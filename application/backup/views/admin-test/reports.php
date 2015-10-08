<?php

class Reports extends CI_Controller{
    
    function Reports() {
        parent::__construct();
        
        if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('reports'))
		{
			redirect('/siteadmin');
			exit;
		}
		
        $this->load->helper('url');
	$this->load->model('Report_model');
	$this->load->model('Customer_model');
	$this->load->model('Affiliate_model');
	$this->load->model('Company_model');
	
    }
    
    function excel()
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('test worksheet');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 
	$filename='just_some_random_name.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    function exportExcel($title='',$headers=array(),$fields=array(),$rows=array())
    {
	$abc->test ='just for a test';
	$check = 'test';
	
	echo $abc->$check;
    }
    
    function refund_report()
    {
	
		$post = $_POST;
		
		$data['title'] = 'Refund Report';
                $total = $this->Report_model->get_RefundReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_RefundReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-refund-report',$data);
		else
		{
		    $this->refund_excel($data);
		}
    }
    
    function product_report()
    {
	
		$post = $_POST;
		
		$data['title'] = 'Product Report';
                $total = $this->Report_model->get_ProductReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_ProductReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-product-report',$data);
		else
		{
		    $this->products_excel($data);
		}
    }
    
    function dailysales_report()
    {
	
		$post = $_POST;
		
		$data['title'] = 'Daily Sales';
                $total = $this->Report_model->get_DailyReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_DailyReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-daily-report',$data);
		else
		{
		    $this->dailysales_excel($data);
		}
    }
    

    
    function orders_report()
    {
		
		$data['title'] = 'Order Report';
                $total = $this->Report_model->get_SalesReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_SalesReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-sales-report',$data);
		else
		{
		    $this->orders_excel($data);
		}

		
		
    }
    
    function coupons_report()
    {
	
		$post = $_POST;
		$data['title'] = 'Coupon Report';
		$total = $this->Report_model->get_CouponReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_CouponReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-coupon-report',$data);
		else
		{
		    $this->coupons_excel($data);
		}
    }
    
    function allusers_report()
    {
		$post = $_POST;
		
		$data['title'] = 'All Users Report';		
		$total = $this->Report_model->get_AllusersReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_AllusersReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-users-report',$data);
		else
		{
		    $this->allusers_excel($data);
		}
    }
    
    function search_report()
    {		
		$data['title'] = 'Search Report';		
		$total = $this->Report_model->get_SearchReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_SearchReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-search-report',$data);
		else
		{
		    $this->search_excel($data);
		}
    }
    
    
    function delivery_report()
    {		
		$data['title'] = 'Delivery Report';		
		$total = $this->Report_model->get_DeliveryReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_DeliveryReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-delivery-report',$data);
		else
		{
		    $this->delivery_excel($data);
		}
    }
    
    function multipleorders_report()
    {
	
		$post = $_POST;
		
		$data['title'] = 'Users Multiple orders Report';
		$total = $this->Report_model->get_UserOrdersReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_UserOrdersReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-usersorders-report',$data);
		else
		{
		    $this->multipleorders_excel($data);
		}
    }
    
    function newemail_report()
    {
	
		$post = $_POST;
		
		$data['title'] = 'Users Multiple orders Report';
		$total = $this->Report_model->get_UserEmailReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_UserEmailReport($this->input->post());
		
		$action = isset($_POST) && isset($_POST['submit']) ? $_POST['submit']:'';
		
		if($action != 'Export to Excel')
		    $this->load->view('admin/new-emails-report',$data);
		else
		{
		    $this->newmail_excel($data);
		}
    }
    
    
    function wizard()
    {
	if(!$_POST)		
	{
	    $this->load->view('admin/wizard');	    
	}
	else
	{
	    if($_POST['step']==1)
	    {
		if(!empty($_POST['customer']))
		{
		    $data['customers'] = $this->Customer_model->getSimilar($_POST['customer']);
		}
		if(!empty($_POST['affiliate']))
		{
		    $data['affiliates'] = $this->Affiliate_model->getSimilar($_POST['affiliate']);		
		}
		
		if(!empty($_POST['customer']) || !empty($_POST['affiliates']))
		{
		    $data['serialized'] = base64_encode(serialize($_POST));
		    $this->load->view('admin/wizard-filter',$data);
		}
		else
		{
		    $this->get($_POST);
		}
	    }
	    elseif($_POST['step']==2)
	    {
		    
		$post = unserialize(base64_decode($_POST['serialized']));
		if(isset($_POST['customer_id']))
		    $post['customer'] = $_POST['customer_id'];
		if(isset($_POST['affiliate_id']))
		    $post['affiliate'] = $_POST['affiliate_id'];
		    

		$this->get($post);
		    

	    }

	}
    }
    
    
    function repnew()
    {
	if(!$_POST)
	{
	    $this->load->view('admin/wizard2');	    
	}
	else
	{
	    if($_POST['step']==1)
	    {
		if(!empty($_POST['customer']))
		{
		    $data['customers'] = $this->Customer_model->getSimilar($_POST['customer']);
		}
		if(!empty($_POST['affiliate']))
		{
		    $data['affiliates'] = $this->Affiliate_model->getSimilar($_POST['affiliate']);		
		}
		
		if(!empty($_POST['customer']) || !empty($_POST['affiliates']))
		{
		    $data['serialized'] = base64_encode(serialize($_POST));
		    $this->load->view('admin/wizard-filter',$data);
		}
		else
		{
		    $this->get($_POST);
		}
	    }
	    elseif($_POST['step']==2)
	    {
		    
		$post = unserialize(base64_decode($_POST['serialized']));
		if(isset($_POST['customer_id']))
		    $post['customer'] = $_POST['customer_id'];
		if(isset($_POST['affiliate_id']))
		    $post['affiliate'] = $_POST['affiliate_id'];
		    

		$this->new($post);
		    

	    }

	}
    }
    

    function get($post) {
        
        $total = 0;
        $per_pg = 2000;
        $offset = 0;
	
	if(!count($post))
	{
	    $post = $_POST;
	}

        
	if(isset($post['navigate']))
        {
            if($post['navigate']=='Go')
            {
                $offset =  ($post['page']*$per_pg) - $per_pg;
            }
            elseif($post['navigate']=='Next')
            {
                $offset = $post['offset'] + $per_pg;
            }
            elseif($post['navigate']=='Previous')
            {
                $offset = $post['offset'] - $per_pg;                
            }
            
        }
        
        $total = 0;
	
	switch(strtolower($post['report_type']))
        {
            case 'sales':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Sales($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Sales($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'customer':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Customer($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Customer($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'affiliate':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Affiliate($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Affiliate($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'product':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Product($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Product($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
            case 'company':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Company($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Company($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'occasion':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Sales($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Sales($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'yearly':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Yearly($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Yearly($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'monthly':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Monthly($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Monthly($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'daily':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Daily($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Daily($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'coupon':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Coupon($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Coupon($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    
	    
            default:
            {

            }
        }
    }
        
    
    function getnew($post) {
        
        $total = 0;
        $per_pg = 2000;
        $offset = 0;
	
	if(!count($post))
	{
	    $post = $_POST;
	}
        
        
	if(isset($post['navigate']))
        {
            if($post['navigate']=='Go')
            {
                $offset =  ($post['page']*$per_pg) - $per_pg;
            }
            elseif($post['navigate']=='Next')
            {
                $offset = $post['offset'] + $per_pg;
            }
            elseif($post['navigate']=='Previous')
            {
                $offset = $post['offset'] - $per_pg;                
            }
            
        }
        
        $total = 0;
	
	switch(strtolower($post['report_type']))
        {
            case 'sales':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_SalesReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_SalesReport($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
            case 'coupon':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_CouponReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_CouponReport($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'customer':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Customer($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Customer($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'affiliate':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Affiliate($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Affiliate($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'product':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Product($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Product($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
            case 'company':
            {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Company($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Company($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'occasion':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Sales($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Sales($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'yearly':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Yearly($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Yearly($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'monthly':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Monthly($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Monthly($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'daily':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_DailyReport($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_DailyReport($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    case 'coupon':
	    {
		$data['title'] = 'Period: <strong>'.$post['start_month'].'/'.$post['start_day'].'/'.$post['start_year'].' To '.$post['end_month'].'/'.$post['end_day'].'/'.$post['end_year'].'</strong>';
                $total = $this->Report_model->get_Coupon($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Coupon($this->input->post(),$per_pg,$offset,FALSE);
                break;
	    }
	    
	    
            default:
            {

            }
        }
        
	
        $data['pages'] = floor($total / $per_pg);
        $data['offset'] = $offset;
        $data['per_pg'] = $per_pg;
	
	$data['start_year'] = $post['start_year'];
	$data['start_month'] = $post['start_month'];
	$data['start_day'] = $post['start_day'];
	$data['end_year'] = $post['end_year'];
	$data['end_month'] = $post['end_month'];
	$data['end_day'] = $post['end_day'];
        
        if($total % $per_pg)
        {
            $data['pages']++;
        }

        //$this->pagination->initialize($config);        
        //$data['pagination']=$this->pagination->create_links();
	
        $this->load->view('admin/new-'.strtolower($post['report_type']).'-report',$data);
    }
    
    function index($report='') {
	$data['this_class'] = get_class($this);
        $data['reporttype'] = ucfirst($report);
        $data['records'] = array();
        $this->load->view('admin/reports',$data);
    }
    
    function test() {
        $this->load->library('pagination');
        
        $config['base_url'] = '/siteadmin/orders/test/';
        $config['total_rows'] = '200';
        $config['per_page'] = '20';
        $config['page_query_string'] = FALSE;
        $config['uri_segment'] = 4;
        

        
        $this->pagination->initialize($config);
        
        echo $this->pagination->create_links();        
        
    }
    
    function view($report='') {
        
	if($_POST)
	{
	    
	}
        
        $total = 0;
        $per_pg = 10000;
        $offset = 0;
        
        if(isset($_POST['navigate']))
        {
            if($_POST['navigate']=='Go')
            {
                $offset =  ($_POST['page']*$per_pg) - $per_pg;
            }
            elseif($_POST['navigate']=='Next')
            {
                $offset = $_POST['offset'] + $per_pg;
            }
            elseif($_POST['navigate']=='Previous')
            {
                $offset = $_POST['offset'] - $per_pg;                
            }
            
        }
        
        $total = 0;
	
	switch($report)
        {
            case 'sales':
            {
                $total = $this->Report_model->get_Sales($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Sales($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'customer':
            {
                $total = $this->Report_model->get_Customer($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Customer($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'affiliate':
            {
                $total = $this->Report_model->get_Affiliate($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Affiliate($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'product':
            {
                $total = $this->Report_model->get_Product($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Product($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
            case 'company':
            {
                $total = $this->Report_model->get_Company($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Company($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
	    case 'coupon':
            {
                $total = $this->Report_model->get_Coupon($this->input->post(),0,999999,TRUE);
                $data['records'] = $this->Report_model->get_Coupon($this->input->post(),$per_pg,$offset,FALSE);
                break;
            }
            default:
            {

            }
        }
	
	/*
        
        $data['pages'] = floor($total / $per_pg);
        $data['offset'] = $offset;
        $data['per_pg'] = $per_pg;
        
        if($total % $per_pg)
        {
            $data['pages']++;
        }
        
	*/

        //$this->pagination->initialize($config);        
        //$data['pagination']=$this->pagination->create_links();
	
        $this->load->view('admin/'.$report.'-report',$data);
    }
    
    
    /***************************** Excel Functions *****************************************/
    
    function orders_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Sales Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Sales Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Order ID')
					->setCellValue('B2','Date')
					->setCellValue('C2','First Name')
					->setCellValue('D2','Last Name')
					->setCellValue('E2','Email')
					->setCellValue('F2','Address')
					->setCellValue('G2','City')
					->setCellValue('H2','Province')
					->setCellValue('I2','Postalcode')
					->setCellValue('J2','Subtotal')
					->setCellValue('K2','Tax')
					->setCellValue('L2','Shipping')
					->setCellValue('M2','Service')
					->setCellValue('N2','Surcharge')
					->setCellValue('O2','Total')
					->setCellValue('P2','Products')
					->setCellValue('Q2','Skus')
					->setCellValue('R2','Occasion')
					->setCellValue('S2','Channel');
					
	$count = 2;
	
	$totals = array('amount'=>0,'shipping'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,'commission'=>0,'gtotal'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		
	    
		$totals['amount'] += $row->amount;
                $totals['shipping'] += $row->shipping;
                $totals['service'] += $row->service;
                $totals['surcharge'] += $row->surcharge;
                $totals['tax'] += $row->tax;
                $totals['discount'] += $row->discount;
                $totals['coupon'] += $row->coupon;
                $totals['commission'] += $row->commission;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax;
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->invoice_id)
						->setCellValue('B'.$count,date('d-m-Y',strtotime($row->order_date)))
						->setCellValue('C'.$count,$row->firstname)
						->setCellValue('D'.$count,$row->lastname)
						->setCellValue('E'.$count,$row->email)
						->setCellValue('F'.$count,$row->address1 .' '.$row->address2)
						->setCellValue('G'.$count,$row->city)
						->setCellValue('H'.$count,$row->province)
						->setCellValue('I'.$count,$row->postalcode)
						->setCellValue('J'.$count,'$'.number_format($row->amount,2))
						->setCellValue('K'.$count,'$'.number_format($row->tax,2))
						->setCellValue('L'.$count,'$'.number_format($row->shipping,2))
						->setCellValue('M'.$count,'$'.number_format($row->service,2))
						->setCellValue('N'.$count,'$'.number_format($row->surcharge,2))
						->setCellValue('O'.$count,'$'.number_format($row->tax+$row->shipping+$row->service+$row->surcharge+$row->amount,2))
						->setCellValue('P'.$count,$row->products)
						->setCellValue('Q'.$count,$row->skus)
						->setCellValue('R'.$count,$row->occasion_name)
						->setCellValue('S'.$count,''); 
	    
	}
	
	 
	$filename='1800-SalesReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function products_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Product Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Product Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','ID')
					->setCellValue('B2','SKU')
					->setCellValue('C2','Category')
					->setCellValue('D2','Quantity')
					->setCellValue('E2','Price')
					->setCellValue('F2','Net Revenue')
					->setCellValue('G2','Gross Revenue')
					->setCellValue('H2','Product Name')
					->setCellValue('I2','Description');
					
	$count = 2;
	
	$totals = array('amount'=>0,'shipping'=>0,'quantity'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,'commission'=>0,'total'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		
	       $totals['total'] += $row->total;
                $totals['quantity'] += $row->quantity;
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->product_id)
						->setCellValue('B'.$count,$row->product_code)
						->setCellValue('C'.$count,$row->category_name)
						->setCellValue('D'.$count,$row->quantity)
						->setCellValue('E'.$count,number_format($row->product_price,2))
						->setCellValue('F'.$count,number_format($row->total,2))
						->setCellValue('G'.$count,number_format($row->total,2))
						->setCellValue('H'.$count,$row->product_name)
						->setCellValue('I'.$count,$row->product_description);
	    
	}
	
	 
	$filename='1800-ProductsReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    

    function refund_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Refund Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Refund Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Order ID')
					->setCellValue('B2','Date')
					->setCellValue('C2','First Name')
					->setCellValue('D2','Last Name')
					->setCellValue('E2','Email')
					->setCellValue('F2','Address')
					->setCellValue('G2','City')
					->setCellValue('H2','Province')
					->setCellValue('I2','Postalcode')
					->setCellValue('J2','Subtotal')
					->setCellValue('K2','Tax')
					->setCellValue('L2','Shipping')
					->setCellValue('M2','Service')
					->setCellValue('N2','Surcharge')
					->setCellValue('O2','Total')
					->setCellValue('P2','Products')
					->setCellValue('Q2','Skus')
					->setCellValue('R2','Occasion')
					->setCellValue('S2','Channel');
					
	$count = 2;
	
	$totals = array('amount'=>0,'shipping'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,'commission'=>0,'gtotal'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		
	    
		$totals['amount'] += $row->amount;
                $totals['shipping'] += $row->shipping;
                $totals['service'] += $row->service;
                $totals['surcharge'] += $row->surcharge;
                $totals['tax'] += $row->tax;
                $totals['discount'] += $row->discount;
                $totals['coupon'] += $row->coupon;
                $totals['commission'] += $row->commission;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax;
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->invoice_id)
						->setCellValue('B'.$count,date('d-m-Y',strtotime($row->order_date)))
						->setCellValue('C'.$count,$row->firstname)
						->setCellValue('D'.$count,$row->lastname)
						->setCellValue('E'.$count,$row->email)
						->setCellValue('F'.$count,$row->address1 .' '.$row->address2)
						->setCellValue('G'.$count,$row->city)
						->setCellValue('H'.$count,$row->province)
						->setCellValue('I'.$count,$row->postalcode)
						->setCellValue('J'.$count,'$'.number_format($row->amount,2))
						->setCellValue('K'.$count,'$'.number_format($row->tax,2))
						->setCellValue('L'.$count,'$'.number_format($row->shipping,2))
						->setCellValue('M'.$count,'$'.number_format($row->service,2))
						->setCellValue('N'.$count,'$'.number_format($row->surcharge,2))
						->setCellValue('O'.$count,'$'.number_format($row->tax+$row->shipping+$row->service+$row->surcharge+$row->amount,2))
						->setCellValue('P'.$count,$row->products)
						->setCellValue('Q'.$count,$row->skus)
						->setCellValue('R'.$count,$row->occasion_name)
						->setCellValue('S'.$count,''); 
	    
	}
	
	 
	$filename='1800-RefundReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    function dailysales_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Daily Sales Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Daily Sales Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Order Date')
					->setCellValue('B2','No. of Orders')
					->setCellValue('C2','Revenue')
					->setCellValue('D2','Shipping')
					->setCellValue('E2','Service')
					->setCellValue('F2','Surcharge')
					->setCellValue('G2','Taxes')
					->setCellValue('H2','Total')
					->setCellValue('I2','Discount Total')
					->setCellValue('J2','Grand Total');
					
	$count = 2;
	
	$totals = array('amount'=>0,'shipping'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,'commission'=>0,'gtotal'=>0,'orders'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		$totals['amount'] += $row->amount;
                $totals['shipping'] += $row->shipping;
                $totals['service'] += $row->service;
                $totals['surcharge'] += $row->surcharge;
                $totals['tax'] += $row->tax;
                $totals['discount'] += $row->discount;
                $tot = $row->amount+$row->shipping+$row->tax;
                $disc = $row->coupon + $row->discount;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->service+$row->surcharge+$row->tax;
                $totals['orders'] += $row->orders;
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,date('d M Y',strtotime($row->order_date)))
						->setCellValue('B'.$count,$row->orders)
						->setCellValue('C'.$count,number_format($row->amount,2))
						->setCellValue('D'.$count,number_format($row->shipping,2))
						->setCellValue('E'.$count,number_format($row->service,2))
						->setCellValue('F'.$count,number_format($row->surcharge,2))
						->setCellValue('G'.$count,number_format($row->tax,2))
						->setCellValue('H'.$count,number_format($tot,2))
						->setCellValue('I'.$count,number_format($disc,2))
						->setCellValue('J'.$count,number_format($tot-$disc,2));
	    
	}
	
	$count++;
	
		$this->excel->getActiveSheet()->setCellValue('A'.$count,'Totals')
						->setCellValue('B'.$count,$totals['orders'])
						->setCellValue('C'.$count,number_format($totals['amount'],2))
						->setCellValue('D'.$count,number_format($totals['shipping'],2))
						->setCellValue('E'.$count,number_format($totals['service'],2))
						->setCellValue('F'.$count,number_format($totals['surcharge'],2))
						->setCellValue('G'.$count,number_format($totals['tax'],2))
						->setCellValue('H'.$count,number_format($totals['amount']+$totals['tax']+$totals['shipping'],2))
						->setCellValue('I'.$count,number_format($totals['coupon']+$totals['discount'],2))
						->setCellValue('J'.$count,number_format(($totals['amount']+$totals['tax']+$totals['shipping'])-($totals['coupon']+$totals['discount']),2));
	
	 
	$filename='1800-DailySalesReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function coupons_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Coupons Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Coupons Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Order ID')
					->setCellValue('B2','Date')
					->setCellValue('C2','Coupon Code')
					->setCellValue('D2','Coupon Value')
					->setCellValue('E2','Coupon Type')
					->setCellValue('F2','Coupon Discount');
					 
	$count = 2;
	
	$totals = array('amount'=>0,
                      'shipping'=>0,
                      'tax'=>0,
                      'coupon'=>0,
                      'discount'=>0,
                      'gtotal'=>0,
                      'commission'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
	    $totals['amount'] += $row->amount;
	    $totals['shipping'] += $row->shipping;
	    $totals['tax'] += $row->tax;
	    $totals['discount'] += $row->discount;
	    $totals['coupon'] += $row->coupon;
	    $totals['commission'] += $row->commission;
	    $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax;
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->invoice_id)
						->setCellValue('B'.$count,date('d-m-Y',strtotime($row->order_date)))
						->setCellValue('C'.$count,$row->discount_name)
						->setCellValue('D'.$count,$row->discount_amount>0 ? $row->discount_amount:$row->discount_percentage)
						->setCellValue('E'.$count,$row->discount_amount>0 ? '$':'%')
						->setCellValue('F'.$count,$row->coupon);
						
	}
	
	$count++;
	
		$this->excel->getActiveSheet()->setCellValue('F'.$count,number_format($totals['coupon'],2));
	 
	$filename='1800-CouponsReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function allusers_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('All Users Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'All Users Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Full Name')
					->setCellValue('B2','Registration Email')
					->setCellValue('C2','Registration Date')
					->setCellValue('D2','Last Login Date')
					->setCellValue('E2','Last Order Date');
					 
	$count = 2;
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->user_firstname . ' ' . $row->user_lastname)
						->setCellValue('B'.$count,$row->user_email)
						->setCellValue('C'.$count,strtotime($row->user_created) > 0 ? date('M-d-Y',strtotime($row->user_created)):'')
						->setCellValue('D'.$count,strtotime($row->user_lastlogin) > 0 ? date('M-d-Y',strtotime($row->user_lastlogin)):'')
						->setCellValue('E'.$count,strtotime($row->lastorderdate) > 0 ? date('M-d-Y',strtotime($row->lastorderdate)):'');
						
	}
	
	$count++;
	 
	$filename='1800-AllUsersReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function search_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Search Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Search Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Search')
					->setCellValue('B2','Search Time')
					->setCellValue('C2','Customer');
					 
	$count = 2;
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
	    $this->excel->getActiveSheet()->setCellValue('A'.$count,$row->search_string)
					    ->setCellValue('B'.$count,date('d M Y H:s:i',strtotime($row->search_time)))
					    ->setCellValue('C'.$count,$row->user_firstname.' '.$row->user_lastname);
	
	}
	
	$count++;
	 
	$filename='1800-SearchReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function delivery_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Delivery Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Delivery Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Delivery Method')
					->setCellValue('B2','Sales')
					->setCellValue('C2','Amount');
					 
	$count = 2;
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
	    $this->excel->getActiveSheet()->setCellValue('A'.$count,$row->delivery_method)
					    ->setCellValue('B'.$count,$row->items)
					    ->setCellValue('C'.$count,number_format($row->amount,2));
	
	}
	
	$count++;
	 
	$filename='1800-DeliveryReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function multipleorders_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('Multiple Orders Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'Multiple Orders Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Full Name')
					->setCellValue('B2','Registration Email')
					->setCellValue('C2','Registration Date')
					->setCellValue('D2','Number of Orders Placed')
					->setCellValue('E2','Last Login Date')
					->setCellValue('F2','Last Order Date');
					
	$count = 2;
	
	$totals = array('amount'=>0,'shipping'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,'commission'=>0,'gtotal'=>0,'orders'=>0);
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
		$this->excel->getActiveSheet()->setCellValue('A'.$count,$row->user_firstname . ' ' . $row->user_lastname)
						->setCellValue('B'.$count,$row->user_email)
						->setCellValue('C'.$count,strtotime($row->user_created) > 0 ? date('M-d-Y',strtotime($row->user_created)):'')
						->setCellValue('D'.$count,$row->orders)
						->setCellValue('E'.$count,strtotime($row->user_lastlogin) > 0 ? date('M-d-Y',strtotime($row->user_lastlogin)):'')
						->setCellValue('F'.$count,strtotime($row->lastorderdate) > 0 ? date('M-d-Y',strtotime($row->lastorderdate)):'');
	    
	}
	
	$count++;
	
	 
	$filename='1800-MultipleOrdersReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    function newmail_excel($data)
    {
	//load our new PHPExcel library
	$this->load->library('excel');
	//activate worksheet number 1
	$this->excel->setActiveSheetIndex(0);
	//name the worksheet
	$this->excel->getActiveSheet()->setTitle('New Emails Report');
	//set cell A1 content with some text
	$this->excel->getActiveSheet()->setCellValue('A1', 'New Emails Report');
	$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//change the font size
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
	//make the font become bold
	//$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	//merge cell A1 until D1
	//$this->excel->getActiveSheet()->mergeCells('A1:D1');
	//set aligment to center for that merged cell (A1 to D1)
	
	$this->excel->getActiveSheet()->setCellValue('A2','Email Address')
					->setCellValue('B2','Name')
					->setCellValue('C2','Registration Date');
					 
	$count = 2;
					
	foreach($data['records'] as $row)
	{
	    $count++;
	    
	    $this->excel->getActiveSheet()->setCellValue('A'.$count,$row->user_email)
					    ->setCellValue('B'.$count,$row->user_firstname . ' ' . $row->user_lastname)
					    ->setCellValue('C'.$count,strtotime($row->user_created) > 0 ? date('M-d-Y',strtotime($row->user_created)):'');
	
	}
	
	$count++;
	 
	$filename='1800-NewEmailsReport.xls'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
		     
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');
    }
    
    
    

}

?>
