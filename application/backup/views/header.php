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

<!-- /*commmon code for freezer on checkout page and designer code */-->
<script type="text/javascript" src="<?php //echo theme_url();?>/test_files/jquery-1.7.1.min.js"></script>
<!-- /*end here commmon code for freezer on checkout page and designer code */-->


<!-- /*code for freezer on checkout page */-->
 <script  language="javascript"  src="<?php echo theme_url();?>/test_files/login.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/test_files/alertbox_2_jquery.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/test_files/jquery.easing.1.3.js"></script>
<link href="<?php echo theme_url();?>/test_files/main10.css" rel="stylesheet" type="text/css">
<!-- /*end here code for freezer on checkout page */-->






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
//echo isset($gtrack) ? $gtrack:'';
?>

<?php /*if(isset($body)) { echo $body; } 
	
	$dt=$_SERVER['REQUEST_URI'];
	$dt2 = substr($dt, 0, 9);*/
	?>
    <?php //if(isset($body)) { echo $body; } ?>




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

<?php if($this->session->userdata('val')=='sci') { ?>
	<link href="<?php echo theme_url();?>/css/sci_style.css" rel="stylesheet" />
<?php } ?>





<script type="text/javascript" src="/js/bootstrap.js"></script>







</head>

<body>






<?php // echo base_url();?>
	<?php if(isset($body)) { echo $body; } ?>
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45017969-3', 'www.memorialflowers.ca');
  ga('send', 'pageview');

</script>



<!-- Google Code for MemorialFlowers Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 958925177;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "F3-3CIfE1lYQ-ZKgyQM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/958925177/?label=F3-3CIfE1lYQ-ZKgyQM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

    
  <?php
echo isset($gtrack) ? $gtrack:'';
?>  
    
    
    
    
    
    
	<div id="top">
	
		<div class="container-fluid" id="top-header" style="margin-top:-33px;">
		
			<?php 
			
			
			if($this->session->userdata('val')!='sci'){?>
				
                <?php
				
				//echo $this->session->userdata('ban_id');
				//echo $affiliate_comp;
				
				//echo $this->session->userdata('disease_id').'_'.$this->session->userdata('disease_firstname').'_'.$this->session->userdata('disease_lastname');
				
				$affiliate_comp=$this->session->userdata('referer');
				
				
				
                if($affiliate_comp!='' && $affiliate_comp!=5886220)
				{ ?>
                 
					<?php if($affiliate_comp==5886217){ ?>
				
						 <div style="text-align:left; font-weight:bold; font-size:15px; margin-top:2px; vertical-align:bottom;">
								<img src="<?php echo theme_url();?>/images/affiliates_logo/<?php echo $log; ?>" alt="MemorialFlowers.ca" /><br />
								&nbsp;&nbsp;&nbsp;<span style="color:#01654D;">Served by</span> <img src="<?php echo theme_url();?>/images/logo_2.png" width="160" height="35" />
						 
						 
						 <?php if($this->session->userdata('user_firstname')!='') { ?>
							   <h2 style="color:#000000; font-size:14px; font-family:verdana; margin-top:-112px; float:right; margin-right:25px;">
							   <?php echo "Welcome ".ucfirst($this->session->userdata('user_firstname'))." ".ucfirst($this->session->userdata('user_lastname'));?> | <a href="/affiliates/logout" style="color:#000000; text-decoration:none;">Logout</a></h2>
							   <?php }			  ?>
						
						 
						 
							  
								
						 </div>
				 
				 <?php }else if($this->session->userdata('logo')==''){ ?>
				 
					<div style="text-align:center; font-weight:bold; font-size:15px; margin-top:40px;">
					<img src="<?php echo theme_url();?>/images/memorial-logo.png" alt="MemorialFlowers.ca" width="600" height="150" />
					</div>
					
				 <?php }else{ ?>
				 
											 <div style="text-align:left; font-weight:bold; font-size:15px; margin-top:20px; vertical-align:bottom;">
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
				
					<div style="text-align:left; font-weight:bold; font-size:15px; vertical-align:bottom;">
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
           
                
                
                
         <?php }else{ ?>
		 
		 
			
			
			
			
			
			
			<div style="margin-left:19%;font-weight:bold;">
				
				<table width="100%" border="0">
					<tr height="70">
						<td width="16%">
							<img src="<?php echo theme_url();?>/images/logo-green.png" width="215" height="55" />
							&nbsp;&nbsp;
							<img src="<?php echo theme_url();?>/images/dark-line.png" width="5" height="55" style="width:1px;height:40px;" />
						</td>
						<td width="83%">
							<span style="font-size:23px;color:#666666;">
								<?php echo ucwords(strtolower($this->session->userdata('business'))); ?>
							<span>
							<span style="font-size:13px;color:#666666;">
								<br />
								<?php echo ucwords(strtolower($this->session->userdata('address').', '.$this->session->userdata('address'))); ?>	
								<?php echo strtoupper(' '.$this->session->userdata('postalcode')); ?>	
							</span>	
						</td>
					</tr>
				</table>
				
            </div>
			
			
			
			
			
			
			
		 
		 
		 <?php } ?>       
                       
				
		</div><!-- Top Header //-->
		<div id="menu-wrapper" class="navbar">
			<div class="navbar-inner">
				<ul class="nav">
					<?php echo get_menu_entries('mainmenu',1,'li', isset($page) ? $page->page_name:''); ?>
				</ul>
				
				<div class="currency">
			       <!--<?php echo form_open('/shop/currency',array('name'=>'setcur','class'=>'form-inline')); ?>
				      <span class="setcurrency" id="setcurrency">
					      <?php echo getCurrencyMenu('setcur'); ?>
				      </span>
			       <?php echo form_close(); ?>-->
				   <?php if(!$this->session->userdata('val')) { ?>
				   <a href="http://french.memorialflowers.ca" style="color:#fff;text-decoration:none;font-size:18px;font-weight:bold;">
						<img src="<?php echo base_url(); ?>images/french.png" width="30" height="20" />
						&nbsp; Français
				   </a>
				   <?php } ?>
				</div><!-- Currency //-->
			</div>
		</div><!-- Menu Wrapper //-->
	</div><!-- Top //-->
	<div id="container" class="container">
		<div id="wrapper">
