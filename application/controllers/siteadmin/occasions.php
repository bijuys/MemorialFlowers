<?php

class Occasions extends CI_Controller {
	
	function Occasions()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('occasions'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Occasion_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['occasions']=$this->Occasion_model->get_occasions();
		$this->load->view('admin/occasions',$data);
	}
	
	function delete($id)
	{
		$this->Occasion_model->delete($id);
		redirect('/siteadmin/occasions');
		exit;
	}

	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('occasion_name', 'Occasion Name','required');
		$this->form_validation->set_rules('occasion_day', 'Occasion Day','required');
		$this->form_validation->set_rules('occasion_month', 'Occasion Month','required');
		$this->form_validation->set_rules('occasion_status', 'Occasion Status','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['occasions'] = $this->Occasion_model->get_occasion($id);
			}
				
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['products'] = $this->Occasion_model->get_products($id);
			$data['existing'] = $this->Occasion_model->get_assigned($id);
			
			$data['action'] = 'Update';
			$this->load->view('admin/occasion-form',$data);
		}
		else
		{
			$this->Occasion_model->update($this->input->post());
			redirect('/siteadmin/occasions');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('occasion_name', 'Occasion Name','required');
		$this->form_validation->set_rules('occasion_day', 'Occasion Day','required');
		$this->form_validation->set_rules('occasion_month', 'Occasion Month','required');
		$this->form_validation->set_rules('occasion_status', 'Occasion Status','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['products'] = $this->Occasion_model->get_products();
			$data['existing'] = array();
			$data['action'] = 'Create';
			$this->load->view('admin/occasion-form',$data);
		}
		else
		{
			$this->Occasion_model->create($this->input->post());
			redirect('/siteadmin/occasions');
			exit;
		}
	}
	
	
	
	
}
