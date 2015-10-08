<?php

class Translate extends CI_Controller {
	function Welcome() 
	{
		parent::__construct();	
	}

	function index() 
	{
		//$this->load->library('translator');

		$string = '';

		if(isset($_POST['text']) && !empty($_POST['text']))
		{
			$string = Translate($_POST['text']);
		}


		echo $string;
	}

	public function set($param)
	{
		$this->session->set_userdata('language',strtolower($param));
		$this->session->set_userdata('langshort',strtoupper(substr($param,0,2)));
		$current_url = $_SERVER['HTTP_REFERER'];
		redirect($current_url, 'location');
	}
	
	public function show()
	{
		echo $this->session->userdata('language');
	}
	

	
}
