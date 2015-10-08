<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loggedin')) { redirect(base_url().'admin/sessions/login'); }
		$this->load->model('Report_model');
	}
	
	public function index()
	{
		if($_POST)
		{
			switch($_POST['report_type'])
			{
				case 'product':
					{
						$data['products'] = $this->Report_model->bGetProducts($this->input->post());
						$this->load->view('admin/reports-products',$data);
						break;
					}
				case 'sales':
					{
						$data['invoices'] = $this->Report_model->bGetSales($this->input->post());
						$this->load->view('admin/reports-sales',$data);
						break;
					}
				case 'customer':
					{
						$data['customers'] = $this->Report_model->bGetCustomerSales($this->input->post());
						$this->load->view('admin/reports-customers',$data);
						break;
					}
				case 'affiliate':
					{
						$data['affiliates'] = $this->Report_model->bGetAffiliateSales($this->input->post());
						$this->load->view('admin/reports-affiliates',$data);
						break;
					}
				case 'occassion':
					{
						$data['occassions'] = $this->Report_model->bGetOccassionSales($this->input->post());
						$this->load->view('admin/reports-occassions',$data);
						break;
					}
				case 'province':
					{
						$data['provinces'] = $this->Report_model->bGetProvinceSales($this->input->post());
						$this->load->view('admin/reports-provinces',$data);
						break;
					}
				case 'city':
					{
						$data['cities'] = $this->Report_model->bGetCitySales($this->input->post());
						$this->load->view('admin/reports-cities',$data);
						break;
					}
				case 'daily':
					{
						$data['daily'] = $this->Report_model->bGetDailySales($this->input->post());
						$this->load->view('admin/reports-daily',$data);
						break;
					}
				case 'monthly':
					{
						$data['monthly'] = $this->Report_model->bGetMonthlySales($this->input->post());
						$this->load->view('admin/reports-monthly',$data);
						break;
					}
				case 'yearly':
					{
						$data['yearly'] = $this->Report_model->bGetYearlySales($this->input->post());
						$this->load->view('admin/reports-yearly',$data);
						break;
					}
				default :
					{
						die(print_r($_POST));
					}
			}
			
		}
		else
		{
			$this->load->view('admin/reports');
		}
		
	}
	
	
	public function sales()
	{
		$data['invoices'] = $this->Report_model->bGetSales(array('start_year'=>'2010',
										  'start_month'=>'1',
										  'start_day'=>'1',
										  'end_year'=>'2012',
										  'end_month'=>'12',
										  'end_day'=>'1'));
		$this->load->view('admin/reports-sales',$data);
		
	}
	
	public function products()
	{
		$data['products'] = $this->Report_model->bGetProducts(array('start_year'=>'2010',
										  'start_month'=>'1',
										  'start_day'=>'1',
										  'end_year'=>'2012',
										  'end_month'=>'12',
										  'end_day'=>'1'));
		$this->load->view('admin/reports-products',$data);
		
	}
	
	public function affiliates()
	{
		$data['affiliates'] = $this->Report_model->bGetAffiliateSales(array('start_year'=>'2010',
										  'start_month'=>'1',
										  'start_day'=>'1',
										  'end_year'=>'2012',
										  'end_month'=>'12',
										  'end_day'=>'1'));
		$this->load->view('admin/reports-affiliates',$data);
		
	}
	
	public function provinces()
	{
		$data['provinces'] = $this->Report_model->bGetProvinceSales(array('start_year'=>'2010',
										  'start_month'=>'1',
										  'start_day'=>'1',
										  'end_year'=>'2012',
										  'end_month'=>'12',
										  'end_day'=>'1'));
		$this->load->view('admin/reports-provinces',$data);
		
	}
	
	public function cities()
	{
		$data['cities'] = $this->Report_model->bGetCitySales(array('start_year'=>'2010',
										  'start_month'=>'1',
										  'start_day'=>'1',
										  'end_year'=>'2012',
										  'end_month'=>'12',
										  'end_day'=>'1'));
		$this->load->view('admin/reports-cities',$data);
		
	}
	
	public function postalcodes()
	{
		redirect(base_url().'admin/reports');
		
	}
	
	

	
}

