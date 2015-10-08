<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function login()
    {
        $this->load->view('admin/login_form');
    }

    public function authenticate()
    {
        $this->load->model('User_model', '', true);
        if ($this->User_model->authenticate($this->input->post(NULL,TRUE)))
        {
            $this->session->set_userdata('loggedin', true);
            redirect(base_url().'admin');
	    exit;
        }
        else
        {
	    $this->session->set_flashdata('message','<div class="errormsg">Invalid Login attempt from IP "'.$_SERVER['REMOTE_ADDR'].'"</div>');
            redirect(base_url().'admin/sessions/login');
	    exit;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('loggedin');
        redirect(base_url().'admin/sessions/login');
	exit;
	
    }
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */