<?php

class Addons extends CI_Controller{
	
	function Addons()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('addons'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->model('Addon_model');
		$this->load->helper('url'); 
		$this->load->helper('form'); 
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['this_class'] = get_class($this);
		$data['addons'] = $this->Addon_model->get_addons();
		$this->load->view('admin/addons',$data);
	}
	
	function create()
	{
	
		$this->form_validation->set_rules('addon_name', 'Addon Name','required');
		$this->form_validation->set_rules('option[0]', 'Addon Price','required');
		$this->form_validation->set_rules('price[0]', 'Addon Price','required');
		$this->form_validation->set_rules('addon_picture', 'Picture','callback_valid_image[addon_picture]');
		//$this->form_validation->set_rules('product_description', 'Product Description','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{

				
			$data['action'] = 'Create';
			$data['this_class'] = get_class($this);
			$this->load->model('Deliverymethod_model');
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
								
			$this->load->view('admin/addon-new',$data);
			
		}
		else
		{
			if(!$image = $this->_doUpload($_POST['addon_name']))
				$image='';
			
			$this->Addon_model->create($this->input->post(),$image);
			redirect('siteadmin/addons');
			exit;
			
		}
	}
	
	function _doUpload($product) {
	
		$filename = url_title($product);

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES['addon_picture']);
		if(!$this->imaging->uploaded)
		{

			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			$this->imaging->image_resize = true;
			$this->imaging->ratio = false;
			$this->imaging->image_x = 330;
			$this->imaging->image_y = 330;
			$this->jpeg_quality     = 100;
			$this->imaging->process('productres/');
			
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
	
	function _processImg($fileName,$thumbName) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'productres/' . $fileName;							
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 350;
		$config['height'] = 350;

		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		if($this->image_lib->resize())
		{
			$config['new_image'] = 'productres/' . $thumbName;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 60;
			$config['height'] = 60;
			
			$this->image_lib->initialize($config);
			if($this->image_lib->resize())
			{
				return TRUE;				
			}
			else 
			{
				return FALSE;				
			}
		}
		else
		{
			return FALSE;			
		}
	}
	
	
	function delete($id)
	{
		$this->Addon_model->delete($id);
		redirect('siteadmin/addons');
		exit();
	}
	
	function valid_image() {
	
	   $field = 'addon_picture';
	
	    //Check for image upload
	    if(!isset($_FILES[$field])) {
	        $this->form_validation->set_message('valid_image', 'Image required');
	        return false;
	    }
	    
	    //Check for file size
	    if($_FILES[$field]['size'] == 0) {
	        $this->form_validation->set_message('valid_image', 'Image required');
	        return false;
	    }
	    
	    //Check for upload errors
	    if($_FILES[$field]['error'] != UPLOAD_ERR_OK) {
	        $this->validation->set_message('valid_image', 'Upload failed');
	        return false;
	    }
	    
	    //Check for valid image upload
	    $imginfo = getimagesize($_FILES[$field]['tmp_name']);
	    if(!$imginfo) {
	        $this->form_validation->set_message('valid_image', 'Only image files are allowed');
	        return false;
	    }
	    
	    //Check for valid image types
	    if( !($imginfo[2] == 1 || $imginfo[2] == 2 || $imginfo[2] == 3) ) {
	        $this->form_validation->set_message('valid_image', 'Only GIF, JPG and PNG files accepted');
	        return false;
	    }
	    
	    //Check for existing image	    
	    return true;
	} 
	
	
	function edit($id)
	{
	
		$this->form_validation->set_rules('addon_name', 'Addon Name','required');
		$this->form_validation->set_rules('price', 'Addon Price','required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
		
			if(! $_POST)
			{
				$data['addon'] = $this->Addon_model->get_addon($id);
			}	
				
			$data['action'] = 'Update';
			$data['this_class'] = get_class($this);
			
			$this->load->model('Deliverymethod_model');
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
					
			$this->load->view('admin/addon-form',$data);
			
		}
		else
		{
			if($image = $this->_doUpload($_POST['addon_name']))
			{
				$add = $this->Addon_model->get_addon($id);
				if($image!=$add->addon_picture)
					@unlink('productres/'.$add->addon_picture);
			}
							
			$this->Addon_model->update($this->input->post(),$image);
			redirect('siteadmin/addons');
			exit;
			
		}
	}
	
}
