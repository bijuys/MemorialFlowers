<?php

class Admin extends CI_Controller {

	function Admin()
	{
				
		parent::__construct();

		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
		$this->load->Model('Banner_model');
		$this->load->Model('Affiliate_model');
		
	}

	function index()
	{

		echo 'Oscar';
	
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */