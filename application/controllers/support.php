<?php

class Support extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');		
        $this->load->library('form_validation');
    }
    
    function index() {
        
        $data['page'] = $this->Pages_model->return_page('customer-service');
        $data['current_page'] = $data['page']->page_handle;
        
        $data['paths'] = array('Home'=>path(),'Customer Support'=>'');        
        $this->load->view('support-center',$data);
    }
    
    function contact()
    {
        
        use_ssl(TRUE);
        
        if(!$_POST)
        {
           $data['page'] = $this->Pages_model->return_page('contact');
           $data['current_page'] = $data['page']->page_handle;
           
           $data['paths'] = array('Home'=>path(),'Customer Service'=>path('support'),'Contact'=>'');     
           $this->load->view('contact-support',$data);
        }
        else
        {
            $data['page'] = $this->Pages_model->return_page('support-thanks');
            $data['paths'] = array('Home'=>path(),'Customer Service'=>path('support'),'Contact'=>'');     
            $this->load->view('support-thanks',$data);
        }
        
    }
    
    function subscribe()
    {
        $this->form_validation->set_message('is_unique', 'This email already exists!');
        $this->form_validation->set_rules('email', 'Email','required|valid_email|is_unique[email_list.email]');
        $this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
        
        if ($this->form_validation->run() == FALSE)
        {
            
            //$data['page'] = $this->Pages_model->return_page('email-subscription');
            $data['paths'] = array('Home'=>path(),'Signup for Special offers'=>'');   
            $this->load->view('email-subscribe',$data);                
        }
        else
        {
            $this->load->model('Customer_model');
            
            if($this->Customer_model->subscribe($this->input->post('email')))
            {
                $data['paths'] = array('Home'=>path(),'Signup for Special offers'=>'');    
                $this->load->view('subscribe-thanks',$data);
            }
            else
            {
                $data['paths'] = array('Home'=>path(),'Signup for Special offers'=>'');   
                 $this->load->view('email-subscribe',$data);      
            }
           
        }        

    }
    
    function tracking()
    {
        use_ssl(false);
        
	$this->form_validation->set_rules('order_number', 'Order Number','required');
        $this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
        
        if ($this->form_validation->run() == FALSE)
        {
           
            if($this->session->userdata('customer_id') && $this->session->userdata('customer_login')==true)
            {
                redirect('/myaccount/track');
            }
            
            $data['paths'] = array('Home'=>path(),'Customer Service'=>path('support'),'Order Tracking'=>'');     
            $data['page'] = $this->Pages_model->return_page('tracking');
            $this->load->view('signin-tracking',$data);                
        }
        else
        {
                $this->load->model('Order_model');
		
		$orderid = $this->Order_model->getID($this->input->post('order_number'));
		
		$this->load->helper('htmldom');
                $data['paths'] = array('Home'=>path(),'Customer Service'=>path('support'),'Order Tracking'=>'');     
		$data['items'] = $this->Order_model->getTracking($this->input->post('order_number'));
		$data['order'] = $this->Order_model->get_order($orderid);
		
		$this->load->view('track-result',$data);	
           
        }

    }




}