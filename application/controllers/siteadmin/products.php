<?php

class Products extends CI_Controller{
	
	function Products()
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
		
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_products_enhanced();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$this->load->view('admin/products',$data);
	}
	
	function merchandise()
	{
		
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['this_class'] = get_class($this);
		//$data['products'] = $this->Product_model->get_products_enhanced();
		$data['products'] = $this->Product_model->products_merchandise();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$this->load->view('admin/products-merchandise',$data);
	}
	
	function locations()
	{
		
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
		$this->load->model('Color_model');
		$this->load->model('Occasion_model');
		$data['this_class'] = get_class($this);
		$data['products'] = $this->Product_model->get_products_enhanced();
		$data['categories'] = $this->Category_model->get_categories();
		$data['subcategories'] = $this->Subcategory_model->get_subcategories();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['colors'] = $this->Color_model->get_colors();
		$this->load->view('admin/products-locations',$data);
	}
	
	function filtered_locations()
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
		$this->load->view('admin/products-locations',$data);
	}
	
	function update_locations()
	{
	
		$product_id = $this->input->post('product_id');
		$customer_page = $this->input->post('customer_page');
		if($customer_page!=1){
			$customer_page = 0;
		}
		$affiliate_page = $this->input->post('affiliate_page');
		if($affiliate_page!=1){
			$affiliate_page = 0;
		}
		$prices = $this->Product_model->get_product_prices($product_id);
		
		foreach($prices as $price){
			
			$price_id = $price->price_id;
			$price_val = $this->input->post('price_val_'.$price->price_id);
			$price_name = $this->input->post('price_name_'.$price->price_id);
			$price_customer = $this->input->post('price_customer_'.$price->price_id);
			$price_affiliate = $this->input->post('price_affiliate_'.$price->price_id);
			
			$this->Product_model->update_price($product_id,$price_id,$price_val,$price_name,$price_customer,$price_affiliate);
		
		}
		
		$this->Product_model->update_pro_info($product_id,$customer_page,$affiliate_page);
		
		redirect('/siteadmin/products/locations');
		
	}
	
	function update_color($id)
	{
		$pieces = explode("_", $id);
		$product_id = $pieces[0];
		$color = $pieces[1];
		
		$nu = $this->Product_model->update_color($product_id,$color);
	
	}
	
	function update_product_customer_status($id)
	{
		$pieces = explode("_", $id);
		$product_id = $pieces[0];
		$statu = $pieces[1];
		
		$nu = $this->Product_model->update_pro_customer_news($product_id,$statu);
	}
	
	function update_product_info_new($id)
	{
		$pieces = explode("_", $id);
		$product_id = $pieces[0];
		$price_id = $pieces[1];
		$price_name = $pieces[2];
		$price_value = $pieces[3];
		
		$nu = $this->Product_model->update_pro_info_news($product_id,$price_id,$price_name,$price_value);
	
	}
	
	function create()
	{
	
		$this->form_validation->set_rules('product_name', 'Product Name','required');
		$this->form_validation->set_rules('product_code', 'Product Code','required|callback_unique_check[product_code,0]');
		$this->form_validation->set_rules('category_id', 'Category','required');
		$this->form_validation->set_rules('subcategory_id[0]','Sub Category','required');
		$this->form_validation->set_rules('delivery_method_id', 'Delivery Method','required');	
		$this->form_validation->set_rules('group_id', 'Location Group','required');
		$this->form_validation->set_rules('delivery_policy_id', 'Deliver Policy','required');
		$this->form_validation->set_rules('substitution_policy_id', 'Substitution Policy','required');
		$this->form_validation->set_rules('product_picture', 'Picture','callback_valid_image[product_picture]');
		//$this->form_validation->set_rules('product_description', 'Product Description','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{

			$this->load->model('Deliverymethod_model');
			$this->load->model('Group_model');
			$this->load->model('Addon_model');	
			$this->load->model('Occasion_model');		
			$this->load->model('Category_model');	
			$this->load->model('Policies_model');
			$this->load->model('Color_model');
			$this->load->model('Subcategory_model');
				
			$data['action'] = 'Create';
			$data['this_class'] = get_class($this);
			
			$data['products'] = $this->Product_model->get_products();
			
			$data['colors'] = $this->Color_model->get_colors();
			$data['occasions'] = $this->Occasion_model->get_occasions();
			$data['categories'] = $this->Category_model->get_categories();
			$data['subcategories'] = $this->Subcategory_model->get_subcategories();
			$data['policies'] = $this->Policies_model->get_policies();
			$data['locgroups'] = $this->Group_model->get_groups();
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
			$data['addons'] = $this->Addon_model->get_addons();
					
			$this->load->view('admin/product-form',$data);
			
		}
		else
		{
			if(!$image = $this->_doUpload($_POST['product_name']))
				$image='';
			$this->Product_model->create($this->input->post(),$image);
			redirect('siteadmin/products');
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
		redirect('siteadmin/products');
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
		
		
	   
		$this->form_validation->set_rules('product_name', 'Product Name','required');
		$this->form_validation->set_rules('product_code', 'Product Code','required|callback_unique_check[product_code,'.$id.']');
		$this->form_validation->set_rules('category_id', 'Category','required');
		$this->form_validation->set_rules('delivery_method_id', 'Delivery Method','required');	
		$this->form_validation->set_rules('group_id', 'Location Group','required');
		$this->form_validation->set_rules('delivery_policy_id', 'Deliver Policy','required');
		$this->form_validation->set_rules('substitution_policy_id', 'Substitution Policy','required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
		
			if(! $_POST)
			{
				$data['product'] = $this->Product_model->get_product($id);
				
			}

			$this->load->model('Deliverymethod_model');
			$this->load->model('Group_model');
			$this->load->model('Occasion_model');
			$this->load->model('Category_model');
			$this->load->model('Addon_model');
			$this->load->model('Policies_model');
			$this->load->model('Color_model');
			$this->load->model('Subcategory_model');
			
			
				
			$data['action'] = 'Update';
			$data['this_class'] = get_class($this);
			
			$data['products'] = $this->Product_model->get_products();
			
			$data['colors'] = $this->Color_model->get_colors();
			$data['occasions'] = $this->Occasion_model->get_occasions();
			$data['categories'] = $this->Category_model->get_categories();
			$data['subcategories'] = $this->Subcategory_model->get_subcategories();
			$data['policies'] = $this->Policies_model->get_policies();
			$data['locgroups'] = $this->Group_model->get_groups();
			$data['delivery_methods'] = $this->Deliverymethod_model->get_deliverymethods();
			$data['addons'] = $this->Addon_model->get_addons();
					
			$this->load->view('admin/productedit-form',$data);
			
		}
		else
		{
			/*
			if($image = $this->_doUpload($_POST['product_name']))
			{
				$prod = $this->Product_model->get_product($id);
				if($image!=$prod->product_picture)
				@unlink('productres/'.$prod->product_picture);
			}
			*/
			
			//PRICES
			$this->Product_model->delete_pro_pri_all($this->input->post('product_id'));
			
			
			$main_pic='';
			$to_prices = $this->input->post('to_pri');
			$d='';
			for($i=1;$i<=$to_prices;$i++){
				$d .= $d.'X';
				$name = $this->input->post('option'.$i);
				$price = $this->input->post('price'.$i);
				
				$imagepic2 = $_FILES['option_picture'.$i]["name"];
				$tempimgloc2 = $_FILES['option_picture'.$i]["tmp_name"];
				$errorimg2 = $_FILES['option_picture'.$i]["error"];
				if($errorimg2 > 0)
				{  
					echo "<strong> <font size='18'>There was a problem uploading your Logo. Please try again!</font></strong>";
					echo "<BR>";
				}
				else 
				{
					move_uploaded_file($tempimgloc2, "productres/".$imagepic2);
				}	
				
				if($imagepic2!=''){
					
				}else{
					$imagepic2=$this->input->post('existing_picture'.$i);
				}
				
				if($i<=2){
					$main_pic=$imagepic2;
				}
				
				$id = $this->Product_model->insert_pri_pro_new($name,$price,$d,$imagepic2,$this->input->post('product_id'));
				
			}
			//PRICES
			
			
			
			$this->Product_model->update($this->input->post(),$main_pic);
			redirect('siteadmin/products');
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
