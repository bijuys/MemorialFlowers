<?php

class Picupload extends CI_Controller {
	
	function Picupload()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		$this->load->helper('form');
	}	
	
	function index() {
		$this->load->view('upload_form');
	}

	function doUpload() {
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		//$config['max_size'] = '1000';
		//$config['max_width'] = '1920';
		//$config['max_height'] = '1280';						

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()) echo $this->upload->display_errors();
		else {
			$fInfo = $this->upload->data();
			$this->_processImg($fInfo['file_name']);

			echo $fInfo."<br/>";
			echo $fInfo['raw_name'] . '_thumb' . $fInfo['file_ext'];
			//$this->load->view('upload_success', $data);
		}
	}
	
	
	function _processImg($fileName) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'uploads/' . $fileName;				
		//$config['create_thumb'] = TRUE;			
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 350;
		$config['height'] = 350;
		
		

		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
		
		$config['new_image'] = 'uploads/2' . $fileName;	
		$config['width'] = 200;
		$config['height'] = 200;		
		
		$this->image_lib->initialize($config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
		
		return true;
	}
	
	

	function _createThumbnail($fileName) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'uploads/' . $fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 150;
		$config['height'] = 150;

		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();
	}
	
}

	
