<?php

class Socialmedia extends CI_Controller {
	
	
	
	function Socialmedia()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		
		if(!accessGrant('discounts'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Discounts_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$this->load->view('admin/socialmedia');
		$this->load->model('socialmedia_model'); 
		
		/*
		$query = "INSERT INTO socialmedia(customer_id,value,figuretype,
			 			start,end,maxuse,number,discounttype,category) VALUES ($customer,$value,$figuretype,
						'$start','$end',$usage,'$number','$type',$categorytype1)";
		*/
		
		IF(ISSET($_POST['submit'])) {
		 $coupon = array(
       'customer_id' => $this->input->post('customer'),
       'value' => $this->input->post('value'),
	   'figuretype' => $this->input->post('figuretype'),
	   'start' => $this->input->post('start'),
	   'end' => $this->input->post('end'),
	   'maxuse' => $this->input->post('usage'),
	   'number' => $this->input->post('number'),	   
	   'discounttype' => $this->input->post('type'),
	   'category' => $this->input->post('categorytype1')
		);
		
				
		
		
        $this->socialmedia_model->add_socialcoupon($coupon);
		
		$this->session->set_flashdata('message', 'New Coupon has been added');
        redirect(current_url());
		
		}
		
		
		IF(ISSET($_POST['populatedata'])) {
		
		
		
		
						$myFile = "currentfile.txt";
						$fh = fopen($myFile, 'r');
						$theData = fread($fh, filesize($myFile));
						fclose($fh);
						echo $theData;
						
						
						
						$keywords = preg_split("/[\s,]+/", $theData);
						
						$track1 = count($keywords);
						
						
						 $track = 0;
						 echo $keywords[0];
						 echo $keywords[1];
						 $dstatus = 1;
						while ($track<$track1){
						/*
						$query = "INSERT INTO socialmedia(customer_id,value,figuretype,
			 			start,end,maxuse,number,discounttype,dstatus,category) VALUES ($customer,$value1,$figuretype1,
						'$start1','$end1',$usage1,'$keywords[$track]','$type1',$dstatus,$categorytype1)";
						
						mysql_query($query);
						*/
						 
						 
						 
						  $coupon = array(
						   'customer_id' => $this->input->post('customer1'),
						   'value' => $this->input->post('value1'),
						   'figuretype' => $this->input->post('figuretype1'),
						   'start' => $this->input->post('start1'),
						   'end' => $this->input->post('end1'),
						   'maxuse' => $this->input->post('usage1'),
						   'discounttype' => $this->input->post('type1'),
						   'category' => $this->input->post('categorytype1'),
						   'number' => $keywords[$track]   
							);
							
						 echo $coupon;
						 
						$this->socialmedia_model->add_socialcoupon($coupon);
						
						
						
						
						$track = $track + 1;
		
		
		
		
				
		
		
			}
		
			$this->session->set_flashdata('message', 'New Coupons has been added');
        redirect(current_url());
		}
	}
	
	function delete($id)
	{
		$this->Discounts_model->delete($id);
		redirect('/siteadmin/discounts');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('discount_name', 'Discount Name','required');
		$this->form_validation->set_rules('discount_value', 'Discount Value','required');
		$this->form_validation->set_rules('discount_type', 'Discount Type','required');
		$this->form_validation->set_rules('discount_value_type', 'Discount Value Type','required');
		$this->form_validation->set_rules('discount_limit', 'Discount Limit','required');
		$this->form_validation->set_rules('day', 'Epiry Date','required');
		$this->form_validation->set_rules('month', 'Epiry Date','required');
		$this->form_validation->set_rules('year', 'Epiry Date','required');
		$this->form_validation->set_rules('discount_availibility', 'Availibility','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Update';
			if(!$_POST)
			{
				$discount = $this->Discounts_model->get_discount($id);
				$data['discount'] = $discount;
				$expiry = $discount->discount_expiry;
				$start = $discount->discount_start;
				list($data['year'],$data['month'],$data['day']) = explode('-',$expiry);
				list($data['syear'],$data['smonth'],$data['sday']) = explode('-',$start);
			}
			
			$this->load->view('admin/discount-form',$data);
		}
		else
		{
			$this->Discounts_model->update($this->input->post());
			redirect('/siteadmin/discounts');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('discount_name', 'Discount Name','required');
		$this->form_validation->set_rules('discount_value', 'Discount Value','required');
		$this->form_validation->set_rules('discount_type', 'Discount Type','required');
		$this->form_validation->set_rules('discount_value_type', 'Discount Value Type','required');
		$this->form_validation->set_rules('discount_limit', 'Discount Limit','required');
		$this->form_validation->set_rules('day', 'Epiry Date','required');
		$this->form_validation->set_rules('month', 'Epiry Date','required');
		$this->form_validation->set_rules('year', 'Epiry Date','required');
		$this->form_validation->set_rules('discount_availibility', 'Availibility','is_natural');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/discount-form',$data);
		}
		else
		{
			$this->Discounts_model->create($this->input->post());
			redirect('/siteadmin/discounts');
			exit;
		}
	}
	
	
}
