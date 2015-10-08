<?php

class AffReferer {
    
	function setReferer($ref='')
	{
            
		if(isset($_GET['aff']) && is_numeric($_GET['aff']))
		{
			$ci=& get_instance();
			$ci->load->database();
			

			$query = $ci->db->query('SELECT * FROM users WHERE user_id='.$_GET['aff']);
			
			if($row = $query->row())
			{
				$ci->session->set_userdata('referer',$row->user_id);
				$ci->session->set_userdata('referer_sitename',$row->user_sitename);
				$ci->session->set_userdata('referer_description',$row->user_description);
				$ci->session->set_userdata('referer_logo',$row->user_logo);
				$ci->session->set_userdata('referer_theme',strtolower($row->user_theme));
				$ci->session->set_userdata('referer_business',$row->user_business);
				$ci->session->set_userdata('referer_address',$row->user_address1.' '.$row->user_address2);
				$ci->session->set_userdata('referer_postalcode',$row->user_postalcode);
				$ci->session->set_userdata('referer_city',$row->user_city);
				$ci->session->set_userdata('referer_province',$row->user_province);
				$ci->session->set_userdata('referer_phone',$row->user_phone1);
				$ci->session->set_userdata('referer_discount',$row->business_discount);
				
			}
		}
	}
}

?>