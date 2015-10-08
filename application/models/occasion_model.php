<?php

class Occasion_Model extends CI_Model{
	
	function Occasion_Model()
	{
		parent::__construct();
	}
	
	function get_occasions_array()
	{
		$this->db->where('occasion_status <>','-1');
		$this->db->where('occasion_type !=','holiday');
		$query = $this->db->get('occasions');
		
		$occasions = array();
		foreach($query->result_array() as $row)
		{
			$occasions['occasion_id'] = $row['occasion_name'];
		}
		
		return $occasions;		
	}
	
	function create($vars)
	{
		$this->db->set('occasion_name',$vars['occasion_name']);
		if($vars['occasion_day']>0 && $vars['occasion_month']>0)
		{
			$this->db->set('occasion_day',$vars['occasion_day']);
			$this->db->set('occasion_month',$vars['occasion_month']);
			$this->db->set('occasion_type',isset($vars['holiday'])?'both':'occasion');
		}
		$this->db->set('occasion_status',$vars['occasion_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->insert('occasions');
		if($id = $this->db->insert_id())
		{
			if(isset($vars['products']) && count($vars['products']))
			{
				foreach($vars['products'] as $key=>$val)
				{
					$data = array('optionrecord_id'=>$id,
						      'product_id'=>$val,
						      'display_order'=>$vars['display_order'][$val],
						      'option_type'=>'occasion');
					
					$this->db->insert('product_options',$data);
					
				}
			}
			
			return $id;
			
		}
		
		
		
	}
	
	function get_occasion_byname($name)
	{
		$this->db->from('occasions');
		$this->db->join('banners','occasions.banner_id=banners.banner_id','left');
		$this->db->where('occasion_name',$name);
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
	
	function get_occasions()
	{
		$this->db->where('occasion_status !=','-1');
		$this->db->where('occasion_type !=','holiday');
		$query = $this->db->get('occasions');
		return $query->result();
	}
	
	function get_occasion($id)
	{
		$query = $this->db->get_where('occasions',array('occasion_id'=>$id));
		return $query->row();
	}
	
	function getOccasionDetails($name)
	{
		$query = $this->db->query("SELECT *,o.occasion_name AS title FROM occasions o 
					  LEFT JOIN banners b ON o.banner_id=b.banner_id 
					  WHERE o.occasion_name='{$name}'");
		return $query->row();
	}
	
	function update($vars)
	{
		$this->db->set('occasion_name',$vars['occasion_name']);
		if($vars['occasion_day']>0 && $vars['occasion_month']>0)
		{
			$this->db->set('occasion_day',$vars['occasion_day']);
			$this->db->set('occasion_month',$vars['occasion_month']);
			$this->db->set('occasion_type',isset($vars['holiday'])?'both':'occasion');
		}
		$this->db->set('occasion_status',$vars['occasion_status']=='1'?'1':'0');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->where('occasion_id',$vars['occasion_id']);
		$this->db->update('occasions');
		
		$this->db->delete('product_options',array('option_type'=>'occasion','optionrecord_id'=>$vars['occasion_id']));
		
		if(isset($vars['products']) && count($vars['products']))
		{
			foreach($vars['products'] as $key=>$val)
			{
				$data = array('optionrecord_id'=>$vars['occasion_id'],
					      'product_id'=>$val,
					      'display_order'=>$vars['display_order'][$val],
					      'option_type'=>'occasion');
				
				$this->db->insert('product_options',$data);
			}
		}
		
		
		
		return true;			
	}
	
	function delete($id)
	{
		$this->db->set('occasion_status','-1');
		$this->db->where('occasion_id',$id);
		$this->db->update('occasions');
	}
	
	
	function get_holidays()
	{
		$this->db->where('occasion_type !=','-1');
		$this->db->where('occasion_type !=','occasion');
		$query = $this->db->get('occasions');
		return $query->result();
	}
	
	function get_holiday($id)
	{
		$query = $this->db->get_where('occasions',array('occasion_id'=>$id));
		return $query->row();		
	}
	
	function delete_holiday($id)
	{
		$this->db->where('occasion_id',$id);
		$this->db->where('occasion_type','both');
		$this->db->set('occasion_type','occasion');
		$this->db->update('occasions');
		
		//for existing occasions
		
		$this->db->where('occasion_id',$id);
		$this->db->where('occasion_type','holiday');
		$this->db->delete('occasions');
		
		// for holidays
	}
	
	function create_holiday($vars)
	{
		$this->db->set('occasion_name',$vars['occasion_name']);
		$this->db->set('occasion_day',$vars['occasion_day']);
		$this->db->set('occasion_month',$vars['occasion_month']);
		$this->db->set('occasion_type','holiday');
		$this->db->insert('occasions');
		return $this->db->insert_id();			
	}	
	
	function update_holiday($vars)
	{
		$this->db->set('occasion_name',$vars['occasion_name']);
		$this->db->set('occasion_day',$vars['occasion_day']);
		$this->db->set('occasion_month',$vars['occasion_month']);
		$this->db->set('occasion_type','holiday');
		$this->db->where('occasion_id',$vars['occasion_id']);
		$this->db->update('occasions');
		return $this->db->affected_rows();			
	}
	
	
	
	function get_products($id=0)
	{
		
		$query = $this->db->query("SELECT p.* FROM products p
					  LEFT JOIN product_options o ON p.product_id=o.product_id 
					  WHERE p.product_id NOT IN (SELECT t.product_id FROM product_options t
					  WHERE t.optionrecord_id={$id} AND t.option_type='occasion')  
					  GROUP BY p.product_id
					  ORDER BY p.product_name");
				
		return $query->result();		
		
	}
	
	
	function get_assigned($id)
	{
		
		$query = $this->db->query("SELECT * FROM product_options o 
					  LEFT JOIN products p ON o.product_id=p.product_id 
					  WHERE o.optionrecord_id={$id} AND o.option_type='occasion'
					  AND p.product_id>0 
					  GROUP BY p.product_id 
					  ORDER BY o.display_order");
		
		return $query->result();		
		
	}
	
	
} 