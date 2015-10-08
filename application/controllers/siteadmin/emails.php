<?php

class Emails Extends CI_Controller{
	
	function Emails() 
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		if(!accessGrant('emails'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->model('Email_model');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['emails']=$this->Email_model->get_emails();
		$this->load->view('admin/emails',$data);		
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Update';
		$data['this_class'] = get_class($this);	
		
		$this->form_validation->set_rules('message_title', 'Email Subject','required');
		$this->form_validation->set_rules('message_text', 'Email Body','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['policy'] = $this->Email_model->get_email($id);
			}
					
			$this->load->view('admin/email-form',$data);
		}
		else
		{
			$this->Email_model->update($this->input->post());
			redirect('/siteadmin/emails');
			exit;
		}		
	}
	
	function create()
	{
		$data = array();
		$data['action'] = 'Create';
		$data['this_class'] = get_class($this);		
					
		$this->form_validation->set_rules('message_title', 'Email Subject','required');
		$this->form_validation->set_rules('message_text', 'Email Body','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/email-form',$data);
		}
		else
		{
			$this->Email_model->create($this->input->post());
			redirect('/siteadmin/emails');
			exit;
		}		
	}
	
	
	function delete($id)
	{
		$this->Email_model->delete($id);
		redirect('/siteadmin/emails');
		exit;
	}
	
	
	
}
