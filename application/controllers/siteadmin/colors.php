<?php

class Colors extends CI_Controller {
	
	function Colors()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('colors'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Color_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['colors']=$this->Color_model->get_colors();
		$this->load->view('admin/colors',$data);
	}
	
	function delete($id)
	{
		$this->Color_model->delete($id);
		redirect('/siteadmin/colors');
		exit;
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('color_name', 'Color Name','required');
		//$this->form_validation->set_rules('color_code', 'Color Code','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['color'] = $this->Color_model->get_color($id);
			}

			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['action'] = 'Update';
			$this->load->view('admin/color-form',$data);
		}
		else
		{
			$this->Color_model->update($this->input->post());
			redirect('/siteadmin/colors');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('color_name', 'Color Name','required');
		//$this->form_validation->set_rules('color_code', 'Color Code','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['action'] = 'Create';
			$this->load->view('admin/color-form',$data);
		}
		else
		{
			$this->Color_model->create($this->input->post());
			redirect('/siteadmin/colors');
			exit;
		}
	}
	
	
}
