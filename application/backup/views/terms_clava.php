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
									Terms Of Use
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
							Memorial Flowers welcomes you to our service. The service includes the Web Site located at www.memorialflowers.ca (the "Web Site"), our mobile applications, and orders 
							placed through our online and telephone applications (collectively, the "Services"). The goal of the Web Site is to provide access to our wide selection of floral, 
							plant, gift basket, gourmet food, and gift products and services to as wide an audience as possible. To ensure a safe, pleasant environment for all users we have 
							established these Terms of Use. This information provides the reader with what can be expected from our company and what is expected of the consumer.
							<br /><br />
							<b>Note:</b> <i>You must be 18 years or older and the age of majority in your place of residence to use, subscribe, or register as a member of Memorial Flowers (or 19 years or 
							older in the event that you place a request for transmission of an order for a product containing alcohol).</i>
							<br /><br />
							Some of the products marketed by Memorial Flowers (www.memorialflowers.ca) may contain wine (alcoholic beverage) products. You must be an adult (19 years or older) to place 
							a request for a wine product order which we will then forward to our designated licensed retailer or winery for acceptance, sale and processing of your order. Similarly, 
							the recipient of your wine product order must be 19 years or older to accept delivery. The shipping carrier shall require identification, age verification and signature of 
							an adult at the time of delivery. By placing your request for a wine product order you certify under penalty of law that you and the intended recipient are at least 19 years 
							old. Any willful misrepresentation of your, or the recipient's age, in order to unlawfully obtain alcoholic beverage is a crime and Memorial Flowers will cooperate with 
							authorities to prosecute you and the recipient to the fullest extent of the law.
							<br /><br />
							<b>
								THESE TERMS OF USE APPLY TO ALL MERCHANDISING CHANNELS OF MEMORIAL FLOWERS AND ITS AFFILIATES INCLUDING, BUT NOT LIMITED TO, THE INTERNET, TELEPHONE, CATALOG, RADIO, 
								TELEVISION, MOBILE DEVICE, SOCIAL MEDIA AND PARTICIPATING RETAIL STORES. BY ACCESSING ANY OF THE COMPANY MERCHANDISING CHANNELS, AND ANY AREAS OF THE SERVICE, YOU AGREE 
								TO BE LEGALLY BOUND AND TO ABIDE BY THESE TERMS OF USE.
							</b>
							<br /><br />
							Memorial Flowers (& Design) and the following are service marks or trademarks of the Company:							
						</p>
						<br />
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Disclaimers and Limitation of Liability</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										YOU EXPRESSLY AGREE THAT USE OF THE SERVICE IS AT YOUR SOLE RISK. NEITHER MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA), NOR ITS AFFILIATES, NOR ANY OF ITS 
										OFFICERS, DIRECTORS, OR EMPLOYEES, AGENTS, THIRD-PARTY SERVICE OR CONTENT PROVIDERS ("PROVIDERS"), MERCHANTS ("MERCHANTS"), SPONSORS ("SPONSORS"), LICENSORS 
										("LICENSORS"), OR THE LIKE (COLLECTIVELY, "ASSOCIATES"), WARRANT THAT THE SERVICE WILL BE UNINTERRUPTED OR ERROR-FREE; NOR DO THEY MAKE ANY WARRANTY AS TO 
										THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF SERVICE, OR AS TO THE ACCURACY, RELIABILITY, OR CURRENCY OF ANY INFORMATION CONTENT, SERVICE, OR MERCHANDISE 
										PROVIDED THROUGH THE SERVICE; EXCEPT THAT MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA) DOES GUARANTEE (THROUGH ITS "100% SATISFACTION GUARANTEE") THAT YOUR 
										FLORAL ARRANGEMENT WILL STAY FRESH FOR SEVEN DAYS AFTER DELIVERY AND THAT OUR FOOD STUFF PRODUCTS WILL BE WHOLESOME AND FREE OF SUBSTANTIAL DEFECTS, AND 
										IF THEY ARE NOT, MEMORIAL FLOWERS' (WWW.MEMORIALFLOWERS.CA) SOLE MAXIMUM LIABILITY WILL BE, WITHIN ITS SOLE DISCRETION, NOT MORE THAN TO EITHER REFUND THE 
										ACTUAL PURCHASE PRICE PAID BY THE CUSTOMER, OR TO REPLACE AND DELIVER AN EQUIVALENT FLORAL ARRANGEMENT OR AFFECTED FOOD STUFF PRODUCT AS SOON AS REASONABLY 
										PRACTICABLE.
										<br /><br />
										THE SERVICE IS PROVIDED ON AN "AS IS," "AS AVAILABLE" BASIS AND MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA) SPECIFICALLY DISCLAIMS WARRANTIES OF ANY KIND, 
										EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF TITLE OR IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE. 
										NO ORAL ADVICE OR WRITTEN OR ELECTRONICALLY DELIVERED INFORMATION GIVEN BY MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA) OR ITS AFFILIATES, OR ANY OF ITS OFFICERS, 
										DIRECTORS, EMPLOYEES, AGENTS, PROVIDERS, MERCHANTS, SPONSORS, LICENSORS, OR THE LIKE, SHALL CREATE ANY WARRANTY WHATSOEVER.
										<br /><br />
										UNDER NO CIRCUMSTANCES SHALL MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA), ITS AFFILIATES, NOR ANY OTHER PARTY INVOLVED IN CREATING, PRODUCING, MANUFACTURING, 
										DISTRIBUTING, MARKETING, OR SELLING THE SERVICE PRODUCTS, SERVICES OR THIS WEB SITE, BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, OR CONSEQUENTIAL 
										DAMAGES, INCLUDING WITHOUT LIMITATION, LOST PROFITS THAT RESULT FROM THE USE OF OR INABILITY TO USE THE SERVICE, INCLUDING BUT NOT LIMITED TO RELIANCE BY YOU 
										ON ANY INFORMATION OBTAINED FROM THE SERVICE OR THAT RESULT FROM MISTAKES, OMISSIONS, INTERRUPTIONS, DELETION OF FILES OR EMAIL, ERRORS, DEFECTS, VIRUSES, 
										DELAYS IN OPERATION OR TRANSMISSION, OR ANY FAILURE OF PERFORMANCE, WHETHER OR NOT RESULTING FROM ACTS OF GOD, COMMUNICATIONS FAILURE, THEFT, DESTRUCTION, 
										OR UNAUTHORIZED ACCESS TO MEMORIAL FLOWERS' (WWW.MEMORIALFLOWERS.CA) RECORDS, PROGRAMS, OR SERVICES.
										<br /><br />
										UNLESS OTHERWISE SPECIFICALLY STATED TO THE CONTRARY, ALL PRICES AND DISCOUNTS FOR ANY AND ALL PRODUCTS OR SERVICES OFFERED FOR SALE ("OFFERS') ARE EXCLUSIVE 
										OF APPLICABLE SERVICE AND SHIPPING CHARGES AND FEDERAL, STATE AND LOCAL TAXES. PRODUCTS AND OFFERS MAY VARY AND ARE SUBJECT TO AVAILABILITY, DELIVERY RULES 
										AND TIMES. OFFERS CANNOT BE COMBINED, ARE NOT AVAILABLE ON ALL PRODUCTS AND SERVICES AND ARE SUBJECT TO RESTRICTIONS, LIMITATIONS AND BLACKOUT PERIODS. 
										PROMOTIONAL OFFERS (AS DEFINED BELOW) ARE LIMITED TO ONE PER CUSTOMER ORDER, ARE NON-TRANSFERABLE, ARE NOT FOR RESALE AND MAY NOT BE REDEEMED FOR CASH. 
										PRICES AND CHARGES ARE SUBJECT TO CHANGE WITHOUT NOTICE. VOID WHERE PROHIBITED.
										<br /><br />
										MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA) RESERVES THE RIGHT, WITHIN ITS SOLE DISCRETION, TO REFUSE TO ACCEPT AND PROCESS ANY AND ALL CUSTOMER ORDERS AND TO 
										SUSPEND, DISCONTINUE, AND REFUSE THE USE OR ACCEPTANCE OF ANY AND ALL OFFERS, PROMOTIONS, DISCOUNTS, INCLUDING BUT NOT LIMITED TO, ANY AND ALL SAVINGS PASSES, 
										REWARD PASSES, FRESH REWARDS, POINTS, AWARD CARDS, APPRECIATION AWARDS, GIFT CARDS, GIFT CERTIFICATES, AND ANY AND ALL OTHER SIMILAR DEVICES AND PROMOTIONAL 
										OFFERS OR CAMPAIGNS ("PROMOTIONAL OFFERS") IN THE EVENT OF ADVERTISING ERRORS AND/OR THE ACTUAL OR SUSPECTED MISUSE, FRAUD OR ABUSE ASSOCIATED WITH SAID 
										PROMOTIONAL OFFERS OR CUSTOMER ORDERS.
										<br /><br />
										YOU HEREBY ACKNOWLEDGE THAT THIS PARAGRAPH SHALL APPLY TO ALL PRODUCTS, SERVICES AND CONTENT AVAILABLE THROUGH ALL PROMOTIONAL CHANNELS OF MEMORIAL FLOWERS' 
										(WWW.MEMORIALFLOWERS.CA) SERVICES AND THAT OF ITS AFFILIATES INCLUDING, BUT NOT LIMITED TO, THE INTERNET, TELEPHONE, CATALOG, RADIO, TELEVISION, MOBILE DEVICE, 
										SOCIAL MEDIA PLATFORM AND PARTICIPATING RETAIL STORES. BECAUSE SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR CONSEQUENTIAL OR 
										INCIDENTAL DAMAGES, IN SUCH STATES LIABILITY IS LIMITED TO THE FULLEST EXTENT PERMITTED BY LAW.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Termination of Usage</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) may terminate your access, or suspend your access to all or part of the Service, without notice, for any reason, 
										including conduct that Memorial Flowers (www.memorialflowers.ca), in its sole discretion, believes is a violation or breach of these Terms of Use, is in violation 
										of any applicable law or is harmful to the interests of another user, customer, recipient, subscriber, a third-party Provider, Merchant, Sponsor, Licensor, 
										content or service provider, Memorial Flowers (www.memorialflowers.ca) or its Affiliates.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Governing Law & Arbitration</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										This Agreement, and the respective rights and obligations of the parties hereunder, shall be governed by, and construed in accordance with the laws of 
										Canada. If there is a dispute between You and Memorial Flowers (www.memorialflowers.ca), any of such parties may elect to have it resolved by proceeding 
										in small claims court or by final and binding arbitration administered by the Canadian Arbitration Association under its rules for consumer arbitration. 
										All disputes in arbitration will be handled just between the named parties, and not on any representative or class basis. YOU ACKNOWLEDGE THAT THIS MEANS 
										THAT YOU MAY NOT HAVE ACCESS TO A COURT OR JURY. The terms of this Section shall survive any termination, cancellation or expiration of this Agreement.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Third Party Content on the Service</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) is a distributor and not a publisher of the Content supplied by third parties on the Service. Any opinions, 
										advice, statements, services, offers, or other information that constitutes part of the Content expressed or made available by third parties, including 
										Providers, Merchants, Sponsors, Licensors, or any user of the Service, are those of the respective authors or distributors and not of Memorial Flowers 
										(www.memorialflowers.ca) or its Affiliates or any of its officers, directors, employees, or agents. NEITHER MEMORIAL FLOWERS (WWW.MEMORIALFLOWERS.CA) NOR 
										ITS AFFILIATES, NOR ANY OF THEIR RESPECTIVE OFFICERS, DIRECTORS, EMPLOYEES, OR AGENTS, NOR ANY THIRD PARTY, INCLUDING ANY PROVIDER, MERCHANT, SPONSOR, 
										LICENSOR, OR ANY OTHER USER OF THE SERVICE, GUARANTEES THE ACCURACY, COMPLETENESS, OR USEFULNESS OF ANY CONTENT, NOR ITS MERCHANTABILITY OR FITNESS FOR 
										ANY PARTICULAR PURPOSE.
										<br /><br />
										In many instances, the Content available through the Service represents the opinions and judgments of the respective Provider, Merchant, Sponsor, Licensor, 
										subscriber, customer, or user, whether or not under contract with Memorial Flowers (www.memorialflowers.ca). Memorial Flowers (www.memorialflowers.ca) 
										neither endorses nor is responsible for the accuracy or reliability of any opinion, advice, submission, posting, or statement made on the Service by anyone 
										other than authorized Memorial Flowers (www.memorialflowers.ca) employees. Under no circumstances shall Memorial Flowers (www.memorialflowers.ca), or its 
										Affiliates, or any of their respective officers, directors, employees, or agents, be liable for any loss or damage caused by your reliance on any Content 
										or other information obtained through the Service. It is your responsibility to evaluate the information, opinion, advice, or other Content available through 
										the Service.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>User Submissions</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) does not claim ownership of any Content you submit or make available for inclusion on the Service. However, with 
										respect to all such Content, including, without limitation, creative ideas, suggestions, content, postings, artwork, material or other submissions whether 
										via email, feedback, a public forum or otherwise (collectively, "User Submissions"), you grant Memorial Flowers (www.memorialflowers.ca) and its Affiliates 
										the worldwide, perpetual, royalty-free, irrevocable, non-exclusive right to use, communicate, reproduce, publish, display, perform, modify, alter, adapt, 
										translate, sublicense, distribute, create derivative works from and exploit such User Submissions in any manner, including on the Service or any other web 
										sites, in television programs, on radio, in books, magazines, articles, commentaries, and in any other medium now known or later developed without your 
										consent. You also warrant that you own or otherwise control all of the rights to any User Submissions you submit or post on or to the Service or otherwise 
										transmit to Memorial Flowers (www.memorialflowers.ca) and that our public posting and other public or private use of such User Submissions will not infringe 
										the rights of any third party. You acknowledge that you are not entitled now, or in the future, to any compensation for any User Submissions you may submit 
										or post.
										<br /><br />
										No User Submissions, regardless of how they may be marked, will be received by us in confidence, nor shall they be subject to any express or implied obligation 
										of confidentiality. Neither Memorial Flowers (www.memorialflowers.ca) or its Affiliates, nor their respective officers, directors, agents or employees shall 
										be liable for any use or disclosure of any User Submissions.
										<br /><br />
										You and your successors and assigns hereby waive any and all rights and remedies you may have against Memorial Flowers (www.memorialflowers.ca), or its 
										Affiliates, or any of their respective officers, directors, employees, or agents now or in the future, and hereby release Memorial Flowers 
										(www.memorialflowers.ca), its Affiliates, and any of their respective officers, directors, agents and employees from any and all claims, demands, actions, 
										causes of action, damages, obligations, losses and expenses of whatever kind, (collectively "Claims") relating to providing, posting, transmitting or making 
										available through the Service the User Submissions to Memorial Flowers (www.memorialflowers.ca), or Memorial Flowers (www.memorialflowers.ca) receiving, 
										evaluating, and utilizing the User Submissions.
										<br /><br />
										In addition, Memorial Flowers (www.memorialflowers.ca) may, in our sole discretion, at any time and without prior notice to you, suspend or terminate any 
										public forum, any other portion of the Service, or the subscription or registration of any user who violates any of these terms and conditions of use, any 
										of the rules, regulations or guidelines or for any other behavior that we in our sole discretion believe is inappropriate.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>The Company's Rights</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) is not responsible for screening, policing, editing, or monitoring Content (including User Submissions). Memorial 
										Flowers (www.memorialflowers.ca) or its Affiliates may elect, but is not obligated, to monitor, electronically or otherwise, areas of the Service and may 
										disclose any Content (including User Submissions), records, or electronic communication of any kind and information you provide to Memorial Flowers 
										(www.memorialflowers.ca) or its Affiliates, through the Service or otherwise, including all merchandising channels, (i) when we believe disclosure to be 
										appropriate to comply with any law, regulation, or government or law enforcement request or to comply with judicial process; or (ii) if such disclosure 
										is necessary or appropriate to operate the Service and/or the overall business of Memorial Flowers (www.memorialflowers.ca) and its Affiliates; or (iii) 
										to protect the rights or property of Memorial Flowers (www.memorialflowers.ca), users of the Service, Affiliates, subscribers, customers, recipients, Sponsors, 
										Providers, Licensors, or Merchants. Subject to the "Copyright Agent" provisions above, if notified of allegedly infringing, defamatory, damaging, illegal, 
										or offensive Content, Memorial Flowers (www.memorialflowers.ca) may investigate the allegation and determine in its sole discretion whether to remove or 
										request the removal of such Content from the Service.
										<br /><br />
										Memorial Flowers (www.memorialflowers.ca) reserves the right to prohibit or remove conduct, communication, or Content (including User Submissions) that it 
										deems in its sole discretion to be harmful to users of the Service, subscribers, customers, recipients, Providers, Merchants, Sponsors, or Licensors, content 
										or service providers, Memorial Flowers (www.memorialflowers.ca) or its Affiliates, or any rights of Memorial Flowers (www.memorialflowers.ca) or any third 
										party, or to violate any applicable law. Notwithstanding the foregoing, neither Memorial Flowers (www.memorialflowers.ca), nor its Affiliates, Providers, 
										Merchants, Sponsors, or Licensors can ensure prompt editing or removal of questionable Content after online posting. Accordingly, neither Memorial Flowers 
										(www.memorialflowers.ca), nor its Affiliates, nor any of their respective officers, directors, employees, agents or employees, nor any Provider, Merchant, 
										Sponsor, or Licensor shall assume liability for any action or inaction with respect to conduct, communication, or Content (including User Submissions) on the 
										Service.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Online Conduct</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Any conduct by you that in Memorial Flowers' (www.memorialflowers.ca) sole discretion restricts or inhibits any other user from using or enjoying the 
										Service will not be permitted. You agree to use the Service in accordance with these Terms of Use and only for lawful purposes.
										<br /><br />
										You agree that you will not use the Service to send unsolicited advertising, promotional material, or other forms of solicitation to other users, except in 
										specified areas, if any, that are specifically designated for such a purpose. The provisions of these Terms of Use are for the benefit of Memorial Flowers 
										(www.memorialflowers.ca), its Affiliates and the Service Providers, Merchants, Sponsors and Licensors, and each shall have the right to assert and enforce 
										such provisions directly against the violator on its own behalf.
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
									<p>Indemnity</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										You agree to indemnify and hold Memorial Flowers (www.memorialflowers.ca), its Subcontractors, and their respective parents, subsidiaries, affiliates, officers, 
										directors, and employees harmless from any claim, damage, demand, expense, liability, or loss, including reasonable attorneys' fees, incurred by such party arising 
										out of or relating to your unauthorized use of the Service or your violation of these Terms. The terms of this Section shall survive any termination, cancellation 
										or expiration of this Agreement.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Severability</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										If any term or other provision of these Terms of Use are deemed by a final court of competent jurisdiction to be invalid, illegal or incapable of being enforced by 
										any rule of law, or public policy, all other terms, conditions and provisions of this these Terms of Use shall nevertheless remain in full force and effect to the 
										maximum extent permitted by law. Upon such determination that any term or other provision is invalid, illegal or incapable of being enforced, the court shall modify 
										only the affected term, condition or provision to effect the original intent of the parties as closely as possible so that the contemplated transactions are fulfilled 
										and Memorial Flowers (www.memorialflowers.ca) and its Affiliates are protected to the greatest extent possible.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Proprietary Rights</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										You acknowledge that the Service contains information, data, software, photographs, graphs, videos, typefaces, graphics, music, sounds, and other material (collectively 
										"Content") that are protected by copyrights, trademarks, or other proprietary rights, and that these rights are valid and protected in all forms, media and technologies 
										existing now or hereinafter developed. All Content is copyrighted as a collective work under the Canadian copyright laws, and Memorial Flowers (www.memorialflowers.ca) 
										or its Affiliates or other third party licensors may own a copyright in the selection, coordination, arrangement, and enhancement of such Content. You may not modify, 
										remove, delete, augment, add to, publish, transmit, participate in the transfer or sale of, create derivative works from, or in any way exploit any of the Content, in 
										whole or in part. If no specific restrictions are displayed, you may use the content only for your personal non-commercial use and make copies of select portions of the 
										Content, provided that the copies are made only for your personal use and that you maintain any notices contained in the Content, such as all copyright notices, trademark 
										legends, or other proprietary rights notices. Except as provided in the preceding sentence or as permitted by the fair use privilege under the Canadian copyright laws, you 
										may not upload, post, reproduce, or distribute in any way Content protected by copyright, or other proprietary right, without obtaining permission of the owner of the 
										copyright or other proprietary right. In addition to the foregoing, use of any software Content shall be governed by the software license agreement accompanying such software.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Copyright Agent</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Memorial Flowers (www.memorialflowers.ca) respects the rights of all copyright holders and in this regard it has adopted and implemented a policy that 
										provides for the termination of user privileges and membership in appropriate circumstances of users who infringe the rights of copyright holders. If you 
										believe that your work has been copied in a way that constitutes copyright infringement, please contact the Memorial Flowers (www.memorialflowers.ca) 
										Copyright Agent with the following information required by the Digital Millennium Copyright Act, C.20.<br /><br />
										<b>a.</b> A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed;<br />
										<b>b.</b> Identification of the copyright work claimed to have been infringed, or, if multiple copyrighted works at a single online site are covered by a single notification, a representative list of such works at that site;<br />
										<b>c.</b> Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit us to locate the material;<br />
										<b>d.</b> Information reasonably sufficient to permit us to contact the complaining party;<br />
										<b>e.</b> A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law; and<br />
										<b>f.</b> A statement that the information in the notification is accurate, and under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.<br />
										<br />
										Memorial Flowers' (www.memorialflowers.ca) Copyright Agent for notice of claims of copyright infringement on or regarding this site can be reached as follows:<br /><br />
										
										Attn: Cesario Ginjo<br />
										Memorial Flowers<br />
										65A Wingold Ave.<br />
										North York, ON M6B 1P8<br />
										Telephone:416-536-1349<br />
										Fax:: 416-537-6392<br />
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Use of Public Forums</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										A "public forum" means any publicly accessible message board, chat room, discussion group, folder, survey, contest, sweepstakes, user review and rate forum, 
										or other interactive service or promotion on or accessible via the Service , and includes both public boards and folders. You must use, subscribe, or register 
										in accordance with instructions that you will find on the Service in order to participate or register in accordance with instructions that you will find on 
										the Service in order to participate or contribute to any public forum. You may not submit or post on any public forum, or send to any other public forum user 
										or our employees, any material that is unlawful, harmful, threatening, abusive, harassing, defamatory, invades a person's privacy, violates any intellectual 
										or other property rights, or is vulgar, obscene, sexually explicit, profane, hateful, racially, ethnically, or otherwise objectionable, including but not 
										limited to any material that encourages conduct that would constitute a criminal offense, give rise to civil liability, or otherwise violate any applicable 
										local, state, national, or international law. You agree not to use any false e-mail address, impersonate any person or entity, or otherwise mislead as to 
										the origin of a communication or other Content, or attempt to do any such acts. You may not use any public forum in a commercial manner. You may not submit 
										or post material that solicits funds, or that advertises or solicits goods or services. You may not submit or post any User Submissions or material that you 
										know, or should have known, to be false. You may not submit or post messages regarding stocks or other securities. You may not submit, post, or transmit any 
										information, software or other material that contains a virus or other harmful component.
										<br /><br />
										Memorial Flowers (www.memorialflowers.ca) is not responsible for any User Submissions or material appearing in any public forum on the Service, except for 
										Content created by one of our identified authorized representatives. We do not screen User Submissions for libel, obscenity, invasion of privacy, copyright 
										or trademark infringement, accuracy, or for any other reason. We retain, however, the rights set forth below in Memorial Flowers' (www.memorialflowers.ca) 
										Rights section.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Distribution by Users of Third Party Content</p>
									<!--<p>Distribution/Uploading by Users of Third Party Content</p>-->
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Except as otherwise set forth in these Terms, you agree not to upload to or otherwise distribute on the Service any Content created or owned by others 
										which is subject to any copyright or other proprietary rights of any third party. The unauthorized submission or distribution of copyrighted or other 
										proprietary third party Content is illegal and could subject you to personal liability for damages. You, not Memorial Flowers (www.memorialflowers.ca) or 
										its Affiliates, or any of their respective officers, directors, agents, employees, Merchants, Providers, Sponsors, Licensors, or the like, will be liable 
										for any damages resulting from any infringement of copyrights or proprietary rights, or from any other harm arising from such submission.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Privacy Policy</p>
									<!--<p>Distribution/Uploading by Users of Third Party Content</p>-->
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We recognize and respect the importance of maintaining the privacy of our users, customers and subscribers and have established a privacy policy as a result. 
										In our Privacy Policy, which constitutes part of these Terms of Use, we describe why we gather information from users, customers, and subscribers, what 
										information we collect, how we collect it, what we use the information for and how you can instruct us if you prefer to limit the use of information about 
										you. We encourage you to carefully read our Privacy Policy. To link to our Privacy Policy click below: 
										<a href="<?php echo base_url(); ?>privacy-and-security">Security and Privacy</a>
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