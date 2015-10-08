<?php
$tcart = get_tiny_cart();
$ci =& get_instance();

include_once('header.php');?>

<style>
@media screen and (min-width : 769px) {
    #mobile-header { display: none; }
	#responsive { display: block; }
}

@media screen and (min-width : 0px) and (max-width : 768px) {
    #mobile-header { display: block; }
	#responsive { display: none; }
	#left-navigation { display: none; }
	#caller-info { display: none; }
	
	body{
		padding-top:0px;
	}
}
</style>

<header>
	<div class="container">
		<div id="responsive" class="row">
			<div class="col-sm-6">
				<h1><a href="<?php echo base_url();?>" id="logo"><img src="<?php echo template_url('img/dignityflowers-logo-213x45.png');?>"  alt="Dignity Flowers"></a></h1>
			</div>
			<div class="col-sm-6">
				<ul id="top-nav">
					<li><img src="<?php echo template_url('img/canada-language-icon-25x19.png');?>"> <a href="#">English</a></li>
					<li><a href="#">$CAD</a></li>
					<li  class="seperate" id="cart-icon"><?php if(isset($tcart) && $tcart->items>0) : ?><a href="/shop/cart"><span><?php echo $tcart->items;?></a></span><?php endif; ?></li>
				</ul>
			</div>
		</div>
	</div>		
</header>

<div class="container">

	<div id="mobile-header" class="row" style="position:fixed;width:100%;background-color:#ffffff;z-index:5000;margin-top:-10px;padding-top:5px;padding-bottom:5px;margin-bottom:350px;">
			
		<div class="col-lg-12">
			
			<table width="100%" border="0">
				<tr>
					<td width="7%">
					
					</td>
					<td width="86%">
						<a href="<?php echo base_url();?>"><img src="<?php echo template_url('img/dignityflowers-logo-213x45.png');?>" width="100%" alt="Dignity Flowers"></a>
					</td>
					<td width="7%">
						
					</td>
				</tr>
			</table>
		
		</div>

		<div class="col-lg-12" style="background-color:#770922;margin-top:5px;">	
			
			<table width="100%">
				<tr height="55">
					<td width="25%" align="center" style="border:1px solid #fff;">
						<div style="margin-top:1px;">
							<a style="color:inherit;" onClick="openMenu2();">
								<i style="font-size:2.0em;color:#fff;" class="fa fa-bars"></i>
							</a>
						</div>	
					</td>
					<td width="25%" align="center" style="border:1px solid #fff;">
						<div style="margin-top:0px;">
							<a style="color:inherit;" onClick="openSearch();">
								<i style="font-size:2.0em;color:#fff;" class="fa fa-search"></i>
							</a>
						</div>
					</td>
					<td width="25%" align="center" style="border:1px solid #fff;">
						<?php if($tcart->items>0){ ?>
							<div style="margin-top:-12px;">
								<a href="<?php echo base_url('shop/cart'); ?>" style="color:inherit;">
									<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
									<div style="font-size:13px;font-weight:bold;color:#770922;margin:-29px 0px 0px 6px;">
										<?php echo isset($tcart) ? $tcart->items:'0'; ?>
									</div>
								</a>
							</div>
						<?php }else{ ?>
							<div style="margin-top:-12px;">
								<a style="color:inherit;">
									<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
									<div style="font-size:13px;font-weight:bold;color:#770922;margin:-29px 0px 0px 6px;">
										0
									</div>
								</a>
							</div>	
						<?php } ?>
					</td>
					<td width="25%" align="center" style="border:1px solid #fff;">
						<div style="margin-top:5px;">
							<a href="tel:1-877-537-8610" style="color:inherit;">
								<i style="font-size:2.3em;color:#fff;" class="fa fa-phone"></i>
							</a>
						</div>
					</td>
				</tr>	
			</table>
					
		</div>
			
	</div>
	
	<div id="mobile-header">
		<br /><br /><br /><br /><br />
	</div>		
			
	<div id="sear" class="row" style="display:none;height:52px;margin-top:16px;">
		<div class="col-lg-12">
			<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
				<div style="padding-bottom:-20px;">
					<input class="input-text" style="width:100%;height:50px;font-size:18px;text-align:center;padding-bottom:-8px;border:2px solid #770922;" name="search" id="search" placeholder="Enter product code or name ..." type="text">
				</div>
			</form>
		</div>
	</div>

	<div id="men" class="row" style="display:none;margin-top:20px;">		
		<div class="col-lg-12">
		
			<table width="100%">
				<tr height="40">
					<td width="100%" align="center" style="background-color:#770922;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Flowers for the Service</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Standing Sprays</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Wreaths & Hearts</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Tributes</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets-service" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Sympathy Baskets</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/urn-spray" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Urn Spray</div>
						</a>	
					</td>
				</tr>
				<tr height="40">
					<td width="100%" align="center" style="background-color:#770922;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Flowers for Home & Office</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Vase Arrangements</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Sympathy Baskets</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>subcategory/bouquets" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Bouquets</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="<?php echo base_url(); ?>category/plants" style="color:inherit;font-size:14px;color:#770922;">
							<div style="width:100%;">Plants</div>
						</a>	
					</td>
				</tr>
				<tr height="40">
					<td width="100%" align="center" style="background-color:#770922;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="javascript:;" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Colours Collection</div>
						</a>	
					</td>
				</tr>
				<tr height="90">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						
						<table width="100%">
							<tr>
								<td width="1%">
									
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/blue">
										<div style="background-color:#1F50A9;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/lavender">
										<div style="background-color:#8769BE;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/pink">
										<div style="background-color:#FB665F;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/white">
										<div style="background-color:#E5E7D1;width:80%;height:30px;">
										
										</div>
									</a>	
								</td>
								<td width="1%">
								
								</td>
							</tr>
							<tr height="10">
								<td colspan="9">
								
								</td>
							</tr>
							<tr>
								<td width="1%">
									
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/pastel">
										<div style="background-color:#E0D2E5;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/yellow">
										<div style="background-color:#EFDF49;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/peach">
										<div style="background-color:#E56544;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%">
									<a href="<?php echo base_url(); ?>subcategory/red">
										<div style="background-color:#C51A1B;width:80%;height:30px;">
										
										</div>
									</a>
								</td>
								<td width="1%">
								
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
				
				
			</table>
			
				
			
		</div>
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
	//document.getElementById('sear').style.display = "none";
	if($('#men:visible').length == 0){
		document.getElementById('men').style.display = "block";
	}else{
		document.getElementById('men').style.display = "none";
	}
}
function openMenu2(){
	document.getElementById('sear').style.display = "none";
	if($('#men:visible').length == 0){
		document.getElementById('men').style.display = "block";
	}else{
		document.getElementById('men').style.display = "none";
	}
}
/*
function dropMenu(id){
	if($('#l'+id+':visible').length == 0){
		document.getElementById('l'+id).style.display = "block";
	}else{
		document.getElementById('l'+id).style.display = "none";
	}
}
*/					
</script>