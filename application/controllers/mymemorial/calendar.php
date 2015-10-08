<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

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
		
		$this->load->model('Order_model');
	}
	
	
	public function index()
	{
		
		
		/*$data['recent_orders'] = $this->Affiliate_model->get_recent_orders($this->session->userdata('affiliate_id'),3);
		$data['recent_items'] = $this->Affiliate_model->get_recent_items($this->session->userdata('affiliate_id'),3);
		$data['affiliate'] = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));
		$sales = $this->Affiliate_model->get_total_sales($this->session->userdata('affiliate_id'));
		$data['monthly_sales'] = $this->Affiliate_model->get_monthly_sales($this->session->userdata('affiliate_id'),6);
		
		$data['sales'] = $sales->sales;*/
		$data['totals_orders'] = $this->Order_model->get_totals_calendar_orders($this->session->userdata('affiliate_id'));
		//echo 'oscar';
		$this->load->view('mymemorial/calendar',$data);
	}
	
	public function delivery($id)
	{
		$pieces = explode("_", $id);
		$dat = $pieces[0];
		$tim = $pieces[1];
			$tim = str_replace("-",":",$tim);
			$tim = $tim.':00';
		$fir = $pieces[2];
		$las = $pieces[3];
		
		$data['totals_orders'] = $this->Order_model->get_totals_calendar_orders2($this->session->userdata('affiliate_id'),$dat,$tim,$fir,$las);
		//echo 'oscar';
		$this->load->view('mymemorial/orders-calendar',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */