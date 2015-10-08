<?php

class Countries extends CI_Controller{

public $short_code;
public $country_id;
public $country_name;

	function Countries()
	{
		parent::__construct();
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('countries'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Country_model');
	}
	
	function index()
	{


		$data['countries']=$this->Country_model->get_countries();
		$this->load->view('admin/countries',$data);
		
	}
	
	function edit($id)
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('short_code', 'Short Code','required');
		$this->form_validation->set_rules('country_name', 'Country Name', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{			
			if(!$_POST)
			{
				$data['country'] = $this->Country_model->get_country($id);
			}
			else 
			{
				$data['country'] = (object) $_POST;
			}
			
			$data['action'] = 'Update';
			
			$this->load->view('admin/countries-new',$data);					
		}
		else
		{
			$this->Country_model->update($_POST);
			redirect('/siteadmin/countries');
		}	
	
	}
	
	function delete($id)
	{
		$this->Occasion_model->delete($id);
		redirect('/siteadmin/occasions');
	}
	
	function create()
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('short_code', 'Short Code','required');
		$this->form_validation->set_rules('country_name', 'Country Name', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['action'] = 'Create';
		$data['country'] = $this;
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/countries-new',$data);					
		}
		else
		{
			$this->Country_model->create($_POST);
			redirect('/siteadmin/countries');
			exit;
		}
	
	}
	
	
}
