<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<section class="content about">
			<div class="container">
			
				<?php echo form_open_multipart(current_url(), 'id="site-searchform"'); ?>
				
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4>Lasting Wishes Standing Spray- White </h4>
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
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-8">
								<select name="upcoming" id="upcoming"  onchange="upcoming_date(this.value);" style="height:40px;width:100%;">
									<option value=""><?php echo lang('Choose delivery date');?></option>
									<?php $dates = get_dates($product->delivery_method_id,10);
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
						<br /><br />
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

function upcoming_date(id){
	$("#delivery_date").val(id);
	if(id!=''){
		document.getElementById('act').style.display = 'block';
		document.getElementById('noact').style.display = 'none';
	}else{
		document.getElementById('act').style.display = 'none';
		document.getElementById('noact').style.display = 'block';
	}
}

function selectPrice(id){
	document.getElementById('price_se').innerHTML = id;
}

</script>