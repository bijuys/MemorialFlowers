<?php

class Affiliate_Model extends CI_Model{
	
	function Affiliate_Model()
	{
		parent::__construct();

	}
	
	
	function retrieve_account($vars)
	{
		$this->db->from('users');
		$this->db->where('user_role','affiliate');
		//$this->db->where('user_status',1);
		
		//echo "hi m here";
	//	die;
		
		
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
		$this->db->where('user_role','affiliate');
		$this->db->like('user_firstname',$name);
		$this->db->or_like('user_lastname',$name);
		$this->db->or_like('user_email',$name);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function count_affiliates()
	{
	    //$query = $this->db->get_where('users',array('user_role'=>'company'));
	    $this->db->from('users');
	    $this->db->where('user_role','affiliate');
	    
	    $count =  $this->db->count_all_results();
	    
	    return $count;
	    
	    
	}
	
	function search_affiliates($search)
	{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_role','affiliate');
		$this->db->where('user_status >',-1);
		$this->db->like('user_firstname',$search);
		$this->db->like('user_lastname',$search);
		$this->db->or_like('user_email',$search);
		$query = $this->db->get();

		return $query->result();
		
	}
	
	function signup($vars)
	{
		$data = array('user_name'=>$vars['username'],
			      'user_password'=>$vars['password'],
			      'user_email'=>$vars['email'],
			      'user_business'=>$vars['business'],
			      'user_firstname'=>$vars['firstname'],
			      'user_lastname'=>$vars['lastname'],
			      'user_address1'=>$vars['address1'],
			      'user_address2'=>$vars['address2'],
			      'user_city'=>$vars['city'],
			      'user_province'=> empty($vars['province']) ? $vars['province2']:$vars['province'],
			      'user_country_id'=>$vars['country_id'],
			      'user_phone1'=>$vars['phone1'],
			      'user_phone2'=>$vars['phone2'],
			      'user_created'=>date('Y-m-d H:i:s',time()),
			      'user_role'=>'affiliate',
			      'user_status'=>0);
		
		$this->db->insert('users',$data);
		return $this->db->insert_id();
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
		$this->db->set('user_role','affiliate');	
		$this->db->set('user_created',date('Y-m-d H:i:s',time()));
		$this->db->set('user_status',$vars['user_status']==1? '1':'0');
		$this->db->set('affiliate_commission',$vars['affiliate_commission']>0 ? $vars['affiliate_commission']:'0');
		$this->db->set('customer_onaccount',$vars['user_onaccount']);
		$this->db->insert('users');
		return $this->db->insert_id();			
	}
	
	function get_affiliates()
	{
		$this->db->from('users');
		$this->db->join('countries','users.user_country_id=countries.country_id');
		$this->db->where('user_role','affiliate');
		$this->db->where('user_status !=','-1');
		$this->db->order_by('user_id','desc');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_affiliate($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id,'user_role'=>'affiliate'));
		return $query->row();
		
	}
	
	
	function get_aff_rec($id)
	{
		$query = $this->db->get_where('users',array('user_id'=>$id,'user_role'=>'affiliate'));
		return $query->row();
		
	}
	
	
	
	function get_orders($id)
	{
		$this->db->from('orders');
		$this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();		
	}
	
