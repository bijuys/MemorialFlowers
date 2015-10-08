<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('affiliate_login')) { redirect(base_url().'mymemorial/sessions/login'); }
		/*$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->model('Product_model');
		$this->load->model('Order_model');
		$this->load->model('Location_model');
		$this->load->model('Memorial_model');
		$this->load->library('cart'); */
	}
	

	
	
	public function index()
	{
		$this->load->model('Affiliate_model');
		$this->load->model('Province_model');
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_business', 'Business Name', 'required');
		$this->form_validation->set_rules('user_firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('user_lastname', 'Lastname', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|email');
	
		$this->form_validation->set_rules('user_postalcode', 'Postalcode', 'required');
		$this->form_validation->set_rules('user_city', 'City', 'required');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['settings'] = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));
			$data['provinces'] = $this->Province_model->get_provinces();
			
			$this->load->view('mymemorial/myshop',$data);
		}
		else
		{
			if($this->Affiliate_model->updateMyInfo($this->input->post()))
			{
				redirect('/mymemorial/settings');
			}
			
		}
		
		/*
		
		$data['countries'] = $this->Location_model->getCountries();
		if($_POST)
			$data['settings'] = (object) $_POST;
		else
			$data['settings'] = $this->Memorial_model->getSettings($this->session->userdata('affiliate_id'));
			
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('business_name', 'Business Name', 'required');
		$this->form_validation->set_rules('affiliatename', 'Affiliate Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|email');
		$this->form_validation->set_rules('postalcode', 'Postalcode', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myshop',$data);
		}
		else
		{
			if($this->Memorial_model->updateSettings($this->input->post(NULL,TRUE),$this->session->userdata('affiliate_id')))
			{
				$this->session->set_flashdata('message','<div class="success">Updated your settings!</div>');
			}
			
			redirect(base_url().'settings');
			exit;
			
		}
		
		*/
		
		
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */