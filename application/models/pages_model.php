<?php

class Pages_Model extends CI_Model{
	
	function Pages_Model()
	{
		parent::__construct();
	}
	
	function create($vars)
	{
		$data = array('page_name'=>$vars['page_name'],
			      'page_handle'=>$vars['page_handle'],
			      'page_title'=>$vars['page_title'],
			      'page_title_fr'=>$vars['page_title_fr'],
			      'h1'=>$vars['h1'],
			      'h1_fr'=>$vars['h1_fr'],
			      'keywords'=>$vars['keywords'],
			      'canonical'=>$vars['canonical'],
			      'contents'=>$vars['contents'],
			      'contents_fr'=>$vars['contents_fr'],
			      'content_position'=> empty($vars['content_position']) ? 'bottom':$vars['content_position'],
			      'banner_id'=>$vars['banner_id'],
			      'description'=>$vars['description']);
		$this->db->insert('pages',$data);
		
		return $this->db->insert_id();
	}
	
	function get_lan_pages()
	{
		$this->db->from('product_groups');
		$this->db->where('publish_home',0);
		$this->db->where('productgroup_status','1');
		$this->db->order_by('productgroup_name','asc');
		//$query = "select * from product_groups where publish_home=0 and banner_id!=0"
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_pages()
	{
		$this->db->from('pages');
		$this->db->order_by('page_name','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_page($id)
	{
		$this->db->from('pages');
		$this->db->join('banners','pages.banner_id=banners.banner_id','left');
		$this->db->where('page_id',$id);
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function return_page($handle)
	{
		$this->db->from('pages');
		$this->db->join('banners','pages.banner_id=banners.banner_id','left');
		$this->db->where('page_handle',$handle);
		$query = $this->db->get();
		return $query->row();
	}
	
	function update($vars)
	{
		$data = array('page_name'=>$vars['page_name'],
			      'page_handle'=>$vars['page_handle'],
			      'page_title'=>$vars['page_title'],
			      'h1'=>$vars['h1'],
			      'h1_fr'=>$vars['h1_fr'],
			      'page_title_fr'=>$vars['page_title_fr'],
			      'keywords'=>$vars['keywords'],
			      'canonical'=>$vars['canonical'],
			      'banner_id'=>$vars['banner_id'],
			      'contents'=>$vars['contents'],
			      'contents_fr'=>$vars['contents_fr'],
			      'content_position'=> empty($vars['content_position']) ? 'bottom':$vars['content_position'],
			      'description'=>$vars['description']);
		$this->db->where('page_id',$vars['page_id']);
		$this->db->update('pages',$data);
		
		return $this->db->affected_rows();			
	}
	
	function delete($id)
	{
		$this->db->delete('pages',array('page_id'=>$id,'core'=>0));	
	}
	
	//DYNAMIC CHANGES
	function home_page_info()
	{
	
		$query = $this->db->query('SELECT * FROM home_page
									WHERE status_id=1');							
									
								   
		return $query->row();
	
	}
	
	function home_page_info2()
	{
	
		$query = $this->db->query('SELECT * FROM home_page
									WHERE status_main=1');							
									
								   
		return $query->row();
	
	}
	
} 