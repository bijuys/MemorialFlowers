<?php

class Holiday_Model extends CI_Model{
	
	function Holiday_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('holiday_name',$vars['holiday_name']);
		if($vars['holiday_day']>0 && $vars['holiday_month']>0)
		{
			$this->db->set('holiday_day',$vars['holiday_day']);
			$this->db->set('holiday_month',$vars['holiday_month']);
		}
		$this->db->insert('holidays');
		return $this->db->insert_id();			
	}
	
	function get_holidays()
	{
		$this->db->where('holiday_status !=','-1');
		$query = $this->db->get('holidays');
		return $query->result();
	}
	
	function get_holiday($id)
	{
		$query = $this->db->get_where('holidays',array('holiday_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('holiday_name',$vars['holiday_name']);
		if($vars['holiday_day']>0 && $vars['holiday_month']>0)
		{
			$this->db->set('holiday_day',$vars['holiday_day']);
			$this->db->set('holiday_month',$vars['holiday_month']);
		}
		$this->db->where('holiday_id',$vars['holiday_id']);
		$this->db->update('holidays');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->set('holiday_status','-1');
		$this->db->where('holiday_id',$id);
		$this->db->update('holidays');
	}
	
} 