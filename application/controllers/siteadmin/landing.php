<?php

class Landing extends CI_Controller{
	
	function Landing()
	{
		parent::__construct();
		
		if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		if(!accessGrant('products'))
		{
			redirect('/siteadmin');
			exit;
		}
		
		$this->load->model('Product_model');
		$this->load->helper('url'); 
		$this->load->helper('form'); 
		$this->load->library('form_validation');
		
		
	}
	
	function filtered()
	{
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_filteredProducts($_POST);
		$this->load->view('admin/products',$data);
	}
	
	function index()
	{
		
		/*$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_products_enhanced();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();*/
		
		
		
		$this->load->model('Landing_model');
		$data['landing_pa'] = $this->Landing_model->allpages();
		
		
		
		$this->load->view('admin/landing',$data);
	}
	
	function keywords()
	{
		
		/*$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_products_enhanced();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();*/
		
		
		
		$this->load->model('Landing_model');
		$data['landing_pa'] = $this->Landing_model->allkeyword();
		
		
		
		$this->load->view('admin/keyword',$data);
	}
	
	
	function create()
	{
	
		$this->form_validation->set_rules('landing_group', 'Landing Group','required');
		$this->form_validation->set_rules('landing_city', 'Landing City','required');
		$this->form_validation->set_rules('landing_h1', 'Landing H1','required');
		/*$this->form_validation->set_rules('subcategory_id[0]','Sub Category','required');
		$this->form_validation->set_rules('delivery_method_id', 'Delivery Method','required');	
		$this->form_validation->set_rules('group_id', 'Location Group','required');
		$this->form_validation->set_rules('delivery_policy_id', 'Deliver Policy','required');
		$this->form_validation->set_rules('substitution_policy_id', 'Substitution Policy','required');
		$this->form_validation->set_rules('product_picture', 'Picture','callback_valid_image[product_picture]');*/
		//$this->form_validation->set_rules('product_description', 'Product Description','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{

			/*$this->load->model('Deliverymethod_model');
			$this->load->model('Group_model');
			$this->load->model('Addon_model');	
			$this->load->model('Occasion_model');		
			$this->load->model('Category_model');	
			$this->load->model('Policies_model');
			$this->load->model('Color_model');
			$this->load->model('Subcategory_model');*/
			
			/*$data['products'] = $this->Product_model->get_products();
			
			$data['colors'] = $this->Color_model->get_colors();
			$data['occasions'] = $this->Occasion_model->get_occasions();
			$data['categories'] = $this->Category_model->get_categories();
			$data['subcategories'] = $this->Subcategory_model->get_subcategories();
			$data['policies'] = $this->Policies_model->get_policies();
			$data['locgroups'] = $this->Group_model->get_groups();
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
			$data['addons'] = $this->Addon_model->get_addons();*/
			
			$this->load->model('Landing_model');
			
			$data['action'] = 'Create';
			$data['this_class'] = get_class($this);
			
			$data['landing_groups'] = $this->Landing_model->allgroups();
			$data['cities'] = $this->Landing_model->allcities();
			
			
			
			
					
			$this->load->view('admin/landing-form',$data);
			
		}
		else
		{
			
			$this->load->model('Landing_model');
			
			/*if(!$image = $this->_doUpload($_POST['landing_city']))
				$image='';*/
			$this->Landing_model->create($this->input->post());
			//$this->Productgroup_model->create($this->input->post());
			
			redirect('siteadmin/landing');
			exit;
			
		}
	}
	
	
	function unique_check($value,$params)
	{
		list($field,$id) = explode(',',$params);
		
		if($this->Product_model->is_exists($value,$field,$id))
		{
			$this->form_validation->set_message('unique_check', 'This %s is already exits, Please provide new one');
			return FALSE;			
		}
		else
		{
			return TRUE;
		}		
	}
	
	function _doUpload($product) {
	
		$filename = url_title($product).'_'.date('YdmHis',time());

		$this->load->library('Imaging');
		$this->imaging->upload($_FILES['product_picture']);
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
				return false;
			}
		}

	}  
	
	
	function delete($id)
	{
		$prod = $this->Product_model->get_product($id);
		if($this->Product_model->delete($id))
		{
			@unlink('productres/'.$prod->product_picture);
		}
		redirect('siteadmin/landing');
		exit();
	}
	
	function valid_image() {
	
	   $field = 'product_picture';
	
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
		$this->load->model('Landing_model');
		
	
		/*$this->form_validation->set_rules('product_name', 'Product Name','required');
		$this->form_validation->set_rules('product_code', 'Product Code','required|callback_unique_check[product_code,'.$id.']');
		$this->form_validation->set_rules('category_id', 'Category','required');
		$this->form_validation->set_rules('delivery_method_id', 'Delivery Method','required');	
		$this->form_validation->set_rules('group_id', 'Location Group','required');
		$this->form_validation->set_rules('delivery_policy_id', 'Deliver Policy','required');*/
		$this->form_validation->set_rules('landing_group', 'Landing Group','required');
		$this->form_validation->set_rules('landing_city', 'Landing City','required');
		$this->form_validation->set_rules('landing_h1', 'Landing H1','required');
		
		//$this->form_validation->set_rules('substitution_policy_id', 'Substitution Policy','required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
		
			if(! $_POST)
			{
			//	$this->load->model('Landing_model');
				$data['lan'] = $this->Landing_model->get_landing_city($id);
				
			}

			/*$this->load->model('Deliverymethod_model');
			$this->load->model('Group_model');
			$this->load->model('Occasion_model');
			$this->load->model('Category_model');
			$this->load->model('Addon_model');
			$this->load->model('Policies_model');
			$this->load->model('Color_model');
			$this->load->model('Subcategory_model');*/
			
			//$this->load->model('Landing_model');
				
			$data['action'] = 'Update';
			$data['this_class'] = get_class($this);
			$data['landing_groups'] = $this->Landing_model->allgroups();
			$data['cities'] = $this->Landing_model->allcities();
			
			
			$data['lan'] = $this->Landing_model->get_landing_city($id);
			
			/*$data['products'] = $this->Product_model->get_products();
			
			$data['colors'] = $this->Color_model->get_colors();
			$data['occasions'] = $this->Occasion_model->get_occasions();
			$data['categories'] = $this->Category_model->get_categories();
			$data['subcategories'] = $this->Subcategory_model->get_subcategories();
			$data['policies'] = $this->Policies_model->get_policies();
			$data['locgroups'] = $this->Group_model->get_groups();
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
			$data['addons'] = $this->Addon_model->get_addons();*/
					
			$this->load->view('admin/landingedit-form',$data);
			
		}
		else
		{
			
			
		
		//$a12 = ucfirst($a12);
		//echo $a11.' '.$a12.' '.$a13;
		
			
			/*if($image = $this->_doUpload($_POST['product_name']))
			{
				$prod = $this->Product_model->get_product($id);
				if($image!=$prod->product_picture)
				@unlink('productres/'.$prod->product_picture);
			}*/
			
			$this->Landing_model->update($this->input->post());
			redirect('siteadmin/landing');
			exit;
			
		}
	}
	
	
	function linking()
	{
		if($_POST)
		{
			$this->Product_model->updateUrls($_POST);
			
			redirect('/siteadmin/products/linking');
			exit;
		}
		else
		{
			$data['products'] = $this->Product_model->get_products();
			$this->load->view('admin/product-links.php',$data);
		}
		
	}
	
}
