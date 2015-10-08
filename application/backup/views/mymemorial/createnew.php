<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>

<div id="content" class="clearfix">

    <div id="page">

		<table width="100%" border="0">
		
			<tr>
			
				<td width="40%">
					<h1>Create Order</h1>
				</td>
				
				<td width="60%">
					<!--<div id="MyLiveChatContainer"></div>
					<script type="text/javascript" src="https://mylivechat.com/chatbutton.aspx?hccid=73301220"></script>-->
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
																		<option value="<?php echo $price->price_id.'_'.$price->price_value_mymemorial; ?>"><?php echo $price->price_name.' - $'.$price->price_value_mymemorial; ?></option>
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
								
								<br />							
								
								
							
								
<script>													

function	populate_details(item_id)
{
	//alert($('#item1id').val());
	var item1id = $('#item1id').val();

	if( $('#copy_'+item_id).prop('checked') == true )
	{
		//var item1id = $('#item1id').val();		
	
		$('#rec_firstname'+item_id).val($('#rec_firstname'+item1id).val()); 
		$('#rec_lastname'+item_id).val($('#rec_lastname'+item1id).val()); 
		$('#order_po'+item_id).val($('#order_po'+item1id).val()); 
		$('#order_by'+item_id).val($('#order_by'+item1id).val()); 
		//$('#card_message'+item_id).val($('#card_message'+item1id).val());
		//$('#special_notes'+item_id).val($('#special_notes'+item1id).val());
		$('#ribbon_text'+item_id).val($('#ribbon_text'+item1id).val());		
		
		 var del_month1_sel =  $('#delivery_month'+item1id +' option:selected').text();	 
		 $('#delivery_month'+item_id +' option:selected').removeAttr('selected');
		 $('#delivery_month'+item_id + ' option').filter(function() { 
			 return ($(this).text() == del_month1_sel); //To select month
		 }).prop('selected', true); 
		 
		 var del_day1_sel =  $('#delivery_day'+item1id +' option:selected').text();
		 var del_day1_val =  $('#delivery_day'+item1id +' option:selected').val();		  
		 $('#delivery_day'+item_id ).append($("<option></option>").attr("value", del_day1_val).text(del_day1_sel).prop('selected', true));
		 
		 var del_time1_sel =  $('#delivery_time'+item1id +' option:selected').text();	 
		 $('#delivery_time'+item_id +' option:selected').removeAttr('selected');
		 $('#delivery_time'+item_id + ' option').filter(function() { 
			 return ($(this).text() == del_time1_sel); //To select time
		 }).prop('selected', true); 
		 
		 var ribbon_color1_sel =  $('#ribbon_color'+item1id +' option:selected').text();	 
		 $('#ribbon_color'+item_id +' option:selected').removeAttr('selected');
		 $('#ribbon_color'+item_id + ' option').filter(function() { 
			 return ($(this).text() == ribbon_color1_sel); //To select ribbon color
		 }).prop('selected', true); 
	 
	}
	else
	{
			
		$('#rec_firstname'+item_id).val(""); 
		$('#rec_lastname'+item_id).val(""); 
		$('#order_po'+item_id).val(""); 
		$('#order_by'+item_id).val(""); 
		$('#card_message'+item_id).val("");
		$('#special_notes'+item_id).val("");
		$('#ribbon_text'+item_id).val("");		
		
		
		 $('#delivery_month'+item_id +' option:selected').removeAttr('selected');
		 $('#delivery_month'+item_id + ' option').filter(function() { 
			 return ($(this).text() == "Month"); //To select month
		 }).prop('selected', true); 
		 
		 $('#delivery_day'+item_id +' option:selected').removeAttr('selected');
		 $('#delivery_day'+item_id + ' option').filter(function() { 
			 return ($(this).text() == "Day"); //To select month
		 }).prop('selected', true); 		 
		 
	 
		 $('#delivery_time'+item_id +' option:selected').removeAttr('selected');
		 $('#delivery_time'+item_id + ' option').filter(function() { 
			 return ($(this).text() == "Select Time"); //To select time
		 }).prop('selected', true); 		 
	 
		 $('#ribbon_color'+item_id +' option:selected').removeAttr('selected');
		 $('#ribbon_color'+item_id + ' option').filter(function() { 
			 return ($(this).text() == "No Ribbon"); //To select ribbon color
		 }).prop('selected', true); 
	}

	 
}
									
