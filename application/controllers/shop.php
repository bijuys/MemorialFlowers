<?php

class Shop extends CI_Controller {

	function Shop()
	{
		parent::__construct();
		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		$this->load->helper('url');
		$this->load->Model('Order_model');
		$this->load->library('form_validation');
		$this->load->Model('Country_model');
		$this->load->Model('Customer_model');
		//$this->load->Model('Discounts_model');
	
	}
	
	function index()
	{
		redirect('/shop/cart');
		exit;
	}
	
	function update()
	{
		$this->Order_model->update_addon($this->input->post());
		redirect('/shop/cart');
		exit;

	}
	
	function currency()
	{
		
		$g = setCurrency($_POST['currency_select']);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function cart()
	{
		use_ssl(false);
		
		$previ = $_SERVER['HTTP_REFERER'];
		
		//echo $previ;
		
		$data['cart'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));

		if($_POST && $_POST['coupon_submit']=='Apply')
		{
			
			$this->form_validation->set_rules("coupon",'Coupon code','alpha_dash|max_length[25]');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			
			if ($this->form_validation->run() == TRUE)
			{
				$tcart = get_tiny_cart();
				
				if($coupon = get_coupon_discount($_POST['coupon'],$tcart->total))
				{
					
					$this->session->set_userdata('coupon',$this->input->post('coupon'));
					$coupon->discount = $coupon->discount_amount ? $coupon->discount_amount: $coupon->discount_percentage * $tcart->total/100;
					$data['coupon'] = $coupon;
					
				}
				else
				{
					$this->session->unset_userdata('coupon');
					
				}
			}

						
		}
		elseif($this->session->userdata('coupon') && count($data['cart'])>0)
		{
			$tcart = get_tiny_cart();
			$coupon = get_coupon_discount($this->session->userdata('coupon'),$tcart->total);
			$data['coupon'] = $coupon;
			$coupon->discount = $coupon->discount_amount ? $coupon->discount_amount: $coupon->discount_percentage * $tcart->total/100;
			$data['coupon'] = $coupon;
		}
		
		$this->load->Model('Occasion_model');
		
		$data['current_page'] = 'shoppingcart';
		$data['occasions']= $this->Occasion_model->get_occasions_array();
		$data['page'] = $this->Pages_model->return_page('shoppingcart');
		$data['paths'] = array('Home'=>path(),'Shopping Cart'=>'');
		
		$carrito = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		
		if($previ=='http://test.memorialflowers.ca/shop/cart'){
			
			if($carrito){
				$this->load->view('shopping_cart.php',$data);
			}else{
				redirect('/');
			}
		
		}else{
			
			$this->load->view('shopping_cart.php',$data);
			
		}
			
	}
	
	function rem($id)
	{
		if(is_numeric($id)) {
			if($this->Order_model->remove($id))
			{
				$this->session->set_flashdata('message','<div id="messenger" class="error">'.lang('1 Item is successfully deleted!').'</div>');
			}
			redirect('/shop/cart');
			exit;
		}
	}
	
	function login()
	{
		
		use_ssl(TRUE);
		
                $data =array();
       
                if($_POST)
                {

                    if($_POST['submit']=='Continue')
                    {
                        $this->session->set_userdata('customer_id','0');
			$this->session->set_userdata('guest_checkout','yes');
                        redirect('/shop/delivery');
                    }
                    else
                    {
			
                        if($user = $this->Customer_model->login($this->input->post()))
                        {
                            $this->session->set_userdata('customer_id',$user->user_id);
                            $this->session->set_userdata('user_firstname',$user->user_firstname);
                            $this->session->set_userdata('user_lastname',$user->user_lastname);
                            $this->session->set_userdata('username',$user->user_name);
							$this->session->set_userdata('customer_account',$user->customer_onaccount);
                            $this->session->set_userdata('customer_login',true);
                            
                            redirect('/shop/delivery');
                            exit;
                        }
                        else
                        {
                            $this->session->set_flashdata('message','<span class="error">Invalid Login!</span>');  
                        }
                    }
                }
		
		$data['page'] = $this->Pages_model->return_page('login-continue');
		$data['paths'] = array('Home'=>path(),'Sign In'=>'');
		$this->load->view('signin-continue',$data);	
	}
        
        function checkUser()
        {
		
	   $custid = $this->session->userdata('customer_id');
	   $guest = $this->session->userdata('guest_checkout');
		
            if((is_numeric($custid) && $custid>0) || ($custid=='0' && $guest=='yes'))
            {
                return true;
            }
	    else
	    {
		return false;
	    }
	}
            
        
	
