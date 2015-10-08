<?php

class Policies Extends Controller{
	
	function Policies() 
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('policies'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->model('Policies_model');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['policies']=$this->Policies_model->get_policies();
		//die(print_r($data));
		$this->load->view('admin/policies',$data);		
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Update';
		$data['this_class'] = get_class($this);	
		
		$this->form_validation->set_rules('message_title', 'Policy Title','required');
		$this->form_validation->set_rules('message_text', 'Policy Text','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['policy'] = $this->Policies_model->get_policy($id);
			}
					
			$this->load->view('admin/policy-form',$data);
		}
		else
		{
			$this->Policies_model->update($this->input->post());
			redirect('/siteadmin/policies');
			exit;
		}		
	}
	
	function create()
	{
		$data = array();
		$data['action'] = 'Create';
		$data['this_class'] = get_class($this);		
					
		$this->form_validation->set_rules('message_title', 'Policy Title','required');
		$this->form_validation->set_rules('message_text', 'Policy Text','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/policy-form',$data);
		}
		else
		{
			$this->Policies_model->create($this->input->post());
			redirect('/siteadmin/policies');
			exit;
		}		
	}
	
	
	function delete($id)
	{
		$this->Policies_model->delete($id);
		redirect('/siteadmin/policies');
		exit;
	}
	
	
	
}
