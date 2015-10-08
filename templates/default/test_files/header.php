<?php
$tcart = get_tiny_cart();
$ci =& get_instance();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
			  if($product->category_id==1){
				  $catego='Plants';
			  }else if($product->category_id==3){
				  $catego='Specialty Gifts';
			  }else if($product->category_id==14){
				  $catego='Flowers';
			  }else if($product->category_id==26){
				  $catego='Sympathy';
			  }else if($product->category_id==29){
				  $catego='Hot Deals';
			  }else if($product->category_id==30){
				  $catego='International';
			  }else if($product->category_id==31){
				  $catego='Same Day';
			  }else if($product->category_id==32){
				  $catego='Seasonal';
			  }else if($product->category_id==33){
				  $catego='MLSE';
			  }else if($product->category_id==34){
				  $catego='Jewellery';
			  }else if($product->category_id==35){
				  $catego='Flowers For A Cause';
			  }
			  if($catego==''){
				  echo 'Flower Delivery Canada | Flowers Canada';
			   
				  }else{
			  
			 echo rightLang($product->product_name,$product->product_name_fr).' | '.$catego;
				  }
			  
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
		//echo "Ordering flowers online at What A Bloom is a breeze, with seasonal websites for the busiest times of year such a Valentine's Day and Mothers Day, it makes shopping that much easier.";
		
		echo rightLang($product->product_name,$product->product_name_fr).'. '. substr(rightLang($product->product_description,$product->product_description_fr), 0, 130);
		
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
		//echo 'florist Toronto, flowers Vancouver, flower shop Richmond BC Canada, flower delivery Vancouver';
		echo rightLang($product->product_name,$product->product_name_fr).', '.$catego;
	     }
	?>" />
<meta name="copyright" content="(c) 2013 FlowersCanada.com" />
<meta name="robots" content="all" />
<meta name="rating" content="General" />
<meta name="author" content="Flowers Canada" />
<meta name="revisit-after" content="7 days" />
<meta name="distribution" content="Global" />
<meta http-equiv="Content-Language" content="en-us" />

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


 <!-- /*ITs me added for innerpages design */-->
<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url();?>/css/stylesheet_innerpages.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url();?>/css/stylesheet_innerpages2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url();?>/css/buttons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url();?>/css/constants.css" rel="stylesheet" type="text/css" />
<!-- /*end here ITs me added for innerpages design */-->


<!-- /*code for freezer on checkout page */-->
<script type="text/javascript" src="<?php echo theme_url();?>/scripts/jquery-1.7.1.min.js"></script>
 <script  language="javascript"  src="<?php echo theme_url();?>/test_files/login.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/test_files/alertbox_2_jquery.js"></script>
<script type="text/javascript"  src="<?php echo theme_url();?>/test_files/jquery.easing.1.3.js"></script>
<link href="<?php echo theme_url();?>/test_files/main10.css" rel="stylesheet" type="text/css">





<!-- /*end here code for freezer on checkout page */-->


<!-- /*designer code  */-->
<link href="<?php echo theme_url();?>/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php echo theme_url();?>/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo theme_url();?>/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo theme_url();?>/scripts/nivo-slider.css" type="text/css" media="screen" />
 <script type="text/javascript" src="<?php echo theme_url();?>/scripts/jquery.nivo.slider.pack.js"></script>
    
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
    
 

  
  
 <!-- /*calendar code */-->
<link rel="stylesheet" type="text/css" href="<?php echo theme_url();?>/ext/jquery/ui/redmond/jquery-ui-1.8.6-osc.css" />
<script type="text/javascript" src="<?php echo theme_url();?>/ext/jquery/ui/jquery-ui-1.8.6.min.js"></script>
<!-- /*calendar code end */-->
  <!--//analytics code-->