	function delivery()
	{
		use_ssl(false);
		
        /*if(!$this->checkUser())
		{
			redirect('/shop/login');
			
		}
         */           
		$cart_id = $this->session->userdata('cart_id');
		
		if($this->Order_model->is_cart_empty($cart_id))
		{
			redirect('/shop/cart');
			exit;
		}
		
		global $p;
		
		$p = $_POST;
		
		
		if(isset($_POST['orderitem_id']) && count($_POST['orderitem_id']))
		{	
                                        
			foreach($_POST['orderitem_id'] as $row)
			{
				$this->form_validation->set_rules("firstname[{$row}]", 'First Name','required|min_length[1]|max_length[45]');
				$this->form_validation->set_rules("lastname[{$row}]", 'Last Name','required|min_length[1]|max_length[45]');
				$this->form_validation->set_rules("location_type[{$row}]", 'Location Type','required|min_length[3]|max_length[45]');
				$this->form_validation->set_rules("address1[{$row}]", 'Address','required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules("address2[{$row}]", 'Address2','max_length[100]');
				$this->form_validation->set_rules("postalcode[{$row}]", 'Postal Code','required|callback_postalcode_check['.$row.']');
				$this->form_validation->set_message('callback_postalcode_check[postalcode]', 'Invalid Postalcode!');
				$this->form_validation->set_rules("city[{$row}]", 'City','required|min_length[1]|max_length[30]');
				$this->form_validation->set_rules("province[{$row}]", 'Province','required|min_length[4]|max_length[30]');
				$this->form_validation->set_rules("country_id[{$row}]", 'Country','required|numeric');
				$this->form_validation->set_rules("dayphone[{$row}]",'Day Phone','required|min_length[5]|max_length[15]');
				$this->form_validation->set_rules("evephone[{$row}]", 'Evening Phone','min_length[0]|max_length[15]');
				//$this->form_validation->set_rules("card_message[{$row}]", 'Card Message','callback_cardmessage_check['.$row.']');
				$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			     
			        if(isset($_POST['useaddress'][$row]) && is_numeric($_POST['useaddress'][$row]))
                                {
                                        $this->session->set_userdata('useaddress',$row);

                                }
                                else
                                {
                                        $this->session->unset_userdata('useaddress');
                                }
				
                                
			}
				
		}
		
		if ($this->form_validation->run() == FALSE)
		{

			$data['p'] = (object) $this->input->post();
			$this->load->Model('Occasion_model');
			$this->load->Model('Country_model');
			$this->load->Model('Province_model');
			$data['occasions']= $this->Occasion_model->get_occasions_array();
			$data['delivery'] = $this->Order_model->getDelivery($cart_id);
			$data['current_page'] = 'deliverydetails';
			$data['page'] = $this->Pages_model->return_page('delivery');
			$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Delivery Info'=>'');
			
			$this->load->view('checkout',$data);							
		}
		else
		{
			$this->Order_model->update_Delivery($cart_id,$p);
			redirect('shop/checkout');
			exit;					
		}		


	}
	
	public function cardmessage_check($str,$row)
	{
		if(isset($_POST) && isset($_POST['enclose_card'][$row]))
		{			
			if(empty($str))
			{
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	function postalcode_check($value,$row)
	{
		
		if(empty($value))
			return TRUE;
		
		$this->load->model('Postalcode_model');
		
		if($this->Postalcode_model->is_valid_canadian($value))
		{
			//$this->form_validation->set_message('postalcode', 'Invalid Postal Code! Please Re-Enter');
			$this->session->set_userdata('sess_postalcode',$value);
			return TRUE;			
		}
		else
		{
			return FALSE;
		}		
	}
	
	function billing()
	{
		
		use_ssl(false);
						
		$cart_id = $this->session->userdata('cart_id');
		
		if($this->Order_model->is_cart_empty($cart_id))
		{
			redirect('/shop/cart');
			exit;
		}
		
		elseif(!$this->Order_model->is_delivery_entered($cart_id))
		{
			redirect('/shop/delivery');
			exit;
		}
		
		$coupon = 0;
		
		if($_POST)
		{
			$this->form_validation->set_message('required','%s is required.');
			$this->form_validation->set_message('is_unique','%s already exists.');
			$this->form_validation->set_message('matches','The Confirm Password does not match the %s field.');
			
			$this->form_validation->set_rules("firstname", 'First Name','required|min_length[1]|max_length[45]');
			$this->form_validation->set_rules("lastname", 'Last Name','required|min_length[1]|max_length[45]');
			$this->form_validation->set_rules("address1", 'Address','required|min_length[1]|max_length[100]');
			$this->form_validation->set_rules("postalcode", 'Postal Code','required|min_length[5]|max_length[7]');
			$this->form_validation->set_rules("city", 'City','required|min_length[1]|max_length[30]');
			$this->form_validation->set_rules("province", 'Province','required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules("country_id", 'Country','required|numeric|min_length[1]');
			$this->form_validation->set_rules("email", 'Email','required|valid_email|min_length[0]|max_length[45]');
			$this->form_validation->set_rules("dayphone",'Day Phone','required|min_length[5]|max_length[15]');
			$this->form_validation->set_rules("evephone", 'Evening Phone','min_length[0]|max_length[15]');
			$this->form_validation->set_rules("create_account", 'Create Account','max_length[5]');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');

			
			if(isset($_POST['create_account']))
			{
				$this->form_validation->set_rules('username', 'Username','required|max_length[44]|is_unique[users.user_name]');
				$this->form_validation->set_rules('password', 'Password','required');
				$this->form_validation->set_rules('cpassword', 'Confirm Password','required|matches[password]');	
			}
			

		}
		
		
		if ($this->form_validation->run() == FALSE || isset($_POST['update']))
		{
			$this->load->model('Group_model');
			
			$cart = $this->Order_model->get_cart($this->session->userdata('cart_id'));
			$totals = array('itemtotal'=>0,
					'shipping'=>0,
					'service'=>0,
					'surcharge'=>0,
					'tax'=>0,
					'coupon'=>0,
					'coupon_code'=>'',
					'discount'=>0,
					'grandtotal'=>0,
					'discount_type'=>'percentage',
					'coupon_type'=>'percentage');
			
			$coupon_discount = 0;
			
			$this->load->model('Company_model');
			$this->load->model('Customer_model');
			
			$cartdiscount = 0;
			$cartcoupon = 0;
			$cartdiscounttype = 'percentage';
			$cartcoupontype = 'percentage';
			
			foreach($cart as $item)
			{			
				
				$totals['itemtotal'] += $item->product_price;
				
				foreach($item->addons as $addon)
				{
					$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
				}
				
			}
			
			
			if($user_discount=$this->Customer_model->getDiscount($this->session->userdata('customer_id')))
			{
				$totals['discount'] = ($totals['itemtotal'] * $user_discount) / 100;
				
			}
			else
			{
				
				if($this->session->userdata('coupon'))
				{
					if($coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']))
					{
						$totals['coupon_code'] = $coupon->discount_name;
						if($coupon->discount_amount>0)
						{
							$cartcoupon = $coupon->discount_amount;
							$cartcoupontype = 'amount';
						}
						else
						{
							$cartcoupon = $coupon->discount_percentage;
							$cartcoupontype = 'percentage';
						}						
					}
					

				}
				
				if($cartcoupon<=0)
				{
						
					if($discount = get_discount($totals['itemtotal']))
					{
						
						if($discount->discount_amount>0)
						{
							
							$cartdiscount = $discount->discount_amount;
							$cartdiscounttype = 'amount';
						}
						else
						{
							$cartdiscount = $discount->discount_percentage;
							$cartdiscounttype = 'percentage';
						}						
					}
				}
			}
			
			$itemscount = count($cart);
			
			foreach($cart as $item)
			{			
				
				$ptotal = $item->product_price;
				
				foreach($item->addons as $addon)
				{
					$ptotal += ($addon->addon_price*$addon->addon_quantity);
				}

				
				
				$addition = $this->Order_model->get_add_charges($item->orderitem_id);

				//$addition = $this->Group_model->get_add_charges($item->product_id,$item->postalcode);
				

				$totals['shipping'] += $addition['shipping'];
				$totals['service'] += $addition['service'];
				$totals['surcharge'] += $addition['surcharge'];
				
				if($cartcoupon>0)
				{
					if($cartcoupontype=='percentage')
					{
						$totals['coupon'] += ($cartcoupon * $ptotal) / 100;
						$ptotal -= ($cartcoupon * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartcoupon / $itemscount;
						$totals['coupon'] += $part;
						$ptotal -= $part;
						
					}
				}
				else
				{
					if($cartdiscounttype=='percentage')
					{
						$totals['discount'] += ($cartdiscount * $ptotal) / 100;
						$ptotal -= ($cartdiscount * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartdiscount / $itemscount;
						$totals['discount'] += $part;
						$ptotal -= $part;
						
					} 
				}
				
				$ptotal += $addition['shipping'];
				$ptotal += $addition['service'];
				$ptotal += $addition['surcharge'];

				$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
				
			}
			
			//$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);	
			
			$affid=$this->session->userdata('referer');
			if($affid!='') {
			$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);	
				
				
			}
			
			else {
			$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);	
			}
			
			
			$data['p'] = (object) $_POST;
			$data['totals'] = $totals;
			
			$this->load->Model('Customer_model');
			
			$data['companies'] = $this->Customer_model->getParentCompanies();
			
			if($this->Order_model->is_billing_entered($cart_id))
				$data['billing'] = $this->Order_model->getBilling($cart_id);
			elseif($this->session->userdata('useaddress'))
				$data['billing'] = $this->Order_model->getAddress($cart_id,$this->session->userdata('useaddress'));						
			elseif($this->session->userdata('customer_id')>0)
				$data['billing'] = $this->Order_model->getCustomerForBilling($this->session->userdata('customer_id'));
			else
				$data['billing'] = $this->Order_model->getBilling($cart_id);

			$data['current_page'] = 'deliverydetails';
			
			$data['page'] = $this->Pages_model->return_page('billing');
			$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Billing Info'=>'');

			$this->load->View('billing',$data);				
	
		}
		else
		{
			
			if(isset($_POST['create_account']) && $_POST['create_account']==1)
			{
				$this->load->model('Customer_model');
				$customer_id = $this->Customer_model->signup($this->input->post());
				$this->autoLogin($customer_id);
			}
			
			$this->Order_model->update_Billing($cart_id,$this->input->post());
			redirect('shop/checkout');
			exit;				
		}

	}
	
	function pay($vars)
	{
		use_ssl(false);			
		$cart_id = $this->session->userdata('cart_id');
		
		if($this->Order_model->is_cart_empty($cart_id))
		{
			redirect('/shop/cart');
			exit;
		}
		
		elseif(!$this->Order_model->is_delivery_entered($cart_id))
		{
			redirect('/shop/checkout');
			exit;
		}
		
		$billing_id = $this->Order_model->update_Billing($cart_id,$vars);
		
		if($billing_id){
		
			/*********************************** PAYMENT ***********************************/
			/*******************************************************************************/
			
			$this->load->model('Group_model');
			$cart = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));
			
			$totals = array('itemtotal'=>0,
					'shipping'=>0,
					'service'=>0,
					'surcharge'=>0,
					'tax'=>0,
					'discount'=>0,
					'coupon'=>0,
					'coupon_code'=>'',
                                        			'companyless'=>0,
					'grandtotal'=>0);
			
			$order_items = '';
                        		$oformat = file_get_contents('assets/email_items.html');
                        		$aoformat = 
                        		$itemformat = '';
                       		$aitemformat = '';
                        
                       		$icnt = 0;
			$itemprc = 0;
			
			$this->load->model('Company_model');
			$this->load->model('Customer_model');
			
			$cartdiscount = 0;
			$cartcoupon = 0;
			$cartdiscounttype = 'percentage';
			$cartcoupontype = 'percentage';
			
			foreach($cart as $item)
			{				
				$totals['itemtotal'] += $item->product_price;
				
				foreach($item->addons as $addon)
				{
					$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
				}
				
			}
			
			
			$coupon_discount = 0;
			
			if($user_discount=$this->Customer_model->getDiscount($this->session->userdata('customer_id')))
			{
				$totals['discount'] = ($totals['itemtotal'] * $user_discount) / 100;
			}
			else
			{
				
				if($this->session->userdata('coupon'))
				{
					if($coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']))
					{
						$totals['coupon_code'] = $coupon->discount_name;
						if($coupon->discount_amount>0)
						{
							$cartcoupon = $coupon->discount_amount;
							$cartcoupontype = 'amount';
						}
						else
						{
							$cartcoupon = $coupon->discount_percentage;
							$cartcoupontype = 'percentage';
						}						
					}
				}
				
				if($cartcoupon<=0)
				{
					if($discount = get_discount($totals['itemtotal']))
					{
						if($discount->discount_amount>0)
						{
							$cartdiscount = $discount->discount_amount;
							$cartdiscounttype = 'amount';
						}
						else
						{
							$cartdiscount = $discount->discount_percentage;
							$cartdiscounttype = 'percentage';
						}						
					}
				}
				
			}
			
			
			$conversion = '';
			
			$cartitems = array();
			
			$itemscount = count($cart);
                                                                        		
			foreach($cart as $item)
			{
				$itemprc = 0;
				$ptotal = $item->product_price;
				
                                $icnt++;
                                
                                $itemf = $oformat;
                                $itemf = str_replace('{counter}',$icnt,$itemf);
                                $itemf = str_replace('{firstname}',$item->firstname,$itemf);
                                $itemf = str_replace('{lastname}',$item->lastname,$itemf);
								
								$itemf = str_replace('{location_type}',$item->location_type,$itemf);
								$itemf = str_replace('{location_type_name}',$item->location_type_name,$itemf);
								
                                $itemf = str_replace('{address1}',$item->address1,$itemf);
                                $itemf = str_replace('{address2}',$item->address2,$itemf);
                                $itemf = str_replace('{city}',$item->city,$itemf);
                                $itemf = str_replace('{postalcode}',$item->postalcode,$itemf);
                                $itemf = str_replace('{province}',$item->province,$itemf);
                                $itemf = str_replace('{country}',$item->country_id,$itemf);
                                $itemf = str_replace('{phone}',$item->dayphone.' '.$item->evephone,$itemf);
                                
                                $itemf = str_replace('{message}',$item->card_message,$itemf);
							    $itemf = str_replace('{special_note}',$item->ribbon_text,$itemf);
                                $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)).' - '.$item->delivery_time,$itemf);
								
								  
								  
                                $itemf = str_replace('{shipping_method}',$item->infotext,$itemf);
								$itemf = str_replace('{delivery_info}',$item->delivery_description,$itemf);

                                $itemf = str_replace('{product_image}','<img src="'.$this->config->item('base_url').img_format('productres/'.$item->product_picture, 'thumb').'" />',$itemf);
                                $itemf = str_replace('{product_code}',$item->product_code,$itemf);
								$itemf = str_replace('{orderitem_id}',$item->orderitem_id,$itemf);
								
								
				
								$itemf = str_replace('{product_name}',$item->product_name .'<br/><small>('.$item->price_name.')</small>',$itemf);
                                $itemf = str_replace('{price}','$'.number_format($item->product_price,2),$itemf);
                                $itemf = str_replace('{quantity}','1',$itemf);
				
				$itemprc += $item->product_price;
				
				if($item->delivery_method_id==1)
				{
					$itemf = str_replace('{delivery_by}','Delivery by Local',$itemf);
				}
				else
				{
					$itemf = str_replace('{delivery_by}','This bouquet comes to via UPS.',$itemf);
				}
				
                                $itemf = str_replace('{total}','$'.number_format($item->product_price,2),$itemf);
				
				if(array_key_exists($item->product_id,$cartitems))
				{
					$cartitems[$item->product_id]['sku'] = $item->product_code;
					$cartitems[$item->product_id]['qty'] = $cartitems[$item->product_id]['qty'] + 1;
					$cartitems[$item->product_id]['amt'] = $cartitems[$item->product_id]['amt'] + $item->product_price*100;
					$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
					$cartitems[$item->product_id]['category'] = urlencode($item->category);
				}
				else
				{
					$cartitems[$item->product_id]['sku'] = $item->product_code;
					$cartitems[$item->product_id]['qty'] = 1;
					$cartitems[$item->product_id]['amt'] = $item->product_price*100;
					$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
					$cartitems[$item->product_id]['category'] = urlencode($item->category);
					
				}
                            
                                $addontot = 0;
                                
                                if(count($item->addons))
                                {
				    $order_items = '';
				   
                                    foreach($item->addons as $addon)
                                    {
						$order_items .= '+(' . $addon->addon_name ." ".$addon->addon_quantity.'x$'.number_format($addon->addon_price,2).")   $".number_format(($addon->addon_price*$addon->addon_quantity),2)."<br/>\n" ;
						$itemprc += ($addon->addon_price*$addon->addon_quantity);
						$addontot += ($addon->addon_price*$addon->addon_quantity);
						$ptotal += ($addon->addon_price*$addon->addon_quantity);
						
						if(array_key_exists($addon->addon_id,$cartitems))
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $cartitems[$addon->addon_id]['qty']+$addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = $cartitems[$addon->addon_id]['amt']+($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
						}
						else
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = ($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
						}										
					
					//echo $order_items;
				    }
				    
				    	//echo $order_items;
                                }
                                else
                                {
                                    $order_items .= 'None';                                    
                                }
				
				$conversion .= 'bta.addConversionLegacy("$", "'.$item->product_name.'", "'.number_format($itemprc,2).'");'."\n";
				
                                $itemf = str_replace('{addons}',$order_items,$itemf);
                                $itemf = str_replace('{addon_price}','$'.number_format($addontot,2),$itemf);
				
				$addition = $this->Order_model->get_add_charges($item->orderitem_id);
				
				$totals['shipping'] += $addition['shipping'];
				$totals['service'] += $addition['service'];
				$totals['surcharge'] += $addition['surcharge'];
							
				if($cartcoupon>0)
				{
					if($cartcoupontype=='percentage')
					{
						$totals['coupon'] += ($cartcoupon * $ptotal) / 100;
						$ptotal -= ($cartcoupon * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartcoupon / $itemscount;
						$totals['coupon'] += $part;
						$ptotal -= $part;
						
					}
				}
				else
				{
					if($cartdiscounttype=='percentage')
					{
						$totals['discount'] += ($cartdiscount * $ptotal) / 100;
						$ptotal -= ($cartdiscount * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartdiscount / $itemscount;
						$totals['discount'] += $part;
						$ptotal -= $part;
						
					} 
				}
				
				$ptotal += $addition['shipping'];
				$ptotal += $addition['service'];
				$ptotal += $addition['surcharge'];

				$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
                            
				$aitemformat .= str_replace('{product_description}','',$itemf);
				$itemf = str_replace('{product_description}',substr($item->product_description,0,50),$itemf);
				$itemformat .= $itemf;
			}
			
			$ggitems = '';
			
			foreach($cartitems as $citem)
			{
				$productids[] = $citem['sku'].':'.str_replace('+','',$citem['name']);
				$itemvalues[] = $citem['amt'];
				$units[] = $citem['qty'];
				$skulist[] = $citem['sku'];
				$qlist[] = $citem['qty'];
				$amtlist[] = $citem['amt'];
				$namelist[] = $citem['name'];
				
			}	
			
			if($totals['discount']>0)
			{
				$skulist[] = 'Discount';
				$qlist[] = 0;
				$amtlist[] = round($totals['discount']*(-100));
				$namelist[] = 'Discount';
				$productids[] = 'Discount';
				$itemvalues[] = round($totals['discount']*(100));
				$units[] = 1;
			}
			elseif($totals['coupon']>0)
			{
				$skulist[] = 'Discount';
				$qlist[] = 0;
				$amtlist[] = round($totals['coupon']*(-100));
				$namelist[] = 'Discount';
				$productids[] = 'Discount';
				$itemvalues[] = round($totals['coupon']*(100));
				$units[] = 1;
			}
			else
			{
				$productids[] = 'Discount';
				$itemvalues[] = 0;
				$units[] = 1;
			}
                        
			
			$affid=$this->session->userdata('referer');

			if($affid!='') 
			{
				$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
			}
			else 
			{
				$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
			}			
			
		//	$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);
			
			$invoiceTotal = number_format($totals['grandtotal'],2);

			$customer_id= $this->session->userdata('customer_id') ? $this->session->userdata('customer_id'):'0';
			$affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'';
			
			
			$this->form_validation->set_rules("cardnumber", 'Credit Card Number','required|numeric|min_length[15]|max_length[16]');
			$this->form_validation->set_rules("expiry_month", 'Expiry Month','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("expiry_year", 'Expiry Year','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("cvv", 'CVV2','required|min_length[3]|max_length[5]');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			
			
			if ($this->form_validation->run() == TRUE)
			{
				if($this->session->userdata('logo') != ''){
				
					$eformat = file_get_contents('assets/email_format.html');
				}else{
					$eformat = file_get_contents('assets/email_format2.html');
				
				}
				
				$eheader = file_get_contents('assets/email_header.html');
			
				if($this->session->userdata('customer_account') == 1 && $this->session->userdata('customer_id')<>0){
				$order = unserialize(base64_decode($_POST['data'])); 
				}else{
				$this->load->library('plugnpay');
				$order = unserialize(base64_decode($_POST['data']));
				}
				
				$country = $this->Country_model->get_country($order->country_id);
				
				$order->country = $country->country_name;
				$order->ipaddress = $_SERVER['REMOTE_ADDR'];
				//$order->nameoncard = $this->input->post('nameoncard');
				$order->nameoncard = $this->input->post('firstname').' '.$this->input->post('lastname');
				$order->cardnumber = $this->input->post('cardnumber');
				$order->cvv = $this->input->post('cvv');
				$order->expiry = $this->input->post('expiry_month').'/'.$this->input->post('expiry_year');
				$order->total = $totals['grandtotal'];
				$order->affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'0';                                       

				$eheader = str_replace('{firstname}',$order->firstname,$eheader);
				$eformat = str_replace('{firstname}',$order->firstname,$eformat);
				$eformat = str_replace('{lastname}',$order->lastname,$eformat);
				$eformat = str_replace('{address1}',$order->address1,$eformat);
				$eformat = str_replace('{address2}',$order->address2,$eformat);
				$eformat = str_replace('{city}',$order->city,$eformat);
				$eformat = str_replace('{postalcode}',$order->postalcode,$eformat);
				$eformat = str_replace('{country}',$order->country,$eformat);
				$eformat = str_replace('{email}',$order->email,$eformat);
				$eformat = str_replace('{dayphone}',$order->dayphone,$eformat);
				$eformat = str_replace('{evephone}',$order->dayphone,$eformat);
				$eformat = str_replace('{product_price}','$'.number_format($totals['itemtotal'],2),$eformat);
				$eformat = str_replace('{delivery_charge}','$'.number_format($totals['shipping'],2),$eformat);
				$eformat = str_replace('{service_charge}','$'.number_format($totals['service'],2),$eformat);
				$eformat = str_replace('{surcharge}','$'.number_format($totals['surcharge'],2),$eformat);
				$eformat = str_replace('{discount}','$'.number_format($totals['discount']-$totals['coupon']-$totals['companyless'],2),$eformat);

				$eformat = str_replace('{tax}','$'.number_format($totals['tax'],2),$eformat);
				$eformat = str_replace('{grand_total}','$'.number_format($totals['grandtotal'],2),$eformat);
				
				$eformat = str_replace('{affi_logo}',$this->session->userdata('logo'),$eformat);
								


				/*if($_SERVER['REMOTE_ADDR']=='127.0.0.1' && ENVIRONMENT=='development')
				{
					$result['FinalStatus']='success';
					$payment_method = 'credit_card';
				}
				else
				{
					$result = $this->plugnpay->pay($order);
					
					/*
					echo 'Website on Test...<br/>';
					echo $result['MErrMsg'];
					
					echo '<pre>';
					die(print_r($result));
					
					echo '</pre>';
					
					*/
				/*	
					$payment_method = 'credit_card';
				}*/
				
				
				if($this->session->userdata('customer_account') == 1 || $_SERVER['REMOTE_ADDR']=='117.253.195.106')
				{
					$result['FinalStatus']='success';
					$payment_method = 'company_pay';
				}
				else
				{
					$result = $this->plugnpay->pay($order);
					
					/*
					echo 'Website on Test...<br/>';
					echo $result['MErrMsg'];
					
					echo '<pre>';
					die(print_r($result));
					
					echo '</pre>';
					
					*/
					
					$payment_method = 'credit_card';
				}
				
				
				
				if($result['FinalStatus']=='success')
				{
				     
					if($oid = $this->Order_model->create_Order($this->session->userdata('cart_id'),$totals,$customer_id,$affiliate_id,$payment_method,$this->session->userdata('ban_id')))
					{
						
						//﻿$linkimg  = '<img src="http://track.linksynergy.com/
						// ep?mid=xxxx&ord=xx&skulist=xxxx
						// &qlist=xxx&amtlist=xxxx&cur=xxx&namelist=xxxxx">';
						
						$cart_id = $this->session->userdata('cart_id');
						
	 					$this->db->where('cart_id',$cart_id);
	 					$this->db->update('carts',array('completed'=>'1'));
								
	 					$this->session->set_userdata('cart_id','0');
						
						$temptot = $totals['itemtotal'] - $totals['discount'] - $totals['coupon'];
						$gtemptot = $totals['itemtotal'];

						$linkimg = '<img src="http://track.linksynergy.com/ep?mid=37609&ord='.$oid;
						$linkimg .= '&skulist='.implode('|',$skulist);
						$linkimg .= '&qlist='.implode('|',$qlist);
						$linkimg .= '&amtlist='.implode('|',$amtlist);
						$linkimg .= '&cur=CAD';
						$linkimg .= '&namelist='.implode('|',$namelist).'">';
						
						$tsa = '<script src="https://thesearchagency.net/tsawaypoint.php?siteid=855&wayid=7685&';
						$tsa .= 'value='.round($totals['grandtotal']*100);
						$tsa .= '&units=1|'.implode('|',$units).'|1';
						$tsa .= '&productID=order|'.implode('|',$productids).'|Shipping';
						$tsa .= '&itemValues='.round($totals['grandtotal']*100).'|'.implode('|',$itemvalues).'|'.(($totals['shipping']+$totals['service']+$totals['surcharge'])*100);
						$tsa .= '&backref='.$oid.'" language="JavaScript" type="text/javascript"></script>';
						
						$emlimg = '<img src="http://email.memorialflowers.ca/public/?q=direct_add&fn=Public_DirectAddForm&id=bvvqnvtvffundtrubmhhrsjocigpbmg&email=';
						$emlimg .= $order->email.'&field1=lastorderdate,set,';
						$emlimg .= date('Y-m-d',time()).'&field2=lastordertotal,set,';
						$emlimg .= number_format($temptot,2).'&list1=0bba03ec00000000000000000000000492e6" width="0" height="0" border="0" alt=""/>';
						
						$ggtrans = 'pageTracker._addTrans(';
						$ggtrans .= '"'.$oid.'",';
						$ggtrans .= '"1-800-Flowers Canada",';
						$ggtrans .= '"'.$gtemptot.'",';
						$ggtrans .= '"'.number_format($totals['tax'],2).'",';
						$ggtrans .= '"'.number_format(($totals['shipping']+$totals['service']+$totals['surcharge']),2).'",';
						$ggtrans .= '"Toronto",';
						$ggtrans .= '"Ontario",';
						$ggtrans .= '"Canada");';
						
						$ggitems = '';
						
						foreach($cartitems as $citem)
						{
							
							$skulist[] = $citem['sku'];
							$qlist[] = $citem['qty'];
							$amtlist[] = $citem['amt'];
							$namelist[] = $citem['name'];
							
							$ggitems .= 'pageTracker._addItem(';
							$ggitems .= '"'.$oid.'",';
							$ggitems .= '"'.$citem['sku'].'",';
							$ggitems .= '"'.$citem['name'].'",';
							$ggitems .= '"'.$citem['category'].'",';
							$ggitems .= '"'.number_format(($citem['amt']/100),2).'",'.$citem['qty'];
							$ggitems .= ');'."\n";
							
						}
						
						$sconvtot = number_format($totals['grandtotal'],2); //$totals['itemtotal'] - $totals['discount'] - $totals['coupon'] + $totals['shipping'] + $totals['service'] + $totals['surcharge'] + $totals['tax'];
						
						$data['googlecode'] = $ggtrans . "\n\n" . $ggitems;
						$data['sconversion'] = '<img src="http://app.bronto.com/public/?q=stream_conversion&fn=Mail_Conversion&id=bvvqnvtvffundtrubmhhrsjocigpbmg&type=$&description=siteorder&money='.number_format($sconvtot,2).'" width="0" height="0" border="0" alt=""/>';
						
						
						$data['linkimg'] = $linkimg;
						$data['tsa'] = $tsa;
						$data['emlimg'] = $emlimg;
						$data['conversion'] = $conversion;
						$data['invoiceTotal'] = $invoiceTotal;
						
						$eformat = str_replace('{invoice_num}',$oid,$eformat);
						
						$admin_format = $eformat;
						$admin_format = str_replace('{items}',$aitemformat,$admin_format);
						$admin_format = str_replace('{email_header}','User Type:'.strtoupper($this->session->userdata('user_role')),$admin_format);
						
						$eformat = str_replace('{items}',$itemformat,$eformat);
						$eformat = str_replace('{email_header}',$eheader,$eformat);
						
						$this->load->library('email');
						
						$email_config['mailtype'] = 'html';
						$this->email->initialize($email_config);
						
						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						//$this->email->to($order->email);
						$this->email->to($this->input->post('email'));
						$this->email->bcc('orders@memorialflowers.ca');
						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($eformat);
						
						if($this->email->send())
						{
							$success = true;
						}

						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						$this->email->to('orders@memorialflowers.ca');
						$this->email->cc('jakki@whatabloom.com');

						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($admin_format);
						
						
						if($this->email->send())
						{
							$success = true;
						}
					
	//					$this->unset_cart();
	
	
	
	
	
	
	/*
	
			
			$day = substr($item->delivery_date, 8, 2);
			$month = substr($item->delivery_date, 5, 2);
			$year = substr($item->delivery_date, 0, 4);	
			
			
			$phone1 = substr($item->dayphone, 0, 3);
			$phone2 = substr($item->dayphone, 3, 3);
			$phone3 = substr($item->dayphone, 6, 4);
			
			
			
 
 
 
$from = 'web_orders@whatabloom.com';


$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: <orders@memorialflowers.ca>";
$headers[] = "Reply-To: Orders <orders@whatabloom.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$subject2 = "Web Order"; 

$autoreply = 'Bill Name: Memorial Flowers
Delivery Instructions: '.$oid.'-'.$item->product_code.' (DS: '.$item->orderitem_id.')
Delivery (Day): '.$day.'
Delivery (Month): '.$month.'
Delivery (Year): '.$year.'
Card Message: '.$item->card_message.'
Product AmountX: '.number_format($totals['itemtotal'],2).'
Product CodeX: '.$item->product_code.'
Product DescriptionX: '.$item->product_name.'
Product QtyX: 1
Recipient Name: '.$item->firstname.' '.$item->lastname.'
Recipient Company: '.$item->firstname.' '.$item->lastname.'
Recipient Address1: '.$item->address1.'
Recipient Address2: '.$item->address2.'
Recipient City: '.$item->city.'
Recipient State: '.$item->province.'
Recipient Country Code: CA
Recipient Zip Code: '.$item->postalcode.'
Recipient Phone Area Code: '.$phone1.'
Recipient Phone Prefix: '.$phone2.'
Recipient Phone Number: '.$phone3.'';


 
 
 
 $send2 = mail($from, $subject2, $autoreply, implode("\r\n", $headers)); 
 if($send2) 
 {
 else 
 {
 }	
	
	
	
	*/
	
	
	
	
	
	
						
						if($this->session->userdata('test_affiliate') == 5886161){
					   
						$this->session->set_userdata('referer',0);
						
					   }
						
						$data['items'] = $this->Order_model->getDelivery($cart_id);
						$data['message'] = 'Your order completed successfully';
						$data['invoice_number'] = $oid;
						$data['totals'] = $totals;
						$data['billing'] = $this->Order_model->getBilling($cart_id);
						$data['page'] = $this->Pages_model->return_page('order-thanks');
						$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Thank you'=>'');
						
						$this->load->view('thankyou',$data);							
						exit;
					}
					
				}
				else 
				{
					$elist = '<ul class="elist">';
			
					if($cerrors = explode('|',$result['MErrMsg']))
					{
						foreach($cerrors as $ce)
						{
							if(!empty($ce))
							{
								$elist .= '<li>'.$ce.'</li>';
							}
							
						}
					}
					else
					{
						$elist = '<li>'.$result['MErrMsg'].'<li>';
					}
					
					$elist .= '</ul>';
					
					$elist = '<div class="show_errors"><h3>'.'Error in Payment'.'</h3>'.$elist.'</div>';
					
		
				
				}

			}


		}
		
	
	}
	
	function autoLogin($id)
	{
                $customer = $this->Customer_model->get_customer($id);
                if($customer->user_id)
                {
                    $this->session->set_userdata('customer_id',$customer->user_id);
                    $this->session->set_userdata('user_firstname',$customer->user_firstname);
                    $this->session->set_userdata('user_lastname',$customer->user_lastname);
		    $this->session->set_userdata('user_company',$customer->parent_id);
		    $this->session->set_userdata('user_role',$customer->user_role);
                    $this->Customer_model->register_Login($customer->user_id);
                }
	}
	
	function checkout_temp()
	{
		use_ssl(false);
		
		//echo "Aff is here === ". $this->session->userdata('referer');
		
		$cart_id = $this->session->userdata('cart_id');
		
		if($this->Order_model->is_cart_empty($cart_id))
		{
			redirect('/shop/cart');
			exit;
		}
		elseif(!$this->Order_model->is_delivery_entered($cart_id))
		{
			redirect('/shop/delivery');
			exit;
		}
		elseif(!$this->Order_model->is_billing_entered($cart_id))
		{
			redirect('/shop/billing');
			exit;	
		}
		else
		{			
			$this->load->model('Group_model');
			
			$cart = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));
			
			$totals = array('itemtotal'=>0,
					'shipping'=>0,
					'service'=>0,
					'surcharge'=>0,
					'tax'=>0,
					'discount'=>0,
					'coupon'=>0,
					'coupon_code'=>'',
                                        'companyless'=>0,
					'grandtotal'=>0);
			
			$order_items = '';
                        $oformat = file_get_contents('assets/email_items.html');
                        $aoformat = 
                        $itemformat = '';
                        $aitemformat = '';
                        
                        $icnt = 0;
			$itemprc = 0;
			
			$this->load->model('Company_model');
			$this->load->model('Customer_model');
			
			$cartdiscount = 0;
			$cartcoupon = 0;
			$cartdiscounttype = 'percentage';
			$cartcoupontype = 'percentage';
			
			foreach($cart as $item)
			{				
				$totals['itemtotal'] += $item->product_price;
				
				foreach($item->addons as $addon)
				{
					$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
				}
				
			}
			
			
			$coupon_discount = 0;
			
			if($user_discount=$this->Customer_model->getDiscount($this->session->userdata('customer_id')))
			{
				$totals['discount'] = ($totals['itemtotal'] * $user_discount) / 100;
			}
			else
			{
				
				if($this->session->userdata('coupon'))
				{
					if($coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']))
					{
						$totals['coupon_code'] = $coupon->discount_name;
						if($coupon->discount_amount>0)
						{
							$cartcoupon = $coupon->discount_amount;
							$cartcoupontype = 'amount';
						}
						else
						{
							$cartcoupon = $coupon->discount_percentage;
							$cartcoupontype = 'percentage';
						}						
					}
				}
				
				if($cartcoupon<=0)
				{
					if($discount = get_discount($totals['itemtotal']))
					{
						if($discount->discount_amount>0)
						{
							$cartdiscount = $discount->discount_amount;
							$cartdiscounttype = 'amount';
						}
						else
						{
							$cartdiscount = $discount->discount_percentage;
							$cartdiscounttype = 'percentage';
						}						
					}
				}
				
			}
			
			
			$conversion = '';
			
			$cartitems = array();
			
			$itemscount = count($cart);
                                                                        		
			foreach($cart as $item)
			{
				$itemprc = 0;
				$ptotal = $item->product_price;
				
                                $icnt++;
                                
                                $itemf = $oformat;
                                $itemf = str_replace('{counter}',$icnt,$itemf);
                                $itemf = str_replace('{firstname}',$item->firstname,$itemf);
                                $itemf = str_replace('{lastname}',$item->lastname,$itemf);
								
								$itemf = str_replace('{location_type}',$item->location_type,$itemf);
								$itemf = str_replace('{location_type_name}',$item->location_type_name,$itemf);
								
                                $itemf = str_replace('{address1}',$item->address1,$itemf);
                                $itemf = str_replace('{address2}',$item->address2,$itemf);
                                $itemf = str_replace('{city}',$item->city,$itemf);
                                $itemf = str_replace('{postalcode}',$item->postalcode,$itemf);
                                $itemf = str_replace('{province}',$item->province,$itemf);
                                $itemf = str_replace('{country}',$item->country_id,$itemf);
                                $itemf = str_replace('{phone}',$item->dayphone.' '.$item->evephone,$itemf);
                                
                                $itemf = str_replace('{message}',$item->card_message,$itemf);
							    $itemf = str_replace('{special_note}',$item->ribbon_text,$itemf);
                                $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)).' - '.$item->delivery_time,$itemf);
								
								  
								  
                                $itemf = str_replace('{shipping_method}',$item->infotext,$itemf);
								$itemf = str_replace('{delivery_info}',$item->delivery_description,$itemf);

                                $itemf = str_replace('{product_image}','<img src="'.$this->config->item('base_url').img_format('productres/'.$item->product_picture, 'thumb').'" />',$itemf);
                                $itemf = str_replace('{product_code}',$item->product_code,$itemf);
								$itemf = str_replace('{orderitem_id}',$item->orderitem_id,$itemf);
								
								
				
								$itemf = str_replace('{product_name}',$item->product_name .'<br/><small>('.$item->price_name.')</small>',$itemf);
                                $itemf = str_replace('{price}','$'.number_format($item->product_price,2),$itemf);
                                $itemf = str_replace('{quantity}','1',$itemf);
				
				$itemprc += $item->product_price;
				
				if($item->delivery_method_id==1)
				{
					$itemf = str_replace('{delivery_by}','Delivery by Local',$itemf);
				}
				else
				{
					$itemf = str_replace('{delivery_by}','This bouquet comes to via UPS.',$itemf);
				}
				
                                $itemf = str_replace('{total}','$'.number_format($item->product_price,2),$itemf);
				
				if(array_key_exists($item->product_id,$cartitems))
				{
					$cartitems[$item->product_id]['sku'] = $item->product_code;
					$cartitems[$item->product_id]['qty'] = $cartitems[$item->product_id]['qty'] + 1;
					$cartitems[$item->product_id]['amt'] = $cartitems[$item->product_id]['amt'] + $item->product_price*100;
					$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
					$cartitems[$item->product_id]['category'] = urlencode($item->category);
				}
				else
				{
					$cartitems[$item->product_id]['sku'] = $item->product_code;
					$cartitems[$item->product_id]['qty'] = 1;
					$cartitems[$item->product_id]['amt'] = $item->product_price*100;
					$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
					$cartitems[$item->product_id]['category'] = urlencode($item->category);
					
				}
                            
                                $addontot = 0;
                                
                                if(count($item->addons))
                                {
				    $order_items = '';
				   
                                    foreach($item->addons as $addon)
                                    {
						$order_items .= '+(' . $addon->addon_name ." ".$addon->addon_quantity.'x$'.number_format($addon->addon_price,2).")   $".number_format(($addon->addon_price*$addon->addon_quantity),2)."<br/>\n" ;
						$itemprc += ($addon->addon_price*$addon->addon_quantity);
						$addontot += ($addon->addon_price*$addon->addon_quantity);
						$ptotal += ($addon->addon_price*$addon->addon_quantity);
						
						if(array_key_exists($addon->addon_id,$cartitems))
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $cartitems[$addon->addon_id]['qty']+$addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = $cartitems[$addon->addon_id]['amt']+($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
						}
						else
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = ($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
						}										
					
					//echo $order_items;
				    }
				    
				    	//echo $order_items;
                                }
                                else
                                {
                                    $order_items .= 'None';                                    
                                }
				
				$conversion .= 'bta.addConversionLegacy("$", "'.$item->product_name.'", "'.number_format($itemprc,2).'");'."\n";
				
                                $itemf = str_replace('{addons}',$order_items,$itemf);
                                $itemf = str_replace('{addon_price}','$'.number_format($addontot,2),$itemf);
				
				$addition = $this->Order_model->get_add_charges($item->orderitem_id);
				
				$totals['shipping'] += $addition['shipping'];
				$totals['service'] += $addition['service'];
				$totals['surcharge'] += $addition['surcharge'];
							
				if($cartcoupon>0)
				{
					if($cartcoupontype=='percentage')
					{
						$totals['coupon'] += ($cartcoupon * $ptotal) / 100;
						$ptotal -= ($cartcoupon * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartcoupon / $itemscount;
						$totals['coupon'] += $part;
						$ptotal -= $part;
						
					}
				}
				else
				{
					if($cartdiscounttype=='percentage')
					{
						$totals['discount'] += ($cartdiscount * $ptotal) / 100;
						$ptotal -= ($cartdiscount * $ptotal) / 100;
						
					}
					else
					{
						$part = $cartdiscount / $itemscount;
						$totals['discount'] += $part;
						$ptotal -= $part;
						
					} 
				}
				
				$ptotal += $addition['shipping'];
				$ptotal += $addition['service'];
				$ptotal += $addition['surcharge'];

				$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
                            
				$aitemformat .= str_replace('{product_description}','',$itemf);
				$itemf = str_replace('{product_description}',substr($item->product_description,0,50),$itemf);
				$itemformat .= $itemf;
			}
			
			$ggitems = '';
			
			foreach($cartitems as $citem)
			{
				$productids[] = $citem['sku'].':'.str_replace('+','',$citem['name']);
				$itemvalues[] = $citem['amt'];
				$units[] = $citem['qty'];
				$skulist[] = $citem['sku'];
				$qlist[] = $citem['qty'];
				$amtlist[] = $citem['amt'];
				$namelist[] = $citem['name'];
				
			}	
			
			if($totals['discount']>0)
			{
				$skulist[] = 'Discount';
				$qlist[] = 0;
				$amtlist[] = round($totals['discount']*(-100));
				$namelist[] = 'Discount';
				$productids[] = 'Discount';
				$itemvalues[] = round($totals['discount']*(100));
				$units[] = 1;
			}
			elseif($totals['coupon']>0)
			{
				$skulist[] = 'Discount';
				$qlist[] = 0;
				$amtlist[] = round($totals['coupon']*(-100));
				$namelist[] = 'Discount';
				$productids[] = 'Discount';
				$itemvalues[] = round($totals['coupon']*(100));
				$units[] = 1;
			}
			else
			{
				$productids[] = 'Discount';
				$itemvalues[] = 0;
				$units[] = 1;
			}
                        
			
			$affid=$this->session->userdata('referer');

			if($affid!='') 
			{
				$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
			}
			else 
			{
				$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
			}			
			
		//	$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);
			
			$invoiceTotal = number_format($totals['grandtotal'],2);

			$customer_id= $this->session->userdata('customer_id') ? $this->session->userdata('customer_id'):'0';
			$affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'';
			
			
			if($this->session->userdata('customer_account') == 1 && $this->session->userdata('customer_id')<>0){
			$this->form_validation->set_rules("use", 'Account','required');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			}else{
			$this->form_validation->set_rules("cardnumber", 'Credit Card Number','required|numeric|min_length[15]|max_length[16]');
			$this->form_validation->set_rules("expiry_month", 'Expiry Month','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("expiry_year", 'Expiry Year','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("cvv", 'CVV2','required|min_length[3]|max_length[5]');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			}
			
			
			if ($this->form_validation->run() == TRUE)
			{
				if($this->session->userdata('logo') != ''){
				
					$eformat = file_get_contents('assets/email_format.html');
				}else{
					$eformat = file_get_contents('assets/email_format2.html');
				
				}
				
				
				
				$eheader = file_get_contents('assets/email_header.html');
			
				
				
				if($this->session->userdata('customer_account') == 1 && $this->session->userdata('customer_id')<>0){
				$order = unserialize(base64_decode($_POST['data'])); 
				}else{
				$this->load->library('plugnpay');
				$order = unserialize(base64_decode($_POST['data']));
				}
				
				
				
				$country = $this->Country_model->get_country($order->country_id);
				
				$order->country = $country->country_name;
				$order->ipaddress = $_SERVER['REMOTE_ADDR'];
				$order->nameoncard = $this->input->post('nameoncard');
				$order->cardnumber = $this->input->post('cardnumber');
				$order->cvv = $this->input->post('cvv');
				$order->expiry = $this->input->post('expiry_month').'/'.$this->input->post('expiry_year');
				$order->total = $totals['grandtotal'];
				$order->affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'0';                                       

				$eheader = str_replace('{firstname}',$order->firstname,$eheader);
				$eformat = str_replace('{firstname}',$order->firstname,$eformat);
				$eformat = str_replace('{lastname}',$order->lastname,$eformat);
				$eformat = str_replace('{address1}',$order->address1,$eformat);
				$eformat = str_replace('{address2}',$order->address2,$eformat);
				$eformat = str_replace('{city}',$order->city,$eformat);
				$eformat = str_replace('{postalcode}',$order->postalcode,$eformat);
				$eformat = str_replace('{country}',$order->country,$eformat);
				$eformat = str_replace('{email}',$order->email,$eformat);
				$eformat = str_replace('{dayphone}',$order->dayphone,$eformat);
				$eformat = str_replace('{evephone}',$order->dayphone,$eformat);
				$eformat = str_replace('{product_price}','$'.number_format($totals['itemtotal'],2),$eformat);
				$eformat = str_replace('{delivery_charge}','$'.number_format($totals['shipping'],2),$eformat);
				$eformat = str_replace('{service_charge}','$'.number_format($totals['service'],2),$eformat);
				$eformat = str_replace('{surcharge}','$'.number_format($totals['surcharge'],2),$eformat);
				$eformat = str_replace('{discount}','$'.number_format($totals['discount']-$totals['coupon']-$totals['companyless'],2),$eformat);

				$eformat = str_replace('{tax}','$'.number_format($totals['tax'],2),$eformat);
				$eformat = str_replace('{grand_total}','$'.number_format($totals['grandtotal'],2),$eformat);
				
				$eformat = str_replace('{affi_logo}',$this->session->userdata('logo'),$eformat);
								


				/*if($_SERVER['REMOTE_ADDR']=='127.0.0.1' && ENVIRONMENT=='development')
				{
					$result['FinalStatus']='success';
					$payment_method = 'credit_card';
				}
				else
				{
					$result = $this->plugnpay->pay($order);
					
					/*
					echo 'Website on Test...<br/>';
					echo $result['MErrMsg'];
					
					echo '<pre>';
					die(print_r($result));
					
					echo '</pre>';
					
					*/
				/*	
					$payment_method = 'credit_card';
				}*/
				
				
				if($this->session->userdata('customer_account') == 1 || $_SERVER['REMOTE_ADDR']=='117.253.195.106')
				{
					$result['FinalStatus']='success';
					$payment_method = 'company_pay';
				}
				else
				{
					$result = $this->plugnpay->pay($order);
					
					/*
					echo 'Website on Test...<br/>';
					echo $result['MErrMsg'];
					
					echo '<pre>';
					die(print_r($result));
					
					echo '</pre>';
					
					*/
					
					$payment_method = 'credit_card';
				}
				
				
				
				if($result['FinalStatus']=='success')
				{
				     
					if($oid = $this->Order_model->create_Order($this->session->userdata('cart_id'),$totals,$customer_id,$affiliate_id,$payment_method,$this->session->userdata('ban_id')))
					{
						
						//﻿$linkimg  = '<img src="http://track.linksynergy.com/
						// ep?mid=xxxx&ord=xx&skulist=xxxx
						// &qlist=xxx&amtlist=xxxx&cur=xxx&namelist=xxxxx">';
						
						$cart_id = $this->session->userdata('cart_id');
						
	 					$this->db->where('cart_id',$cart_id);
	 					$this->db->update('carts',array('completed'=>'1'));
								
	 					$this->session->set_userdata('cart_id','0');
						
						$temptot = $totals['itemtotal'] - $totals['discount'] - $totals['coupon'];
						$gtemptot = $totals['itemtotal'];

						$linkimg = '<img src="http://track.linksynergy.com/ep?mid=37609&ord='.$oid;
						$linkimg .= '&skulist='.implode('|',$skulist);
						$linkimg .= '&qlist='.implode('|',$qlist);
						$linkimg .= '&amtlist='.implode('|',$amtlist);
						$linkimg .= '&cur=CAD';
						$linkimg .= '&namelist='.implode('|',$namelist).'">';
						
						$tsa = '<script src="https://thesearchagency.net/tsawaypoint.php?siteid=855&wayid=7685&';
						$tsa .= 'value='.round($totals['grandtotal']*100);
						$tsa .= '&units=1|'.implode('|',$units).'|1';
						$tsa .= '&productID=order|'.implode('|',$productids).'|Shipping';
						$tsa .= '&itemValues='.round($totals['grandtotal']*100).'|'.implode('|',$itemvalues).'|'.(($totals['shipping']+$totals['service']+$totals['surcharge'])*100);
						$tsa .= '&backref='.$oid.'" language="JavaScript" type="text/javascript"></script>';
						
						$emlimg = '<img src="http://email.memorialflowers.ca/public/?q=direct_add&fn=Public_DirectAddForm&id=bvvqnvtvffundtrubmhhrsjocigpbmg&email=';
						$emlimg .= $order->email.'&field1=lastorderdate,set,';
						$emlimg .= date('Y-m-d',time()).'&field2=lastordertotal,set,';
						$emlimg .= number_format($temptot,2).'&list1=0bba03ec00000000000000000000000492e6" width="0" height="0" border="0" alt=""/>';
						
						$ggtrans = 'pageTracker._addTrans(';
						$ggtrans .= '"'.$oid.'",';
						$ggtrans .= '"1-800-Flowers Canada",';
						$ggtrans .= '"'.$gtemptot.'",';
						$ggtrans .= '"'.number_format($totals['tax'],2).'",';
						$ggtrans .= '"'.number_format(($totals['shipping']+$totals['service']+$totals['surcharge']),2).'",';
						$ggtrans .= '"Toronto",';
						$ggtrans .= '"Ontario",';
						$ggtrans .= '"Canada");';
						
						$ggitems = '';
						
						foreach($cartitems as $citem)
						{
							
							$skulist[] = $citem['sku'];
							$qlist[] = $citem['qty'];
							$amtlist[] = $citem['amt'];
							$namelist[] = $citem['name'];
							
							$ggitems .= 'pageTracker._addItem(';
							$ggitems .= '"'.$oid.'",';
							$ggitems .= '"'.$citem['sku'].'",';
							$ggitems .= '"'.$citem['name'].'",';
							$ggitems .= '"'.$citem['category'].'",';
							$ggitems .= '"'.number_format(($citem['amt']/100),2).'",'.$citem['qty'];
							$ggitems .= ');'."\n";
							
						}
						
						$sconvtot = number_format($totals['grandtotal'],2); //$totals['itemtotal'] - $totals['discount'] - $totals['coupon'] + $totals['shipping'] + $totals['service'] + $totals['surcharge'] + $totals['tax'];
						
						$data['googlecode'] = $ggtrans . "\n\n" . $ggitems;
						$data['sconversion'] = '<img src="http://app.bronto.com/public/?q=stream_conversion&fn=Mail_Conversion&id=bvvqnvtvffundtrubmhhrsjocigpbmg&type=$&description=siteorder&money='.number_format($sconvtot,2).'" width="0" height="0" border="0" alt=""/>';
						
						
						$data['linkimg'] = $linkimg;
						$data['tsa'] = $tsa;
						$data['emlimg'] = $emlimg;
						$data['conversion'] = $conversion;
						$data['invoiceTotal'] = $invoiceTotal;
						
						$eformat = str_replace('{invoice_num}',$oid,$eformat);
						
						$admin_format = $eformat;
						$admin_format = str_replace('{items}',$aitemformat,$admin_format);
						$admin_format = str_replace('{email_header}','User Type:'.strtoupper($this->session->userdata('user_role')),$admin_format);
						
						$eformat = str_replace('{items}',$itemformat,$eformat);
						$eformat = str_replace('{email_header}',$eheader,$eformat);
						
						$this->load->library('email');
						
						$email_config['mailtype'] = 'html';
						$this->email->initialize($email_config);
						
						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						//$this->email->to($order->email);
						$this->email->to($order->email);
						$this->email->bcc('orders@memorialflowers.ca');
						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($eformat);
						
						if($this->email->send())
						{
							$success = true;
						}

						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						$this->email->to('orders@memorialflowers.ca');
						$this->email->cc('jakki@whatabloom.com');

						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($admin_format);
						
						
						if($this->email->send())
						{
							$success = true;
						}
					
	//					$this->unset_cart();
	
	
	
	
	
	
	
	
						
						if($this->session->userdata('test_affiliate') == 5886161){
					   
						$this->session->set_userdata('referer',0);
						
					   }
						
						$data['items'] = $this->Order_model->getDelivery($cart_id);
						$data['message'] = 'Your order completed successfully';
						$data['invoice_number'] = $oid;
						$data['totals'] = $totals;
						$data['billing'] = $this->Order_model->getBilling($cart_id);
						$data['page'] = $this->Pages_model->return_page('order-thanks');
						$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Thank you'=>'');
						
						$this->load->view('thankyou',$data);						
						exit;
					}
					
				}
				else 
				{
					$elist = '<ul class="elist">';
			
					if($cerrors = explode('|',$result['MErrMsg']))
					{
						foreach($cerrors as $ce)
						{
							if(!empty($ce))
							{
								$elist .= '<li>'.$ce.'</li>';
							}
							
						}
					}
					else
					{
						$elist = '<li>'.$result['MErrMsg'].'<li>';
					}
					
					$elist .= '</ul>';
					
					$elist = '<div class="show_errors"><h3>'.'Error in Payment'.'</h3>'.$elist.'</div>';
					
		
				
				}

			}



			$this->load->Model('Occasion_model');
			$data['elist'] = isset($elist) ? $elist:'';
			$data['countries'] = $this->Country_model->get_countries();
			$data['items'] = $this->Order_model->getDelivery($cart_id);
			$data['occasions']= $this->Occasion_model->get_occasions_array();
			$data['billing'] = $this->Order_model->getBilling($cart_id);
			if($this->session->userdata('user_role')=='company')
			{
				$this->load->model('Company_model');
				$pmethod = $this->Company_model->get_pmethod($this->session->userdata('customer_id'));
				if($pmethod==1)
					$data['on_account'] = 1;
				else
					$data['on_account'] = 0;
			}
			else
			{
				$data['on_account'] = 0;
			}

			$data['encoded'] = base64_encode(serialize($data['billing']));
			$data['totals'] = $totals;
			$data['current_page'] = 'revieworder';
			$data['page'] = $this->Pages_model->return_page('checkout');
			$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Review & Pay'=>'');

			$this->load->view('checkout',$data);	

		}
		
	}
	
	
	function editbilling()
	{
		
		$this->form_validation->set_rules("firstname", 'First Name','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules("lastname", 'Last Name','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules("address1", 'Address','required|min_length[1]|max_length[100]');
		$this->form_validation->set_rules("postalcode", 'Postal Code','required|min_length[5]|max_length[7]');
		$this->form_validation->set_rules("city", 'City','required|min_length[1]|max_length[30]');
		$this->form_validation->set_rules("province", 'Province','required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules("country_id", 'Country','required|min_length[1]');
		$this->form_validation->set_rules("email", 'Email','required|valid_email|min_length[0]|max_length[45]');
		$this->form_validation->set_rules("dayphone",'Day Phone','required|min_length[5]|max_length[15]');
		$this->form_validation->set_rules("evephone", 'Evening Phone','min_length[0]|max_length[15]');
		$this->form_validation->set_rules("create_account", 'Create Account','max_length[5]');
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$cartid = $this->session->userdata('cart_id');
			$data['billing'] = $this->Order_model->getBilling($cartid);
			$data['p'] = (object) $_POST;
			
			$output = $this->load->view('edit-billing',$data,TRUE);
	
			$result = array('form'=>$output,'result'=>'failed');
			
			die(json_encode($result));
		}
		else
		{
			$cart_id = $this->session->userdata('cart_id');
			if($this->Order_model->update_Billing($cart_id,$this->input->post()))
			{
				$status = 'ok';
			}
			else
			{
				$status = 'failed';
			}
			
			$result = array('result'=>$status);
			die(json_encode($result));
			
		}		
		
	}
	
	
	function editdelivery($orderitem_id=0)
	{
		
		$this->form_validation->set_rules("firstname", 'First Name','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules("lastname", 'Last Name','required|min_length[1]|max_length[45]');
		$this->form_validation->set_rules("location_type", 'Location Type','required|min_length[3]|max_length[45]');
		$this->form_validation->set_rules("address1", 'Address','required|min_length[1]|max_length[100]');
		$this->form_validation->set_rules("postalcode", 'Postal Code','required|callback_postalcode_check');
		$this->form_validation->set_message('callback_postalcode_check[postalcode]', 'Invalid Postalcode!');
		$this->form_validation->set_rules("city", 'City','required|min_length[1]|max_length[30]');
		$this->form_validation->set_rules("province", 'Province','required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules("country_id", 'Country','required');
		$this->form_validation->set_rules("dayphone",'Day Phone','required|min_length[5]|max_length[15]');
		$this->form_validation->set_rules("evephone", 'Evening Phone','min_length[0]|max_length[15]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$cartid = $this->session->userdata('cart_id');
			$data['row'] = $this->Order_model->get_Delivery($cartid,$orderitem_id);
			$data['p'] = (object) $_POST;
			$data['orderitem_id'] = $orderitem_id;
			
			$output = $this->load->view('edit-delivery',$data,TRUE);
	
			$result = array('form'=>$output,'result'=>'failed');
			
			die(json_encode($result));
		}
		else
		{
			$cart_id = $this->session->userdata('cart_id');
			if($this->Order_model->updateDelivery($cart_id,$orderitem_id,$this->input->post()))
			{
				$status = 'ok';
			}
			else
			{
				$status = 'failed';
			}
			
			$result = array('result'=>$status);
			die(json_encode($result));
			
		}		
		
	}
	
	function unset_cart()
	{
		$this->session->unset_userdata('cart_id');
		$this->session->unset_userdata('guest_checkout');
		$this->session->unset_userdata('coupon');
	}

	function get_totals($cartid)
	{
		$cart = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));

		$totals = array('itemtotal'=>0,'shipping'=>0,'service'=>0,'surcharge'=>0,'tax'=>0,'discount'=>0,'coupon'=>0,
				'coupon_code'=>'', 'companyless'=>0, 'grandtotal'=>0);

		$cartdiscount = 0;
		$cartcoupon = 0;
		$cartdiscounttype = 'percentage';
		$cartcoupontype = 'percentage';

		foreach($cart as $item)
		{				
			$totals['itemtotal'] += $item->product_price;
			$ptotal = $item->product_price;
			foreach($item->addons as $addon)
			{
				$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
			}
		}

		if($this->session->userdata('coupon'))
		{
			if($coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']))
			{
				$totals['coupon_code'] = $coupon->discount_name;
				if($coupon->discount_amount>0)
				{
					$cartcoupon = $coupon->discount_amount;
					$cartcoupontype = 'amount';
				}
				else
				{
					$cartcoupon = $coupon->discount_percentage;
					$cartcoupontype = 'percentage';
				}						
			}
		}
	
		if($cartcoupon <= 0)
		{
			if($discount = get_discount($totals['itemtotal']))
			{
				if($discount->discount_amount>0)
				{
					$cartdiscount = $discount->discount_amount;
					$cartdiscounttype = 'amount';
				}
				else
				{
					$cartdiscount = $discount->discount_percentage;
					$cartdiscounttype = 'percentage';
				}						
			}
		}

		$addition = $this->Order_model->get_add_charges($item->orderitem_id);

		$totals['shipping'] += $addition['shipping'];
		$totals['service'] += $addition['service'];
		$totals['surcharge'] += $addition['surcharge'];
					
		if($cartcoupon>0)
		{
			if($cartcoupontype=='percentage')
			{
				$totals['coupon'] += ($cartcoupon * $ptotal) / 100;
				$ptotal -= ($cartcoupon * $ptotal) / 100;
			}
			else
			{
				$part = $cartcoupon / $itemscount;
				$totals['coupon'] += $part;
				$ptotal -= $part;
			}
		}
		else
		{
			if($cartdiscounttype=='percentage')
			{
				$totals['discount'] += ($cartdiscount * $ptotal) / 100;
				$ptotal -= ($cartdiscount * $ptotal) / 100;
			}
			else
			{
				$part = $cartdiscount / $itemscount;
				$totals['discount'] += $part;
				$ptotal -= $part;
			} 
		}
		
		$ptotal += $addition['shipping'];
		$ptotal += $addition['service'];
		$ptotal += $addition['surcharge'];

		$totals['tax'] += ($addition['tax'] * $ptotal) / 100;

		$affid=$this->session->userdata('referer');

		if($affid!='') {
			$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);	
		}
		else {
			$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);	
		}

		return $totals;

	}

	function checkout() 
	{
	
		$this->load->Model('Product_model');
		
		//UPDATE CARD MESSAGE
		$datos = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));
		
			foreach($datos as $item){
				$this->Order_model->update_item_card_message($this->input->post('card_message'.$item->orderitem_id),$item->orderitem_id);
			}
		//UPDATE CARD MESSAGE
			
		$cart = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));	
	
