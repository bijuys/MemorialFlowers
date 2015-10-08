<?php

class Diseases_model extends CI_Model{
	
	function Diseases_model()
	{
		parent::__construct();
	}
	
	function validate_data($fields)
	{		
		return ( $this->db->get_where('diseases', array('data_id' => $fields['data_id']))->num_rows() == 0 )? TRUE : FALSE;	
	}

	function insert_data($fields)
	{
		$this->db->insert('diseases', $fields); 		
	}
	
} 