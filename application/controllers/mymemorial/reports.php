<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		if (!$this->session->userdata('affiliate_login')) { redirect(base_url().'/mymemorial/sessions/login'); }
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->model('Report_model');
	}
	
	
	public function index()
	{	
	
		$data['fhomes'] = $this->Report_model->get_funeral_homes_list();
		
		if($_POST){
			$newspaper = $this->input->post('newspaper');
			$funeral_home = $this->input->post('funeral_home'); 
			if($funeral_home==''){
				$query = '';
			}else{
				$query = ' AND dd.location_id='.$funeral_home;
			}
			
			if($newspaper==''){
				$query .= '';
			}else{
				$query .= ' AND o.cobrand="'.$newspaper.'"';
			}
			
			$date1 = $this->input->post('datepicker1'); 
			$date1 = date("Y-m-d", strtotime($date1));
			$data['de1'] = $date1;
			
			$date2 = $this->input->post('datepicker2');
			$date2 = date("Y-m-d", strtotime($date2));
			$data['de2'] = $date2;
			
			$report_type = $this->input->post('report_type');
			
			$data['report_type'] = $report_type;
			$data['funeral_home'] = $funeral_home;
			
			
			$data['newspaper2'] = $newspaper;
			
			if($report_type==2){
			
				$data['orders'] = $this->Report_model->ordersreport_dignity($this->session->userdata('affiliate_id'),$date1,$date2,$query);
				$this->load->view('mymemorial/report-sales',$data);
				
			}else{
			
				$data['orders'] = $this->Report_model->cancelsreport_dignity($this->session->userdata('affiliate_id'),$date1,$date2,$query);
				$this->load->view('mymemorial/report-cancels',$data);
			
			}
			
			
			
		/*
		$newspaper = $this->input->post('newspaper');
		$Monthly_sel = $this->input->post('Monthly_sel');
		$month_year = $this->input->post('month-year');
		$Yearly_sel = $this->input->post('Yearly_sel');
		$date1 = date('Y-m-d', strtotime($date1));
		$date2 = date('Y-m-d', strtotime($date2));
		$data['de1'] = $date1;
		$data['de2'] = $date2;
		$data['newspaper'] = $newspaper;
		$data['Monthly_sel']=$Monthly_sel;
		$data['month_year']=$month_year;
		$data['Yearly_sel']=$Yearly_sel;
		*/
		
		
					
		/*
			switch($_POST['report_type'])
			{
				case 'sales' :
					if($newspaper!=''){
						$data['orders'] = $this->Report_model->reportSales2($this->session->userdata('affiliate_id'),$date1, $date2, $newspaper);
					}else{
					$data['orders'] = $this->Report_model->reportSales($this->session->userdata('affiliate_id'),$date1, $date2);
					}	
					$this->load->view('mymemorial/report-sales',$data);
					
					break;
				case 'product' :
					$data['products'] = $this->Report_model->reportProducts($this->session->userdata('affiliate_id'),$date1, $date2);					
					$this->load->view('mymemorial/report-products',$data);
					break;
			   case 'orderby' :
					$data['orderby'] = $this->Report_model->reportOrderBy($this->session->userdata('affiliate_id'),$date1, $date2);	
					$this->load->view('mymemorial/report-orderby',$data);
					break;	
					
				case 'customer' :
					$data['customers'] = $this->Report_model->reportCustomers($this->session->userdata('affiliate_id'),$this->input->post());					
					$this->load->view('report-customers',$data);
					break;
					
				
					
					
				case 'occassion' :
					$data['occasions'] = $this->Report_model->reportOccasions($this->session->userdata('affiliate_id'),$this->input->post());					
					$this->load->view('mymemorial/report-occassion',$data);
					break;
			
				case 'yearly' :
					$data['yearly'] = $this->Report_model->reportYearly($this->session->userdata('affiliate_id'),$Yearly_sel);					
					$this->load->view('mymemorial/report-yearly',$data);
					break;
					
				case 'monthly' :
					$data['monthly'] = $this->Report_model->reportMonthly($this->session->userdata('affiliate_id'),$Monthly_sel,$month_year);					
					$this->load->view('mymemorial/report-monthly',$data);
					break;
					
				case 'daily' :
					$data['orders'] = $this->Report_model->reportDaily($this->session->userdata('affiliate_id'),$this->input->post());					
					$this->load->view('mymemorial/report-daily',$data);
					break;
				default :
					die(print_r($_POST));
					break;
			}
			
		
			*/
			
		}
		else
		{
			
			$this->load->view('mymemorial/reports',$data);
		}
		
	}
	
		
	 function toExcel()
		{
		$date1= $_REQUEST['d1'];
		$date2= $_REQUEST['d2'];
		$newspaper= $_REQUEST['newspaper'];
		$data['de1'] = $date1;
		$data['de2'] = $date2;
		$data['newspaper'] = $newspaper;
			if($_REQUEST['query']=='sale')
			{
				if($newspaper!=''){
						$data['orders'] = $this->Report_model->reportSales2($this->session->userdata('affiliate_id'),$date1, $date2, $newspaper);
					}else{
						$data['orders'] = $this->Report_model->reportSales($this->session->userdata('affiliate_id'),$date1, $date2);
					}
			//$data['orders'] = $this->Report_model->reportSales($this->session->userdata('affiliate_id'),$date1, $date2);
			$this->load->view('mymemorial/export-sales',$data);
				
			}
				
		}
		
	  
			
			
			
		
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */