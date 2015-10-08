<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<?php 
		
		if($_SERVER['REQUEST_URI']!='/products' && $_SERVER['REQUEST_URI']!='/search'){
		
			$inf = $_SERVER['REQUEST_URI']; 
			$in = explode("/", $inf);
			
			if($in[2]=='red'){
				$d = 1;
			}
			if($in[2]=='white'){
				$d = 1;
			}
			if($in[2]=='blue'){
				$d = 1;
			}
			if($in[2]=='lavender'){
				$d = 1;
			}
			if($in[2]=='pink'){
				$d = 1;
			}
			if($in[2]=='bright'){
				$d = 1;
			}
			if($in[2]=='pastel'){
				$d = 1;
			}
			if($in[2]=='yellow'){
				$d = 1;
			}
			if($in[2]=='peach'){
				$d = 1;
			}
		
		}else{
			  
		}
		?>
		
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
		
		
		
		
		
		<section class="content about">
			<div class="container">
				<div class="row sub_content">
					
					<div class="col-lg-12" id="responsive" style="margin-top:-30px;">
						<div class="row">
							<div class="col-lg-3 col-md-12 col-sm-12">
								<!--<h3><?php echo $secti; ?> <i class="fa fa-chevron-right"></i> <?php echo ucwords($cat_name); ?></h3>-->
								<h2>
									<?php echo ucwords($cat_name); ?>
								</h2>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">
								<span style="font-size:11px;">
								<?php 
								if($this->session->userdata('language')=='french'){
									echo $rec->description_fr;
								}else{
									echo $rec->description;
								}
								?>
								</span>
							</div>
							<div id="right_products_banner" class="col-lg-3 col-md-12 col-sm-12">
								<img src="<?php echo base_url(); ?>images/mf-top-banner-new-1.jpg" width="100%">
							</div>
						</div>
						<div class="dividerLatest">
							<div class="gDot"></div>
						</div>
					</div>	
					
					<div class="col-lg-12" id="mobile-header" style="margin-top:-40px;">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<!--<h3><?php echo $secti; ?> <i class="fa fa-chevron-right"></i> <?php echo ucwords($cat_name); ?></h3>-->
								<h2>
									<?php echo ucwords($cat_name); ?>
								</h2>
							</div>
						</div>
						<div class="dividerLatest">
							<div class="gDot"></div>
						</div>
					</div>	
					
					<?php if($d==1){ ?>
					
					<div class="col-lg-12">
					
						<img src="<?php echo base_url(); ?>images/memorial/<?php echo $in[2]; ?>.jpg" style="width:100%;height:400px;" />
						<br /><br />
						
					</div>
					
					<?php } ?>
					
				</div>	
				
				<div class="row sub_content" id="responsive" style="margin-top:-40px;">
				
						<?php foreach($products as $row){ ?>  
						<div class="col-lg-3 col-md-3 col-sm-3">
							<a href="<?php echo base_url().$row->url;?>" style="text-decoration:none;color:inherit;">
								<img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" alt="profile img" width="100%" height="250" />
								<div class="profile text-center">
									<div style="height:70px;padding:7px 5px 7px 5px;">
										<span style="font-size:13px;"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></span>
									</div>
									<p style="font-size:20px;font-weight:bold;">
										<?php echo getRate($row->price_value);?>
									</p>
									<a href="<?php echo base_url().$row->url; ?>" class="btn btn-large btn-block btn-default"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
								</div>
							</a>
							<br />	
						</div>
						<?php } ?>
					
				</div>
				
				<div class="row sub_content" id="mobile-header" style="margin-top:-40px;margin-bottom:-40px;">
					<div class="col-lg-12">
						<table width="100%">
							<?php 
							$i=1;
							foreach($products as $row){ 
							if($i==1 || $i%2==1){
								echo '<tr>';
							}
							?>  
							<td width="50%" align="center">
								<a href="<?php echo base_url().$row->url;?>" style="text-decoration:none;color:inherit;">
									<div style="height:150px;">
										<img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" alt="profile img" width="94%" height="150" />
									</div>
									<div class="profile text-center">
										<div style="height:70px;padding:7px 5px 7px 5px;">
											<span style="font-size:13px;"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></span>
										</div>
										<p style="font-size:18px;font-weight:bold;">
											<?php echo getRate($row->price_value);?>
										</p>
										<a href="<?php echo base_url().$row->url; ?>" class="btn btn-large btn-block btn-default"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</a>
							</td>
							<!--
							<div class="col-lg-3 col-md-3 col-sm-3">
								<a href="<?php echo base_url().$row->url;?>" style="text-decoration:none;color:inherit;">
									<img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" alt="profile img" width="100%" height="250" />
									<div class="profile text-center">
										<div style="height:70px;padding:7px 5px 7px 5px;">
											<span style="font-size:13px;"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></span>
										</div>
										<p style="font-size:20px;font-weight:bold;">
											<?php echo getRate($row->price_value);?>
										</p>
										<a href="<?php echo base_url().$row->url; ?>" class="btn btn-large btn-block btn-default"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
									</div>
								</a>
								<br />	
							</div>
							-->
							<?php 
							if($i==2 || $i%2==0){
								echo '</tr>';
							}
							$i=$i+1;
							} 
							?>
						</table>
					</div>	
				</div>
				
				
			</div>
		</section>			
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>