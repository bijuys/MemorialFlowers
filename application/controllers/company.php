<?php

class Company extends CI_Controller{

	
	function Company()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Company_model');	
		$this->customerid = $this->session->userdata('customer_id');
	}
	
	function index()
	{
		$this->checkLogin();
		
		$data['current_page'] = 'company-home';
		$data['user'] = $this->Company_model->get_company($this->session->userdata['customer_id']);
		$this->load->view('company-home',$data);		
		
		
	}
	
	
	function orders()
	{
		$this->checkLogin();
		
		$data['orders'] = $this->Company_model->get_orders($this->session->userdata['customer_id']);
		$data['current_page'] = 'company-orders';
		$this->load->view('company-orders',$data);
	}
	
	
	function customers()
	{
		
		$data['customers'] = $this->Company_model->get_customers($this->customerid);
		
		$this->load->view('company-customers',$data);
		
	}
	
	
	function checkLogin()
	{

		if($this->session->userdata('customer_id') && $this->session->userdata('company_login')==true)
		{
			return true;
		}

		redirect('/company/signin');
		exit;
		
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
			$data['user'] = $this->Company_model->get_company($this->session->userdata['customer_id']);
			$this->load->view('company-password',$data);
		}
		else
		{
			if($this->Company_model->update_Password($this->input->post()))
			{
				$this->session->set_flashdata('message','Password succesfully updated.');
			}
			else
			{
				$this->session->set_flashdata('message','Password not changed.');
			}
			
			redirect('/company/password');
			exit;
			
		}		
		
	}
	
	function discount()
	{
	
		$this->checkLogin();
		
		$this->form_validation->set_rules('company_code', 'Signup Code','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['p'] = (object) $_POST;
			
			if(!$_POST)
			{
				$data['user'] = $this->Company_model->get_company($this->session->userdata['customer_id']);
			}
				
			$data['current_page'] = 'company-code';
			$this->load->view('company-code',$data);
		}
		else
		{
			if($id=$this->Company_model->update_Discount($this->input->post()))
			{
				$this->session->set_flashdata('message','Discount settings updated');
			}
			else
			{
				$this->session->set_flashdata('message','<span class="error">Settings not changed</span>');
			}

			redirect('/company/discount');
			exit;
		}
	}
	
	
	
	function payment()
	{
		$this->checkLogin();
		

		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if (!$_POST)
		{
			$data['user'] = $this->Company_model->get_company($this->session->userdata['customer_id']);
				
			$data['current_page'] = 'company-payment';
			$this->load->view('company-payment',$data);
		}
		else
		{
			if($id=$this->Company_model->update_Payment($this->input->post()))
			{
				$this->session->set_flashdata('message','Payment method is updated');
			}
			else
			{
				$this->session->set_flashdata('message','<span class="error">Payment Method is changed!</span>');
			}

			redirect('/company/payment');
			exit;
		}
	}
	

	
	function profile()
	{
	
		$this->checkLogin();
		
		$this->form_validation->set_rules('firstname', 'First Name','required');

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
				$data['user'] = $this->Company_model->get_company($this->session->userdata['customer_id']);
			}
				
			$data['current_page'] = 'company-profile';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('company-profile',$data);
		}
		else
		{
			if($id=$this->Company_model->update_Profile($this->input->post()))
			{
				$data['current_page'] = 'update-profile';
				$data['message'] = '<p>Successfully updated your profile!</p>';
				$data['message'] .= '<p>You can now <a href="/signin">Signin to the Account</a></p>';
				redirect('/company');
				exit;
			}
			else
			{
				$this->load->view('404');
			}
		}
	}
	
	
	function signin()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_error_delimiters('<span class="error error_span">','</span>');
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('company-signin');			
		}
		else
		{
			if($user = $this->Company_model->login($this->input->post()))
			{
				$this->session->set_userdata('customer_id',$user->user_id);
				$this->session->set_userdata('user_firstname',$user->user_firstname);
				$this->session->set_userdata('user_lastname',$user->user_lastname);
				$this->session->set_userdata('user_role',$user->user_role);
				$this->session->set_userdata('username',$user->user_name);
				$this->session->set_userdata('company_login',true);
				if($user->referer_id>0)
					$this->session->set_userdata('referer',$user->referer_id);
				redirect('/company');
				exit;
			}
			else
			{
				$data['message'] = 'Invalid Login! Please try again';
				$this->load->view('company-signin',$data);
			}
		}

	}
	
	function logout()
	{

		$this->checkLogin();	
		
		$this->session->set_userdata('company_login',false);
			
		$this->session->unset_userdata('customer_id');
		$this->session->unset_userdata('user_firstname');
		$this->session->unset_userdata('user_lastname');
		$this->session->unset_userdata('is_company');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('company_login');
		
		redirect(site_url());
		exit;
	}
	
	function signup()
	{
		$this->form_validation->set_rules('username', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,0]');
		$this->form_validation->set_rules('password', 'Password','required');
		$this->form_validation->set_rules('password2', 'Confirm Password','required|callback_matchpass[password2,0]');
		$this->form_validation->set_rules('email', 'Email','required|valid_email|callback_unique_check[user_email,0]');
		$this->form_validation->set_rules('business', 'Company Name','required');
		$this->form_validation->set_rules('address1', 'Address','required');
		$this->form_validation->set_rules('address2', 'Address Line 2','max_length[150]');
		$this->form_validation->set_rules('city', 'City','required');
		$this->form_validation->set_rules('postalcode', 'Postalcode','max_length[10]|min_length[4]');
		$this->form_validation->set_rules('province2', 'Other Province','max_length[45]|callback_province_check');
		$this->form_validation->set_rules('country_id', 'Country','required|numeric');
		$this->form_validation->set_rules('dayphone', 'Phone Number','required|callback_valid_phone_numer');
		$this->form_validation->set_rules('evephone', 'Additional Phone','callback_valid_phone_numer');
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
			$this->load->view('company-form',$data);
		}
		else
		{
			if($id=$this->Company_model->signup($this->input->post()))
			{
				$data['current_page'] = 'signup';
				$data['message'] = '<h1>Thank you for the Signup</h1>
				<p>One of our officials will verify your information manually, 
				and we will let you know when account is activated. 
				This will be done within 24 hours on normal working days</p>
				<p><a href="/contact">Contact us</a> if you need an instant activation</p>';
				$this->load->view('company-thankyou',$data);				
			}
			else
			{
				die('<div id="error">Unexpected error, please try after sometime.</div>');
				exit;
			}
		}
	}
	
	function delete($id)
	{
		$this->checkLogin();
		
		$this->Company_model->delete($id);
		redirect('siteadmin/customers');
		exit;
	}
	
	
	function edit($id)
	{
		
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,'.$id.']');
		$this->form_validation->set_rules('user_password', 'Password','required');
		$this->form_validation->set_rules('user_email', 'Email','required|valid_email|callback_unique_check[user_email,'.$id.']');
		$this->form_validation->set_rules('user_business', 'Business','max_length[150]');
		$this->form_validation->set_rules('user_firstname', 'First Name','required');
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
				$data['customer'] = $this->User_model->get_customer($id);
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
			$this->Company_model->update($this->input->post());
			redirect('siteadmin/company');
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
		
		if($this->Company_model->is_exists($value,$field,$id))
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
