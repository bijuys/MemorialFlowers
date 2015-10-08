<?php

class Orders extends CI_Controller{
    
    function Orders() {
        parent::__construct();
        
        if(!admin_authorized())
        {
            redirect('/siteadmin/login');
            exit;
        }
		
		if(!accessGrant('orders'))
		{
			redirect('/siteadmin');
			exit;
		}
        
        $this->load->helper('url');
	$this->load->model('Order_model');
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
    
    function month() {
        
        $total= $this->Order_model->count_month();
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/month/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
	$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_month($offset,$per_pg);
        $data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders',$data);
    }
    
    function yesterday() {
        
        $total= $this->Order_model->count_yesterday();
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/yesterday/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
	$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_yesterday($offset,$per_pg);
        $data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders',$data);
    }
    
    function today() {
        
        $total= $this->Order_model->count_todays();
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/today/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
	    $data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_todays($offset,$per_pg);
        $data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders',$data);
    }
    
	
	
	function filtered()
	{
		/*$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_filteredProducts($_POST);
		$this->load->view('admin/products',$data);*/
		
		$total= $this->Order_model->count_orders();
        $per_pg=20;
        $offset=$this->uri->segment(4);
		
		$this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/browse/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        //$data['pagination']=$this->pagination->create_links();
        
		$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_filteredOrders($_POST);
        $data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders',$data);
		
	}
	
	
	
	function cities() {
        
        //$total= $this->Order_model->count_cities();
		$total= 100;
        $per_pg=10;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/cities';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        //$data['pagination']=$this->pagination->create_links();
        
	    $data['this_class'] = get_class($this);
        
		$data['orders_canada'] = $this->Order_model->canada_total();
		$data['orders_canada_local'] = $this->Order_model->canada_total_local();
        $data['orders_canada_ds'] = $this->Order_model->canada_total_ds();
		
		$data['orders_city'] = $this->Order_model->city_total();
		$data['orders_city_local'] = $this->Order_model->city_total_local();
        $data['orders_city_ds'] = $this->Order_model->city_total_ds();
        
		$data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders_by_city',$data);
		
    }
	
	
	
	
	
	
	function advanced_filter()
    {
	/*$this->load->model('Category_model');
	$this->load->model('Subcategory_model');
	$this->load->model('Color_model');
	$this->load->model('Occasion_model');
	$data['categories'] = $this->Category_model->get_categories();
	$data['subcategories'] = $this->Subcategory_model->get_subcategories();
	$data['occasions'] = $this->Occasion_model->get_occasions();
	$data['colors'] = $this->Color_model->get_colors();
	$data['this_class'] = get_class($this);
	$data['products'] = $this->Product_model->get_filteredProducts($_POST);
	$this->load->view('admin/products',$data);*/
	
	
      $prov = $this->input->post("province");
	  $city = $this->input->post("city");

	  if($city!='') {
		$ed = " AND dd.city='".$city."'";
		}else{
		$ed = "";
		}
	
	$total= $this->Order_model->count_orders();
	
	$per_pg=20;
	$offset=$this->uri->segment(4);
		
	$this->load->library('pagination');
	$config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/browse/';
	$config['total_rows'] = $total;
	$config['per_page'] = $per_pg;
	$config['uri_segment'] = 4;
	$config['page_query_string'] = FALSE;
	$config['next_link'] = '&raquo;';
	$config['prev_link'] = '&laquo;';
	$config['full_tag_open'] = '<div class="pagination"> Pages: ';
	$config['full_tag_close'] = '</div>';

	$this->pagination->initialize($config);
	//$data['pagination']=$this->pagination->create_links();
	
	
	$data['orders_canada'] = $this->Order_model->canada_total();
	$data['orders_canada_local'] = $this->Order_model->canada_total_local();
    $data['orders_canada_ds'] = $this->Order_model->canada_total_ds();
	
	$data['this_class'] = get_class($this);
	
	$data['gen_orders'] = $this->Order_model->gen_total($prov,$ed);
	$data['gen_orders_lo'] = $this->Order_model->gen_total_local($prov,$ed);
	$data['gen_orders_ds'] = $this->Order_model->gen_total_ds($prov,$ed);
	
	$data['provin'] = $prov;
	
	$data['status_codes'] = $this->Order_model->get_status_codes();
	$this->load->view('admin/orders_report_fil',$data);
	    
    }
	
	
	
	
	
    function browse() {
        
        $total= $this->Order_model->count_orders();
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/browse/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
		$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_orders($offset,$per_pg);
        $data['status_codes'] = $this->Order_model->get_status_codes();
        $this->load->view('admin/orders',$data);
    }
    
    function view($id) {
        $data['order'] = $this->Order_model->get_order($id);
        $this->load->view('admin/order-view',$data);  
    }
    
    function tracking()
    {
	if($_POST)
	{
	    if($this->Order_model->updateTracking($_POST))
	    {
		$this->sendTrackingCode($_POST);
	    }
	}
	
	$this->load->library('user_agent');
	
	redirect($this->agent->referrer());
	exit;
	
    }
    
    function sendTrackingCode($vars)
    {
	

	$this->load->model('Email_model');
	
	$items = $this->Order_model->getTrackItems($vars['orderitem_id']);
		
	foreach($items as $row)
	{
	    $data = array('FIRSTNAME'=>$row->firstname, 'LASTNAME'=>$row->lastname, 'FULLNAME'=>$row->firstname.' '.$row->lastname,
			  'TRACKINGCODE'=>$vars['tracking_code'],'INVOICE'=>$row->invoice_id,'TRACKINGURL'=>'<a href="'.base_url().'support/tracking">Click here to track the order</a>');
	    
	    
	    $eformat = $this->Email_model->getMessage('send-tracking',$data);
    
	    $this->load->library('email');
	    
	    $email_config['mailtype'] = 'html';
	    $this->email->initialize($email_config);
	    
	    $this->email->from('ordertracking@whatabloom.com', 'What A Bloom');
	    $this->email->to($row->email);
	    
	    $this->email->subject('What A Bloom Track your Order');
	    $this->email->message($eformat);
	    
	    @$this->email->send();
	    
	}
	
	return true;
	
    }
    
    function pending()
    {
        
        $total= $this->Order_model->count_pending();
        
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/pending/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
	$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_pending($offset,$per_pg);
	$data['ptitle'] = 'Pending';
        $this->load->view('admin/pending-orders',$data);	
    }
    
    function completed()
    {
        $total= $this->Order_model->count_completed();
        
        $per_pg=20;
        $offset=$this->uri->segment(4);
        
        $this->load->library('pagination');
        $config['base_url'] = $this->config->item('base_url').'/siteadmin/orders/completed/';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_pg;
        $config['uri_segment'] = 4;
        $config['page_query_string'] = FALSE;
        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['full_tag_open'] = '<div class="pagination"> Pages: ';
        $config['full_tag_close'] = '</div>';

        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        
        
	$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_completed($offset,$per_pg);
	$data['ptitle'] = 'Completed';
        $this->load->view('admin/orders',$data);	
    }
    
    function cancelled()
    {
	$data['this_class'] = get_class($this);
        $data['orders'] = $this->Order_model->get_cancelled();
	$data['ptitle'] = 'Cancelled';
        $this->load->view('admin/orders',$data);	
    }
    
    function cancel_order($id)
    {
	if(!$_POST)
	{
	    $this->load->view('admin/cancel-form');
	}
	else
	{
	    $this->Order_model->cancelOrder($id,$_POST['reason']);
	    redirect('/siteadmin/orders/browse');
	}

    }
    
    function show($status_id=1)
    {
    
    }
    
    function status($id,$status)
    {
       if($this->Order_model->set_status($id,strtoupper($status)))
       {
            redirect('/siteadmin/orders/browse');
            exit;
       }
       
       redirect("siteadmin/orders/view/{$id}");
       exit;
    }
    
    function cancel() {
	
        $data['cancels'] = array();
        $this->load->view('admin/cancels',$data);
        
    }
    
    function ups()
    {

	
    }

}

?>
