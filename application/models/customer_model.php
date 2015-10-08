<?php

class Customer_Model extends CI_Model{
	
	function Customer_Model()
	{
		parent::__construct();
	}
	
	function retrieve_account($vars)
	{
		$this->db->from('users');
		$this->db->where('user_role','customer');
		
		if($vars['retrieve']=='password')
		{
			$this->db->where('user_name',isset($vars['username']) ? $vars['username']:'');
		}
		else
		{
			$this->db->where('user_email',isset($vars['email']) ? $vars['email']:'');
		}
		
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
	
	function getSimilar($name)
	{
		$this->db->from('users');
		$this->db->where('user_role','customer');
		$this->db->like('user_firstname',$name);
		$this->db->or_like('user_lastname',$name);
		$this->db->or_like('user_email',$name);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function count_customers()
	{
	    //$query = $this->db->get_where('users',array('user_role'=>'company'));
	    $this->db->from('users');
	    $this->db->where('user_role','customer');
	    

	    $count =  $this->db->count_all_results();
	    
	    return $count;
	    
	}
	
	
	function search_customers($search)
	{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role','customer');
		$this->db->where('user_status >',-1);
		$this->db->like('user_firstname',$search);
		$this->db->like('user_lastname',$search);
		$this->db->or_like('user_email',$search);
		$query = $this->db->get();

		return $query->result();
		
	}
	
	function is_valid_code($code,$user)
	{
		$this->db->from('users');
		$this->db->where('user_status',1);
		$this->db->where('user_role','company');
		$this->db->where('user_id',$user);
		$this->db->where('company_code',$code);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function getParentCompanies()
	{
		$this->db->from('users');
		$this->db->where('user_role','company');
		$this->db->where('user_status',1);
		$this->db->order_by('user_business','ASC');
		$query = $this->db->get();
		
		return $query->result();	
	}
	
	function signup($vars,$affiliate_id=0)
	{
		$this->db->set('user_name',$vars['username']);
		$this->db->set('user_password',$vars['password']);
		$this->db->set('user_email',$vars['email']);
		$this->db->set('user_firstname',$vars['firstname']);
		$this->db->set('user_lastname',$vars['lastname']);
		$this->db->set('user_address1',$vars['address1']);
		$this->db->set('user_address2',$vars['address2']);
		$this->db->set('user_city',$vars['city']);
		$this->db->set('user_province',$vars['province']);
		$this->db->set('user_country_id',$vars['country_id']);
		$this->db->set('user_phone1',$vars['dayphone']);
		$this->db->set('user_phone2',$vars['evephone']);
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_role','customer');
		$this->db->set('user_status',1);
			      
		$this->db->insert('users');
		
		return $this->db->insert_id();
	}
		
	function update_profile($vars)
	{
		$data = array('user_email'=>$vars['email'],
			      'user_firstname'=>$vars['firstname'],
			      'user_lastname'=>$vars['lastname'],
			      'user_address1'=>$vars['address1'],
			      'user_address2'=>$vars['address2'],
			      'user_city'=>$vars['city'],
			      'user_postalcode'=>$vars['postalcode'],
			      'user_province'=> $vars['province'],
			      'user_country_id'=>$vars['country_id'],
			      'user_phone1'=>$vars['dayphone'],
			      'user_phone2'=>$vars['evephone'],
			      'user_created'=>date('Y-m-d H:i:s',time()),
			      'user_role'=>'customer',
			      'user_status'=>1);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	function get_orders($id)
	{
		
		$this->db->from('orders');
		$this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		
		return $query->result();		
	}
	
	
	function get_invoices($id)
	{
		$this->db->select('orders.*, COUNT(order_items.orderitem_id) AS items, GROUP_CONCAT(delivery_details.firstname) AS firstname ');
		$this->db->from('orders');
		$this->db->join('order_items','order_items.cart_id=orders.cart_id','left');
		$this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
		$this->db->group_by('orders.order_id');
		$this->db->where('user_id',$id);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_invoice($id,$invid)
	{
		$this->db->from('order_items');
		$this->db->join('orders','order_items.cart_id=orders.cart_id','left');
		$this->db->join('products','order_items.product_id=products.product_id','left');
		$this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
		$this->db->where('orders.user_id',$id);
		$this->db->where('orders.order_id',$invid);
		
		$query = $this->db->get();
		
		$items = array();
		
		foreach($query->result() as $row)
		{
			$item = $row;
			
			$this->db->from('order_addons');
			$this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id');			
			$this->db->where('order_addons.orderitem_id',$row->orderitem_id);
			$this->db->group_by('order_addons.order_addon_id');
			
			$aquery = $this->db->get();
			
			$item->addons = $aquery->result();
			
			$items[] = $item;
		}
		
		return $items;
	}
	
	function get_billing($id,$invid)
	{
		$this->db->from('orders');
		$this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
		$this->db->where('orders.user_id',$id);
		$this->db->where('orders.order_id',$invid);
		
		$query = $this->db->get();
		
		return $query->row();
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
		$this->db->set('user_role','customer');	
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');	
		$this->db->insert('users');
		return $this->db->insert_id();			
	}
	
	function get_customers()
	{
		$this->db->from('users');
		$this->db->join('countries','users.user_country_id=countries.country_id');
		$this->db->where('user_role','customer');
		$this->db->where('user_status !=','-1');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_pmethod($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id));
		$res = $query->row();
		return $res->customer_onaccount;
	}
	
	function get_customer($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id));
		return $query->row();
	}
	
	function register_Login($id)
	{
		$this->db->query("UPDATE users SET user_lastlogin=CONCAT(CURDATE(),' ',CURTIME())
				 WHERE user_id={$id}");
		return $this->db->affected_rows();
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
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');
		if(isset($vars['user_discount']))
			$this->db->set('user_discount',$vars['user_discount']);
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
                if(!empty($vars['username']) && !empty($vars['password']))
                {
                    $this->db->from('users');
                    $this->db->where('user_name',$vars['username']);
                    $this->db->where('user_password',$vars['password']);
                    $this->db->where('user_role','affiliate');
		    
                    $query = $this->db->get();
            
                    if($query->num_rows()>0)
                            return $query->row();
                    else
                            return false;
                }
                
                return false;
	}
	
	function delete($id)
	{
		$this->db->delete('users',array('user_id'=>$id));
	}
	
	function getDiscount($id)
	{
		
		$this->db->where('user_id',$id);
		$this->db->where('user_role','customer');
		$query = $this->db->get('users');
		
		foreach($query->result() as $row)
		{
			if($row->user_discount>0)
				return $row->user_discount;
			else
				return FALSE;
		}
		
		return FALSE;
		
	}
	
	function subscribe($email)
	{
		
		$this->db->set('email',$email);
		$this->db->insert('email_list');
		
		return $this->db->insert_id();
		
	}
	
} 