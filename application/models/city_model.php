<?php

class City_Model extends CI_Model{
	
	function City_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('province_id',$vars['province_id']);
		$this->db->set('city_name',$vars['city_name']);
		$this->db->insert('cities');
		return $this->db->insert_id();			
	}
	
	function get_default($country_id=0,$province_id=0) {
		$this->db->from('cities');
		$this->db->join('provinces','provinces.province_id=cities.province_id');
		$this->db->join('countries','provinces.country_id=countries.country_id');
		$this->db->order_by('countries.country_id ASC, provinces.province_id ASC, cities.city_id ASC');
		if($country_id>0)
		{
			$this->db->where('provinces.country_id',$country_id);
		}
		if($country_id>0)
		{
			$this->db->where('cities.province_id',$province_id);
		}
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->row();
	}
	
	function get_cities($province_id='')
	{
		$this->db->from('cities');
		$this->db->join('provinces','provinces.province_id=cities.province_id');
		$this->db->join('countries','provinces.country_id=countries.country_id');
		$this->db->order_by('countries.country_id ASC, provinces.province_id ASC');
		if($province_id>0) 
		{
			$this->db->where('cities.province_id',$province_id);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_city($id)
	{
		$this->db->from('cities');
		$this->db->join('provinces','provinces.province_id=cities.province_id');
		$this->db->join('countries','provinces.country_id=countries.country_id');
		$this->db->where(array('city_id'=>$id));
		$query = $this->db->get();		
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('province_id',$vars['province_id']);
		$this->db->set('city_name',$vars['city_name']);
		$this->db->where('city_id',$vars['city_id']);
		$this->db->update('cities');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('cities',array('city_id'=>$id));
	}
	
} 