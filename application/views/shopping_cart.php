<?php include_once('top.php'); ?>
      <div class="container">
            <div id="breadcrumb">
                  <h3>Items in Cart (<?php echo count($cart); ?>)</h3>
            </div>
            <div id="page" style="margin-left:0px;margin-right:0px;">
				
				<div id="responsive">
				
                  <div id="shopping-cart">
					<?php if($cart){ ?>
                        <table border="0">
                              <tr>
                                    <th width="15%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="15%" style="text-align:center;">Quantity</th>
                                    <th width="20%" style="text-align:right;">Price</th>
                                </tr>
                                <?php 
                                          $total_price = 0;
                                          foreach($cart as $row) :
												if($row->ribbon_text!=''){
													$total_price += $row->product_price+12.99;
												}else{
													$total_price += $row->product_price;
												}
                                                
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
									      <p class="text-center"><a href="/shop/rem/<?php echo $row->orderitem_id;?>" onclick="javascript:return confirm('<?php echo lang('Are you sure you want to remove this item from your cart'); ?>?'); return false;">Remove</a></p></td>
                                      </td>
                                      
									  <td valign="top"><h2><a href="<?php echo base_url($row->url);?>"><?php echo $row->product_name; ?></a></h2>
                                                <p>
													<b>Delivery Date: </b>
													<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
													<br />
													<b>Size: </b>
													<?php echo $row->product_size; ?>
													
													
												</p>
												<?php if($row->ribbon_text!=''){ ?>
												<p>
													<b>Ribbon:</b>
													<?php echo $row->ribbon_text; ?>
												</p>
												<?php } ?>
                                      </td>
                                       <td valign="top" align="center" style="padding-top:20px;">
                                                  1                    
                                      </td>
                                      <td valign="top" align="right">
										<br/><?php echo getRate($row->product_price)?>
										<?php if($row->ribbon_text!=''){ ?>
										<br /><br /><br /><br /><br /><?php echo getRate('12.99')?>
										<?php } ?>
									
									</td>
                                     
                                </tr>
                              <?php endforeach; ?>
                        </table>
                        <div class="cart-totals text-right">
                              Sub-total: &nbsp;  &nbsp;  &nbsp;  &nbsp;  
							  <strong>
									<?php echo getRate(isset($coupon) ? $total_price-$coupon->discount : $total_price);?>
								
								
							</strong> &nbsp; 
                             
                        </div>
					
					<?php }else{ ?>
					
						<h1 style="color:#555;font-size:20px;font-weight:bold;">Your cart is currently empty.</h1>
						<br />
						<a href="<?php echo base_url(); ?>" class="btn btn-primary">Continue Shopping</a>
						
					<?php } ?>
                        
                  </div>
				  
			</div>

			<div id="mobile-header">
				
				<div id="shopping-cart">
				
					<?php if($cart){ ?>
				
                        <table width="100%" border="0">
                              <tr>
                                    <th width="25%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="25%" style="text-align:right;">Price</th>
                                </tr>
                                <?php 
                                          $total_price = 0;
                                          foreach($cart as $row) :
												if($row->ribbon_text!=''){
													$total_price += $row->product_price+12.99;
												}else{
													$total_price += $row->product_price;
												}
                                                
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
										<a href="<?php echo base_url($row->url);?>"style="font-size:12px;line-height:80%;font-weight:bold;"><?php echo $row->product_name; ?></a>
                                                <p style="font-size:11px;">
													<b>Delivery Date: </b><br />
													<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
													<br />
													<b>Size: </b><br />
													<?php echo $row->product_size; ?><br />
													<?php if($row->ribbon_text!=''){ ?>
													<b>Ribbon:</b><br />
													<?php echo $row->ribbon_text; ?>
												<?php } ?>
												</p>
									  </td>
                                      <td valign="top" align="right" style="font-size:12px;padding:0px;text-align:right;">
										<br/><?php echo getRate($row->product_price)?>
										<?php if($row->ribbon_text!=''){ ?>
										<br /><br /><br /><br /><br /><?php echo getRate('12.99')?>
										<?php } ?>
									
									</td>
                                     
                                </tr>
                              <?php endforeach; ?>
                        </table>
                        <div class="cart-totals text-right">
                              Sub-total: &nbsp;  &nbsp;  &nbsp;  &nbsp;  
							  <strong>
									<?php echo getRate(isset($coupon) ? $total_price-$coupon->discount : $total_price);?>
								
								
							</strong> &nbsp; 
                             
                        </div>
						
						<?php }else{ ?>
					
							<h1 style="color:#5BC5C4;font-size:20px;font-weight:bold;">Your cart is currently empty.</h1>
							<br />
							<a href="<?php echo base_url(); ?>" class="btn btn-primary">Continue Shopping</a>
							
						<?php } ?>

                        
                  </div>
				
			</div>
				
				<?php if($cart){ ?>
				
                  <div id="responsive" class="text-right" style="margin-bottom: 50px; margin-right: 25px;"><br/>
                              Shipping and Taxes will be calculated during checkout<br/>
                              <p style="margin-top:5px;">
								<!--<button class="btn btn-primary"  onclick="javascript: window.location='/';" >Continue Shopping</button>-->
								<a href="<?php echo base_url(); ?>" class="btn btn-default">Continue Shopping</a>
								<button class="btn btn-primary"  onclick="javascript: window.location='/shop/checkout';" >Checkout</button></p>
                        </div>
						
						<div id="mobile-header" class="text-center" style="margin-bottom: 50px;"><br/>
                              Shipping and Taxes will be calculated during checkout<br/>
                              <p style="margin-top:5px;">
								<!--<button class="btn btn-primary"  onclick="javascript: window.location='/';" >Continue Shopping</button>-->
								<button class="btn btn-primary"  onclick="javascript: window.location='/shop/checkout';" style="width:100%;height:50px;font-size:25px;">Checkout</button></p>
                        </div>
						
				<?php }else{ ?>
				
					<br />
				
				<?php } ?>
                
            </div><!-- Page ends here //-->

            

      </div><!-- Container //-->
<div class="copyright text-center">
	
	<div class="row">
		<div class="col-lg-4">
		
		</div>
		<div class="col-lg-4">
			<p>Copyright 2015 MemorialFlowers.ca. All rights are reserved.</p>
		</div>
		<div class="col-lg-4">
		
		</div>
	</div>	
	<!--<small></small>-->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

