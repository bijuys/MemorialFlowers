<?php

class Postalcodes extends CI_Controller{

public $postalcode_id;
public $city_id;
public $postalcode;

	function Postalcodes()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('postalcodes'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Province_model');
		$this->load->model('Country_model');
		$this->load->model('City_model');
		$this->load->model('Postalcode_model');
	}
	
	function index()
	{
		$location = $this->City_model->get_default();
		redirect('/siteadmin/postalcodes/show/'.$location->country_id.'/'.$location->province_id.'/'.$location->city_id);			
	}
	
	function show($country='',$province='',$city='')
	{
		$data['postalcodes']=$this->Postalcode_model->get_postalcodes($city);
		$data['country_id'] = $country;
		$data['province_id'] = $province;
		$data['city_id'] = $city;
		$this->load->view('admin/postalcodes',$data);
		
	}
	
	
	
	function edit($id)
	{
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_id', 'Province','required');
		$this->form_validation->set_rules('city_id', 'City ID', 'required');
		$this->form_validation->set_rules('postalcode_id','Postalcode ID','required');
		$this->form_validation->set_rules('postalcode', 'Postalcode', 'required');
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
			$data['cities'] = $this->City_model->get_cities($_POST?$_POST['province_id']:'');
			
			$this->load->view('admin/postalcode-form',$data);					
		}
		else
		{
			$this->Postalcode_model->update($_POST);
			redirect('/siteadmin/postalcodes/'.$_POST['country_id'].'/'.$_POST['province_id'].'/'.$_POST['city_id']);
		}	
	
	}
	
	function delete($id)
	{
		$this->Postalcode_model->delete($id);
		redirect('/siteadmin/postalcodes');
	}
	
	function create($country,$province,$city)
	{
		
		$this->load->helper('form');		
		$this->load->library('form_validation');
		
		$data['action'] = 'Create';

		$data['countries'] = $this->Country_model->get_countries();	
		$data['provinces'] = $this->Province_model->get_Provinces($country);	
		$data['cities'] = $this->City_model->get_cities($province);			
		$this->form_validation->set_rules('country_id', 'Country','required');
		$this->form_validation->set_rules('province_id', 'Province','required');
		$this->form_validation->set_rules('city_id', 'City', 'required');
		$this->form_validation->set_rules('postalcode', 'Postalcode', 'required');
		$this->form_validation->set_rules('button','','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/postalcode-form',$data);
					
		}
		else
		{		
			$this->Postalcode_model->create($_POST);
			redirect('/siteadmin/postalcodes/'.$_POST['country_id'].'/'.$_POST['province_id'].'/'.$_POST['city_id']);
		}
			
	}
	
	
}