function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}

								
$(function(){	

//------------  Code For tabs 

	$("input[id^='tab']:checked + label").css({
			'background' : '#555555',
			'color': 'white',
			'top': '0'  
	});

	$("[id^='tab']:checked ~ [id^='tab-content']").css({
			'display' : 'block'
	});

	$("input[id^='tab']").on( "click", function() {
		
		$("div[id^='tab-content']").css('display' , 'none');
		 
		$("input[id^='tab'] + label").css({
			'background' : 'white',
			'color': '#555555'
		});
				 
		var selected_tab = "#tab"+$(this).attr('id').substring(3);
		selected_tab = selected_tab+" + label";
		$(selected_tab).css({
			'background' : '#555555',
			'color': 'white',
			'top': '0'  
		});
		
		var selected_content = "#tab-content"+$(this).attr('id').substring(3);
		
		 $(selected_content).css('display' , 'block');
		 
		 
	});	




//------------  Code For Populating Days

	$( '.sel-del-month' ).on( "change", function() {
		var day_sel = "#delivery_day"+$(this).attr('id').substring(14);	
		
		var month = $(this).val();
		var num_days = daysInMonth(month, 2014)	;	
			
		$(day_sel).empty();
		$(day_sel).append($("<option></option>").attr("value", "").text("Day"));
		for(var  i = 1; i <= num_days; i++) {    		
			$(day_sel).append($("<option></option>").attr("value", i).text(i));
		}
	});


//------------  Code For Delivery Details Validation
								
	$('#btnSubmit').click(function(event){   
   	 	var items_count = ord_item_id.length;	 	 	
     	alert_text = "";
		
		for ( var i = 0; i < items_count; i++ ) 
		{ 	
			var item_alert = "";
			var item_no =  i+1; 			
			var text_val = $('#ribbon_text'+ord_item_id[i]).val();
			
			 if(  $('#rec_firstname'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please give 'Recipient Firstname ' for Item #"+ item_no +"\n";						
			 }
			 if(  $('#rec_lastname'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please give 'Recipient Lastname ' for Item #"+ item_no +"\n";						
			 }			
			
			 if(  $('#delivery_month'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please select 'Delivery Month' for Item #"+ item_no +"\n";						
			 }
			 
			 if(  $('#delivery_day'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please select 'Delivery Day' for Item #"+ item_no +"\n";						
			 }
			 
			 if(  $('#delivery_time'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please select 'Delivery Time' for Item #"+ item_no +"\n";						
			 }
			 
			 if(  $('#order_po'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please give 'Order PO' for Item #"+ item_no +"\n";						
			 }	
			 
			 if(  $('#order_by'+ord_item_id[i]).val() == "" )
			 {				 
				 item_alert += " Please give 'Order By' for Item #"+ item_no +"\n";						
			 }
						 
			 if(  $('#ribbon_color'+ord_item_id[i]).val() == "No Ribbon"  &&  text_val != "" )
			 {				 
				 item_alert += " Please select 'Ribbon Color' for Item #"+ item_no +"\n";						
			 }			 	 
			 
			 if(  $('#ribbon_color'+ord_item_id[i]).val() != "No Ribbon"  &&  text_val == "" )
			 {				 
				 item_alert += " Please select 'Ribben Text' for Item #"+ item_no +"\n";						
			 }					 
			 
			 if(item_alert != ""  )
			 {
				if( items_count > 1  )
				{
				 item_alert = "For ITEM #"+item_no+"\n --------------------\n"+item_alert;
				}
				alert_text += item_alert+"\n";
			 }
		}
	 
			if(alert_text != "")
			{
				alert_text = "PLEASE GIVE THE FOLLOWING DETAILS \n \n"+alert_text; 
				alert(alert_text );
				return false;
			}
			
			
	 
	})
})

var ord_item_id = [];	// to store orderitem_id																
								</script>
								
								
								
								
								
								
								
								
			<?php echo form_open('/mymemorial/orders/createnew_submitorder',array('class'=>'form-search')); ?>
								
								
								<h2><b>2. </b>Delivery Details</h2>
								
								
								<?php if($items){ ?>
										
								<div style="padding-left:30px;">
								
							
								<table width="100%" border="0">
									
									<tr>
										
										<td width="100%" height="900" valign="top">
										
											<ul class="tabs">
												<?php $i = 1; ?>
                  <input type="hidden" id="item1id" value="<?php echo $items[0]->orderitem_id; ?>"   />                           
												<?php foreach($items as $item){ ?>
												<li>
													<input type="radio" <?php if($i==1){ echo 'checked'; } ?> name="tabs" id="tab<?php echo $item->orderitem_id; ?>">
													<label for="tab<?php echo $item->orderitem_id; ?>">
														<!--<img src="<?php echo base_url(); ?>productres/<?php echo $item->product_picture; ?>" style="width:20px; height:20px;">-->
														<?php echo 'Item #'.$i; ?>
													</label>
													<div id="tab-content<?php echo $item->orderitem_id; ?>" class="tab-content animated fadeIn">
														
														<table width="100%" border="0">
                                                        
<?php 
if($i > 1)
{
?>                                                        
<tr style="text-align:center">
<td colspan="3">
<div style=" padding: 5px; background-color: rgb(240, 240, 240); border-radius: 5px;">
<input type="checkbox"  name="copy_<?php echo $item->orderitem_id; ?>" id="copy_<?php echo $item->orderitem_id; ?>"  onClick="populate_details('<?php echo $item->orderitem_id; ?>');"/> <span style="vertical-align: middle; padding-top: 5px;">Copy Delivery Details From Item #1</span>
</div>
</td>
</tr>
<?php 
}
?>
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
                                                                    
                                                                    


<!--

First Name
 <input type="text" id="affi_firstname<?php echo $item->orderitem_id; ?>" name="affi_firstname<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_firstname; ?>" style="width:85%;">	
Last Name 
  <input type="text" id="affi_lastname<?php echo $item->orderitem_id; ?>" name="affi_lastname<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_lastname; ?>" style="width:85%;">
Address Line 1  
  <input type="text" id="affi_address1<?php echo $item->orderitem_id; ?>" name="affi_address1<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_address1; ?>" style="width:85%;">  														
Address Line 2  
  <input type="text" id="affi_address2<?php echo $item->orderitem_id; ?>" name="affi_address2<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_address2; ?>" style="width:85%;">  																	
City																	
  <input type="text" id="affi_city<?php echo $item->orderitem_id; ?>" name="affi_city<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_city; ?>" style="width:85%;">
Province																	
  <input type="text" id="affi_province<?php echo $item->orderitem_id; ?>" name="affi_province<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_province; ?>" style="width:85%;">
Postal Code																	
  <input type="text" id="affi_postalcode<?php echo $item->orderitem_id; ?>" name="affi_postalcode<?php echo $item->orderitem_id; ?>" value="<?php echo $affiliate->user_postalcode; ?>" style="width:85%;">

-->



                                                                    
                                                                    
                                                                    
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
															
								<select style="width:100%;" id="delivery_month<?php echo $item->orderitem_id; ?>" name="delivery_month<?php echo $item->orderitem_id; ?>" class="sel-del-month">
																					<option value="">Month</option>
																					<option value="01">January</option>
																					<option value="02">February</option>
																					<option value="03">March</option>
																					<option value="04">April</option>
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
																					    <?php for($t=1;$t<=31;$t++) { 
																									$t = ($t < 10)? '0'.$t :  $t;
																							?>
																						 
																								<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
																								<?php } ?>
																							</select>
																							
																						</td>
																						
																						<td width="33%">
																							
																							<input type="hidden" id="delivery_year<?php echo $item->orderitem_id; ?>" name="delivery_year<?php echo $item->orderitem_id; ?>" value="2015" style="width:85%;">
																							
																							<input type="text" id="" name="" value="2015" disabled style="width:85%;">
																							
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
																				<textarea rows="9" cols="50" style="width:95%;" id="card_message<?php echo $item->orderitem_id; ?>" name="card_message<?php echo $item->orderitem_id; ?>"></textarea> 
																				
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
																				<textarea rows="9" cols="50" style="width:95%;" id="special_notes<?php echo $item->orderitem_id; ?>" name="special_notes<?php echo $item->orderitem_id; ?>"></textarea> 
																				
																				
																			
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
																				<textarea rows="4" cols="50" id="ribbon_text<?php echo $item->orderitem_id; ?>" name="ribbon_text<?php echo $item->orderitem_id; ?>" style="width:95%;height:60px;color:#EED5B7;background-image: url(<?php echo base_url(); ?>images/ribbon2.png);"  ></textarea>	
																			</td>
																		
																		</tr>
																	
																	</table>
																	<br />
																	
																
																</td>
																
															</tr>
															
															
														</table>	
<script>
  ord_item_id.push( "<?php echo $item->orderitem_id;?>") ;
</script>													</div>
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
								
								
								<table width="100%">
									<tr>
										<td width="58%">
											<h2><b>3. </b>Affiliate Information</h2>
										</td>
										<td width="42%">
											<h2><b>4. </b>Confirmation Email</h2>
										</td>
									</tr>
								</table>
								
								
								
								<div style="padding-left:30px;">
								
							
								<table width="100%" border="0">
									
									<tr>
										
										<td width="60%" valign="top">
										
											<p style="font-size:23px;line-height:105%;">
												<?php echo $affiliate->user_firstname.' '.$affiliate->user_lastname; ?><br />
												<?php echo $affiliate->user_address1; ?> <?php echo $affiliate->user_address2; ?><br />
												<?php echo $affiliate->user_city; ?>, <?php echo $affiliate->user_province; ?> <br />
												<?php echo $affiliate->user_postalcode; ?> Canada
											</p>
								
										</td>
										<td width="40%" valign="top" align="center">
											
											<br />
											
											<input type="text" id="custo_email" name="custo_email" value="" required style="width:90%;text-align:center;font-size:15px;font-weight:bold;border:2px solid #3299CC;">
										
											<p style="font-size:17px;color:#8E2323;font-weight:bold;">
												An order confirmation email will be sent to:<br />
												<span style="font-weight:normal;">(Mandatory Field)</span>
											</p>
											
										</td>
								
									</tr>
								
								</table>
								
								</div>
								
								
								
								<br /><br />
								
								
								
								
								
								
								
								<div style="width:100%; text-align:right;">
									<button type="submit" name="submit" id="btnSubmit" class="btn btn-success" style="font-size:30px;padding:3px 3px 3px 3px;height:60px;width:320px;">Save & Submit Order</button>              
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