<?php

class Banner_Model extends CI_Model{
	
	function Banner_Model()
	{
		parent::__construct();
	}
	
	
	function createTile($vars,$image)
	{
		$this->db->set('banner_name',$vars['banner_name']);
		$this->db->set('link_to',$vars['link_to']);
		$this->db->set('banner_file',$image);
		$this->db->set('banner_type','tile');
		$this->db->insert('banners');
		
                $id = $this->db->insert_id();
		
		
		/*
		
		if($id>0 && count($vars['pages']))
		{
			foreach($vars['pages'] as $page)
			{
				$this->db->where('page_id',$page);
				$this->db->update('pages',array('banner_id'=>$id));
			}
		}
		
		*/
		
		return $id;			
	}
	
	function create($vars,$image,$image_fr)
	{
		$this->db->set('banner_name',$vars['banner_name']);
		$this->db->set('link_to',$vars['link_to']);
		$this->db->set('banner_file',$image);
		$this->db->set('banner_file_fr',$image_fr);
		$this->db->insert('banners');
		
                $id = $this->db->insert_id();
		
		
		/*
		
		if($id>0 && count($vars['pages']))
		{
			foreach($vars['pages'] as $page)
			{
				$this->db->where('page_id',$page);
				$this->db->update('pages',array('banner_id'=>$id));
			}
		}
		
		*/
		
		return $id;			
	}
	
	function get_banners()
	{
		$query = $this->db->get('banners');
		return $query->result();
	}
	
	function get_tiles()
	{
		$this->db->where('banner_type','tile');
		$this->db->order_by('banner_id','ASC');
		$query = $this->db->get('banners');
		return $query->result();
	}
	
	function get_banner($id)
	{
		$query = $this->db->get_where('banners',array('banner_id'=>$id));
		
		return $query->row();
		
	}
	
	function update($vars,$image,$image_fr)
	{
		$this->db->set('banner_name',$vars['banner_name']);
		$this->db->set('link_to',$vars['link_to']);
		if($image!='')
			$this->db->set('banner_file',$image);
		if($image_fr!='')
			$this->db->set('banner_file_fr',$image_fr);
		$this->db->where('banner_id',$vars['banner_id']);
		$this->db->update('banners');
		return $this->db->affected_rows();			
	}
	
	function updateTile($vars,$image)
	{
		$this->db->set('banner_name',$vars['banner_name']);
		$this->db->set('link_to',$vars['link_to']);
		if($image!='')
			$this->db->set('banner_file',$image);
		$this->db->where('banner_id',$vars['banner_id']);
		$this->db->update('banners');
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('banners',array('banner_id'=>$id));
	}
	
} 