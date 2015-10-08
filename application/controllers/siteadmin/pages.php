<?php

class Pages Extends CI_Controller{
	
	function Pages() 
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('pages'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->model('Pages_model');
		$this->load->model('Banner_model');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['pages']=$this->Pages_model->get_pages();
		$this->load->view('admin/pages',$data);		
	}
	
	function menus()
	{
		$data['pages']=$this->Pages_model->get_pages();
		$this->load->view('admin/pages_menu',$data);		
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Update';
		$data['this_class'] = get_class($this);
		$data['banners'] = $this->Banner_model->get_banners();
		
		$this->form_validation->set_rules('page_name', 'Page Name','required');
		$this->form_validation->set_rules('page_handle', 'Contents','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(!$_POST)
			{
				$data['page'] = $this->Pages_model->get_page($id);
			}
					
			$this->load->view('admin/page-form',$data);
		}
		else
		{
			$this->Pages_model->update($this->input->post());
			redirect('/siteadmin/pages');
			exit;
		}		
	}
	
	function create()
	{
		$data = array();
		$data['action'] = 'Create';
		$data['this_class'] = get_class($this);
		$data['banners'] = $this->Banner_model->get_banners();
					
		$this->form_validation->set_rules('page_name', 'Page Name','required');
		$this->form_validation->set_rules('page_handle', 'Contents','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/page-form',$data);
		}
		else
		{
			$this->Pages_model->create($this->input->post());
			redirect('/siteadmin/pages');
			exit;
		}		
	}
	
	
	function delete($id)
	{
		$this->Pages_model->delete($id);
		redirect('/siteadmin/pages');
		exit;
	}
	
	
	
}
