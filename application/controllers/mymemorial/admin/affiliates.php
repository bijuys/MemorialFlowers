<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Affiliates extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loggedin')) { redirect(base_url().'admin/sessions/login'); }
		$this->load->model('Affiliate_model');

	}
	
	public function index()
	{		
		$data['affiliates'] = $this->Affiliate_model->getAffiliates($this->input->post());
		$this->load->view('admin/affiliates',$data);
	}
	
	public function create()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('affiliatename', 'Affiliate Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Memorial_model');
			$data['templates'] = $this->Memorial_model->getTemplates();
			$data['countries'] = $this->Memorial_model->getCountries();
			$data['provinces'] = $this->Memorial_model->getProvinces();
			$data['action'] = 'Create';
			$this->load->view('admin/affiliate-form',$data);
		}
		else
		{
			$this->Affiliate_model->create($this->input->post(NULL,TRUE),'');
			redirect(base_url().'admin/affiliates');
			exit;
		}

	}
	
	public function edit($id)
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('affiliatename', 'Affiliate Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Memorial_model');
			$data['templates'] = $this->Memorial_model->getTemplates();
			$data['countries'] = $this->Memorial_model->getCountries();
			$data['provinces'] = $this->Memorial_model->getProvinces();
			
			if(!$_POST)
			{
				$data['affiliate'] = $this->Affiliate_model->getAffiliate($id);
			}
			
			$data['action'] = 'Update';
			$this->load->view('admin/affiliate-form',$data);
		}
		else
		{
			$this->Affiliate_model->create($this->input->post(NULL,TRUE),'');
			redirect(base_url().'admin/affiliates');
			exit;
		}

	}
	
	
	public function delete($id)
	{
		$this->Affiliate_model->delete($id);
		redirect(base_url().'admin/affiliates');
		exit;
	}
	
	public function upgrade()
	{
		$this->Affiliate_model->upgrade($this->input->post());
		
		redirect(base_url().'admin/affiliates');
		exit;
	}	
	
}

