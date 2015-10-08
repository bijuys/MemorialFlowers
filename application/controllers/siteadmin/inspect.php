<?php

class Inspect extends CI_Controller {
	function Inspect() 
	{
		parent::__construct();
	}

	function index()
	{
		$query = $this->db->query('DESCRIBE order_items');

		foreach($query->result() as $row)
		{
			print_r($row);
		}
	}
}