<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper">
		
		<section class="promo_box-mf">
			<div id="responsive" class="container">
				<div class="row" id="orderbyphone" style="margin-top:20px;">
					<div class="col-sm-4 col-md-4 col-lg-4" style="padding-top:8px;">
						<span style="font-size:23px;margin-left:1%;font-weight:900;font-family:'Open Sans Condensed',sans-serif;">
							Order by Phone: 1-877-537-8610
						</span>
					</div>
					<div class="col-sm-5 col-md-5 col-lg-5 text-center">
						<?php
						if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
						?>			
						<table width="100%" border="0">
							<tr>
								<td width="50%">
									<div style="padding-top:8px;">
										<img src="<?php echo base_url(); ?>images/in-memory-of.png" width="100%" />
									</div>
								</td>
								<td width="50%" align="left" style="padding-left:10px;">
									<?php
									$json = file_get_contents('http://www.legacy.com/webservices/ns/FuneralInfo.svc/GetFuneralInfoJson?fhid='.$this->session->userdata('fhid').'&cobrand='.$this->session->userdata('cobrand').'&pid='.$this->session->userdata('pid'));
									$obj = json_decode($json);
										/*
										echo $this->session->userdata('fhid').'_'.$this->session->userdata('cobrand').'_'.$this->session->userdata('pid').'_____________';
										echo $json;
										*/
										
										echo '<div style="font-weight:bold;margin-top:5px;font-size:18px;color:#000;">'.ucwords(strtolower($obj->Obituary->FirstName.' '.$obj->Obituary->LastName)).'</div>';
									?> 
								</td>
							</tr>
						</table>
						<?php 
						}
						?>
						
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
							<div>
								<input class="input-text"  name="search" id="s" style="width:75%;" placeholder="Search products ..." type="text">
								<input id="searchsubmit" value="Search" type="submit" class="pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<div class="row" id="mobile-header" style="background-color:#8D0352;">
				<div class="col-lg-12">
					<table width="100%">
						<tr height="60">
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a style="color:inherit;" onClick="openMenu();">
										<i style="font-size:2.0em;color:#fff;" class="fa fa-bars"></i>
									</a>
								</div>	
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a style="color:inherit;" onClick="openSearch();">
										<i style="font-size:2.0em;color:#fff;" class="fa fa-search"></i>
									</a>
								</div>
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<?php if($tcart->items>0){ ?>
									<div style="margin-top:0px;">
										<a href="<?php echo base_url('shop/cart'); ?>" style="color:inherit;">
											<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
											<div style="font-size:13px;font-weight:bold;color:#8D0352;margin:-29px 0px 0px 6px;">
												<?php echo isset($tcart) ? $tcart->items:'0'; ?>
											</div>
										</a>
									</div>
								<?php }else{ ?>
									<div style="margin-top:0px;">
										<a style="color:inherit;">
											<i style="font-size:2.4em;color:#fff;" class="fa fa-shopping-cart"></i>
											<div style="font-size:13px;font-weight:bold;color:#fff;margin:-29px 0px 0px 6px;">
												0
											</div>
										</a>
									</div>	
								<?php } ?>
							</td>
							<td width="25%" align="center" style="border:1px solid #fff;">
								<div style="margin-top:10px;">
									<a href="tel:1-877-537-8610" style="color:inherit;">
										<i style="font-size:2.3em;color:#fff;" class="fa fa-phone"></i>
									</a>
								</div>
							</td>
						</tr>	
					</table>
				</div>
				<div class="col-lg-12" id="sear" style="margin-top:-9px;display:none;height:52px;">
					<form method="post" id="site-searchform" action="<?php echo base_url('search'); ?>">
						<div style="padding-bottom:-20px;">
							<input class="input-text" style="width:100%;height:50px;font-size:18px;text-align:center;padding-bottom:-8px;border:2px solid #8D0352;" name="search" id="search" placeholder="Enter product code or name ..." type="text">
							<!--<input id="searchsubmit" value="Search" type="submit" class="pull-right">-->
						</div>
					</form>
				</div>
				<div class="col-lg-12" id="men" style="background-color:#242E30;margin-top:0px;display:none;">
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(1);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> For Funeral Home </div>
								</a>
							</td>
						</tr>
					</table>
					
					<div id="l1" style="display:none;">
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/standing-sprays" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Standing Sprays</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Wreaths & Hearts</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/tributes" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Tributes</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/urn-spray" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Urn Sprays</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>
						
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(2);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> For Home & Office </div>
								</a>
							</td>
						</tr>
					</table>
						
					<div id="l2" style="display:none;">	
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/vase-arrangements" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Vase Arrangements</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Sympathy Baskets</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/bouquets" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Bouquets</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>	
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(3);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> Colours Collection </div>
								</a>
							</td>
						</tr>
					</table>

					<div id="l3" style="display:none;">
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/white" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">White</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/blue" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Blue</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/lavender" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Lavender</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/pink" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Pink</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/bright" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Bright</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/pastel" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Pastel</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/yellow" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Yellow</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/peach" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Peach</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>subcategory/red" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">Red</div>
									</a>	
								</td>
							</tr>
						</table>
					</div>	
					
					<table width="100%">
						<tr height="45">
							<td width="100%" align="center" style="border-left:1px solid #fff;border-right:1px solid #fff;">
								<a onClick="dropMenu(4);" style="color:inherit;font-size:17px;font-weight:bold;color:#fff;">
									<div style="width:100%;"> By Price Range </div>
								</a>
							</td>
						</tr>
					</table>
					
					<div id="l4" style="display:none;">	
						<table width="100%">
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/1/100" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$1 - $100</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/101/200" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$101 - $200</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/201/300" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$201 - $300</div>
									</a>	
								</td>
							</tr>
							<tr height="35">
								<td width="100%" align="center" style="background-color:#3A4A4D;border-left:1px solid #fff;border-right:1px solid #fff;">
									<a href="<?php echo base_url(); ?>pricing/301/500" style="color:inherit;font-size:14px;color:#fff;">
										<div style="width:100%;">$301 - $500</div>
									</a>	
								</td>
							</tr>
						</table>	
					</div>
					
				</div>
				<script>
					function openSearch(){
						document.getElementById('men').style.display = "none";
						if($('#sear:visible').length == 0){
							document.getElementById('sear').style.display = "block";
						}else{
							document.getElementById('sear').style.display = "none";
						}
					}
					function openMenu(){
						document.getElementById('sear').style.display = "none";
						if($('#men:visible').length == 0){
							document.getElementById('men').style.display = "block";
						}else{
							document.getElementById('men').style.display = "none";
						}
					}
					function dropMenu(id){
						if($('#l'+id+':visible').length == 0){
							document.getElementById('l'+id).style.display = "block";
						}else{
							document.getElementById('l'+id).style.display = "none";
						}
					}
					
				</script>
			</div>
		</section>
		
		<section class="content about" style="margin-top:-25px;margin-bottom:-70px;">
			<div class="container">
				<div class="row sub_content">
					
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-5 col-md-12 col-sm-12">
								<h2>
									Privacy and Security Policies
								</h2>
							</div>
							<div class="col-lg-4 col-md-12 col-sm-12">
								
							</div>
							<div id="right_products_banner" class="col-lg-3 col-md-12 col-sm-12">
								
							</div>
						</div>
						<div class="dividerLatest">
							<div class="gDot"></div>
						</div>
					</div>	
					
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<p style="text-align:justify;">
						Memorial Flowers (www.memorialflowers.ca) recognizes and respects the importance of maintaining the privacy of our customers, registered members 
						("Members") and users, and has established this Privacy Policy as a result. The purpose of this Privacy Policy is to inform you of:<br /><br />
						
						<b>*</b> The personal information we may collect from you when you visit our Web Site, respond to our emails, place orders via mail or fax, use our mobile 
						applications, place orders through social media applications (such as our Facebook App) or otherwise contact us via telephone, email, fax or mail 
						(collectively, our "Services").<br />
						<b>*</b> Why we gather information from you,<br />
						<b>*</b> How we collect it,<br />
						<b>*</b> How we use it, and <br />
						<b>*</b> The choices you have regarding our use of personal information you have provided.
						
						<br /><br />
						
						This Privacy Policy is part of the Terms of Use, The Services are owned by Memorial Flowers (the "Company").<br /><br />
						</p>
					
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Security</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) makes browsing and shopping easy, convenient, and safe. Any private information submitted to us 
										(including credit card numbers, names, addresses, and telephone numbers) is encrypted using SSL (secure socket layer) technology ensuring 
										that private information cannot be read as it crosses the Internet. Memorial Flowers (www.memorialflowers.ca) does not store any credit card 
										information on our website, so your billing information is not accessible by others. However, due to the inherent open nature of the Internet, 
										we cannot guarantee that communications between you and Memorial Flowers (www.memorialflowers.ca), and Memorial Flowers (www.memorialflowers.ca)
										and you, will be free from unauthorized access by third parties, such as hackers.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Use of Email Adresses</p>
								</div>
								<div class="clav_toggle_content media">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) will use customer email addresses for periodic communications. For example, we may contact you about feedback 
										on your experience with us, or provide you with promotional offers. Opt-Out: Memorial Flowers provides the option to remove your information from our 
										database at any time.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Third Party Tracking</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We use Google Analytics, Google AdWords Conversion tracker, and other Google services that place cookies on a browser across the website. These cookies 
										help us increase the website's effectiveness for our visitors. These cookies are set and read by Google. To opt out of Google tracking, please visit Google's 
										Ads Settings.We also use Google AdWords remarketing to market our site across the web. We place a cookie on your browser, and then based on your past site 
										visit, Google reads this cookie and may serve our ad on one of their 3rd party sites in their advertising network. You may opt out of this ad serving on 
										Google's opt out page. If you are concerned about 3rd party cookies served by networks, you should also visit the Network Advertising Initiative opt-out page.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Why do we gather information?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) gathers personal information to help improve our products and customer service, to communicate with you, to 
										process your orders, to provide an enhanced and more personalized shopping experience.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>How we use the information we collect</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We use information we collect to communicate with you, to process your orders, to provide an enhanced and more personalized shopping experience, to 
										inform you and your gift and message recipients of offers and discounts from Memorial Flowers (www.memorialflowers.ca) and our affiliated brands and 
										to enable you to receive credits for purchases under loyalty or buying programs which you have joined. In addition, we may make such information 
										(except for credit/debit card number and expiration date, unless you consent otherwise), including aggregated information, available to selected third 
										parties including, but not limited to, those who share or rent information for direct marketing purposes.
										<br /><br />
										However, without your consent, we do not make your or your gift or message recipients' email addresses, available to "third parties" (as that term is 
										defined and limited below). For example, we may make your postal address available to third parties for marketing purposes, however we would not share 
										your email address without your consent. In addition, you may instruct that other personal information about you or your message or gift recipients' 
										that you have provided to us not be shared with third parties by following the instructions in How to Limit the Use of Personal Information, below.
										<br /><br />
										Our Affiliates, subcontractors, and agents, and any successors or assignees to our business (if we ever sell, lease, license or assign some or all of 
										our business), are not considered to be third parties under this Policy. We may provide your information to our Affiliates for use in connection with 
										their businesses, including sending you offers and promotions. However, in connection with information collected under this Policy, they are required 
										to comply with this Policy. "Affiliates" are persons or entities directly or indirectly controlling, controlled by, or under common control with, or 
										in the same corporate family as Memorial Flowers (www.memorialflowers.ca). 
										<br /><br />	
										We may combine information we receive from you via our Services with information from our Affiliates and third parties. We use the combined information 
										to enhance and personalize your shopping experience with us and to communicate with you in accordance with this Privacy Policy.
										<br /><br />
										We reserve the right to disclose information you provide to us as required by law, in response to legal process and law enforcement requests and as 
										necessary or appropriate, in our view, to operate the Services, process orders or registrations, to conduct promotions, contests, and sweepstakes you 
										participate in, and to protect the rights or property of Memorial Flowers (www.memorialflowers.ca), its Affiliates, users, customers, recipients, Members, 
										Sponsors, Providers, Licensors, Merchants and Associates (as these terms are defined in the Terms of Use).
										<br /><br />
										Please note that any personal information you reveal or post on one of our public forums (as defined in the Terms of Use), such as a message board, chat 
										room, discussion group, folder, survey, contest, sweepstakes, user review and rate forum, and all User Submissions, are not protected by this Privacy 
										Policy and may be collected, shared and used by us and with third parties, including to contact you. Information you give out or post on our public forums 
										you disclose at your own risk.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Security and Passwords</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										If you place an order on our Web site, it encrypts the credit/debit card number you submit prior to transmission over the Internet using secure socket 
										layer (SSL) encryption technology. This technology works best when the Web Site is viewed using Microsoft IE, Google Chrome, Mozilla Firefox, and Apple 
										Safari browsers. However, no transmission of data over the Internet or any other network can be guaranteed to be 100% secure. Although we make reasonable 
										efforts to safeguard personal information once we receive it, we cannot warrant the security of information we receive.
										<br /><br />
										Portions of the Services (such as our Member registration and Address Book) may require registration and log-in processes in which you will select a user 
										ID and password (collectively, the "Password"). Passwords provided to you by us are the confidential property of Memorial Flowers (www.memorialflowers.ca) 
										and may be used by you solely for your individual use of the Services (and otherwise as specified by us). You are responsible for maintaining the 
										confidentiality of any Password and for all activities that occur using your Password, whether or not authorized by you. You agree to immediately notify 
										us of any unauthorized use of your Password or accounts.
										<br /><br />
										We may provide you with the ability to log into our Services using a social media account, such as Facebook Connect. We do not control the activities of 
										such social media services and have no control over the data they collect or their privacy practices. You should review their privacy practices before using 
										any such social media service.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>From Third Parties</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We do not share email addresses you provide with third parties without your consent. In addition, if you prefer that other personal information provided 
										by you not be shared with third parties, please let us know by contacting us as described below and identify the personal information that you would prefer 
										not to be shared. Your instructions will be processed as soon as reasonably practicable and in accordance with law.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Your Consent and Changes to this Policy</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Subject to the above provisions, by using our Web Site, you consent to the terms of this Privacy Policy and the Terms of Use, of which this policy is a part. 
										We may change our Privacy Policy and Terms of Use from time to time as new features or services are added, suggestions from our customers are incorporated 
										or other changes are made. We will endeavor to post any material changes to the Privacy Policy and/or Terms of Use on our Web Site at least 30 days prior 
										to their effective date - unless we believe changes must take effect sooner to comply with law or to protect Memorial Flowers (www.memorialflowers.ca) or 
										our customers, users, Members, recipients, Sponsors, Providers, Licensors, Merchants, Associates and Affiliates, in which case the changes will be effective 
										upon posting or as otherwise specified.
										<br /><br />
										The date on which the current Privacy Policy and overall Terms of Use took effect is listed at the top of the Privacy Policy and Terms of Use (see "Last 
										Updated" at the top of each).
										<br /><br />
										By using Memorial Flowers (www.memorialflowers.ca), after such changes take effect, you agree to be legally bound and to abide by the revised Privacy Policy 
										and Terms of Use, of which this policy is a part.
									</p>
								</div>
							</li>
						</ul>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Children</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memoriaflowers.ca) is intended for the use of adults 18 years or older. You are not permitted to use the website if you are under 
										the age of 18. By using the website, you agree to provide us with accurate information concerning your age or identity if we request it. You also agree 
										not to assist children under the age of 18 in accessing the Memorial Flowers website or to attempt to contact children under 18 through the website.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Cookies</p>
								</div>
								<div class="clav_toggle_content media">
									
									<p style="text-align:justify;">
										A cookie is a string of information that is sent by a website and stored on your hard drive or temporarily in your computer's memory. We may employ cookie 
										technology to help you move faster through our site. We may employ cookie technology to estimate our total audience size and traffic and to help us improve 
										our site's experience by measuring which site areas are of greatest interest to users. You can turn off the ability to receive any of these cookies by adjusting 
										the browser settings in your computer, but you should note that if you do so, this may materially affect the functionality of the Memorial Flowers 
										(www.memorialflowers.ca) website and the information you can access through it. If you wish to find out more about cookies, or how to refuse cookies, please 
										visit the Interactive Advertising Bureau's website at www.allaboutcookies.org. We collect anonymous data when you visit most pages on the Memorial Flowers 
										(www.memorialflowers.ca) website. Your visit may automatically provide us with data that is not linked to your personal information, such as your IP 
										(Internet Protocol) address, browser type, operating system, domain name, access times, and referring website addresses. Some parts of the Memorial Flowers 
										(www.memorialflowers.ca) website use embedded pixel or JavaScript technologies to facilitate your use of the website and to track general traffic. We use your 
										anonymous data to obtain general statistics regarding the use of the Memorial Flowers (www.memorialflowers.ca) website and its specific web pages and to evaluate 
										how our visitors use and navigate our website on an aggregate basis. We do not link your anonymous data with personal data.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Credit Cards</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Purchasing from Memorial Flowers (www.memorialflowers.ca) requires a valid credit card.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>What information do we gather?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We collect information through our Web Site, emails, mail, fax, telephone, mobile applications and social media applications including when you:<br /><br />
										
										<b>*</b> Place an order,<br />
										<b>*</b> Participate in our forums, surveys, contests, sweepstakes, promotions, content submissions, chats, bulletin boards, discussion groups, requests 
												 for suggestions, and membership registrations, and<br />
										<b>*</b> Engage in other activities, services, products and resources we make accessible to our customers, members or users.<br /><br />
										
										Depending on how you are interact with us, we collect some or all of the following types of information:<br /><br />
										
										<b>*</b> Your name, address, telephone number, email address,<br />
										<b>*</b> Billing information (credit/debit card number, expiration date, alternate or additional billing information and billing address),<br />
										<b>*</b> Gender and birth date, if you choose, or are otherwise required to, enter such information,<br />
										<b>*</b> Products purchased and occasion type (for example, Mother's Day),<br />
										<b>*</b> Any promotion or gift card code and related information <br />
										<b>*</b> Message and gift recipients' names, addresses, telephone numbers and email addresses, and<br />
										<b>*</b> Other information you provide to us, including User Submissions (defined in the Terms of Use).<br /><br />

										Information you provide to us may be collected by us even if an order, registration, or other process is started but not completed or otherwise 
										cancelled. Members may also add to their Address Book the name, address and telephone number of friends or other persons to whom they may wish to 
										send gifts or expressions. Other Members do not have the right to view and edit your Address Book entries. 
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Links to Other Services</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) wants you to be aware that when you click on links and/or ad banners that take you to affiliated or third-party 
										services, you will be subject to the privacy policies and terms of use of those services, not ours. We encourage you to read the posted privacy statement 
										and user terms whenever using, and prior to providing any personal information to, any other service.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>How to Limit the Use of Personal Information</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We want to communicate with you only to the extent you want to hear from us. If you prefer not to have personal information collected from you via the 
										Services shared with third parties, or to set your preferences concerning promotional communications, please follow the directions below.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Customer Satisfaction Department</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										<b>Memorial Flowers</b><br />
										65A Wingold Avenue<br />
										North York, ON, M6b 1p8<br />
										Telephone: 416-536-1349<br /><br />
										**Please include or tell us your mailing address and if you have a catalog, brochure or other mailing label from us, please include it with your request 
										or have it ready when you call.**
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Your Comments</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) welcomes feedback concerning this Privacy Policy and our practices. <br /><br />
										If you have any questions, concerns or comments regarding our Terms of Use, Privacy Policy or privacy practices, please contact our Head Office at 416-536-1349.
									</p>
								</div>
							</li>
						</ul>
					</div>
					
				
				</div>
			</div>
		</section>			
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>