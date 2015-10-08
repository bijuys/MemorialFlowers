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
	
	
	
	
	
	
	
	
	<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">
	
	
	
	
	
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


if($affiliate_comp==5886202) { ?>
	<link href="<?php echo theme_url();?>/css/style_lifenews.css" rel="stylesheet" />
<?php } ?>

<?php if($affiliate_comp==378) { ?>
	<link href="<?php echo theme_url();?>/css/style_affilliate.css" rel="stylesheet" />
<?php } ?>

<?php if($affiliate_comp==5886217) { ?>
	<link href="<?php echo theme_url();?>/css/style_sci.css" rel="stylesheet" />
<?php } ?>


<?php if($affiliate_comp=='' || 5886220) { ?>
	<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" />
<?php } ?>



<script type="text/javascript" src="/js/bootstrap.js"></script>







</head>

<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45017969-3', 'memorialflowers.ca');
  ga('send', 'pageview');

</script>

<?php // echo base_url();?>
	<?php if(isset($body)) { echo $body; } ?>
	<div id="top">
	
		<div class="container-fluid" id="top-header">
				
                <?php
				
				//echo $this->session->userdata('ban_id');
				//echo $affiliate_comp;
				
				//echo $this->session->userdata('disease_id').'_'.$this->session->userdata('disease_firstname').'_'.$this->session->userdata('disease_lastname');
				
				$affiliate_comp=$this->session->userdata('referer');
				
				
				
                if($affiliate_comp!='' && $affiliate_comp!=5886220)
				{ ?>
                 
					<?php if($affiliate_comp==5886217){ ?>
				
						 <div style="text-align:center; font-weight:bold; font-size:15px; margin-top:2px; vertical-align:bottom;">
								<img src="<?php echo theme_url();?>/images/affiliates_logo/<?php echo $log; ?>" alt="MemorialFlowers.ca" /><br />
								&nbsp;&nbsp;&nbsp;<span style="color:#01654D;">Served by</span> <img src="<?php echo theme_url();?>/images/logo_2.png" width="160" height="35" />
						 
						 
						 <?php if($this->session->userdata('user_firstname')!='') { ?>
							   <h2 style="color:#000000; font-size:14px; font-family:verdana; margin-top:-112px; float:right; margin-right:25px;">
							   <?php echo "Welcome ".ucfirst($this->session->userdata('user_firstname'))." ".ucfirst($this->session->userdata('user_lastname'));?> | <a href="/affiliates/logout" style="color:#000000; text-decoration:none;">Logout</a></h2>
							   <?php }			  ?>
						
						 
						 
							  
								
						 </div>
				 
				 <?php }else{ ?>
				 
											 <div style="text-align:center; font-weight:bold; font-size:15px; margin-top:20px; vertical-align:bottom;">
								<img src="<?php echo theme_url();?>/images/affiliates_logo/<?php echo $log; ?>" alt="MemorialFlowers.ca" /><br />
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Served by <img src="<?php echo theme_url();?>/images/logo_2.png" width="215" height="55" />
						 
						 
						 <?php if($this->session->userdata('user_firstname')!='') { ?>
							   <h2 style="color:#000000; font-size:14px; font-family:verdana; margin-top:-112px; float:right; margin-right:25px;">
							   <?php echo "Welcome ".ucfirst($this->session->userdata('user_firstname'))." ".ucfirst($this->session->userdata('user_lastname'));?> | <a href="/affiliates/logout" style="color:#000000; text-decoration:none;">Logout</a></h2>
							   <?php }			  ?>
						
						 
						 
							  
								
						 </div>
	
				 
				 
				 <?php } ?>
				      
            
				<?php }
				else { ?>
				
				<?php if($this->session->userdata('test_affiliate') == 5886161) {  ?>
				
					<div style="text-align:center; font-weight:bold; font-size:15px; vertical-align:bottom;">
						<img src="<?php echo base_url();?>/images/affiliate/mpgroup.png" alt="Mount Pleasant group" /><br />
						<div style="margin:-40px 0px 0px 100px;">
						<span style="color:#DEDEDE; font-size:14px;">Served by</span> <img src="<?php echo base_url();?>/images/aff_logo.png" width="215" height="55" />
						</div>
                 
                 <?php if($this->session->userdata('user_firstname')!='') { ?>
					   <h2 style="color:#DEDEDE; font-size:14px; font-family:verdana; margin-top:-132px; float:right; margin-right:25px;">
					   <?php echo "Welcome ".ucfirst($this->session->userdata('user_firstname'))." ".ucfirst($this->session->userdata('user_lastname'));?> | <a href="/affiliates/logout" style="color:#DEDEDE; text-decoration:none;">Logout</a></h2>
					   <?php }			  ?>
				
                 
                 
                      
                        
                 </div>
				
				<?php }else{?>
					
					<div style="text-align:center; font-weight:bold; font-size:15px; margin-top:40px;">
					<img src="<?php echo theme_url();?>/images/memorial-logo.png" alt="MemorialFlowers.ca" width="600" height="150" />
					</div>
					
					
                   <?php if($this->session->userdata('user_firstname')!='') { ?>    
					<h2 style="color:#FFFFFF; font-size:14px; font-family:verdana; margin-top:-112px; float:right; margin-right:25px;">
					  <?php echo "Welcome ".ucfirst($this->session->userdata('user_firstname'))." ".ucfirst($this->session->userdata('user_lastname'));?> | <a href="/affiliates/logout" style="color:#33A1DE; text-decoration:none;">Logout</a></h2>
					   <?php }			  ?>
				
				<?php } ?>
				
                
                
                
				<?php }?>
           
                
                
                
                
                
                     
				
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

