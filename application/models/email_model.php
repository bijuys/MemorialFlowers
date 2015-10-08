<?php

class Email_Model extends CI_Model{
	
	function Email_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('message_title',$vars['message_title']);
		$this->db->set('message_title_fr',$vars['message_title_fr']);
		$this->db->set('message_text',$vars['message_text']);
		$this->db->set('message_text_fr',$vars['message_text_fr']);
		$this->db->set('attach_page',$vars['attach_page']);
		$this->db->set('message_type','email');
		$this->db->insert('message_templates');
		return $this->db->insert_id();			
	}
	
	function getTitle($page,$vars)
	{
		$this->db->where('message_type','email');
		$this->db->where('attach_page',$page);
		$this->db->limit(1);
		$query = $this->db->get('message_templates');
		
		$res = $query->row();
		
		$title = ($this->session->userdata('language') == 'french') ? $res->message_title_fr : $res->message_title;	
		
		return $title;
	}
	
	function getMessage($page,$vars)
	{
		$this->db->where('message_type','email');
		$this->db->where('attach_page',$page);
		$this->db->limit(1);
		$query = $this->db->get('message_templates');
		
		$res = $query->row();
		
		$message = ($this->session->userdata('language') == 'french') ? $res->message_text_fr : $res->message_text;
		
		foreach($vars as $key=>$val)
		{
			$varname = '{'.strtoupper($key).'}';		
			$message = str_replace($varname,$val,$message);
			
		}
		
		
		return $message;
	}
	
	function get_emails()
	{
		$query = $this->db->get_where('message_templates',array('message_type'=>'email'));	
		return $query->result();
	}
	
	function get_email($id)
	{
		$query = $this->db->get_where('message_templates',array('message_id'=>$id));
		return $query->row();
	}
	
	function update($vars)
	{
		$this->db->set('message_title',$vars['message_title']);
		$this->db->set('message_title_fr',$vars['message_title_fr']);
		$this->db->set('message_text',$vars['message_text']);
		$this->db->set('message_text_fr',$vars['message_text_fr']);
		$this->db->set('attach_page',$vars['attach_page']);
		$this->db->where('message_id',$vars['message_id']);
		$this->db->update('message_templates');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('message_templates',array('message_id'=>$id));	
	}
	
} 