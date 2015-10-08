<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
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
	
	function getLocationInfo($pcode='')
	{
		$query = $this->db->query("SELECT * FROM postalcodes p
					  LEFT JOIN cities c ON p.city_id=c.city_id 
					  LEFT JOIN provinces r ON c.province_id=r.province_id
					  LEFT JOIN countries n ON r.country_id=n.country_id
					  WHERE REPLACE(p.postalcode,' ','')=UCASE(REPLACE('{$pcode}',' ','')) ");
		
		return $query->row();
	}
	
	
}

