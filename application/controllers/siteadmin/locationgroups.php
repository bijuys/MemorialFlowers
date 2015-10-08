<?php

class Locationgroups extends CI_Controller {
	
	function Locationgroups()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('locationgroups'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Group_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['groups']=$this->Group_model->get_groups();
		$this->load->view('admin/locationgroups',$data);
	}
	
	function delete($id)
	{
		$this->Group_model->delete($id);
		redirect('/siteadmin/locationgroups');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('group_name', 'Group Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['group'] = $this->Group_model->get_group($id);
			}
			$this->load->model('Deliverymethod_model');
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces(1);
			$data['action'] = 'Update';
			$this->load->view('admin/group-form',$data);
		}
		else
		{
			$this->Group_model->update($this->input->post());
			redirect('/siteadmin/locationgroups');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('group_name', 'Group Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Deliverymethod_model');
			$this->load->model('Country_model');
			$this->load->model('Province_model');
			$data['this_class'] = get_class($this);
			$data['countries'] = $this->Country_model->get_countries();
			$data['provinces'] = $this->Province_model->get_provinces(1);
			$data['action'] = 'Create';
			$this->load->view('admin/group-form',$data);
		}
		else
		{
			$this->Group_model->create($this->input->post());
			redirect('/siteadmin/locationgroups');
			exit;
		}
	}
	
	
}
