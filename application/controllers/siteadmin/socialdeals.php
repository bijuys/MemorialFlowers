<?php

class Socialdeals extends CI_Controller {
	
	function Socialdeals()
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
		$this->load->model('Deals_model');
		
	}
	
	function index()
	{
		$data['deals']=$this->Deals_model->get_deals();
		$this->load->view('admin/deals',$data);
	}
	
	function details($id)
	{
		$data['total1']=$this->Deals_model->get_total1($id);
		$data['total2']=$this->Deals_model->get_total2($id);
		$data['total3']=$this->Deals_model->get_total3($id);
		$data['deal']=$this->Deals_model->get_deal($id);
		$data['discount_info']=$this->Deals_model->get_coupon_deals($id);
		//$data['deal']=$this->Deals_model->get_deal($id);
		$this->load->view('admin/coupon_deals',$data);
	}
	
	function delete($id)
	{
		$this->Deals_model->delete($id);
		redirect('siteadmin/socialdeals');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('socialdeal_company', 'Social Deal Company','required');
		$this->form_validation->set_rules('socialdeal_name', 'Social Deal Name','required');
		$this->form_validation->set_rules('socialdeal_amount', 'Social Deal amount','required');
		$this->form_validation->set_rules('socialdeal_status', 'Social Media Status','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Update';
			if(!$_POST)
			{
				$deal = $this->Deals_model->get_deal($id);
				$data['deal'] = $deal;
				$starts = $deal->socialdeal_starts;
				$finish = $deal->socialdeal_finish;
				list($data['syear'],$data['smonth'],$data['sday']) = explode('-',$starts);
				list($data['year'],$data['month'],$data['day']) = explode('-',$finish);
			}
			
			$this->load->view('admin/deals-form',$data);
		}
		else
		{
			$this->Deals_model->update($this->input->post());
			redirect('siteadmin/socialdeals');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('socialdeal_company', 'Social Deal Company','required');
		$this->form_validation->set_rules('socialdeal_name', 'Social Deal Name','required');
		$this->form_validation->set_rules('socialdeal_amount', 'Social Deal amount','required');
		$this->form_validation->set_rules('socialdeal_status', 'Social Media Status','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/deals-form',$data);
		}
		else
		{
			$this->Deals_model->create($this->input->post());
			redirect('siteadmin/socialdeals');
			exit;
		}
	}
	
	
}
