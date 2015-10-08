<?php

class Country_Model extends CI_Model{
	
	function Country_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('short_code',$vars['short_code']);
		$this->db->set('country_name',$vars['country_name']);
		$this->db->insert('countries');
		return $this->db->insert_id();			
	}
	
	function getMainCountries()
	{
		$this->db->where('main',1);
		$this->db->order_by('country_name','ASC');
		$query = $this->db->get('countries');
		
		return $query->result();
	}
	
	function getContinentCountries($code)
	{
		$this->db->where('continent_code',$code);
		$query = $this->db->get('countries');
		
		return $query->result();
	} 
	
	function alphaCountries()
	{
		$this->db->order_by('country_name','ASC');
		$query = $this->db->get('countries');
		
		$countrylist = array();
		
		foreach($query->result() as $row)
		{
				$countrylist[strtoupper(substr(trim($row->country_name),0,1))][]=$row;

		}
		
		return $countrylist;
	
	}
	
	function get_countries()
	{
		$this->load->helper('url');
		$this->db->from('countries');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_country($id)
	{
		$query = $this->db->get_where('countries',array('country_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('short_code',$vars['short_code']);
		$this->db->set('country_name',$vars['country_name']);
		$this->db->where('country_id',$vars['country_id']);
		$this->db->update('countries');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('countries',array('country_id'=>$id));
	}
	
} 