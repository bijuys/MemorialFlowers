<?php

class User extends CI_Controller{

	
	function User()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Customer_model');
	}
	
	function index()
	{
		$this->checkLogin();
	}
	
	
	function get_account()
	{

		if($_POST && isset($_POST['retrieve']) && $_POST['retrieve']=='password')
		{
			$this->form_validation->set_rules('username', 'Username','required');
		}
		elseif($_POST && isset($_POST['retrieve']) && $_POST['retrieve']=='username')
		{
			$this->form_validation->set_rules('email', 'Email','required');
		}
		
		$this->form_validation->set_rules('retrieve', 'Account','required');
		
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{  
			$this->load->view('retrieve-account');
		}
		else
		{
			if($user = $this->Customer_model->retrieve_account($this->input->post()))
			{
		
				if($email = get_message('forget-password'))
				{
					if($this->session->userdata('language')=='french')
					{
						$message = $email->message_text_fr;
						$title = $email->message_title_fr;
						
					}
					else
					{
						$message = $email->message_text;
						$title = $email->message_title;
					}
					
					$message = str_replace('{FIRSTNAME}',$user->user_firstname,$message);
					$message = str_replace('{LASTNAME}',$user->user_lastname,$message);
					$message = str_replace('{USERNAME}',$user->user_name,$message);
					$message = str_replace('{PASSWORD}',$user->user_password,$message);
					$message = str_replace("\n",'<br/>',$message);
					
					$this->load->library('email');
					
					$email_config['mailtype'] = 'html';
					$email_config['protocol'] = 'mail';
					
					$this->email->initialize($email_config);
					
					$this->email->from('myaccount@memorialflowers.ca', '1-800-Flowers');
					$this->email->to($user->user_email);
					
					$this->email->subject($title);
					$this->email->message($message);
					
					$this->email->send();
					
					$this->load->view('password-sent');

				}
				
			}
			else
			{
				$data['message'] = 'Sorry this account does not exists!';
				$this->load->view('retrieve-account',$data);
			}
				
		}	
	}
	
	function trackorder($num)
	{
		use_ssl(TRUE);
		
		$this->checkLogin();
		$this->load->model('Order_model');
		
		$orderid = $this->Order_model->getID($num);
		
		$this->load->helper('htmldom');
		$data['items'] = $this->Order_model->getTracking($num);
		$data['order'] = $this->Order_model->get_order($orderid);
		
		$this->load->view('track-order',$data);	
	}
	
	function track()
	{
		use_ssl(TRUE);
		
		$this->checkLogin();

		$this->form_validation->set_rules('order_number', 'Order Number','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data = array();
		    $this->load->view('get-trackingno',$data);	                
		}
		else
		{
			$this->load->model('Order_model');
			
			$orderid = $this->Order_model->getID($this->input->post('order_number'));
		
			$this->load->helper('htmldom');
			$data['items'] = $this->Order_model->getTracking($this->input->post('order_number'));
			$data['order'] = $this->Order_model->get_order($orderid);
			
			$this->load->view('track-order',$data);	
		      
		}


		
		
	}

	
	function orders()
	{
		use_ssl(TRUE);
		
		$this->checkLogin();
		
		$data['orders'] = $this->Customer_model->get_invoices($this->session->userdata['customer_id']);
		
		$data['current_page'] = 'user-orders';
		$data['page'] = $this->Pages_model->return_page('customer-orders');
		$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Orders'=>'');     
		$this->load->view('user-orders',$data);
	}
	
	function view($id)
	{
		use_ssl(TRUE);
		
		$this->checkLogin();
		
		$data['items'] = $this->Customer_model->get_invoice($this->session->userdata['customer_id'],$id);
		$data['billing'] = $this->Customer_model->get_billing($this->session->userdata['customer_id'],$id);
		$data['page'] = $this->Pages_model->return_page('customer-orders');
		$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Orders'=>'');
		$data['invoiceid']= $id;
		$this->load->view('view',$data);
		
	}
	
	function checkLogin()
	{
		if($this->session->userdata('customer_id') && $this->session->userdata('customer_login')==true)
		{
			return true;
		}
		
		redirect('/signin');
		exit;
		
	}
	
	function password()
	{
		use_ssl(TRUE);
		
		$this->checkLogin();
		
		$this->form_validation->set_rules('oldpassword', 'Old Password','required');
		$this->form_validation->set_rules('newpassword', 'New Password','required');
		$this->form_validation->set_rules('confpassword', 'Password Confirmation','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = $this->Pages_model->return_page('customer-password');
			$data['user'] = $this->Customer_model->get_customer($this->session->userdata['customer_id']);
			$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Password'=>'');   
			$this->load->view('user-password',$data);
		}
		else
		{
			if($this->Customer_model->update_Password($this->input->post()))
			{
				
				$this->session->set_flashdata('message','Your password is changed.');
			}
			else
			{
				$this->session->set_flashdata('message','<span class="error">Your password is not changed.</span>');
			}
			
			redirect('/myaccount/password');
			exit;
		}			
	}

	
	function profile()
	{
		use_ssl(TRUE);
		
		$this->checkLogin();	
	
		$this->form_validation->set_rules('firstname', 'First Name','required');
		$this->form_validation->set_rules('lastname', 'Last Name','required');
		$this->form_validation->set_rules('business', 'Business','max_length[150]');
		$this->form_validation->set_rules('address1', 'Address','required');
		$this->form_validation->set_rules('address2', 'Address Line 2','max_length[150]');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('postalcode', 'Postalcode','max_length[10]|min_length[4]');
		$this->form_validation->set_rules('province2', 'Other Province','max_length[45]|callback_province_check');
		$this->form_validation->set_rules('country_id', 'Country','required|numeric');
		$this->form_validation->set_rules('email', 'Email','required|valid_email');
		$this->form_validation->set_rules('dayphone', 'Day Phone','required|callback_valid_phone_numer');
		$this->form_validation->set_rules('evephone', 'Evening Phone','callback_valid_phone_numer');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['p'] = (object) $_POST;
			
			if(!$_POST)
			{
				$data['user'] = $this->Customer_model->get_customer($this->session->userdata['customer_id']);
			}	

			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$data['page'] = $this->Pages_model->return_page('customer-profile');
			$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Profile'=>'');   
			$this->load->view('user-profile',$data);
		}
		else
		{
			if($id=$this->Customer_model->update_profile($this->input->post()))
			{
				$this->session->set_flashdata('message',lang('Profile succesfully updated').'!');
			}
			else
			{
				$this->session->set_flashdata('message','<span class="error">'.lang('Profile not updated').'!</span>');
			}
				
			redirect('/myaccount/profile');
			exit;			
			
		}
	}
	
	function myaccount()
	{
		use_ssl(TRUE);
		
		$this->checkLogin();	
		$data['user'] = $this->Customer_model->get_customer($this->session->userdata['customer_id']);
		$data['current_page'] = 'user-home';
		$data['page'] = $this->Pages_model->return_page('myaccount');
		$this->load->view('user-home',$data);		
	}
	
	function signin()
	{
		use_ssl(TRUE);
		
		$this->form_validation->set_rules('username','Username','required|alpha_dash|max_length[45]');
		$this->form_validation->set_rules('password','Password','required|max_length[45]');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		if($this->form_validation->run()==FALSE)
		{
			$data['page'] = $this->Pages_model->return_page('signin');
			$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Login'=>''); 
			$this->load->view('signin',$data);			
		}
		else
		{
			if($user = $this->Customer_model->login($this->input->post()))
			{
				$this->session->set_userdata('customer_id',$user->user_id);
				$this->session->set_userdata('user_firstname',$user->user_firstname);
				$this->session->set_userdata('user_lastname',$user->user_lastname);
				$this->session->set_userdata('username',$user->user_name);
				$this->session->set_userdata('user_company',$user->parent_id);
				$this->session->set_userdata('user_role',$user->user_role);
				$this->session->set_userdata('customer_login',true);
				if($user->referer_id>0)
					$this->session->set_userdata('referer',$user->referer_id);
				redirect('/myaccount');
				exit;
			}
			else
			{
				$data['page'] = $this->Pages_model->return_page('signin');
				$data['message'] = 'Invalid Login! Please try again';
				$data['paths'] = array('Home'=>path(),'My Account'=>path('myaccount'),'Orders'=>'');   
				$this->load->view('signin',$data);
			}
		}

	}
	
	function logout()
	{
		use_ssl(TRUE);
		
		$this->session->set_userdata('customer_login',true);
		
		$this->session->unset_userdata('customer_id');
		$this->session->unset_userdata('user_firstname');
		$this->session->unset_userdata('user_lastname');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('customer_login');
		$this->session->unset_userdata('user_company');
		$this->session->unset_userdata('user_role');
		
		redirect(site_url());
		exit;
	}
	
	function signup()
	{
		use_ssl(TRUE);
		
		$this->form_validation->set_rules('username', 'User Name','required|min_length[4]|max_length[45]|alpha_dash|is_unique[users.user_name]');
		$this->form_validation->set_rules('password', 'Password','required|min_length[4]|max_length[45]');
		$this->form_validation->set_rules('password2', 'Confirm Password','required|matches[password]');
		$this->form_validation->set_rules('email', 'Email','required|valid_email|max_length[45]|is_unique[users.user_email]');
		$this->form_validation->set_rules('firstname', 'First Name','required|min_length[4]|max_length[45]|alpha_dash_space');
		$this->form_validation->set_rules('lastname', 'Last Name','required|min_length[4]|max_length[45]|alpha_dash_space');
		$this->form_validation->set_rules('business', 'Business','max_length[100]');
		$this->form_validation->set_rules('address1', 'Address','required|max_length[100]');
		$this->form_validation->set_rules('address2', 'Address Line 2','max_length[100]');
		$this->form_validation->set_rules('city', 'City','required|max_length[35]');
		$this->form_validation->set_rules('postalcode', 'Postalcode','max_length[10]|min_length[4]');
		$this->form_validation->set_rules('province', 'Province','max_length[45]|alpha_dash_space|callback_province_check');
		$this->form_validation->set_rules('country_id', 'Country','required|numeric');
		$this->form_validation->set_rules('dayphone', 'Day Phone','required|max_length[15]|callback_valid_phone_numer');
		$this->form_validation->set_rules('evephone', 'Day Phone','max_length[15]|callback_valid_phone_numer');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['p'] = (object) $_POST;
			$data['current_page'] = 'signup';
			$data['page'] = $this->Pages_model->return_page('signup');
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('user-form',$data);
		}
		else
		{
			if($id=$this->Customer_model->signup($this->input->post()))
			{
				$data['current_page'] = 'signup';
				$this->load->model('Email_model');
				$data['title'] = $this->Email_model->getTitle('signup',$this->input->post());
				$data['email'] = $this->Email_model->getMessage('signup',$this->input->post());
				
				$this->load->library('email');
				
				$this->email->from('admin@1800florists.ca', '1-800-Flowers Canada');
				$this->email->to($this->input->post('emai'));
				
				$this->email->subject($data['title']);
				$this->email->message($data['email']);
				
				@$this->email->send();
				
				
				$this->session->set_userdata('customer_id',$id);
				$this->session->set_userdata('user_firstname',$this->input->post('firstname'));				$this->session->set_userdata('user_lastname',$user->user_lastname);
				$this->session->set_userdata('username',$this->input->post('username'));
				$this->session->set_userdata('user_company',0);
				$this->session->set_userdata('user_role','customer');
				$this->session->set_userdata('customer_login',true);

				redirect('/myaccount');
				
				exit;				
			}
			else
			{
				die('<div id="error">'.lang('An unknown error happened. Please try later.').'</div>');
				exit;
			}
		}
	}
	
	function delete($id)
	{
		$this->Customer_model->delete($id);
		redirect('siteadmin/customers');
		exit;
	}
	
	
	function edit($id)
	{
		
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[44]|callback_unique_check[user_name,'.$id.']');
		$this->form_validation->set_rules('user_password', 'Password','required');
		$this->form_validation->set_rules('user_email', 'Email','required|valid_email|callback_unique_check[user_email,'.$id.']');
		$this->form_validation->set_rules('user_firstname', 'First Name','required');
		$this->form_validation->set_rules('user_lastname', 'Last Name','required');
		$this->form_validation->set_rules('user_business', 'Business','max_length[150]');
		$this->form_validation->set_rules('user_address1', 'Address','required');
		$this->form_validation->set_rules('user_address2', 'Address Line 2','max_length[150]');
		$this->form_validation->set_rules('user_city', 'City','required');
		$this->form_validation->set_rules('user_postalcode', 'Postalcode','max_length[10]|min_length[4]');
		$this->form_validation->set_rules('user_province', 'Province','callback_province_check');
		$this->form_validation->set_rules('user_province2', 'Other Province','max_length[45]');
		$this->form_validation->set_rules('user_country_id', 'Country','required|numeric');
		$this->form_validation->set_rules('user_phone1', 'Day Phone','required|callback_valid_phone_numer');
		$this->form_validation->set_rules('user_phone2', 'Day Phone','callback_valid_phone_numer');
		$this->form_validation->set_rules('user_phone1_ext', 'Day Phone','numeric');
		$this->form_validation->set_rules('user_phone2_ext', 'Day Phone','numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			if( ! $_POST)
			{
				$data['customer'] = $this->Customer_model->get_customer($id);
			}
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Update';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			//$data['page'] = $this->Pages_model->return_page('signup');
			
			$this->load->view('admin/customer-form',$data);
		}
		else
		{
			$this->Customer_model->update($this->input->post());
			redirect('siteadmin/customers');
			exit;
		}
	}
	
	function valid_code($value,$params=0)
	{	
		if(empty($value))
			return TRUE;	
	
		if(!$this->Customer_model->is_valid_code($value,$_POST['parent_id']))
		{
			$this->form_validation->set_message('valid_code', 'This code is invalid, Please contact the company!');
			return FALSE;			
		}
		else
		{
			return TRUE;
		}		
	}
	
	
	function matchpass($value,$params=0)
	{		
		if($_POST['password']!=$value)
		{
			$this->form_validation->set_message('matchpass', 'Confirm Password does not match!');
			return FALSE;			
		}
		else
		{
			return TRUE;
		}		
	}
	
	
	function unique_check($value,$params)
	{
		list($field,$id) = explode(',',$params);
		
		if($this->Customer_model->is_exists($value,$field,$id))
		{
			$this->form_validation->set_message('unique_check', 'This %s is already exits, Please provide new one');
			return FALSE;			
		}
		else
		{
			return TRUE;
		}		
	}
	
	

	
	function province_check($value)
	{
		if(trim(strlen($_POST['province'])==0) && trim(strlen($_POST['province2'])==0))
		{
			$this->form_validation->set_message('province_check', 'Please enter %s');
			return FALSE;
		}
		else
		{
			return TRUE;			
		}
		
	}
	
	function valid_phone_number($value)
	{
	        $value = trim($value);
	        if ($value == '') {
	                return TRUE;
	        }
	        else
	        {
	                if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value))
	                {
	                        return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
	                }
	                else
	                {

							$this->form_validation->set_message('valid_phone_number', 'The %s is not a valid phone');
	                        return FALSE;
	                }
	        }
	}

}
