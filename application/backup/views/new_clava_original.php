<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<section class="promo_box-mf">
			<div class="container">
				<div class="row" id="orderbyphone" style="margin-top:20px;">
					<div class="col-sm-8 col-md-8 col-lg-8">
						<div class="row">
							<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top:8px;">
								<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
									Order by Phone:
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-lg-9" style="padding-top:8px;">
								<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
									1-877-537-8610
								</span>
							</div>
						</div>
                    </div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
							<div>
								<input class="input-text"  name="search" id="s" placeholder="Enter product code or name ..." type="text">
								<input id="searchsubmit" value="Search" type="submit" class="pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		
		<section class="info_service">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-3">
					
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
					
					<div class="col-sm-12 col-md-12 col-lg-9">
					
						<img src="<?php echo base_url(); ?>images/MEM-landing-banner-new-4fix-2.jpg" width="100%" height="260" />
					
					</div>
						
						
						
						
						
					
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
		
		
		<section class="info_service" style="margin-top:20px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service">
							<img src="<?php echo base_url(); ?>images/MF-tile-funeral-2.jpg" width="100%" />	
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office">
							<img src="<?php echo base_url(); ?>images/MF-tile-homeandoffice.jpg" width="100%" />	
						</a>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<a href="<?php echo base_url(); ?>category/fruit-baskets">
							<img src="<?php echo base_url(); ?>images/MF-tile-gourmet-2.jpg" width="100%" />	
						</a>
					</div>
				</div>
			</div>
		</section>		
		
		<section class="info_service" style="margin-top:5px;">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti3.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Funeral Tributes</span>
						</a>
						<br /><br />		
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti4.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Service Arrangements</span>
						</a>
						<br /><br />		
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/corazon.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Wreaths & Hearts</span>
						</a>
						<br /><br />	
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti1.png" width="100%" />
							<br />
							<span style="font-size:14px;line-height:30px;">Standing Sprays</span>
						</a>
						<br /><br />	
					</div>
					
				</div>
			</div>
		</section>
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>