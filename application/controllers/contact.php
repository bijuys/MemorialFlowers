<?php

class Contact extends CI_Controller {

	function Contact()
	{
		parent::__construct();	
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url'); 
		$this->load->Model('Menu_model');
		$this->load->Model('Category_model');
	}
	
	function index()
	{
		$data['current_page']='contact';
		$data['topmenu'] = $this->Menu_model->get_menu_entries('topmenu');
		$data['mainmenu'] = $this->Menu_model->get_menu_entries('mainmenu');
		$data['footermenu'] = $this->Menu_model->get_menu_entries('footermenu');
		$data['page'] = $this->Pages_model->return_page('contact');
		
		$this->load->view('contact.php',$data);			
	}
	
	function about_us()
	{
		$this->load->Model('Product_model');
		$data['current_page']='contact';
		$data['topmenu'] = $this->Menu_model->get_menu_entries('topmenu');
		$data['mainmenu'] = $this->Menu_model->get_menu_entries('mainmenu');
		$data['footermenu'] = $this->Menu_model->get_menu_entries('footermenu');
		$data['page'] = $this->Pages_model->return_page('contact');
		$data['val'] = 'About Us';
		
		$this->load->view('about-us.php',$data);			
	}
	
	function shipping_and_delivery()
	{
		$data['current_page']='contact';
		$data['topmenu'] = $this->Menu_model->get_menu_entries('topmenu');
		$data['mainmenu'] = $this->Menu_model->get_menu_entries('mainmenu');
		$data['footermenu'] = $this->Menu_model->get_menu_entries('footermenu');
		$data['page'] = $this->Pages_model->return_page('contact');
		
		$this->load->view('shipping.php',$data);			
	}
	
	
	
	function test()
	{
		echo '<link src="/templates/default/css/calender.css"/>';
		/* sample usages */
		echo '<h2>October 2012</h2>';
		echo draw_calendar('10',2012);
		echo '<h2>November 2012</h2>';
		echo draw_calendar('11',2012);
		
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */