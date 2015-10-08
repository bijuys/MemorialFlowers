<?php

class Deliverycharges extends CI_Controller {
	
	function Deliverycharges()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('deliverycharges'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		//$this->load->model('Deliverycharge_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['deliverycharge']=$this->Deliverycharge_model->get_deliverycharges();
		$this->load->view('admin/deliverycharges',$data);
	}
	
	function delete($id)
	{
		$this->Deliverycharge_model->delete($id);
		redirect('/siteadmin/deliverycharges');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('deliverycharge_name', 'Delivery Charge Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['group'] = $this->Deliverycharge_model->get_group($id);
			}
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Update';
			$this->load->view('admin/deliverycharge-form',$data);
		}
		else
		{
			$this->Deliverycharge_model->update($this->input->post());
			redirect('/siteadmin/deliverycharges');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('charge_name', 'Title','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['this_class'] = get_class($this);
			$data['action'] = 'Create';
			$this->load->view('admin/deliverycharge-form',$data);
		}
		else
		{
			$this->Deliverycharge_model->create($this->input->post());
			redirect('/siteadmin/deliverycharges');
			exit;
		}
	}
	
	
}
