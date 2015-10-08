<?php

class Order extends CI_Controller{
    
    function Order() {
        parent::__construct();
        
        if(!admin_authorized())
		{
			redirect('/siteadmin/login');
			exit;
		}
		
		
		if(!accessGrant('order'))
		{
			redirect('/siteadmin');
			exit;
		}
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Product_model');
        $this->load->model('Order_model');
    }
    
    function index() {
        
        $data = array();
        $data['products'] = $this->Product_model->get_products();
        $this->load->view('admin/showproducts',$data);
    }
    
    function item($itemid) {
        
        if($_POST) {
            $this->Order_model->addItem($this->xxs_clean($_POST));
            redirect('siteadmin/order/view');
            exit();            
        }
        
        $product = $this->Product_model->get_product($itemid);
        if($product->allow_addons) {
            $this->load->model('Addon_model');
            $addons = $this->Addon_model->get_addons();
            $data['addons'] = $addons;
        }
        $data['product'] = $product;
        $this->load->view('admin/showproduct',$data);
    }
    
    
    
    
    
    
    
}

?>
