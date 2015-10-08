<?php

class Deliverymethod_Model extends CI_Model{
	
	function Deliverymethod_Model()
	{
		parent::__construct();
	}
	
	function get_deliverymethod_byname($name)
	{
		$this->db->from('delivery_methods');
		$this->db->join('banners','delivery_methods.banner_id=banners.banner_id','left');
		$this->db->where('delivery_method',$name);
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
	
	function create($vars,$icon)
	{
		/*
		$this->db->set('delivery_method',$vars['delivery_method']);
		$this->db->set('delivery_within',$vars['delivery_within']);
		$this->db->set('delivery_charge',$vars['delivery_charge']);
		$this->db->set('delivery_policy_id',$vars['delivery_policy_id']);
		$this->db->set('substitution_policy_id',$vars['substitution_policy_id']);
		$this->db->set('service_charge',$vars['service_charge']);
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('infotext',$vars['infotext']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		if(strlen($icon)>2) 
		{ 
			$this->db->set('icon_image',$icon); 
		} 
		$this->db->set('delivery_days',implode(",",$vars['delivery_days']));
		$this->db->set('stoppage_time',$vars['delivery_hour'].':'.$vars['delivery_minute'].':00');
		$this->db->insert('delivery_methods');
		return $this->db->insert_id();
		
		*/
	}
	
	function get_deliverymethods()
	{
		$query = $this->db->get('delivery_methods');
																	
		return $query->result();
	}
	
	function get_deliverymethod($id)
	{
		$query = $this->db->get_where('delivery_methods',array('delivery_method_id'=>$id));
		return $query->row();
	}
	
	function getDeliverymethodDetails($name)
	{
		$query = $this->db->query("SELECT *,d.delivery_method AS title FROM delivery_methods d 
					  LEFT JOIN banners b ON d.banner_id=b.banner_id 
					  WHERE d.delivery_method='{$name}'");
		return $query->row();
		
	}
	
	function update($vars,$icon)
	{
		$this->db->set('delivery_method',$vars['delivery_method']);
		$this->db->set('delivery_within',$vars['delivery_within']);
		$this->db->set('delivery_charge',$vars['delivery_charge']);
		//$this->db->set('service_charge',$vars['service_charge']);
		$this->db->set('infotext',$vars['infotext']);
		$this->db->set('delivery_days',implode(",",$vars['delivery_days']));
		$this->db->set('delivery_policy_id',$vars['delivery_policy_id']);
		$this->db->set('substitution_policy_id',$vars['substitution_policy_id']);
		$this->db->set('stoppage_time',$vars['delivery_hour'].':'.$vars['delivery_minute'].':00');
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		if(strlen($icon)>2) 
		{ 
			$this->db->set('icon_image',$icon); 
		} 
		$this->db->where('delivery_method_id',$vars['delivery_method_id']);
		$this->db->update('delivery_methods');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('delivery_methods',array('delivery_method_id'=>$id));	
	}
	
} 