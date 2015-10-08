<?php

class Holidays extends CI_Controller {
	
	function Holidays()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('holidays'))
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
		$data['holidays']=$this->Occasion_model->get_holidays();
		$this->load->view('admin/holidays',$data);
	}
	
	function delete($id)
	{
		$this->Occasion_model->delete_holiday($id);
		redirect('/siteadmin/holidays');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		$data['this_class'] = get_class($this);
		
		$this->form_validation->set_rules('occasion_name', 'Holiday Name','required');
		$this->form_validation->set_rules('occasion_day', 'Holiday Day','required');
		$this->form_validation->set_rules('occasion_month', 'Holiday Month','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['holiday'] = $this->Occasion_model->get_holiday($id);
			}
					
			$data['action'] = 'Update';
			$this->load->view('admin/holiday-form',$data);
		}
		else
		{
			$this->Occasion_model->update_holiday($this->input->post());
			redirect('/siteadmin/holidays');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		$data['this_class'] = get_class($this);
		
		$this->form_validation->set_rules('occasion_name', 'Holiday Name','required');
		$this->form_validation->set_rules('occasion_day', 'Holiday Day','required');
		$this->form_validation->set_rules('occasion_month', 'Holiday Month','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/holiday-form',$data);
		}
		else
		{
			$this->Occasion_model->create_holiday($this->input->post());
			redirect('/siteadmin/holidays');
			exit;
		}
	}
	
	
	
	
}
