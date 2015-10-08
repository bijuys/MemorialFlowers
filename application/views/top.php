<?php
$tcart = get_tiny_cart();
$ci =& get_instance();

include_once('header.php');?>

<style>
@media screen and (min-width : 769px) {
	#mobile-header { display: none; }
	#mobile-header2 { display: none; }
	#ipad-header { display: none; }
	#responsive { display: block; }
	#page { margin-left:-30px;margin-right:-30px; }
	.container { max-width: 940px; }
	body { overflow-x: hidden; }
	#shipping-funeral-home { margin-right:150px; }
}

@media screen and (min-width : 700px) and (max-width : 768px) {
	#mobile-header { display: block; }
	#mobile-header2 { display: none; }
	#ipad-header { display: block; }
}
@media screen and (min-width : 0px) and (max-width : 667px) {
    #mobile-header { display: block; }
	#mobile-header2 { display: block; }
	#ipad-header { display: none; }
	#responsive { display: none; }
	#left-navigation { display: none; }
	#caller-info { display: none; }
	body{ padding-top:0px;overflow-x: hidden; }
	#bo-text { padding-left:25px;padding-right:28px; }
}

@media screen and (min-width : 0px) and (max-width : 414px) {
    .logo-mobile{ width:100%; }
}

@media screen and (orientation: portrait){
	.orienta{ 
		height:100% 
	}
}

@media screen and (orientation: landscape){
	.orienta{ 
		height:100%; 
	}
}
</style>

<?php
$previ = $_SERVER['PATH_INFO'];
$goto = 'http://french.memorialflowers.ca'.$previ;		
?>

<script>
function sendToSister(){
	//alert('oscar'+);
	//alert("_<?php echo $goto; ?>");
	window.location.href = "<?php echo $goto; ?>";
}
</script>

<header>
	<div class="container" style="margin-top:-10px;">
		<div id="responsive" class="row">
			<div class="col-sm-6" style="padding-top:1.5%;">
				<!--<h1><a href="<?php echo base_url();?>" id="logo"><img src="<?php echo template_url('img/dignityflowers-logo-213x45.png');?>"  alt="Dignity Flowers"></a></h1>-->
				<h1><a href="<?php echo base_url();?>" id="logo"><img src="<?php echo template_url('img/memlogo.png');?>"  style="width: 200px; height:auto;" alt="Dignity Flowers"></a></h1>
			</div>

			<div class="col-sm-6" style="padding-top:10px;">
				<div id="top-buttons" class="pull-right" style="position:relative;">
					<?php if($tcart->items>0){ ?>
						<a href="<?php echo base_url('shop/cart'); ?>" class="cart-button"  style="text-decoration:none;" >
							<i class="fa fa-shopping-cart"></i>
							<span style="font-size:11px;"><?php echo isset($tcart) ? $tcart->items:'0'; ?>  <?php echo lang('Item(s)'); ?></span>
						</a>
					<?php }else{ ?>
						<a class="cart-button empty"  style="text-decoration:none;">
							<i class="fa fa-shopping-cart"></i>
							<span style="font-size:11px;">0 Item(s)</span>
						</a>
					<?php } ?>
					<a href="#" class="lang-button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Language: EN <i class="fa fa-triangle-bottom"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="position:absolute;">
						<!--<li><a href="http://www.memorialflowers.ca">English</a></li>-->
						<li><a href="javascript:;" onclick="sendToSister();">French</a></li>
					</ul>
				</div>
				
				
			</div>
		</div>
	</div>		
</header>
<div id="sub-header">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<span id="order-by-phone">
					Order by Phone: 1-877-537-8610
				</span>
			</div>
			<div class="col-sm-4">
				
				<form method="post" id="site-searchform" action="/search">
					<div class="text-right">
						<input class="input-text" name="search" id="search" style="width:150px;" placeholder="Search products ..." type="text">
						<button id="searchsubmit" value="Search" class="pull-right btn btn-primary" type="submit"><i class="fa fa-search"></i>
					</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>

<div class="container" style="padding-left:0px;padding-right:0px;">
	
	<div id="mobile-header" class="row" style="position:fixed;width:110%;background-color:transparent;z-index:5000;margin-top:-20px;padding-bottom:5px;">
			
		<div class="col-lg-12">
			
			<table width="100%" border="0" style="background-color:#fff;">
				<tr>
					<td width="82%" align="center" style="padding-left:13%;">
						<!--<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>templates/dignity/img/dignityflowers-logo-213x45.png" alt="Dignity Flowers"></a>-->
						<a href="<?php echo base_url();?>"><img src="<?php echo template_url(); ?>/img/memlogo.png" class="logo-mobile" alt="Memorial Flowers"></a>
					</td>
					<td width="18%" align="center" style="padding-right:7%;">
						<!--
						<li id="cart-icon">
							<?php if(isset($tcart) && $tcart->items>0) : ?>
								<a href="/shop/cart"><span style="margin-top:-10px;"><?php echo $tcart->items;?></span></a>
							<?php endif; ?>
						</li>
						-->
						<?php if($tcart->items>0){ ?>
							<a href="<?php echo base_url();?>shop/cart" style="text-decoration:none;">
								<i class="fa fa-shopping-cart" style="color:#8A8E8E;font-size:1.5em;"></i>
								<div style="border:1px solid #41C1C0;background-color:#41C1C0;color:#fff;font-size:11px;font-weight:bold;margin-top:-32px;margin-left:20px;width:15px;height:16px;">
									&nbsp;<?php echo $tcart->items; ?>&nbsp;
								</div>
							</a>	
						<?php }else{ ?>
							<a href="<?php echo base_url();?>shop/cart" style="text-decoration:none;">
								<i class="fa fa-shopping-cart" style="color:#BFC1C2;font-size:1.5em;"></i>
							</a>
						<?php } ?>
					</td>
				</tr>
				<tr style="background-color:#E9E8E6;">
					<td colspan="3" align="center">
						<table width="100%" border="0">
							<tr>
								<td width="100%" align="center">
									<div style="padding-top:5px;padding-bottom:5x;">
										<span id="order-by-phone">
											<small>Order by Phone: 1-877-537-8610</small>
										</span>
									</div>
								</td>
							</tr>
						</table>
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
					<input class="input-text" style="width:100%;height:50px;font-size:18px;text-align:center;padding-bottom:-8px;border:2px solid #5BC5C3;" name="search" id="search" placeholder="Enter product code or name ..." type="text">
				</div>
			</form>
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
	document.getElementById('men3').style.display = "none";
	if($('#men:visible').length == 0){
		document.getElementById('men').style.display = "block";
	}else{
		document.getElementById('men').style.display = "none";
	}
}
function openMenu3(){
	document.getElementById('men').style.display = "none";
	if($('#men3:visible').length == 0){
		document.getElementById('men3').style.display = "block";
	}else{
		document.getElementById('men3').style.display = "none";
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





	  <script>
			function isNumber(evt) {
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
			function checkLink2(val){
				var dat = document.getElementById('va_link_type').value;
				document.getElementById('va_link_color').value=""+val;
				var dat3 = document.getElementById('va_link_name').value;
				var dat4 = document.getElementById('sortby_val').value;
				//PRICE RANGE
				var min_val = document.getElementById('min_val').value;
				var max_val = document.getElementById('max_val').value;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				//PRICE RANGE
				if(dat4==''){
					dat4='BM';
				}
				
				
				if(dat==''){
					//alert("<?php echo base_url(); ?>subcategory/"+val);
					//if(dat3=='' || dat3=='blue' || dat3=='lavender' || dat3=='pink' || dat3=='pastel' || dat3=='white' || dat3=='yellow' || dat3=='peach' || dat3=='red'){
						document.getElementById('va_link_type').value;
						window.location.href = "<?php echo base_url(); ?>subcategory/"+val+"/1";
					//}
				}else{
					if(dat3=='' || dat3=='blue' || dat3=='lavender' || dat3=='pink' || dat3=='pastel' || dat3=='white' || dat3=='yellow' || dat3=='peach' || dat3=='red'){
						document.getElementById('va_link_type').value;
						window.location.href = "<?php echo base_url(); ?>subcategory/"+val+"/1";
					}else{
						//window.location.href = "<?php echo base_url(); ?>subcategory/"+val+"/1";
						window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/1/"+val+"/"+min_val+"/"+max_val+"/"+dat4;
					}
				}
			}
			function checkValores(){
				
				var dat = document.getElementById('va_link_type').value;
				var dat2 = document.getElementById('va_link_color').value;
				var dat3 = document.getElementById('va_link_name').value;
				
				var dat4 = document.getElementById('sortby_val').value;
					if(dat2==''){
						dat2='all';
					}
				min_val = document.getElementById('min_val').value;
				max_val = document.getElementById('max_val').value;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				if(dat4==''){
					dat4='BM';
				}
				
				if(dat!=''){
					window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/1/"+dat2+"/"+min_val+"/"+max_val+"/"+dat4;
				}else{
					window.location.href = "<?php echo base_url(); ?>products/catalog/1/all/"+min_val+"/"+max_val+"/"+dat4;
					//alert('You have not selected a category. Please select a category to apply filter !');
				}
			}
			function changeSortBy(val){
				document.getElementById('sortby_val').value = val;
				var dat = document.getElementById('va_link_type').value;
				var dat2 = document.getElementById('va_link_color').value;
				if(dat2==''){
					dat2='all';
				}
				var dat3 = document.getElementById('va_link_name').value;
				min_val = document.getElementById('min_val').value;
				max_val = document.getElementById('max_val').value;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/<?php echo $pagi; ?>/"+dat2+"/"+min_val+"/"+max_val+"/"+val;
			}
			function addValorTe1(val)
			{
				document.getElementById('min_val').value = val;
			}
			function addValorTe2(val)
			{
				document.getElementById('max_val').value = val;
			}
			function removePriceRange()
			{
				//alert("0 - 1000");
				//document.getElementById('sortby_val').value = val;
				var dat = document.getElementById('va_link_type').value;
				var dat2 = document.getElementById('va_link_color').value;
				if(dat2==''){
					dat2='all';
				}
				var dat3 = document.getElementById('va_link_name').value;
				var dat4 = document.getElementById('sortby_val').value;
				min_val = document.getElementById('min_val').value;
				max_val = document.getElementById('max_val').value;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/<?php echo $pagi; ?>/"+dat2+"/0/1000/"+dat4;
			}
			function removeColor()
			{
				//alert("0 - 1000");
				//document.getElementById('sortby_val').value = val;
				var dat = document.getElementById('va_link_type').value;
				var dat2 = document.getElementById('va_link_color').value;
				if(dat2==''){
					dat2='all';
				}
				var dat3 = document.getElementById('va_link_name').value;
				var dat4 = document.getElementById('sortby_val').value;
				min_val = document.getElementById('min_val').value;
				max_val = document.getElementById('max_val').value;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/<?php echo $pagi; ?>/all/"+min_val+"/"+max_val+"/"+dat4;
			}
			function goToHome()
			{
				window.location.href = "<?php echo base_url(); ?>";
			}
			/*
			function checkValores2(val){
				var dat = document.getElementById('va_link_type').value;
				var dat2 = document.getElementById('va_link_color').value;
				var dat3 = document.getElementById('va_link_name').value;
					if(dat2==''){
						dat2='all';
					}
				max_val = document.getElementById('max_val').value;
				min_val = val;
				if(min_val==''){
					min_val=0;
				}
				if(max_val==''){
					max_val=1000;
				}
				window.location.href = "<?php echo base_url(); ?>"+dat+"/"+dat3+"/1/"+dat2+"/"+min_val+"/"+max_val;
			}
			*/
			</script>
			
			<input type="hidden" id="va_link_type" name="va_link_type" value="<?php echo $ti; ?>">
				<input type="hidden" id="va_link_name" name="va_link_name" value="<?php echo $ti2; ?>">
				<input type="hidden" id="va_link_color" name="va_link_color" value="<?php echo $e_color; ?>">
				<input type="hidden" id="va_link_orderby" name="va_link_orderby" value="<?php echo $e_orderby; ?>">
				<input type="hidden" id="min_val" name="min_val" value="<?php echo $e_min; ?>">
				<input type="hidden" id="max_val" name="max_val" value="<?php echo $e_max; ?>">
				<input type="hidden" id="sortby_val" name="sortby_val" value="<?php echo $sortby_val; ?>">
	  
	  
	  