		if(count($cart)<1) 
		{
			redirect('/shop/cart');
			exit;
		}

		$data['cart'] = $cart;

		$totals = $this->get_totals($this->session->userdata('cart_id'));
		
		//OSCAR CODE
		$totals['itemtotal'] = $this->input->post('final_pricing');
		$totals['service'] = $this->input->post('final_service');
		$totals['shipping'] = 0;
		$totals['tax'] = $this->input->post('final_tax');
		//OSCAR CODE
		
		$data['totals'] = $totals;

		$this->load->library('Form_validation');
		$this->load->model('Province_model');

		$this->form_validation->set_rules('nameoncard','Name on Card','required');
		$this->form_validation->set_rules("card_number", 'Credit Card Number','required|numeric|min_length[15]|max_length[16]');
		$this->form_validation->set_rules("exp_month", 'Expiry Month','required|min_length[2]|max_length[5]');
		$this->form_validation->set_rules("exp_year", 'Expiry Year','required|min_length[2]|max_length[5]');
		$this->form_validation->set_rules("cvv", 'CVV2','required|min_length[3]|max_length[5]');
		$this->form_validation->set_rules('address1','Address','required');
		$this->form_validation->set_rules('city','City','required');
		$this->form_validation->set_rules('postalcode','Postalcode','required');
		$this->form_validation->set_rules('province_id','Province_id','required');
		$this->form_validation->set_rules('email','Email Address','required|valid_email');

