<?php

class Discounts_Model extends CI_Model{
	
	function Discounts_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$data = array('discount_name'=>$vars['discount_name'],
			      'discount_type'=>$vars['discount_type'],
			      'discount_amount'=>$vars['discount_value_type']=='$' ? $vars['discount_value']:'0',
			      'discount_percentage'=>$vars['discount_value_type']=='%' ? $vars['discount_value']:'0',
			      'discount_minimum'=>$vars['discount_minimum'],
			      'discount_limit'=>$vars['discount_limit'],
			      'discount_expiry'=>$vars['year'].'-'.$vars['month'].'-'.$vars['day'],
			      'discount_start'=>$vars['syear'].'-'.$vars['smonth'].'-'.$vars['sday'],
				  'discount_firstname'=>$vars['custo_first'],
				  'discount_lastname'=>$vars['custo_last'],
				  'discount_orderfix'=>$vars['disc_pre_or'],
				  'discount_reason'=>$vars['disc_reason']
			      );
		$this->db->insert('discounts',$data);
		return $this->db->insert_id();			
	}
	
	function get_discounts()
	{
		$query = $this->db->get('discounts');
		return $query->result();
	}
	
	/*function get_discounts($id)
	{
		$query = $this->db->get('discounts');
		$query = $this->db->where('socialdeal_id',$id);
		return $query->result();
	}*/
	
	function get_discount($id)
	{
		$query = $this->db->get_where('discounts',array('discount_id'=>$id));
		return $query->row();
		
	}
	
	function get_coupon_deals($id)
	{
		$query = $this->db->get_where('discounts',array('socialdeal_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars)
	{
		$data = array('discount_name'=>$vars['discount_name'],
			      'discount_type'=>$vars['discount_type'],
			      'discount_amount'=>$vars['discount_value_type']=='$' ? $vars['discount_value']:'0',
			      'discount_percentage'=>$vars['discount_value_type']=='%' ? $vars['discount_value']:'0',
			      'discount_minimum'=>$vars['discount_minimum'],
			      'discount_limit'=>$vars['discount_limit'],
			      'discount_expiry'=>$vars['year'].'-'.$vars['month'].'-'.$vars['day'],
			      'discount_start'=>$vars['syear'].'-'.$vars['smonth'].'-'.$vars['sday']
			      );
		$this->db->where('discount_id',$vars['discount_id']);
		$this->db->update('discounts',$data);
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('discounts',array('discount_id'=>$id));
	}
	
} 