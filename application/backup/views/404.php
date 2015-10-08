<?php
$tcart = get_tiny_cart();
$ci =& get_instance();
?>
<html lang="en">
<head>
<meta name="robots" content="noodp,noydir"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title))
	     {
		    echo $title;
	     }
	     elseif(isset($page) && !empty($page->page_title))
	     {
		echo $page->page_title;
	     }
	     else
	     {
		echo 'Memorial Flowers Canada';
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
<link rel="shortcut icon" href="http://www.memorialflowers.ca/templates/default/images/favicon.ico" />
<script>
<!--
if(top.location != location) {
    top.location.href = document.location.href;
}
//-->
</script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="/js/fc.js"></script>
<!--[if lt IE 7]>
<style>
    img, div, h1, h2, .product span { behavior: url(/css/iepngfix.htc) }
</style>
<script type="text/javascript" src="/js/iepngfix_tilebg.js"></script>  
<![endif]-->

<?php
echo isset($js) ? $js:'';
echo isset($css) ? $css:'';
?>
<link href="<?php echo theme_url();?>/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" />
<script type="text/javascript" src="/js/bootstrap.js"></script>
</head>
<body>
<?php if(isset($body)) { echo $body; } ?>
	<div id="top">
		<div class="container-fluid" id="top-header">
				<h1 class="text-center"><img src="<?php echo theme_url();?>/images/memorial-logo.png" alt="MemorialFlowers.ca" /></h1>
		</div><!-- Top Header //-->
		<div id="menu-wrapper" class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<?php echo get_menu_entries('mainmenu',1,'li',isset($page) ? $page->page_name:''); ?>
				</ul>
				<div class="pull-right currency">
			       <?php echo form_open('/shop/currency',array('name'=>'setcur','class'=>'form-inline')); ?>
				      <span class="setcurrency" id="setcurrency">
					      <?php echo getCurrencyMenu('setcur'); ?>
				      </span>
			       <?php echo form_close(); ?>
				</div><!-- Currency //-->
			</div>
		</div><!-- Menu Wrapper //-->
	</div><!-- Top //-->
	<div id="container" class="container">
		<div id="wrapper">
            <div class="content">
            <div id="main" class="page-content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
		<?php if(isset($page)) : ?>
                <?php echo ($this->session->userdata('language')=='french') ? $page->contents_fr:$page->contents; ?>
		<?php endif; ?>
            </div> <!-- main -->
            </div> <!-- content -->
        <div id="footer">
					<div class="row-fluid">
						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer1',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer2',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer3',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer4',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span8">
							<h4>Signup for Special Offers</h4>
							
							

							<?php echo form_open('/support/subscribe');?>
								<div class="input-append">

									<input type="text" name="email" placeholder="Enter Email Address" class="input-large" />
									<input type="submit" name="submit" value="Signup" class="btn btn-inverse" />
								</div>
							<?php echo form_close(); ?>
							<p>
							<img src="<?php echo theme_url();?>/images/memorial-name.png" /></p>
							<p>Order by Phone: <strong><big>1-877-537-8610</big></strong></p>


						</div> <!-- Span8 //-->

					</div><!-- Row Fluid //-->
			</div><!-- Footer //-->
			<div class="copyright text-center">
				&copy; 2007-2013 MemorialFlowers.ca All rights are reserved.
			</div><!-- Copyright //-->
	</div><!-- Wrapper //-->
</div><!-- Container //-->
<div id="mask"></div>
<?php if(isset($footer)) { echo $footer; } ?>
</body>
</html>