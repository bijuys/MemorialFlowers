<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>

<div id="content" class="clearfix">

    <div id="page">

		<table width="100%" border="0">
		
			<tr>
			
				<td width="40%">
					<h1>Create Order</h1>
				</td>
				
				<td width="60%">
					<!--Chat button will appear here--> <div id="MyLiveChatContainer"></div>
					<!--Add the following script at the bottom of the web page (before </body></html>)-->
					<script type="text/javascript" src="https://mylivechat.com/chatbutton.aspx?hccid=73301220"></script>
				</td>
				
			</tr>
		
		</table>
		
		
		
			
			
			
		
        	<div class="contents">
				
				<div id="table-wrapper">
					
					<table width="100%" border="0">
					
						<tr>
						
							<td width="72%">
							
								<h2><b>1. </b>Select Product(s)</h2>
							
								<div style="padding-left:30px;">
							
									<div id="order_search">
										<?php echo form_open('/mymemorial/orders/createnew_order',array('class'=>'form-search')); ?>
											<input type="text" name="product_sear" id="product_sear" value="" placeholder="Product Code or Name" style="width:300px;" />
											<button type="submit" name="submit" class="btn btn-success">Search</button>              
										<?php echo form_close();?>
									</div>
									
									<?php if($products){ ?>
									<div class="tablebg">
						
										<table width="100%" border="0">
										
											<tr>
											
												<td width="100%">
												
													<table class="table table-hover">
														<thead>
															<tr style="text-align:center; background-color:#A9A9A9;">
																<th style="text-align:center; color:#2E2E2E; font-weight:bold;" width="15%">Code</th>
																<th style="text-align:center; color:#2E2E2E; font-weight:bold;" width="30%">Name</th>
																<th style="text-align:center; color:#2E2E2E; font-weight:bold;" width="10%">Image</th>
																<th style="text-align:center; color:#2E2E2E; font-weight:bold;" width="20%">Price</th>
																<th style="text-align:center; color:#2E2E2E; font-weight:bold;" width="25%">Action</th>
															</tr>
														</thead>
														<tbody>
														<?php foreach($products as $product){ ?>
														<?php echo form_open('/mymemorial/orders/createnew_additem',array('class'=>'form-search')); ?>
														<tr>
															<td class="first" style="text-align:center;vertical-align:middle;">
																<input type="hidden" id="pro_id" name="pro_id" value="<?php echo $product->product_id; ?>">
																<input type="hidden" id="pro_na" name="pro_na" value="<?php echo $product->product_name; ?>">
																<?php echo $product->product_code; ?>
															</td>
															<td class="first" style="vertical-align:middle;">
																<?php echo $product->product_name; ?>
															</td>
															<td class="first" style="text-align:center;vertical-align:middle;">
																<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture; ?>" width="40" height="40" style="width:40px; height:40px;">
															</td>
															<td class="first" style="text-align:center;">
																<?php $prices = $this->Invoice_model->get_product_prices($product->product_id); ?>
																<select style="width:100%;" id="pro_pr" name="pro_pr">
																	<?php foreach($prices as $price){ ?>
																		<option value="<?php echo $price->price_id.'_'.$price->price_value; ?>"><?php echo $price->price_name.' - $'.$price->price_value; ?></option>
																	<?php } ?>
																</select> 
															</td>
															<td class="first" style="text-align:center;vertical-align:middle;">
																<button type="submit" name="submit" class="btn btn-success">Add to Cart</button>
															</td>
														</tr>
														<?php echo form_close();?>
														<?php } ?>
														</tbody>
													</table>
												
												</td>
												
											</tr>
										
										</table>
									
									</div>
									<?php } ?>
									
									<div class="pagenav">
									<?php //echo $links; ?> <?php //echo $totalpages.' Orders in Total'; ?>
									</div>
									
									<!--<br /><br />
									<span style="font-size:25px; color:red;">NOTE: Please, search and select all the items you wish to purchase!</span>-->	
								
								</div>
								
								<br /><br />							
								
								
								
								
								
								
								
								
								<script>
																
									function changeMonth(id,id2){
								
										var max = 31;
										var month = document.getElementById('delivery_month'+id2).value;
										var days = document.getElementById('delivery_day'+id2);
										
										//GET CURRRENT MONTH
										var da = new Date();
										var m = da.getMonth()+1;
										var d = da.getDate();
										var h = da.getHours()
										
										if(m<10){
											m = '0'+m;	
										}else{
											m = m;
										}
										
										
										
										if(month==m){
											if(h<13){
												
												for (var i = d; i<=max; i++){
											
													var opt = document.createElement('option');
													
													if(i<10){
														opt.value = '0'+i;
														opt.innerHTML = '0'+i;
														days.appendChild(opt);	
													}else{
														opt.value = i;
														opt.innerHTML = i;
														days.appendChild(opt);
													}
													
													
												
												}
												
											}else{
											
												for (var i = d+1; i<=max; i++){
											
													var opt = document.createElement('option');
													
													if(i<10){
														opt.value = '0'+i;
														opt.innerHTML = '0'+i;
														days.appendChild(opt);	
													}else{
														opt.value = i;
														opt.innerHTML = i;
														days.appendChild(opt);
													}
												
												}
											
											}
										}else{
										
											for (var i = 1; i<=max; i++){
											
												var opt = document.createElement('option');
													
													if(i<10){
														opt.value = '0'+i;
														opt.innerHTML = '0'+i;
														days.appendChild(opt);	
													}else{
														opt.value = i;
														opt.innerHTML = i;
														days.appendChild(opt);
													}
													
													
												
											}
											
										}
																		
										//alert(month+'_'+m+'_'+d+'_'+h);
										
										/*if()	
										for (var i = min; i<=max; i++){
											
											var opt = document.createElement('option');
											opt.value = i;
											opt.innerHTML = i;
											days.appendChild(opt);
										
										}*/
									
									}	
																
								</script>
								
								
								
								
								
								
								<h2><b>2. </b>Delivery Details</h2>
								
								<?php echo form_open('/mymemorial/orders/createnew_submitorder',array('class'=>'form-search')); ?>
								
								<?php if($items){ ?>
										
								<div style="padding-left:30px;">
								
								
								<table width="100%" border="0">
									
									<tr>
										
										<td width="100%" height="900" valign="top">
										
											<ul class="tabs">
												<?php $i = 1; ?>
												<?php foreach($items as $item){ ?>
												<li>
													<input type="radio" <?php if($i==1){ echo 'checked'; } ?> name="tabs" id="tab<?php echo $item->orderitem_id; ?>">
													<label for="tab<?php echo $item->orderitem_id; ?>">
														<!--<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:20px; height:20px;">-->
														<?php echo 'Item #'.$i; ?>
													</label>
													<div id="tab-content<?php echo $item->orderitem_id; ?>" class="tab-content animated fadeIn">
														
														<table width="100%" border="0">

															<tr>
															
																<td width="32%" valign="top">
																	
																	<h3>Deliver To:</h3>
																	Recipient Firstname <input type="text" id="rec_firstname<?php echo $item->orderitem_id; ?>" name="rec_firstname<?php echo $item->orderitem_id; ?>" value="" style="width:85%;">
																	Recipient Lastname <input type="text" id="rec_lastname<?php echo $item->orderitem_id; ?>" name="rec_lastname<?php echo $item->orderitem_id; ?>" value="" style="width:85%;">
																	<br /><br />
																	
																	<h3>Ship To:</h3>
																	<!--Funeral Home <input type="text" value="2014" style="width:85%;">
																	Address Line 1 <input type="text" value="2014" style="width:85%;">
																	Address Line 2 <input type="text" value="2014" style="width:85%;">
																	City <input type="text" value="2014" style="width:85%;">
																	Province <input type="text" value="2014" style="width:85%;">
																	Postal Code <input type="text" value="2014" style="width:85%;">-->
																	<p style="line-height:100%; font-size:18px;">
																	<?php echo $affiliate->user_firstname.' '.$affiliate->user_lastname; ?><br />
																	<?php echo $affiliate->user_address1; ?><br />
																	<?php echo $affiliate->user_address2; ?><br />
																	<?php echo $affiliate->user_city; ?>, <?php echo $affiliate->user_province; ?> <?php echo $affiliate->user_postalcode; ?><br />
																	</p>
																	<br />
																	
																	<h4><?php echo $item->product_name; ?></h4>
																	<!--<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:20px; height:20px;">-->
																	<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:220px; height:230px;">
																	<h4 style="color:red;">Code: <?php echo $item->product_code; ?></h4>
																	
																</td>
																
																<td width="2%">
																
																</td>
																
																
																
																
																
																<td width="66%" valign="top">
																
																	<table width="100%">
																	
																		<tr>
																		
																			<td width="49%" valign="top">
																			
																				<h3>Delivery Date</h3>
																				<table>
																					<tr>
																						<td width="34%">
																						
																							<select style="width:100%;" onchange="changeMonth(this.value,<?php echo $item->orderitem_id; ?>)" id="delivery_month<?php echo $item->orderitem_id; ?>" name="delivery_month<?php echo $item->orderitem_id; ?>">
																								<option value="">Month</option>
																								<option value="05">May</option>
																								<option value="06">June</option>
																								<option value="07">July</option>
																								<option value="08">August</option>
																								<option value="09">September</option>
																								<option value="10">October</option>
																								<option value="11">November</option>
																								<option value="12">December</option>
																							</select>
																							
																						</td>
																						
																						<td width="33%">
																							
																							<select style="width:100%;" id="delivery_day<?php echo $item->orderitem_id; ?>" name="delivery_day<?php echo $item->orderitem_id; ?>">
																								<option value="">Day</option>
																								<!--<?php for($t=1;$t<=31;$t++) { ?>
																									<?php if($t < 10){ 
																											$t = '0'.$t;
																										}else{
																											$t = $t;
																										}
																									?>
																									<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
																								<?php } ?>-->
																							</select>
																							
																						</td>
																						
																						<td width="33%">
																						
																							<input type="text" value="2014" style="width:85%;" disabled>
																							
																						</td>
																					</tr>
																				</table>
																				
																				<br />
																				<h3>Delivery Time</h3>
																				<select style="width:100%;" id="delivery_time<?php echo $item->orderitem_id; ?>" name="delivery_time<?php echo $item->orderitem_id; ?>">
																					<option value="">Select Time</option>
																					<?php for($t=7;$t<=11;$t++) { ?>
																						<?php $time = $t.'am'; ?>
																						<option value="<?php echo $time; ?>"><?php echo $time; ?></option>
																					<?php } ?>
																					<option value="12pm">12pm</option>
																					<?php for($t=1;$t<=11;$t++) { ?>
																						<?php $time = $t.'pm'; ?>		
																						<option value="<?php echo $time; ?>"><?php echo $time; ?></option>
																					<?php } ?>
																				</select>	
																				
																				<br /><br />
																				<h3>Card Message</h3>
																				<textarea rows="9" cols="50" style="width:95%;" id="card_message<?php echo $item->orderitem_id; ?>" name="card_message<?php echo $item->orderitem_id; ?>">
																				</textarea> 
																				
																				<br />
																					
																			
																			</td>
																			
																			<td width="2%">
																			
																			</td>
																			
																			<td width="49%" valign="top">
																			
																				<h3>Order PO</h3>
																				<input type="text" value="" style="width:95%;" id="order_po<?php echo $item->orderitem_id; ?>" name="order_po<?php echo $item->orderitem_id; ?>">
																				
																				<br /><br />
																				<h3>Order By</h3>
																				<input type="text" value="" style="width:95%;" id="order_by<?php echo $item->orderitem_id; ?>" name="order_by<?php echo $item->orderitem_id; ?>">	
																				
																				<br /><br />
																				<h3>Special Notes</h3>
																				<textarea rows="9" cols="50" style="width:95%;" id="special_notes<?php echo $item->orderitem_id; ?>" name="special_notes<?php echo $item->orderitem_id; ?>">
																				</textarea> 
																				
																				
																			
																			</td>
																		
																		</tr>
																		
																		<tr>
																		
																			<td colspan="3">
																			
																				<h3>Ribbon</h3>
																				Ribbon Color
																				<br />
																				<select style="width:50%;" id="ribbon_color<?php echo $item->orderitem_id; ?>" name="ribbon_color<?php echo $item->orderitem_id; ?>">
																					<option value="No Ribbon">No Ribbon</option>
																					<option value="Match to Item">Match to Item</option>
																					<option value="White">White</option>
																					<option value="Red">Red</option>
																					<option value="Blue">Blue</option>
																					<option value="Pink">Pink</option>
																					<option value="Yellow">Yellow</option>
																					<option value="Dark Blue">Dark Blue</option>
																					<option value="Peach">Peach</option>
																					<option value="Purple">Purple</option>
																					<option value="Burgundy">Burgundy</option>
																					<option value="Lavender">Lavender</option>
																					
																				</select>
																				
																				<br /><br />
																				Ribbon Text
																				<textarea rows="4" cols="50" style="width:95%;height:50px;color:#EED5B7;background-image: url(<?php echo base_url(); ?>images/ribbon2.png);" id="ribbon_text<?php echo $item->orderitem_id; ?>" name="ribbon_text<?php echo $item->orderitem_id; ?>">
																				</textarea>	
																			</td>
																		
																		</tr>
																	
																	</table>
																	<br />
																	
																
																</td>
																
															</tr>
															
															
														</table>	
														
													</div>
												</li>
												<?php $i=$i+1; } ?>
												
											</ul>
											
										</td>
											
									</tr>
									
								</table>
								
								<div class="pagenav">
								<?php //echo $links; ?> <?php //echo $totalpages.' Orders in Total'; ?>
								</div>
								
								</div>	
								
								
								
								
								<div style="width:100%; text-align:right;">
									<button type="submit" name="submit" class="btn btn-success" style="font-size:30px;padding:3px 3px 3px 3px;height:60px;width:320px;">Save & Submit Order</button>              
								</div>
								
								<?php }else{ ?>	
								
									<div style="padding:0px 0px 0px 30px;">	
										<b>No products were found in your cart!</b>
									</div>	
									
								<?php } ?>	
								
								<?php echo form_close();?>
								
							
							</td>
							
							<td width="2%">
							
							</td>
							
							<td width="26%" valign="top" align="left">
							
								<h2>Your Cart</h2>
								
								<?php if($items){ ?>
								
									<table width="100%">
										
										<?php $sub_total = 0; ?>
										<?php foreach($items as $item){ ?>
										<tr>
										
											<td width="3%">
										
											</td>
											
											<td width="40%" align="center" class="first">
											
												<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:100px; height:120px;" title="<?php echo $item->product_code.' | '.$item->product_name; ?>" alt="<?php echo $item->product_code.' | '.$item->product_name; ?>">
										
											</td>
											
											<td width="3%">
										
											</td>
											
											<td width="51%" align="center" valign="middle">
										
												<h3>$<?php echo $item->product_price; ?></h3>
												
												<a href="<?php echo base_url(); ?>mymemorial/orders/createnew_removeitem/<?php echo $item->orderitem_id; ?>" style="color:red;">Remove Item</a>
										
											</td>
											
											<td width="3%">
										
											</td>
										
										</tr>
										<?php $sub_total = $sub_total + $item->product_price; ?>
										<?php } ?>
										
									</table>
									
									<?php 
										$tax_rate = 0.13; 
										$taxes = $sub_total*$tax_rate;
									?>
									
									<br /><br />
									
									<div style="border-top:2px solid #5C5C5C;">
									<table width="100%">
										
										<tr>
										
											<td width="3%">
										
											</td>
											
											<td width="40%" align="right" valign="middle">
											
												<h3>Sub-total</h3>
											
											</td>
											
											<td width="3%">
											
											</td>
											
											<td width="51%"  valign="middle" align="center">
											
												<span style="font-size:20px;">$</span><input type="text" style="width:50%;font-size:20px;text-align:right;" value="<?php echo $sub_total; ?>" id="sub_total" name="sub_total" disabled>
											
											</td>
											
											<td width="3%" >
											
											</td>
										
										</tr>
										
										<tr>
										
											<td width="3%">
										
											</td>
											
											<td align="right" valign="middle">
											
												<h3>Taxes</h3>
											
											</td>
											
											<td>
											
											</td>
											
											<td valign="middle" align="center">
											
												<span style="font-size:20px;">$</span><input type="text" style="width:50%;font-size:20px;text-align:right;" value="<?php echo number_format($taxes,2); ?>" id="taxes" name="taxes"  disabled>
											
											</td>
											
											<td>
											
											</td>
										
										</tr>
										
										<tr>
										
											<td width="3%">
										
											</td>
											
											<td align="right" valign="middle">
											
												<h3 style="color:red;">Total</h3>
											
											</td>
											
											<td>
											
											</td>
											
											<td valign="middle" align="center">
											
												<span style="font-size:20px;color:red;">$</span><input type="text" style="width:50%;font-size:20px;text-align:right;color:red;" value="<?php echo number_format(($sub_total+$taxes),2); ?>" disabled>
											
											</td>
											
											<td>
											
											</td>
										
										</tr>
									
									</table>
									</div>
									
								<?php }else{ ?>	
									
									<div style="text-align:center;">	
										<b>Your cart is empty!</b>
									</div>	
								
								<?php } ?>	
							
							</td>
						
						</tr>
					
					
					</table>

					
					
					
					
					
					
					
				</div>
			  
			</div>
			

			 
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>

