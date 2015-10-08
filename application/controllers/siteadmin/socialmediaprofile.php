<?php

class Socialmediaprofile extends CI_Controller {
	
	function Socialmediaprofile()
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
	}
	
	function index()
	{
		$this->load->view('admin/socialmediaprofile');
		  			
		$this->load->database();
		$this->load->model('socialmedia_model'); 
		
    $socialtypename = $this->input->post('socialname');
	$socialcontactpersion = $this->input->post('socialcontactperson');
	$socialcontactno = $this->input->post('socialcontactno');	
    $description = $this->input->post('socialdescription');
	$socialcity = $this->input->post('socialcity');
	$socialstate = $this->input->post('socialstate');
	$socialemail = $this->input->post('socialemail');
	
	
	
           
    $data = array(
       'socialtypename' => $this->input->post('socialname'),
       'socialcontactperson' => $this->input->post('socialcontactperson'),
	   'socialcontactno' => $this->input->post('socialcontactno'),
	   'description' => $this->input->post('socialdescription'),
	   'socialcity' => $this->input->post('socialcity'),
	   'socialstate' => $this->input->post('socialstate'),
	   'socialemail' => $this->input->post('socialemail'),
	   
    );
		if($this->input->post('socialname'))
		{
		$this->socialmedia_model->add_socialname1($data);
		}
		
	
	}
	function add()
	{
	
	echo "did you came before";
	
	
	
	
	
	}
	}
