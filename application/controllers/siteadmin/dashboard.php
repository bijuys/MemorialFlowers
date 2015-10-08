<?php

class Dashboard extends CI_Controller {
	function Dashboard() 
	{
		parent::__construct();
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}	
	}
	
	function index()
	{
		echo 'You are at Administration Area!';
	}
}