		/*	
		if($_POST['shipping_to']=='funeral home')
		{
		*/
			$this->form_validation->set_rules('fh_name','Name','required');
			$this->form_validation->set_rules('fh_address1','Address Line 1','required');
			$this->form_validation->set_rules('fh_postalcode','Postal code','required');
			$this->form_validation->set_rules('fh_city','City','required');
			$this->form_validation->set_rules('fh_province_id','Provnce','required');
		/*
		}
		else
		{
			$this->form_validation->set_rules('ho_name','Name','required');
			$this->form_validation->set_rules('ho_address1','Address Line 1','required');
			$this->form_validation->set_rules('ho_postalcode','Postal code','required');
			$this->form_validation->set_rules('ho_city','City','required');
			$this->form_validation->set_rules('ho_province_id','Provnce','required');
		}
		*/

		if($this->form_validation->run()==TRUE)
		{
			$totals = array();
					
			if($this->_update_delivery($this->session->userdata('cart_id'),$this->input->post()))
			{
				if($this->_update_billing($this->session->userdata('cart_id'),$this->input->post()))
				{
					$cart = $this->Order_model->get_fullcart($this->session->userdata('cart_id'));
					$order_items = '';
			                        	$oformat = file_get_contents('assets/email_items.html');

			                        	$aoformat = 
			                        	$itemformat = '';
			                        	$aitemformat = '';
		                        
		                       		$icnt = 0;
					$itemprc = 0;

					$this->load->model('Company_model');
					$this->load->model('Customer_model');

					$cartdiscount = 0;
					$cartcoupon = 0;
					$cartdiscounttype = 'percentage';
					$cartcoupontype = 'percentage';

					$conversion = '';
					$cartitems = array();
					$itemscount = count($cart);

					foreach($cart as $item)
					{
						//echo $this->input->post('card_message'.$item->orderitem_id);
						
						//OSCAR CODE
						//$this->Order_model->update_item_card_message($this->input->post('card_message'.$item->orderitem_id),$item->orderitem_id);
						//OSCAR CODE
					
						$itemprc = 0;
						$ptotal = $item->product_price;
				
                                				$icnt++;
                                
			                                	$itemf = $oformat;
			                                	$itemf = str_replace('{counter}',$icnt,$itemf);
			                                	$itemf = str_replace('{firstname}',$item->firstname,$itemf);
			                                	$itemf = str_replace('{lastname}',$item->lastname,$itemf);
								
						$itemf = str_replace('{location_type}',$item->location_type,$itemf);
						$itemf = str_replace('{location_type_name}',$item->location_type_name,$itemf);
								
			                                	$itemf = str_replace('{address1}',$item->address1,$itemf);
			                                	$itemf = str_replace('{address2}',$item->address2,$itemf);
			                                	$itemf = str_replace('{city}',$item->city,$itemf);
			                                	$itemf = str_replace('{postalcode}',$item->postalcode,$itemf);
			                                	$itemf = str_replace('{province}',$item->province,$itemf);
			                                	$itemf = str_replace('{country}',$item->country_id,$itemf);
			                                	$itemf = str_replace('{phone}',$item->dayphone.' '.$item->evephone,$itemf);
                                
                                				$itemf = str_replace('{message}',$item->card_message,$itemf);
						$itemf = str_replace('{special_note}',$item->ribbon_text,$itemf);
                                				$itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)).' - '.$item->delivery_time,$itemf);
									  
                                				$itemf = str_replace('{shipping_method}',$item->infotext,$itemf);
						$itemf = str_replace('{delivery_info}',$item->delivery_description,$itemf);

						
							if($item->option_picture==''){
								$itemf = str_replace('{product_image}','<img src="'.$this->config->item('base_url').img_format('productres/'.$item->product_picture, 'thumb').'" />',$itemf);
							}else{
								$itemf = str_replace('{product_image}','<img src="'.$this->config->item('base_url').img_format('productres/'.$item->option_picture, 'thumb').'" />',$itemf);
							}
						
                                				
                                				$itemf = str_replace('{product_code}',$item->product_code,$itemf);
						$itemf = str_replace('{orderitem_id}',$item->orderitem_id,$itemf);
						
						if($item->ribbon_text!=''){
							$itemf = str_replace('{product_name}',$item->product_name .' + Ribbon ($12.99)<br/><small>('.$item->price_name.')</small>',$itemf);
                        }else{
							$itemf = str_replace('{product_name}',$item->product_name .'<br/><small>('.$item->price_name.')</small>',$itemf);
                        }
						if($item->ribbon_text!=''){
							$itemf = str_replace('{price}','$'.number_format(($item->product_price+12.99),2),$itemf);
							$itemf = str_replace('{total}','$'.number_format(($item->product_price+12.99),2),$itemf);
                        }else{
							$itemf = str_replace('{price}','$'.number_format($item->product_price,2),$itemf);
							$itemf = str_replace('{total}','$'.number_format($item->product_price,2),$itemf);
                        }						
						//$itemf = str_replace('{product_name}',$item->product_name .'<br/><small>('.$item->price_name.')</small>',$itemf);
                        //$itemf = str_replace('{price}','$'.number_format($item->product_price,2),$itemf);
                        //$itemf = str_replace('{total}','$'.number_format($item->product_price,2),$itemf);

        				$itemf = str_replace('{quantity}','1',$itemf);
				
						$itemprc += $item->product_price;
				
						if($item->delivery_method_id==1)
						{
							$itemf = str_replace('{delivery_by}','Delivery by Local',$itemf);
						}
						else
						{
							$itemf = str_replace('{delivery_by}','This bouquet comes to via UPS.',$itemf);
						}
				
                                				
				
						if(array_key_exists($item->product_id,$cartitems))
						{
							$cartitems[$item->product_id]['sku'] = $item->product_code;
							$cartitems[$item->product_id]['qty'] = $cartitems[$item->product_id]['qty'] + 1;
							$cartitems[$item->product_id]['amt'] = $cartitems[$item->product_id]['amt'] + $item->product_price*100;
							$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
							$cartitems[$item->product_id]['category'] = urlencode($item->category);
						}
						else
						{
							$cartitems[$item->product_id]['sku'] = $item->product_code;
							$cartitems[$item->product_id]['qty'] = 1;
							$cartitems[$item->product_id]['amt'] = $item->product_price*100;
							$cartitems[$item->product_id]['name'] = urlencode($item->product_name);
							$cartitems[$item->product_id]['category'] = urlencode($item->category);
							
						}
                            
                                				$addontot = 0;
                                
				                          if(count($item->addons))
				                          {
							$order_items = '';
				   
                                    					foreach($item->addons as $addon)
                                    					{
								$order_items .= '+(' . $addon->addon_name ." ".$addon->addon_quantity.'x$'.number_format($addon->addon_price,2).")   $".number_format(($addon->addon_price*$addon->addon_quantity),2)."<br/>\n" ;
								$itemprc += ($addon->addon_price*$addon->addon_quantity);
								$addontot += ($addon->addon_price*$addon->addon_quantity);
								$ptotal += ($addon->addon_price*$addon->addon_quantity);
						
								if(array_key_exists($addon->addon_id,$cartitems))
								{
									$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
									$cartitems[$addon->addon_id]['qty'] = $cartitems[$addon->addon_id]['qty']+$addon->addon_quantity;
									$cartitems[$addon->addon_id]['amt'] = $cartitems[$addon->addon_id]['amt']+($addon->addon_price*100);
									$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
									$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
								}
								else
								{
									$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
									$cartitems[$addon->addon_id]['qty'] = $addon->addon_quantity;
									$cartitems[$addon->addon_id]['amt'] = ($addon->addon_price*100);
									$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
									$cartitems[$addon->addon_id]['category'] = urlencode($item->category);
								}										
					
								//echo $order_items;
				    			}

				                          }
			                                	else
			                                	{
			                                    		$order_items .= 'None';                                    
			                                	}
				
						$conversion .= 'bta.addConversionLegacy("$", "'.$item->product_name.'", "'.number_format($itemprc,2).'");'."\n";
				
                                				$itemf = str_replace('{addons}',$order_items,$itemf);
                                				$itemf = str_replace('{addon_price}','$'.number_format($addontot,2),$itemf);
				
						$addition = $this->Order_model->get_add_charges($item->orderitem_id);
				
						$totals['shipping'] += $addition['shipping'];
						$totals['service'] += $addition['service'];
						$totals['surcharge'] += $addition['surcharge'];
							
						if($cartcoupon>0)
						{
							if($cartcoupontype=='percentage')
							{
								$totals['coupon'] += ($cartcoupon * $ptotal) / 100;
								$ptotal -= ($cartcoupon * $ptotal) / 100;
								
							}
							else
							{
								$part = $cartcoupon / $itemscount;
								$totals['coupon'] += $part;
								$ptotal -= $part;
								
							}
						}
						else
						{
							if($cartdiscounttype=='percentage')
							{
								$totals['discount'] += ($cartdiscount * $ptotal) / 100;
								$ptotal -= ($cartdiscount * $ptotal) / 100;
								
							}
							else
							{
								$part = $cartdiscount / $itemscount;
								$totals['discount'] += $part;
								$ptotal -= $part;
								
							} 
						}
				
						$ptotal += $addition['shipping'];
						$ptotal += $addition['service'];
						$ptotal += $addition['surcharge'];

						$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
		                            
						$aitemformat .= str_replace('{product_description}','',$itemf);
						$itemf = str_replace('{product_description}',substr($item->product_description,0,50),$itemf);
						$itemformat .= $itemf;
					}
			
