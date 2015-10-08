<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('affiliate_login')) { redirect(base_url().'mymemorial/sessions/login'); }
		$this->load->model('Product_model');
		$this->load->model('Order_model');
		$this->load->library('cart');
		$this->load->library('Form_validation');
	}
	
	function trans()
	{
		$this->lang->load('french','french');
	}
	
	function index()
	{
		redirect(base_url().'mymemorial/orders/browse');
		exit;
	}
	
	
	public function browse()
	{

		/*
		$this->load->library("pagination");
		
		$config = array();
		$config["base_url"] = base_url() . "mymemorial/orders/browse";
		$config["total_rows"] = $this->Order_model->getAffiliateOrdersCount($this->session->userdata('affiliate_id'),$this->input->post(NULL,TRUE));
		$config["per_page"] =25;
		$config["uri_segment"] = 4;
		
	
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		
		$data['totalpages'] = $config['total_rows'];
		
		*/

		$data['orders'] = $this->Order_model->get_affiliate_orders($this->session->userdata('affiliate_id'),$this->input->post(NULL,TRUE));
		
		$data['pagename'] = 'my_orders';
		$this->load->view('mymemorial/orders',$data);
	}
	
	public function show($id)
	{
		$data['order'] = $this->Order_model->get_order($id);
		$this->load->view('mymemorial/order-view',$data);
	}
	
	public function printview($id)
	{
		$data['order'] = $this->Order_model->get_order($id);
		$this->load->view('mymemorial/print-view',$data);
	}
	
	
	public function search()
	{		
		$data['orders'] = $this->Order_model->getOrderItems($this->session->userdata('affiliate_id'),$this->input->post(NULL,TRUE));
		$data['page'] = 'My Orders';
		$data['pagename'] = 'search_results';
		$this->load->view('orderslist',$data);
	}
	
	public function itemdelivery()
	{
		$this->load->model('Occasion_model');
		$data['occasions'] = $this->Occasion_model->get_occasions();
		$data['cartitems'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		
		$html = $this->load->view('mymemorial/delivery-details',$data,TRUE);
		
		$output = json_encode(array('html'=>$html,'count'=>count($data['cartitems'])));
		
		echo $output;
	}
	
	public function updatedelivery()
	{
		$cart = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		
		if($this->Order_model->updateMyOrder($cart,$_POST))
		{
			echo 'success';
		}
	}	
	
	
	public function myorders()
	{

	}
	
	public function widget_cart()
	{
		$this->load->view('widget_cart');
	}
	
	public function submit()
	{
		
		$cart_id = $this->session->userdata('cart_id');
		
		if($this->Order_model->is_cart_empty($cart_id))
		{
			die('Cart is empty!');
		}
		elseif(!$this->Order_model->is_delivery_entered($cart_id))
		{
			die('Invalid Use! Delivery is not entered');
		}
		elseif(!$this->Order_model->is_billing_entered($cart_id))
		{
			die('Invalid Use! Billing info not entered');
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
		
			$this->load->model('Affiliate_model');
			
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
			$cartitems = array();			
			$itemscount = count($cart);                                                                        		
			foreach($cart as $item)
			{
				
				$ptotal = $item->product_price;
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
                            
			}	
			
                        
			
			$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);
			
			$invoiceTotal = number_format($totals['grandtotal'],2);

			$customer_id= $this->session->userdata('affiliate_id');
			$affiliate_id = $this->session->userdata('affiliate_id');
			
			$aff = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));
			
			$this->form_validation->set_rules("cc", 'Credit Card Number','required|numeric|min_length[15]|max_length[16]');
			$this->form_validation->set_rules("cmonth", 'Expiry Month','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("cyear", 'Expiry Year','required|min_length[2]|max_length[5]');
			$this->form_validation->set_rules("cvv", 'CVV2','required|min_length[3]|max_length[5]');
			$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');
			
			if ($this->form_validation->run() == TRUE || $aff->customer_onaccount==1)
			{			
				$this->load->library('plugnpay');
				$order = (object) $_POST;
				
				$this->load->model('Country_model');
				
				$country = $this->Country_model->get_country($order->country_id);
				
				$order->country = $country->country_name;
				$order->ipaddress = $_SERVER['REMOTE_ADDR'];
				$order->nameoncard = $this->input->post('payeename');
				$order->cardnumber = $this->input->post('cc');
				$order->cvv = $this->input->post('cvv');
				$order->expiry = $this->input->post('cmonth').'/'.$this->input->post('cyear');
				$order->total = $totals['grandtotal'];
				$order->affiliate_id = $this->session->userdata('affiliate_id');
				$order->email = $aff->user_email;
				$order->address1 = $aff->user_address1;
				$order->address2 = $aff->user_address2;
				
				if($aff->customer_onaccount!=1)
				{
					if($_SERVER['REMOTE_ADDR']=='127.0.0.1' && ENVIRONMENT=='development')
					{
						//$result = $this->plugnpay->pay($order);			
						$result['FinalStatus']='success';
						$payment_method = 'credit_card';
					}
					else
					{
						$result = $this->plugnpay->pay($order);					
						$payment_method = 'credit_card';
					}
				}
				else
				{
					$result['FinalStatus']='success';
					$payment_method = 'on_account';
				}
				
				
				
				if($result['FinalStatus']=='success')
				{
				     
					if($oid = $this->Order_model->create_Order($this->session->userdata('cart_id'),$totals,$customer_id,$affiliate_id,$payment_method))
					{
						
						$cart_id = $this->session->userdata('cart_id');
						
	 					$this->db->where('cart_id',$cart_id);
	 					$this->db->update('carts',array('completed'=>'1'));
								
	 					$this->session->set_userdata('cart_id','0');	
						
							
						//$this->unset_cart();
						
						$data['items'] = $this->Order_model->getDelivery($cart_id);
						$data['message'] = 'Your order completed successfully';
						$data['invoice_number'] = $oid;
						$data['totals'] = $totals;
						$data['billing'] = $this->Order_model->getBilling($cart_id);
						
						
						
						
						
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
                                $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)),$itemf);

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

				//$totals['tax'] += ($addition['tax'] * $ptotal) / 100;
                            
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
			
					
						
						
						
						
						
						
						
						
						
					/*$addition = $this->Order_model->get_add_charges($item->orderitem_id);
				
				$totals['shipping'] += $addition['shipping'];
				$totals['service'] += $addition['service'];
				$totals['surcharge'] += $addition['surcharge'];	*/
						
						
						
						
						
						
						
												
							//email code
						$eformat = file_get_contents('assets/ff_email_format.html');
				    $eheader = file_get_contents('assets/ff_email_header.html');	
							
							
				$this->load->library('plugnpay');
				//$order = unserialize(base64_decode($_POST['data']));
				
				//$country = $this->Country_model->get_country($order->country_id);
				
				//$gci=$this->session->userdata('cart_id');
				
				
				//$bil = $this->Order_model->getBilling2($this->session->userdata('cart_id')); //$this->Order_model->get_add_charges($item->orderitem_id);
				
				$country = $this->Country_model->get_country($order->country_id);
				$order2->country = $country->country_name;
				
				$billi = $this->Order_model->getBilling2($this->session->userdata('affiliate_id'));
				$order2->firstname = $billi->user_firstname;
				$order2->lastname = $billi->user_lastname;
				$order2->address1 = $billi->user_address1;
				$order2->address2 = $billi->user_address2;
				$order2->postalcode = $billi->user_postalcode;
				$order2->city = $billi->user_city;
				$order2->email = $billi->user_email;
				
				$inf_oscar = $billi->user_firstname;
				
				
							
				$g_total=$totals['itemtotal']+$totals['tax'];
				
				$order->affiliate_id = $this->session->userdata('referer') ? $this->session->userdata('referer'):'0';               
				$aff_phone='';
				/*if($order->dayphone!='')
				{
					$aff_phone=$order->dayphone;
				}*/
				
				
				
				$eheader = str_replace('{firstname}',$order->firstname,$eheader);
				$eformat = str_replace('{firstname}',$order2->firstname,$eformat);
				$eheader = str_replace('{lastname}',$order->lastname,$eheader);
				$eformat = str_replace('{lastname}',$order2->lastname,$eformat);
				$eformat = str_replace('{address1}',$order2->address1,$eformat);
				$eformat = str_replace('{address2}',$order2->address2,$eformat);
				$eformat = str_replace('{city}',$order2->city,$eformat);
				$eformat = str_replace('{postalcode}',$order2->postalcode,$eformat);
				$eformat = str_replace('{country}',$order2->country,$eformat);
				$eformat = str_replace('{email}',$order2->email,$eformat);
				
				
				
				
				/*$eformat = str_replace('{dayphone}',$order->user_phone1,$eformat);
				$eformat = str_replace('{evephone}',$order->user_phone2,$eformat);*/
				$eformat = str_replace('{product_price}','$'.number_format($totals['itemtotal'],2),$eformat);
				/*$eformat = str_replace('{delivery_charge}','$'.number_format($totals['shipping'],2),$eformat);
				$eformat = str_replace('{service_charge}','$'.number_format($totals['service'],2),$eformat);
				$eformat = str_replace('{surcharge}','$'.number_format($totals['surcharge'],2),$eformat);
				$eformat = str_replace('{discount}','$'.number_format($totals['discount']-$totals['coupon']-$totals['companyless'],2),$eformat);*/

				$eformat = str_replace('{tax}','$'.number_format($totals['tax'],2),$eformat);
				//$eformat = str_replace('{grand_total}','$'.number_format($totals['grandtotal'],2),$eformat);
				$eformat = str_replace('{grand_total}','$'.number_format($g_total,2),$eformat);
			//	$eformat = str_replace('{affi_logo}',$this->session->userdata('logo'),$eformat);
							
							
					
						
						$eformat = str_replace('{invoice_num}',$oid,$eformat);
						$admin_format = $eformat;
						$admin_format = str_replace('{items}',$aitemformat,$admin_format);
						
						
						$admin_format = str_replace('{email_header}','Dear :'.strtoupper($this->session->userdata('user_role')),$admin_format);
						
						$eformat = str_replace('{items}',$itemformat,$eformat);
						$eformat = str_replace('{email_header}',$eheader,$eformat);
						
						$eformat = str_replace('{invoice_num}',$oid,$eformat);
						//$session['firstname']
						
						$eformat = str_replace('{items}',$itemformat,$eformat);
						$eformat = str_replace('{email_header}',$eheader,$eformat);
						
						$this->load->library('email');
						
						$email_config['mailtype'] = 'html';
						$this->email->initialize($email_config);
						
						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						//$this->email->to($order->email);
						$this->email->to($order->email);
						//$this->email->bcc('orders@memorialflowers.ca');
						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($eformat);
						
						if($this->email->send())
						{
							$success = true;
						}

						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						//$this->email->to('sammehmi@gmail.com');
						//$this->email->cc('jakki@whatabloom.com');
						$this->email->to('orders@memorialflowers.ca');
						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($admin_format);
						
						
						if($this->email->send())
						{
							$success = true;
						}
						
						
						
						
						//end here
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						$data['page'] = $this->Pages_model->return_page('order-thanks');
						$data['paths'] = array('Home'=>path(),'Checkout'=>'#','Thank you'=>'');
						$this->load->view('mymemorial/thankyou',$data);
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
			else
			{
				echo validation_errors();
				die('~Invalid Use!');
			}
		
		}
		
		
	}
	
	public function unset_cart()
	{
		$this->session->unset_userdata('cart_id');
		$this->session->unset_userdata('guest_checkout');
		$this->session->unset_userdata('coupon');

	}
	
	public function send($id)
	{
		$this->Order_model->sendItem($id);
		redirect(base_url().'mymemorial/orders/active');
		exit;
	}
	
	public function confirm($id)
	{
		$this->Order_model->confirmItem($id);
		redirect(base_url().'mymemorial/orders/active');
		exit;
	}
	
	public function printitem($id)
	{
		$data['order'] = $this->Order_model->getOrderItem($this->session->userdata('affiliate_id'),$id);
		$this->load->view('print-order',$data);
	}
	
	public function create()
	{
		$this->load->model('Location_model');
		$this->load->model('Memorial_model');
		$this->load->model('Affiliate_model');
		$this->load->model('Occasion_model');

		$data['products'] = $this->Product_model->mymemorial_products(1000);
		
		$affiliate = $this->Affiliate_model->getAffiliateInfo($this->session->userdata('affiliate_id'));
		
		
		if(!$this->session->userdata('del_firstname'))
		{
			$session['locationtype'] = '';
			$session['firstname'] = $affiliate->user_firstname;
			$session['lastname'] = $affiliate->user_lastname;
			$session['phone'] = $affiliate->user_phone1;
			$session['address'] = $affiliate->user_address1 . ' ' .$affiliate->user_address2;
			$session['postalcode'] = $affiliate->user_postalcode;
			$session['city'] = $affiliate->user_city;
			$session['province'] = $affiliate->user_province;
			$session['country_id'] = $affiliate->user_country_id;
			
		}
		else
		{
			$session['locationtype'] = $this->session->userdata('del_locationtype');
			$session['firstname'] = $this->session->userdata('del_firstname');
			$session['lastname'] = $this->session->userdata('del_lastname');
			$session['phone'] = $this->session->userdata('del_phone');
			$session['address'] = $this->session->userdata('del_address');
			$session['postalcode'] = $this->session->userdata('del_postalcode');
			$session['city'] = $this->session->userdata('del_city');
			$session['province'] = $this->session->userdata('del_province');
			$session['country_id'] = $this->session->userdata('del_country_id');
		}
		
		$data['session'] = $session;
		$data['provinces'] = $this->Location_model->getProvinces();
		$data['countries'] = $this->Location_model->getCountries();
		$data['occasions'] = $this->Occasion_model->get_occasions();
		
		$data['cart'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));
				$this->load->model('Category_model');
		$data['categories'] = $this->Category_model->get_categories();
		$data['affiliate'] = $affiliate;

		$this->load->view('mymemorial/order',$data);		
	}
	
	public function additem()
	{
		if(isset($_POST['id']))
		{
			if($product=$this->Product_model->getItemDetail($_POST['id'],$_POST['price_id']))
			{
				$item = array('id'=>$product->product_id,
					      'qty'=>1,
					      'price'=>number_format($product->price,2),
					      'name'=>$product->product,
					      'options'=>array('price_id'=>$product->price_id,
							       'title'=>$product->title,
							       'picture'=>$product->picture));
				
				$this->cart->insert($item);	
			}
			echo 'success';
			
			
		}		
		
	}
	
	
	public function addcart()
	{		
	$this->load->helper('url');	
	
		$this->form_validation->set_rules("product_id", 'Product','required');
		$this->form_validation->set_rules("price_id", 'Price','required|numeric|max_length[10]');
			
		$this->form_validation->set_error_delimiters('<span class="error error_span">', '</span>');

		if ($this->form_validation->run() == TRUE)
		{			
			if($this->Order_model->add_to_mycart($this->input->post()))
			{
				echo 'Item Added';	
				redirect(base_url().'mymemorial/products');
			}
			else {
				echo 'Failed to Add';
			}
		}
		
	}
	
	
	public function deliveryaddress()
	{

		$this->load->library('Form_validation');

		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('postalcode', 'Postalcode', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->model('Memorial_model');
			$this->load->model('Location_model');
			
			$data['provinces'] = $this->Location_model->getProvinces();
			$data['countries'] = $this->Location_model->getCountries();
			
			$res = json_encode(array('html'=>$this->load->view('mymemorial/delivery-address',$data,TRUE),
					   'validation'=>'failed'));
			
			
					
			echo $res;
		}
		else
		{
			$this->load->model('Order_model');					
			$this->load->model('Memorial_model');
			$this->load->model('Location_model');
			
			$data['provinces'] = $this->Location_model->getProvinces();
			$data['countries'] = $this->Location_model->getCountries();
			$data['ord_ite'] = $this->session->userdata('cart_id');
			
			$this->Order_model->updateMyDelivery($this->session->userdata('cart_id'),$_POST);
					
			$res = json_encode(array('html'=>$this->load->view('mymemorial/delivery-address',$data,TRUE),
					'validation'=>'ok'));
			
			$post = $this->input->post(NULL,TRUE);
			
			$this->session->set_userdata('del_firstname',$post['firstname']);
			$this->session->set_userdata('del_lastname',$post['lastname']);
			$this->session->set_userdata('del_phone',$post['phone']);
			$this->session->set_userdata('del_address',$post['address']);
			$this->session->set_userdata('del_postalcode',$post['postalcode']);
			$this->session->set_userdata('del_city',$post['city']);
			$this->session->set_userdata('del_province',$post['province']);
			$this->session->set_userdata('del_country_id',$post['country_id']);
			$this->session->set_userdata('del_locationtype',$post['locationtype']);
			
			echo $res;
		}
		

	}
	
	public function test()
	{
		$starttime = date(mktime(6,0));
		echo date('H:i',$starttime+(60*15));
	}
	
	
	public function cartsummary()
	{
		
		$this->load->model('Memorial_model');
		$this->load->model('Affiliate_model');
		
		$comm = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));
		
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

			
			
			$addition = $this->Order_model->get_add_estimate($item->orderitem_id);

			//$addition = $this->Group_model->get_add_charges($item->product_id,$item->postalcode);
			
			
			//san has changed on 13-7-2013
			//$totals['shipping'] += 10; ///$addition['shipping'];
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

			$totals['tax'] += ($addition['tax'] * $ptotal) / 100;   //$addition['tax']
			
		}
		
		$totals['grandtotal'] = number_format($totals['itemtotal'],2) + number_format($totals['shipping'],2) + number_format($totals['service'],2) + number_format($totals['surcharge'],2) + number_format($totals['tax'],2) - number_format($totals['discount'],2) - number_format($totals['coupon'],2);	
		
		$data['p'] = (object) $_POST;
		$data['totals'] = $totals;
		$data['cart'] = $cart;
		
		//$data['commission'] = ($this->cart->total() * $comm->commission)/100;
		
		$result = array('cartsummary'=>$this->load->view('mymemorial/summary',$data,true),
				'shipping'=>$totals['shipping'],
				'tax'=>$totals['tax'],
				'commission'=>0);
		
		echo json_encode($result);		
		
	}
	
	
	public function checkcard()
	{		
		$this->load->library('Form_validation');
		
		$this->load->model('Affiliate_model');
		$affiliate = $this->Affiliate_model->get_affiliate($this->session->userdata('affiliate_id'));

		$this->form_validation->set_rules('payeename', 'Card Holder Name', 'required');
		$this->form_validation->set_rules('cc', 'Credit Card Number', 'required');
		$this->form_validation->set_rules('cmonth', 'Expiry Month', 'required|[minlength[2]|maxlength[2]');
		$this->form_validation->set_rules('cyear', 'Expiry Year', 'required|[minlength[2]|maxlength[2]');
		$this->form_validation->set_rules('cvv', 'CVV', 'required|numeric|minlength[3]|maxlength[4]');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == FALSE && $affiliate->customer_onaccount!=1)
		{
			$html = $this->load->view('mymemorial/payment',array(),TRUE);
			echo json_encode(array('validation'=>'failed','html'=>$html,'error'=>form_error()));
		}
		else
		{

			$cart = $this->Order_model->get_cart($this->session->userdata('cart_id'));
			
			$this->Order_model->updateMyBilling($this->session->userdata('cart_id'),$affiliate);			
			
			echo json_encode(array('validation'=>'success'));
		}
	}
	
	
	public function remitem()
	{
		if(isset($_POST['id']))
		{
			
			$this->cart->update(array('rowid'=>$_POST['id'],
						  'qty'=>0));
			
			echo 'success';
		}		
		
	}
	
	public function catalogSearch()
	{
		
		$keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword']:'';
		$catid = isset($_REQUEST['catid']) ? $_REQUEST['catid']:'';
		
		$data['products'] = $this->Product_model->mymemorial_products(1000, array('search'=>$keyword,'catid'=>$catid));
		
		$result = $this->load->view('mymemorial/show-products',$data,TRUE);
		
		echo $result;

	}
	
	
	
	
	public function details()
	{
		
		//$keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword']:'';
		if(isset($_REQUEST['testname']))
		{
		$name=$_REQUEST['testname'];
		}
		//else { 
		//$name=9;
		//}
		
		//$data['products'] = $this->Product_model->mymemorial_products(1000, array('search'=>$keyword,'catid'=>$catid));
		
		$result = $this->load->view('mymemorial/details',$name);
		
		return $result;

	}
	
	
	
	
	/*
	public function catalog()
	{
		/*
		$data['nums'] = 60;
		
		if(isset($_POST['direction']) && $_POST['direction']=='prev')
		{
			$data['start'] = isset($_POST['start']) ? $_POST['start']-($data['nums']*2):'0';			
		}
		else
		{
			$data['start'] = isset($_POST['start']) ? $_POST['start']:'0';			
		}
		
		if($data['start']<0) { $data['start']=0; }
		
		*/