<style>
 .tabs input[type=radio] {
          position: relative;
          top: -9999px;
          left: -9999px;
      }
      .tabs {
        width: 100%;
        list-style: none;
        position: relative;
        padding: 0;
        margin: 0px 0px;
      }
      .tabs li{
        float: left;
      }
      .tabs label {
          display: block;
          padding: 10px 20px;
          border-radius: 2px 2px 0 0;
          color: #555555;
          font-size: 24px;
          font-weight: normal;
          font-family: 'Lily Script One', helveti;
          background: rgba(255,255,255,0.2);
          cursor: pointer;
          position: relative;
          top: 3px;
          -webkit-transition: all 0.2s ease-in-out;
          -moz-transition: all 0.2s ease-in-out;
          -o-transition: all 0.2s ease-in-out;
          transition: all 0.2s ease-in-out;
      }
      .tabs label:hover {
        background-color: #707070;
		color:#fff;
        top: 0;
      }
       
      [id^=tab]:checked + label {
        background: #555555;
        color: white;
        top: 0;
      }
       
      [id^=tab]:checked ~ [id^=tab-content] {
          display: block;
      }
      .tab-content{
        z-index: 2;
        display: none;
        text-align: left;
        width: 100%;
        font-size: 20px;
        line-height: 140%;
        padding-top: 10px;
        border: 1px solid #555555;
		background: #fff;
        padding: 15px;
        color: #555555;
        position: absolute;
        top: 53px;
        left: 0;
        box-sizing: border-box;
        -webkit-animation-duration: 0.5s;
        -o-animation-duration: 0.5s;
        -moz-animation-duration: 0.5s;
        animation-duration: 0.5s;
      }
</style>