					$ggitems = '';
			
					foreach($cartitems as $citem)
					{
						$productids[] = $citem['sku'].':'.str_replace('+','',$citem['name']);
						$itemvalues[] = $citem['amt'];
						$units[] = $citem['qty'];
						$skulist[] = $citem['sku'];
						$qlist[] = $citem['qty'];
						$amtlist[] = $citem['amt'];
						$namelist[] = $citem['name'];
						
					}	
			
					if($totals['discount']>0)
					{
						$skulist[] = 'Discount';
						$qlist[] = 0;
						$amtlist[] = round($totals['discount']*(-100));
						$namelist[] = 'Discount';
						$productids[] = 'Discount';
						$itemvalues[] = round($totals['discount']*(100));
						$units[] = 1;
					}
					elseif($totals['coupon']>0)
					{
						$skulist[] = 'Discount';
						$qlist[] = 0;
						$amtlist[] = round($totals['coupon']*(-100));
						$namelist[] = 'Discount';
						$productids[] = 'Discount';
						$itemvalues[] = round($totals['coupon']*(100));
						$units[] = 1;
					}
					else
					{
						$productids[] = 'Discount';
						$itemvalues[] = 0;
						$units[] = 1;
					}
		                        
					
					$affid=$this->session->userdata('referer');

