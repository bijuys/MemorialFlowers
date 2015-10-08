<?php

class Productgroup_Model extends CI_Model{
	
	function Productgroup_Model()
	{
		parent::__construct();
	}
	
	function get_unallocatedproducts()
	{
		$this->db->select('*,products.product_id AS product_id');
		$this->db->from('products');
		$this->db->join('group_products','products.product_id=group_products.product_id','left');
		//$this->db->where('group_products.groupproduct_id IS NULL');
		$this->db->where('products.landing_status', '1');
		$this->db->order_by('products.product_name');
		$this->db->group_by('products.product_id');
		$res = $this->db->get();
		
		return $res->result();
	}
	
	function get_products($id)
	{
		$this->db->select('*,products.product_id AS product_id');
		$this->db->from('products');
		$this->db->join('group_products','products.product_id=group_products.product_id','left');
		//$this->db->where('group_products.groupproduct_id IS NULL OR group_products.productgroup_id='.$id);
		$this->db->where('products.landing_status', '1');
		$this->db->order_by('products.product_name');
		$this->db->group_by('products.product_id');
		$res = $this->db->get();
		
		return $res->result();
	}
	
	function create($vars)
	{
		$products = isset($vars['product_id'])?$vars['product_id']:array();
		$this->db->set('productgroup_name',$vars['productgroup_name']);
		$this->db->set('productgroup_link',$vars['productgroup_link']);
		
		$this->db->set('productgroup_status',$vars['productgroup_status'] ? '1':'0');
		$this->db->set('publish_home',$vars['publish_home'] ? '1':'0');
		$this->db->set('display_order',$vars['display_order'] ? $vars['display_order']:'0');
		$this->db->set('banner_id',$vars['banner_id']);
                //$this->db->set('page_id',$vars['page_id']);
                $this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->insert('product_groups');
		$lastid = $this->db->insert_id();
		
		if(count($products)) {	
			foreach($products as $row=>$val)
			{
				$this->db->set('productgroup_id',$lastid);
				$this->db->set('product_id',$row);
				$this->db->insert('group_products');			
			}			
		}		
		
		return $lastid;				
	}
	
	function get_groups()
	{
		$query = $this->db->get('product_groups');
		return $query->result();
	}
	
	function get_group($id)
	{
		$query = $this->db->get_where('product_groups',array('productgroup_id'=>$id));
		$result = $query->row();
		
		$this->db->from('group_products');
		$this->db->where('productgroup_id',$id);
		$items = $this->db->get();
		
		$pro = array();
		
		foreach($items->result() as $row)
		{
			$pro[]=$row->product_id;
		}
		
		$result->products = $pro;
	
		return $result;
	}
	
	function get_grouplanding($id2)	
	{
		$this->db->from('product_groups');
		//$this->db->join('banners','pages.banner_id=banners.banner_id','left');
		$this->db->where('productgroup_name',$id2);
		$query = $this->db->get();
		return $query->row();
		
		/*
		$query = $this->db->get_where('product_groups',array('productgroup_name'=>$id2));
		$result = $query->row();
		
		return $result;*/
	}
	
	
	function getGroupDetails($name)
	{
		return true;
	}
	
	function update($vars)
	{
		$this->db->set('productgroup_name',$vars['productgroup_name']);
		$this->db->set('productgroup_link',$vars['productgroup_link']);
		
		$this->db->set('publish_home',$vars['publish_home'] ? '1':'0');
		$this->db->set('productgroup_status',$vars['productgroup_status'] ? '1':'0');
		
		$this->db->set('display_order',$vars['display_order'] ? $vars['display_order']:'0');
		$this->db->set('banner_id',$vars['banner_id']);
                //$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->where('productgroup_id',$vars['productgroup_id']);
		$this->db->update('product_groups');
		$affrows = $this->db->affected_rows();



		
		$products = isset($vars['product_id'])?$vars['product_id']:array();
		$ord = isset($vars['product_order'])?$vars['product_order']:array();	
		
		$this->db->where('productgroup_id',$vars['productgroup_id']);
		$this->db->delete('group_products');	



	if(isset($vars['products']) && count($vars['products']))
		{
			foreach($vars['products'] as $key=>$val)
			{
				$data = array('productgroup_id'=>$vars['productgroup_id'],
					      'product_id'=>$val,
					      'orderby'=>$vars['product_order'][$val]);
			//echo  $data;
				$this->db->insert('group_products',$data);
			}
		}
		
		
		//	die();
		return $affrows;	
				



		
	}
	
	function delete($id)
	{
		$this->db->delete('product_groups',array('productgroup_id'=>$id));
		$this->db->delete('group_products',array('productgroup_id'=>$id));
	}
	function get_productgroup_byname($name)
	{
		$this->db->from('product_groups');
		$this->db->join('banners','product_groups.banner_id=banners.banner_id','left');
		$this->db->where('productgroup_name',$name);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}
} 