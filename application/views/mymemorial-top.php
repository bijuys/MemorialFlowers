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
			<div class="col-sm-12 text-center">
				<h1><a href="<?php echo base_url();?>" id="logo"><img src="<?php echo template_url('img/memlogo.png');?>"  alt="Memorial Flowers"></a></h1>
			</div>
		</div>
	</div>		
</header>