					if($affid!='') 
					{
						$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
					}
					else 
					{
						$totals['grandtotal'] = round($totals['itemtotal'],2) + round($totals['shipping'],2) + round($totals['service'],2) + round($totals['surcharge'],2) + round($totals['tax'],2) - round($totals['discount'],2) - round($totals['coupon'],2);
					}			
					
					//	$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);
					
					$invoiceTotal = number_format($totals['grandtotal'],2);

					$customer_id= $this->session->userdata('customer_id') ? $this->session->userdata('customer_id'):'0';
					$affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'';

					$eformat = file_get_contents('assets/email_format.html');
					$eheader = file_get_contents('assets/email_header.html');

					$result = $this->_pay($this->input->post(),$totals);



					$eheader = str_replace('{firstname}',$_POST['firstname'],$eheader);
					$eformat = str_replace('{firstname}',$_POST['firstname'],$eformat);
					$eformat = str_replace('{lastname}',$_POST['lastname'],$eformat);
					$eformat = str_replace('{address1}',$_POST['address1'],$eformat);
					$eformat = str_replace('{address2}',$_POST['address2'],$eformat);
					$eformat = str_replace('{city}',$_POST['city'],$eformat);
					$eformat = str_replace('{postalcode}',$_POST['postalcode'],$eformat);
					$eformat = str_replace('{country}',$_POST['country'],$eformat);
					$eformat = str_replace('{email}',$_POST['email'],$eformat);
					$eformat = str_replace('{dayphone}',$_POST['dayphone'],$eformat);
					$eformat = str_replace('{evephone}',$_POST['dayphone'],$eformat);
					$eformat = str_replace('{product_price}','$'.number_format($this->input->post('final_pricing'),2),$eformat);
					$eformat = str_replace('{delivery_charge}','$'.number_format($totals['shipping'],2),$eformat);
					$eformat = str_replace('{service_charge}','$'.number_format($this->input->post('final_service'),2),$eformat);
					$eformat = str_replace('{surcharge}','$'.number_format($totals['surcharge'],2),$eformat);
					$eformat = str_replace('{discount}','$'.number_format($totals['discount']-$totals['coupon']-$totals['companyless'],2),$eformat);

