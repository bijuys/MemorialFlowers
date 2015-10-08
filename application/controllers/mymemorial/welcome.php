<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	}
	
	
	public function index()
	{	
		
		$year=date("Y");
	
		$this->load->model('Affiliate_model');
		
		$data['recent_orders'] = $this->Affiliate_model->get_recent_orders($this->session->userdata('affiliate_id'),5);
		$data['recent_items'] = $this->Affiliate_model->get_recent_items($this->session->userdata('affiliate_id'),3);
		$data['affiliate'] = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));
		$sales = $this->Affiliate_model->get_total_sales($this->session->userdata('affiliate_id'));
		$data['monthly_sales'] = $this->Affiliate_model->get_monthly_sales($this->session->userdata('affiliate_id'),6);
		$data['ventas'] = $this->Affiliate_model->get_this_year_sales($year,$this->session->userdata('affiliate_id'));
		
		$data['sales'] = $sales->sales;
		$data['total'] = $sales->total;
		
		$this->load->view('mymemorial/dashboard',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */