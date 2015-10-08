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
		echo 'Flowers, flower delivery, birthday flowers, mother�s day flowers, gift baskets, roses';
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
							<img src="<?php echo base_url(); ?>images/mf-logo-new.png" width="100%" />
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
				
				<form action="http://www.memorialflowers.ca/shop/pay" method="post">
				
				<div class="row sub_content" style="margin-top:-30px;">
				
					<div class="col-lg-9">
					
						<div class="row">
							<div class="col-lg-12">
								<div class="alert alert-dismissable" style="background-color:#EEEEEE;height:30px;padding:4px 5px 4px 5px;">
									<span style="font-size:15px;color:#555;font-weight:600;">Enter Payment Information</span>
								</div>
							</div>
						</div>
						

	                    <?php 
                        if(validation_errors())
                        {
                            echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                        }
                    ?>							
								
 <!--                               
                                
                                
                                
                                
                                
 -->                               
                                
<div class="row" style="margin-top:-30px;">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
								<ul class="cards">
									<li class="amex">Amex</li>
									<li class="visa">Visa</li>
									<li class="mastercard">MasterCard</li>
									<li class="visa_electron">Visa Electron</li> 
									<li class="maestro">Maestro</li>
									<li class="discover">Discover</li>
								</ul>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								
							</div>
							
					</div>			
					
					<div class="row" style="margin-top:5px;	">	
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
								Credit Card Number *
								<input type="text" style="height:30px;width:100%;" name="cardnumber" id="cardnumber" maxlength="16" value="<?php if($_POST) echo $_POST['cardnumber'];?>" placeholder="<?php echo lang("Credit Card Number");?>" style="color:#000;" pattern="\d*" />
								<!--
								<label for="nameoncard"><?php echo lang("Card holder's name");?><span class="required">*</span></label>
								<input type="text" class="form-control" name="nameoncard" id="nameoncard" value="<?php if($_POST) echo $_POST['nameoncard'];?>" placeholder="<?php echo lang("Card holder's name");?>" /> 
								-->
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
								Expiry Date *
								<div class="row" >
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin:0px;">
										<select name="expiry_month" id="expiry_month" style="height:30px;width:100%;">
											<option value="">Month</option>
											<option value="01" <?php if($_POST && $_POST['expiry_month']=='01') echo 'selected="selected"';?>>01</option> 
											<option value="02" <?php if($_POST && $_POST['expiry_month']=='02') echo 'selected="selected"';?>>02</option>
											<option value="03" <?php if($_POST && $_POST['expiry_month']=='03') echo 'selected="selected"';?>>03</option>
											<option value="04" <?php if($_POST && $_POST['expiry_month']=='04') echo 'selected="selected"';?>>04</option>
											<option value="05" <?php if($_POST && $_POST['expiry_month']=='05') echo 'selected="selected"';?>>05</option>
											<option value="06" <?php if($_POST && $_POST['expiry_month']=='06') echo 'selected="selected"';?>>06</option>
											<option value="07" <?php if($_POST && $_POST['expiry_month']=='07') echo 'selected="selected"';?>>07</option>
											<option value="08" <?php if($_POST && $_POST['expiry_month']=='08') echo 'selected="selected"';?>>08</option>
											<option value="09" <?php if($_POST && $_POST['expiry_month']=='09') echo 'selected="selected"';?>>09</option>
											<option value="10" <?php if($_POST && $_POST['expiry_month']=='10') echo 'selected="selected"';?>>10</option>
											<option value="11" <?php if($_POST && $_POST['expiry_month']=='11') echo 'selected="selected"';?>>11</option>
											<option value="12" <?php if($_POST && $_POST['expiry_month']=='12') echo 'selected="selected"';?>>12</option>
										</select>      
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="margin:0px;">
										<select name="expiry_year" id="expiry_year" style="height:30px;width:100%;">
											<option value="">Year</option>
											<?php for($i=0;$i<=15;$i++)
												{
													$ydate = time() + (60 * 60 * 24 * 365 * $i);
													$year = date('Y',$ydate);
											?>
											 <option value="<?php echo $year;?>" <?php
											 
												if($_POST && isset($_POST['expiry_year']))
												{
													if($_POST['expiry_year']==$year)
													{
														echo 'selected="selected"';
													}
												}
											 
											 ?>><?php echo $year;?></option>                           
											<?php                                    
												}
											?>
										</select>
									</div> 
								</div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
								CVV *
								<input type="text" style="height:30px;width:100%;" name="cvv" id="cvv" value="<?php if($_POST) echo $_POST['cvv'];?>" size="5" maxlength="4" size="14" placeholder="<?php echo lang('CVV');?>" pattern="\d*" />
							</div>
						</div>								





 <!--                               
                                
                                
                                
                                
                                
 -->                               
        

	
								

						
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
                        <input type="hidden" name="data" value="<?php echo $_POST ? $_POST['data']:$encoded;?>" />
                        
              
                        <button type="submit" name="paynow" id="paynow" value="" class="btn btn-large btn-block btn-default" onclick="return checklocationtype();">
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
    <script src="<?php echo base_url('templates/clava/js/jquery.creditCardValidator.js'); ?>"></script>
  <!--
