<?php

class Login extends CI_Controller {
	
	function Login() 
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	function index()
	{
		
		$this->form_validation->set_rules('uname', 'Username','required');
		$this->form_validation->set_rules('pword', 'Password','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/login');			
		}
		else
		{
			$this->load->model('Admin_model');
			
			if($this->Admin_model->login($this->input->post()))
			{
				$this->session->set_userdata('admin_authorized',TRUE);
				redirect('siteadmin/'.$this->session->flashdata('prevurl'));
				exit;				
			}	
			else
			{
				$data['error'] = 'Invalid Login...';
				$this->load->view('admin/login',$data);					
			}		
		}
		
	}
	
}
