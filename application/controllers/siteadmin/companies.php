<?php

class Companies extends CI_Controller{

	
	function Companies()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('companies'))
		{
			redirect('/siteadmin');
			exit;
		}	
		
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Company_model');	
	}
	
	function index()
	{
		redirect('/siteadmin/companies/browse');
		exit;
	}
	
	function search()
	{
		$string = $_POST['search'];
		$total= $this->Company_model->count_companies();
		$per_pg=20;
		$offset=$this->uri->segment(4);
		
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item('base_url').'/siteadmin/companies/browse';
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
		$data['companies'] = $this->Company_model->search_companies($string);
		$this->load->view('admin/companies',$data);
	}	
	
	function browse()
	{
		$total= $this->Company_model->count_companies();
		$per_pg=20;
		$offset=$this->uri->segment(4);
		
		$this->load->library('pagination');
		$config['base_url'] = $this->config->item('base_url').'/siteadmin/companies/browse';
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
		$data['companies'] = $this->Company_model->get_companies($per_pg,$offset);
		$this->load->view('admin/companies',$data);
	}
	
	function delete($id)
	{
		$this->Affiliate_model->delete($id);
		redirect('siteadmin/affiliates');
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
		$this->form_validation->set_rules('affiliate_commission', 'Affiliate Commission','numeric');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Create';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('admin/company-form',$data);
		}
		else
		{
			$this->Company_model->create($this->input->post());
			redirect('siteadmin/companies');
			exit;
		}
	}
	
	
	function edit($id)
	{
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[10]');
		$this->form_validation->set_rules('user_password', 'Password','required');
		$this->form_validation->set_rules('user_email', 'Email','required|valid_email');
		$this->form_validation->set_rules('user_firstname', 'First Name','max_length[50]');
		$this->form_validation->set_rules('user_lastname', 'Last Name','max_length[50]');
		$this->form_validation->set_rules('user_business', 'Business','required|max_length[150]');
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
		$this->form_validation->set_rules('business_discount', 'Discount','numeric');
		$this->form_validation->set_error_delimiters('<div class="error">','</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			if( ! $_POST)
			{
				$data['company'] = $this->Company_model->get_company($id);
			}
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Update';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('admin/company-form',$data);
		}
		else
		{
			$this->Company_model->update($this->input->post());
			redirect('siteadmin/companies');
			exit;
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
