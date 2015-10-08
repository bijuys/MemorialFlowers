<?php

class Robots extends CI_Controller{

	function index()
	{
		if($_POST)
		{
			file_put_contents('robots.txt',$_POST['robots']);		
			
			$data['robots'] = $_POST['robots'];
			$this->load->view('admin/robots',$data);
		}
		else
		{
			$data['robots'] = file_get_contents('robots.txt');
			$this->load->view('admin/robots',$data);			
		}
	}
	
}
