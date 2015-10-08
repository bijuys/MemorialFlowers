<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {

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
		
	}
	
	
	public function set($param)
	{
		$this->session->set_userdata('language',strtolower($param));
		$this->session->set_userdata('langshort',strtoupper(substr($param,0,2)));
		
		$current_url = urldecode($current_url);
		redirect($current_url, 'location');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */


