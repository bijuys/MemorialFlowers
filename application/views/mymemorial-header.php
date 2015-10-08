<?php
$tcart = get_tiny_cart();
$ci =& get_instance();

?>
<!doctype html>
<html lang="en">
<head>
<meta name="robots" content="noodp,noydir" />
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
		echo 'Memorial Flowers - Online flowers Canada';
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
<link rel="shortcut icon" href="<?php echo theme_url();?>/images/favicon.ico" />
<script>
<!--
if(top.location != location) {
    top.location.href = document.location.href;
}
//-->
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fc.js"></script>
<!--[if lt IE 7]>
<style>
    img, div, h1, h2, .product span { behavior: url(/css/iepngfix.htc) }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/iepngfix_tilebg.js"></script>  
<![endif]-->

<?php
echo isset($js) ? $js:'';
echo isset($css) ? $css:'';
?>
<link href="<?php echo theme_url();?>/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>
</head>



<?php 

$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");

$today = date("Y-m-d");
	$day = substr($today, 8, 2);
	$year = substr($today, 0, 4);
	//YEAR AND MONTH
	$month = substr($today, 0, 7);
	$month2 = substr($today, 5, 2);
	
?>

<body>


	<?php if(isset($body)) { echo $body; } ?>
	<div id="top" style="background-image:url();background-color:#fff;position:fixed;width:100%;">
		<div style="width: 1190px; margin:0px auto;">
			<table width="100%" border="0">
				<tr>
					<td width="48%" >
						<h1><img src="<?php echo template_url('img/memlogo.png');?>" alt="" style="width:150px; height:90%;" /></h1>
					</td>
					<td width="52%" >
						
					</td>
				</tr>
			</table>
		</div><!-- Top Header //-->
		<div id="menu-wrapper" class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<?php echo get_menu_entries('mymemorial2',1,'li', isset($page) ? $page->page_name:''); ?>
				</ul>
			</div>
		</div><!-- Menu Wrapper //-->
	</div><!-- Top //-->
	<div id="container" class="container">
		<div id="wrapper">
			
			<br /><br /><br /><br /><br />
