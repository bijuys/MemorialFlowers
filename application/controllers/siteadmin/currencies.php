<?php

class Currencies extends CI_Controller {
	
	function Currencies()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('currencies'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Currency_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['currencies']=$this->Currency_model->get_currencies();
		$this->load->view('admin/currencies',$data);
	}
	
	function delete($id)
	{
		$this->Currency_model->delete($id);
		redirect('/siteadmin/currencies');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('currency_id', 'Currency ID, eg: USD','required');
		$this->form_validation->set_rules('currency_name', 'Please enter a Name or Description','required');
		$this->form_validation->set_rules('currency_symbol', 'Currency Symbol','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Update';
			if(!$_POST)
			{
				$currency = $this->Currency_model->get_currency($id);
				$data['currency'] = $currency;
			}
			
			$this->load->view('admin/currency-form',$data);
		}
		else
		{
			$this->Currency_model->update($this->input->post());
			redirect('/siteadmin/currencies');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('currency_id', 'Currency ID, eg: USD','required');
		$this->form_validation->set_rules('currency_name', 'Please enter a Name or Description','required');
		$this->form_validation->set_rules('currency_symbol', 'Currency Symbol','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/currency-form',$data);
		}
		else
		{
			$this->Currency_model->create($this->input->post());
			redirect('/siteadmin/currencies');
			exit;
		}
	}
	
	
}
