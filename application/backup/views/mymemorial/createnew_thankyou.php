<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>

<div id="content" class="clearfix">

    <div id="page">

			<div class="contents">
				
				<div id="table-wrapper">
					
					<table width="100%" border="0">
					
						<tr>
						
							<td width="10%">
							
							</td>
							
							<td width="80%" align="center">
							
								<h1><b>Your Order was Successfully Submitted</b></h1>
								<h2 style="color:red;"><?php echo 'MEM'.$order_id_created; ?></h2>
								
								<?php $items = $this->Invoice_model->get_order_items($cart_id_created); ?>
								<?php $order_comple = $this->Invoice_model->get_order_comple($order_id_created); ?>
								<?php $i = 1; ?>
								<?php foreach($items as $item){ ?>
								
								<table width="100%"border="1">
								
									<tr>
									
										<td colspan="2" width="100%" align="center" style="background-color:#B8B8B8; color:#2E2E2E;">
										
											<span style="font-size:22px;"><b>Item #<?php echo $i; ?> | PO <?php echo $item->order_po; ?></b></span>
										
										</td>
										
									</tr>
									
									<tr>
									
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											<b>Recipient Information</b>
										</td>
										
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											<b>Delivery Date</b>
										</td>
									
									</tr>
									
									<tr>
									
										<td style="padding:10px 15px 10px 15px;">
										
											<h4><?php echo $item->firstname.' '.$item->lastname; ?></h4>
											<br />
											<span style="font-size:20px;">
											<span style="color:red;"><?php echo $item->location_type; ?></span>
											<br />
											<?php echo $item->location_type_name; ?><br />
											<?php echo $item->address1; ?><br />
											<?php echo $item->address2; ?><br />
											<?php echo $item->city.', '.$item->province; ?><br />
											<?php echo $item->postalcode.' CA'; ?><br />
											<?php echo $item->dayphone; ?><br />
											</span>
										</td>
										
										<td align="center" valign="top" style="padding:15px 0px 0px 0px;">
										
											<h3 style="color:red;"><?php echo $item->delivery_date.' | '.$item->delivery_time; ?></h3>
											<br />
											
											<table width="100%">
												<tr>
													<td width="100%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
														<b>Card Message</b>
													</td>
												</tr>
											</table>
											<div style="font-size:20px;text-align:left; padding:10px 10px 10px 10px;">
												<?php echo $item->card_message; ?><br />
											</div>
										
										</td>
									
									</tr>
									
									<tr>
									
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											Ribbon
										</td>
										
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											Special Notes
										</td>
									
									</tr>
									
									<tr>
									
										<td style="padding:10px 10px 10px 10px;" valign="top">
											<b>Color: </b>
											<?php echo $item->ribbon_color; ?>
											<br /><br />
											<b>Text: </b>
											<?php echo $item->ribbon_text; ?>
											
										</td>
										
										<td style="padding:10px 10px 10px 10px;" valign="top">
										
											<b>Notes: </b>
											<?php echo $item->special_note; ?>
										
										</td>
									
									</tr>
								
								</table>
								
								<table width="100%" border="1">
								
									<tr>
									
										<td width="25%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											Image
										</td>
										
										<td width="44%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											Product
										</td>
										
										<td width="33%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											Price
										</td>
									
									</tr>
									
									<tr>
									
										<td align="center">
											<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:200px; height:240px;">
										</td>
										
										<td style="padding:10px 10px 10px 10px;" valign="top">
											<h4><b>Code</b></h4>
											<?php echo $item->product_code; ?>
											
											<br /><br />
											
											<h4><b>Name</b></h4>
											<?php echo $item->product_name; ?>
											
										</td>
										
										<td valign="middle" align="center">
											<h2>$<?php echo $item->product_price; ?></h2>	
										</td>
									
									</tr>
								
								</table>
								
								<?php $i = $i + 1; ?>
								<?php } ?>
								
								
								
								<table width="100%"border="1">
								
									<tr>
									
										<td colspan="2" width="100%" align="center" style="background-color:#B8B8B8; color:#2E2E2E;">
										
											<span style="font-size:22px;"><b>Billing Information</b></span>
										
										</td>
										
									</tr>
									
									<tr>
									
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											<b>Customer Information</b>
										</td>
										
										<td width="50%" style="background-color:#B8B8B8; color:#2E2E2E;" align="center">
											<b>Invoice Details</b>
										</td>
									
									</tr>
									
									<tr>
									
										<td style="padding:10px 15px 10px 15px;">
										
											<h4><?php echo $order_comple->firstname.' '.$order_comple->lastname; ?></h4>
											<br />
											<span style="font-size:20px;">
											<?php echo $order_comple->address1; ?><br />
											<?php echo $order_comple->address2; ?><br />
											<?php echo $order_comple->city.', '.$item->province; ?><br />
											<?php echo $order_comple->postalcode.' CA'; ?><br />
											<?php echo $order_comple->dayphone; ?><br />
											<?php echo $order_comple->email; ?><br />
											</span>
										</td>
										
										<td align="center" valign="top" style="padding:15px 0px 0px 0px;">
										
											<table width="100%">
												<tr>
													<td width="48%" align="right">
														<h3><b>Sub-Total</b></h3>
														<h3><b>Tax</b></h2>
														<h3><b>Delivery</b></h3>
														<br />
														<h3><b>Grand Total</b></h3>
													</td>
													<td width="4%">
														
													</td>
													<td width="48%">
														<h3><b>$<?php echo $order_comple->amount; ?></b></h3>
														<h3><b>$<?php echo $order_comple->tax; ?></b></h3>
														<h3><b>$<?php echo $order_comple->shipping; ?></b></h3>
														<br />
														<h3 style="color:red;"><b>$<?php echo $order_comple->amount+$order_comple->tax; ?></b></h3>
												</tr>
											</table>											
											
										</td>
									
									</tr>
									
									
								
								</table>
								
								
							</td>
							
							<td width="10%">
							
							</td>
						
						</tr>
					
					
					</table>

					
					
					
					
					
					
					
				</div>
			  
			</div>
			

			 
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
