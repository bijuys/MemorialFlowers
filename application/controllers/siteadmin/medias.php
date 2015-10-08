<?php

class Uploads extends CI_Controller {
	
	function Uploads()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		if(!accessGrant('uploads'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Upload_model');
		$this->load->model('Pages_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['uploads']=$this->Upload_model->get_pictures();
		$this->load->view('admin/pictures',$data);
	}
	
	function delete($id)
	{
		$bann = $this->Banner_model->get_picture($id);
		if($this->Picture_model->delete($id))
		{
			@unlink('pictures/'.$prod->picture_picture);
		}
		redirect('siteadmin/pictures');
		exit();
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('picture_name', 'Picture Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			if(! $_POST)
			{
				$data['picture'] = $this->Picture_model->get_picture($id);
				$data['pages'] = $this->Picture_model->get_pages();
			}
					
			$data['action'] = 'Update';
			$this->load->view('admin/picture-form',$data);
		}
		else
		{
			if($image = $this->_doUpload($_POST['picture_name'],'picture_file'))
			{
				$pic = $this->Picture_model->get_picture($id);
				if($image!=$pic->picture_file)
					@unlink('media/'.$pic->picture_file);
			}
			
			if($image_fr = $this->_doUpload($_POST['banner_name_fr'],'banner_file_fr'))
			{
				$bann = $this->Banner_model->get_banner($id);
				if($image!=$bann->banner_file_fr)
					@unlink('banners/'.$bann->banner_file_fr);
			}
			
			$this->Banner_model->update($this->input->post(),$image,$image_fr);
			redirect('/siteadmin/banners');
			exit;
		}
	}
	
	function create()
	{
	
		$data = array();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['action']='Create';
		
		$this->form_validation->set_rules('banner_name', 'Banner Name','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$data['action'] = 'Create';
			$this->load->view('admin/banner-form',$data);
		}
		else
		{			
			if(!$image = $this->_doUpload($_POST['banner_name'],'banner_file'))
				$image='';
				
			if(!$image_fr = $this->_doUpload($_POST['banner_name'].'fr','banner_file_fr'))
				$image_fr='';

			$this->Banner_model->create($this->input->post(),$image,$image_fr);
			redirect('/siteadmin/banners');
			exit;
		}
	}
	
	function _doUpload($name,$up) {
	
		$filename = url_title($name);

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES[$up]);
		if(!$this->imaging->uploaded)
		{
			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			//$this->imaging->image_resize = true;
			//$this->imaging->ratio = false;
			//$this->imaging->image_x = 570;
			//$this->imaging->image_y = 75;
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