<!--<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22591984-10']);
  _gaq.push(['_setDomainName', '.flowerscanada.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->
<!--Admin control files here-->
<script type="text/javascript" src="/js/fc.js"></script>
<!--End Code Admin control files here-->

<!--Inner pages jss and css working Espacially in *Use Above Address* -->
 <?php
echo isset($js) ? $js:'';
echo isset($css) ? $css:'';
?>
<!--End Code Inner pages jss and css working Espacially in *Use Above Address* -->


   
    <?php
echo isset($gtrack) ? $gtrack:'';
?>
</head>
<body>
<?php if(isset($body)) { echo $body; } 
	
	$dt=$_SERVER['REQUEST_URI'];
	$dt2 = substr($dt, 0, 9);
	?>
    <?php if(isset($body)) { echo $body; } ?>
    
    
    

<div id="container">
  <div id="top-bar">
    <div id="logo">
     <?php if($ci->session->userdata['referer']) { ?>
            <a href="<?php echo site_url();?>"><img src="/uploads/<?php echo $ci->session->userdata['referer_logo'];?>" alt="<?php echo $ci->session->userdata['referer_sitename'];?>"/>
            </a>
     <?php
            }
            else
            { ?>
              
              <a class="logo" href="<?php echo base_url();?>">
              <img src="<?php echo theme_url();?>/images/flowerscanada-logo.png" alt="Flowers Canada" title="Flowers Canada"  />
               </a>
         
            <?php } ?>
    
  
    
    
    </div>
    <div id="top-right">
    
    
   
        
    
    	<?php echo form_open('/shop/currency',array('name'=>'setcur')); ?>
      <div id="currency">Currency
       
       <?php echo getCurrencyMenu('setcur'); ?>
	    <?php echo form_close(); ?>
        <!--<select class="currency-feild">
          <option>$ CAD</option>
        </select>-->
      </div>
      <div class="top-menu">
        <div class="search-div">
        <?php  echo form_open('/search'); //when I do this to put my string, it does not work?>
          <input type="text" name="search" id="search_term2" value="<?php echo lang('Keyword or item#');?>" class="search-input" onblur="if(this.value=='') this.value='Keyword or item#';" onfocus="if(this.value=='Keyword or item#') this.value=''" />
          <input name="btnDoSearch" id="btnDoSearch2" type="submit" class="search-btn" value="Search"  alt="<?php echo lang('Search');?>" title="<?php echo lang('Search');?>"/>
 <?php echo form_close();?>
         
  
        </div>
         <?php $custid = $this->session->userdata('customer_id'); ?>
         <?php
      if($custid==0 && empty($custid) && $custid==NULL)
      {
	  ?>
               
      <a href="../user/signin"><?php echo lang('Sign in');?></a> | <a href="../user/signup"><?php echo lang('Register');?></a>
      
      
      <?php 
	  }
	  else
	  {
		?>
        
        <a href="/myaccount"><?php echo lang('My Account');?></a> | <a href="/signout"><?php echo lang('Sign out');?></a>
        
        
        <?php
		  
	  }
	  
	  
	  
	  
	  ?>
      | <a href="/support/tracking"> <?php echo lang('Order Tracking');?></a>|<a href="/customer-service.html"><?php echo lang('Customer Service')?></a></div>
      <div class="claer small-h"></div>
      <div class="order-before"> <a href="/delivery/grower-direct" style="text-decoration:none;"><img src="<?php echo theme_url();?>/images/order-before.png" width="263" height="89" border="0" /></a></div>
      <div class="top-bottom-right">
        <div class="phn-num">To Order by Phone <strong>1-888-339-9666</strong></div>
       
     <?php
      if($custid>0 && !empty($custid) && $custid!=NULL)
      {
	  ?>
       <div class="welcome-cus">
	   <a href="/myaccount">
	   <?php
	  
         echo lang('Welcome ');
		  echo $this->session->userdata('user_firstname') . ' ' .$this->session->userdata('user_lastname');
		  ?>
         </div>
		  <?php

      }
	  else
	  {
       ?>
       <div class="welcome-cus">&nbsp;</div>
        <?php
	  }?>
        <div class="cart-item"> <a href="/shop/cart">My Cart : <?php
							 echo isset($tcart) ? $tcart->items:'0';?>  <?php echo lang('item(s)');?>: <?php  echo isset($tcart) ? getRate($tcart->gtotal):getRate(0);?>
                      
                        </a></div>
        
        
        
        
       
        
        
        
        
        
      </div>
      <div class="claer"></div>
    </div>
    <div class="claer"></div>
  </div>
  <div>
  <nav>
    <ul class="ul-none">
 <!--     <li><a href="#">Spring</a></li>
      <li><a href="#">Sympathy</a></li>
      <li><a href="#">Flowers</a>
      	<ul>
        	<li><a href="#">Mixed Bouquets</a></li>
            <li><a href="#">Roses</a></li>
			<li><a href="#">Lilies</a></li>
            <li><a href="#">Orchids</a></li>
			<li><a href="#">Daisies</a></li>
            <li><a href="#">Tulips</a></li>
        </ul>
      </li>
      <li><a href="#">Plants</a>
	  
	  	<ul>
        	<li><a href="#">Test Menu</a></li>
            <li><a href="#">Test Menu</a></li>
			<li><a href="#">Test Menu</a></li>
            <li><a href="#">Test Menu</a></li>
        </ul>
	  </li>
      <li><a href="#">Birthday</a></li>
      <li><a href="#">Gift Box</a></li>
      <li><a href="#">Thank-You</a></li>
      <li><a href="#" class="brdr-none">Same-Day</a></li>-->
      
      	<?php echo get_menu_entries('mainmenu',1,'li',isset($page) ? $page->page_name:''); ?>
    </ul>
    </nav>
    <div class="claer"></div>
  </div>
