<?php
$tcart = get_tiny_cart();
$ci =& get_instance();

?>
<!doctype html>
<html lang="en">
<head>
<meta name="robots" content="noodp,noydir"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	
	
	
	
	
	
	
	
	 <link href="css/memorial_slider/css/styles.css" type="text/css" media="all" rel="stylesheet" />

	<!-- Skitter Styles -->
	<link href="css/memorial_slider/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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

<?php
echo isset($gtrack) ? $gtrack:'';
?>

<?php if(isset($body)) { echo $body; } 
	
	$dt=$_SERVER['REQUEST_URI'];
	$dt2 = substr($dt, 0, 9);
	?>
    <?php if(isset($body)) { echo $body; } ?>




<link href="<?php echo theme_url();?>/css/bootstrap.css" rel="stylesheet" />

<?php
$affiliate_comp=$this->session->userdata('referer');
$log = $this->session->userdata('logo');

if($affiliate_comp!='')
{ ?>
<link href="<?php echo theme_url();?>/css/style_affilliate.css" rel="stylesheet" />
<?php }
else { ?>
<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" />
<?php }?>


<script type="text/javascript" src="/js/bootstrap.js"></script>
</head>

<body>
<?php // echo base_url();?>
	<?php if(isset($body)) { echo $body; } ?>
	<div id="top">
	
		<div class="container-fluid" id="top-header">
				
                <?php
				
				//echo $affiliate_comp;
				
				/*$affiliate_comp=$this->session->userdata('referer');
                if($affiliate_comp!='')
				{ */?>
                 
				 
				
				 <div style="text-align:center; font-weight:bold; font-size:15px; vertical-align:bottom;">
						<img src="<?php echo base_url(); ?>images/affiliate/logo_full.gif" alt="MemorialFlowers.ca" /><br />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<span style="color:#DEDEDE;">Served by</span> <img src="<?php echo theme_url();?>/images/logo_2.png" width="215" height="55" />
                 
                 
                
				
                 
                 
                      
                        
                 </div>
				      
            
				
           
                
                
                
                
                
                     
				
		</div><!-- Top Header //-->
		<div id="menu-wrapper" class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<?php echo get_menu_entries('mainmenu',1,'li', isset($page) ? $page->page_name:''); ?>
				</ul>
				
				<div class="currency">
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

