<?php

class Company_Model extends CI_Model{
	
	function Company_Model()
	{
		parent::__construct();
	}
	
	function count_companies()
	{
	    //$query = $this->db->get_where('users',array('user_role'=>'company'));
	    $this->db->from('users');
	    $this->db->where('user_role','company');
	    

	    $count =  $this->db->count_all_results();
	    
	    return $count;
	    
	}
	
	function signup($vars,$affiliate_id='')
	{
	   $firstname = '';
	   $lastname = '';
	   
            if(substr_count($vars['firstname'],' ')>0)
               list($firstname,$lastname) = explode(' ',$vars['firstname'],2);
            else
            {
                $firstname = $vars['firstname'];
                $lastname = '';
            }
                
	   
		$data = array('user_name'=>$vars['username'],
			      'user_password'=>$vars['password'],
			      'user_email'=>$vars['email'],
			      'user_business'=>$vars['business'],
			      'user_firstname'=>$firstname,
			      'user_lastname'=>$lastname,
			      'user_address1'=>$vars['address1'],
			      'user_address2'=>$vars['address2'],
			      'user_city'=>$vars['city'],
			      'user_province'=> $vars['province'],
			      'user_country_id'=>$vars['country_id'],
			      'user_phone1'=>$vars['dayphone'],
			      'user_phone2'=>$vars['evephone'],
			      'user_created'=>date('Y-m-d H:i:s',time()),
			      'user_role'=>'company',
				  'business_discount'=>10,
			      'user_status'=>1);
		
		if($affiliate_id>0)
			$data['referer_id'] = $affiliate_id;
		
		
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	
	function get_orders($id)
	{
		$this->db->from('orders');
		$this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();		
	}
	
	function get_company($id)
	{
		$this->db->from('users');
		$this->db->where('user_role','company');
		$this->db->where('user_id',$id);
		
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
	function search_companies($search)
	{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role','company');
		$this->db->where('user_status >',-1);
		$this->db->like('user_business',$search);
		$this->db->or_like('user_email',$search);
		$query = $this->db->get();

		return $query->result();
		
	}
	
	function get_companies($num=500, $offset=0)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role','company');
		$this->db->where('user_status >',-1);
		$this->db->limit($num, $offset);
		$query = $this->db->get();

		return $query->result();
		
	}
	
	
	function get_customers($id)
	{
		$this->db->select('*');
		$this->db->select('COUNT(orders.order_id) AS orders');
		$this->db->select('users.user_id AS user_id');
		$this->db->from('users');
		$this->db->join('orders','users.user_id=orders.user_id','left');
		$this->db->where('user_status >',-1);
		$this->db->where('user_role','customer');
		$this->db->where('parent_id',$id);
		$this->db->group_by('users.user_id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function update_Profile($vars)
	{
		$data = array('user_email'=>$vars['email'],
			      'user_firstname'=>$vars['firstname'],
			      'user_business'=>$vars['business'],
			      'user_address1'=>$vars['address1'],
			      'user_address2'=>$vars['address2'],
			      'user_city'=>$vars['city'],
			      'user_province'=> $vars['province'],
			      'user_country_id'=>$vars['country_id'],
			      'user_phone1'=>$vars['dayphone'],
			      'user_phone2'=>$vars['evephone'],
			      'user_created'=>date('Y-m-d H:i:s',time()),
			      'user_status'=>1);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	function update_Discount($vars)
	{
		$data = array('company_code'=>$vars['company_code'],
                              'double_discount'=>$vars['double_discount']==1 ? 1:0);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->where('user_role','company');
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	function update_Payment($vars)
	{
		$data = array('double_discount'=>$vars['customer_onaccount']==1 ? 1:0);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->where('user_role','company');
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	
	function update_Password($vars)
	{
		$data = array('user_password'=>$vars['newpassword']);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->where('user_password',$vars['oldpassword']);
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	function create($vars)
	{
		$this->db->set('user_name',$vars['user_name']);
		$this->db->set('user_password',$vars['user_password']);
		$this->db->set('user_email',$vars['user_email']);
		$this->db->set('user_firstname',$vars['user_firstname']);
		$this->db->set('user_lastname',$vars['user_lastname']);
		$this->db->set('user_business',$vars['user_business']);
		$this->db->set('user_address1',$vars['user_address1']);
		$this->db->set('user_address2',$vars['user_address2']);
		$this->db->set('user_city',$vars['user_city']);
		$this->db->set('user_postalcode',$vars['user_postalcode']);
		$this->db->set('user_province', $vars['user_province']=='' ? $vars['user_province2']:$vars['user_province']);
		$this->db->set('user_country_id',$vars['user_country_id']);
		$this->db->set('user_phone1',$vars['user_phone1']);
		$this->db->set('user_phone1_ext',$vars['user_phone1_ext']);
		$this->db->set('user_phone2',$vars['user_phone2']);
		$this->db->set('user_phone2_ext',$vars['user_phone2_ext']);
                $this->db->set('business_discount',$vars['business_discount']);
		$this->db->set('user_role','company');	
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');	
		$this->db->insert('users');
		return $this->db->insert_id();			
	}
	
	/*function get_company($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id,'user_role'=>'company'));
		return $query->row();
		
	}*/
	
	function get_pmethod($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id,'user_role'=>'company'));
		$res = $query->row();
		return $res->customer_onaccount;
	}
	
	function register_Login($id)
	{
		$this->db->query("UPDATE users SET user_lastlogin=CONCAT(CURDATE(),' ',CURTIME())
				 WHERE user_id={$id} AND user_role='customer'");
		return $this->db->affected_rows();
	}
	
	function checkWaiver($id)
	{
		$this->db->from('users');
		$this->db->where('user_role','company');
		$this->db->where('user_id',$id);
		
		$query = $this->db->get();
		
		foreach($query->result() as $row)
		{
			if($row->waive_shipping==1)
				return true;
		}
		
		return false;
	}
	
	function update($vars)
	{
		$this->db->set('user_password',$vars['user_password']);
		$this->db->set('user_firstname',$vars['user_firstname']);
		$this->db->set('user_lastname',$vars['user_lastname']);
		$this->db->set('user_business',$vars['user_business']);
		$this->db->set('user_address1',$vars['user_address1']);
		$this->db->set('user_address2',$vars['user_address2']);
		$this->db->set('user_city',$vars['user_city']);
		$this->db->set('user_postalcode',$vars['user_postalcode']);
		$this->db->set('user_province', $vars['user_province']=='' ? $vars['user_province2']:$vars['user_province']);
		$this->db->set('user_country_id',$vars['user_country_id']);
		$this->db->set('user_phone1',$vars['user_phone1']);
		$this->db->set('user_phone1_ext',$vars['user_phone1_ext']);
		$this->db->set('user_phone2',$vars['user_phone2']);
		$this->db->set('user_phone2_ext',$vars['user_phone2_ext']);	
		$this->db->set('business_discount',$vars['business_discount']);
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');
		$this->db->set('waive_shipping',$vars['waive_shipping']==1? '1':'0');
		$this->db->set('customer_onaccount',$vars['payment_method']==1? '1':'0');	
		$this->db->where('user_id',$vars['user_id']);
		$this->db->update('users');
		
		return $this->db->affected_rows();			
	}
	
	function is_exists($value,$field,$id)
	{
		$this->db->from('users');
		$this->db->where($field,$value);
		$this->db->where('user_id <>',$id);
		$query = $this->db->get();
		if($query->num_rows>0)
			return TRUE;
		else
			return FALSE;
	}
	
	function login($vars)
	{
		$this->db->from('users');
		$this->db->where('user_name',$vars['username']);
		$this->db->where('user_password',$vars['password']);
		$this->db->where('user_status',1);
		$this->db->where('user_role','company');
		$query = $this->db->get();
	
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	
	}
	
	function delete($id)
	{
		$this->db->delete('users',array('user_id'=>$id));
	}
	
} 
