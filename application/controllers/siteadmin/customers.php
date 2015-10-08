<?php

class Customers extends CI_Controller{

	
	function Customers()
	{
		parent::__construct();
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('customers'))
		{
			redirect('/siteadmin');
			exit;
		}	
		
		
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Customer_model');	
	}
	
	function index()
	{
		$data['this_class'] = get_class($this);
		$data['customers'] = $this->Customer_model->get_customers();
		$this->load->view('admin/customers',$data);
	}
	
	function search()
	{
		$string = $_POST['search'];
		$total= $this->Customer_model->count_customers();
		$per_pg=20;
		$offset=$this->uri->segment(4);
		
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item('base_url').'/siteadmin/customers/browse';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_pg;
		$config['uri_segment'] = 4;
		$config['page_query_string'] = FALSE;
		$config['next_link'] = '&raquo;';
		$config['prev_link'] = '&laquo;';
		$config['full_tag_open'] = '<div class="pagination"> Pages: ';
		$config['full_tag_close'] = '</div>';
	
		$this->pagination->initialize($config);
	
		$data['this_class'] = get_class($this);
		$data['customers'] = $this->Customer_model->search_customers($string);
		$this->load->view('admin/customers',$data);
	}
	
	function delete($id)
	{
		$this->Customer_model->delete($id);
		redirect('siteadmin/customers');
		exit;
	}
	
	function create()
	{
	
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,0]');
		$this->form_validation->set_rules('user_password', 'Password','required');
		$this->form_validation->set_rules('user_email', 'Email','required|valid_email|callback_unique_check[user_email,0]');
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
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Create';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('admin/customer-form',$data);
		}
		else
		{
			$this->Customer_model->create($this->input->post());
			redirect('siteadmin/customers');
			exit;
		}
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
		$this->form_validation->set_rules('user_discount','Discount','numeric');
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
		if(trim(strlen($value)==0) && trim(strlen($_POST['user_province2'])==0))
		{
			$this->form_validation->set_message('province_check', 'Please select a %s');
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
