<section class="promo_box-mf">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<blockquote class="default">
					Memorial Flowers offers a tailored catalogue of elegant and sophisticated sympathy floral pieces. Our goal is to help you find solace and peace of mind with our products as you remember a family member, friend or colleague.
				</blockquote>                                   
			</div>
			<div class="col-sm-4 col-md-4 col-lg-4" style="padding-top:10px;display:none;">
				<div class="sw_search">                            
					<!--
					<div class="sw_title">
						<h4>Signup for Special Offers</h4>
						<div class="gDot"></div>
					</div>
					-->
					<div class="site-search-area">
						<form method="post" id="site-searchform" action="http://www.memorialflowers.ca/support/subscribe">
								<input class="input-text" name="search" id="email" placeholder="Enter Email Address..." type="text" style="width:100%;">
								<button type="submit" class="btn btn-default btn-small btn-block">Sign Up</button>
						</form>
					</div><!-- end site search -->
				</div>
			</div>
		</div>
	</div>
</section>
<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="dividerWidget">
						<h4>MORE WAYS TO SHOP</h4>
						<div class="gDot widget"></div>
					</div>
					<div class="widfoot_content">
						<ul class="links">
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/subcategory/bouquets/1" style="font-weight:normal;">Bouquets</a>
							</li>
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/subcategory/standing-sprays/1" style="font-weight:normal;">Standing Sprays </a>
							</li> 																	                            
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/subcategory/sympathy-baskets/1" style="font-weight:normal;">Sympathy Baskets</a>
							</li>                            
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/occasion/flowers-for-service/1" style="font-weight:normal;">Flowers For Service</a>
							</li>                           
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="dividerWidget">
						<h4>CUSTOMER SERVICE</h4>
						<div class="gDot widget"></div>
					</div>
					<div class="widfoot_content">
						<ul class="links">
							<!--
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="http://memorial.dev/support/tracking" style="font-weight:normal;">Order Tracking</span></a>
							</li>
							-->
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/about-us" style="font-weight:normal;">About Us</a>
							</li>
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/contact" style="font-weight:normal;">Contact Us</a>
							</li>
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/faqs" style="font-weight:normal;">FAQs</a>
							</li>	
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/terms-of-use" style="font-weight:normal;">Terms Of Use</a>
							</li> 
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/privacy-and-security" style="font-weight:normal;">Privacy and Security Policies</a>
							</li> 							
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="dividerWidget">
						<h4>AFFILIATES</h4>
						<div class="gDot widget"></div>
					</div>
					<div class="widfoot_content">
						<ul class="links">
							<li>
								<i class="fa fa-caret-right"></i> 
								<a href="/mymemorial" style="font-weight:normal;">Affiliate Login</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<div class="dividerWidget">
						<h4>CONTACT US</h4>
						<div class="gDot widget"></div>
					</div>
					<div class="widfoot_content">                                  		
                        <ul class="contact-details-alt">
							<li>
								<i class="fa fa-map-marker"></i> 
								<p>
									65A Wingold Avenue<br> 
									<span style="padding-left:15px;">North York M6P 4H3</span>
								</p>
							</li>
							<li>
								<i class="fa fa-phone"></i> 
								<p>1-877-537-8610</p>
							</li>
						</ul>
                    </div>
				</div>
			</div>
		</div>
	</footer>
<section class="footer_bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 text-center">
				<p class="copyright">© Copyright 2015 | Powered by  MemorialFlowers.ca</p>
			</div>
		</div>
	</div>
</section>
<script>
	function openMenu(val,num){
		if(val=='content_1'){
			document.getElementById('content_2').style.display = 'none';
			document.getElementById('content_3').style.display = 'none';
		}
		if(val=='content_2'){
			document.getElementById('content_1').style.display = 'none';
			document.getElementById('content_3').style.display = 'none';
		}
		if(val=='content_3'){
			document.getElementById('content_1').style.display = 'none';
			document.getElementById('content_2').style.display = 'none';
		}
		$('#mas_1').find($(".fa")).removeClass('fa-chevron-down').addClass('fa-chevron-right');
		$('#mas_2').find($(".fa")).removeClass('fa-chevron-down').addClass('fa-chevron-right');
		$('#mas_3').find($(".fa")).removeClass('fa-chevron-down').addClass('fa-chevron-right');
		
		if($('#'+val+':visible').length == 0){
			
			 if($('#mas_'+num).find($(".fa")).hasClass('fa-chevron-right')){
				$('#mas_'+num).find($(".fa")).removeClass('fa-chevron-right').addClass('fa-chevron-down');
			 }
			document.getElementById(val).style.display = 'block';
		}else{
			document.getElementById(val).style.display = 'none';
		}
	}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo template_url();?>js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="<?php echo template_url('js/vendor/bootstrap.min.js');?>"></script>
<script src="<?php echo template_url('js/plugins.js');?>"></script>
<script src="<?php echo template_url('js/datepicker.js');?>"></script>
<script src="<?php echo template_url('js/main.js');?>"></script>