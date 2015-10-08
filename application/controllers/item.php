<?php

class Item extends CI_Controller {

	function Welcome()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url'); 
		$this->load->Model('Menu_model');
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
	}
	
	function index()
	{
		$data['current_page']='home';
		$data['topmenu'] = $this->Menu_model->get_menu_entries('topmenu');
		$data['mainmenu'] = $this->Menu_model->get_menu_entries('mainmenu');
		$data['footermenu'] = $this->Menu_model->get_menu_entries('footermenu');
		$data['maincategories'] = $this->Category_model->get_main_categories();
		$data['products'] = $this->Product_model->get_home_products(10);
		$this->load->view('home.php',$data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */