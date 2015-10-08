<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addresses extends CI_Controller {

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
		$this->load->model('Order_model');
		$this->load->library('cart');
		$this->load->library('Form_validation');
	}
	
	function trans()
	{
		$this->lang->load('french','french');
	}
	
	function index()
	{
		redirect(base_url().'mymemorial/addresses/browse');
		exit;
	}
	
	
	public function browse()
	{

		/*
		$this->load->library("pagination");
		
		$config = array();
		$config["base_url"] = base_url() . "mymemorial/orders/browse";
		$config["total_rows"] = $this->Order_model->getAffiliateOrdersCount($this->session->userdata('affiliate_id'),$this->input->post(NULL,TRUE));
		$config["per_page"] =25;
		$config["uri_segment"] = 4;
		
	
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		
		$data['totalpages'] = $config['total_rows'];
		
		*/

		$data['orders'] = $this->Order_model->get_affiliate_addresses($this->session->userdata('affiliate_id'));
		
		$data['pagename'] = 'my_addresses';
		$this->load->view('mymemorial/addresses',$data);
	}
	
	public function edit($id) {
		
		$this->load->model('Province_model');
		
		$data['address'] = $this->Order_model->get_affiliate_address($id);
		$data['provinces'] = $this->Province_model->get_all_provinces();
		
		//$data['pagename'] = 'my_addresses';
		$this->load->view('mymemorial/address_edit',$data);
	
	}
	
	
	
	public function update($id)
	{
		//$cart = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		
		/*if($this->Order_model->updateAddress($id,$_POST))
		{
			echo 'good';
		}*/
		
		
		$this->Order_model->updateAddress($id, $this->input->post());
			redirect(base_url().'mymemorial/addresses/browse');
		exit;
		
	}	
	
	
	public function create()
	{
		//$cart = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		
		/*if($this->Order_model->updateAddress($id,$_POST))
		{
			echo 'good';
		}*/
		$this->load->model('Province_model');
		$data['provinces'] = $this->Province_model->get_all_provinces();
		
		$this->load->view('mymemorial/address_create',$data);
		
	}	
	
	
	public function new_address()
	{
	
		$this->db->set('affiliate_id',$this->session->userdata('affiliate_id'));
		$this->db->set('name',$this->input->post('name'));
		$this->db->set('address',$this->input->post('address'));
		$this->db->set('city',$this->input->post('city'));
		$this->db->set('postalcode',$this->input->post('postalcode'));
		$this->db->set('province',$this->input->post('province'));
		$this->db->set('country',$this->input->post('country'));
		$this->db->set('contact_firstname',$this->input->post('contact_firstname'));
		$this->db->set('contact_lastname',$this->input->post('contact_lastname'));
		$this->db->set('phone',$this->input->post('phone'));
		$this->db->set('email',$this->input->post('email'));
		
		$this->db->insert('affiliate_locations');
		//return $this->db->insert_id();	
		
			redirect(base_url().'mymemorial/addresses/browse');
		exit;
	
	}
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */