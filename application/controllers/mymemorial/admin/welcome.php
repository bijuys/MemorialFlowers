<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loggedin')) { redirect(base_url().'admin/sessions/login'); }
	}

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
	public function index()
	{
		$this->load->model('Affiliate_model');
		$this->load->model('Customer_model');
		$this->load->model('Product_model');
		$this->load->model('Order_model');
		
		$data['customers'] = $this->Customer_model->getRecent(2);
		$data['affiliates'] = $this->Affiliate_model->getRecent(2);
		$data['products'] = $this->Product_model->getRecent(2);
		$data['orders'] = $this->Order_model->getPending(10);
		$data['page'] = 'Home';
		$this->load->view('mymemorial/admin/home',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */