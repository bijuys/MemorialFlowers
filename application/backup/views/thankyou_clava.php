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
   

<?php 
$vaseID = $this->session->userdata('vaseID');


// include_once('header_clava.php');



?>	



<!--
:: for Oscar -- to avoid header::

-->
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico'); ?>">
	<!-- CSS FILES -->
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/js/rs-plugin/css/settings.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/clava/css/style.css');?>" media="screen" data-name="skins">
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/layout/wide.css');?>" data-name="layout"> 
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('templates/clava/css/switcher.css');?>" media="screen" />-->
	<script src="<?php echo base_url('templates/clava/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js');?>"></script>
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/style-mf.css');?>">   

<!--
:: to avoid header::

-->

</head>
<body>


<!--start wrapper-->
	<section class="wrapper">
		
		
		
		<section class="content about">
			<div class="container">
				
				<div class="row" style="margin-bottom:20px;">
					<div id="stepi" class="col-sm-12 col-md-12 col-lg-3" style="margin-top:-20px;">
						<a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url(); ?>images/mf-logo-new.png" width="100%" />
						</a>
					</div>
					<div class="text-center col-lg-6 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;">
						<img src="<?php echo base_url('templates/clava/img/step3.jpg'); ?>" width="100%">
					</div>
					<div id="stepi" class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;text-align:right;">
						<img src="<?php echo base_url(); ?>images/secure_checkout.png" width="75%">
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 text-center">
                 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php }  ?>
                 <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?>                     
     				 <div >
										<h2>
											Your order was successfully completed. Thank you the purchase!
										</h2>	
                                          <p class="lead text-center" style="font-weight: 600; color: #C20030;"><?php echo lang('Invoice #');?>: <?php echo $invoice_number;?></p>									
					</div>			
                           
					</div>
									
				</div>
           
           
           
<!--         
   /////////////////////////////////////////////             
-->                
         
       <div class="row">
             
                
       <div class="col-xs-12 col-md-6 col-lg-6 col-sm-6">           	   
                                <table border="0" cellpadding="15" cellspacing="0" class="table" >
                        <?php $total_price =0;
                        foreach($items as $item) { ?>
                        <td class="thumb"><img src="<?php echo img_format('productres/'.$item->product_picture,'stamp');?>"/></td>
                        <td>
                            <h4><?php echo ucwords(strtolower($item->product_name));?></h4>
                            <p>
                             <em><?php echo lang('Ships to');?>: </em><strong>(<?php echo $item->location_type;?>): (<?php echo $item->location_type_name;?>)</strong><br/>
                            
                           <!-- <em><?php //echo lang('Sent to');?>:</em> -->
                           <strong><?php echo $item->firstname.' '.$item->lastname; ?></strong><br/>
                                <?php echo $item->address1.' '.$item->address2.'<br /> '.$item->city.' '.strtoupper($item->postalcode) . ' ' .$item->province; ?><br/>
                                <?php echo 'Phone: '.$item->dayphone;?>
                                <?php echo empty($item->evephone) ? '':' '.$item->evephone;?><br />
                                <?php echo $item->email;?></p>
                         <p><em><?php echo lang('Sent On');?>:</em> <strong><?php echo date('l d M Y',strtotime($item->delivery_date));?></strong></p>
                        <p><em><?php echo lang('Message');?>:</em> <?php echo $item->card_message;?></p>
                         <p><em><?php echo lang('Message on Ribbon');?>:</em> <?php echo $item->ribbon_text;?></p>
                        </td>
                        <td>
                            <p><strong><?php echo getRate($item->product_price);?></strong></p>
                        </td>
                        </tr>
                        <?php foreach($item->addons as $addon) {
                                $total_price += $addon->addon_price*$addon->addon_quantity;                        
                        ?>
                       <tr>
                            <td class="addonrow">&nbsp;</td>
                            <td class="addonrow">
                            [<big>+</big>] <?php echo ucfirst(strtolower($addon->addon_name)); ?> (<?php echo getRate($addon->addon_price); ?>) x <?php echo $addon->addon_quantity;?>
                            </td>
                            <td class="addonrow">
                            <strong><?php echo getRate($addon->addon_price*$addon->addon_quantity)?></strong></td>
                        </tr>
                        <?php
                            }
                         } ?>
                    </table>            
                        
       </div>
       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<!--       				<div class="dividerLatest">
							<h4>xxx</h4>
							<div class="gDot"></div>
						</div>-->
                  <table class="table">
                            <tr>
                                <td colspan="2"> <?php echo $billing->firstname.' '.$billing->lastname;?><br/>
                                    <?php echo $billing->address1.' '.$billing->address2;?><br/>
                                    <?php echo $billing->city.' '.$billing->postalcode.' '.$billing->province;?><br/>
                                    <?php echo $billing->dayphone.' '.$billing->evephone;?></br>
                                     <?php echo $billing->email;?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td class="right"><?php echo getRate($totals['itemtotal']);?></td>
                            </tr>
                            <!--<tr>
                                <td>Shipping</td>
                                <td class="right"><?php //echo getRate($totals['shipping']);?></td>
                            </tr>-->
                            <?php if($totals['service']>0) : ?>
                            <tr>
                                <td>Delivery fee </td>
                                <td class="right"><?php echo getRate($totals['service']);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php //if($totals['surcharge']>0) : ?>
                            <!--<tr>
                                <td>Same day surcharge</td>
                                <td class="right"><?php //echo getRate($totals['surcharge']);?></td>
                            </tr>-->
                            <?php //endif; ?>
                            <tr>
                                <td>Tax</td>
                                <td class="right"><?php echo getRate($totals['tax']);?></td>
                            </tr>
                            <?php //$discount = $totals['discount']+$totals['coupon']; ?>
                            <?php // if($discount>0) : ?>
                           <!-- <tr>
                                <td>Discount</td>
                                <td class="right"><?php// echo getRate($discount);?></td>
                            </tr>-->
                            
                            
                               <?php //if(($totals['coupon']+$totals['discount'])>0) : 
                            //san code here. for actual file take a look on server named file thankyou-12-7-2013
                            $affid=$this->session->userdata('referer');
							$bothsum=0;
                            if($totals['coupon']>0){
								
							$bothsum=$totals['coupon']+$totals['discount'];
							}
							if($affid!='') {
							$bothsum=0;	
							}
							?>
                             <?php 
								
								
								//if($bothsum>0) { ?>
                          
                           
                           <tr>
                                <td>
								
								<?php 
								$dist = $totals['coupon']+$totals['discount'];
								echo lang('Discount');?></td>
                                <td class="right">-<?php echo getRate($dist);
								//echo getRate($bothsum);
								
								?></td>
                            </tr>
                            
                            <?php //} //endif; ?>
                            
                           
                            <tr>
                                <th>Grand Total:</th>
                                <th class="right"><?php echo getRate($totals['grandtotal']); ?></th>
                        </table>      

                        
       
       
       
       </div>       
      
       </div>  
         
<!--         
   /////////////////////////////////////////////             
-->                
                
			</div>
            
            <p class="text-center"><small><a href="<?php echo base_url(); ?>user/logout"><?php echo lang('Back to Home');?></a></small></p> 
		</section>			
		
	</section>
	<!--end wrapper-->

<br />
	
	<section class="footer_bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
					<p class="copyright">&copy; Copyright 2015 | Powered by  MemorialFlowers.ca</p>
				</div>
			</div>
		</div>
	</section>


<!--
::For Oscar -- avoid footer::

-->
	
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/vendor/jquery-1.10.2.min.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/vendor/bootstrap.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/jquery.easing.1.3.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/retina-1.1.0.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jquery.cookie.js'); ?>"></script> <!-- jQuery cookie --> 
	<!--<script type="text/javascript" src="<?php echo base_url('templates/clava/js/styleswitch.js'); ?>"></script>--> <!-- Style Colors Switcher -->
	
	<script src="<?php echo base_url('templates/clava/js/jquery.superfish.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/jquery.jpanelmenu.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/jquery.blackandwhite.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('templates/clava/js/rs-plugin/js/jquery.themepunch.plugins.min.js'); ?>"></script>
	<script src="<?php echo base_url('templates/clava/js/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jquery.jcarousel.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jflickrfeed.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jflickrfeed-setup.js'); ?>"></script>	
	
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jquery.magnific-popup.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jquery.isotope.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/swipe.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/tweetable.jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('templates/clava/js/jquery.timeago.js'); ?>"></script>
	
	<script src="<?php echo base_url('templates/clava/js/main.js'); ?>"></script>
    
  <!--
:: avoid footer::

-->  
<script>
<!--

$(function() {  
    $('#create_account').click(function(){
    
    if($(this).is(":checked"))
    {
        $('#username').removeAttr('disabled');
        $('#password').removeAttr('disabled');
        $('#cpassword').removeAttr('disabled');
        $('#parent_id').removeAttr('disabled');
        $('#company_code').removeAttr('disabled');
    }
    else
    {
        $('#username').attr('disabled','disabled');
        $('#password').attr('disabled','disabled');
        $('#cpassword').attr('disabled','disabled');
        $('#parent_id').attr('disabled','disabled');
        $('#company_code').attr('disabled','disabled');
    }
        
    });
});
//-->
</script>





<!-- Activity name for this tag: WhataBloom --> <script type='text/javascript'> var axel = Math.random()+""; var a = axel * 10000000000000; document.write('<img src="" width=1 height=1 border=0/>'); </script> <noscript> <img src="" width=1 height=1 border=0/> </noscript>

</body>
</html>
	 	
<?php // include_once('footer_clava.php'); ?>

<?php die();?>