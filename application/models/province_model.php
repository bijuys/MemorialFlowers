<?php

class Province_Model extends CI_Model{
	
	function Province_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('country_id',$vars['country_id']);
		$this->db->set('province_name',$vars['province_name']);
		$this->db->insert('provinces');
		return $this->db->insert_id();			
	}
	
	function get_all_provinces()
	{
		$this->db->from('provinces');
		$query = $this->db->get();
		return $query->result();		
	}
	
	function get_provinces($country_id=0)
	{
		$this->db->from('provinces');
		$this->db->join('countries','countries.country_id=provinces.country_id');
		if($country_id>0) 
		{
			$this->db->where(array('provinces.country_id'=>$country_id));
		}
		$this->db->order_by('provinces.country_id,province_name','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_provinces_new($country_id=0)
	{
		$this->db->from('provinces');
		$this->db->where('country_id',$country_id);
		$this->db->order_by('province_name','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_provinces_name($countries)
	{
		$countries = explode(',',$countries);
		$this->db->from('provinces');
		$this->db->join('countries','countries.country_id=provinces.country_id');
		if(count($countries)) 
		{
			foreach($countries as $row):
				$this->db->where(array('countries.country_name'=>$row));
			endforeach;
		}
                $this->db->order_by('provinces.province_name','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_province($id)
	{
		$query = $this->db->get_where('provinces',array('province_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('country_id',$vars['country_id']);
		$this->db->set('province_name',$vars['province_name']);
		$this->db->where('province_id',$vars['province_id']);
		$this->db->update('provinces');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('provinces',array('province_id'=>$id));
	}
	
} 