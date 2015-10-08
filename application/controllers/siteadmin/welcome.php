<?php

class Welcome extends CI_Controller {
	function Welcome() 
	{
				
		parent::__construct();
		$this->load->library('session');
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}		
		
	}
	
	function index()
	{
		$this->load->helper('url'); 
		$this->load->view('admin/dashboard');
	}
	
	function logout()
	{
			$this->session->unset_userdata('permissions');
			$this->session->unset_userdata('admin_authorized');
			redirect('/');
			exit;
	}
	
}