	function get_commission($id)
	{
		$this->db->select('affiliate_commission');
		$this->db->from('users');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
	function get_last_payment($id)
	{
		$this->db->select('payment_date');
		$this->db->from('affiliate_payments');
		$this->db->where('affiliate_id',$id);
		$this->db->order_by('payment_date','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->row();
		
	}
	
	function get_affiliate_orders($id,$lastpay)
	{
		$this->db->from('orders');
		$this->db->join('users','orders.user_id=users.user_id','left');
		$this->db->where('affiliate_id',$id);
		$this->db->where('order_date >', $lastpay);
		$query = $this->db->get();
		return $query->result();		
	}
	
	
	function update_Password($vars)
	{
		$data = array('user_password'=>$vars['newpassword']);
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->where('user_password',$vars['oldpassword']);
		$this->db->where('user_role','affiliate');
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	
	function update_Profile($vars)
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
			      'user_phone2'=>$vars['evephone']);
		
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->update('users',$data);
		
		return $this->db->affected_rows();
	}
	
	function update_Site($vars,$fname='')
	{
		$data = array('user_sitename'=>$vars['user_sitename'],
			      'user_description'=>$vars['user_description'],
			      'user_theme'=>$vars['theme']);
                
		if($fname!='')
		{
			$data['user_logo'] = $fname;
		}
		
		$this->db->where('user_id',$vars['customer_id']);
		$this->db->update('users',$data);
                
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
		$this->db->set('customer_onaccount',$vars['customer_onaccount']==1? '1':'0');
		$this->db->set('affiliate_commission',$vars['affiliate_commission']>0 ? $vars['affiliate_commission']:'0');
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
		$this->db->where('user_role','affiliate');
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
	
	function reportProducts($id,$vars)
	{
		
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->select('*');
		$this->db->select('COUNT(order_items.product_id) AS sales');
		$this->db->from('order_items');
		$this->db->join('orders','orders.cart_id=order_items.cart_id','left');
		$this->db->join('products','order_items.product_id=products.product_id','left');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		$this->db->order_by('sales','DESC');
		$this->db->group_by('order_items.product_id');
		
		$query = $this->db->get();
		
		return $query->result();		
		
	}
	
	function reportInvoice($id,$vars)
	{
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->from('orders');
		$this->db->join('billing_details','billing_details.cart_id=orders.cart_id','left');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		
		$query = $this->db->get();
		
		return $query->result();		
		
	}
	
	function reportCustomer($id,$vars)
	{
		
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->select('*');
		$this->db->select('COUNT(orders.order_id) AS purchases');
		$this->db->select('SUM(orders.amount) AS amount');
		$this->db->select('SUM(orders.commission) AS commission');
		$this->db->from('users');
		$this->db->join('orders','orders.user_id=users.user_id','left');
		$this->db->join('order_items','orders.cart_id=orders.cart_id','left');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);

		$this->db->group_by('users.user_id');
		
		$query = $this->db->get();
		
		return $query->result();		
		
	}
	
	function reportOccasion($id,$vars)
	{
		
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->from('orders');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		
		$query = $this->db->get();
		
		return $query->result();		
		
	}
	
	function reportYearly($id,$vars)
	{
		
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->select('*');
		$this->db->select('YEAR(orders.order_date) AS year');
		$this->db->select('SUM(orders.amount) AS orderamount');
		$this->db->select('COUNT(orders.order_id) AS sales');
		$this->db->select('SUM(orders.commission) AS commission');
		$this->db->from('orders');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		$this->db->group_by("YEAR(orders.order_date)");
		
		$query = $this->db->get();
		
		return $query->result();		
		
	}
	
	function reportMonthly($id,$vars)
	{
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());
		
		$this->db->select('*');
		$this->db->select('MONTH(orders.order_date) AS month, YEAR(orders.order_date) AS year');
		$this->db->select('SUM(orders.amount) AS orderamount');
		$this->db->select('COUNT(orders.order_id) AS sales');
		$this->db->select('SUM(orders.commission) AS commission');
		$this->db->from('orders');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		$this->db->group_by("MONTH(orders.order_date)");
		
		$query = $this->db->get();
		
		return $query->result();		
	}
	
