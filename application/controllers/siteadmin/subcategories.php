<?php

class Subcategories extends CI_Controller {
	
	function Subcategories()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('subcategories'))
		{
			redirect('/siteadmin');
			exit;
		}	
		
		$this->load->helper('url'); 
		$this->load->model('Subcategory_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function select()
	{
		if($_POST)
		{
			$this->Category_model->setMainCategories($this->input->post());
		}
		
		$data['categories']=$this->Category_model->get_categories();
		$this->load->view('admin/main-categories',$data);		
	}
	
	function index()
	{
		$data['subcategories']=$this->Subcategory_model->get_subcategories();
		//print_r($data['categories']);
		$this->load->view('admin/subcategories',$data);
	}
	
	function delete($id)
	{
		$this->Subcategory_model->delete($id);
		redirect('/siteadmin/subcategories');
		exit;
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('subcategory_name', 'Category Name','required');
		$this->form_validation->set_rules('category_id', 'Parent Category','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['subcategory'] = $this->Subcategory_model->get_subcategory($id);
			}
			
			$this->load->model('Category_model');
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['products'] = $this->Subcategory_model->get_products($id);
			$data['existing'] = $this->Subcategory_model->get_assigned($id);				
			$data['categories'] = $this->Category_model->get_categories();				
			$data['action'] = 'Update';
			$this->load->view('admin/subcategory-form',$data);
		}
		else
		{
			$this->Subcategory_model->update($this->input->post());
			redirect('/siteadmin/subcategories');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('subcategory_name', 'Sub Category Name','required');
		$this->form_validation->set_rules('category_id', 'Category Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$this->load->model('Category_model');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['products'] = $this->Subcategory_model->get_products();
			$data['existing'] = array();
			$data['action'] = 'Create';
			$data['categories'] = $this->Category_model->get_categories();
			$this->load->view('admin/subcategory-form',$data);
		}
		else
		{
			$this->Subcategory_model->create($this->input->post());
			redirect('/siteadmin/subcategories');
			exit;
		}
	}
	
	
	
	
}
