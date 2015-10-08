<?php

class Slider extends CI_Controller {
	
	function Slider()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('slider'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->helper('url'); 
		$this->load->model('Product_model');
		$this->load->helper('form');		
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['sliders']=$this->Product_model->get_sliders();
		$this->load->view('admin/slider',$data);
	}
	
	
	function delete($id)
	{
		if($slide = $this->Product_model->get_slide($id))
		{
			if($this->Product_model->delete_Slide($id))
				@unlink('/productres/'.$slide->slide_picture);
			redirect('/siteadmin/slider');
			exit;
			
		}		
	}
	
	function edit($id)
	{
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('product_id', 'Product','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{				
			$data['action'] = 'Update';
			if($id)
			{
				$data['slider'] = $this->Product_model->get_slide($id);
			}
			$data['products'] = $this->Product_model->get_products();
			$data['slides'] = $this->Product_model->get_sliders();
			$this->load->view('admin/slider-form',$data);
		}
		else
		{
			$product = $this->Product_model->get_product_info($_POST['product_id']);
			$vars = array('product_id'=>$id,
					'price'=>$product->price_value,
					'req_order'=>$_POST['req_order']);
			
			$this->Product_model->update_Slide($this->input->post());
			redirect('/siteadmin/slider');
			exit;
		}
	}
	
	function create()
	{
		$data = array();
		$data['action']='Create';
		
		$this->form_validation->set_rules('product_id', 'Product','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
		if ($this->form_validation->run() == FALSE)
		{				
			$data['action'] = 'Create';
			$data['products'] = $this->Product_model->get_products();
			$data['slides'] = $this->Product_model->get_sliders();
			$this->load->view('admin/slider-form',$data);
		}
		else
		{
			$product = $this->Product_model->get_product_info($_POST['product_id']);
			$vars = array('source'=>$product->product_picture,
					'price'=>$product->price_value,
					'req_order'=>$_POST['req_order']);
			
			$this->Product_model->create_Slide($this->input->post());
			redirect('/siteadmin/slider');
			exit;
		}		
	}
	
	function customSlide() {
		
		$filename = 'sl_temp'; 
		
		$config['upload_path'] = 'productres/';  
		$config['allowed_types'] = 'jpg';    
		$config['file_name'] = $filename;
			
		$this->load->library('upload', $config);  
	   
		if(!$this->upload->do_upload('product_picture')) 
		{
		   return FALSE;
		}  
		else 
		{
		    $data = $this->upload->data();
		    return $data['file_name']; 
		}  
	}  
	
	function create_SliderImage($vars)
	{
		$newname = 'sl_'.$vars['source'];
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_SERVER["DOCUMENT_ROOT"].'/productres/'.$vars['source'];
		$config['new_image'] = $_SERVER["DOCUMENT_ROOT"].'/productres/'.$vars['newfile'];
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = 'height';
		$config['width'] = 265;
		
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		
		if($this->image_lib->resize())
		{
			$this->image_lib->clear();
			unset($config);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $_SERVER["DOCUMENT_ROOT"].'/productres/'.$vars['newfile'];
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 245;
			$config['height'] = 326;
			$config['y_axis'] = 10;
			$config['x_axis'] = 10;
			$this->image_lib->initialize($config);
			
			if($this->image_lib->crop())
			{
				$this->image_lib->clear();
				unset($config);
				$config['image_library'] = 'gd2';				
				$config['source_image'] = $_SERVER["DOCUMENT_ROOT"].'/productres/'.$vars['newfile'];
				$config['wm_type'] = 'overlay';
				$config['wm_x_transp'] = '20';
				$config['wm_y_transp'] = '0';
				$config['wm_hor_alignment'] = 'left';
				$config['wm_vrt_alignment'] = $vars['place'];
				$config['wm_opacity']= $vars['color']=='white' ? '70':'40';
				$config['wm_overlay_path'] = $_SERVER["DOCUMENT_ROOT"].'/images/'.$vars['color'].'.gif';
				
				$this->image_lib->initialize($config);
				
				if($this->image_lib->watermark())
				{
					
					$this->image_lib->clear();
					unset($config);
					$config['image_library'] = 'gd2';				
					$config['source_image'] = $_SERVER["DOCUMENT_ROOT"].'/productres/'.$vars['newfile'];
					$config['wm_type'] = 'overlay';
					$config['wm_x_transp'] = '20';
					$config['wm_y_transp'] = '5';
					$config['wm_hor_alignment'] = 'left';
					$config['wm_vrt_alignment'] = 'top';
					$config['wm_opacity']= '100';
					$config['wm_overlay_path'] = $_SERVER["DOCUMENT_ROOT"].'/images/topshadow.png';
					
					$this->image_lib->initialize($config);
					if(!$this->image_lib->watermark())
						echo $this->image_lib->display_errors();
					
					echo '<img src="/productres/'.$vars['newfile'].'" />';
				}
				else
				{
					echo $this->image_lib->display_errors();
				}
				return $vars['newfile'];
			}
			else
				die($this->image_lib->display_errors());	
		}
		else
		{
			die($this->image_lib->display_errors());
		}
		
		
		
		
	}
	
	
	
		
}
