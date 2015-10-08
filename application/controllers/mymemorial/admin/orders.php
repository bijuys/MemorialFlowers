<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loggedin')) { redirect(base_url().'admin/sessions/login'); }
		$this->load->model('Order_model');
		$this->load->library('cart');
	}
	
	public function index()
	{
		redirect(base_url().'admin/orders/active');
		/*$data['pagename'] = 'All Orders';
		$data['orders'] = $this->Order_model->getOpenOrders($this->input->post());
		$this->load->view('admin/orders',$data);*/
	}
	
	public function active()
	{
		$this->load->library("pagination");
		
		$config = array();
		$config["base_url"] = base_url() . "admin/orders/active";
		$config["total_rows"] = $this->Order_model->getAllActiveItemsCount();
		$config["per_page"] =25;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';
	
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		
		$data['totalpages'] = $config['total_rows'];
		$data['start'] = $page+1;
		$data['recs'] = ($config['per_page'] >= $config['total_rows'] ? $config['total_rows']:$config['per_page'])-1;
		
		
		$data['pagename'] = 'Active Orders';
		$data['orders'] = $this->Order_model->getAllActiveItems($this->input->post(),$config['per_page'],$page);
		$this->load->view('admin/orders',$data);
	}
	
	public function completed()
	{
		
		$this->load->library("pagination");
		
		$config = array();
		$config["base_url"] = base_url() . "admin/orders/active";
		$config["total_rows"] = $this->Order_model->getAllArchivedItemsCount();
		$config["per_page"] =25;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';
	
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		
		$data['totalpages'] = $config['total_rows'];
		$data['start'] = $page+1;
		$data['recs'] = ($config['per_page'] >= $config['total_rows'] ? $config['total_rows']:$config['per_page'])-1;
		
		$data['pagename'] = 'Completed Orders';
		$data['orders'] = $this->Order_model->getAllArchivedItems($this->input->post(),$config['per_page'],$page);
		$this->load->view('admin/orders',$data);
	}
	
	
	public function edit($id)
	{
		$this->load->model('Affiliate_model');
		$this->load->model('Product_model');
		$this->load->model('Location_model');
		$this->load->model('Memorial_model');
		
		$this->cart->destroy();
		
		if($_POST)
		{
			if(count($_POST['price_id']))
			{
				foreach($_POST['price_id'] as $prod)
				{
					if($product=$this->Product_model->getItemDetailByPrice($prod))
					{
						
						$item = array('id'=>$product->product_id,
							      'qty'=>1,
							      'price'=>number_format($product->price,2),
							      'name'=>$product->product,
							      'options'=>array('price_id'=>$product->price_id,
									       'title'=>$product->title,
									       'picture'=>$product->picture));
						
						$this->cart->insert($item);
						
					}
				}
				
				if($orderid = $this->Order_model->updateAdminOrder($this->input->post(NULL,TRUE),$_POST['affiliate_id'],$id))
				{
					$this->session->set_flashdata('message','<div class="success">Successfully updated the Order</div>');
					$this->cart->destroy();
					redirect(base_url().'admin/orders/active');
					exit;
				}
				
			}
		}
		else
		{
			$data['order'] = $this->Order_model->getOrderDetails($id);
		}

		$data['occassions'] = $this->Memorial_model->getOccassions();
		$data['affiliates'] = $this->Affiliate_model->getActiveAffiliates();
		$data['products'] = $this->Product_model->getActiveProducts();
		$data['provinces'] = $this->Location_model->getProvinces();
		$data['countries'] = $this->Location_model->getCountries();
		$data['action'] = 'Update';
		
		
		$this->cart->destroy();
		$this->load->view('admin/order-edit',$data);
	}
	

	
	public function create()
	{
		$this->load->model('Affiliate_model');
		$this->load->model('Product_model');
		$this->load->model('Location_model');
		$this->load->model('Memorial_model');
		
		$this->cart->destroy();
		
		if($_POST)
		{
			if(count($_POST['price_id']))
			{
				foreach($_POST['price_id'] as $prod)
				{
					if($product=$this->Product_model->getItemDetailByPrice($prod))
					{
						
						$item = array('id'=>$product->product_id,
							      'qty'=>1,
							      'price'=>number_format($product->price,2),
							      'name'=>$product->product,
							      'options'=>array('price_id'=>$product->price_id,
									       'title'=>$product->title,
									       'picture'=>$product->picture));
						
						$this->cart->insert($item);
						
					}
				}
				
				if($orderid = $this->Order_model->createAdminOrder($this->input->post(NULL,TRUE),$_POST['affiliate_id']))
				{
					$this->session->set_flashdata('message','<div class="success">Successfully created the Order</div>');
					$this->cart->destroy();
					redirect(base_url().'admin/orders/active');
					exit;
				}
				
			}
		}

		$data['occassions'] = $this->Memorial_model->getOccassions();
		$data['affiliates'] = $this->Affiliate_model->getActiveAffiliates();
		$data['products'] = $this->Product_model->getActiveProducts();
		$data['provinces'] = $this->Location_model->getProvinces();
		$data['countries'] = $this->Location_model->getCountries();
		$data['action'] = 'Create';
		
		$this->cart->destroy();
		$this->load->view('admin/order-create',$data);
	}
	
	
	public function view($id)
	{
		$this->load->model('Affiliate_model');
		$this->load->model('Product_model');
		$this->load->model('Location_model');
		$this->load->model('Memorial_model');
		
		$data['order'] = $this->Order_model->getFullOrder($id);

		$data['occassions'] = $this->Memorial_model->getOccassions();
		$data['affiliates'] = $this->Affiliate_model->getActiveAffiliates();
		$data['products'] = $this->Product_model->getActiveProducts();
		$data['provinces'] = $this->Location_model->getProvinces();
		$data['countries'] = $this->Location_model->getCountries();
		$data['action'] = 'Create';
		
		$this->load->view('admin/order-view',$data);
	}
	
	
	
	
	
	public function getlocinfo()
	{
		$this->load->model('Location_model');
		$location = $this->Location_model->getLocationInfo($this->input->post('postalcode'));
		
		$result = json_encode(array('city'=>$location->city,'province_id'=>$location->province_id,
					    'country_id'=>$location->country_id));
		
		echo $result;
		
	}
	

	
}

