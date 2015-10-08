<?php

class Addon_Model extends CI_Model{
	
	function Addon_Model()
	{
		parent::__construct();
	}
	
	function create($vars,$pic)
	{
		$this->db->set('addon_name',$vars['addon_name']);
		$this->db->set('description',$vars['description']);
		$this->db->set('addon_picture',$pic);		
		$this->db->insert('addon_products');
		
		$id = $this->db->insert_id();

		if(isset($vars['option']) && count($vars['option']))
		{
			foreach($vars['option'] as $key=>$val)
			{
				$this->db->insert('addon_prices',array('addon_id'=>$id,
							'price'=>$vars['price'][$key],
							'description'=>$val));
			}
		}
		
		if(count($vars['delivery_method_id']))
		{
			foreach($vars['delivery_method_id'] as $dmethod)
			{
				$this->db->set('addon_id',$id);
				$this->db->set('delivery_method_id', $dmethod);
				$this->db->insert('addons_deliverymethods');
			}
		}
		
		return $id;
	}
	
	function get_addons()
	{
		$this->db->select('*,addon_products.addon_id AS addon_id');
		$this->db->from('addon_products');
		$this->db->join('addon_prices','addon_products.addon_id=addon_prices.addon_id','left');
		$this->db->group_by('addon_products.addon_id');
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
		
	}


	function getAddons()
	{
		$this->db->select('*,addon_products.addon_id AS addon_id');
		$this->db->from('addon_products');
		$this->db->join('addon_prices','addon_products.addon_id=addon_prices.addon_id','left');
		$this->db->group_by('addon_products.addon_id');
		$query = $this->db->get();

		foreach($query->result() as $row)
		{
			$res = $row;
			$prices = $this->db->get_where('addon_prices',array('addon_id'=>$row->addon_id));
			$res->prices = $prices->result();

		}

		
		return $res;
		
	}
	
	
	function getProductAddons($id)
	{
		$this->db->from('products');
		$this->db->join('categories','products.category_id=categories.category_id','left');
		$this->db->where('products.product_id',$id);

		$query = $this->db->get();
		$product = $query->row();

		if($product->show_addons==1)
		{

			$this->db->from('addons_deliverymethods');
			$this->db->join('addon_products','addons_deliverymethods.addon_id=addon_products.addon_id','left');
			$this->db->group_by('addons_deliverymethods.addon_id');
			$this->db->where('addons_deliverymethods.delivery_method_id',$product->delivery_method_id);
			$query = $this->db->get();
			
			$result = array();
			
			foreach($query->result() as $row)
			{
				$res = $row;
				$prices = $this->db->get_where('addon_prices',array('addon_id'=>$row->addon_id));
				$res->prices = $prices->result();

				$result[] = $res;

			}
			
			return $result;			
		}

		return array();	

	}
	
	
	function get_addon($id)
	{
		$query = $this->db->get_where('addon_products',array('addon_id'=>$id));
		foreach($query->result() as $row)
		{
			$res = $row;
			
			$dquery = $this->db->get_where('addons_deliverymethods',array('addon_id'=>$id));
			$pquery = $this->db->get_where('addon_prices',array('addon_id'=>$id));
			
			foreach($dquery->result() as $drow)
			{

				$res->delivery_methods[] = $drow->delivery_method_id; 
				
			}

			$res->prices = $pquery->result();
			
			return $res;
		}
		
	}
	
	function update($vars,$pic)
	{

		$this->db->set('addon_name',$vars['addon_name']);
		$this->db->set('description',$vars['description']);
		if($pic!='')
		{
			$this->db->set('addon_picture',$pic);
		}		
		$this->db->where('addon_id',$vars['addon_id']);
		$this->db->update('addon_products');
		//die($this->db->last_query());
		$id = $vars['addon_id'];

		$this->db->delete('addon_prices',array('addon_id'=>$id));

		if(isset($vars['option']) && count($vars['option']))
		{

			foreach($vars['option'] as $key=>$val)
			{
				$this->db->insert('addon_prices',array('addon_id'=>$id,
														'price'=>$vars['price'][$key],
														'description'=>$val));

			}
		}
		
		$this->db->delete('addons_deliverymethods',array('addon_id'=>$id));
		
		if(count($vars['delivery_method_id']))
		{
			foreach($vars['delivery_method_id'] as $dmethod)
			{
				$this->db->set('addon_id',$id);
				$this->db->set('delivery_method_id', $dmethod);
				$this->db->insert('addons_deliverymethods');
			}
		}

		return $id;	
	}
	
	function is_exists($value,$field,$id)
	{
		$this->db->from('addon_products');
		$this->db->where($field,$value);
		$this->db->where('addon_id <>',$id);
		$query = $this->db->get();
		if($query->num_rows>0)
			return TRUE;
		else
			return FALSE;
	}
	
	function delete($id)
	{
		$this->db->delete('addon_products',array('addon_id'=>$id));
		$this->db->delete('addon_prices',array('addon_id'=>$id));
		$this->db->delete('addons_deliverymethods',array('addon_id'=>$id));
	}
	
} 