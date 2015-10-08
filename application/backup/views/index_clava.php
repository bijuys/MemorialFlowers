<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<!--Start Slider-->
		<section class="slider" id="noslidermobile" style="display:none;">
			<!-- START REVOLUTION SLIDER 2.3.91 -->
			<div class="fullwidthbanner-container">
				<div class="fullwidthbanner">
					<ul>
						
						<li 
                        data-transition="fade" 
                        data-slotamount="1" 
                        data-masterspeed="1000" 
                        data-delay="9000" 
                        data-thumb="<?php echo base_url('templates/clava/img/revslider/transparent1.png'); ?>">
                            
								<img 
                                src="<?php echo base_url('templates/clava/img/revslider/transparent.png'); ?>" 
                                data-lazyload="<?php echo base_url('templates/clava/img/revslider/revslide_5_1.jpg'); ?>"  
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
							
								<div class="caption sfr tp-caption tp-resizeme" 
									data-x="20" 
									data-y="355" 
									data-easing="easeOutExpo" 
									data-start="4300" 
									data-speed="1000" >
									
										<a 
										href="<?php echo base_url('occasion/flowers-for-cremation'); ?>" 
										class="btn btn-large btn-block btn-default">View More
										</a>
								</div>
						</li> 
						
					</ul>
				</div>
			</div>
			<!-- END REVOLUTION SLIDER -->
		</section>
		<!--End Slider-->
		
		<section class="promo_box-mf">
			<div class="container">
				<div class="row" id="orderbyphone" style="margin-top:20px;">
					<div class="col-sm-8 col-md-8 col-lg-8">
						<div class="row">
							<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top:8px;">
								<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
									Order by Phone:
								</span>
							</div>
							<div class="col-sm-9 col-md-9 col-lg-9" style="padding-top:8px;">
								<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
									1-877-537-8610
								</span>
							</div>
						</div>
                    </div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
							<div>
								<input class="input-text"  name="search" id="s" placeholder="Enter product code or name ..." type="text">
								<input id="searchsubmit" value="Search" type="submit" class="pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		
		<section class="info_service">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-9">
						<div id="tabs">
								<ul id="standard_tabs" class="tabs">  
									<li><a href="#pink">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pink&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#red">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Red&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;White&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#lavender">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lavender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#bright">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bright&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#pastel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pastel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yellow&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
									<li><a href="#peach">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peach&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								</ul>
								
								<ul class="tabs" id="new_tabs" style="display:none;">  
									<li><a id="color_pink" href="#pink"></a></li>
									<li><a id="color_red" href="#red"></a></li>
									<li><a id="color_white" href="#white"></a></li>
									<li><a id="color_blue" href="#blue"></a></li>
									<li><a id="color_lavender" href="#lavender"></a></li>
									<li><a id="color_bright" href="#bright"></a></li>
									<li><a id="color_pastel" href="#pastel"></a></li>
									<li><a id="color_yellow" href="#yellow"></a></li>
									<li><a id="color_peach" href="#peach"></a></li>
								</ul>
								
								<div id="color_mobile" style="display:none;">
									<script>
										function changeFuneral(id){
											var myLink = document.getElementById('color_'+id);
											myLink.click();				
										}
									</script>
									
									<select onChange="changeFuneral(this.value);" style="width:100%;">
										<option value="">Select Color</option>
										<option value="pink">Pink</option>
										<option value="red">Red</option>
										<option value="white">White</option>
										<option value="blue">Blue</option>
										<option value="lavender">Lavender</option>
										<option value="bright">Bright</option>
										<option value="pastel">Pastel</option>
										<option value="yellow">Yellow</option>
										<option value="peach">Peach</option>
									</select>
								
								</div>
								
								<div class="tab_container" style="padding:0px;">	
									<div id="pink" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/pink">
											<img src="<?php echo base_url(); ?>images/memorial/pink.jpg" width="100%" />
										</a>
									</div>
									<div id="red" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/red">
											<img src="<?php echo base_url(); ?>images/memorial/red.jpg" width="100%" />
										</a>
									</div>
									<div id="white" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/white">
											<img src="<?php echo base_url(); ?>images/memorial/white.jpg" width="100%" />
										</a>
									</div>
									<div id="blue" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/blue">
											<img src="<?php echo base_url(); ?>images/memorial/blue.jpg" width="100%" />
										</a>
									</div>
									<div id="lavender" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/lavender">
											<img src="<?php echo base_url(); ?>images/memorial/lavender.jpg" width="100%" />
										</a>
									</div>
									<div id="bright" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/bright">
											<img src="<?php echo base_url(); ?>images/memorial/bright.jpg" width="100%" />
										</a>
									</div>
									<div id="pastel" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/pastel">
											<img src="<?php echo base_url(); ?>images/memorial/pastel.jpg" width="100%" />
										</a>
									</div>
									<div id="yellow" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/yellow">
											<img src="<?php echo base_url(); ?>images/memorial/yellow.jpg" width="100%" />
										</a>
									</div>
									<div id="peach" class="tab_content"> 
										<a href="<?php echo base_url(); ?>subcategory/peach">
											<img src="<?php echo base_url(); ?>images/memorial/peach.jpg" width="100%" />
										</a>
									</div>
								</div>
							</div>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-cremation">
							<img src="<?php echo base_url(); ?>images/memorial-tiles-new.jpg" width="100%" height="100%" />
						</a>
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office">	
							<img src="<?php echo base_url(); ?>images/memorial-tiles-new-2.jpg" width="100%" height="100%" style="margin-top:7px;" />
						</a>
					</div>
				</div>
			</div>
		</section>	
		
		<section class="info_service">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>category/tributes" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti3.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Funeral Tributes</span>
						</a>
						<br /><br />		
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti4.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Service Arrangements</span>
						</a>
						<br /><br />		
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>category/hearts" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/corazon.png" width="100%" />	
							<br />
							<span style="font-size:14px;line-height:30px;">Hearts & Wreaths</span>
						</a>
						<br /><br />	
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 text-center">
						<a href="<?php echo base_url(); ?>category/standing-sprays" style="color:inherit;">
							<img src="<?php echo base_url(); ?>images/ti1.png" width="100%" />
							<br />
							<span style="font-size:14px;line-height:30px;">Standing Sprays</span>
						</a>
						<br /><br />	
					</div>
					
				</div>
			</div>
		</section>
		
	</section>
	<!--end wrapper-->
	
	<!-- Activity name for this tag: WhataBloom --> <script type='text/javascript'> var axel = Math.random()+""; var a = axel * 10000000000000; document.write('<img src="" width=1 height=1 border=0/>'); </script> <noscript> <img src="" width=1 height=1 border=0/> </noscript>

	
<?php include_once('footer_clava.php'); ?>