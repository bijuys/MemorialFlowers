<?php include_once('top.php'); ?>
      <div class="container">
            <div id="breadcrumb">
                  
            </div>
            <div id="page" style="margin-left:0px;margin-right:0px;">
                  <h1><big>Thank you for your order!</big></h1>
                  <form action="" method="post">
                  <div class="content-box">
                        <div class="box-inner">
						
							<div id="responsive">
								<div class="pull-right">
									<a href="<?php echo base_url(); ?>orders/review-invoice/<?php echo $invoice_id;?>" target="_blank" style="color:#c81b09;">Print Receipt</a>	
								</div>
								<p><strong>Your order number is <?php echo $invoice_id;?></strong></p>
								<p>You will receive an email confirmation shortly at <?php echo $_POST['email'];?></p>
								<br/>
								<p><strong>What would you like to do next?</strong></p>
								<a href="<?php echo base_url();?>" class="btn btn-default">Back to Flowers</a>
								<?php if($funeral_home_id!=0 && $funeral_home_id!=''){ ?>
								&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="btn btn-primary">Back to <?php echo $funeral_home_description; ?></a>
								<?php } ?>
							</div>
							
							<div id="mobile-header">
								<div class="pull-right">
									<a href="<?php echo base_url(); ?>orders/review-invoice/<?php echo $invoice_id;?>" target="_blank" style="color:#c81b09;">Print</a>	
								</div>
								<p><strong>Order Number: <?php echo $invoice_id;?></strong></p>
								<p>You will receive an email confirmation at:<br /> <b><?php echo $_POST['email'];?></b></p>
								<?php if($funeral_home_id!=0){ ?>
								<br/>
								<p>What would you like to do next?</p>
								<a href="javascript:;" class="btn btn-primary" style="width:100%;">Go to Stone Garden Funeral</a>
								<?php } ?>
								<br /><br />
								<a href="http://dignity.memorialflowers.ca/" class="btn btn-default" style="width:100%;">Back to Flowers</a>
							</div>
							
							
                            <div id="order-summary">
							<br />
                        <h2>Order Summary</h2>

                        <div id="responsive">
						<table border="0">
                              <tr height="30">
                                    <th width="15%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="20%" style="text-align:center;">Quantity</th>
                                    <th width="15%" style="text-align:right;">Price</th>
                                    
                                </tr>
                                <?php 
                                          $total_price = 0;
										  $total_shipping = 0;
										  $total_tax = 0;
                                          foreach($cart as $row) :
												if($row->ribbon_text!=''){
													$item_price = $row->product_price+12.99;
												}else{
													$item_price = $row->product_price;
												}
                                                $total_price = $total_price+$item_price;
												$total_shipping = $total_shipping+17.99;
												$total_tax = (($total_price+$total_shipping)*0.13);
                                  ?>
                                <tr>
                                      <td align="center">
										<div class="cart-item-picture">
											<?php if($row->option_picture==''){ ?>
												<img src="/productres/<?php echo $row->product_picture;?>">
											  <?php }else{ ?>
												<img src="/productres/<?php echo $row->option_picture;?>">
											  <?php } ?>
										</div>
                                      </td>
                                      <td valign="top">
											<?php if($row->delivery_date!='0000-00-00'){ ?>
											<p style="line-height:140%;">
												<span style="color:#444;font-weight:bold;"><?php echo $row->product_name; ?></span>
												<?php if($row->ribbon_text!=''){ ?>
													<span style="color:#849998;font-weight:bold;"> + Ribbon ($12.99)</span>
												<?php } ?>
											</p>
											<p style="line-height:155%;font-size:12px;">
												<b>Delivery Date: </b>
												<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
												<br />
												<b>Size: </b><?php echo $row->price_name; ?>
												<br />
												<?php if($row->card_message!=''){ ?>
												 <b>Card Message: </b>
												  <?php echo $row->card_message; ?>
												  <br />	
												<?php } ?>
																				
												<?php if($row->ribbon_text!=''){ ?>
												  <b>Ribbon:</b>
												  <?php echo $row->ribbon_text; ?>
												<?php } ?>
											  </p>
											<?php } ?>
												
												
												
												
                                      </td>
                                      
                                      <td valign="top" align="center" style="padding-top:2px;vertical-align:top;">
										1
										
                                      </td>
                                      <td valign="top" align="right" style="vertical-align:top;">
                                            <?php echo getRate($item_price)?>
                                            <!--
											<?php if($row->ribbon_text!=''){ ?>
                                            <br /><br /><br /><br /><?php echo getRate('12.99')?>
                                            <?php } ?>
											-->
                                          </td>
                                </tr>
							  <?php endforeach; ?>
                        </table>
						</div>
						
						
						<div id="mobile-header">
				
				<div id="shopping-cart">
                        <table width="100%" border="0">
                              <tr>
                                    <th width="25%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="25%" style="text-align:right;">Price</th>
                                </tr>
								<?php
                                $total_price = 0;
										  $total_shipping = 0;
										  $total_tax = 0;
                                          foreach($cart as $row) {
												if($row->ribbon_text!=''){
													$item_price = $row->product_price+12.99;
												}else{
													$item_price = $row->product_price;
												}
                                                $total_price = $total_price+$item_price;
												$total_shipping = $total_shipping+17.99;
												$total_tax = (($total_price+$total_shipping)*0.13);
												
									?>			
                                <tr>
                                      <td align="center" style="padding:0px;">
									  <div class="cart-item-picture" style="width:100%;">
									  <?php if($row->option_picture==''){ ?>
												<img src="/productres/<?php echo $row->product_picture;?>" style="width:100%;">
											  <?php }else{ ?>
												<img src="/productres/<?php echo $row->option_picture;?>" style="width:100%;">
											  <?php } ?>
									  
									  </div>
									      <p class="text-center"><a href="/shop/rem/<?php echo $row->orderitem_id;?>" onclick="javascript:return confirm('<?php echo lang('Are you sure you want to remove this item from your cart'); ?>?'); return false;" style="font-size:12px;">Remove</a></p>
                                      </td>
                                      
									  <td valign="top" style="vertical-align:top;padding:10px;">
										<?php if($row->delivery_date!='0000-00-00'){ ?>
											<p style="line-height:140%;">
												<span style="color:#444;font-weight:bold;"><?php echo $row->product_name; ?></span>
												<?php if($row->ribbon_text!=''){ ?>
													<span style="color:#849998;font-weight:bold;"> + Ribbon ($12.99)</span>
												<?php } ?>
											</p>
											<p style="line-height:155%;font-size:12px;">
												<b>Delivery Date: </b><br />
												<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
												<br />
												<b>Size: </b><br /><?php echo $row->price_name; ?><br />
												<!--
												<?php if($row->card_message!=''){ ?>
												 <b>Card Message: </b>
												  <?php echo $row->card_message; ?>
												  <br />	
												<?php } ?>
												-->								
												<?php if($row->ribbon_text!=''){ ?>
												  <b>Ribbon:</b><br />
												  <?php echo $row->ribbon_text; ?>
												<?php } ?>
											  </p>
											<?php } ?>
									  </td>
                                      <td valign="top" align="right" style="font-size:12px;padding:0px;text-align:right;">
										<br/><?php echo getRate($item_price)?>
									
									</td>
                                     
                                </tr>
                              <?php } ?>
                        </table>
                        <div class="cart-totals text-right" style="display:none;">
                              Sub-total: &nbsp;  &nbsp;  &nbsp;  &nbsp;  
							  <strong>
									<?php echo getRate(isset($coupon) ? $total_price-$coupon->discount : $total_price);?>
								
								
							</strong> &nbsp; 
                             
                        </div>

                        
                  </div>
				
			</div>
						
						
						<br />
                        <div class="text-right">
							<table width="100%" border="0">
								<tr>
									<td width="10%">
									
									</td>
									<td width="90%">
                                                                 <?php
										             $affid=$this->session->userdata('referer');
                                                                              $bothsum=0;
                                                                              
                                                                              if($totals['coupon']>0) {
                                                                                    $bothsum=$totals['coupon']+$totals['discount'];
                                                                              }
                                                                              if($affid!='') {
                                                                                    $bothsum=0; 
                                                                              }

                                                                              $dist = $totals['coupon']+$totals['discount'];
                                                                  ?>              
										<table width="100%" border="0">
											<tr>
												<td width="90%" align="right">
													<p>Sub-total:</p>
                                                                                    <?php if($dist>0) { ?>
                                                                                                <p>Discount</p>
                                                                                    <?php }  ?>
													<?php if($totals['service']==0 || $totals['shipping']>0) { ?>
                                                                                                <p>Shipping:</p>
                                                                                      <?php } ?>
                                                                                      <?php if($totals['service']>0) : ?>
                                                                                                <p><?php echo lang('Shipping');?></p>
                                                                                      <?php endif; ?>
                                                                                      <?php if($totals['surcharge']>0) : ?>
                                                                                                <p><?php echo lang('Same day surcharge');?></p>
                                                                                      <?php endif; ?>
													<p>Taxes:</p>
													<p>Grand Total:</p>
												</td>
												<td width="10%" align="right" style="padding-right:0px;">
													<p><strong><?php echo getRate($total_price);?></strong></p>
                                                                                      <?php if($dist>0) { ?>
                                                                                                <p><?php echo getRate($total_price); ?></p>
                                                                                    <?php }  ?>
                                                                                          <p>
                                                                                                  <?php echo getRate($total_shipping); ?>
                                                                                            </p>
                                                                                       <!--
																					   <?php if($totals['service']>0) : ?>
                                                                                                  <p>
                                                                                                        <?php echo getRate($totals['service']);?>
                                                                                                  </p>
                                                                                        <?php endif; ?>
																						-->
                                                                                        <?php if($totals['surcharge']>0) : ?>
                                                                                              <p>
                                                                                                    <?php echo getRate($totals['surcharge']);?>
                                                                                              </p>
                                                                                        <?php endif; ?>
                                                                                              <p><?php echo getRate($total_tax);?></p>
                                                                                              <p><strong><?php echo getRate($total_price+$total_shipping+$total_tax);?></strong></p>
												</td>
											</tr>
										</table>
										
									</td>
								</tr>
							</table>
                        </div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
                                                </div>
                                                </div>                        
                                          </div>





                        </div>                        
                  </div>
                  <br/>
                  <div class="text-center">
                       <big><strong>Get Live Help!</strong></big>
                       <p>Call 1-888-980-8840
                  </div>

                  </form>

            </div><!-- Page ends here //-->
      </div><!-- Container //-->

	  
	  <div class="copyright text-center" style="height:40px;">
	
	<div class="row">
		<div class="col-lg-4">
		
		</div>
		<div class="col-lg-4">
			<small>
				<!--
				This website and floral service is provided by Memorial Flowers.  Memorial Flowers holds trademark rights in the Memorial Flowers brand and logo and in the copyright holder (&copy; 2015) in Memorial Flowers content.
				-->
				This website and floral service is provided by 1882540 Ontario, Inc, which holds trademark rights in the Memorial Flowers brand and logo and in the copyright holder (&copy; 2015) in the Memorial Flowers  content. 
				</small>
			<br /><br />
			<small>
				SCI management, L.P. holds trademark rights in the Dignity Flowers brand and logo and is the copyright holder (&copy; 2015) in all other content.
			</small>
		</div>
		<div class="col-lg-4">
		
		</div>
	</div>
	
	<br />
	
	<!--<small>Copyright 2015 Dignity. All rights are reserved.</small>-->
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script>

      $(function(){



      })

</script>