/*
		$data['products'] = $this->Product_model->getProducts(array());
		
		$this->load->view('show-products',$data);
	}*/
	
	public function getlocinfo()
	{
		$this->load->model('Location_model');
		$location = $this->Location_model->getLocationInfo($this->input->post('postalcode'));
		
		$result = json_encode(array('city'=>$location->city,'province_id'=>$location->province_id,
					    'country_id'=>$location->country_id));
		
		echo $result;
		
	}
	
	
	public function xmycart()
	{
		
		$data['cart'] = $this->Order_model->get_cart($this->session->userdata('cart_id'));
		$output = $this->load->view('mymemorial/mycart',$data,true);
		
		$total = 0;
		$items = count($data['cart']);
		
		foreach($data['cart'] as $item)
		{
			$total += $item->product_price;
		}
		
		$cartview = $this->load->view('mymemorial/cartview',$data,true);
		
		$result = array('cartview'=>$cartview, 'cartotal'=>getRate($total), 'sidecart'=>$output, 'items'=>$items);
		
		echo json_encode($result);
		
	}
	
	public function mycartrem()
	{
		$id = $_REQUEST['id'];
		
		if(is_numeric($id))
		{
			$this->Order_model->remove($id);
			
		}
		
		return $this->xmycart();
	}
	
	function mydate()
	{
		$this->load->view('mymemorial/datetest');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */