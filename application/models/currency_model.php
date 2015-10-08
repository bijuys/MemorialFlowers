<?php

class Currency_Model extends CI_Model{
	
	function Currency_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{

		$data = array('currency_id'=>$vars['currency_id'],
			      'currency_name'=>$vars['currency_name'],
			      'currency_symbol'=>$vars['currency_symbol'],
			      'prefix'=>$vars['prefix'],
			      'suffix'=>$vars['suffix'],
			      'exchange_rate'=>$vars['exchange_rate'] ? $vars['exchange_rate']:1,
			      'timestamp'=>time(),
			      'base_currency'=>isset($vars['base_currency']) ? $vars['base_currency']:0
			      );
		if($this->db->insert('currencies',$data))
		{
			if(isset($vars['base_currency']) && $vars['base_currency']==1)
			{
				$this->db->where('currency_id !=',$vars['currency_id']);
				$this->db->update('currencies',array('base_currency'=>0));

			}			

			return TRUE;
		}

		return FALSE;

	}
	
	function get_currencies()
	{
		$query = $this->db->get('currencies');
		return $query->result();
	}
	
	function get_currency($id)
	{
		$query = $this->db->get_where('currencies',array('currency_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars)
	{
		$data = array('currency_id'=>$vars['currency_id'],
			      'currency_name'=>$vars['currency_name'],
			      'currency_symbol'=>$vars['currency_symbol'],
			      'prefix'=>$vars['prefix'],
			      'suffix'=>$vars['suffix'],
			      'exchange_rate'=>$vars['exchange_rate'] ? $vars['exchange_rate']:1,
			      'timestamp'=>time(),
			      'base_currency'=>isset($vars['base_currency']) ? $vars['base_currency']:0			      
			      );
		$this->db->where('currency_id',$vars['id']);
		$this->db->update('currencies',$data);

		if($this->db->affected_rows() && isset($vars['base_currency']) && $vars['base_currency']==1)
		{
			$this->db->where('currency_id !=',$vars['id']);
			$this->db->update('currencies',array('base_currency'=>0));

		}

		return TRUE;

	
	}
	
	function delete($id)
	{
		$this->db->delete('currencies',array('currency_id'=>$id));
	}
	
} 