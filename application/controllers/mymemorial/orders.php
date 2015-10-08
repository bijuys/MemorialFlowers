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
	
	function createnew()
	{
		//CALL MODEL	
		$this->load->model('Invoice_model');
		
		//GET CART ID
		$cart_id2 = $this->session->userdata('cart_id');
		
		$data['products'] = '';
		if($cart_id2 == '' || $cart_id2 == 0){
			$data['items'] = '';
		}else{
			$data['items'] = $this->Invoice_model->get_cart_items($cart_id2);
		}	
		
		$data['affiliate'] = $this->Invoice_model->get_affiliate($this->session->userdata('affiliate_id'));
		
		$this->load->view('mymemorial/createnew',$data);
	}
	
	function createnew_order()
	{
		//CALL MODEL	
		$this->load->model('Invoice_model');
		
		//GET SEARCH VALUE
		$val = $this->input->post("product_sear");
		
		//GET CART ID
		$cart_id = $this->session->userdata('cart_id');
		
		$data['products'] = $this->Invoice_model->get_search_products($val);
		if($cart_id == '' || $cart_id == 0){
			$data['items'] = '';
		}else{
			$data['items'] = $this->Invoice_model->get_cart_items($cart_id);
		}	
		
		$data['affiliate'] = $this->Invoice_model->get_affiliate($this->session->userdata('affiliate_id'));
		
		
		$this->load->view('mymemorial/createnew',$data);
	
	}
	
	function createnew_additem()
	{
		
		$this->load->model('Invoice_model');
		//echo $this->session->userdata('cart_id');
		
		$pro_id = $this->input->post("pro_id");
		$pro_na = $this->input->post("pro_na");
		
		//price
		$pro_combo_price = $this->input->post("pro_pr");
		$pieces = explode("_", $pro_combo_price);
		$pri_id = $pieces[0];
		$pri_va = $pieces[1];
		
		if($this->session->userdata('cart_id')=='' || $this->session->userdata('cart_id')==0){
			$last_id = $this->Invoice_model->get_cart_id();
			$cart_id = $last_id->cart_id+1;
		}else{
			$cart_id = $this->session->userdata('cart_id');
		}	
		
		$orderitem_id = $this->Invoice_model->add_item($cart_id,$pro_id,$pri_id,$pro_na,$pri_va);
		
		if($this->session->userdata('cart_id')=='' || $this->session->userdata('cart_id')==0){
			$new_cart_id = $this->Invoice_model->add_cart();
			$this->session->set_userdata('cart_id',$new_cart_id);
		}	
		
		//GET CART ID
		$cart_id2 = $this->session->userdata('cart_id');
		
		$data['products'] = '';
		if($cart_id2 == '' || $cart_id2 == 0){
			$data['items'] = '';
		}else{
			$data['items'] = $this->Invoice_model->get_cart_items($cart_id2);
		}	
		
		$data['affiliate'] = $this->Invoice_model->get_affiliate($this->session->userdata('affiliate_id'));
		
		
		//$this->load->view('mymemorial/createnew',$data);
		
		redirect('mymemorial/orders/createnew');
	
	}
	
	function createnew_removeitem($id)
	{
		
		$this->load->model('Invoice_model');
		//echo $this->session->userdata('cart_id');
		
		$orderitem_id = $this->Invoice_model->remove_item($id);
		
		redirect('mymemorial/orders/createnew');
	
	}
	
	function createnew_submitorder()
	{
		$this->load->model('Invoice_model');
		
		//GET ITEMS
		$items = $this->Invoice_model->get_cart_items($this->session->userdata('cart_id'));
		
		//GET AFFILIATE INFO
		$affiliate = $this->Invoice_model->get_affiliate($this->session->userdata('affiliate_id'));
		
		//UPDATE ITEMS
		$sub_total = 0;
		$tax_rate = 0.13;
		
		$customer_email = $this->input->post('custo_email');
		
		$it = 0;
		
		foreach($items as $item){
		
			$it = $item->orderitem_id;
		
			//FORM DATA TO UPDATE ORDER ITEMS
			$card_message = $this->input->post('card_message'.$item->orderitem_id);
				$mon = $this->input->post('delivery_month'.$item->orderitem_id);
				$day = $this->input->post('delivery_day'.$item->orderitem_id);
				$fulldate = $this->input->post('delivery_year'.$item->orderitem_id).'-'.$mon.'-'.$day;
			$delivery_date = $fulldate;
			$ribbon_text = $this->input->post('ribbon_text'.$item->orderitem_id);
			$order_po = $this->input->post('order_po'.$item->orderitem_id);
			$order_by = $this->input->post('order_by'.$item->orderitem_id);
			$delivery_time = $this->input->post('delivery_time'.$item->orderitem_id);
			$special_notes = $this->input->post('special_notes'.$item->orderitem_id);
			$ribbon_color = $this->input->post('ribbon_color'.$item->orderitem_id);
			
			$orderitem_id = $this->Invoice_model->update_orderitem($item->orderitem_id,$card_message,$delivery_date,$ribbon_text,$order_po,$order_by,$delivery_time,$special_notes,$ribbon_color);
			
			//echo 'WELL DONE UPDATE ORDER ITEMS<br />';
			
			
			//FORM DATA TO INSERT DELIVERY DETAILS
			$rec_firstname = $this->input->post('rec_firstname'.$item->orderitem_id);
			$rec_lastname = $this->input->post('rec_lastname'.$item->orderitem_id);
			$address1 = $affiliate->user_address1;
			$address2 = $affiliate->user_address2;
			$postalcode = $affiliate->user_postalcode;
			$city = $affiliate->user_city;
			$province = $affiliate->user_province;
			$country_id = $affiliate->user_country_id;
			$dayphone = $affiliate->user_phone1;
			$evephone = $affiliate->user_phone2;
			$location_type = 'Funeral Home';
			$location_type_name = $affiliate->user_business;
			
			$deliverydetail_id = $this->Invoice_model->insert_deliverydetail($item->orderitem_id,$rec_firstname,$rec_lastname,$address1,$address2,$postalcode,$city,$province,$country_id,$dayphone,$evephone,$location_type,$location_type_name);
			
			//echo 'WELL DONE INSERT DELIVERY DETAILS<br />';
			
			$sub_total = $sub_total + $item->product_price;
			
		}
		
			
			$firstname = $affiliate->user_firstname;
			$lastname = $affiliate->user_lastname;
			$address1 = $affiliate->user_address1;
			$address2 = $affiliate->user_address2;
			$postalcode = $affiliate->user_postalcode;
			$city = $affiliate->user_city;
			$province = $affiliate->user_province;
			$country_id = $affiliate->user_country_id;
			//$email = $affiliate->user_email;
			$email = $customer_email;
			$dayphone = $affiliate->user_phone1;
			$evephone = $affiliate->user_phone2;
			
			$billingdetail_id = $this->Invoice_model->insert_billingdetail($this->session->userdata('cart_id'),$firstname,$lastname,$address1,$address2,$postalcode,$city,$province,$country_id,$email,$dayphone,$evephone);
			
			//echo 'WELL DONE INSERT BILLING DETAILS<br />';
			
			
			
			$last_id = $this->Invoice_model->get_order_id();
			$order_id = $last_id->order_id+1;
			
			$invoice_id = 'MEM'.$order_id;
			$user_id = $affiliate->user_id;
			$affiliate_id = $affiliate->user_id;
			$order_date = date('Y-m-d H:i:s',time());
			$amount = $sub_total;
			$tax = number_format(($amount*$tax_rate),2);
			$commission = number_format(($amount*($affiliate->affiliate_commission/100)),2);
			
			$order_val_id = $this->Invoice_model->insert_order($invoice_id,$user_id,$affiliate_id,$order_date,$amount,$tax,$this->session->userdata('cart_id'),$commission);
			
			
			$info_number = $order_val_id;
			
			
			
			
		

$p_co = '';
$p_na = '';	
$r_na = '';
$r_a1 = '';
$r_a2 = '';
$r_ci = '';
$r_pr = '';		
$day = '';
$month = '';
$year = '';	
$c_me = '';	
$pos = '';	
$phone1 = '';
$phone2 = '';
$phone3 = '';		
		
$orders_items = $this->Invoice_model->get_email_items($this->session->userdata('cart_id'));
foreach($orders_items as $item) {

	$p_co = $item->product_code;
	$p_na = $item->product_name;
	$r_na = $item->firstname.' '.$item->lastname;
	$r_a1 = $item->address1;
	$r_a2 = $item->address2;
	$r_ci = $item->city;
	$r_pr = $item->province;
	
	$day = substr($item->delivery_date, 8, 2);
	$month = substr($item->delivery_date, 5, 2);
	$year = substr($item->delivery_date, 0, 4);	
	$c_me = $item->card_message;
	$pos = $item->postalcode;
	
	$phone1 = substr($item->dayphone, 0, 3);
	$phone2 = substr($item->dayphone, 3, 3);
	$phone3 = substr($item->dayphone, 6, 4);

}		
		
		
		
		
		
		
		
//FTD
			 
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
Delivery Instructions: '.$invoice_id.'-'.$p_co.' (DS: '.$it.')
Delivery (Day): '.$day.'
Delivery (Month): '.$month.'
Delivery (Year): '.$year.'
Card Message: '.$c_me.'
Product AmountX: '.$amount.'
Product CodeX: '.$p_co.'
Product DescriptionX: '.$p_na.'
Product QtyX: 1
Recipient Name: '.$r_na.'
Recipient Company: '.$r_na.'
Recipient Address1: '.$r_a1.'
Recipient Address2: '.$r_a2.'
Recipient City: '.$r_ci.'
Recipient State: '.$r_pr.'
Recipient Country Code: CA
Recipient Zip Code: '.$pos.'
Recipient Phone Area Code: '.$phone1.'
Recipient Phone Prefix: '.$phone2.'
Recipient Phone Number: '.$phone3.'';

 
$send2 = mail($from, $subject2, $autoreply, implode("\r\n", $headers)); 
if($send2) 
{//header( "Location: http://www.cibcmortgagecareers.com/apply-now/thank-you" );
} 
else 
{//print "We encountered an error sending your mail, please notify info@cibcmortgagecareers.com ... Sorry for the inconvenients ..."; 
} 


















		
		/*
		$data['billing'] = $this->Invoice_model->get_order_email($info_number);	
		$orders_items = $this->Invoice_model->get_email_items($order->cart_id);

		$message = $this->load->view('mymemorial/order-confirm',$data,true);	
			
		$this->load->library('email');
		$email_config['mailtype'] = 'html';
		$this->email->initialize($email_config);
		
		$this->email->from('orders@memorialflowers.ca', 'MEM');
		$this->email->to($data['billing']->email);
		$this->email->subject('Memorial Flowers - Order Confirmation');
		$this->email->message($message);
			
		$this->email->send();
		*/
		
		
		
		
		
		
			
			
			//$order_val_id = 918;
		
		$order = $this->Invoice_model->get_order_email($info_number);	
		$from_email_address = 'orders@memorialflowers.ca';
		
		//CREATE HEADER FOR EMAIL	
		$to = $order->email;
		//$to = 'orabines@hotmail.com';
		$header = "From: orders@memorialflowers.ca\n";
		$header .= "Cc: jakki@whatabloom.com\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=ISO-8859-1\n";
		$subject = "Memorial Flowers - Invoice";
		$message = '<html><body>';
		
			/*$orders = $this->Orders_model->get_order($order_record_id2);
			foreach($orders as $order) { */
			
			//$ord_id = $invoice->order_id;
				
			$message .= '<table width="60%">
							<tr>
								<td>
								<p>Invoice number: <span style="font-weight:bold; font-size:17px; color:#DB2929">'.$order->invoice_id.'</span><br />';

								/*if($order->order_by != "") { 
									$message .= 'Ordered By: <span style="font-weight:bold; font-size:17px; color:#DB2929">'.$order->order_by.'</span>';
								}*/
			$message .= '		</p>
								</td>
								<td align="right">
									<img src="'.base_url().'images/mem_logo.png" alt="Memorial Flowers" width="250" height="70" />
								</td>
							</tr>
						</table>';
			
				$orders_items = $this->Invoice_model->get_email_items($order->cart_id);
				foreach($orders_items as $item) {

					$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
									<tr>
										<th colspan="2" class="bg-center-text">';
										$message .= 'ITEM ID: '.$item->orderitem_id;
											if($item->order_po != "") { 
											$message .= ' | ORDER PO: '.$item->order_po;
											}
									
					$message .= '		</th>
									</tr>
									<tr>
										<th class="bg-center-text" width="50%">Recipient Information</th>
										<th class="bg-center-text" width="50%">Delivery Date & Time</th>
									</tr>
									<tr>
										<td rowspan="3"><b>'.ucfirst($item->firstname.' '.$item->lastname).'</b><br /><br />
											<span style="color:#990000;">
											'.ucfirst($item->location_type).':</span> 
											'.ucfirst($item->location_type_name).'<br />
											'.ucfirst($item->address1.' '.$item->address2).'<br />
											'.ucfirst($item->city.' '.$item->province).'<br />';
									
									if($item->country_id ==1) {
										$message .= 'CA';
									}else{
										$message .= 'US';
									}
									$message .= ' '.strtoupper($item->postalcode).'<br/><br />
												'.$item->dayphone; 
									
									if($item->evephone == '') {
										$message .= '';
									}else{
										$message .= ' | '.$item->evephone;
									}
									
								$message .= '</td>
								<td align="right">
									<span style="font-weight:bold; font-size:17px; color:#DB2929"><center>';
										 
										/*if($item->delivery_date == '000-00-00') {
											$message .= $item->delivery_range;
										}else{*/
											$message .= date("F j, Y", strtotime($item->delivery_date));
										//}
										
										if($item->delivery_time == '') {
											$message .= '';
										}else{
											$message .= ' - '.$item->delivery_time;
										}
										
								$message .=	'</center></span>
								</td>
							</tr>
							<tr>
								<th class="bg-center-text">Card Message</td>
							</tr>
							<tr>
								<td class="keep-size" align="justify">'.$item->card_message.'</td>
							</tr>
							<tr>
								<th class="bg-center-text" width="50%">Special Notes</th>
								<th class="bg-center-text" width="50%">Ribbon Message</th>
							</tr>
							<tr>
								<td>
									<b>Ordered By:</b> '.$item->order_by.'<br /><br />
									<b>Special Notes:</b> '.$item->special_note.'<br /><br />
								<td>
									<b>Ribbon Color:</b> '.$item->ribbon_color.'<br /><br />
									<b>Ribbon Message:</b> '.$item->ribbon_text.'<br /><br />
								</td>
							</tr>
							
						</table>'; 
					
					
						
				$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
							<tr>
								<th class="bg-center-text" width="20%">Image</th>
								<th class="bg-center-text" width="35%">Product</th>
								<th class="bg-center-text" width="15%">Price</th>
								<th class="bg-center-text" width="15%">Quantity</th>
								<th class="bg-center-text" width="15%">Total</th>
							</tr>
							
							<tr height="110">
								<td align="center">
									<img src="'.base_url().'productres/'.$item->product_picture.'" alt="'.$item->product_name.'" width="200" height="220"/>
								</td>
								<td>
									<p><strong>Product Code</strong><br />
									'.$item->product_code.'</p>
									<p><strong>Product Name</strong><br />
									'.$item->product_name.'</p>
									<p><strong>Product Size</strong><br />
									'.$item->price_name.'</p>
								</td>
								<td align="center">
									$ '.$item->product_price.'
								</td>
								<td align="center">
									1
								</td>
								<td align="center">
									$ <b>'.$item->product_price.'</b>
								</td>
							</tr>';
							
							
							
							
							/*$orders_addons = $this->Orders_model->get_orders_addons($item->orderitem_id,$item->db_id);
						
							foreach($orders_addons as $addon) { 
							
							
					$message .= '<tr>
								<td align="center">
									<img src="'.base_url().'productres/'.$order->website_folder.'/'.$addon->addon_picture.'" alt="'.$addon->addon_name.'" width="40" height="40"/>
								</td>
								<td>
									'.$addon->addon_name.'
								</td>
								<td align="center">
									'.$addon->addon_price.'
								</td>
								<td align="center">
									'.$addon->addon_quantity.'
								</td>
								<td align="center">
									'.$addon->addon_price*$addon->addon_quantity.'
								</td>
							</tr>';
							
							} */
							
						
					$message .= '	</table>';
				
				}


				$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
							<tr>
								<th colspan="2" class="bg-center-text">BILLING INFORMATION</th>
							</tr>
							<tr>
								<th class="bg-center-text">Customer Information</th>
								<th class="bg-center-text">Invoice Details</th>
							</tr>

							<tr>
								<td width="50%">
									<b>'.ucfirst($order->firstname.' '.$order->lastname).'</b><br/>
									'.ucfirst($order->address1.' '.$order->address2).'<br />
									'.ucfirst($order->city.', '.$order->province).'<br/>';
									 
									if($order->country_id ==1) {
										$message .= 'CA';
									}else{
										$message .= 'US';
									}
									
						$message .= ' '.strtoupper($order->postalcode).'<br/>
									<br/>
									'.strtolower($order->email).' <br/>
									'.$order->dayphone; 
									
									if($order->evephone == '') {
										$message .= '';
									}else{
										$message .= ' / '.$order->evephone;
									}
									
						$message .= '</td>
									<td width="50%">
								
									<table cellpadding="2" cellspacing="0" border="0" width="100%">
										<tr>
											<td width="50%" align="right">Product Price</td>
											<td width="15%" align="center">:</td>
											<td width="35%">$ '.$order->amount.' </td>
										</tr>
										<tr>
											<td align="right">Delivery Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->shipping.' </td>
										</tr>
										<tr>
											<td align="right">Service Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->service.' </td>
										</tr>
										<tr>
											<td align="right">Same Day Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->surcharge.' </td>
										</tr>
										<tr>
											<td align="right">Discount</td>
											<td align="center">:</td>
											<td>$ ';
											 
											$total_discount = $order->coupon+$order->company_less+$order->discount;
							$message .= $total_discount; 
							
							$message .= '</td>
										</tr>
										<tr>
											<td align="right">Tax</td>
											<td align="center">:</td>
											<td>$ '.$order->tax.'</td>
										</tr>
										<tr>
											<td colspan="3"></td>
										</tr>
										<tr style="font-size:17px; font-weight:bold;">
											<td align="right">Total</td>
											<td align="center">:</td>
											<td>$ ';
											
											$gran_total = $order->amount + $order->shipping + $order->service + $order->surcharge - $total_discount + $order->tax;
											
							$message .= $gran_total.'
											
											</td>
										</tr>
									</table>                    
								
								</td>
							</tr>
						</table>';
				
				
				
		
			
			
		$message .= '</body></html>';
		
		$retval = mail($to,$subject,$message,$header,"-f $from_email_address");
		if( $retval == true )  
		{
			/*$email_invoice = $this->Orders_model->email_invoice($ord_id,$db_id2);
			$this->load->view('mail-modal', $data);*/
			//echo "Message sent successfully ...";
		}
		else
		{
			//echo "Message could not be sent ...";
		}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			$data['order_id_created'] = $order_val_id;
			$data['cart_id_created'] = $this->session->userdata('cart_id');
			
			$this->load->view('mymemorial/createnew_thankyou',$data);
			
			$this->session->unset_userdata('cart_id');
			
	}
	
	function createnew_thankyou()
	{
		$this->load->model('Invoice_model');
		
		
		
		$order_val_id = 977;
		
		$order = $this->Invoice_model->get_order_email($order_val_id);	
		
		//CREATE HEADER FOR EMAIL	
		//$to = $order->email;
		$to = 'jakki@whatabloom.com';
		$header = "From: orders@memorialflowers.ca \r\n";
		$header .= "Cc: jakki@whatabloom.com\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$subject = "Memorial Flowers - Invoice";
			
		$message = '<html><body>';
		
			/*$orders = $this->Orders_model->get_order($order_record_id2);
			foreach($orders as $order) { */
			
			//$ord_id = $invoice->order_id;
				
			$message .= '<table width="60%">
							<tr>
								<td>
								<p>Invoice number: <span style="font-weight:bold; font-size:17px; color:#DB2929">'.$order->invoice_id.'</span><br />';

								/*if($order->order_by != "") { 
									$message .= 'Ordered By: <span style="font-weight:bold; font-size:17px; color:#DB2929">'.$order->order_by.'</span>';
								}*/
			$message .= '		</p>
								</td>
								<td align="right">
									<img src="'.base_url().'images/mem_logo.png" alt="Memorial Flowers" width="250" height="70" />
								</td>
							</tr>
						</table>';
			
				$orders_items = $this->Invoice_model->get_email_items($order->cart_id);
				foreach($orders_items as $item) {

					$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
									<tr>
										<th colspan="2" class="bg-center-text">';
										$message .= 'ITEM ID: '.$item->orderitem_id;
											if($item->order_po != "") { 
											$message .= ' | ORDER PO: '.$item->order_po;
											}
									
					$message .= '		</th>
									</tr>
									<tr>
										<th class="bg-center-text" width="50%">Recipient Information</th>
										<th class="bg-center-text" width="50%">Delivery Date & Time</th>
									</tr>
									<tr>
										<td rowspan="3"><b>'.ucfirst($item->firstname.' '.$item->lastname).'</b><br /><br />
											<span style="color:#990000;">
											'.ucfirst($item->location_type).':</span> 
											'.ucfirst($item->location_type_name).'<br />
											'.ucfirst($item->address1.' '.$item->address2).'<br />
											'.ucfirst($item->city.' '.$item->province).'<br />';
									
									if($item->country_id ==1) {
										$message .= 'CA';
									}else{
										$message .= 'US';
									}
									$message .= ' '.strtoupper($item->postalcode).'<br/><br />
												'.$item->dayphone; 
									
									if($item->evephone == '') {
										$message .= '';
									}else{
										$message .= ' | '.$item->evephone;
									}
									
								$message .= '</td>
								<td align="right">
									<span style="font-weight:bold; font-size:17px; color:#DB2929"><center>';
										 
										/*if($item->delivery_date == '000-00-00') {
											$message .= $item->delivery_range;
										}else{*/
											$message .= date("F j, Y", strtotime($item->delivery_date));
										//}
										
										if($item->delivery_time == '') {
											$message .= '';
										}else{
											$message .= ' - '.$item->delivery_time;
										}
										
								$message .=	'</center></span>
								</td>
							</tr>
							<tr>
								<th class="bg-center-text">Card Message</td>
							</tr>
							<tr>
								<td class="keep-size" align="justify">'.$item->card_message.'</td>
							</tr>
							<tr>
								<th class="bg-center-text" width="50%">Special Notes</th>
								<th class="bg-center-text" width="50%">Ribbon Message</th>
							</tr>
							<tr>
								<td>
									<b>Ordered By:</b> '.$item->order_by.'<br /><br />
									<b>Special Notes:</b> '.$item->special_note.'<br /><br />
								<td>
									<b>Ribbon Color:</b> '.$item->ribbon_color.'<br /><br />
									<b>Ribbon Message:</b> '.$item->ribbon_text.'<br /><br />
								</td>
							</tr>
							
						</table>'; 
					
					
						
				$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
							<tr>
								<th class="bg-center-text" width="20%">Image</th>
								<th class="bg-center-text" width="35%">Product</th>
								<th class="bg-center-text" width="15%">Price</th>
								<th class="bg-center-text" width="15%">Quantity</th>
								<th class="bg-center-text" width="15%">Total</th>
							</tr>
							
							<tr height="110">
								<td align="center">
									<img src="'.base_url().'productres/'.$item->product_picture.'" alt="'.$item->product_name.'" width="200" height="220"/>
								</td>
								<td>
									<p><strong>Product Code</strong><br />
									'.$item->product_code.'</p>
									<p><strong>Product Name</strong><br />
									'.$item->product_name.'</p>
									<p><strong>Product Size</strong><br />
									'.$item->price_name.'</p>
								</td>
								<td align="center">
									$ '.$item->product_price.'
								</td>
								<td align="center">
									1
								</td>
								<td align="center">
									$ <b>'.$item->product_price.'</b>
								</td>
							</tr>';
							
							
							
							
							/*$orders_addons = $this->Orders_model->get_orders_addons($item->orderitem_id,$item->db_id);
						
							foreach($orders_addons as $addon) { 
							
							
					$message .= '<tr>
								<td align="center">
									<img src="'.base_url().'productres/'.$order->website_folder.'/'.$addon->addon_picture.'" alt="'.$addon->addon_name.'" width="40" height="40"/>
								</td>
								<td>
									'.$addon->addon_name.'
								</td>
								<td align="center">
									'.$addon->addon_price.'
								</td>
								<td align="center">
									'.$addon->addon_quantity.'
								</td>
								<td align="center">
									'.$addon->addon_price*$addon->addon_quantity.'
								</td>
							</tr>';
							
							} */
							
						
					$message .= '	</table>';
					
					
					
					
				
				}


				$message .= '<table width="60%" cellpadding="5" cellspacing="0" border="1">
							<tr>
								<th colspan="2" class="bg-center-text">BILLING INFORMATION</th>
							</tr>
							<tr>
								<th class="bg-center-text">Customer Information</th>
								<th class="bg-center-text">Invoice Details</th>
							</tr>

							<tr>
								<td width="50%">
									<b>'.ucfirst($order->firstname.' '.$order->lastname).'</b><br/>
									'.ucfirst($order->address1.' '.$order->address2).'<br />
									'.ucfirst($order->city.', '.$order->province).'<br/>';
									 
									if($order->country_id ==1) {
										$message .= 'CA';
									}else{
										$message .= 'US';
									}
									
						$message .= ' '.strtoupper($order->postalcode).'<br/>
									<br/>
									'.strtolower($order->email).' <br/>
									'.$order->dayphone; 
									
									if($order->evephone == '') {
										$message .= '';
									}else{
										$message .= ' / '.$order->evephone;
									}
									
						$message .= '</td>
									<td width="50%">
								
									<table cellpadding="2" cellspacing="0" border="0" width="100%">
										<tr>
											<td width="50%" align="right">Product Price</td>
											<td width="15%" align="center">:</td>
											<td width="35%">$ '.$order->amount.' </td>
										</tr>
										<tr>
											<td align="right">Delivery Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->shipping.' </td>
										</tr>
										<tr>
											<td align="right">Service Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->service.' </td>
										</tr>
										<tr>
											<td align="right">Same Day Charge</td>
											<td align="center">:</td>
											<td>$ '.$order->surcharge.' </td>
										</tr>
										<tr>
											<td align="right">Discount</td>
											<td align="center">:</td>
											<td>$ ';
											 
											$total_discount = $order->coupon+$order->company_less+$order->discount;
							$message .= $total_discount; 
							
							$message .= '</td>
										</tr>
										<tr>
											<td align="right">Tax</td>
											<td align="center">:</td>
											<td>$ '.$order->tax.'</td>
										</tr>
										<tr>
											<td colspan="3"></td>
										</tr>
										<tr style="font-size:17px; font-weight:bold;">
											<td align="right">Total</td>
											<td align="center">:</td>
											<td>$ ';
											
											$gran_total = $order->amount + $order->shipping + $order->service + $order->surcharge - $total_discount + $order->tax;
											
							$message .= $gran_total.'
											
											</td>
										</tr>
									</table>                    
								
								</td>
							</tr>
						</table>';
				
				
				
		
			
			
		$message .= '</body></html>';
		
		$retval = mail($to,$subject,$message,$header);
		if( $retval == true )  
		{
			/*$email_invoice = $this->Orders_model->email_invoice($ord_id,$db_id2);
			$this->load->view('mail-modal', $data);*/
			echo $order_val_id." sent successfully ...";
		}
		else
		{
			echo $order_val_id." could not be sent ...";
		}
			
		

			
			
			
		
		
	
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
		$data['fhomes'] = $this->Order_model->get_funeral_homes_list();
		
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
		//--------------------------------------------------------------------------------------
		elseif(!$this->Order_model->is_delivery_date_entered($cart_id))
		{
			$this->session->set_userdata('date_error', true);
			redirect(base_url().'mymemorial/orders/create');
			exit;
			
		}
		//--------------------------------------------------------------------------------------
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
								
								if($item->order_po!='') {
								$item->order_po=" - ORDER PO: ".$item->order_po;
								$itemf = str_replace('{order_po}',$item->order_po,$itemf);
								}
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
								$itemf = str_replace('{special_note}',$item->special_note,$itemf);
								
                               // $itemf = str_replace('{delivery_date}',date('d M Y',strtotime($item->delivery_date)),$itemf);
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
						$this->email->to($order->email);
						$this->email->cc('jakki@whatabloom.com');
						//$this->email->to("san.whatabloom@gmail.com");
						$aff_email_id=$aff->user_email;
						//$this->email->cc("san.whatabloom@gmail.com");
						//($aff_email_id);
						
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($eformat);
						
						if($this->email->send())
						{
							$success = true;
						}
						
						
						
						
						
					/*	
						$this->email->from('orders@memorialflowers.ca', 'Memorial Flowers');
						//$this->email->to('san.whatabloom@gmail.com');
						//$this->email->cc('jakki@whatabloom.com');
						$this->email->to('orders@memorialflowers.ca');
						$this->email->cc($aff_email_id);
						$this->email->subject('Memorial Flowers Order Confirmation');
						$this->email->message($admin_format);
						
						
						if($this->email->send())
						{
							$success = true;
						}
						
						
						
						
						//end here
						
						
						
						*/
						
						
						
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
			$session['locationtype'] = 'Regular';
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