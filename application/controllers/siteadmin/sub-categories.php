<?php

class Categories extends CI_Controller {
	
	function Categories()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('categories'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		
		$this->load->helper('url'); 
		$this->load->model('Category_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['categories']=$this->Category_model->get_categories();
		$this->load->view('admin/categories',$data);
	}
	
	function delete($id)
	{
		$this->Category_model->delete($id);
		redirect('/siteadmin/categories');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('category_name', 'Category Name','required');
		$this->form_validation->set_rules('category_status', 'Category Status','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['category'] = $this->Category_model->get_category($id);
			}
					
			$data['action'] = 'Update';
			$this->load->view('admin/category-form',$data);
		}
		else
		{
			$this->Category_model->update($this->input->post());
			redirect('/siteadmin/categories');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('category_name', 'Category Name','required');
		$this->form_validation->set_rules('category_status', 'Category Status','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/category-form',$data);
		}
		else
		{
			$this->Category_model->create($this->input->post());
			redirect('/siteadmin/categories');
			exit;
		}
	}
	
	
	
	
}
