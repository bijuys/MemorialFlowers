<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');

    }

    public function login()
    {
		$this->load->view('mymemorial/login_form');
    }

    public function authenticate()
    {
	
        $this->load->model('Affiliate_model', '', true);
	
        if($affiliate = $this->Affiliate_model->login($this->input->post(NULL,TRUE)))
        {
	    
            $this->session->set_userdata('affiliate_login', true);
	    $this->session->set_userdata('affiliate_id',$affiliate->user_id);
            redirect(base_url().'mymemorial');
	    exit;
        }
        else
        {
	    $this->session->set_flashdata('message','<div class="errormsg">Username/Password Incorrect! Please try again!"</div>');
            redirect(base_url().'mymemorial/sessions/login');
	    exit;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('loggedin');
        redirect(base_url().'mymemorial/sessions/login');
	exit;
	
    }
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */