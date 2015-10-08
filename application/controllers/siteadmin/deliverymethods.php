<?php

class Deliverymethods extends CI_Controller {
	
	function Deliverymethods()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('deliverymethods'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Deliverymethod_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['deliverymethods']=$this->Deliverymethod_model->get_deliverymethods();
		$this->load->view('admin/deliverymethods.php',$data);
	}
	
	function delete($id)
	{
		/*
		$this->Deliverymethod_model->delete($id);
		redirect('/siteadmin/deliverymethods');
		exit;
		
		*/
	}
	
	function edit($id)
	{
	
		$data = array();
		$data['action']='Update';
		
		$this->form_validation->set_rules('delivery_method', 'Delivery Method','required');
		$this->form_validation->set_rules('delivery_within', 'Delivery in','numeric');
		$this->form_validation->set_rules('delivery_charge', 'Delivery Charge','numeric');
		$this->form_validation->set_rules('delivery_days[]', 'Week Day','callback_post_array_check');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Policies_model');
			
			$dmethod = $this->Deliverymethod_model->get_deliverymethod($id);
			$dmethod->delivery_days = explode(',',$dmethod->delivery_days);
			$data['policies'] = $this->Policies_model->get_policies();
			list($dmethod->delivery_hour,$dmethod->delivery_minute,$sc) = explode(':',$dmethod->stoppage_time);
			$data['deliverymethod'] = $dmethod;
			$data['this_class'] = get_class($this);	
			$data['action'] = 'Update';
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$this->load->view('admin/deliverymethod-form',$data);
		}
		else
		{
			if(!$image = $this->_doUpload($_POST['delivery_method']))
				$image='';
				
			$this->Deliverymethod_model->update($this->input->post(),$image);
			redirect('/siteadmin/deliverymethods');
			exit;
		}
	}
	
	function post_array_check($postar)
	{
		if(count($postar)>0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('post_array_check', 'Please select atleast one %s field');
			return FALSE;
		}
	}
	
	function create()
	{
	
		/*
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('delivery_method', 'Delivery Method','required');
		$this->form_validation->set_rules('delivery_within', 'Delivery in','numeric');
		$this->form_validation->set_rules('delivery_charge', 'Delivery Charge','numeric');
		$this->form_validation->set_rules('delivery_days[]', 'Week Day','callback_post_array_check');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Policies_model');
			$this->load->model('Banner_model');
			$data['banners'] = $this->Banner_model->get_banners();
			$data['pages'] = $this->Pages_model->get_pages();
			$data['policies'] = $this->Policies_model->get_policies();
			$data['this_class'] = get_class($this);	
			$data['action'] = 'Create';
			$this->load->view('admin/deliverymethod-form',$data);
		}
		else
		{
			if(!$image = $this->_doUpload($_POST['delivery_method']))
				$image='';
				
			$this->Deliverymethod_model->create($this->input->post(),$image);
			redirect('/siteadmin/deliverymethods');
			exit;
		}
		
		*/
	}
	
	
	
	
	function _doUpload($deliverymethod) {
	
		$filename = url_title($deliverymethod);

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES['icon_image']);
		if(!$this->imaging->uploaded)
		{

			return false;
		}
		else
		{
			$this->imaging->file_new_name_body = $filename;
			$this->imaging->image_resize = true;
			//$this->imaging->image_x = 330;
			$this->imaging->image_y = 15;
			$this->imaging->image_ratio_x        = true;
			$this->imaging->jpeg_quality     = 100;
			$this->imaging->process('uploads/');
			
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
