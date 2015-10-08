<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('affiliate_login')) { redirect(base_url().'mymemorial/sessions/login'); }
		$this->load->model('Product_model');
		$this->load->library('form_validation');
		$this->load->model('Order_model');
	}	
	
	public function index()
	{
		
		
		$keyword = isset($_POST['keyword']) ? $_POST['keyword']:'';
		$data['products'] = $this->Product_model->mymemorial_products(1000, array('search'=>$keyword));
		$data['cart'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));

		$this->load->view('mymemorial/productslist',$data);
		
	}
	
	public function addcart()
	{		
		$this->form_validation->set_rules("product_id", 'Product','required|numeric|max_length[10]');
		$this->form_validation->set_rules("price_id", 'Price','required|numeric|max_length[10]');
			
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');

		if ($this->form_validation->run() == TRUE)
		{			
			if($this->Order_model->add_to_mycart($this->input->post()))
			{
				$this->session->set_flashdata('message','<div id="messenger">'.lang('1 Item is successfully added to your cart!').'</div>');
				redirect($_SERVER['HTTP_REFERER']);
				exit;				
			}
			else {
				$this->session->set_flashdata('message','<div id="messenger">'.lang('Failed to add the Item').'</div>');
				redirect($_SERVER['HTTP_REFERER']);
				exit;	
			}
		}
		else
		{
			redirect($_SERVER['HTTP_REFERER']);
			exit;				
		}
	}
	
	public function browse()
	{
		$data['category_id'] = $this->input->post('category_id');
		$data['product_name'] = $this->input->post('product_name');
		$data['products'] = $this->Product_model->get_customer_products($this->input->post(NULL,TRUE));
		//$data['fhomes'] = $this->Order_model->get_funeral_homes_list();
		
		$data['pagename'] = 'my_products';
		$this->load->view('mymemorial/products',$data);
	}
	
	function upd_pro_des_inf()
	{
		$pr_id=$this->Product_model->update_product_description_info($this->input->post());
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */