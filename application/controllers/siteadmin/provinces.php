<?php

class Provinces extends CI_Controller{

public $province_id;
public $country_id;
public $province_name;

	function Provinces()
	{
		
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('provinces'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Province_model');
		$this->load->model('Country_model');
	}
	
	function index()
	{


		$data['provinces']=$this->Province_model->get_provinces();
		$this->load->view('admin/provinces',$data);
		
	}
	
	function edit($id)
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_name', 'Province Name', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{			
			if(!$_POST)
			{
				$data['province'] = $this->Province_model->get_province($id);
			}
			else 
			{
				$data['province'] = (object) $_POST;
			}
			
			$data['action'] = 'Update';
			
			$data['countries'] = $this->Country_model->get_countries();	
			
			$this->load->view('admin/province-form',$data);					
		}
		else
		{
			$this->Province_model->update($_POST);
			redirect('/siteadmin/provinces');
		}	
	
	}
	
	function delete($id)
	{
		$this->Province_model->delete($id);
		redirect('/siteadmin/provinces');
	}
	
	function create()
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_name', 'Province Name', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['action'] = 'Create';
		$data['province'] = $this;
		$data['countries'] = $this->Country_model->get_countries();		
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/province-form',$data);					
		}
		else
		{
			$this->Province_model->create($_POST);
			redirect('/siteadmin/provinces');
		}
	
	}
	
	
}
