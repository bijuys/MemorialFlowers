<?php

class Productgroups extends CI_Controller {
	
	function Productgroups()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('productgroups'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Productgroup_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['productgroups']=$this->Productgroup_model->get_groups();
		$this->load->view('admin/productgroups',$data);
	}
	
	function landing()
	{
		$data['productgroups']=$this->Productgroup_model->get_groups();
		$this->load->view('admin/productgroups_landing',$data);
	}
	
	function delete($id)
	{
		$this->Productgroup_model->delete($id);
		redirect('/siteadmin/productgroups');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('productgroup_name', 'Product Group Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['productgroup'] = $this->Productgroup_model->get_group($id);
			}
			$this->load->model('Productgroup_model');
			$data['this_class'] = get_class($this);
			$data['products'] = $this->Productgroup_model->get_products($id);
			$data['pages'] = $this->Pages_model->get_pages();
                        $data['action'] = 'Update';
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$this->load->view('admin/productgroup-form',$data);
		}
		else
		{
			$this->Productgroup_model->update($this->input->post());
			redirect('/siteadmin/productgroups');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('productgroup_name', 'Product Group Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['this_class'] = get_class($this);
			$data['products'] = $this->Productgroup_model->get_unallocatedproducts();
			$data['pages'] = $this->Pages_model->get_pages();
                        $data['action'] = 'Create';
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$this->load->view('admin/productgroup-form',$data);
		}
		else
		{
			$this->Productgroup_model->create($this->input->post());
			redirect('/siteadmin/productgroups');
			exit;
		}
	}
	
	
}
