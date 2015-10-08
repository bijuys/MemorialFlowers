<?php

class Affiliates extends CI_Controller{

	
	function Affiliates()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Affiliate_model');
		$this->load->model('Customer_model');		
	}
	
	
	function index()
	{
		$this->checkLogin();

		$data['current_page'] = 'affiliate-home';
		$data['firstname'] = $this->session->userdata('user_firstname');
		//$this->load->view('affiliate-home',$data);
		redirect('index.php');
		exit;
			
	}
	
	
	function checkLogin()
	{
		if($this->session->userdata('affiliate_id') && $this->session->userdata('customer_id')
									&& $this->session->userdata('affiliate_login')==true)
		{	
			return true;
		}
		
		redirect('/affiliates/signin');
		exit;
			
	}
	
	function site()
	{
		
		$this->checkLogin();
		
		$this->form_validation->set_rules('Update', 'Update','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['p'] = (object) $_POST;
			
			if(!$_POST)
			{
				$data['user'] = $this->Affiliate_model->get_affiliate($this->session->userdata['customer_id']);
			}
				
			$data['current_page'] = 'affiliate-site';
			$this->load->view('affiliate-site',$data);
		}
		else
		{
			$fname = $this->_doUpload($this->session->userdata['customer_id']);
                        
			if($this->Affiliate_model->update_Site($this->input->post(),$fname))
			{
				$this->session->set_flashdata('message','Affiliate site settings updated.');
			}
			
			redirect('/affiliates/site');
			exit;
		}
	}
	
	function _doUpload($customer_id) {
	
		$filename = md5($customer_id).'-logo';

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES['logo']);
		if(!$this->imaging->uploaded)
		{
			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			$this->imaging->image_resize = true;
			//$this->imaging->image_ratio = true;
			$this->imaging->image_crop = array(0,0,0,0);
			$this->imaging->image_x = 200;
			$this->imaging->image_y = 75;
			$this->jpeg_quality     = 100;
			$this->imaging->process('uploads/');
			
			if($this->imaging->processed)
			{
				return $this->imaging->file_dst_name;
			}
			else
			{
				die('Image upload Error: '.$this->imaging->error.'failed');
				return false;
			}
		}

	}
	
	function password()
	{
		
		$this->checkLogin();
		
		$this->form_validation->set_rules('oldpassword', 'Old Password','required');
		$this->form_validation->set_rules('newpassword', 'New Password','required');
		$this->form_validation->set_rules('confpassword', 'Password Confirmation','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{		
			$data['user'] = $this->Affiliate_model->get_affiliate($this->session->userdata['customer_id']);
			$this->load->view('affiliate-password',$data);
		}
		else
		{
			if($this->Affiliate_model->update_Password($this->input->post()))
			{
					$this->session->set_flashdata('message','Your password has been changed.');

			}
			
			redirect('/affiliates/password');
			exit;
		}		
		
	}
	
	
	
	function profile()
	{
		
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
		$this->form_validation->set_rules('evephone', 'Day Phone','callback_valid_phone_numer');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{

			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['p'] = (object) $_POST;
			
			if(!$_POST)
			{
				$data['user'] = $this->Affiliate_model->get_affiliate($this->session->userdata['customer_id']);
			}
				
			$data['current_page'] = 'affiliate-profile';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('affiliate-profile',$data);
		}
		else
		{
			if($id=$this->Affiliate_model->update_Profile($this->input->post()))
			{
				$this->session->set_flashdata('message','Your Profile is updated');
			}
			
			redirect('/affiliates/profile');
			exit;
		}
	}
	
	function orders()
	{
		
		$this->checkLogin();
		
		$data['orders'] = $this->Affiliate_model->get_orders($this->session->userdata['customer_id']);
		$data['current_page'] = 'affiliate-orders';
		$this->load->view('affiliate-orders',$data);
	}
	
	function commissions()
	{
		
		$this->checkLogin();
		
		$last_payment = $this->Affiliate_model->get_last_payment($this->session->userdata['customer_id']);
		$data['orders'] = $this->Affiliate_model->get_affiliate_orders($this->session->userdata['customer_id'], $last_payment ? $last_payment->payment_date:'');
		$commission = $this->Affiliate_model->get_commission($this->session->userdata['customer_id']);
		$data['commission'] = $commission->affiliate_commission;
		$data['current_page'] = 'affiliate-commissions';
		$data['last_payment'] = $last_payment ? $last_payment->payment_date:'';
		$this->load->view('affiliate-commissions',$data);
	}
	
	
	function integration()
	{
		
		$this->checkLogin();
		
		$data['user'] = $this->Affiliate_model->get_affiliate($this->session->userdata['customer_id']);
		$data['current_page'] = 'affiliate-integration';
		$this->load->view('affiliate-integration',$data);		
	}
	
	function logout()
	{	
		$this->session->set_userdata('affiliate_login',false);
		
		$this->session->unset_userdata('affiliate_id');
		$this->session->unset_userdata('customer_id');
		$this->session->unset_userdata('user_firstname');
		$this->session->unset_userdata('user_lastname');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('affiliate_login');
		redirect('/affiliates');
		exit;
	}
	
	function signin()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		if($this->form_validation->run()==FALSE)
		{
			$data['page'] = $this->Pages_model->return_page('affiliate-signin');
			$this->load->view('affiliates-signin');			
		}
		else
		{
			if($user = $this->Affiliate_model->login($this->input->post()))
			{
				$this->session->set_userdata('affiliate_id',$user->user_id);
				$this->session->set_userdata('customer_id',$user->user_id);
				$this->session->set_userdata('user_firstname',$user->user_firstname);
				$this->session->set_userdata('user_lastname',$user->user_lastname);
				$this->session->set_userdata('username',$user->user_name);
				$this->session->set_userdata('affiliate_login',true);
				//redirect('/affiliates');
				redirect('/index.php');
				exit;
			}
			else
			{
				$data['page'] = $this->Pages_model->return_page('affiliate-signin');
				$data['message'] = 'Invalid Login! Please try again';
				$this->load->view('affiliates-signin',$data);
			}
		}

	}
	
	
	function signup()
	{
		
		$this->form_validation->set_rules('username', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,0]');
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('password2', 'Confirm Password','required|callback_matchpass[password2,0]');
		$this->form_validation->set_rules('email', 'Email','required|valid_email|callback_unique_check[user_email,0]');
		$this->form_validation->set_rules('firstname', 'First Name','required');
		$this->form_validation->set_rules('lastname', 'Last Name','required');
		$this->form_validation->set_rules('business', 'Business','max_length[150]');
		$this->form_validation->set_rules('address1', 'Address','required');
		$this->form_validation->set_rules('address2', 'Address Line 2','max_length[150]');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('postalcode', 'Postalcode','max_length[10]|min_length[4]');
		$this->form_validation->set_rules('province2', 'Other Province','max_length[45]|callback_province_check');
		$this->form_validation->set_rules('country_id', 'Country','required|numeric');
		$this->form_validation->set_rules('phone1', 'Day Phone','required|callback_valid_phone_numer');
		$this->form_validation->set_rules('phone2', 'Day Phone','callback_valid_phone_numer');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['p'] = (object) $_POST;
			$data['current_page'] = 'signup';
			$data['page'] = $this->Pages_model->return_page('affiliate-signup');
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('affiliate-form',$data);
		}
		else
		{
			if($id=$this->Affiliate_model->signup($this->input->post()))
			{
				$data['current_page'] = 'affiliate-signup';
				$data['page'] = $this->Pages_model->return_page('affiliate-signup');
				$data['message'] = 'Successfully created the Affiliate Account!';
				$this->load->view('affiliate-thankyou',$data);				
			}
			else
			{
				$this->load->view('404');
			}
		}
	}
	
	function delete($id)
	{
		
		$this->Affiliate_model->delete($id);
		redirect('/');
		exit;
	}
	
	
	function edit($id)
	{
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,'.$id.']');
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
			$this->load->view('admin/customer-form',$data);
		}
		else
		{
			$this->Customer_model->update($this->input->post());
			redirect('siteadmin/customers');
			exit;
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
		
		if($this->Affiliate_model->is_exists($value,$field,$id))
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
	
	function reports()
	{
		$type = isset($_POST['report_type']) ? $_POST['report_type']:'';
		
		if(!empty($type))
		{			
			switch(strtolower($type))
			{
				case 'product' :
				{

					$data['records'] = $this->Affiliate_model->reportProducts($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-products';
					break;
				}
				case 'invoice' :
				{
					$data['records'] = $this->Affiliate_model->reportInvoice($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-invoice';
					break;
				}
				case 'customer' :
				{
					$data['records'] = $this->Affiliate_model->reportCustomer($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-customer';
					break;
				}
				case 'occasion' :
				{
					$data['records'] = $this->Affiliate_model->reportOccasion($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-occasion';
					break;
				}
				case 'yearly' :
				{
					$data['records'] = $this->Affiliate_model->reportYearly($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-yearly';
					break;
				}
				case 'monthly' :
				{
					$data['records'] = $this->Affiliate_model->reportMonthly($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-monthly';
					break;
				}
				case 'daily' :
				{
					$data['records'] = $this->Affiliate_model->reportDaily($this->session->userdata('affiliate_id'),$_POST);
					$view = 'affiliate-report-daily';
					break;
				}
				default :
				{
					break;
				}
				
			}
			
			$this->load->view($view,$data);

			
		}
		else
		{
			$this->load->view('affiliate-reports');				
		}
		
	
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
			if($user = $this->Affiliate_model->retrieve_account($this->input->post()))
			{
		
				if($email = get_message('forget-password'))
				{
					
						$message = $email->message_text;
						$title = $email->message_title;
					
					
					$message = str_replace('{FIRSTNAME}',$user->user_firstname,$message);
					$message = str_replace('{LASTNAME}',$user->user_lastname,$message);
					$message = str_replace('{USERNAME}',$user->user_name,$message);
					$message = str_replace('{PASSWORD}',$user->user_password,$message);
					$message = str_replace("\n",'<br/>',$message);
					
					$this->load->library('email');
					
					$email_config['mailtype'] = 'html';
					$email_config['protocol'] = 'mail';
					
					$this->email->initialize($email_config);
					
					$this->email->from('myaccount@memorialflowers.ca', 'Memorial Flowers');
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





}
