<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      
	  <br />
	  
	  <div id="content" class="clearfix">
	  
		<span style="color:#770922;font-size:30px;">Products</span>
		<br /><br />
		
		<table width="100%" border="0">
			<tr>
				<td width="100%" valign="top">
					
					<div id="order_search">
						<?php echo form_open('/mymemorial/products/browse',array('class'=>'form-search')); ?>
							<select name="category_id" id="category_id" class="search-query">
								<option value="">All Categories</option>
								<option value="" disabled></option>
								<option value="3_1" <?php if($category_id=="3_1"){ echo 'selected="selected"'; } ?> style="font-weight:bold;">Flowers for the Service</option>
								<option value="2_26" <?php if($category_id=="2_26"){ echo 'selected="selected"'; } ?>>Standing Sprays</option>
								<option value="2_25" <?php if($category_id=="2_25"){ echo 'selected="selected"'; } ?>>Wreaths & Hearts</option>
								<option value="2_33" <?php if($category_id=="2_33"){ echo 'selected="selected"'; } ?>>Crosses</option>
								<option value="2_29" <?php if($category_id=="2_29"){ echo 'selected="selected"'; } ?>>Vase Arrangements</option>
								<option value="2_27" <?php if($category_id=="2_27"){ echo 'selected="selected"'; } ?>>Tributes</option>
								<option value="2_32" <?php if($category_id=="2_32"){ echo 'selected="selected"'; } ?>>Sympathy Baskets</option>
								<option value="2_28" <?php if($category_id=="2_28"){ echo 'selected="selected"'; } ?>>Urn Spray</option>
								<option value="" disabled></option>
								<option value="3_2" <?php if($category_id=="3_2"){ echo 'selected="selected"'; } ?> style="font-weight:bold;">Flowers for Home & Office</option>
								<option value="2_29" <?php if($category_id=="2_29"){ echo 'selected="selected"'; } ?>>Vase Arrangements</option>
								<option value="2_30" <?php if($category_id=="2_30"){ echo 'selected="selected"'; } ?>>Sympathy Baskets</option>
								<option value="1_1" <?php if($category_id=="1_1"){ echo 'selected="selected"'; } ?>>Plants</option>
								<option value="" disabled></option>
								<option value="" disabled style="font-weight:bold;">Colors</option>
								<option value="2_12" <?php if($category_id=="2_12"){ echo 'selected="selected"'; } ?>>Blue</option>
								<option value="2_13" <?php if($category_id=="2_13"){ echo 'selected="selected"'; } ?>>Lavender</option>
								<option value="2_14" <?php if($category_id=="2_14"){ echo 'selected="selected"'; } ?>>Pink</option>
								<option value="2_17" <?php if($category_id=="2_17"){ echo 'selected="selected"'; } ?>>Pastel</option>
								<option value="2_11" <?php if($category_id=="2_11"){ echo 'selected="selected"'; } ?>>White</option>
								<option value="2_18" <?php if($category_id=="2_18"){ echo 'selected="selected"'; } ?>>Yellow</option>
								<option value="2_19" <?php if($category_id=="2_19"){ echo 'selected="selected"'; } ?>>Peach</option>
								<option value="2_21" <?php if($category_id=="2_21"){ echo 'selected="selected"'; } ?>>Red</option>
							</select>
							&nbsp;
							<input type="text" name="product_name" id="product_name" value="<?php echo $product_name; ?>" class="search-query" placeholder="Product name" />
							&nbsp;
							<button type="submit" name="submit" class="btn btn-success">Search Products</button>              
						<?php echo form_close();?>
					</div>
					
				</td>
			</tr>
			<tr>
				<td width="100%" valign="top">
						
						<script>
						function openDesc(id){
							<?php foreach($products as $product){ ?>
								document.getElementById('desc_upd_<?php echo $product->product_id; ?>').style.display = 'none';
								document.getElementById('desc_ori_<?php echo $product->product_id; ?>').style.display = 'block';
							<?php } ?>
							document.getElementById('desc_ori_'+id).style.display = 'none';
							document.getElementById('desc_upd_'+id).style.display = 'block';
						}
						function updateDesc(id,val){
							document.getElementById('desc_ori_'+id).style.display = 'block';
							document.getElementById('desc_upd_'+id).style.display = 'none';
							var te = document.getElementById('d_n_'+id).value;
							document.getElementById('d_na_'+id).innerHTML = ''+te;
							$.ajax({
								url: "<?php echo base_url(); ?>mymemorial/products/upd_pro_des_inf",
								type:"POST",
								data:
								{
									'product_id': id,
									'product_description': val
								}
							});
						}
						</script>
						
						<span style="color:#770922;font-weight:bold;font-size:18px;">Click on the product description to edit text and click away to update!</span>
						
						<br /><br />
						
						<table class="dashboard-table table" style="color:#555;">
								<tr style="text-align:center; background-color:#A9A9A9;">
									<th style="text-align:center;color:#fff;background-color:#770922;" width="15%"><?php echo lang('Picture');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;" width="20%"><?php echo lang('Information');?></th>
									<!--<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Status');?></th>-->
									<th style="text-align:center;color:#fff;background-color:#770922;" width="55%"><?php echo lang('Description');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;" width="10%"><?php echo lang('');?></th>
								</tr>
							<?php foreach($products as $product) : ?>
								<tr>
									<td class="first" style="text-align:center;vertical-align:middle;">
										<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture;?>" style="width:10em;">
									</td>
									<td style="vertical-align:middle;">
										<b>Name</b><br />
										<?php echo $product->product_name;?>
										<br /><br />
										<b>Code</b><br />
										<?php echo $product->product_id;?>
										<br /><br />
										<?php 
										if($product->product_id){ 
										$prices = $this->Product_model->get_customer_products_prices($product->product_id);
										?>
										<b>Price(s)</b>
										<table width="100%" border="0">
											<?php foreach($prices as $price){ ?>
												<tr>
													<td width="30%" align="center" style="text-align:center;">
														<?php echo $price->price_val; ?>
													<td>
													<td width="40%">
														<?php echo $price->price_name; ?>
													<td>
													<td width="30%" align="right" style="text-align:right;">
														<?php echo 'C$'.$price->price_value; ?>
													<td>
												</tr>
											<?php } ?>
										</table>
										<?php 
										}
										?>
									</td>
									<!--
									<td style="text-align:center;vertical-align:middle;">
										<?php if($product->product_status==1){ ?>
											<img src="/images/okay-icon.png" width="20" height="20"/>
										<?php }else{ ?>
											<img src="/images/cancel-icon.png" width="20" height="20"/>
										<?php } ?>
									</td>
									-->
									<td style="vertical-align:middle;padding-right:10px;">
									
										<div id="desc_ori_<?php echo $product->product_id; ?>" class="tooltip-demo">
											<a id="d_na_<?php echo $product->product_id; ?>" name="d_na_<?php echo $product->product_id; ?>" href="javascript:;" onCliCk="openDesc('<?php echo $product->product_id; ?>');" style="color:inherit;text-align:justify;text-decoration:none;"><?php echo $product->product_description; ?></a>
										</div>
										<div id="desc_upd_<?php echo $product->product_id; ?>" style="display:none;">
											<textarea id="d_n_<?php echo $product->product_id; ?>" name="d_n_<?php echo $product->product_id; ?>" rows="3" class="form-control" onChange="updateDesc('<?php echo $product->product_id; ?>',this.value);" style="width:100%;height:180px;"><?php echo $product->product_description; ?></textarea>
										</div>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<div class="buttonwrap">
											<a href="<?php echo base_url(); ?><?php echo $product->url; ?>" class="btn btn-inverse btn-small" target="_blank" title="See product on website">View</a>
										</div>	
									</td>
									
								</tr>
							<?php endforeach; ?>
						</table>
					
				</td>
			</tr>
		</table>		
	  
      </div><!-- Contents //-->
<?php //include_once(APPPATH.'views/footer.php'); ?>