					$eformat = str_replace('{tax}','$'.number_format($this->input->post('final_tax'),2),$eformat);
					$eformat = str_replace('{grand_total}','$'.number_format(($this->input->post('final_pricing')+$this->input->post('final_service')+$this->input->post('final_tax')),2),$eformat);
					
					$eformat = str_replace('{affi_logo}',$this->session->userdata('logo'),$eformat);


					if($result['FinalStatus'] == 'success')
					{
					
						//OSCAR CODE
						$totals['itemtotal'] = $this->input->post('final_pricing');
						$totals['service'] = $this->input->post('final_service');
						$totals['shipping'] = 0;
						$totals['tax'] = $this->input->post('final_tax');
						//OSCAR CODE
						/*
						$totals = $totals[];
						$data['totals'] = $totals;
						*/
						if($oid = $this->Order_model->new_order($this->input->post(),$this->session->userdata('cart_id'),$totals,0))
						{
							$cart_id = $this->session->userdata('cart_id');
							$data['cart'] = $this->Order_model->get_cart($cart_id);
							$data['invoice_id'] = $oid;
		 					$this->db->where('cart_id',$cart_id);
		 					$this->db->update('carts',array('completed'=>'1'));
		 					$this->session->set_userdata('cart_id','0');
							$data['funeral_home_id'] = $this->input->post('fh_id');
							$data['funeral_home_description'] = $this->input->post('fh_location');
		 					$temptot = $totals['itemtotal'] - $totals['discount'] - $totals['coupon'];
							$gtemptot = $totals['itemtotal'];

							$linkimg = '<img src="http://track.linksynergy.com/ep?mid=37609&ord='.$oid;
							$linkimg .= '&skulist='.implode('|',$skulist);
							$linkimg .= '&qlist='.implode('|',$qlist);
							$linkimg .= '&amtlist='.implode('|',$amtlist);
							$linkimg .= '&cur=CAD';
							$linkimg .= '&namelist='.implode('|',$namelist).'">';
						
							$tsa = '<script src="https://thesearchagency.net/tsawaypoint.php?siteid=855&wayid=7685&';
							$tsa .= 'value='.round($totals['grandtotal']*100);
							$tsa .= '&units=1|'.implode('|',$units).'|1';
							$tsa .= '&productID=order|'.implode('|',$productids).'|Shipping';
							$tsa .= '&itemValues='.round($totals['grandtotal']*100).'|'.implode('|',$itemvalues).'|'.(($totals['shipping']+$totals['service']+$totals['surcharge'])*100);
							$tsa .= '&backref='.$oid.'" language="JavaScript" type="text/javascript"></script>';
						
							$emlimg = '<img src="http://email.memorialflowers.ca/public/?q=direct_add&fn=Public_DirectAddForm&id=bvvqnvtvffundtrubmhhrsjocigpbmg&email=';
							$emlimg .= $order->email.'&field1=lastorderdate,set,';
							$emlimg .= date('Y-m-d',time()).'&field2=lastordertotal,set,';
							$emlimg .= number_format($temptot,2).'&list1=0bba03ec00000000000000000000000492e6" width="0" height="0" border="0" alt=""/>';
							
							$ggtrans = 'pageTracker._addTrans(';
							$ggtrans .= '"'.$oid.'",';
							$ggtrans .= '"1-800-Flowers Canada",';
							$ggtrans .= '"'.$gtemptot.'",';
							$ggtrans .= '"'.number_format($totals['tax'],2).'",';
							$ggtrans .= '"'.number_format(($totals['shipping']+$totals['service']+$totals['surcharge']),2).'",';
							$ggtrans .= '"Toronto",';
							$ggtrans .= '"Ontario",';
							$ggtrans .= '"Canada");';
						
							$ggitems = '';
						
							foreach($cartitems as $citem)
							{
								
								$skulist[] = $citem['sku'];
								$qlist[] = $citem['qty'];
								$amtlist[] = $citem['amt'];
								$namelist[] = $citem['name'];
								
								$ggitems .= 'pageTracker._addItem(';
								$ggitems .= '"'.$oid.'",';
								$ggitems .= '"'.$citem['sku'].'",';
								$ggitems .= '"'.$citem['name'].'",';
								$ggitems .= '"'.$citem['category'].'",';
								$ggitems .= '"'.number_format(($citem['amt']/100),2).'",'.$citem['qty'];
								$ggitems .= ');'."\n";
								
							}
						
							$sconvtot = number_format($totals['grandtotal'],2); //$totals['itemtotal'] - $totals['discount'] - $totals['coupon'] + $totals['shipping'] + $totals['service'] + $totals['surcharge'] + $totals['tax'];
							
							$data['googlecode'] = $ggtrans . "\n\n" . $ggitems;
							$data['sconversion'] = '<img src="http://app.bronto.com/public/?q=stream_conversion&fn=Mail_Conversion&id=bvvqnvtvffundtrubmhhrsjocigpbmg&type=$&description=siteorder&money='.number_format($sconvtot,2).'" width="0" height="0" border="0" alt=""/>';
							
							
							$data['linkimg'] = $linkimg;
							$data['tsa'] = $tsa;
							$data['emlimg'] = $emlimg;
							$data['conversion'] = $conversion;
							$data['invoiceTotal'] = $invoiceTotal;
							
							$eformat = str_replace('{invoice_num}',$oid,$eformat);
							
							$admin_format = $eformat;
							$admin_format = str_replace('{items}',$aitemformat,$admin_format);
							$admin_format = str_replace('{email_header}','User Type:'.strtoupper($this->session->userdata('user_role')),$admin_format);
							
							$eformat = str_replace('{items}',$itemformat,$eformat);
							$eformat = str_replace('{email_header}',$eheader,$eformat);

							/*
							$this->load->library('email');
						
							$email_config['mailtype'] = 'html';
							$this->email->initialize($email_config);
							
							$this->email->from('orders@memorialflowers.ca', 'Dignity Flowers');
							$this->email->to($_POST['email']);
							$this->email->bcc('orabines@gmail.com');
							
							$this->email->subject('Dignity Flowers Order Confirmation');
							$this->email->message($eformat);
							
							if($this->email->send())
							{
								$success = true;
							}

							$this->email->from('orders@memorialflowers.ca', 'Dignity Flowers');
							$this->email->to('orabines@gmail.com');
							
							$this->email->subject('Dignity Flowers Order Confirmation');
							$this->email->message($admin_format);
							
							if($this->email->send())
							{
								$success = true;
							}
							*/
							
							
							
							$ema_order = $this->Order_model->get_email_order_info($oid);
							
							$ema_deli = $this->Order_model->get_delivery_order_info($ema_order->cart_id);
							
							$e_delivery = $this->Order_model->get_delivery_order_info_details($ema_order->cart_id);
							
							$to = $ema_order->email;
							//$to = 'orabines@gmail.com';
							$header = "From: orders@memorialflowers.ca \r\n";
							$header .= "Cc: jakki@memorialflowers.ca \r\n";
							$header .= "MIME-Version: 1.0\r\n";
							$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
							$subject = "Order Confirmation ".$ema_order->invoice_id." - Memorial Flowers";
							
							
							$message = '<html><body>';
							
							$message .= '
										<table width="100%" border="0" style="background-color:#F4F4F4;">
											<tr>
												<td width="30%">
												
												</td>
												<td width="40%" align="center" valign="top">
												
													<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;background-color:#fff;">
														<tr style="background-color:#fff;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="4" width="100%" align="center">
																
																	<img src="'.base_url().'templates/memorial/img/memlogo.png" width="157" height="62">

															</td>
														</tr>

														<tr style="background-color:#fff;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td rowspan="7" width="2%">
															
															</td>
															<td colspan="2" width="96%" style="padding-top:10px;">
																<span style="font-size:20px;">Thank You for your order.</span><br /><br />
																<span style="font-size:15px;">Your order has been received and is now being processed. Your order details are shown below for your reference.</span><br /><br />
																<span style="font-size:16px;"><b>Order Number: '.$ema_order->invoice_id.'</b></span><br />
																<span style="font-size:13px;">Order Placed on '.date("M j, Y h:i:s A", strtotime($ema_order->order_date)).'</span><br /><br />
															</td>
															<td rowspan="7" width="2%">
															
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:10px;padding-bottom:10px;">
																<span style="font-size:15px;"><b>Shipping Details</b></span><br />
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:5px;" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">
																	<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="2" width="100%" style="padding-top:5px;" valign="top">
																			'.$ema_deli->firstname.' '.$ema_deli->lastname.'<br />';
																			
																			if($ema_deli->location_type_name!=''){
																				$message .= $ema_deli->location_type_name.'<br />';
																			}
																	$message .= $ema_deli->address1.' '.$ema_deli->address2.'<br />
																			'.$ema_deli->city.', '.$ema_deli->province.' '.$ema_deli->postalcode.'<br />
																			'.$ema_deli->dayphone.'<br /><br />
																		</td>
																	</tr>';
																	
																	foreach($e_delivery as $ed){
																	
																	$message .= '<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td width="25%" style="padding-top:5px;" valign="top">
																			<img src="'.base_url().'productres/'.$ed->option_picture.'" width="85%">
																		</td>
																		<td width="75%" style="padding-top:5px;padding-left:10px;color:#757167;" valign="top">
																			<span style="font-weight:bold;font-size:14px;">'.$ed->product_name.'</span><br />
																			<b>Item ID: </b>'.$ed->orderitem_id.' | <b>Delivery Date: </b>'.date("M j, Y", strtotime($ed->delivery_date));
																			
																			if($ed->card_message!=''){
																	$message .= '<br /><br />
																			<b>Card Message</b><br />
																			'.$ed->card_message.'';
																			}
																			if($ed->ribbon_text!=''){
																			
																				$message .= '<br /><br />
																							<b>Ribbon Message</b><br />
																							'.$ed->ribbon_text.'';
																			
																			}
																			
																$message .= '</td>
																	</tr>';
																	
																	
																	}
																	
																	
																	
														$message .= '</table>
																
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:10px;padding-bottom:10px;">
																<span style="font-size:15px;"><b>Billing Details</b></span><br />
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:5px;" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">
																	<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td width="50%" style="padding-top:5px;" valign="top">
																			'.$ema_order->firstname.' '.$ema_order->lastname.'<br />
																			'.$ema_order->address1.' '.$ema_order->address2.'<br />
																			'.$ema_order->city.', '.$ema_order->province.' '.$ema_order->postalcode.'<br />
																			'.$ema_order->dayphone.'<br />
																			'.$ema_order->email.'
																			<br />
																		</td>
																		<td width="50%" style="padding-top:5px;" valign="top">
																			<b>Payment Type</b><br />
																			'.$ema_order->cardtype.': xxxx xxxx xxxx '.substr($ema_order->cardnumber,-4).'
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
														<tr style="background-color:#F4F4F4;color:#757167;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:10px;padding-bottom:10px;">
															
																<table width="100%" border="0" style="font-family:Tahoma, Geneva, sans-serif;">
																	<tr style="color:#757167;font-size:13px;">
																		<td width="45%" style="padding-top:5px;" valign="top">
																			<span style="font-size:11px;"><b>Product Name</b></span><br />
																		</td>
																		<td width="23%" style="padding-top:5px;" align="center" valign="top">
																			<span style="font-size:11px;"><b>Price</b></span><br />
																		</td>
																		<td width="10%" style="padding-top:5px;" align="center" valign="top">
																			<span style="font-size:11px;"><b>Qty</b></span><br />
																		</td>
																		<td width="22%" style="padding-top:5px;" align="right" valign="top">
																			<span style="font-size:11px;"><b>Subtotal</b></span><br />
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
														<tr style="background-color:#fff;color:#757167;font-size:12px;font-family:Tahoma, Geneva, sans-serif;">
															<td colspan="2" width="96%" style="padding-top:5px;" valign="top">
																
																<table width="100%" style="font-family:Tahoma, Geneva, sans-serif;">';
																
																	foreach($e_delivery as $ed){
																	
																		$message .= '<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																						<td width="45%" style="padding-top:5px;" valign="middle">
																							<span style="font-weight:bold;font-size:13px;">'.$ed->product_name.'';
																							
																							$rt = 0;
																							if($ed->ribbon_text!=''){
																								$rt = $ed->product_price+12.99;
																								$message .= '<span style="color:#757167;"> + Ribbon (C$ 12.99)</span>';
																							
																							}else{
																								$rt = $ed->product_price;
																							}
																							
																					$message .= '</span><br />	
																						</td>
																						<td width="23%" style="padding-top:5px;" valign="middle" align="center">
																							C$ '.$rt.'<br />	
																						</td>
																						<td width="10%" style="padding-top:5px;" valign="middle" align="center">
																							1<br />	
																						</td>
																						<td width="22%" style="padding-top:5px;" valign="middle" align="right">
																							C$ '.$rt.'<br />	
																						</td>
																					</tr>';
																	
																	}
																	
														$message .= '<tr style="background-color:#fff;color:#757167;font-size:13px;height:20px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="4" style="padding-top:5px;" valign="middle" align="right">
																				
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Sub-Total	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->amount.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Shipping	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->service.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#fff;color:#757167;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			Taxes	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			C$ '.$ema_order->tax.'<br />	
																		</td>
																	</tr>
																	<tr style="background-color:#F4F4F4;color:#757167;font-size:13px;height:35px;vertical-align:middle;font-family:Tahoma, Geneva, sans-serif;">
																		<td colspan="3" style="padding-top:5px;" valign="middle" align="right">
																			<b>Total</b>	
																		</td>
																		<td style="padding-top:5px;" valign="middle" align="right">
																			<b>C$ '.number_format(($ema_order->amount+$ema_order->service+$ema_order->tax),2).'</b><br />	
																		</td>
																	</tr>
																</table>
																
															</td>
														</tr>
													</table>
												
													
												</td>
												<td width="30%">
												
												</td>
											</tr>
											<tr>
												<td>
												
												</td>
												<td align="center" style="font-family:Tahoma, Geneva, sans-serif;color:#757167;font-size:10px;">
													<br /><br />
													<small>
														<b>
															This website and floral service is provided by Memorial Flowers, a division of 1882540 Ontario, which holds trademark rights in the Memorial Flowers brand and logo and in the copyright holder (&copy; 2015) in the Memorial Flowers content.
														</b>
													</small>
													
												</td>
												<td>
												
												</td>
											</tr>
										</table>
							
							
							
										';
							
							
							
							$message .= '</body></html>';

							
							$retval = mail($to,$subject,$message,$header);
							if($retval==true)  
							{
							
							}
							else
							{
							
							}
							
							
							
							
							
							
							
							
							
							
							

		 					$purchase = TRUE;
		 					$this->load->view('thankyou',$data);
						}
					}
					else
					{
						$elist = '<ul class="elist">';
						if($cerrors = explode('|',$result['MErrMsg']))
						{
							foreach($cerrors as $ce)
							{
								if(!empty($ce))
								{
									$elist .= '<li>'.$ce.'</li>';
								}
							}
						}
						else
						{
							$elist .= '<li>'.$result['MErrMsg'].'<li>';
						}
						$elist .= '</ul>';
						$elist = '<div class="show_errors"><h3>'.'Error in Payment'.'</h3>'.$elist.'</div>';
						$data['errors'] = $elist;
					}
				}
				else
				{
					$data['errors'] = '<div class="show_errors">Unable to create billing information. Please contact website administrator!</div>';
				}
			}
			else
			{
				$data['errors'] = '<div class="show_errors">Unable to create shipping information. Please contact website administrator!</div>';
			}
		}
		
		if(!$purchase)
		{
			if($_POST) { $data['vars'] = (object) $_POST; }
			$data['provinces'] = $this->Province_model->get_provinces_new(1);
			$this->load->view('checkout',$data);
		}

	}

	function _update_delivery($cart,$vars)
	{
		return $this->Order_model->update_delivery_address($cart,$vars);
	}

	function _update_billing($cart,$vars)
	{
		return $this->Order_model->update_billing_address($cart,$vars);
	}

	function _pay($vars,$totals)
	{
		
		$final_val = $vars['final_pricing']+$vars['final_service']+$vars['final_tax'];
		
		$order->nameoncard = $vars['nameoncard'];
		$order->cardnumber = $vars['card_number'];
		$order->cvv = $vars['cvv'];
		$order->expiry = $vars['exp_month'].'/'.$vars['exp_year'];
		//$order->total = $totals['grandtotal'];
		$order->total = $final_val;
		$order->ipaddress = $_SERVER['REMOTE_ADDR'];	
		$order->affiliate_id = 0;  
		$order->email = $vars['email'];
		$order->address1 = $vars['address1'];
		$order->address2 = $vars['address2'];
		$order->postalcode = $vars['postalcode'];
		$order->city = $vars['city'];
		$order->province = 'Ontario';
		$order->country = 'Canada';
		$this->load->library('plugnpay');
		$result = $this->plugnpay->pay($order);

		//$result['FinalStatus'] = 'success';

		return $result;
	}

	function send_confirmation()
	{

	}

	
	function new_postalcode() {
	
	//use_ssl(FALSE);
	
	$pc=$this->input->post('postalcode_error');
	$cit=$this->input->post('city_error');
	$prov=$this->input->post('province_error');
	//$cit=$this->input->post('city_error');
	$ci_id = 0;
	//$pc=$this->input->post('province_error');
	//$pc=$this->input->post('country_error');
	
	$pc = strtoupper($pc);
	
	$str = substr($pc, 0, 3) . ' ' . substr($pc, 3, 3);
	
	//echo $pc;
	//$this->load->model('Postalcode_model');
	$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
				
	
	$result = mysqli_query($con,"select * from cities where city_name='".$cit."' and province_id>=1 and province_id<=13");
					
					while($row = mysqli_fetch_array($result)){
						$ci_id = $row['city_id'];
					}
		
		
		mysqli_query($con,"insert into postalcodes (city_id, postalcode) values (".$ci_id.", '".$str."')");		
		
		
		
		
		$from = 'pc_wab@gmail.com';

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: <orabines@memorialflowers.ca>";
$headers[] = "Reply-To: Postal Codes <pc_wab@gmail.com>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();

$subject2 = "Postal Code Memorial Flowers"; 

$autoreply = 'New Postal Code: '.$str.'
City: '.$cit.'
Province: '.$prov.'
Country: Canada';


 
 
 
 $send2 = mail($from, $subject2, $autoreply, implode("\r\n", $headers)); 
 if($send2) 
 {//header( "Location: http://www.cibcmortgagecareers.com/apply-now/thank-you" );
 } 
 else 
 {//print "We encountered an error sending your mail, please notify info@cibcmortgagecareers.com ... Sorry for the inconvenients ..."; 
 } 
		
		
		
		
	redirect('/shop/delivery');	
	
	}
	
	
	
	function getlocationinfo()
	{
		
		if(isset($_POST) && isset($_POST['postalcode']))
		{
			$this->load->model('Postalcode_model');
			$loc = $this->Postalcode_model->get_info($this->input->post('postalcode'));
			
			if(count($loc))
			{
				$location = array('result'=>'ok','city'=>$loc->city_name,'province'=>$loc->province_id,'country'=>$loc->country_id);
				echo json_encode($location);
			}
			else
			{
				/*$message = '<div class="themessage"><p style="color: red;">Please enter a valid Canadian postal code. <a href="http://www.canadapost.ca/cpotools/apps/fpc/personal/findByCity?execution=e2s1">Click here</a> if you do not have one.</p><p>If you would like to ship outside of Canada please visit our <a href="http://ww31.1800flowers.com/international-flower-delivery">sister site</a></p></div>';
				echo json_encode(array('result'=>'failed','message'=>$message));*/
				
				
				$message = '<div style="padding: 10px 10px 10px 50px; height:150px;">';
				//$message .= '<p style="color: red;">Please enter a valid Canadian postal code. <a href="http://www.canadapost.ca/cpotools/apps/fpc/personal/findByCity?execution=e2s1" target="_blank">Click here</a> if you do not have one.</p>';
				$message .= '<p style="color: red;">Please validate your Canadian postal code. <a href="http://www.canadapost.ca/cpotools/apps/fpc/personal/findByCity?execution=e2s1" target="_blank">Click here</a> and fill the following form:</p>';
				
				$message .= '<br /><form method="post" action="http://new.memorialflowers.ca/shop/new_postalcode"><div style="margin-left:40px;"><table>';
								
				$message .= '<tr><td>Postal Code:</td><td><input type="text" name="postalcode_error" onkeyup="countCharp(this)" id="postalcode_error">e.i. <span style="color:#5E2D79;">A1A 2B2</span></td></tr>';
				$message .= '<tr><td>City:</td><td><input type="text" name="city_error" id="city_error">e.i. <span style="color:#5E2D79;">My City</span></td></tr>';
				$message .= '<tr><td>Province:</td><td>
				
				<select name="province_error" id="province_error" style="width:153px; margin-left:2px;">
                                <option value="" selected="selected">Please select</option>
                                                                            <option value="Alberta" >Alberta</option>
                                                                            <option value="British columbia " >British columbia </option>
                                                                            <option value="Manitoba" >Manitoba</option>
                                                                            <option value="New Brunswick" >New Brunswick</option>
                                                                            <option value="Newfoundland" >Newfoundland</option>
                                                                            <option value="Northwest Territories" >Northwest Territories</option>
                                                                            <option value="Nova Scotia" >Nova Scotia</option>
                                                                            <option value="Nunavut" >Nunavut</option>
                                                                            <option value="Ontario" >Ontario</option>
                                                                            <option value="Prince Edward Island" >Prince Edward Island</option>
                                                                            <option value="Quebec" >Quebec</option>
                                                                            <option value="Saskatchewan" >Saskatchewan</option>
                                                                            <option value="Yukon" >Yukon</option>
                                                                    </select> 
				
				</td></tr>';
				$message .= '<tr><td>Country:</td><td><input type="text" name="country_error" id="country_error" value="Canada" disabled=disabled>
				<input type="submit" name="new" id="new" value="Continue" class="submitbt" />
                    
				</td></tr>';
				
				$message .= '</table></div></form><br />';
				
				$message .= '<p>If you would like to ship outside of Canada please visit our <a href="http://ww31.1800flowers.com/international-flower-delivery" target="_blank">sister site</a></p></div>';
				echo json_encode(array('result'=>'failed','message'=>$message));
				
				
			}
		}
		else
		{
			return json_encode(array('result'=>'failed','message'=>$message));
		}
		
	}
	
	function test()
	{
		echo date('d-m-Y H:i:s',time());
		echo '<br/>----------';
		//echo showCalendar(2,25);
	}
	
	function add_last_visited($id)
	{
		$pieces = explode("_", $id);
		
		$session_id = $pieces[0];
		$product_id = $pieces[1];
		
		$val = $this->Order_model->insert_similar_product($session_id,$product_id); 
	
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