	function reportDaily($id,$vars)
	{
		$start = isset($vars['start_year']) ? $vars['start_year']:date('Y',time());
	        $start .= '-';
	        $start .= isset($vars['start_month']) ? $vars['start_month']:date('m',time());
	        $start .= '-';
	        $start .= isset($vars['start_day']) ? $vars['start_day']:'1';
	       
	        $end = isset($vars['end_year']) ? $vars['end_year']:date('Y',time());
	        $end .= '-';
	        $end .= isset($vars['end_month']) ? $vars['end_month']:date('m',time());
	        $end .= '-';
	        $end .= isset($vars['end_day']) ? $vars['end_day']:date('d',time());

		$this->db->select('*');
		$this->db->select('DAY(orders.order_date) AS day, MONTH(orders.order_date) AS month, YEAR(orders.order_date) AS year');
		$this->db->select('SUM(orders.amount) AS orderamount');
		$this->db->select('COUNT(orders.order_id) AS sales');
		$this->db->select('SUM(orders.commission) AS commission');		
		$this->db->from('orders');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->where('orders.order_date >=',$start);
		$this->db->where('orders.order_date <=',$end);
		$this->db->group_by("DAY(orders.order_date)");
		
		$query = $this->db->get();
		
		return $query->result();		
	}
	
	
	
	/******************************* MyMemorial Model ********************************************/
	
	
	
