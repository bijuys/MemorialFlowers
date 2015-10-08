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
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>category/plants" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Plants</div>
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
		
		
		<section class="info_service" id="carrito">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
						
						<table width="100%" border="0" style="background:url('<?php echo base_url(); ?>images/mf-website-main-banner-redo.png') no-repeat;">
							<tr height="275">
								<td width="25%" valign="top" style="padding-top:5px;padding-left:32px;">
									<div style="font-size:14px;height:25px;color:#828282;border-bottom:1px solid #D3D3D3;width:90%;">
										<b>For The Service</b>
									</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;">Standing Sprays</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;">Wreaths and Hearts</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;">Tributes</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/urn-spray" style="color:inherit;">Urn Spray</a>
										</div>
										
									
									<div style="font-size:14px;margin-top:12px;height:25px;color:#828282;border-bottom:1px solid #D3D3D3;width:90%;">
										<b>For Home & Office</b>
									</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="color:inherit;">Vase Arrangements</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="color:inherit;">Sympathy Baskets</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>subcategory/bouquets" style="color:inherit;">Bouquets</a>
										</div>
										<div style="font-size:12px;color:#555;border-bottom:1px solid #D3D3D3;width:90%;">
											<a href="<?php echo base_url(); ?>category/plants" style="color:inherit;">Plants</a>
										</div>	
										
										
								</td>
								<td width="75%">
									
								</td>
							</tr>
						</table>
						
						<!--
						<style>
						.arrow-down {
							width: 100%; 
							height: 0; 
							border-left: 110px solid transparent;
							border-right: 110px solid transparent;
							
							border-top: 20px solid <?php echo $template->menu_bg; ?>;
						}
						</style>
					
						<div style="margin-top:10px;">
						 <table width="100%" border="0">
							<tr>
								<td width="10%" valign="top">
									<div style="background-color:#555555;height:20px;margin-top:-10px;padding-top:3px;">
										<div style="font-size:14px;color:#fff;text-align:center;width:100%;font-weight:bold;font-family:Tahoma, Geneva, sans-serif;">
											Funeral Home
										</div>
									</div>
									<div class="arrow-down"></div>
									<table width="100%" style="font-size:13px;color:#555;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;margin-top:5px;">
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="line-height:13px;padding-left:10px;color:#555;">Standing Sprays</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="line-height:13px;padding-left:10px;color:#555;">Wreaths and Hearts</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/tributes" style="line-height:13px;padding-left:10px;color:#555;">Tributes</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/urn-spray " style="line-height:13px;padding-left:10px;color:#555;">Urn Spray</a>
											</td>
										</tr>
									</table>
									
									<div style="background-color:#555555;height:20px;margin-top:5px;padding-top:3px;">
										<div style="font-size:14px;color:#fff;text-align:center;width:100%;font-weight:bold;font-family:Tahoma, Geneva, sans-serif;">
											Home & Office
										</div>
									</div>
									<div class="arrow-down"></div>
									<table width="100%" style="font-size:13px;color:#555;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;margin-top:5px;">
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="line-height:13px;padding-left:10px;color:#555;">Vase Arrangements</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="line-height:13px;padding-left:10px;color:#555;">Sympathy Baskets</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/bouquets" style="line-height:13px;padding-left:10px;color:#555;">Bouquets</a>
											</td>
										</tr>
									</table>
									
									
								</td>
								<td width="90%">
								
								</td>
							</tr>
						  </table>
						</div>
					-->
						
					</div>
					
					<!--
					<div class="col-sm-12 col-md-12 col-lg-9">
					
						<img src="<?php echo base_url(); ?>images/MEM-landing-banner-new-4fix-2.jpg" width="100%" height="260" />
					
					</div>
					-->	
						
						
						
						
					
				</div>
			</div>
		</section>
		
		
		<section class="info_service" style="display:none;">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
						
						
						<style>
						.arrow-down {
							width: 100%; 
							height: 0; 
							border-left: 110px solid transparent;
							border-right: 110px solid transparent;
							
							border-top: 20px solid <?php echo $template->menu_bg; ?>;
						}
						</style>
					
						<div style="margin-top:10px;">
						 <table width="100%" border="0" style="background:url('<?php echo base_url(); ?>images/MEM-landing-banner-new-4.jpg') no-repeat;">
							<tr>
								<td width="10%" valign="top">
									<div style="background-color:#555555;height:20px;margin-top:-10px;padding-top:3px;">
										<div style="font-size:14px;color:#fff;text-align:center;width:100%;font-weight:bold;font-family:Tahoma, Geneva, sans-serif;">
											Funeral Home
										</div>
									</div>
									<div class="arrow-down"></div>
									<table width="100%" style="font-size:13px;color:#555;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;margin-top:5px;">
										<!--
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>category/casket-sprays" style="line-height:13px;padding-left:10px;color:#555;">Casket Sprays</a>
											</td>
										</tr>
										-->
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="line-height:13px;padding-left:10px;color:#555;">Standing Sprays</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="line-height:13px;padding-left:10px;color:#555;">Wreaths and Hearts</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/tributes" style="line-height:13px;padding-left:10px;color:#555;">Tributes</a>
											</td>
										</tr>
										<!--
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>category/hearts" style="line-height:13px;padding-left:10px;color:#555;">Hearts</a>
											</td>
										</tr>
										-->
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/urn-spray " style="line-height:13px;padding-left:10px;color:#555;">Urn Spray</a>
											</td>
										</tr>
									</table>
									
									<div style="background-color:#555555;height:20px;margin-top:5px;padding-top:3px;">
										<div style="font-size:14px;color:#fff;text-align:center;width:100%;font-weight:bold;font-family:Tahoma, Geneva, sans-serif;">
											Home & Office
										</div>
									</div>
									<div class="arrow-down"></div>
									<table width="100%" style="font-size:13px;color:#555;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;margin-top:5px;">
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="line-height:13px;padding-left:10px;color:#555;">Vase Arrangements</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="line-height:13px;padding-left:10px;color:#555;">Sympathy Baskets</a>
											</td>
										</tr>
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>subcategory/bouquets" style="line-height:13px;padding-left:10px;color:#555;">Bouquets</a>
											</td>
										</tr>
										<!--
										<tr class="last" style="height:13px;border-bottom:1px solid #000;">
											<td width="100%">
												<a href="<?php echo base_url(); ?>category/plants" style="line-height:13px;padding-left:10px;color:#555;">Plants</a>
											</td>
										</tr>
										-->
									</table>
									
									
								</td>
								<td width="90%">
								
								</td>
							</tr>
						  </table>
						</div>
						
						
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="info_service" style="margin-top:0px;">
			<div class="container">
				<div class="row" id="responsive">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service">
							<img src="<?php echo base_url(); ?>images/MF-tile-funeral-4.jpg" width="100%" style="border:1px solid #999999;" />	
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office">
							<img src="<?php echo base_url(); ?>images/MF-tile-homeandoffice-4.jpg" width="100%" style="border:1px solid #999999;" />	
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>category/fruit-baskets">
							<img src="<?php echo base_url(); ?>images/MF-tile-gourmet-4.jpg" width="100%" style="border:1px solid #999999;" />	
						</a>
					</div>
				</div>
				
				<div class="row" id="mobile-header">
					
					<?php
					if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
					?>			
					<div class="col-lg-12" style="margin-bottom:10px;">
						<table width="100%" border="0" style="border:1px solid #8D0352;">
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
										echo '<div style="font-weight:bold;margin-top:5px;font-size:18px;color:#000;">'.ucwords(strtolower($obj->Obituary->FirstName.' '.$obj->Obituary->LastName)).'</div>';
									?> 
								</td>
							</tr>
						</table>
					</div>
					<?php 
					}
					?>
					
					<div class="col-lg-12" style="margin-bottom:5px;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service">
							<img src="<?php echo base_url(); ?>images/MF-tile-funeral-4.jpg" width="100%" style="border:1px solid #8D0352;" />	
						</a>
					</div>
					<div class="col-lg-12" style="margin-bottom:5px;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office">
							<img src="<?php echo base_url(); ?>images/MF-tile-homeandoffice-4.jpg" width="100%" style="border:1px solid #8D0352;" />	
						</a>
					</div>
					<div class="col-lg-12" style="margin-bottom:5px;">
						<a href="<?php echo base_url(); ?>category/fruit-baskets">
							<img src="<?php echo base_url(); ?>images/MF-tile-gourmet-4.jpg" width="100%" style="border:1px solid #8D0352;" />	
						</a>
					</div>	
					
					
				</div>
				
			</div>
		</section>		
		
		<section class="info_service" style="margin-top:5px;">
			<div class="container">
				<div class="row">
				
					<div class="col-lg-12" id="mobile-header">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h2>Best Sellers</h2>
							</div>
							
						</div>
						<div class="dividerLatest">
							<div class="gDot"></div>
						</div>
					</div>

					<div class="col-lg-12" id="mobile-header">
						<table width="100%">
							<tr>
								<td width="49%" height="200" valign="top" align="center" style="border:1px solid #8D0352;">
									<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;">
										<img src="<?php echo base_url(); ?>images/ti3.png" width="100%" />	
										<br />
										<span style="color:#8D0352;font-size:18px;font-weight:bold;">Funeral Tributes</span>
									</a>
								</td>
								<td width="2%">
								</td>
								<td width="49%" height="200" valign="top" align="center" style="border:1px solid #8D0352;">
									<a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;">
										<img src="<?php echo base_url(); ?>images/ti4.png" width="100%" />	
										<br />
										<span style="color:#8D0352;font-size:18px;font-weight:bold;">Service Arrangements</span>
									</a>
								</td>
							</tr>
							<tr height="5">
								<td colspan="3">
								</td>
							</tr>
							<tr>
								<td width="49%" height="200" valign="top" align="center" style="border:1px solid #8D0352;">
									<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;">
										<img src="<?php echo base_url(); ?>images/corazon.png" width="100%" />	
										<br />
										<span style="color:#8D0352;font-size:18px;font-weight:bold;">Wreaths & Hearts</span>
									</a>
								</td>
								<td width="2%">
								</td>
								<td width="49%" height="200" valign="top" align="center" style="border:1px solid #8D0352;">
									<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;">
										<img src="<?php echo base_url(); ?>images/ti1.png" width="100%" />
										<br />
										<span style="color:#8D0352;font-size:18px;font-weight:bold;">Standing Sprays</span>
									</a>
								</td>
							</tr>
						</table>
						
						<br />
						
					</div>	
				
					<div id="responsive" class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti3.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;font-weight:bold;color:#8D0352;">Funeral Tributes</span>
						</a>
						<br /><br />		
					</div>
					<div id="responsive" class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti4.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;font-weight:bold;color:#8D0352;">Service Arrangements</span>
						</a>
						<br /><br />		
					</div>
					<div id="responsive" class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/corazon.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;font-weight:bold;color:#8D0352;">Wreaths & Hearts</span>
						</a>
						<br /><br />	
					</div>
					<div id="responsive" class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti1.png" width="100%" />
							<br />
							<span style="font-size:14px;line-height:30px;font-weight:bold;color:#8D0352;">Standing Sprays</span>
						</a>
						<br /><br />	
					</div>
					
				</div>
			</div>
		</section>
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>