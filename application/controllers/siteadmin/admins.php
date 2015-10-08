<?php

class Admins extends CI_Controller{

	
	function Admins()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('admins'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		
		$this->load->helper('url'); 
		$this->load->helper('form');		
		$this->load->library('form_validation');
		$this->load->model('Admin_model');	
	}
	
	
	function index()
	{
		$data['this_class'] = get_class($this);
		$data['admins'] = $this->Admin_model->getAdmins();
		$this->load->view('admin/admins',$data);
	}
	
	function delete($id)
	{
		$this->Admin_model->delete($id);
		redirect('siteadmin/admins');
		exit;
	}
	
	function create()
	{
	
		$this->form_validation->set_rules('user_name', 'User Name','required|min_length[5]|max_length[10]|callback_unique_check[user_name,0]');
		$this->form_validation->set_rules('user_password', 'Password','required');
		$this->form_validation->set_rules('user_email', 'Email','required|valid_email|callback_unique_check[user_email,0]');
		$this->form_validation->set_rules('user_firstname', 'First Name','required');
		$this->form_validation->set_rules('user_lastname', 'Last Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['sections'] = $this->Admin_model->getSections();
			$data['action'] = 'Create';
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			$this->load->view('admin/admin-form',$data);
		}
		else
		{
			$this->Admin_model->create($this->input->post());
			redirect('siteadmin/admins');
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
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			if( ! $_POST)
			{
				$data['admin'] = $this->Admin_model->getAdmin($id);
			}
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['action'] = 'Update';
			$data['sections'] = $this->Admin_model->getSections();
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces_name('Canada','United States');
			
			$this->load->view('admin/admin-form',$data);
		}
		else
		{
			$this->Admin_model->update($this->input->post());
			redirect('siteadmin/admins');
			exit;
		}
	}
	
	
	function unique_check($value,$params)
	{
		list($field,$id) = explode(',',$params);
		
		if($this->Admin_model->is_exists($value,$field,$id))
		{
			$this->form_validation->set_message('unique_check', 'This %s is already exits, Please provide new one');
			return FALSE;			
		}
		else
		{
			return TRUE;
		}		
	}
	

}
