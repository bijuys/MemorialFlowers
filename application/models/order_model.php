<?php

class Order_model extends CI_Model {
    
    function Order_model() {
        parent::__construct();
    }
    
    function count_orders()
    {
        return $this->db->count_all('orders');        
    }
    
    function getTrackItems($id)
    {
        
        $this->db->from('order_items');
	$this->db->join('orders','order_items.cart_id=orders.cart_id','left');
	$this->db->join('billing_details','billing_details.cart_id=orders.cart_id','left');
	$this->db->where('order_items.orderitem_id',$id);
	
	$query = $this->db->get();
        
        return $query->result();
    }
    
    function updateTracking($vars)
    {
        $data = array('tracking_code'=>$vars['tracking_code']);
        
        $this->db->where('orderitem_id',$vars['orderitem_id']);
        $this->db->update('order_items',$data);
        
        return TRUE;       
        
    }
   

    function get_totals_calendar_orders($id)
	{
	
		$query = $this->db->query('SELECT o.order_id, o.invoice_id, COUNT(*) AS total, oi.delivery_date, MID(oi.delivery_time,1,5) AS tim, dd.firstname, dd.lastname FROM order_items oi
									LEFT JOIN orders o ON oi.cart_id=o.cart_id
									LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
									WHERE o.status_id=2 AND o.affiliate_id='.$id.'
									GROUP BY CONCAT(dd.firstname," ",dd.lastname), oi.delivery_date
									ORDER BY oi.delivery_date DESC');
								   
		return $query->result();					   
	
	}
	
	function get_email_order_info($id)
	{
		$query = $this->db->query('SELECT * FROM orders o
									LEFT JOIN billing_details bd ON o.cart_id=bd.cart_id
									WHERE o.invoice_id="'.$id.'"');
								   
		return $query->row();		
	
	}
	
	function get_funeral_homes_list()
	{
		
		$query = $this->db->query('SELECT * FROM sci_list
								   ORDER BY sci_id ASC');
								   
		return $query->result();
	
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
	
	function get_totals_calendar_orders2($id,$id2,$id3,$id4,$id5)
	{
	
		$query = $this->db->query('SELECT o.invoice_id, oi.delivery_date, CONCAT(dd.firstname, " ", dd.lastname) AS recipient, dd.city AS city2, p.product_picture, p.product_name, TRUNCATE((o.amount+o.tax+o.shipping-o.coupon-o.company_less-o.discount+o.service+o.surcharge), 2) AS total FROM orders o 
		LEFT JOIN billing_details bd ON o.cart_id=bd.cart_id
LEFT JOIN order_items oi ON bd.cart_id=oi.cart_id
LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id
LEFT JOIN products p ON oi.product_id=p.product_id
LEFT JOIN countries c ON bd.country_id=c.country_id
WHERE o.status_id=2 AND o.affiliate_id='.$id.' AND oi.delivery_date="'.$id2.'" AND oi.delivery_time="'.$id3.'" AND dd.firstname="'.$id4.'" AND dd.lastname="'.$id5.'"			
ORDER BY o.order_id DESC');
								   
		return $query->result();					   
	
	}


   
    function get_orders($offset=0,$num=100)
    {
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          b.firstname AS bfirstname, b.lastname AS blastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('billing_details b','orders.cart_id=b.cart_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;
	
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    function count_month()
    {
        $start = date('Y-m-01 00:00:00',time());
        $end = date('Y-m-d 23:59:59',time());
        
        $this->db->select('*,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        
        return $this->db->count_all_results();
    }
    
    function get_month($offset=0,$limit=999)
    {
        $start = date('Y-m-01 00:00:00',time());
        $end = date('Y-m-d 23:59:59',time());
        
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;
	
        $this->db->limit($limit,$offset);
    
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function count_yesterday()
    {
        $start = date('Y-m-d 00:00:00',time() - (24*60*60));
        $end = date('Y-m-d 23:59:59',time()- (24*60*60));
        
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        
        return $this->db->count_all_results();
    }
    
    function get_yesterday($offset='0',$limit=999)
    {
        $start = date('Y-m-d 00:00:00',time() - (24*60*60));
        $end = date('Y-m-d 23:59:59',time() - (24*60*60));
        
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;
	
        $this->db->limit($limit,$offset);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function count_todays()
    {
        
        $start = date('Y-m-d 00:00:00',time());
        $end = date('Y-m-d 23:59:59',time());
        
        $this->db->select('*,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        
        return $this->db->count_all_results();
    }
    
    function get_todays($offset=0,$limit=999)
    {
        $start = date('Y-m-d 00:00:00',time());
        $end = date('Y-m-d 23:59:59',time());
        
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where("orders.order_date >=",$start);
        $this->db->where("orders.order_date <=",$end);
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;	
	
        $this->db->limit($limit,$offset);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function count_pending()
    {
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where('orders.status_id','1');
        
        return $this->db->count_all_results();
    }
    
    function get_pending($offset=0,$limit=999)
    {
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where('orders.status_id','1');
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;
	
        $this->db->limit($limit,$offset);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function count_completed()
    {
        $this->db->select('*,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->where('orders.status_id','2');
        
        return $this->db->count_all_results();
        
    }
    
    function get_completed($offset=0,$limit=999999)
    {
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where('orders.status_id','2');
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
	
	$offset = empty($offset) ? '0':$offset;
	
        $this->db->limit($limit,$offset);
        
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_cancelled()
    {
        $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          COUNT(order_items.orderitem_id) AS items');
        $this->db->from('orders');
        $this->db->join('billing_details b','b.cart_id=orders.cart_id','left');
        $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id');
        $this->db->where('orders.status_id','0');
        $this->db->group_by('orders.order_id');
        $this->db->order_by('orders.order_id','DESC');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function update_addon($vars)
    {
        if(count($vars['addon']))
        {
            foreach($vars['addon'] as $key=>$val)
            {
                if($val==0)
                {
                    $this->db->delete('order_addons',array('order_addon_id'=>$key));
                }
                else
                {
                    $data = array('addon_quantity'=>$val);
                    $this->db->where('order_addon_id',$key);
                    $this->db->update('order_addons',$data);
                }
                
                return $this->db->affected_rows();
            }
        }
    }
    
    function is_cart_empty($cart_id=0)
    {
        if($cart_id>0)
        {
            $this->db->from('order_items');
            $this->db->where('cart_id',$cart_id);
            if($this->db->count_all_results()>0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;    
        }

    }
    
    function update_Billing($cart_id,$vars)
    {
        
        if(!$this->is_cart_empty($cart_id))
        {
            $this->db->set('firstname',$vars['firstname']);
            $this->db->set('lastname',$vars['lastname']);
            $this->db->set('address1',$vars['address1']);
            $this->db->set('address2',$vars['address2']);
            $this->db->set('postalcode',$vars['postalcode']);
            $this->db->set('city',$vars['city']);
            $this->db->set('province',$vars['province']);
            $this->db->set('country_id',$vars['country_id']);
            $this->db->set('email',$vars['email']);
            $this->db->set('dayphone',$vars['dayphone']);
            $this->db->set('evephone',$vars['evephone']);
            $this->db->set('cart_id',$cart_id);
            
            if($this->is_billing_entered($cart_id))
            {
                $this->db->where('cart_id',$cart_id);
                $this->db->update('billing_details',$data);
                return TRUE;
            }
            else
            {
                $this->db->insert('billing_details',$data);
                return $this->db->insert_id();
            }
        }
        else
        {
            return false;           
        }
    }
    
    function update_Delivery($cart_id,$vars)
    {
           	    	
        $orderitems = $vars['orderitem_id'];
        
        if(!$this->is_cart_empty($cart_id) && count($orderitems))
        {
            
            foreach($orderitems as $key=>$val)
            {
                $this->db->from('order_items');
                $check = $this->db->where('orderitem_id',$val);
                $check= $this->db->where('cart_id',$cart_id);
		

                
                if($this->db->count_all_results()>0)   // if item in cart actually exists!
                {

                    $this->db->set('delivery_date',$vars['delivery_date'][$val]);
		    $this->db->set('enclose_card',isset($vars['enclose_card'][$val]) ? $vars['enclose_card'][$val]:'0');
                    $this->db->set('card_message',$vars['card_message'][$val]);
					$this->db->set('ribbon_text',$vars['ribbon_message'][$val]);
                    $this->db->set('occasion_id',$vars['occasion_id'][$val]);
                    $this->db->set('postalcode',$vars['postalcode'][$val]);
                    
                    $this->db->where('orderitem_id',$val);
                    $this->db->update('order_items',$idata);
                    
                    $this->db->set('firstname',$vars['firstname'][$val]);
                    $this->db->set('lastname',$vars['lastname'][$val]);
		            $this->db->set('location_type',$vars['location_type'][$val]);
					
			      $this->db->set('location_type_name',isset($vars['location_type_name'][$val]) ? $vars['location_type_name'][$val]:'');
			
                    $this->db->set('address1',$vars['address1'][$val]);
                    $this->db->set('address2',$vars['address2'][$val]);
                    $this->db->set('postalcode',$vars['postalcode'][$val]);
                    $this->db->set('city',$vars['city'][$val]);
                    $this->db->set('province',$vars['province'][$val]);
                    $this->db->set('country_id',$vars['country_id'][$val]);
                    $this->db->set('email',isset($vars['email'][$val]) ? $vars['email'][$val]:'');
                    $this->db->set('dayphone',$vars['dayphone'][$val]);
                    $this->db->set('evephone',$vars['evephone'][$val]);
                    $this->db->set('orderitem_id',$vars['orderitem_id'][$key]);
                    
                    if($this->is_delivery_created($val))
                    {
                        $this->db->where('orderitem_id',$val);
                        $this->db->update('delivery_details',$data);
			
                    }
                    else
                    {
                        $this->db->insert('delivery_details',$data);

                    }
                    
                }
                else
                {
                	return false;
                }
            }
            
        }
        else
        {
            return false;
        }
        
        return true;
    }
    
    
    function updateDelivery($cart_id,$val,$vars)
    {
           	    	
        
        if(!$this->is_cart_empty($cart_id))
        {
	    $this->db->from('order_items');
	    $check = $this->db->where('orderitem_id',$val);
	    $check= $this->db->where('cart_id',$cart_id);
	    
	    if($this->db->count_all_results()>0)   // if item in cart actually exists!
	    {
		
		list($day,$month,$year) = explode('-',$vars['delivery_date']);

		$this->db->set('delivery_date',$year.'-'.$month.'-'.$day);
		$this->db->set('enclose_card',isset($vars['enclose_card']) ? $vars['enclose_card']:'0');
		$this->db->set('card_message',$vars['card_message']);
		$this->db->set('ribbon_text',$vars['ribbon_message']);
		$this->db->set('occasion_id',$vars['occasion_id']);
		$this->db->set('postalcode',$vars['postalcode']);
		
		$this->db->where('orderitem_id',$val);
		$this->db->update('order_items',$idata);
		
		$this->db->set('firstname',$vars['firstname']);
		$this->db->set('lastname',$vars['lastname']);
		$this->db->set('location_type',$vars['location_type']);
		$this->db->set('address1',$vars['address1']);
		$this->db->set('address2',$vars['address2']);
		$this->db->set('postalcode',$vars['postalcode']);
		$this->db->set('city',$vars['city']);
		$this->db->set('province',$vars['province']);
		$this->db->set('country_id',$vars['country_id']);
		$this->db->set('email',isset($vars['email']) ? $vars['email']:'');
		$this->db->set('dayphone',$vars['dayphone']);
		$this->db->set('evephone',$vars['evephone']);
		$this->db->set('orderitem_id',$vars['orderitem_id']);
		
		if($this->is_delivery_created($val))
		{
		    $this->db->where('orderitem_id',$val);
		    $this->db->update('delivery_details',$data);    
		}
		
	    }
	    else
	    {
		    return false;
	    }

            
        }
        else
        {
            return false;
        }
        
        return true;
    }
    
    

    
    function is_delivery_created($id)
    {
    	$this->db->from('delivery_details');
    	$this->db->where('orderitem_id',$id);
    	
    	$query = $this->db->get();
    	
    	return $query->num_rows();
    	
    }
    
    function is_billing_entered($cart_id=0)
    {
        if($cart_id>0)
        {
            $this->db->from('billing_details');
            $this->db->where('cart_id',$cart_id);
            if($this->db->count_all_results()>0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;            
        }
    }
    
    
    
    function is_delivery_entered($cart_id=0,$item=0)
    {
    	
        if($cart_id>0)
        {
            $this->db->from('order_items');
            $this->db->where('cart_id',$cart_id);
            
            if($item>0)
            {
                $this->db->where('orderitem_id',$item);
            }
            
            $query = $this->db->get();            
            $res = $query->result();
            
            $total = $query->num_rows();
            
            foreach($res as $row)
            {
                $this->db->from('delivery_details');
                $this->db->where('orderitem_id',$row->orderitem_id);
                if($this->db->count_all_results()==0)
                {
                    return false;
                }
            }
            
            if($total>0)
            {
                return true;
            }
            
        }
        else
        {
            return false;
        }
    }
    

	function is_delivery_date_entered($cart_id=0 )
    {
		if($cart_id>0)
        {
            $this->db->from('order_items');
            $this->db->where('cart_id',$cart_id);          
           
            
            $query = $this->db->get();            
            $res = $query->result();
            
            $total = $query->num_rows();
            
			//$str = "";
            foreach($res as $row)
            { 
			
			//$str .= $row->delivery_date." \n ";
			            
                if($row->delivery_date == NULL || $row->delivery_date == "0000-00-00" || $row->delivery_date == "" )
                {
                    return false;
                }
            }
           // seef($str); exit;
            
                return true;
            
            
        }
        else
        {
            return false;
        }
		
	}


    function getBilling($cart_id=0)
    {
        if($cart_id>0)
        {
            
            $this->db->from('order_items');
            $this->db->join('billing_details','order_items.cart_id=billing_details.cart_id','left');
            $this->db->where('order_items.cart_id',$cart_id);
            $query = $this->db->get();
            
            if($query->num_rows()>0)
            {
                return $query->row();                
            }
            
        }
        else
        {
            return false;            
        }
    }
	
	function getBilling2($id)
    {
       
            
            $this->db->from('users');
            //$this->db->join('billing_details','order_items.cart_id=billing_details.cart_id','left');
            $this->db->where('user_id',$id);
            $query = $this->db->get();
            
           
                return $query->row();                
           
            
       
    }
    
    function getCompany($cart_id=0)
    {
        if($cart_id>0)
        {
            
            $this->db->from('order_items');
            $this->db->join('billing_details','order_items.cart_id=billing_details.cart_id','left');
            $this->db->where('order_items.cart_id',$cart_id);
            $query = $this->db->get();
            
            if($query->num_rows()>0)
            {
                return $query->row();                
            }
            
        }
        else
        {
            return false;            
        }
        
    }
    
    function getCustomerForBilling($customer_id=0)
    {

        $this->db->select('user_firstname AS firstname, user_lastname AS lastname,
                          user_address1 AS address1, user_address2 AS address2,
                          user_city AS city, user_postalcode AS postalcode,
                          user_province AS province, user_country_id AS country_id,
                          user_phone1 AS dayphone, user_phone2 AS evephone,
                          user_email AS email');
        $this->db->from('users');
        $this->db->where('user_id',$customer_id);
        $query = $this->db->get();
        
        return $query->row();

    }
    
    
    function getDelivery($cart_id=0)
    {
        if($cart_id>0)
        {
            $this->db->select('*, order_items.orderitem_id AS orderitem_id, order_items.postalcode AS opostalcode');
            $this->db->from('order_items');
            $this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
            $this->db->join('products','order_items.product_id=products.product_id','left');
            $this->db->group_by('order_items.orderitem_id');
            $this->db->where('order_items.cart_id',$cart_id);
            $query = $this->db->get();
            
            if($query->num_rows()>0)
            {
                $cart = array();
        
                foreach($query->result() as $item)
                {
                    $this->db->from('order_addons');
                    $this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id','left');
                    $this->db->where('orderitem_id',$item->orderitem_id);
                    $query = $this->db->get();
                    $item->addons = $query->result();
                    $cart[] = $item;
                }
                
                return $cart;
                              
            }            
            
        }
        else
        {
            return false;           
        }
    }
    
    function get_Delivery($cart_id=0,$orderitem_id=0)
    {
        if($cart_id>0)
        {
            $this->db->select('*, delivery_details.location_type AS location_type, order_items.orderitem_id AS orderitem_id, order_items.postalcode AS opostalcode');
            $this->db->from('order_items');
            $this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
            $this->db->join('products','order_items.product_id=products.product_id','left');
            $this->db->where('order_items.cart_id',$cart_id);
	    $this->db->where('order_items.orderitem_id',$orderitem_id);
            $query = $this->db->get();

            if($query->num_rows()>0)
            {
		$item = $query->row();
		
		$this->db->from('order_addons');
                $this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id','left');
                $this->db->where('orderitem_id',$item->orderitem_id);
                $query = $this->db->get();
                $item->addons = $query->result();		
                
                return $item;  
            }
	    else
	    {
		return false;
	    }
            
        }
        else
        {
            return false;           
        }
    }
    
    function createOrder() {
        
        $sessionid = $this->session->userdata('sessionid');
        $this->db->from('order_items');
        $this->db->where('session_id');    
        
    }
    
    function remove($id) {
        
        $this->db->delete('order_items',array('orderitem_id'=>$id));
        $affected = $this->db->affected_rows();
        $this->db->delete('order_addons',array('orderitem_id'=>$id));
        $this->db->delete('delivery_details',array('orderitem_id'=>$id));
        
        return $affected;
    
    }
    
    function get_cart($cart_id=0) {
        
        $this->db->from('order_items');
        $this->db->join('products','order_items.product_id=products.product_id','left');
		$this->db->join('product_prices','order_items.price_id=product_prices.price_id','left');
        $this->db->where('cart_id',$cart_id);
        $query = $this->db->get();
        
        $cart = array();
        
        foreach($query->result() as $item)
        {
            $this->db->from('order_addons');
            $this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id','left');
            $this->db->join('addon_prices','order_addons.addon_price_id=addon_prices.addonprice_id','left');
            $this->db->where('orderitem_id',$item->orderitem_id);
            $query = $this->db->get();
            $item->addons = $query->result();
            $cart[] = $item;
        }
        
        return $cart;
        
    }
    
	function insert_similar_product($id,$id2)
	{
	
		$this->db->set('session_id',$id);
		$this->db->set('product_id',$id2);
		$this->db->insert('similar_pro');
	
	}
	
    function get_fullcart($cart_id=0) {
        
	$this->db->select('*,delivery_methods.description AS delivery_description,order_items.orderitem_id AS orderitem_id');
        $this->db->from('order_items');
        $this->db->join('products','order_items.product_id=products.product_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
	    $this->db->join('product_prices','order_items.price_id=product_prices.price_id','left');
        $this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
        $this->db->where('cart_id',$cart_id);
        $query = $this->db->get();
        
        $cart = array();
        
        foreach($query->result() as $item)
        {
            $this->db->from('order_addons');
            $this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id','left');
            $this->db->where('orderitem_id',$item->orderitem_id);
            $query = $this->db->get();
            $item->addons = $query->result();
            $cart[] = $item;
        }
        
        return $cart;
        
    }
    
    function getAddress($cart_id,$orderitem_id)
    {
        $this->db->from('order_items');
        $this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
        $this->db->where('order_items.cart_id',$cart_id);
        $this->db->where('order_items.orderitem_id',$orderitem_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function add_to_cart($vars,$precio_id,$precio_nombre)
    {
	
	
               
        if($vars['product_id']!='' && $vars['price_id']!='') {
        
            $this->db->from('products');
            $this->db->join('product_prices','products.product_id=product_prices.product_id');
            $this->db->where(array('products.product_id'=>$vars['product_id'],
                                   'product_prices.price_id'=>$precio_id));
            $this->db->group_by('products.product_id');
            $query = $this->db->get();
	    
    	    $additional = 0;
    	    
    	    if(isset($vars['special_delivery']) && $vars['special_delivery']==1)
    	    {
        	$vars['delivery_date'] = date('d-m-Y',time());
    	    }

            list($day,$month,$year) = explode('-',$vars['delivery_date']);
            
            $result = $query->result();
            
            foreach($result as $row)
            {
				/*
				$pieces = explode("__", $row->price_id);
				$precio_id = $pieces[0];
				$precio_nombre = $pieces[1];
				*/
				
		
                $cart_id = $this->session->userdata('cart_id');
		        $last_id = 0;
			
		$vaseID = $this->session->userdata('vaseID');
                
                if(!isset($cart_id) || empty($cart_id) || $cart_id<1 || $cart_id==NULL)
		{
		    
        		    if($this->db->insert('carts',array('created_time'=>date('Y-m-d H:i:s',time()))))
        		    {
            			$cart_id = $this->db->insert_id();
            			
            			$this->db->set('cart_id',$cart_id);
            			$this->db->set('product_id',$row->product_id);
            			//$this->db->set('price_id',$row->price_id);
						$this->db->set('price_id',$precio_id);
						$this->db->set('product_size',$precio_nombre);
						$this->db->set('category',$vars['category']);
            			$this->db->set('product_name',$row->product_name);
						$this->db->set('delivery_time',$vars['upcoming_time']);
						
						if($vars['ribbon_text']!=''){
							$this->db->set('ribbon_text',$vars['ribbon_text']);
						}
						$this->db->set('delivery_date',$vars['delivery_date']);
						//$this->db->set('ribbon_text',$vars['ribbon_text']);
            			$this->db->set('product_price',$row->price_value-($row->price_value*$this->session->userdata('disco')));
            			//$this->db->set('delivery_date',$year. '-'.$month.'-'.$day);
            			$this->db->set('postalcode','');
$this->db->set('card_message',$vars['card_message']);
                                        if(isset($vars['home_id']) && is_numeric($vars['home_id']) && $vars['home_id']>0)
                                        {
                                            $this->db->set('funeral_home_id',$vars['home_id']);
                                        }

				if(!empty($vaseID)) { $this->db->set('vase_id',$vaseID);}
			
            			if(isset($vars['special_delivery']) && $vars['special_delivery']==1)
            			{
            			    $this->db->set('special_delivery',1);
            			}
			
				$this->db->insert('order_items');
				$last_id = $this->db->insert_id();
		   
				$this->session->set_userdata('cart_id',$cart_id);			
		           }
		    
               }
		else
		{
		 
			 $query = $this->db->get_where('carts',array('cart_id'=>$cart_id,
							     'completed'=>'0'));
		 
			 if($query->num_rows())
			 {
				     $cart = $query->row();
				     
				    $this->db->set('cart_id',$cart_id);
				    $this->db->set('product_id',$row->product_id);
				    //$this->db->set('price_id',$row->price_id);
						$this->db->set('price_id',$precio_id);
						$this->db->set('product_size',$precio_nombre);
					$this->db->set('category',$vars['category']);
				    $this->db->set('product_name',$row->product_name);
				    $this->db->set('product_price',$row->price_value-($row->price_value*$this->session->userdata('disco')) + $additional);
				    //$this->db->set('delivery_date',$year. '-'.$month.'-'.$day);
					$this->db->set('delivery_date',$vars['delivery_date']);
						$this->db->set('delivery_time',$vars['upcoming_time']);
					
					if($vars['ribbon_text']!=''){
							$this->db->set('ribbon_text',$vars['ribbon_text']);
						}
					
				    $this->db->set('postalcode',$vars['postalcode']);

                                                        if(isset($vars['home_id']) && is_numeric($vars['home_id']) && $vars['home_id']>0)
                                                        {
                                                            $this->db->set('funeral_home_id',$vars['home_id']);
                                                        }
				    
				    if(!empty($vaseID)) { $this->db->set('vase_id',$vaseID);}
				     
				     if(isset($vars['special_delivery']) && $vars['special_delivery']==1)
				     {
					 $this->db->set('special_delivery',1);
				     }
				     $this->db->set('card_message',$vars['card_message']);
				     $this->db->insert('order_items');
				     
				     $last_id = $this->db->insert_id();
			     
			 }
		 
	     }
                
	    if(isset($vars['addon']) && count($vars['addon']) && $last_id>0)
	    {
		
		foreach($vars['addon'] as $addon_id=>$quantity)
		{
		    $aprice = $vars['option'][$addon_id];
		    if($quantity>0)
		    {
			$this->db->from('addon_products');
			$this->db->join('addon_prices','addon_products.addon_id=addon_prices.addon_id','left');
			$this->db->group_by('addon_products.addon_id');
			$this->db->where('addon_products.addon_id',$addon_id);
			$this->db->where('addon_prices.addonprice_id',$vars['option'][$addon_id]);

			$query = $this->db->get();
			$addon = $query->row();
			
			$this->db->set('orderitem_id',$last_id);
			$this->db->set('addon_id',$addon_id);
			$this->db->set('addon_name',$addon->addon_name);
			$this->db->set('addon_price',$addon->price);
			$this->db->set('addon_price_id',$aprice);
			$this->db->set('addon_quantity',$quantity);
				      
			$this->db->insert('order_addons');
		    }
		
		}             
		
	    }
        
                return true;
                
            }
            
        }
        else
        {
            return false;
        }
    }
    
    
    function add_to_mycart($vars)
    {
	
	
               
        if($vars['product_id']!='' && $vars['price_id']>0) {
        
            $this->db->from('products');
            $this->db->join('product_prices','products.product_id=product_prices.product_id');
            $this->db->where(array('products.product_id'=>$vars['product_id'],
                                   'product_prices.price_id'=>$vars['price_id']));
            $this->db->group_by('products.product_id');
            $query = $this->db->get();
	    
    	    $additional = 0;
            
            $result = $query->result();
            
            foreach($result as $row)
            {
		

		
                $cart_id = $this->session->userdata('cart_id');
		        $last_id = 0;
			
		$vaseID = $this->session->userdata('vaseID');
                
                if(!isset($cart_id) || empty($cart_id) || $cart_id<1 || $cart_id==NULL)
		{
		    
        		    if($this->db->insert('carts',array('created_time'=>date('Y-m-d H:i:s',time()))))
        		    {
            			$cart_id = $this->db->insert_id();
						
						//if()
            			
            			$this->db->set('cart_id',$cart_id);
            			$this->db->set('product_id',$row->product_id);
						$this->db->set('price_id',$row->price_id);
            			$this->db->set('product_name',$row->product_name);
            			$this->db->set('product_price',$row->price_value-($row->price_value*$this->session->userdata('disco')));
				if(!empty($vaseID)) { $this->db->set('vase_id',$vaseID);}
			
				$this->db->insert('order_items');
				$last_id = $this->db->insert_id();
		   
		   //redirect(base_url().'mymemorial/products');
			     
		   
				$this->session->set_userdata('cart_id',$cart_id);			
		           }
		    
               }
		else
		{
		 
			 $query = $this->db->get_where('carts',array('cart_id'=>$cart_id,
							     'completed'=>'0'));
		 
			 if($query->num_rows())
			 {
				     $cart = $query->row();
				     
				    $this->db->set('cart_id',$cart_id);
				    $this->db->set('product_id',$row->product_id);
				    $this->db->set('price_id',$row->price_id);
				    $this->db->set('product_name',$row->product_name);
				    $this->db->set('product_price',$row->price_value-($row->price_value*$this->session->userdata('disco')) + $additional);
				    
				    if(!empty($vaseID)) { $this->db->set('vase_id',$vaseID);}
				     
				     if(isset($vars['special_delivery']) && $vars['special_delivery']==1)
				     {
					 $this->db->set('special_delivery',1);
				     }
				     
				     $this->db->insert('order_items');
				     
				     $last_id = $this->db->insert_id();
					 
					 //redirect(base_url().'mymemorial/products');
			     
			 }
		 
	     }
                
	    if(isset($vars['addon']) && count($vars['addon']) && $last_id>0)
	    {
		
		foreach($vars['addon'] as $addon_id=>$quantity)
		{
		    $aprice = $vars['option'][$addon_id];
		    if($quantity>0)
		    {
			$this->db->from('addon_products');
			$this->db->join('addon_prices','addon_products.addon_id=addon_prices.addon_id','left');
			$this->db->group_by('addon_products.addon_id');
			$this->db->where('addon_products.addon_id',$addon_id);
			$this->db->where('addon_prices.addonprice_id',$vars['option'][$addon_id]);

			$query = $this->db->get();
			$addon = $query->row();
			
			$this->db->set('orderitem_id',$last_id);
			$this->db->set('addon_id',$addon_id);
			$this->db->set('addon_name',$addon->addon_name);
			$this->db->set('addon_price',$addon->price);
			$this->db->set('addon_price_id',$aprice);
			$this->db->set('addon_quantity',$quantity);
				      
			$this->db->insert('order_addons');
		    }
		
		}             
		
	    }
        
                return true;
                
            }
            
        }
        else
        {
            return false;
        }
    }
    

    function createMyOrder($cart_id,$totals,$customer_id=0,$affiliate_id=0,$pay='credit_card')
    {
        $data = array('cart_id'=>$cart_id,
                      'user_id'=>$customer_id,
                      'affiliate_id'=>0,
                      'ipaddress'=>$_SERVER['REMOTE_ADDR'],
                      'order_date'=>date('Y-m-d H:i:s',time()),
                      'amount'=>number_format($totals['itemtotal'],2),
                      'shipping'=>number_format($totals['shipping'],2),
                      'coupon'=>number_format($totals['coupon'],2),
        	      'service'=>number_format($totals['service'],2),
		      'surcharge'=>number_format($totals['surcharge'],2),
                      'discount'=>number_format($totals['discount'],2),
                      'tax'=>number_format($totals['tax'],2),
                      'status_id'=>2,
                      'coupon_code'=>$totals['coupon_code'],
                      'payment_method'=>$pay);
        
        $this->db->select('c.*');
        $this->db->from('users u');
        $this->db->join('users c','u.parent_id=c.user_id','left');
        $this->db->where('u.user_id',$customer_id);
        $query = $this->db->get();
        
        foreach($query->result() as $cust)
        {
            if($cust->user_id && $cust->user_role=='company')
            {
                $data['company_id'] = $cust->user_id;
                
                if($cust->double_discount!=1)
                    $data['commission'] = ($cust->business_discount*$totals['itemtotal'])/100;
                else
                    $data['commission'] = 0;
            }
            else
            {
                if($affiliate_id>0)
                {
                   $data['affiliate_id'] = $affiliate_id;
                    //$data['affiliate_id'] = 716;
                    $this->db->from('users');
                    $this->db->where('user_id',$affiliate_id);
                    $this->db->where('user_role','affiliate');
                    $query = $this->db->get();
                    
                    $row = $query->row();
                    $data['commission'] = ($row->affiliate_commission*$totals['itemtotal'])/100;
                }                
            }
            
        }
        
        
        
        if($this->db->insert('orders',$data))
        {
            $order_id = $this->db->insert_id();
	    
	    $this->db->where('order_id',$order_id);
	    $this->db->update('orders',array('invoice_id'=>'18HCA'.$order_id));
	    
            return '18HCA'.$order_id;
        
        }
        else
        {
            return false;
        }
        
        
    }
	
	
	function update_item_card_message($text,$id)
	{
	
		$this->db->where('orderitem_id',$id);
        $this->db->update('order_items',array('card_message'=>$text));
	
	}
    
    
    function create_Order($cart_id,$totals,$customer_id=0,$affiliate_id=0,$pay='credit_card',$ban_id)
    {
        
		 if($customer_id<>0 && $affiliate_id<>0){
						$ser=0;
					  }else{
						$ser=number_format($totals['service'],2);
					  }
		
		
		$data = array('cart_id'=>$cart_id,
                      'user_id'=>$customer_id,
                      'affiliate_id'=>$affiliate_id,
                      'ipaddress'=>$_SERVER['REMOTE_ADDR'],
                      'order_date'=>date('Y-m-d H:i:s',time()),
                      'amount'=>round($totals['itemtotal'],2),
                      'shipping'=>round($totals['shipping'],2),
                      'coupon'=>round($totals['coupon'],2),
					  'service'=>$ser,
					  'surcharge'=>round($totals['surcharge'],2),
                      'discount'=>round($totals['discount'],2),
                      'tax'=>round($totals['tax'],2),
                      'status_id'=>2,
                      'coupon_code'=>$totals['coupon_code'],
                      'payment_method'=>$pay,
					  'ban_id'=>$ban_id,
					  'funeralhome_id'=>$this->session->userdata('fhid'),
					  'person_id'=>$this->session->userdata('pid'),
					  'cobrand'=>$this->session->userdata('cobrand'));

					  
	//San has added this code on 12-7-2013 cuz customer id was 0 and commssion was not adding to affiliate if purchasing was through basic-funeral link.				  
	if(($customer_id==0) && ($affiliate_id>0))
	{
		$customer_id=$affiliate_id;
	}
	// upto here
        
        $this->db->select('c.*');
        $this->db->from('users u');
        $this->db->join('users c','u.parent_id=c.user_id','left');
        $this->db->where('u.user_id',$customer_id);
        $query = $this->db->get();
        
        foreach($query->result() as $cust)
        {
            if($cust->user_id && $cust->user_role=='company')
            {
                $data['company_id'] = $cust->user_id;
                
                if($cust->double_discount!=1)
                    $data['commission'] = ($cust->business_discount*$totals['itemtotal'])/100;
                else
                    $data['commission'] = 0;
            }
            else
            {
                if($affiliate_id>0)
                {
                    $data['affiliate_id'] = $affiliate_id; 
                    
                    $this->db->from('users');
                    $this->db->where('user_id',$affiliate_id);
				    //$this->db->where('user_id', '378');
                    $this->db->where('user_role','affiliate');
                    $query = $this->db->get();
                    
                    $row = $query->row();
                    $data['commission'] = ($row->affiliate_commission*$totals['itemtotal'])/100;
                }                
            }
            
        }
        
        if($this->db->insert('orders',$data))
        {
            $order_id = $this->db->insert_id();
	    
	    $this->db->where('order_id',$order_id);
	    $this->db->update('orders',array('invoice_id'=>'MEM'.$order_id));
		if($affiliate_id=='')
		{
			$affiliate_id=0;
		}
		
			// integration code starts here
			
			/*
			$this->db = $this->load->database('default', TRUE);
			
		$queryorderitem = "SELECT oi.* FROM order_items oi LEFT JOIN orders o ON o.cart_id = oi.cart_id where o.order_id = ".$order_id;
		$query1orderitem = $this->db->query($queryorderitem);
		if($query1orderitem->num_rows()>0) {
				$new_dataorderitem = $query1orderitem->result_array();
	
		foreach ($new_dataorderitem as $row => $data_justaname_orderitems) {
					$data_justaname_orderitems['db_id']=7;
					$this->third_db = $this->load->database('bics', TRUE);
					$data['bics'] = $this->third_db->insert("order_items", $data_justaname_orderitems);
					$this->db = $this->load->database('default', TRUE);
    							}  
		
		}
		
		
		$this->db = $this->load->database('default', TRUE);
		$queryorders = "SELECT * from orders where order_id=".$order_id;
		$query1orders = $this->db->query($queryorders);		
		if($query1orders->num_rows()>0) {
		
			$new_dataorders = $query1orders->result_array();
			
			foreach ($new_dataorders as $row => $data_justaname_orders) {
			            $this->third_db = $this->load->database('bics', TRUE);
						$data_justaname_orders['db_id']=7;
						$data['bics'] = $this->third_db->insert("orders", $data_justaname_orders);
			            $this->db = $this->load->database('default', TRUE);
			} 	

		}	
		
		$this->db = $this->load->database('default', TRUE);
		foreach ($new_dataorderitem as $row => $data_justaname_orderitems) {
					$orderitem_id=$data_justaname_orderitems['orderitem_id'];
		$query_delivery = "SELECT * from delivery_details where orderitem_id=".$orderitem_id;
		$query1delivery = $this->db->query($query_delivery);		
		if($query1delivery->num_rows()>0) {
		
    			$new_data_delivery = $query1delivery->result_array();
				
				foreach ($new_data_delivery as $row => $data_justaname_delivery) {
					
					$this->third_db = $this->load->database('bics', TRUE);
					$data_justaname_delivery['db_id']=7;
					$data['bics'] = $this->third_db->insert("delivery_details", $data_justaname_delivery);
                    $this->db = $this->load->database('default', TRUE);
					} 
        
			
			
			}	
		}
		
		$this->db = $this->load->database('default', TRUE);
		$querybilling = "SELECT b.* from billing_details b LEFT JOIN orders o ON o.cart_id = b.cart_id where o.order_id=".$order_id;
		$query1billing = $this->db->query($querybilling);		
		if($query1billing->num_rows()>0) {
		
    			$new_data_billing = $query1billing->result_array();
		$this->third_db = $this->load->database('bics', TRUE);	

		foreach ($new_data_billing as $row => $data_justaname_billing) {
		            $this->third_db = $this->load->database('bics', TRUE);
					$data_justaname_billing['db_id']=7;
					$data['bics'] = $this->third_db->insert("billing_details", $data_justaname_billing);
					  $this->db = $this->load->database('default', TRUE);
    							} 		
			
			}	
		
		
		
		
		$this->db = $this->load->database('default', TRUE);
		
		$queryorderitem = "SELECT oi.* FROM order_items oi LEFT JOIN orders o ON o.cart_id = oi.cart_id where o.order_id = ".$order_id;
		// echo "SELECT oi.* FROM order_items oi LEFT JOIN orders o ON o.cart_id = oi.cart_id where o.order_id = ".$order_id;
		$query1orderitem = $this->db->query($queryorderitem);
		if($query1orderitem->num_rows()>0) {
				$new_dataorderitem = $query1orderitem->result_array();
		
		
		foreach ($new_dataorderitem as $row => $data_justaname_orderitems) {
					$orderitem_id=$data_justaname_orderitems['orderitem_id'];
		$query_addon = "SELECT * from order_addons where orderitem_id=".$orderitem_id;
		// echo "SELECT * from order_addons where orderitem_id=".$orderitem_id;
		$query1_addon = $this->db->query($query_addon);		
		if($query1_addon->num_rows()>0) {
		
    			$new_data_addon = $query1_addon->result_array();
				
			foreach ($new_data_addon as $row => $data_justaname_addon) {
					$data_justaname_addon['db_id']=7;
					$this->third_db = $this->load->database('bics', TRUE);
					$data['bics'] = $this->third_db->insert("order_addons", $data_justaname_addon);
					$this->db = $this->load->database('default', TRUE);
    							} 
			
			}	
		}
		
	}
		
			
			*/
									
			
			// integration code ends here
		
		
		
	    
            return 'MEM'.$order_id;
        }
        else
        {
            return false;
        }
	
    }


    /*************************** New Order ********************************************/

    function update_delivery_address($cart,$vars)
    {
              $cart = $this->get_cart($cart);
              $funeralhome = $vars['shipping_to'] == 'funeral home' ? TRUE:FALSE;

              $loc = $this->db->from('provinces')->join('countries','provinces.country_id=countries.country_id','left')
                                         ->where('provinces.province_id',$vars['fh_province_id'])->get()->row();
              
              list($firstname,$lastname,$lastname2,$lastname3,$lastname4,$lastname5) = explode(' ',$vars['fh_name']); 
			  $lastname = $lastname.' '.$lastname2.' '.$lastname3.' '.$lastname4.' '.$lastname5;	
				
				if($lastname==''){
					$lastname = ' ';
				}
				
              foreach($cart as $item)
              {
			  
					if($vars['fh_province_id']==1 || $vars['fh_province_id']=='Alberta' || $vars['fh_province_id']=='AB'){
						$provin_val = 'AB';
					}
					if($vars['fh_province_id']==2 || $vars['fh_province_id']=='British columbia ' || $vars['fh_province_id']=='BC'){
						$provin_val = 'BC';
					}
					if($vars['fh_province_id']==3 || $vars['fh_province_id']=='Manitoba' || $vars['fh_province_id']=='MN'){
						$provin_val = 'MN';
					}
					if($vars['fh_province_id']==4 || $vars['fh_province_id']=='New Brunswick' || $vars['fh_province_id']=='NB'){
						$provin_val = 'NB';
					}
					if($vars['fh_province_id']==5 || $vars['fh_province_id']=='Newfoundland' || $vars['fh_province_id']=='NL'){
						$provin_val = 'NL';
					}
					if($vars['fh_province_id']==6 || $vars['fh_province_id']=='Nova Scotia' || $vars['fh_province_id']=='NS'){
						$provin_val = 'NS';
					}
					if($vars['fh_province_id']==7 || $vars['fh_province_id']=='Nunavut' || $vars['fh_province_id']=='NV'){
						$provin_val = 'NV';
					}
					if($vars['fh_province_id']==8 || $vars['fh_province_id']=='Northwest Territories' || $vars['fh_province_id']=='NW'){
						$provin_val = 'NW';
					}
					if($vars['fh_province_id']==9 || $vars['fh_province_id']=='Ontario' || $vars['fh_province_id']=='ON'){
						$provin_val = 'ON';
					}
					if($vars['fh_province_id']==10 || $vars['fh_province_id']=='Prince Edward Island' || $vars['fh_province_id']=='PE'){
						$provin_val = 'PE';
					}
					if($vars['fh_province_id']==11 || $vars['fh_province_id']=='Quebec' || $vars['fh_province_id']=='PQ'){
						$provin_val = 'PQ';
					}
					if($vars['fh_province_id']==12 || $vars['fh_province_id']=='Saskatchewan' || $vars['fh_province_id']=='SK'){
						$provin_val = 'SK';
					}
					if($vars['fh_province_id']==13 || $vars['fh_province_id']=='Yukon' || $vars['fh_province_id']=='YK'){
						$provin_val = 'YK';
					}
			  
                            $shipdata = array('orderitem_id'=>$item->orderitem_id,
                                        'title'=>'',
                                        'firstname'=>$firstname,
                                        'lastname'=>$lastname,
                                        'address1'=>$vars['fh_address1'],
                                        'address2'=>$vars['fh_address2'],
                                        'postalcode'=>$vars['fh_postalcode'],
                                        'city'=>$vars['fh_city'],
                                        //'province'=>$loc->province_name,
										'province'=>$provin_val,
                                        'country_id'=>$loc->country_id,
                                        'email'=>'',
                                        'dayphone'=>$vars['fh_dayphone'],
                                        'evephone'=>'',
                                        'location_type'=>$vars['shipping_to'],
                                        'location_type_name'=>$vars['fh_location'],
										'location_id'=>$vars['fh_id']);

                            if($this->db->where('orderitem_id',$item->orderitem_id)->count_all_results('delivery_details')>0)
                                        $this->db->where('orderitem_id',$item->orderitem_id)->update('delivery_details',$shipdata);
                            else
                                        $this->db->insert('delivery_details',$shipdata);
              }

              return TRUE;
    }

    function update_billing_address($cart,$vars)
    {
             $loc = $this->db->from('provinces')->join('countries','provinces.country_id=countries.country_id','left')
                                         ->where('provinces.province_id',$vars['province_id'])->get()->row();
              
             list($firstname,$lastname,$lastname2,$lastname3,$lastname4,$lastname5) = explode(' ',$vars['nameoncard']); 
			 $lastname = $lastname.' '.$lastname2.' '.$lastname3.' '.$lastname4.' '.$lastname5;	 
				
				if($lastname==''){
					$lastname = ' ';
				}
				
			 
			if($vars['province_id']==1 || $vars['province_id']=='Alberta' || $vars['province_id']=='AB'){
				$provin_val = 'AB';
			}
			if($vars['province_id']==2 || $vars['province_id']=='British columbia ' || $vars['province_id']=='BC'){
				$provin_val = 'BC';
			}
			if($vars['province_id']==3 || $vars['province_id']=='Manitoba' || $vars['province_id']=='MN'){
				$provin_val = 'MN';
			}
			if($vars['province_id']==4 || $vars['province_id']=='New Brunswick' || $vars['province_id']=='NB'){
				$provin_val = 'NB';
			}
			if($vars['province_id']==5 || $vars['province_id']=='Newfoundland' || $vars['province_id']=='NL'){
				$provin_val = 'NL';
			}
			if($vars['province_id']==6 || $vars['province_id']=='Nova Scotia' || $vars['province_id']=='NS'){
				$provin_val = 'NS';
			}
			if($vars['province_id']==7 || $vars['province_id']=='Nunavut' || $vars['province_id']=='NV'){
				$provin_val = 'NV';
			}
			if($vars['province_id']==8 || $vars['province_id']=='Northwest Territories' || $vars['province_id']=='NW'){
				$provin_val = 'NW';
			}
			if($vars['province_id']==9 || $vars['province_id']=='Ontario' || $vars['province_id']=='ON'){
				$provin_val = 'ON';
			}
			if($vars['province_id']==10 || $vars['province_id']=='Prince Edward Island' || $vars['province_id']=='PE'){
				$provin_val = 'PE';
			}
			if($vars['province_id']==11 || $vars['province_id']=='Quebec' || $vars['province_id']=='PQ'){
				$provin_val = 'PQ';
			}
			if($vars['province_id']==12 || $vars['province_id']=='Saskatchewan' || $vars['province_id']=='SK'){
				$provin_val = 'SK';
			}
			if($vars['province_id']==13 || $vars['province_id']=='Yukon' || $vars['province_id']=='YK'){
				$provin_val = 'YK';
			}		
				
             $billdata = array('cart_id'=>$cart,
                                                    'title'=>'',
                                                    'firstname'=>$firstname,
                                                    'lastname'=>$lastname,
                                                    'address1'=>$vars['address1'],
                                                    'address2'=>$vars['address2'],
                                                    'postalcode'=>$vars['postalcode'],
                                                    'city'=>$vars['city'],
                                                    //'province'=>$loc->province_name,
													'province'=>$provin_val,
                                                    'country_id'=>$loc->country_id,
                                                    'email'=>$vars['email'],
                                                    'dayphone'=>$vars['dayphone'],
                                                    'evephone'=>'');

              if($this->db->where('cart_id',$cart)->count_all_results('billing_details')>0)
              {
                            $this->db->where('cart_id',$cart)->update('billing_details',$billdata);
                            return TRUE;
              }
              else
              {
                            $this->db->insert('billing_details',$billdata);
                            return $this->db->insert_id();
              }
    }



    function new_order($vars,$cart,$totals,$customer)
    {
		$tarjeta = '';
		if(substr($vars['card_number'],0,1)==4){
			$tarjeta = 'Visa';
		}
		if(substr($vars['card_number'],0,2)==51 || substr($vars['card_number'],0,2)==52 || substr($vars['card_number'],0,2)==53 || substr($vars['card_number'],0,2)==54 || substr($vars['card_number'],0,2)==55){
			$tarjeta = 'MasterCard';
		}
		if(substr($vars['card_number'],0,2)==34 || substr($vars['card_number'],0,2)==37){
			$tarjeta = 'American Express';
		}
		
              $data = array('cart_id'=>$cart,
                      'user_id'=>$customer,
                      'affiliate_id'=>$this->session->userdata('referer'),
                      'ipaddress'=>$_SERVER['REMOTE_ADDR'],
                      'order_date'=>date('Y-m-d H:i:s',time()),
                      //'amount'=>round($totals['itemtotal'],2),
					  'amount'=>round($vars['final_pricing'],2),
					  'tax'=>round($vars['final_tax'],2),
                      'shipping'=>round($totals['shipping'],2),
                      'coupon'=>round($totals['coupon'],2),
                      'service'=>round($vars['final_service'],2),
                      'surcharge'=>round($totals['surcharge'],2),
                      'discount'=>round($totals['discount'],2),
                      'tax'=>round($totals['tax'],2),
                      'status_id'=>2,
                      'coupon_code'=>$totals['coupon_code'],
                      'payment_method'=>'credit_card',
                      'ban_id'=>$ban_id,
                      'funeralhome_id'=>$this->session->userdata('fhid'),
                      'person_id'=>$this->session->userdata('pid'),
                      'cobrand'=>$this->session->userdata('cobrand'),
					  'nameoncard'=>$vars['nameoncard'],
					  'cardnumber'=>$vars['card_number'],
					  'cardmonth'=>$vars['exp_month'],
					  'cardyear'=>$vars['exp_year'],
					  'cardcvv'=>$vars['cvv'],
					  'cardtype'=>$tarjeta
					  );

                    if($this->db->insert('orders',$data))
                    {
                        $order_id = $this->db->insert_id();
                    
                        $this->db->where('order_id',$order_id);
                        $this->db->update('orders',array('invoice_id'=>'MEM'.$order_id));

                    
                    
                        return 'MEM'.$order_id;
                    }
                    else
                    {
                        return false;
                    }
    }
    
    
    function getID($num)
    {
	$query = $this->db->get_where('orders',array('invoice_id'=>$num));
	
	if($query->num_rows()>0)
	{
	    $order = $query->row();
	    return $order->order_id;
	}
	
	return false;
	
    }
    
    
    function get_order($id)
    {
        $this->db->select('orders.*,billing_details.*,users.*,status_codes.*, 
                          c.user_firstname AS cfirstname, c.user_lastname AS clastname,
                          c.user_name AS cusername, m.user_business AS company');
        $this->db->from('orders');
        $this->db->where('orders.order_id',$id);
        $this->db->join('billing_details','orders.cart_id=billing_details.cart_id','left');
        $this->db->join('users','orders.affiliate_id=users.user_id','left');
        $this->db->join('status_codes','orders.status_id=status_codes.status_id','left');
        $this->db->join('users c','orders.user_id=c.user_id','left');
        $this->db->join('users m','c.parent_id=m.user_id','left');
        $orders = $this->db->get();
        
        $result = array();
        
        foreach($orders->result() as $order)
        {
        	        	
            $result = $order;
            
            $result->items = array();
            
            $this->db->from('order_items');
            $this->db->where('order_items.cart_id',$order->cart_id);
            $this->db->join('products','order_items.product_id=products.product_id','left');
            $this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
            $this->db->group_by('order_items.orderitem_id');
            
            $items = $this->db->get();
            
            foreach($items->result() as $item)
            {
                $this->db->from('order_addons');
                $this->db->where('order_addons.orderitem_id',$item->orderitem_id);
                $this->db->join('addon_products','order_addons.addon_id=addon_products.addon_id','left');
                
                $addons = $this->db->get();
                
                foreach($addons->result() as $addon)
                {
                    $item->addons[] = $addon;
                }
                
                $result->items[] = $item;      

            }  
             
        }
        
        return $result;
    }
    
    function get_status_codes()
    {
        $this->db->from('status_codes');
        $query = $this->db->get();
        
        return $query->result();
        
    }
    
    
    function set_status($id,$status)
    {
        $query = $this->db->get_where('status_codes',array('status_code'=>$status));
        
        foreach($query->result() as $stat)
        {
            $this->db->set('status_id',$stat->status_id);
            $this->db->where('order_id',$id);
            $this->db->update('orders');
            
            return $this->db->affected_rows();
        }
        
        return false;
    }  


    function get_add_charges($id=0)
    {       
        $shipping = 0;
        $tax = 0;
	$service = 0;
	$surcharge = 0;
        
        $loc = $this->db->query("SELECT * FROM order_items o 
                      LEFT JOIN delivery_details d ON o.orderitem_id=d.orderitem_id
		      LEFT JOIN products p ON o.product_id=p.product_id 
                      WHERE o.orderitem_id = ? ",array($id));

        
        foreach($loc->result() as $delivery)
        {

            $postalcode = strtoupper(str_replace(' ','',trim($delivery->postalcode)));
            $country_id = $delivery->country_id;
            $province = $delivery->postalcode;
            $product_id = $delivery->product_id;
            
            $post = $this->db->query("SELECT * FROM postalcodes p
                         LEFT JOIN cities c ON p.city_id=c.city_id
                         LEFT JOIN provinces r ON c.province_id=r.province_id
                         LEFT JOIN countries n ON r.country_id=n.country_id
                         WHERE REPLACE(UPPER(p.postalcode),' ','')= ?  
                         GROUP BY p.postalcode", array($postalcode));
	    
	    if($delivery->special_delivery==1)
	    {
		$surcharge = 10;
	    }
            
            if($post->num_rows()>0)
            {
                foreach($post->result() as $row)
                {
                    $province_id = $row->province_id;
                    
                    $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='country' AND
                                l.location_id = ? AND p.product_id = ?
                                GROUP BY p.product_id ", array($country_id,$product_id));
                    
                    foreach($coquery->result() as $cores)
                    {
			if($delivery->delivery_method_id==1)
				
				$service += $cores->location_shipping;
			    
			else
			    $shipping += $cores->location_shipping;
			    
                        $tax += $cores->location_tax;
                    }
                    
                    $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='province' AND
                                l.location_id = ? AND p.product_id = ? 
                                GROUP BY p.product_id ", array($province_id, $product_id));
                    
                    foreach($coquery->result() as $prores)
                    {
			if($delivery->delivery_method_id==1)
				
				$service += $prores->location_shipping;
				
			    
			else
			    $shipping += $prores->location_shipping;
			    
                        $tax += $prores->location_tax;
                    }
                    
                }               
            }
            else
            {
                $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='country' AND
                                l.location_id = ? AND p.product_id = ? 
                                GROUP BY p.product_id ", array($country_id, $product_id));
                
                foreach($coquery->result() as $cores)
                {
		    
		    if($delivery->delivery_method_id==1)
			
			if($this->session->userdata('referer')==5886400){
					$service += 17.99;
				}else{
					$service += $cores->location_shipping;
				}
			
		    
			else
		        $shipping += $cores->location_shipping;
			
                    $tax += $cores->location_tax;
                }
                
            }
            
        }
        
        $acharges = array('shipping'=>$shipping,
                 'tax'=>$tax,
		 'service'=>$service,
		 'surcharge'=>$surcharge);

        $this->db->from('order_items');
        $this->db->join('products','order_items.product_id=products.product_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where('order_items.orderitem_id',$id);

        $query = $this->db->get();
  
        foreach($query->result() as $row)
        {
            if($row->delivery_charge==-1)
            {
                $acharges['shipping'] = 0;
            }
            else
            {
		if($delivery->delivery_method_id==1)
		
			if($this->session->userdata('referer')==5886400){
					//$service += 17.99;
					$acharges['service'] = $acharges['service'] + 17.99;
				}else{
					$acharges['service'] = $acharges['service'] + $row->delivery_charge;
				}
		
		    
		else
		    $acharges['shipping'] = $acharges['shipping'] + $row->delivery_charge;
            }
        }
                
        return $acharges;           
        
    }
    
    
    function get_add_estimate($id=0)
    {       
        $shipping = 0;
        $tax = 0;
	$service = 0;
	$surcharge = 0;
        
        $loc = $this->db->query("SELECT * FROM order_items o 
                      LEFT JOIN delivery_details d ON o.orderitem_id=d.orderitem_id
		      LEFT JOIN products p ON o.product_id=p.product_id 
                      WHERE o.orderitem_id = ? ",array($id));

        
        foreach($loc->result() as $delivery)
        {

            $postalcode = strtoupper(str_replace(' ','',trim($delivery->postalcode)));
            $country_id = $delivery->country_id;
            $province = $delivery->postalcode;
            $product_id = $delivery->product_id;
            
            $post = $this->db->query("SELECT * FROM postalcodes p
                         LEFT JOIN cities c ON p.city_id=c.city_id
                         LEFT JOIN provinces r ON c.province_id=r.province_id
                         LEFT JOIN countries n ON r.country_id=n.country_id
                         WHERE REPLACE(UPPER(p.postalcode),' ','')= ?  
                         GROUP BY p.postalcode", array($postalcode));
	    
	    if($delivery->special_delivery==1)
	    {
		$surcharge = 10;
	    }
            
            if($post->num_rows()>0)
            {
                foreach($post->result() as $row)
                {
                    $province_id = $row->province_id;
                    
                    $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='country' AND
                                l.location_id = ? AND p.product_id = ?
                                GROUP BY p.product_id ", array($country_id,$product_id));
                    
                    foreach($coquery->result() as $cores)
                    {
			if($delivery->delivery_method_id==1)
			    $service += $cores->location_shipping;
			else
			    $shipping += $cores->location_shipping;
			    
                        $tax += $cores->location_tax;
                    }
                    
                    $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='province' AND
                                l.location_id = ? AND p.product_id = ? 
                                GROUP BY p.product_id ", array($province_id, $product_id));
                    
                    foreach($coquery->result() as $prores)
                    {
			if($delivery->delivery_method_id==1)
			    $service += $prores->location_shipping;
			else
			    $shipping += $prores->location_shipping;
			    
                        $tax += $prores->location_tax;
                    }
                    
                }               
            }
            else
            {
                $coquery = $this->db->query("SELECT * FROM products p
                                LEFT JOIN product_locations r ON p.product_id=r.product_id
                                LEFT JOIN groups g ON r.group_id=g.group_id 
                                LEFT JOIN group_locations l ON g.group_id=l.group_id
                                WHERE l.location_type='country' AND
                                l.location_id = ? AND p.product_id = ? 
                                GROUP BY p.product_id ", array($country_id, $product_id));
                
                foreach($coquery->result() as $cores)
                {
		    
		    if($delivery->delivery_method_id==1)
			$service += $cores->location_shipping;
		    else
		        $shipping += $cores->location_shipping;
			
                    $tax += $cores->location_tax;
                }
                
            }
            
        }
        
        $acharges = array('shipping'=>$shipping,
                 'tax'=>$tax,
		 'service'=>$service,
		 'surcharge'=>$surcharge);

        $this->db->from('order_items');
        $this->db->join('products','order_items.product_id=products.product_id','left');
        $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
        $this->db->where('order_items.orderitem_id',$id);

        $query = $this->db->get();
  
        foreach($query->result() as $row)
        {
            if($row->delivery_charge==-1)
            {
                $acharges['shipping'] = 0;
            }
            else
            {
		if($delivery->delivery_method_id==1)
		    $acharges['service'] = $acharges['service'] + $row->delivery_charge;
		else
		    $acharges['shipping'] = $acharges['shipping'] + $row->delivery_charge;
            }
        }
                
        return $acharges;           
        
    }


    function get_plus_charges($product_id,$group_id,$postalcode)
    {
        $shipping = 0;
        $tax = 0;
        
        $this->db->from('postalcodes');
        $this->db->join('cities','postalcodes.city_id=cities.city_id','left');
        $this->db->join('provinces','cities.province_id=provinces.province_id','left');
        $this->db->join('countries','provinces.country_id=countries.country_id','left');
        $this->db->where("UPPER(REPLACE(postalcode,' ',''))=",strtoupper(str_replace(' ','',$postalcode)));
        $query = $this->db->get();
        $loc = $query->row();
        
        $this->db->from('group_locations');
        $this->db->where('location_type','country');
        $this->db->where('location_id',$loc->country_id);
        $this->db->where('group_id',$group_id);
        
        $charges = $this->db->get();
        
        foreach($charges->result() as $row)
        {
            $shipping += $row->location_shipping;
            $tax += $row->location_tax;
        }
        
        
        $this->db->from('group_locations');
        $this->db->where('location_type','province');
        $this->db->where('location_id',$loc->province_id);
        $this->db->where('group_id',$group_id);
        
        $charges = $this->db->get();
        
        foreach($charges->result() as $row)
        {
            $shipping += $row->location_shipping;
            $tax += $row->location_tax;
        }
                
                $this->db->from('products');
                $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
                $this->db->where('product_id',$product_id);
                
                $decharges = $this->db->get();
                
                foreach($decharges->result() as $row)
                {
                    if($row->delivery_charge!=-1)
                    {
                        $shipping += $row->delivery_charge;  
                    }
                    else
                    {
                        $shipping = 0;  
                    }
                }
        
        $acharges = array('shipping'=>$shipping,
                 'tax'=>$tax);

        $this->db->from('products');
        $this->db->join('delivery_methods','products.delivery_method_id=delviery_methods.delivery_method_id','left');
        $this->db->where('products.product_id',$product_id);

        $query = $this->db->get();

        foreach($query->result() as $row)
        {
            if($row->delivery_charge==-1)
            {
                $acharges['shipping'] = 0;
            }
            else
            {
                $acharges['shipping'] = $acharges['shipping'] + $row->delivery_charge;
            }
        }
                
        return $acharges;       
        
    }
    
    
    function cancelOrder($id,$message='')
    {
	$this->db->where('order_id',$id);
	$this->db->update('orders',array('status_id'=>'0','remarks'=>$message));
	
	return $this->db->affected_rows();
    }
    
    function uncancelOrder($id)
    {
	$this->db->where('order_id',$id);
	$this->db->update('orders',array('status_id'=>'2','remarks'=>''));
	
	return $this->db->affected_rows();
    }
    
    function getTracking($num)
    {
	$this->db->from('order_items');
	$this->db->join('orders','order_items.cart_id=orders.cart_id','left');
	$this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
	$this->db->join('products','order_items.product_id=products.product_id','left');
	$this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
	$this->db->where('orders.invoice_id',$num);
	
	$query = $this->db->get();
	
	$items = array();
	
	foreach($query->result() as $row)
	{
	    if($row->delivery_method_id!=1 && $row->delivered != 1)
	    {
		
		$row->tracking = $this->__update_tracking($row->orderitem_id);		
		
	    }
	    elseif($row->delivery_method!=1)
	    {
		$stq = $this->db->get_where('tracking_data',array('orderitem_id'=>$row->orderitem_id));
		$row->tracking = $stq->result();
	    }
	    
	    if($row->delivery_method!=1)
	        $items[] = $row;
	}
	
	return $items;
    }
    
    function __update_tracking($id)
    {
	
	$query = $this->db->get_where('order_items',array('orderitem_id'=>$id));
	
	$row = $query->row();	
	
	$ordernumber = '';
	$shipdate = '';
	$tracking = $row->tracking_code;
	$tracking_url = 'http://wwwapps.ups.com/WebTracking/detail?&showSpPkgProg=Show%20Package%20Progress&tracknum='.$tracking;
	
	$this->load->helper('htmldom');
	
	$html = file_get_html($tracking_url);
	
	foreach($html->find('th') as $e)
	    $e->outertext = '';
	    
	$html->save();	
	
	$status = $html->find('a#tt_spStatus',0)->plaintext;
	$method = $html->find('a.service',0)->plaintext;

	foreach($html->find('table.dataTable') as $service) 
	{
	  $rline = str_get_html($service->innertext);
	  
	  $oldlocation = '';
	  
	  $this->db->delete('tracking_data',array('orderitem_id'=>$row->orderitem_id));
	  
	  foreach($rline->find('tr') as $line)
	  {
	    if($line->find('td'))
	    {
		
		$location = $line->find('td',0)->innertext;
		$activity = $line->find('td',3)->innertext;
		$atime = $line->find('td',1)->innertext.'|'.$line->find('td',2)->innertext;
		
		$this->db->set('orderitem_id',$row->orderitem_id);
		$this->db->set('location',str_replace('  ','',trim($location)));
		$this->db->set('activity',str_replace('  ','',trim($activity)));
		$this->db->set('activity_time',str_replace('  ','',trim($atime)));
	    
		$this->db->insert('tracking_data');
	    }
	  }
	  
	  $this->db->set('delivered',($status=='Delivered') ? 1:'0');
	  $this->db->set('shipping_method',$method);
	  $this->db->where('orderitem_id',$row->orderitem_id);
	  $this->db->update('order_items');
	  
	}
	
	$stq = $this->db->get_where('tracking_data',array('orderitem_id'=>$row->orderitem_id));
	return $stq->result();
    }
    
    
    function deleteOrder($id)
    {
	$orders = $this->db->get_where('orders',array('order_id'=>$id));
	
	$this->db->delete('orders',array('order_id'=>$id));
	
	foreach($orders->result() as $order)
	{
	    $cartid = $order->cart_id;
	    
	    $this->db->delete('billing_details',array('cart_id'=>$cartid));
	    $this->db->delete('carts',array('cart_id'=>$cartid));
	    
	    $items = $this->db->get_where('order_items',array('cart_id'=>$cartid));
	    
	    $this->db->delete('order_items',array('cart_id'=>$cartid));
	    
	    foreach($items->result() as $item)
	    {
		$itemid = $item->orderitem_id;
		
		$this->db->delete('order_addons',array('orderitem_id'=>$itemid));
		$this->db->delete('delivery_details',array('orderitem_id'=>$itemid));
	    }
	    
	    
	    
	}
	
	return TRUE;	
	
    }
    
    
    function get_filteredOrders($vars)
    {
	    
	    /*$this->db->from('products');
	    $this->db->join('categories','products.category_id=categories.category_id','left');
	    $this->db->join('product_subcategories','products.product_id=product_subcategories.product_id','left');
	    $this->db->join('product_options','products.product_id=product_options.product_id','left');
	    $this->db->join('product_prices','products.product_id=product_prices.product_id','left');
	    $this->db->join('delivery_methods','products.delivery_method_id=delivery_methods.delivery_method_id','left');
	    $this->db->order_by('products.product_name','ASC');*/
	    
	    $this->db->select('*,b.firstname AS bfirstname, b.lastname AS blastname,c.user_firstname AS cfirstname, c.user_lastname AS clastname,
		      b.firstname AS bfirstname, b.lastname AS blastname,
		      COUNT(order_items.orderitem_id) AS items');
	    $this->db->from('orders');
	    $this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
	    $this->db->join('users c','orders.user_id=c.user_id','left');
	    $this->db->join('billing_details b','orders.cart_id=b.cart_id','left');
	    $this->db->join('users','orders.affiliate_id=users.user_id','left');
	    $this->db->join('status_codes','orders.status_id=status_codes.status_id');
   
	    $this->db->order_by('orders.order_id','DESC');
	    
	    if(!empty($vars['productcode']))
	    {
		    $this->db->where('orders.order_id',$vars['productcode']);
	    }
	    
	    if(!empty($vars['firstname']))
	    {
		$this->db->where('b.firstname',$vars['firstname']);
	    }
	    
	    if(!empty($vars['lastname']))
	    {
	        $this->db->where('b.lastname',$vars['lastname']);			    
	    }
	    
	    
	    
	    //$this->db->where('product_status !=','-1');
	     $this->db->group_by('orders.order_id');
	    //$this->db->group_by('products.product_id');
	    $query = $this->db->get();
	    
	    return $query->result();
    }
    
    
    /* ************************************** My Memorial Functions*********************************** */
    
    function getAffiliateOrdersCount($id,$post = array())
    {
	    $whr = '';
	    
	    if(isset($post['action']) && $post['action']=='search')
	    {
		    $key = $post['search'];
		    $whr = " AND (o.order_id LIKE '%{$key}%' OR p.product_id LIKE '%{$key}%' OR p.product LIKE '%{$key}%'
			    OR d.firstname LIKE '%{$key}%' OR d.lastname LIKE '%{$key}%' OR d.address LIKE '%{$key}%' OR d.postalcode LIKE '%{$key}%')";
	    }
	    
	    $query = $this->db->query("SELECT * FROM orders o
				      LEFT JOIN order_items i ON o.cart_id=i.cart_id 
				      LEFT JOIN delivery_details d ON d.orderitem_id=i.orderitem_id 
				      LEFT JOIN products p ON i.product_id=p.product_id 
				      LEFT JOIN provinces e ON d.province=e.province_name 
				      LEFT JOIN countries t ON d.country_id=t.country_id
				      WHERE o.affiliate_id={$id} AND o.status_id=2 {$whr}
				      ORDER BY o.order_id DESC");
	    
	    return $query->num_rows();		
    }
    
    
    function getAffiliateOrders($id,$post = array(),$limit=10000000000,$start=0)
    {
	    $whr = '';
	    
	    if(isset($post['action']) && $post['action']=='search')
	    {
		    $key = $post['search'];
		    $whr = " AND (o.order_id LIKE '%{$key}%' OR p.product_id LIKE '%{$key}%' OR p.product LIKE '%{$key}%'
			    OR d.firstname LIKE '%{$key}%' OR d.lastname LIKE '%{$key}%' OR d.address LIKE '%{$key}%' OR d.postalcode LIKE '%{$key}%')";
	    }
	    
	    $query = $this->db->query("SELECT * FROM orders o
				      LEFT JOIN order_items i ON o.cart_id=i.cart_id 
				      LEFT JOIN delivery_details a ON a.orderitem_id=i.orderitem_id 
				      LEFT JOIN products p ON i.product_id=p.product_id 
				      LEFT JOIN provinces e ON a.province=e.province_name 
				      LEFT JOIN countries t ON a.country_id=t.country_id
				      WHERE o.affiliate_id={$id} AND o.status_id=2 {$whr}
				      ORDER BY o.order_id DESC
				      LIMIT {$start},{$limit}");
	    
	    $orders = array();
	    
	    foreach($query->result() as $row)
	    {
		    $order = $row;
		    
		    $oid = $row->order_id;
		    
		    $subquery = $this->db->query("SELECT * FROM order_items o
						 LEFT JOIN orders r ON o.cart_id=r.cart_id 
						 LEFT JOIN products p ON o.product_id=p.product_id 
						 LEFT JOIN delivery_addresses a ON o.orderitem_id=a.orderitem_id
						 LEFT JOIN provinces e ON a.province=e.province_name
						 LEFT JOIN countries c ON a.country_id=c.country_id 
						 WHERE r.order_id={$oid}");
		    
		    $order->items = $subquery->result();
		    
		    $orders[] = $order;
		    
	    }
	    
	    return $orders;		
    }
    
    
    
    /********************** My Memorial Functions ****************************************/
    
    function updateMyDelivery($cart_id,$vars)
    {
	
	$cart = $this->get_cart($cart_id);
	
	foreach($cart as $item)
	{
	    
	    $this->db->where('orderitem_id',$item->orderitem_id);
	    $query = $this->db->get('delivery_details');
	    
	    $data = array('firstname'=>$vars['firstname'],
			  'lastname'=>$vars['lastname'],
			  'dayphone'=>$vars['phone'],
			  'address1'=>$vars['address'],
			  'postalcode'=>$vars['postalcode'],
			  'city'=>$vars['city'],
			  'province'=>$vars['province'],
			  'country_id'=>$vars['country_id'],
			  'location_type'=>$vars['locationtype'],
			  'orderitem_id'=>$item->orderitem_id);

	    if($query->num_rows()>0)
	    {
		$this->db->where('orderitem_id',$item->orderitem_id);
		$this->db->update('delivery_details',$data);
	    }
	    else
	    {
		$this->db->insert('delivery_details',$data);
	    }
	    
	}
	
	return true;
        
    }
    
    
    
    function updateMyOrder($cart,$vars)
    {
	$count = 0;
		
	foreach($cart as $item)
	{
		$count++;
		
		//date("Y-m-d", strtotime($date));
		
		//$new_dat = date("Y-d-m", strtotime($vars['datepicker'][$item->orderitem_id]));
		
		
		$data['delivery_date'] = $vars['datepicker'][$item->orderitem_id];
		$data['delivery_time'] = $vars['deliverytime'][$item->orderitem_id];
		$data['occasion_id'] = $vars['occasion_id'][$item->orderitem_id];
		$data['order_po'] = $vars['businessname'][$item->orderitem_id];
		$data['order_by'] = $vars['orderby'][$item->orderitem_id];
		$data['card_message'] = $vars['message'][$item->orderitem_id];
		$data['special_note'] = $vars['specialnotes'][$item->orderitem_id];
		$data['ribbon_text'] = $vars['ribbontext'][$item->orderitem_id];
		$data['ribbon_color'] = isset($vars['ribbon_color']) && isset($vars['ribbon_color'][$item->orderitem_id]) ? $vars['ribbon_color'][$item->orderitem_id]:'white';
		
		$this->db->update('order_items',$data, array('orderitem_id'=>$item->orderitem_id));		
	}
	}
	
	function updateAddress($id,$vars)
    {
	//$count = 0;
		
	/*foreach($cart as $item)
	{
		$count++;
		
		//date("Y-m-d", strtotime($date));
		
		$new_dat = date("Y-d-m", strtotime($vars['datepicker'][$item->orderitem_id])); */
		
		
		//$data['delivery_date'] = $new_dat;
		//$data['name'] = $vars['name'];
		/*$data['address'] = $vars['address'];
		$data['city'] = $vars['city'];
		$data['postalcode'] = $vars['postalcode'];
		$data['province'] = $vars['province'];
		$data['country'] = $vars['country'];
		$data['contact_firstname'] = $vars['contact_firstname'];
		$data['contact_lastname'] = $vars['contact_lastname'];
		$data['phone'] = $vars['phone'];
		$data['email'] = $vars['email'];
		
		
		
		$this->db->update('affiliate_locations',$data, array('location_id'=>$id));		
	//}
	
	
	return true;*/
	
	$data = array('name'=>$vars['name'],
				  'address'=>$vars['address'],
				  'city'=>$vars['city'],
				  'postalcode'=>$vars['postalcode'],
				  'province'=>$vars['province'],
				  'country'=>$vars['country'],
				  'contact_firstname'=>$vars['contact_firstname'],
				  'contact_lastname'=>$vars['contact_lastname'],
				  'phone'=>$vars['phone'],
				  'email'=>$vars['email']);
		$this->db->where('location_id',$id);
		/*$this->db->where('user_password',$vars['oldpassword']);
		$this->db->where('user_role','affiliate');*/
		$this->db->update('affiliate_locations',$data);
		return $this->db->affected_rows();
	
    
    }
    
    
    function updateMyBilling($cart_id,$aff)
    {
	
	
	$data = array('firstname' => $aff->user_firstname,
		      'lastname' => $aff->user_lastname,
		      'email' => $aff->user_email,
		      'address1' => $aff->user_address1,
		      'address2' => $aff->user_address2,
		      'city' => $aff->user_city,
		      'postalcode'=> $aff->user_postalcode,
		      'province' => $aff->user_province,
		      'country_id' => $aff->user_country_id,
		      'dayphone' => $aff->user_phone1,
		      'evephone' => $aff->user_phone2,
		      'cart_id' => $cart_id );
	
	if($this->is_billing_entered($cart_id))
	{
	    $this->db->update('billing_details',$data,array('cart_id'=>$cart_id));
	}
	else
	{
	    $this->db->insert('billing_details',$data);
	}
	
	return true;
	
    }
    
    function get_affiliate_orders($id , $vars = array())
    {
	
	$this->db->from('orders');
	$this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
	$this->db->join('products','order_items.product_id=products.product_id','left');
	$this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
	$this->db->join('countries','delivery_details.country_id=countries.country_id','left');
	$this->db->where('orders.affiliate_id',$id);
	$this->db->group_by('orders.order_id');
	$this->db->order_by('orders.order_id','DESC');
	
	if(isset($vars['invoice_id']) && !empty($vars['invoice_id']))
	{
	    $this->db->where('orders.invoice_id',$vars['invoice_id']);
	}
	if(isset($vars['funeral_home']) && !empty($vars['funeral_home']) && $vars['funeral_home']!=0)
	{
	    $this->db->where('delivery_details.location_id',$vars['funeral_home']);
	}	
	
	$orders = $this->db->get();
	
	return $orders->result();
    }
	
	
	
	
	function get_affiliate_addresses($id)
    {
	
	$this->db->from('affiliate_locations');
	/*$this->db->join('order_items','orders.cart_id=order_items.cart_id','left');
	$this->db->join('products','order_items.product_id=products.product_id','left');
	$this->db->join('delivery_details','order_items.orderitem_id=delivery_details.orderitem_id','left');
	$this->db->join('countries','delivery_details.country_id=countries.country_id','left');*/
	$this->db->where('affiliate_id',$id);
	//$this->db->group_by('orders.order_id');
	$this->db->order_by('location_id','ASC');
	
	/*if(isset($vars['invoice_id']) && !empty($vars['invoice_id']))
	{
	    $this->db->where('orders.invoice_id',$vars['invoice_id']);
	}	*/
	
	$orders = $this->db->get();
	
	return $orders->result();
    }
	
	
	
	function get_affiliate_address($id)
    {
	
	$this->db->select('*');
        $this->db->from('affiliate_locations');
        $this->db->where('location_id',$id);
        $query = $this->db->get();
        
        return $query->row();
    }
	
	
	
	
    
}

?>
