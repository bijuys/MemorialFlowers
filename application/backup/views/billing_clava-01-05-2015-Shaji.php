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
			<div class="container" style="margin-bottom:-70px;">
				
				<div class="row" style="margin-bottom:20px;">
					<div id="stepi" class="col-sm-12 col-md-12 col-lg-3" style="margin-top:-20px;">
						<a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url('templates/clava/img/logo_2.png'); ?>" width="100%" />
						</a>
					</div>
					<div class="text-center col-lg-6 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;">
						<img src="<?php echo base_url('templates/clava/img/step2.jpg'); ?>" width="100%">
					</div>
					<div id="stepi" class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;text-align:right;">
						<img src="<?php echo base_url(); ?>images/secure_checkout.png" width="75%">
					</div>
				</div>
				
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4>Checkout <i class="fa fa-chevron-right"></i> Billing Information</h4>
							<div class="gDot"></div>
						</div>
                    </div>
				</div>
				
				<?php //echo form_open('shop/pay',array('class'=>'form-horizontal')); ?>
				
				<form action="https://www.memorialflowers.ca/shop/pay" method="post">
				
				<div class="row sub_content" style="margin-top:-30px;">
				
					<div class="col-lg-9">
					
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-dismissable" style="background-color:#EEEEEE;height:30px;padding:4px 5px 4px 5px;">
									<span style="font-size:15px;color:#555;font-weight:600;">Enter Payment Information</span>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top:-10px;">
							<div class="col-lg-12" style="padding-left:20px;padding-right:20px;">
								
								<img src="<?php echo base_url(); ?>images/cc.png" width="35%" />
								
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										
										<div style="margin-top:10px;">
											Credit Card Type *
											<select style="height:30px;width:100%;padding-left:9px;" name="cardtype" required id="cardtype">
												<option value="visa">Visa</option>
												<option value="master">Master Card</option>
												<option value="american">American Express</option>
											</select>
										</div>
										<div style="margin-top:10px;">
											Credit Card Number *
											<input style="height:30px;width:100%;" required name="cardnumber" id="cardnumber" maxlength="16" type="text" value="<?php if($_POST) echo $_POST['cardnumber'];?>" />
										</div>
										
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="row">
											<div class="col-lg-8" style="margin-top:10px;">
												Expiration Date *
												<div class="row">
													<div class="col-lg-6">
														<select style="height:30px;width:100%;padding-left:9px;" required name="expiry_month" id="expiry_month">
															<option value="">MM</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
														</select>
														<br /><br />
													</div>
													<div class="col-lg-6">
														<select style="height:30px;width:100%;padding-left:9px;" required name="expiry_year" id="expiry_year">
															<option value="">YY</option>
															<?php for($m=2015;$m<2031;$m++){ ?>
															<option value="<?php echo $m; ?>"><?php echo $m; ?></option>	
															<?php } ?>
														</select>
														<br /><br />
													</div>
												</div>
											</div>
											<div class="col-lg-4" style="margin-top:10px;">
												CVV *
												<input style="height:30px;width:100%;" required type="text" name="cvv" id="cvv" size="5" maxlength="4" />
											</div>
										</div>
									</div>
									
								</div>	
								
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-dismissable" style="background-color:#EEEEEE;height:30px;padding:4px 5px 4px 5px;">
									<span style="font-size:15px;color:#555;font-weight:600;">Card Holder Information</span>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top:-10px;">
							<div class="col-lg-12" style="padding-left:20px;padding-right:20px;">
								
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										
										<div>
											Billing First Name *
											<input style="height:30px;width:100%;" required type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:$billing->firstname;?>" />
										</div>
										<div style="margin-top:10px;">
											Billing Last Name *
											<input style="height:30px;width:100%;" required type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:$billing->lastname;?>" />
										</div>
										<div style="margin-top:10px;">
											Address Line 1 *
											<input style="height:30px;width:100%;" required type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:$billing->address1;?>" />
										</div>
										<div style="margin-top:10px;">
											Address Line 2 
											<input style="height:30px;width:100%;" type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:$billing->address2;?>" />
										</div>
										<div style="margin-top:10px;">
											Postal Code *
											<input style="height:30px;width:100%;" required type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:$billing->postalcode;?>" />
										</div>
										
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										
										<div>
											City *
											<input style="height:30px;width:100%;" required type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:$billing->city;?>" />
										</div>
										<div style="margin-top:10px;">
											Province * 
											<select style="height:30px;width:100%;padding-left:9px;" required name="province" id="province" >
												<option value="" <?php
													if($_POST)
													{
														if($_POST['province']=='')
															echo 'selected="selected"';
													}
													else
													{
														if(isset($billing) && $billing->province=='')
															echo 'selected="selected"';
													}
											?>><?php echo lang('Please select');?></option>
											<?php echo province_options($_POST ? $_POST['province']:(isset($billing) ? $billing->province:'')); ?>
											</select>
										</div>		
										<div style="margin-top:10px;">
											Country *
											<select style="height:30px;width:100%;padding-left:9px;" required name="country_id" id="country_id">
												<option value="" <?php
													if($_POST)
													{
														if($_POST['country_id']=='')
															echo 'selected="selected"';
													}
													else
													{
														if(isset($billing) && $billing->country_id=='')
															echo 'selected="selected"';
													}
											?>><?php echo lang('Please select');?></option>
											<?php echo country_options($_POST ? $_POST['country_id']:(isset($billing) ? $billing->country_id:'')) ?>
											</select>
										</div>	
										<div style="margin-top:10px;">
											Email Address *
											<input style="height:30px;width:100%;" required type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:$billing->email;?>" />
										</div>	
										<div style="margin-top:10px;">
											Telephone Number *
											<input style="height:30px;width:100%;" required type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:$billing->dayphone;?>" />
											<input type="hidden" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:$billing->evephone;?>" />
										</div>	
										<input type="hidden" name="create_account" id="create_account" value="" <?php echo set_checkbox('create_account','1',TRUE);?> />
										<input type="hidden" name="username" id="username" class="form-control" value="<?php echo $_POST && isset($_POST['username']) ? $p->username:'';?>" />
										<input type="hidden" name="password" id="password" value="" class="form-control" />
										<input type="hidden" name="cpassword" id="cpassword" value="" class="form-control" />
										
									</div>
								</div>	
							</div>
						</div>
					
					</div>
					
					<div class="col-lg-3">
					
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-dismissable" style="background-color:#EEEEEE;height:30px;padding:4px 5px 4px 5px;">
									<span style="font-size:15px;color:#555;font-weight:600;">Order Summary</span>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top:-10px;">
							<div class="col-lg-12" style="padding-left:20px;padding-right:20px;">
								<table style="font-size:13px;" border="0" width="100%">
									<tr>
										<td>Amount</td>
										<td align="right"><?php echo getRate($totals['itemtotal']);?></td>
									</tr>
									<?php 
									$affid=$this->session->userdata('referer');
									$bothsum=0;
									if($totals['coupon']>0){
										$bothsum=$totals['coupon']+$totals['discount'];
									}
									if($affid!='') {
										$bothsum=0;	
									}
									?>
									<tr>
										<td>
											Discount
											<?php 
											$dist = $totals['coupon']+$totals['discount'];
											?>
										</td>
										<td align="right">
											-<?php echo getRate($dist); ?>
										</td>
									</tr>
									<?php if($totals['service']==0 || $totals['shipping']>0) : ?>
									<tr>
										<td>Delivery Charge</td>
										<td align="right"><?php echo getRate($totals['shipping']);?></td>
									</tr>
									<?php endif; ?>
									<?php if($totals['service']>0) : ?>
									<tr>
										<td>Service Charge</td>
										<td align="right"><?php echo getRate($totals['service']);?></td>
									</tr>
									<?php endif; ?>
									<?php if($totals['surcharge']>0) : ?>
									<tr>
										<td>Special Delivery</td>
										<td align="right"><?php echo getRate($totals['surcharge']);?></td>
									</tr>
									<?php endif; ?>
									<tr>
										<td>Tax</td>
										<td align="right"><?php echo getRate($totals['tax']);?></td>
									</tr>
									<tr>
										<td style="vertical-align:middle;">Order Total</td>
										<td align="right"><b><?php echo getRate($totals['grandtotal']);?></b></td>
									</tr>
								</table> 
								<br />
								<img src="<?php echo base_url(); ?>images/stella-guarantee.gif" width="100%" />
							</div>
						</div>
						
						
					</div>
					
				</div>	
				
				<div class="row sub_content">
					<div class="col-lg-9">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12">
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">
								<button type="submit" name="checkout" id="checkout" value="" class="btn btn-large btn-block btn-default" onClick="return checklocationtype();" >
									<b>Submit Order &nbsp; <i class="fa fa-play"></i> </b> 
								</button>
							</div>
						</div>	
					</div>
					<div class="col-lg-3">
					
					</div>
				</div>
				
				<?php echo form_close(); ?>
            
			</div>
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

</body>
</html>
	 	
<?php // include_once('footer_clava.php'); ?>