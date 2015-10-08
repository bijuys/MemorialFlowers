<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<section class="promo_box-mf">
			<div id="responsive" class="container">
				<div class="row" id="orderbyphone" style="margin-top:20px;">
					<div class="col-sm-4 col-md-4 col-lg-4" style="padding-top:8px;">
						<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
							Order by Phone: 1-877-537-8610
						</span>
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5 text-center">
						<?php
						if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
						?>			
						<table width="100%" border="0">
							<tr>
								<td width="50%">
									<div style="padding-top:8px;">
										<img src="<?php echo base_url(); ?>images/in-memory-of.png" width="100%" />
									</div>
								</td>
								<td width="50%" align="left" style="padding-left:10px;">
									<?php
									$json = file_get_contents('http://www.legacy.com/webservices/ns/FuneralInfo.svc/GetFuneralInfoJson?fhid='.$this->session->userdata('fhid').'&cobrand='.$this->session->userdata('cobrand').'&pid='.$this->session->userdata('pid'));
									$obj = json_decode($json);
										/*
										echo $this->session->userdata('fhid').'_'.$this->session->userdata('cobrand').'_'.$this->session->userdata('pid').'_____________';
										echo $json;
										*/
										
										echo '<div style="font-weight:bold;margin-top:5px;font-size:18px;color:#000;">'.ucwords(strtolower($obj->Obituary->FirstName.' '.$obj->Obituary->LastName)).'</div>';
									?> 
								</td>
							</tr>
						</table>
						<?php 
						}
						?>
						
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
							<div>
								<input class="input-text"  name="search" id="s" style="width:75%;" placeholder="Search products ..." type="text">
								<input id="searchsubmit" value="Search" type="submit" class="pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="row" id="mobile-header" style="background-color:#8D0352;">
				<div class="col-lg-12">
					<table width="100%">
						<tr height="60">
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a style="color:inherit;" onClick="openMenu();">
										<i style="font-size:2.0em;color:#fff;" class="fa fa-bars"></i>
									</a>
								</div>	
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a style="color:inherit;" onClick="openSearch();">
										<i style="font-size:2.0em;color:#fff;" class="fa fa-search"></i>
									</a>
								</div>
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<?php if($tcart->items>0){ ?>
									<div style="margin-top:0px;">
										<a href="<?php echo base_url('shop/cart'); ?>" style="color:inherit;">
											<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
											<div style="font-size:13px;font-weight:bold;color:#8D0352;margin:-29px 0px 0px 6px;">
												<?php echo isset($tcart) ? $tcart->items:'0'; ?>
											</div>
										</a>
									</div>
								<?php }else{ ?>
									<div style="margin-top:0px;">
										<a style="color:inherit;">
											<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
											<div style="font-size:13px;font-weight:bold;color:#fff;margin:-29px 0px 0px 6px;">
												0
											</div>
										</a>
									</div>	
								<?php } ?>
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a href="tel:1-877-537-8610" style="color:inherit;">
										<i style="font-size:2.3em;color:#fff;" class="fa fa-phone"></i>
									</a>
								</div>
							</td>
						</tr>	
					</table>
				</div>
				<div class="col-lg-12" id="sear" style="margin-top:-9px;display:none;height:52px;">
					<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
						<div style="padding-bottom:-20px;">
							<input class="input-text" style="width:100%;height:50px;font-size:18px;text-align:center;padding-bottom:-8px;border:2px solid #8D0352;" name="search" id="search" placeholder="Enter product code or name ..." type="text">
							<!--<input id="searchsubmit" value="Search" type="submit" class="pull-right">-->
						</div>
					</form>
				</div>
				<div class="col-lg-12" id="men" style="background-color:#242E30;margin-top:0px;display:none;">
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(1);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> For Funeral Home </div>
								</a>
							</td>
						</tr>
					</table>
					
					<div id="l1" style="display:none;">
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Standing Sprays</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Wreaths & Hearts</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Tributes</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/urn-spray" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Urn Sprays</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>
						
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(2);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> For Home & Office </div>
								</a>
							</td>
						</tr>
					</table>
						
					<div id="l2" style="display:none;">	
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Vase Arrangements</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Sympathy Baskets</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/bouquets" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Bouquets</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>	
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(3);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> Colours Collection </div>
								</a>
							</td>
						</tr>
					</table>

					<div id="l3" style="display:none;">
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/white" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">White</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/blue" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Blue</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/lavender" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Lavender</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/pink" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Pink</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/bright" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Bright</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/pastel" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Pastel</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/yellow" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Yellow</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/peach" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Peach</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/red" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Red</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>	
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(4);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> By Price Range </div>
								</a>
							</td>
						</tr>
					</table>
					
					<div id="l4" style="display:none;">	
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/1/100" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$1 - $100</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/101/200" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$101 - $200</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/201/300" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$201 - $300</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/301/500" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$301 - $500</div>
									</a>	
								</td>
							</tr>
						</table>	
					</div>
					
				</div>
				<script>
					function openSearch(){
						document.getElementById('men').style.display = "none";
						if($('#sear:visible').length == 0){
							document.getElementById('sear').style.display = "block";
						}else{
							document.getElementById('sear').style.display = "none";
						}
					}
					function openMenu(){
						document.getElementById('sear').style.display = "none";
						if($('#men:visible').length == 0){
							document.getElementById('men').style.display = "block";
						}else{
							document.getElementById('men').style.display = "none";
						}
					}
					function dropMenu(id){
						if($('#l'+id+':visible').length == 0){
							document.getElementById('l'+id).style.display = "block";
						}else{
							document.getElementById('l'+id).style.display = "none";
						}
					}
					
				</script>
			</div>
		</section>
		
		<section class="content about" style="margin-top:-25px;margin-bottom:-70px;">
			<div class="container">
			
				<?php echo form_open_multipart(current_url(), 'id="site-searchform"'); ?>
				
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4><?php echo ucwords(strtolower(rightLang($product->product_name,$product->product_name_fr)));?> </h4>
							<div class="gDot"></div>
						</div>
					</div>
					
					<div class="col-lg-1">
							
					</div>
					
					<div class="col-lg-5">
						<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture;?>" alt="profile img" width="100%" height="100%" />
						<div class="profile text-center">
							<span style="font-size:15px;font-weight:900;"><?php echo $product->product_code;?></span>
						</div>
							
						<br />
						
						<div class="row" id="simi_pro">
						<?php foreach($sameitems as $row){ ?>
							<div class="col-lg-4 text-center">
								<a href="<?php echo base_url().$row->url; ?>" style="color:inherit;">
									<img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" width="100%" height="110" />
									<br />
									<span style="font-weight:500;"><?php echo getRate($row->price_value); ?></span>
									<br />
									<a href="<?php echo base_url().$row->url;?>" class="btn btn-small btn-block btn-success"><i class="fa fa-search"></i>View</a>
								</a>	
							</div>	
						<?php } ?>
						</div>
					</div>
					
					<div class="col-lg-5">
						
						<input type="hidden" name="product_id" value="<?php echo $product->product_id;?>" />
						<input type="hidden" name="category" value="<?php echo $category;?>" />
			   
						
						<span id="price_se" name="price_se" style="font-size:35px;font-weight:790;padding:5px 5px 5px 5px;" class="pull-right"><?php echo getRate($product->prices[0]->price_value-($product->prices[0]->price_value*$this->session->userdata('disco')));?></span>
						<br /><br />
						<div style="margin-top:20px;">
							<span style="font-size:20px;font-weight:780;">Choose Size:</span>
						</div>
						
						<table width="100%" style="margin-top:10px;">
						<?php
						$ct = 0;
						foreach($product->prices as $prc) {
						$ct++;                               
						?>	
							<tr height="30">
								<td width="10%">
									<input type="radio" name="price_id" id="price_<?php echo $prc->price_id;?>" onClick="selectPrice('<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>');" value="<?php echo $prc->price_id; ?>" <?php echo $ct==1 ? 'checked="checked"':'';?> />
								</td>
								<td width="90%">
									<span style="font-size:15px;">
										<?php echo lang($prc->price_name); ?>
										<span style="color:#E74C3C;">(<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>)</span>
									</span>	
								</td>
							</tr>
						<?php 
						} 
						?>
						</table>
						<div style="margin-top:30px;">
							<span style="font-size:20px;font-weight:780;">Select Delivery Date:</span>
						</div>
						<div id="delidrop" class="row" style="margin-top:10px;">
							<div class="col-lg-8">
								<select name="upcoming" id="upcoming"  onchange="upcoming_date(this.value);" style="height:40px;width:100%;">
									<option value=""><?php echo lang('Choose delivery date');?></option>
									<?php $dates = get_dates($product->delivery_method_id,30);
										foreach($dates as $day) { ?>
										<option value="<?php echo date('d-m-Y',strtotime($day)); ?>"><?php echo date('l, d F',strtotime($day));?></option>
									<?php   } ?>
									<optgroup label="....................................." class="vical"></optgroup>
									<option value="cal"><?php echo lang('View calendar');?></option>
								</select>
								<input type="hidden" id="delivery_date" name="delivery_date" value="" />
							</div>
							<div class="col-lg-4">
								<!--
								<a href="#calendar" name="datepick" id="datepick" class="btn btn-medium btn-block btn-info"><i class="fa fa-calendar"></i>Calendar</a>
								<input type="hidden" id="delivery_date" name="delivery_date" value="" />
								-->
							</div>
						</div>
						<br/>
						<div class="row" style="display:none;">
							<div class="col-sm-8">
								<a name="datepick" id="datepick" href="#myModal" class="btn btn-success btn-large" role="button" data-toggle="modal">
									<i class="fa fa-calendar"></i> &nbsp; Pick A Delivery Date &nbsp;
								</a> 
							</div>
							<div class="col-sm-4">
								<input type="hidden" id="show_date2" readonly size="30" style="background:transparent; border: none;" />
							</div>
						</div>

						<!-- Modal HTML -->

					    <div id="myModal" class="modal fade">
					        <div class="modal-dialog">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                    <h4 class="modal-title">Choose Delivery Date</h4>
					                </div>

					                <div class="modal-body">
					                    <div id="calendarwrap">
					             
					            		<!-- #customize your modal window here -->
					         
					            		<div id="calendar" class="window">
					             
						             <?php
						                
						                	$tmonth = date('m',time());
						                	$tyear = date('y',time());
						                
							                if($tmonth<12)
							                {
							                    $nmonth = $tmonth+1;
							                    $nyear = $tyear;
							                }
							                else
							                {
							                    $nmonth = 1;
							                    $nyear = $tyear+1;
							                }
						                
							    	echo showCalendar($product->delivery_method_id,25);

						                
						             ?> 
						              <!--  <a href="#" class="close">Close it</a>-->
						         
						            </div>
						            <!-- Do not remove div#mask, because you'll need it to fill the whole screen --> 

							</div>

						                </div>

						                <div class="modal-footer">

						                </div>

						            </div>

						        </div>

					    </div>
						
						<!--
						<table width="100%" style="margin-top:10px;">
							<tr height="30">
								<td width="60%" style="padding-left:15px;">
									
								</td>
								<td width="40%">
									
								</td>
							</tr>
						</table>
						-->

						<!--
						<p class="showing_date">
							<label>
								<?php echo lang('Delivery');?>: 
								<input type="text" id="show_date" readonly  size="30" style="background:transparent; border: none; box-shadow: none; font-size:20px; font-weight:bold;" value="" />
							</label>
						</p>
						-->
						<!--
						<img src="<?php echo theme_url();?>/images/<?php echo imgLang('sameday-delivery-LN.png');?>" width="100%" alt="<?php echo lang('Same day delivery');?>" /> 
						-->
						
						<?php

						if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
							/* JSON WEB SERVICE ACCESS */
							$json = file_get_contents('http://www.legacy.com/webservices/ns/FuneralInfo.svc/GetFuneralInfoJson?fhid='.$this->session->userdata('fhid').'&cobrand='.$this->session->userdata('cobrand').'&pid='.$this->session->userdata('pid'));
							$obj = json_decode($json);
							/*
							echo $this->session->userdata('fhid').'_'.$this->session->userdata('cobrand').'_'.$this->session->userdata('pid').'_____________';
							echo $json;
							*/
							echo '<br />';
							echo '<span style="font-size:20px;font-weight:bold;color:#8D0352;">Funeral Home</span><br />';
							echo '<span style="color:#8A8A8A;font-size:14px;">';
							echo $obj->FuneralHome->FHKnownBy1.'<br />';
							echo $obj->FuneralHome->FHAddress1.' '.$obj->FuneralHome->FHAddress2.'<br />';
							echo $obj->FuneralHome->FHCity.', '.$obj->FuneralHome->FHState.' '.$obj->FuneralHome->FHZip.'<br />';
							echo '</span><br /><br />';
						}else{

						?> 
						
						<div style="margin: 15px 0px;">
							<div style="margin-top:0px;">
								<span style="font-size:20px;font-weight:780;">Find Funeral Home</span>
							</div>
							<input type="text" name="country" id="home" class="form-control" placeholder="Type Funeral Home Name" />
							<input type="hidden" name="home_name" id="home-name" value="" />
							<input type="hidden" name="home_address"  id="home-address" value="" />
							<input type="hidden" name="home_postalcode" id="home-postalcode"  value="" />
							<input type="hidden" name="home_city"  id="home-city" value="" />
							<input type="hidden" name="home_province"  id="home-province" value="" />
							<input type="hidden" name="home_phone"  id="home-phone" value="" />
							<input type="hidden" name="home_id"  id="home-id" value="" />
						</div>
						
						<?php 
						}
						
						?>

						<div id="act" style="display:none;">
							<button type="submit" class="btn btn-large btn-block btn-default"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
						</div>	
						<div id="noact">
							<a class="btn btn-large btn-block"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
						</div>	
						
						<br /><br />
						
						<div id="tabs">
							<ul class="tabs">  
								<li style="width:auto;"><a href="#tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								<!--
								<li style="width:auto;"><a href="#tab2">&nbsp;&nbsp;&nbsp;Delivery Policy&nbsp;&nbsp;&nbsp;</a></li>
								<li style="width:auto;"><a href="#tab3">&nbsp;&nbsp;&nbsp;Substitution Policy&nbsp;&nbsp;&nbsp;</a></li>
								-->
							</ul>
							<div class="tab_container">	
								<div id="tab1" class="tab_content"> 
									<?php echo rightLang($product->product_description,$product->product_description_fr); ?>
								</div> 
								<!--
								<div id="tab2" class="tab_content">	 
									<?php
									foreach($product->delivery_policy as $dpol){                             
										echo rightLang($dpol->message_text,$dpol->message_text_fr);
									}
									?>
								</div>
								<div id="tab3" class="tab_content">	 
									<?php 
									foreach($product->substitution_policy as $spol){                             
										echo rightLang($spol->message_text,$spol->message_text_fr);
									} 
									?>
								</div>
								-->
							</div>
						</div>	
					</div>
					<div class="col-lg-1">
							
					</div>
					
				</div>
				
				</form>
				
			</div>
		</section>

	</section>
	<!--end wrapper-->
	
	
	
