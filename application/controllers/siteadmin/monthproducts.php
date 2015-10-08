<?php

class Monthproducts extends CI_Controller {
	
	function Monthproducts()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('monthproducts'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Monthproduct_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['monthproducts']=$this->Monthproduct_model->get_months();
		$this->load->view('admin/monthproducts',$data);
	}
	
	function update($id)
	{
		if($_POST)
		{
			$pics['en'] = $this->_doUpload('picture');
			$pics['fr'] = $this->_doUpload('picture_fr');
			
			$this->Monthproduct_model->updateMonth($id,$_POST,$pics);
			
			redirect('/siteadmin/monthproducts');			
		}
		else
		{
			$this->load->model('Banner_model');
			
			$data['action']='Update';
			$data['products'] = $this->Monthproduct_model->get_products($id);
			$data['existing'] = $this->Monthproduct_model->get_assigned($id);
			$data['banners'] = $this->Banner_model->get_banners();
			$data['month'] = $this->Monthproduct_model->get_month($id);
			
			$this->load->view('admin/monthproduct-form',$data);
		}
	

		
	}
	
	function _doUpload($pic) {
	
		$filename = url_title($pic).'_'.date('YdmHis',time());

		$this->load->library('Imaging');
		
		if(is_uploaded_file($_FILES[$pic]['tmp_name'])) {
		
		$this->imaging->upload($_FILES[$pic]);
		if(!$this->imaging->uploaded)
		{

			return '';
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			$this->imaging->image_resize = true;
			$this->imaging->ratio = false;
			$this->imaging->image_x = 330;
			$this->imaging->image_y = 370;
			$this->jpeg_quality     = 100;
			$this->imaging->process('productres/');
			
			if($this->imaging->processed)
			{
				return $this->imaging->file_dst_name;
			}
			else
			{
				die('Image upload Error: '.$this->imaging->error.'failed');
				return '';
			}
		}
		
		}
		else
		{
			return '';
		}

	}  
	

	
	
}
