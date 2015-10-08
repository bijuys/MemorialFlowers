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
		use_ssl(TRUE);
		
		$data['cart'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));

		if($_POST && $_POST['coupon_submit']=='Apply')
		{
			
			$this->form_validation->set_rules("coupon",'Coupon code','alpha_numeric');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			
			if ($this->form_validation->run() == TRUE)
			{
				$tcart = get_tiny_cart();
				
				if($coupon = get_coupon_discount($_POST['coupon'],$tcart->total))
				{
					
					$this->session->set_userdata('coupon',$_POST['coupon']);
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
		
		$this->load->view('shopping_cart.php',$data);
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
		
            if(is_numeric($custid) && $guest=='yes')
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
		use_ssl(TRUE);
		
                if(!$this->checkUser())
		{
			redirect('/shop/login');
			
		}
                    
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
				$this->form_validation->set_rules("postalcode[{$row}]", 'Postal Code','required|callback_postalcode_check['.$row.']');
				$this->form_validation->set_message('callback_postalcode_check[postalcode]', 'Invalid Postalcode!');
				$this->form_validation->set_rules("city[{$row}]", 'City','required|min_length[1]|max_length[30]');
				$this->form_validation->set_rules("province[{$row}]", 'Province','required|min_length[4]|max_length[30]');
				$this->form_validation->set_rules("country_id[{$row}]", 'Country','required');
				$this->form_validation->set_rules("dayphone[{$row}]",'Day Phone','required|min_length[5]|max_length[15]');
				$this->form_validation->set_rules("evephone[{$row}]", 'Evening Phone','min_length[0]|max_length[15]');
				$this->form_validation->set_rules("card_message[{$row}]", 'Card Message','callback_cardmessage_check['.$row.']');
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
			
			$this->load->View('delivery',$data);							
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
		
		use_ssl(TRUE);
						
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
			$this->form_validation->set_rules("country_id", 'Country','required|min_length[1]');
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
					'grandtotal'=>0);
			
			$coupon_discount = 0;
			
			$this->load->model('Company_model');
			$this->load->model('Customer_model');
			
			foreach($cart as $item)
			{
				$totals['itemtotal'] += $item->product_price;
				$ptotal = $item->product_price;
				
				foreach($item->addons as $addon)
				{
					$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
					$ptotal += ($addon->addon_price*$addon->addon_quantity);
				}

				
				
				$addition = $this->Order_model->get_add_charges($item->orderitem_id);

				//$addition = $this->Group_model->get_add_charges($item->product_id,$item->postalcode);
				
				if(!$waiver = $this->Company_model->checkWaiver($this->session->userdata('customer_id')))
				{
					$totals['shipping'] += $addition['shipping'];
					$totals['service'] += $addition['service'];
					$totals['surcharge'] += $addition['surcharge'];
				}

				$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
				
			}
			
			if($user_discount=$this->Customer_model->getDiscount($this->session->userdata('customer_id')))
			{
				$totals['discount'] = ($totals['itemtotal'] * $user_discount) / 100;
				
			}
			else
			{
				
				if($this->session->userdata('coupon'))
				{
					$coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']);
					
					$totals['coupon_code'] = $coupon->discount_name;
					$totals['coupon'] = $coupon->discount_amount ? $coupon->discount_amount: $coupon->discount_percentage * $totals['itemtotal'] / 100;
				}
				
				$totals['discount'] += get_discount($totals['itemtotal']);
				
			}
			
			$totals['grandtotal'] = $totals['itemtotal'] + $totals['shipping'] + $totals['service'] + $totals['surcharge'] + $totals['tax'] - $totals['discount'] - $totals['coupon'];
			
			
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
			$affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'';
			
			if(isset($_POST['create_account']) && $_POST['create_account']==1)
			{
				$this->load->model('Customer_model');
				$customer_id = $this->Customer_model->signup($this->input->post(),$affiliate_id);
				$this->autoLogin($customer_id);
			}
			
			$this->Order_model->update_Billing($cart_id,$this->input->post());
			redirect('shop/checkout');
			exit;				
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
	
	function checkout()
	{
		use_ssl(TRUE);
		
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
			
			$conversion = '';
			
			$cartitems = array();
                                                                        		
			foreach($cart as $item)
			{
				$itemprc = 0;
				$ptotal = $item->product_price;
				
                                $icnt++;
                                
                                $itemf = $oformat;
                                $itemf = str_replace('{counter}',$icnt,$itemf);
                                $itemf = str_replace('{firstname}',$item->firstname,$itemf);
                                $itemf = str_replace('{lastname}',$item->lastname,$itemf);
                                $itemf = str_replace('{address1}',$item->address1,$itemf);
                                $itemf = str_replace('{address2}',$item->address2,$itemf);
                                $itemf = str_replace('{city}',$item->city,$itemf);
                                $itemf = str_replace('{postalcode}',$item->postalcode,$itemf);
                                $itemf = str_replace('{province}',$item->province,$itemf);
                                $itemf = str_replace('{country}',$item->country_id,$itemf);
                                $itemf = str_replace('{phone}',$item->dayphone.' '.$item->evephone,$itemf);
                                
                                $itemf = str_replace('{message}',$item->card_message,$itemf);
                               // $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)),$itemf);
							   $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)).' - '.$item->delivery_time,$itemf);

                                $itemf = str_replace('{shipping_method}',$item->infotext,$itemf);
				$itemf = str_replace('{delivery_info}',$item->delivery_description,$itemf);

                                $itemf = str_replace('{product_image}','<img src="'.$this->config->item('base_url').img_format('productres/'.$item->product_picture, 'thumb').'" />',$itemf);
                                $itemf = str_replace('{product_code}',$item->product_code,$itemf);
				
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
				
				$totals['itemtotal'] += $item->product_price;
				
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
						$totals['itemtotal'] += ($addon->addon_price*$addon->addon_quantity);
						$itemprc += ($addon->addon_price*$addon->addon_quantity);
						$addontot += ($addon->addon_price*$addon->addon_quantity);
						$ptotal += ($addon->addon_price*$addon->addon_quantity);
						
						if(array_key_exists($addon->addon_id,$cartitems))
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $cartitems[$addon->addon_id]['qty']+$addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = $cartitems[$addon->addon_id]['amt']+($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$item->product_id]['category'] = urlencode($item->category);
						}
						else
						{
							$cartitems[$addon->addon_id]['sku'] = $addon->addon_id;
							$cartitems[$addon->addon_id]['qty'] = $addon->addon_quantity;
							$cartitems[$addon->addon_id]['amt'] = ($addon->addon_price*100);
							$cartitems[$addon->addon_id]['name'] = urlencode($addon->addon_name);
							$cartitems[$item->product_id]['category'] = urlencode($item->category);
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
				
				if(!$waiver = $this->Company_model->checkWaiver($this->session->userdata('customer_id')))
				{
					$totals['shipping'] += $addition['shipping'];
					$totals['service'] += $addition['service'];
					$totals['surcharge'] += $addition['surcharge'];
				}
				
				$totals['tax'] += ($addition['tax'] * $ptotal) / 100 ;
                            
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
			
			
			$coupon_discount = 0;
			
			if($user_discount=$this->Customer_model->getDiscount($this->session->userdata('customer_id')))
			{
				$totals['discount'] = ($totals['itemtotal'] * $user_discount) / 100;
			}
			else
			{
				if($this->session->userdata('coupon'))
				{
					$coupon = get_coupon_discount($this->session->userdata('coupon'),$totals['itemtotal']);
		
					$totals['coupon_code'] = $coupon->discount_name;
					$totals['coupon'] = $coupon->discount_amount ? $coupon->discount_amount: $coupon->discount_percentage * $totals['itemtotal'] / 100;
				}
				
				$totals['discount'] = get_discount($totals['itemtotal']);
				$totals['companyless'] = get_company_discount($totals['itemtotal'],$this->session->userdata('customer_id') ? $this->session->userdata('customer_id'):'0');
			}
			
			if($totals['discount']>0)
			{
				$skulist[] = 'Discount';
				$qlist[] = 0;
				$amtlist[] = ($totals['discount']*(-100));
				$namelist[] = 'Discount';
				$productids[] = 'Discount';
				$itemvalues[] = round($totals['discount']*(100));
				$units[] = 1;
			}
			else
			{
				$productids[] = 'Discount';
				$itemvalues[] = 0;
				$units[] = 1;
			}
                        
			$totals['grandtotal'] = $totals['itemtotal'] + $totals['shipping'] + $totals['service'] + $totals['surcharge'] + $totals['tax'] - $totals['discount'] - $totals['coupon'] - $totals['companyless'];
			
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
				$eformat = file_get_contents('assets/email_format.html');
				$eheader = file_get_contents('assets/email_header.html');
			
				$this->load->library('plugnpay');
				$order = unserialize(base64_decode($_POST['data']));
				
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


				if($_SERVER['REMOTE_ADDR']=='127.0.0.1' && ENVIRONMENT=='development')
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
					
					$payment_method = 'credit_card';
				}
				
				
				if($result['FinalStatus']=='success')
				{
				     
					if($oid = $this->Order_model->create_Order($this->session->userdata('cart_id'),$totals,$customer_id,$affiliate_id,$payment_method))
					{
						
						//﻿$linkimg  = '<img src="http://track.linksynergy.com/
						// ep?mid=xxxx&ord=xx&skulist=xxxx
						// &qlist=xxx&amtlist=xxxx&cur=xxx&namelist=xxxxx">';
						
						$cart_id = $this->session->userdata('cart_id');
						
						$this->db->where('cart_id',$cart_id);
						$this->db->update('carts',array('completed'=>'1'));
								
						$this->session->set_userdata('cart_id','0');
						
						$temptot = $totals['itemtotal'] - $totals['discount'] - $totals['coupon'];

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
						
						$emlimg = '<img src="http://email.1800florists.ca/public/?q=direct_add&fn=Public_DirectAddForm&id=bvvqnvtvffundtrubmhhrsjocigpbmg&email=';
						$emlimg .= $order->email.'&field1=lastorderdate,set,';
						$emlimg .= date('Y-m-d',time()).'&field2=lastordertotal,set,';
						$emlimg .= number_format($temptot,2).'&list1=0bba03ec00000000000000000000000492e6" width="0" height="0" border="0" alt=""/>';
						
						$ggtrans = 'pageTracker._addTrans(';
						$ggtrans .= '"'.$oid.'",';
						$ggtrans .= '"1-800-Flowers Canada",';
						$ggtrans .= '"'.$temptot.'",';
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
							$ggitems .= '"'.number_format(($citem['amt']/100),2).'",1';
							$ggitems .= ');'."\n";
							
						}
						
						$data['googlecode'] = $ggtrans . "\n\n" . $ggitems;
						
						
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
						
						$this->email->from('orders@1800florists.ca', '1-800-Flowers');
						//$this->email->to($order->email);
						$this->email->to($order->email);
						
						$this->email->subject('1-800-Flowers Order Confirmation');
						$this->email->message($eformat);
						
						if($this->email->send())
						{
							$success = true;
						}

						$this->email->from('orders@1800florists.ca', '1-800-Flowers');
						$this->email->to('sales@1800florists.ca');
						
						$this->email->subject('1-800-Flowers Order Confirmation');
						$this->email->message($admin_format);
						
						
						if($this->email->send())
						{
							$success = true;
						}
					
						$this->unset_cart();
						
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
			$this->load->View('checkout',$data);

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
		$this->session->unset_userdata('coupon');

	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
