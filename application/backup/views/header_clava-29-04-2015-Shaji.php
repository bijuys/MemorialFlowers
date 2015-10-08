<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" class="no-js" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php if(isset($page) && !empty($page->page_title))
	     {
		    echo $page->page_title;
	     }
	     elseif(isset($title))
	     {
			echo $title;
	     }
	     else
	     {
			echo 'MemorialFlowers.ca - Online flowers Canada';
	     }
	?></title>

<meta name="description" content="<?php if(isset($description))
	     {
		    echo $description;
	     }
	     elseif(isset($page) && !empty($page->description))
	     {
			echo $page->description;
	     }
	     else
	     {
		echo 'Order flowers, roses, and gift baskets online & send same day flower delivery for birthdays and anniversaries from trusted florist 1-800-Flowers.ca.';
	     }
	?>" />
 
 <meta name="keywords" content="<?php if(isset($keywords))
	     {
		    echo $keywords;
	     }
	     elseif(isset($page) && !empty($page->keywords))
	     {
		echo $page->keywords;
	     }
	     else
	     {
		echo 'Flowers, flower delivery, birthday flowers, mother’s day flowers, gift baskets, roses';
	     }
	?>" />
    
    <link rel="canonical" href="<?php if(isset($canonical))
	     {
	         echo $canonical;
	     }
	     elseif(isset($page) && !empty($page->canonical))
	     {
			 echo $page->canonical;
	     }
	     else
	     {
			 echo current_url();
	     }
	?>" />
   
		<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>">
        
        
	<!-- CSS FILES -->
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/js/rs-plugin/css/settings.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/clava/css/style.css');?>" media="screen" data-name="skins">
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/layout/wide.css');?>" data-name="layout"> 
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/clava/css/switcher.css');?>" media="screen" />-->
	<script src="<?php echo base_url('templates/clava/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>
    
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>-->
	<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/style-mf.css');?>">    
    
    
</head>
<body>
<!--
::Note these::

putting google code here breaks template
-->
<?php $tcart = get_tiny_cart(); ?>
	<!--Start Header-->
	<!--<header id="header" style="height:113px;">-->
	<header id="header">
    
			<div class="row" style="padding: 5px; background-color: #F8F8F8;display:none;">
				
					<div class="topmenu col-sm-3 col-md-3 col-lg-3 pull-right">
						
					<a href="<?php echo base_url('shop/cart'); ?>"><i class="fa fa-shopping-cart"></i> <?php echo isset($tcart) ? $tcart->items:'0';?>  <?php echo lang('item(s)');?></a>
				
					</div>
			
			</div>    
    
			<div class="row">
			<!-- Logo / Mobile Menu -->
				<div class="col-lg-2">
				
				</div>
			
				<div class="col-sm-12 col-md-12 col-lg-3">
					<div id="mobile-navigation" style="margin-top:10px;">
						<a href="#menu" class="menu-trigger">
							<i class="fa fa-bars"></i>
						</a>
					</div>
					<a href="<?php echo base_url(); ?>" style="padding-left:20px;">
						
						<img src="<?php echo base_url(); ?>images/mf-new-logo.png" width="40%" style="margin-top:10px;" />
						<!--<img src="<?php echo base_url('templates/clava/img/logo_2.png'); ?>" width="70%" style="margin-top:10px;" />-->
					</a>
				</div>
				
				<div class="col-sm-12 col-md-12 col-lg-1">
					<div class="row">
						<div class="col-lg-12" style="text-align:right;padding-top:25px;">
							<?php if($tcart->items>0){ ?>
								<a href="<?php echo base_url('shop/cart'); ?>" style="font-size:25px;">
									<i class="fa fa-shopping-cart"></i>
									<span style="font-size:11px;"><?php echo isset($tcart) ? $tcart->items:'0'; ?>  <?php echo lang('Item(s)'); ?></span>
								</a>
							<?php }else{ ?>
								<a style="font-size:25px;color:inherit;">
									<i class="fa fa-shopping-cart"></i>
									<span style="font-size:11px;">0 Item(s)</span>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>

				<!-- Navigation
				================================================== -->
				<div class="col-lg-4">
					<nav id="navigation" class="menu">
						<ul id="responsive">
							<!--
							<li><a href="#">Home</a>
                            	<ul>
									<li><a href="<?php echo base_url('exit_clava');?>">Exit Template</a></li>		
								</ul>
							</li>
							-->
							<li><a href="#">Categories</a>
								<ul>                            
								<?php 
								/*
								::Note these::
								130 stands for 'category', got from get_menu_entries() app_helper
								*/
								$catg_menu_items = get_categ_menuitems(130); 
								foreach($catg_menu_items as $menu_item){
								?>	 
									<li><a href="<?php echo base_url($menu_item->menulink);?>"><?php echo ucwords($menu_item->menuitem);?></a></li>						
								<?php 	
								}
								?>
								</ul>	
							</li>
							<li><a href="#">Locations</a>
								<ul>
									<li><a href="<?php echo base_url('occasion/flowers-for-service');?>">For Service</a></li>
									<li><a href="<?php echo base_url('occasion/flowers-for-home-and-office');?>">For Home & Office</a></li>
									<li><a href="<?php echo base_url('occasion/flowers-for-cremation');?>">For Cremation</a></li>
								</ul>
							</li>
							<li>
								<a href="<?php echo base_url('category/fruit-baskets');?>">Gift Baskets</a>
							</li>
							<li><a href="#">By Colour</a>
                            	<ul>
								<?php 
								/*
								::Note these::
								134 stands for 'colours', got from get_menu_entries() app_helper
								*/
								$catg_menu_items = get_categ_menuitems(134); 
								foreach($catg_menu_items as $menu_item){
								?>	 
									<li><a href="<?php echo base_url($menu_item->menulink);?>"><?php echo ucwords($menu_item->menuitem);?></a></li>						
								<?php 	
								}
								?>
								</ul>
							</li>
							<li><a href="#">By Price</a>
                            	<ul>
									<li><a href="<?php echo base_url(); ?>pricing/1-100">$1 - $100</a></li>	
									<li><a href="<?php echo base_url(); ?>pricing/101-200">$101 - $200 </a></li>	
									<li><a href="<?php echo base_url(); ?>pricing/201-300">$201 - $300</a></li>	
									<li><a href="<?php echo base_url(); ?>pricing/301-500">$301 - $500</a></li>	
									<li><a href="<?php echo base_url('exit_clava');?>">Exit Template</a></li>		
								</ul>
							</li>
						</ul>
					</nav>
				</div>
				<div class="col-lg-2">
				
				</div>
			</div>
	</header>
	<!--End Header-->
<!--
::Note these::

Affiliates code note included

-->