<?php include_once('header_clava.php');?>
	<!--start wrapper-->
	<section class="wrapper  topwrapper">
		
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

				<div class="clearfix"></div>
				<div class="row">
					<div class="col-sm-2">
						<div id="left-menu" style="margin-top:-40px;">
						<?php $navs = array();
							foreach($paths as $key=>$val) {
								$navs[ucwords(str_replace('-', ' ', $key))] = $val;
							}
						?>
						<h3><a href="#">For the Service</a></h3>
						<ul>
							<li <?php echo array_key_exists('Standing Sprays',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/standing-sprays');?>">Standing Sprays</a></li>
							<li <?php echo array_key_exists('Wreaths & Hearts',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/wreaths-&-hearts');?>">Wreaths and Hearts</a></li>
							<li <?php echo array_key_exists('Tributes',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/tributes');?>">Tributes</a></li>
							<li <?php echo array_key_exists('Urn Spray',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/urn-spray');?>">Urn Spray</a></li>
						</ul>
							<h3><a href="#">For Home or Office</a></h3>
						<ul>
							<li <?php echo array_key_exists('Vase Arrangements',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/vase-arrangements');?>">Vase Arrangements</a></li>
							<li <?php echo array_key_exists('Sympathy Baskets',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/sympathy-baskets');?>">Sympathy Baskets</a></li>
							<li <?php echo array_key_exists('Bouquets',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('subcategory/bouquets');?>">Bouquets</a></li>
							<li <?php echo array_key_exists('Plants',$navs) ? 'class="active"':''; ?>><a href="<?php echo base_url('category/plants');?>">Plants</a></li>
						</ul>
						</div><!-- LEft Menu //-->
					</div>
					<div class="col-sm-10">



						<div class="row sub_content" id="products-wrapper" style="margin-top:-40px;">

						<div class="col-sm-12">
							<div class="breadcrumb">
								<ul>
								<?php foreach($paths as $key=>$val) : ?>
									<li><a href="<?php echo $val;?>"><?php echo ucwords(str_replace('-',' ',$key));?></a></li>
								<?php endforeach; ?>
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
				
						<?php $procount = 0; 
							foreach($products as $row){ 
								$procount++; 
						?>  
						<div class="col-lg-3 col-md-3 col-sm-3">
							<div class="prod-item">
							<a href="<?php echo base_url().$row->url;?>" style="text-decoration:none;color:inherit;">
								
								<img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" alt="<?php echo $row->product_name; ?>" class="prod-img" />
								<div class="text-center">
									<div class="prod-name">
										<?php echo rightLang($row->product_name,$row->product_name_fr); ?>
									</div>
									<div class="prod-price">
										<?php echo getRate($row->price_value);?>
									</div>
								</div>
							</a>
							</div>
						</div>
						<?php if($procount % 4 == 0) { ?>
							<div class="clearfix"></div>
						<?php } ?>
						<?php } ?>
					
						</div>

					</div>
				</div>
				
				
				
				<div class="row sub_content" id="mobile-header" style="margin-top:-40px;margin-bottom:-40px;">
					<div class="col-lg-12">
						<table width="100%">

							<?php 
								$i=1;
								foreach($products as $row) { 

									if($i==1 || $i%2==1) {
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