<?php

class Color_Model extends CI_Model{
	
	function Color_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$this->db->set('color_name',$vars['color_name']);
		$this->db->set('color_code',$vars['color_code']);
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->insert('colors');
		return $this->db->insert_id();			
	}
	
	function get_colors()
	{
		$query = $this->db->get('colors');
		return $query->result();
	}
	
	function get_color($id)
	{
		$query = $this->db->get_where('colors',array('color_id'=>$id));
		return $query->row();
		
	}
	
	function get_color_byname($name)
	{
		$this->db->from('colors');
		$this->db->join('banners','colors.banner_id=banners.banner_id','left');
		$this->db->where('color_name',$name);
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function getColorDetails($name)
	{
		$query = $this->db->query("SELECT *,c.color_name AS title FROM colors c
					  LEFT JOIN banners b ON c.banner_id=b.banner_id
					  WHERE c.color_name='{$name}'");
		return $query->row();
		
	}
	
	function update($vars)
	{
		$this->db->set('color_name',$vars['color_name']);
		$this->db->set('color_code',$vars['color_code']);
		$this->db->set('banner_id',$vars['banner_id']);
		$this->db->set('page_id',$vars['page_id']);
		$this->db->set('description',$vars['description']);
		$this->db->set('description_fr',$vars['description_fr']);
		$this->db->where('color_id',$vars['color_id']);
		$this->db->update('colors');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('colors',array('color_id'=>$id));
	}
	
} 