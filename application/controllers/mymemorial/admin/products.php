<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('loggedin')) { redirect(base_url().'admin/sessions/login'); }
		$this->load->model('Product_model');
	}
	
	function create()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_id', 'Product ID', 'required');
		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('price[1]', 'Product Price', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Memorial_model');
			$data['categories'] = $this->Memorial_model->getCategories();
			$data['types'] = $this->Memorial_model->getTypes();
			$data['occassions'] = $this->Memorial_model->getOccassions();
			$data['colors'] = $this->Memorial_model->getColors();
			$data['action'] = 'Create';
			$this->load->view('admin/product-form',$data);
		}
		else
		{
			$image = $this->_doUpload('picture');
			
			$this->Product_model->create($this->input->post(NULL,TRUE),$image);
			redirect(base_url().'admin/products');
			exit;
		}
	}
	
	function edit($id)
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('product_id', 'Product ID', 'required');
		$this->form_validation->set_rules('product', 'Product Name', 'required');
		$this->form_validation->set_rules('price[0]', 'Product Price', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('Memorial_model');
			$data['categories'] = $this->Memorial_model->getCategories();
			$data['types'] = $this->Memorial_model->getTypes();
			$data['occassions'] = $this->Memorial_model->getOccassions();
			$data['colors'] = $this->Memorial_model->getColors();
			$data['action'] = 'Update';
			
			if(!$_POST)
			{
				$data['product'] = $this->Product_model->getProduct($id);
			}
			
			$this->load->view('admin/product-form',$data);
		}
		else
		{
			$image = $this->_doUpload('picture');
			
			$this->Product_model->update($this->input->post(NULL,TRUE),$image,$id);
			redirect(base_url().'admin/products');
			exit;
		}
	}

	function _doUpload($img)
	{
		$config['upload_path'] = '../pictures/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($img))
		{
			$error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = $this->upload->data();
			return $data['file_name'];
		}
	}
	
	
	
	public function index()
	{		
		$data['page'] = 'Products';
		$data['products'] = $this->Product_model->getProducts($this->input->post());
		$this->load->view('admin/products',$data);
	}
	
	public function del()
	{
		redirect(base_url().'admin/products');
		exit;
	}
	

	
}

