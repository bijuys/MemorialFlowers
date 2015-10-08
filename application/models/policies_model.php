<?php

class Policies_Model extends CI_Model{
	
	function Policies_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('message_title',$vars['message_title']);
		$this->db->set('message_title_fr',$vars['message_title_fr']);
		$this->db->set('message_text',$vars['message_text']);
		$this->db->set('message_text_fr',$vars['message_text_fr']);
		$this->db->set('message_type','policy');
		$this->db->insert('message_templates');
		return $this->db->insert_id();			
	}
	
	function get_policies()
	{
		$query = $this->db->get_where('message_templates',array('message_type'=>'policy'));	
		return $query->result();
	}
	
	function get_policy($id)
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
		$this->db->set('message_type','policy');
		$this->db->where('message_id',$vars['message_id']);
		$this->db->update('message_templates');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('message_templates',array('message_id'=>$id));	
	}
	
} 