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
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('templates/clava/css/style-mf.css');?>">    
    
    
</head>
<body>
	
	<!--start wrapper-->
	<section class="wrapper" style="margin-top:10px;">
		
		<!--Start Slider-->
		<section class="slider">
			<!-- START REVOLUTION SLIDER 2.3.91 -->
			<div class="fullwidthbanner-container">
				<div class="fullwidthbanner">
					<ul>
						<!-- SLIDEUP -->
						<li 
                        data-transition="fade" 
                        data-slotamount="1" 
                        data-masterspeed="1000" 
                        data-delay="9000" 
                        data-thumb="<?php echo base_url('templates/clava/img/revslider/transparent1.png'); ?>">
                            
								<img 
                                src="<?php echo base_url('templates/clava/img/revslider/transparent.png'); ?>" 
                                data-lazyload="<?php echo base_url('templates/clava/img/revslider/revslide_5.jpg'); ?>"  
                                alt="darkblurbg"  
                                data-bgfit="cover" 
                                data-bgposition="left top" 
                                data-bgrepeat="no-repeat">
							
								<div 
                                class="tp-caption sft" 
                                data-x="510" 
                                data-y="40" 
                                data-speed="1000" 
                                data-start="3500" 
                                data-easing="easeOutExpo">
                                    
									<img src="<?php echo base_url('templates/clava/img/revslider/01.png'); ?>" alt="iMac Slider">
								</div>
						
								<div 
                                class="tp-caption modern_medium_fat sft start tp-resizeme" 
                                data-x="20" 
                                data-y="115" 
                                data-speed="1000" 
                                data-start="1200" 
                                data-easing="easeInBack">
                                
									Express Your Bereavement with
								</div>
							
								<div 
                                class="tp-caption inlarge_light_black sfl" 
                                data-x="20" 
                                data-y="142" 
                                data-speed="700" 
                                data-start="1600" 
                                data-easing="easeOutExpo">
                                
									Funeral Flowers.
								</div>
                            
								<div 
                                class="caption sfr modern_small_text_dark tp-caption" 
                                data-x="20" 
                                data-y="215" 
                                data-easing="easeOutExpo" 
                                data-start="2200" 
                                data-speed="700" >
                                
									<p>
                                        When you are miles away, <br>
                                        a thoughtfully designed floral arrangement can convey <br>
                                        your deepest sympathies better than any words can.
                                    </p>
                                    
								</div>	
                            						
								<div 
                                class="caption sfr modern_small_text_dark tp-caption sfl" 
                                data-x="20" 
                                data-y="285" 
                                data-speed="700" 
                                data-start="2800" 
                                data-easing="easeInBack">
                                
									<i>*Delivery Across Canada and USA.</i>
                                    
								</div>
							
								<div 
                                class="caption sfr tp-caption tp-resizeme" 
                                data-x="20" 
                                data-y="355" 
                                data-easing="easeOutExpo" 
                                data-start="4300" 
                                data-speed="1000" >
									<!--
									<a 
                                    href="<?php echo base_url('occasion/flowers-for-cremation'); ?>" 
                                    class="btn btn-large btn-block btn-default">View More
                                    </a>
									-->
							</div>
						</li> 
						
						<!-- SLIDEUP -->
						<li 
                        data-transition="fade" 
                        data-slotamount="1" 
                        data-masterspeed="1000" 
                        data-delay="9000" 
                        data-thumb="<?php echo base_url('templates/clava/img/revslider/transparent.png'); ?>">
							<img 
                            src="<?php echo base_url('templates/clava/img/revslider/transparent.png'); ?>" 
                            data-lazyload="<?php echo base_url('templates/clava/img/revslider/revslide_5.jpg'); ?>"  
                            alt="darkblurbg"  
                            data-bgfit="cover" 
                            data-bgposition="left top" 
                            data-bgrepeat="no-repeat">
							
							<div 
                            class="caption randomrotate" 
                            data-x="70" 
                            data-y="40" 
                            data-speed="600" 
                            data-start="900" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/04.jpg'); ?>" alt="iMac Slider">
                                
							</div>
                            
							<div 
                            class="caption randomrotate" 
                            data-x="1" 
                            data-y="270" d
                            ata-speed="600" 
                            data-start="1200" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/05.jpg'); ?>" alt="Ipad Slider">
                                
							</div>
                            
							<div 
                            class="caption randomrotate" 
                            data-x="240" 
                            data-y="80" 
                            data-speed="600" 
                            data-start="1300" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/01.jpg'); ?>" alt="Iphone Slider">
                                
							</div>
                            
 							<div 
                            class="caption randomrotate" 
                            data-x="200" 
                            data-y="300" 
                            data-speed="600" 
                            data-start="1600" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/03.jpg'); ?>" alt="Iphone Slider">
                                
							</div>                           
							
 							<div 
                            class="caption randomrotate" 
                            data-x="400" 
                            data-y="225" 
                            data-speed="600" 
                            data-start="1900" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/06.jpg'); ?>" alt="Iphone Slider">
                                
							</div>   
                            
 							<div 
                            class="caption randomrotate" 
                            data-x="110" 
                            data-y="155" 
                            data-speed="600" 
                            data-start="2100" 
                            data-easing="easeOutExpo">
                            
								<img src="<?php echo base_url('templates/clava/img/revslider/02.jpg'); ?>" alt="Iphone Slider">
                                
							</div>     
                            
                            <div 
                            class="tp-caption medium_bg_orange sft start" 
                            data-x="700" 
                            data-y="115" 
                            data-speed="700" 
                            data-start="2700" 
                            data-easing="easeOutBack">
                            
								A Variety Of Colours
                                
							</div>
							
							<div 
                            class="tp-caption modern_big_blackbg sft start" 
                            data-x="800" 
                            data-y="150" 
                            data-speed="700" 
                            data-start="2700" 
                            data-easing="easeOutBack">
                            
								To Choose
                                
							</div>   
                            
                         	<div 
                                class="caption sfr tp-caption tp-resizeme" 
                                data-x="830" 
                                data-y="255" 
                                data-easing="easeOutExpo" 
                                data-start="3800" 
                                data-speed="1000" >
									<!--
									<a 
                                    href="<?php echo base_url('subcategory/white'); ?>" 
                                    class="btn btn-large btn-block btn-default">View More
                                    </a>
									-->
							</div>                                                    
							
						</li> 
						
					</ul>
				</div>
			</div>
			<!-- END REVOLUTION SLIDER -->
		</section>
		<!--End Slider-->
		
		<br />
		
		<!--start info service-->
		<section class="info_service">
			<div class="container">
				<div class="row sub_content">
					<div class="rs_box">
						<div class="col-sm-4 col-md-4 col-lg-4">
							<div class="front_service">
								<div class="icon_service">
									<i class="fa fa-map-marker"></i>
									<h3>Select A Destination</h3>
								</div>
								<div class="fr_content">
									<p style="padding-left:19%;">Where do you want to ship the item?</p>
								</div>
							</div>
						</div>
						
						<div class="col-sm-4 col-md-4 col-lg-4">
							<div class="front_service">
								<div class="icon_service">
									<h3>Canada</h3>
								</div>
								<div class="fr_content">
									<?php echo form_open('/location',array('class'=>'form-inline')); ?>
									<table width="100%">
										<tr>
											<td width="70%">
												<select id="location" name="location" class="form-control" required />
													<?php echo country_provinces(1);?>
												</select>
											</td>
											<td width="30%" valign="top">
												<button type="submit" class="btn btn-default btn-large btn-block">GO</button>
											</td>
										</tr>
									</table>
									<?php echo form_close();?>
								</div>
							</div>
						</div>	

						<div class="col-sm-4 col-md-4 col-lg-4">
							<div class="front_service">
								<div class="icon_service">
									<h3>USA</h3>
								</div>
								<div class="fr_content">
									<?php echo form_open('/location',array('class'=>'form-inline')); ?>
									<table width="100%">
										<tr>
											<td width="70%">
												<select id="location" name="location" class="form-control" required />
													<?php echo country_provinces(2);?>
												</select>
											</td>
											<td width="30%" valign="top">
												<button type="submit" class="btn btn-default btn-large btn-block">GO</button>
											</td>
										</tr>
									</table>
									<?php echo form_close();?>
								</div>
							</div>
						</div>	
					
					</div>
				</div>
			</div>
		</section>
		<!--end info service-->
		
        </section>
		<!--end wrapper-->
		<section class="promo_box-mf">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-md-3 col-lg-12 text-center">
                        Here at Memorial Flowers .ca we offer beautiful time tested traditional designs for the immediate family, close relatives, 
                        friends and business associates. Our floral deliveries are prompt, handled with care and professionally presented.
						<!--
						<br /><br />
						<img src="<?php echo base_url(); ?>images/decoration_2.png" width="100%" />
						-->
					</div>
				</div>
			</div>
		</section>

		
	
	
	<section class="footer_bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
					<p class="copyright">&copy; Copyright 2015 | Powered by  MemorialFlowers.ca</p>
				</div>
			</div>
		</div>
	</section>
	
	
	
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
	
	<!-- Start Style Switcher -->
	<!--<div class="switcher"></div>-->
	<!-- End Style Switcher -->
</body>
</html>		