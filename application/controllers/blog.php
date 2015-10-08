<?php

class Blog extends CI_Controller {

       function Blog()
       {
            parent::__construct();
            $this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');

            $this->load->scaffolding('countries');
       }
	   
	   function update()
	   {
	      use_ssl(FALSE);
	      
	   		$res = $this->db->get('countries_temp');
			
			$i = 1;
			
			foreach($res->result() as $row)
			{
				$this->db->where('short_code',$row->short_code);
				$this->db->set('country_id',$i++);
				$this->db->update('countries_temp');
				
				echo $row->country_name."<br/>";
			}
	   
	   }
}
