<?php

class Tiles extends CI_Controller {
	
	function Tiles()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('tiles'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Banner_model');
		$this->load->model('Pages_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	
	
	}
	
	function index()
	{
		$data['banners']=$this->Banner_model->get_tiles();
		$this->load->view('admin/tiles',$data);
	}
	
	function delete($id)
	{
		$bann = $this->Banner_model->get_banner($id);
		if($this->Banner_model->delete($id))
		{
			@unlink('banners/'.$prod->banner_picture);
		}
		redirect('siteadmin/tiles');
		exit();
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('banner_name', 'Banner Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['banner'] = $this->Banner_model->get_banner($id);
				$data['pages'] = $this->Pages_model->get_pages();
			}
					
			$data['action'] = 'Update';
			$this->load->view('admin/tile-form',$data);
		}
		else
		{
			if($image = $this->_doUpload($_POST['banner_name']))
			{
				$bann = $this->Banner_model->get_banner($id);
				if($image!=$bann->banner_file)
				@unlink('banners/'.$bann->banner_file);
			}
			
			$this->Banner_model->updateTile($this->input->post(),$image);
			redirect('/siteadmin/tiles');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('banner_name', 'Banner Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/tile-form',$data);
		}
		else
		{
			if(!$image = $this->_doUpload($_POST['banner_name']))
				$image='';

			$this->Banner_model->createTile($this->input->post(),$image);
			redirect('/siteadmin/tiles');
			exit;
		}
	}
	
	function _doUpload($name) {
	
		$filename = url_title($name);

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES['banner_file']);
		if(!$this->imaging->uploaded)
		{
			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			$this->imaging->image_resize = false;
			$this->imaging->ratio = true;
			//$this->imaging->image_x = 316;
			//$this->imaging->image_y = 129;
			$this->jpeg_quality     = 100;
			$this->imaging->process('banners/');
			
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
	
	
}
