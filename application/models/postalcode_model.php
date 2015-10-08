<?php

class Postalcode_Model extends CI_Model{
	
	function Postalcode_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('city_id',$vars['city_id']);
		$this->db->set('postalcode',$vars['postalcode']);
		$this->db->insert('postalcodes');
		return $this->db->insert_id();			
	}
	
	function is_valid($val)
	{
		$val = strtoupper(str_replace(' ','',trim($val)));
		$this->db->from('postalcodes');
		$this->db->where('REPLACE(UPPER(postalcode)," ","")=',$val);
		if($this->db->count_all_results()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function is_valid_canadian($val)
	{
		$val = strtoupper(str_replace(' ','',trim($val)));
		$this->db->from('postalcodes');
		$this->db->join('cities','postalcodes.city_id=cities.city_id','left');
		$this->db->join('provinces','provinces.province_id=cities.province_id','left');
		$this->db->join('countries','countries.country_id=provinces.country_id');
		$this->db->where('REPLACE(UPPER(postalcode)," ","")=',$val);
		$this->db->where('countries.country_id','1');
		if($this->db->count_all_results()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_postalcodes($city_id)
	{
		$this->load->helper('url'); 
		$this->db->from('postalcodes');
		$this->db->join('cities','cities.city_id=postalcodes.city_id');
		$this->db->join('provinces','provinces.province_id=cities.province_id');
		$this->db->join('countries','provinces.country_id=countries.country_id');
		$this->db->order_by('countries.country_id ASC, provinces.province_id ASC, cities.city_id ASC');
		$this->db->where('postalcodes.city_id',$city_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_postalcode($id)
	{
		$this->db->from('postalcodes');
		$this->db->join('cities','cities.city_id=postalcodes.city_id');
		$this->db->join('provinces','provinces.province_id=cities.province_id');
		$this->db->join('countries','provinces.country_id=countries.country_id');
		$this->db->where(array('postalcode_id'=>$id));
		$query = $this->db->get();		
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('city_id',$vars['city_id']);
		$this->db->set('postalcode',$vars['postalcode']);
		$this->db->where('postalcode_id',$vars['postalcode_id']);
		$this->db->update('postalcodes');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('postalcodes',array('postalcode_id'=>$id));
	}
	
	function get_info($val)
	{
		$val = strtoupper(str_replace(' ','',trim($val)));
		$this->db->from('postalcodes');
		$this->db->join('cities','postalcodes.city_id=cities.city_id','left');
		$this->db->join('provinces','provinces.province_id=cities.province_id','left');
		$this->db->join('countries','countries.country_id=provinces.country_id');
		$this->db->where('REPLACE(UPPER(postalcode)," ","")=',$val);
		$this->db->where('countries.country_id','1');
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
} 