<?php include_once('footer_clava.php'); ?>
<script>
 $(function(){
 	'use strict';

 	$('#home').autocomplete({
	        	serviceUrl: '/products/fhomes',
   		forceFixPosition:true,
   		onSearchStart: function(){
   			$("#home").attr("style","background: url(/images/loader.gif) right center no-repeat;")
   		},
   		onSearchComplete: function() {
   			$("#home").removeAttr("style")
   		},
   		onSelect: function(suggestion) {
   			$("#home-name").val(suggestion.name)
		            $("#home-address").val(suggestion.address)
		            $("#home-postalcode").val(suggestion.postalcode)
		            $("#home-city").val(suggestion.city)
		            $("#home-province").val(suggestion.province)
		            $("#home-phone").val(suggestion.phone)
		            $("#home-id").val(suggestion.data)
   		}
	});
 })

</script>

<script> 

function upcoming_date(id){
	$("#delivery_date").val(id);

	if(id=='cal')
	{
		$('#myModal').modal('show');
		//document.getElementById('delidrop').style.display = 'none';
		document.getElementById('viewcale').style.display = 'block';
		
	}
	else
	{
		if(id!=''){
			$("#delivery_date").val(id);
        			$("#show_date").val(id); 
			document.getElementById('act').style.display = 'block';
			document.getElementById('noact').style.display = 'none';
		}else{
			
			document.getElementById('act').style.display = 'none';
			document.getElementById('noact').style.display = 'block';
		}
	}
}

function selectPrice(id){
	document.getElementById('price_se').innerHTML = id;
}

$(function() {   

    $('.daypick').click(function(e){
        e.preventDefault();
        $('#myModal').modal('hide');
                    
        $("#special_delivery").removeAttr("checked");              
        $('.selected').removeClass('selected');
        $(this).addClass('selected');

        var dt = $(this).attr("id");
	
        $("#delivery_date").val($(this).attr('id'));
        $("#show_date").val($(this).attr('name')); 

        $("#upcoming").val($(this).attr('id'));
		
		//CALENDAR
		$("#upcoming option[value='cal']").remove();
		$("#upcoming").append('<option value="'+dt+'" selected="selected">'+$(this).attr('name')+'</option>');
		$("#upcoming").append('<option value="cal">View Calendar</option>');
		//CALENDAR
        if($(this).attr('class').slice(8,15)=='special')
        {
            $("#special_delivery").trigger('click');    
        }

	if(dt!=''){
		document.getElementById('act').style.display = 'block';
		document.getElementById('noact').style.display = 'none';
	}else{
		document.getElementById('act').style.display = 'none';
		document.getElementById('noact').style.display = 'block';
	}

    });

 });

</script>