:: avoid footer::

--> 

<script type="text/javascript">

                        $(document).ready(function(){
							
							
	   $("#paymentform").submit(function(){
                                $('<div id="mask">Loading...</div>').appendTo("body");
                                $("#paynow").val('Please wait...');
                                $("#paynow").attr("disabled","disabled");
                                return true;
                           })

                           $('input[type="radio"]').click(function() 
                           {
                                if($(this).attr('id') == 'optionsRadios1') {
                                    $('#credit_card_div').show();
                                    $('#checkout_but').show();
                                    $('#checkout_but2').hide();     
                                    $('#step2_div').show(); 
                                    $('#visa_checkout_div').hide();     
                                }
                                else{
                                    $('#credit_card_div').hide(); 
                                    $('#checkout_but').hide();
                                    $('#checkout_but2').show();                                                                         
                                    $('#step2_div').hide(); 
                                    $('#visa_checkout_div').show();  
                                }
                           });						
							
							
                            $("#country_id").change(function(){
                                var valu = $(this).val();

                                if(valu<3)
                                {
                                    $("#province").removeAttr("disabled");
                                }
                                else
                                {
                                     $("#province").val("");
                                     $("#province").attr("disabled","disabled");
                                }
                            });

                            $("#country_id").trigger("change");
                        })

                        $(".showservice").click(function(){
                            var id = $(this).attr("id")
                            numid = id.slice(11)

                            $('.serviceinfo').each(function(){
                                var thisid = $(this).attr("id")

                                thisid = thisid.slice(11)

                                if(thisid==numid)
                                {
                                    $(this).toggle()
                                }
                                else
                                {
                                    $(this).css("display","none")
                                }
                            })
                            
                        });

                        $('#cardnumber').validateCreditCard(function(result)
                        {
                            var cardname = result.card_type.name

                            if(result.length_valid)
                            {
                                $("#cardnumber").addClass("ok")
                            }
                            else
                            {
                                $("#cardnumber").removeClass("ok")
                            }

                            $('.cards li').each(function(){
                                var cls = $(this).attr('class').split(' ')[0]
                                
                                if(cls==cardname)
                                {
                                    $(this).removeClass('off')
                                }
                                else
                                {
                                    $(this).addClass('off')
                                }
                            })

                        });

                        (function(){
                            $(function()
                            {
                                $(".demo .numbers li").wrapInner('<a href="#"></a>').click(function(e)
                                {
                                    e.preventDefault();
                                    return $("#card_number").val($(this).text()).trigger("input")});

                                $(".vertical.maestro").hide().css({opacity:0});

                                return $("#card_number").validateCreditCard(function(e){
                                    if(e.card_type==null){
                                        $(".cards li").removeClass("off");
                                        $("#card_number").removeClass("valid");

                                        $(".vertical.maestro").slideUp({duration:200}).animate({opacity:0},{queue:!1,duration:200});

                                return
                            }

                            $(".cards li").addClass("off");
                            $(".cards ."+e.card_type.name).removeClass("off");
                            e.card_type.name==="maestro"?$(".vertical.maestro").slideDown({duration:200}).animate({opacity:1},{queue:!1}):$(".vertical.maestro").slideUp({duration:200}).animate({opacity:0},{queue:!1,duration:200});return e.length_valid&&e.luhn_valid?$("#card_number").addClass("valid"):$("#card_number").removeClass("valid")},{accept:["visa","visa_electron","mastercard","maestro","discover"]})
                            })
                        }).call(this);

</script>
                    
                    
                    
                    
                    
                     
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