	function getRecent($num)
	{
		$this->db->from('affiliates');
		$this->db->where('active',1);
		$this->db->order_by('created','DESC');
		$this->db->limit($num,0);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function getAffiliate($id)
	{
		$query = $this->db->get_where('affiliates',array('affiliate_id'=>$id));
		return $query->row();
	}
	
	function getAffiliateInfo($id)
	{
		$this->db->from('users');
		$this->db->where('user_role','affiliate');
		$this->db->join('provinces','users.user_province=provinces.province_name','left');
		$this->db->join('countries','users.user_country_id=countries.country_id','left');
		$this->db->where('user_id',$id);
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	public function myMemorial_create($vars,$logo)
	{
		$data['firstname'] = $vars['firstname'];
		$data['lastname'] = $vars['lastname'];
		$data['affiliatename'] = $vars['affiliatename'];
		$data['email'] = $vars['email'];
		$data['password'] = $vars['password'];
		$data['address'] = $vars['address'];
		$data['city'] = $vars['city'];
		$data['province_id'] = $vars['province_id'];
		$data['country_id'] = $vars['country_id'];
		$data['telephone'] = $vars['telephone'];
		$data['postalcode'] = $vars['postalcode'];
		$data['created'] = date('Y-m-d',time());
		$data['domain'] = $vars['domain'];
		$data['active'] = isset($vars['active']) ? $vars['active']:'0';
		$data['sitename'] = $vars['sitename'];
		$data['description'] = $vars['description'];
		$data['template_id'] = $vars['template_id'];
		$data['payment_type'] = $vars['payment_type'];
		$data['commission'] = is_numeric($vars['commission']) ? $vars['commission']:'0';
		$data['donate'] = isset($vars['donate']) ? '1':'0';
		$data['managed'] = isset($vars['managed']) ? '1':'0';
		$data['localcode'] = $vars['localcode'];
		$data['logo_file'] = empty($logo) ? $logo:'';
		$data['business_name'] = $vars['business_name'];
		$data['logo_file'] = $vars['logo_file'];
		$data['service_fee'] = is_numeric($vars['service_fee']) ? $vars['service_fee']:'0';
		$data['url'] = $vars['url'];
		$data['upgraded'] = isset($vars['upgraded']) ? '1':'0';
		
		$this->db->insert('affiliates',$data);
		
		return $this->db->insert_id();
	}
	
	public function myMemorial_update($vars,$logo,$id)
	{
		
		$data['firstname'] = $vars['firstname'];
		$data['lastname'] = $vars['lastname'];
		$data['affiliatename'] = $vars['affiliatename'];
		$data['email'] = $vars['email'];
		$data['password'] = $vars['password'];
		$data['address'] = $vars['address'];
		$data['city'] = $vars['city'];
		$data['province_id'] = $vars['province_id'];
		$data['country_id'] = $vars['country_id'];
		$data['telephone'] = $vars['telephone'];
		$data['postalcode'] = $vars['postalcode'];
		$data['domain'] = $vars['domain'];
		$data['active'] = isset($vars['active']) ? $vars['active']:'0';
		$data['sitename'] = $vars['sitename'];
		$data['description'] = $vars['description'];
		$data['template_id'] = $vars['template_id'];
		$data['payment_type'] = $vars['payment_type'];
		$data['commission'] = is_numeric($vars['commission']) ? $vars['commission']:'0';
		$data['donate'] = isset($vars['donate']) ? '1':'0';
		$data['managed'] = isset($vars['managed']) ? '1':'0';
		$data['localcode'] = $vars['localcode'];
		if(!empty($logo)) { $data['logo_file'] = $logo; }
		$data['business_name'] = $vars['business_name'];
		$data['logo_file'] = $vars['logo_file'];
		$data['service_fee'] = is_numeric($vars['service_fee']) ? $vars['service_fee']:'0';
		$data['url'] = $vars['url'];
		
		$this->db->where('affiliate_id',$id);		
		$this->db->update('affiliates',$data);
		
		return $this->db->affected_rows();
	}
	
	public function myMemorial_delete($id)
	{
		$this->db->delete('affiliates',array('affiliate_id'=>$id));
		return $this->db->affected_rows();
	}
	
	
	public function getAffiliates($vars)
	{
		$where = 'WHERE a.active=1';
		
		if(!empty($vars['affiliate_id']))
		{
		    $where .= ' AND a.affiliate_id='.$vars['affiliate_id'];
		}
		
		if(!empty($vars['sales_min']))
		{
		    $where .= ' AND amount>='.$vars['sales_min'];
		}
		
		if(!empty($vars['sales_max']))
		{
		    $where .= ' AND amount<='.$vars['sales_max'];
		}
		
		if(!empty($vars['joined_after']))
		{
		    $where .= ' AND created>='.$vars['joined_after'];
		}
		
		if(!empty($vars['joined_before']))
		{
		    $where .= ' AND created<='.$vars['joined_before'];
		}
		
		if(!empty($vars['keyword']))
		{
		    $where .= " AND (firstname LIKE '%".$vars['keyword']."%' OR lastname LIKE '%".$vars['keyword']."%')";
		}
	 
		$query = $this->db->query("SELECT a.*,COUNT(i.invoice_id) AS sales, SUM(i.amount) AS amount
				     FROM affiliates a
				     LEFT JOIN orders o ON a.affiliate_id=o.affiliate_id
				     LEFT JOIN invoice i ON o.order_id=i.order_id
				     {$where} 
				     GROUP BY a.affiliate_id
				     ORDER BY upgraded DESC");
		
		return $query->result();  
	}
	
	function getActiveAffiliates()
	{
		$this->db->from('affiliates');
		$this->db->where('active',1);
		$this->db->order_by('firstname','ASC');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function upgrade($vars)
	{
		$this->db->query("UPDATE affiliates SET upgraded=0");
		
		if(count($vars['affiliate']))
		{			
			foreach($vars['affiliate'] as $key)
			{
				$this->db->query("UPDATE affiliates SET upgraded=1 WHERE affiliate_id={$key}");

			}
		}
	}
	
	function getSettings($affid)
	{
		$this->db->select('business_name,address,city,postalcode,province_id,country_id,affiliatename,telephone,email,password,language');
		$this->db->from('affiliates');
		$this->db->where('affiliate_id',$affid);
		
		return $this->db->get()->row();

	}
	
	
	function get_recent_orders($id,$limit)
	{
		$this->db->from('orders');
		$this->db->where('affiliate_id',$id);
		$this->db->order_by('order_id','DESC');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_recent_items($id,$limit)
	{
		$this->db->from('products');
		$this->db->join('product_prices','products.product_id=product_prices.product_id','left');
		$this->db->join('order_items','order_items.product_id=products.product_id','left');
		$this->db->join('orders','orders.cart_id=order_items.cart_id','left');
		$this->db->order_by('orders.order_date','DESC');
		$this->db->where('orders.affiliate_id',$id);
		$this->db->group_by('products.product_id');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	function get_total_sales($id)
	{
		$this->db->select('COUNT(orders.order_id) AS sales, SUM(orders.amount) AS total');
		$this->db->from('orders');
		$this->db->where('affiliate_id',$id);
		//$this->db->group_by('affiliate_id');
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	function get_monthly_sales($id,$limit)
	{
		$this->db->select('MONTH(orders.order_date) AS month, YEAR(orders.order_date) AS year, SUM(orders.amount) AS sales');
		$this->db->from('orders');
		$this->db->where('affiliate_id',$id);
		$this->db->group_by('MONTH(orders.order_date)');
		$this->db->limit(6);
		$this->db->order_by('MONTH(orders.order_date)','ASC');
		
		$query = $this->db->get();

		return $query->result();
	}
	
	function get_this_year_sales($year,$id)
	{
		$query = $this->db->query('SELECT TRUNCATE(SUM(amount+shipping+service+surcharge-discount-coupon+tax),2) AS total,LEFT(order_date,7) AS monthofyear FROM orders
									WHERE LEFT(order_date,4)="'.$year.'" AND status_id=2 AND affiliate_id='.$id.'
									GROUP BY LEFT(order_date,7)
									ORDER BY LEFT(order_date,7) ASC');							
		return $query->result();
	
	}
	
	function updateMyInfo($vars)
	{
		$data = array('user_email'=>$vars['user_email'],
			      'user_business'=>$vars['user_business'],
			      'user_password'=>$vars['user_password'],
			      'user_firstname'=>$vars['user_firstname'],
			      'user_lastname'=>$vars['user_lastname'],
			      'user_address1'=>$vars['user_address1'],
			      'user_city'=>$vars['user_city'],
			      'user_postalcode'=>$vars['user_postalcode'],
			      'user_province'=> $vars['province_id'],
			      'user_country_id'=>$vars['country_id'],
			      'user_phone1'=>$vars['user_phone1']);
		
		$this->db->where('user_id',$this->session->userdata('affiliate_id'));
		$this->db->update('users',$data);
		
		return $this->db->affected_rows();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_order($id)
	{
		$query = $this->db->query('SELECT * FROM orders o
								   LEFT JOIN billing_details bd ON o.cart_id=bd.cart_id
								   WHERE o.invoice_id="'.$id.'"');							
		return $query->result();					   
	}
	
	function get_order_items($id,$id3)
	{
		
		$query = $this->db->query('SELECT *,p.product_id,pp.price_val FROM order_items oi
									LEFT JOIN orders o ON oi.cart_id=o.cart_id 
									LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
									LEFT JOIN products p ON oi.product_id=p.product_id
									LEFT JOIN product_prices pp ON oi.price_id=pp.price_id
									WHERE oi.cart_id='.$id.' AND o.order_id='.$id3.'
									ORDER BY oi.orderitem_id DESC');
		
		return $query->result();	
			
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function get_email_order_info($id)
	{
		$query = $this->db->query('SELECT * FROM orders o
									LEFT JOIN billing_details bd ON o.cart_id=bd.cart_id
									WHERE o.invoice_id="'.$id.'"');
								   
		return $query->row();		
	
	}
	
	function get_delivery_order_info($id)
	{
		$query = $this->db->query('SELECT * FROM order_items oi
									LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
									WHERE oi.cart_id='.$id.'
									GROUP BY oi.cart_id
									ORDER BY oi.orderitem_id ASC');
								   
		return $query->row();		
	
	}
	
	function get_delivery_order_info_details($id)
	{
		$query = $this->db->query('SELECT * FROM order_items oi
									LEFT JOIN products p ON oi.product_id=p.product_id
									LEFT JOIN product_prices pp ON oi.price_id=pp.price_id
									LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
									WHERE oi.cart_id='.$id.'
									ORDER BY oi.orderitem_id ASC');
								   
		return $query->result();		
	
	}
	
	
	
	
	
	
	

	
} 