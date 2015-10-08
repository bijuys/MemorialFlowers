<?php

class Cities extends CI_Controller{

public $city_id;
public $province_id;
public $city_name;
public $country_id;

	function Cities()
	{
		parent::__construct();
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('cities'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Province_model');
		$this->load->model('Country_model');
		$this->load->model('City_model');
	}
	
	function index()
	{


		$data['cities']=$this->City_model->get_cities();
		$this->load->view('admin/cities',$data);
		
	}
	
	function edit($id)
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_id', 'Province','required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('city_id', 'City ID', 'required');
		$this->form_validation->set_rules('button','','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
					
			if(!$_POST)
			{
				$data['city'] = $this->City_model->get_city($id);
			}
			
			$data['action'] = 'Update';
			
			$data['countries'] = $this->Country_model->get_countries();	
			$data['provinces'] = $this->Province_model->get_provinces($_POST?$_POST['country_id']:'');	
			
			$this->load->view('admin/city-form',$data);					
		}
		else
		{
			$this->City_model->update($_POST);
			redirect('/siteadmin/cities');
		}	
	
	}
	
	function delete($id)
	{
		$this->City_model->delete($id);
		redirect('/siteadmin/cities');
	}
	
	function create()
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		
		$data['action'] = 'Create';

		$data['countries'] = $this->Country_model->get_countries();	
		$data['provinces'] = $this->Province_model->get_Provinces($_POST?$_POST['country_id']:'');	
		
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_id', 'Province','required');
		$this->form_validation->set_rules('city_name', 'City Name', 'required');
		$this->form_validation->set_rules('button','','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/city-form',$data);					
		}
		else
		{		
			$this->City_model->create($_POST);
			redirect('/siteadmin/cities');
		}
			
	}
	
	
}
