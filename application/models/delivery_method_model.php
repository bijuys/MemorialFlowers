<?php

class Category_Model extends CI_Model{
	
	function Category_Model()
	{
		parent::__construct();
	}
	
	function create($vars,$icon)
	{
		$this->db->set('category_name',$vars['category_name']);
		$this->db->set('parent_id',$vars['parent_id']);
		$this->db->set('category_status',$vars['category_status']=='1'?'1':'0');
		$this->db->set('icon_image',$icon);
		$this->db->insert('categories');
		return $this->db->insert_id();			
	}
	
	function rowparser($row)
	{
		$temp_cat = $row;
		$row->category_name=NULL;
		$row->category_id=NULL;
		$row->category_status=NULL;
		
		return $row;
				
	}
	
	function get_categories()
	{
		$query = $this->db->query("SELECT *,ABS(CONCAT(IF(parent_id>0,parent_id,category_id),category_id)) AS corder FROM categories p ORDER BY (corder) ASC");
																	
		return $query->result();
	}
	
	function get_category($id)
	{
		$query = $this->db->get_where('categories',array('category_id'=>$id));
		return $query->row();
		
	}
	
	function update($vars,$icon)
	{
		$this->db->set('category_name',$vars['category_name']);
		$this->db->set('parent_id',$vars['parent_id']);
		$this->db->set('category_status',$vars['category_status']=='1'?'1':'0');
		if(strlen($icon)>2) 
		{ 
			$this->db->set('icon_image',$icon); 
		} 
			
		$this->db->where('category_id',$vars['category_id']);
		$this->db->update('categories');
		
		die($this->db->last_query());
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$check = $this->db->get_where('categories',array('parent_id'=>$id));
		if($check->num_rows()>0)
		{
			return FALSE;
		}
		else
		{
			$this->db->delete('categories',array('category_id'=>$id));	
		}
	}
	
} 