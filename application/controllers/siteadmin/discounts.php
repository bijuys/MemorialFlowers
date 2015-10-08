<?php

class Discounts extends CI_Controller {
	
	function Discounts()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		
		if(!accessGrant('discounts'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Discounts_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['discounts']=$this->Discounts_model->get_discounts();
		$this->load->view('admin/discounts',$data);
	}
	
	function delete($id)
	{
		$this->Discounts_model->delete($id);
		redirect('/siteadmin/discounts');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('discount_name', 'Discount Name','required');
		$this->form_validation->set_rules('discount_value', 'Discount Value','required');
		$this->form_validation->set_rules('discount_type', 'Discount Type','required');
		$this->form_validation->set_rules('discount_value_type', 'Discount Value Type','required');
		$this->form_validation->set_rules('discount_limit', 'Discount Limit','required');
		$this->form_validation->set_rules('day', 'Epiry Date','required');
		$this->form_validation->set_rules('month', 'Epiry Date','required');
		$this->form_validation->set_rules('year', 'Epiry Date','required');
		$this->form_validation->set_rules('discount_availibility', 'Availibility','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Update';
			if(!$_POST)
			{
				$discount = $this->Discounts_model->get_discount($id);
				$data['discount'] = $discount;
				$expiry = $discount->discount_expiry;
				$start = $discount->discount_start;
				list($data['year'],$data['month'],$data['day']) = explode('-',$expiry);
				list($data['syear'],$data['smonth'],$data['sday']) = explode('-',$start);
			}
			
			$this->load->view('admin/discount-form',$data);
		}
		else
		{
			$this->Discounts_model->update($this->input->post());
			redirect('/siteadmin/discounts');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('discount_name', 'Discount Name','required');
		$this->form_validation->set_rules('discount_value', 'Discount Value','required');
		$this->form_validation->set_rules('discount_type', 'Discount Type','required');
		$this->form_validation->set_rules('discount_value_type', 'Discount Value Type','required');
		$this->form_validation->set_rules('discount_limit', 'Discount Limit','required');
		$this->form_validation->set_rules('day', 'Epiry Date','required');
		$this->form_validation->set_rules('month', 'Epiry Date','required');
		$this->form_validation->set_rules('year', 'Epiry Date','required');
		$this->form_validation->set_rules('discount_availibility', 'Availibility','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/discount-form',$data);
		}
		else
		{
			$this->Discounts_model->create($this->input->post());
			redirect('/siteadmin/discounts');
			exit;
		}
	}
	
	
}
