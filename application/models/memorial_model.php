<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Memorial_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getSettings($affid)
	{
		$this->db->select('business_name,address,city,postalcode,province_id,country_id,affiliatename,telephone,email,password,language');
		$this->db->from('affiliates');
		$this->db->where('affiliate_id',$affid);
		
		return $this->db->get()->row();

	}
	
	function updateSettings($vars,$affid)
	{
		$data['business_name'] = $vars['business_name'];
		$data['address'] = $vars['address'];
		$data['city'] = $vars['city'];
		$data['postalcode'] = $vars['postalcode'];
		$data['province_id'] = $vars['province_id'];
		$data['country_id'] = $vars['country_id'];
		$data['affiliatename'] = $vars['affiliatename'];
		$data['telephone'] = $vars['telephone'];
		$data['email'] = $vars['email'];
		$data['password'] = $vars['password'];
		$data['language'] = $vars['language'];
		
		$this->db->where('affiliate_id',$affid);
		$this->db->update('affiliates',$data);
		
		return $this->db->affected_rows();
		
	}
	
	
	function getShipping($province,$country)
	{
		$query = $this->db->query("SELECT * FROM shippingcharge WHERE country_id={$country} AND province_id=$province");
		
		return $query->row();
	}
	
	
	function getTax($province,$country)
	{
		$query = $this->db->query("SELECT * FROM tax WHERE country_id={$country} AND province_id=$province");
		
		return $query->row();
	}
	
	function getColors()
	{
		$query = $this->db->get('colors');
		return $query->result();
	}
	
	function getOccasions()
	{
		$query = $this->db->get('occasions');
		return $query->result();
	}
	
	function getCategories()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}
	
	function getTypes()
	{
		$query = $this->db->get('types');
		return $query->result();
	}
	
	function getCountries()
	{
		$query = $this->db->get('countries');
		return $query->result();
	}
	
	function getProvinces()
	{
		$query = $this->db->get('provinces');
		return $query->result();
	}
	
	function getTemplates()
	{
		$query = $this->db->get('templates');
		return $query->result();
	}
	
	
}

