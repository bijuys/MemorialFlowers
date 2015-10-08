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
									FAQs
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
						<h3>General</h3>
					</div>
					
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>What forms of payment do you accept?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We accept Visa, MasterCard and American Express for orders placed online. In addition to these, we also accept cash and debit for orders placed at a What A Bloom 
										retail store. For a complete list of What A Bloom locations across Canada please visit our <a href="<?php echo base_url(); ?>contact">Contact Us</a> page.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Is it safe to use my credit card online?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes. We never send your personal information over the network in a way that is readable to anyone but us. We encrypt your information and send it over the Internet 
										using SSL (secure socket layer) technology. When your browser is in secure mode you will notice a key or lock icon at the bottom of your browser window. Memorial 
										Flowers does not rent or sell information we receive from web orders or e-mail registrations to third parties. For more information please refer to our 
										<a href="<?php echo base_url(); ?>privacy-and-security">Privacy Policy</a>
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>What happens after I place an order online?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										After placing an order online you will be directed to a confirmation page that will provide you with the invoice number pertaining to your order. This invoice number 
										will also be sent to you via e-mail to the address you provided. Keep this number for your records and reference it in the event that you have any questions or concerns 
										regarding your order. If you do not see a confirmation page after placing your order it means your order placement was unsuccessful and your credit card was not charged.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can I include a message with my order for the recipient?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes, and it’s free! When placing an order you will be given the option to include a card message with your gift and will be asked for the message during the checkout process. 
										If you do not wish to include a card message simply uncheck the “Message on Card” option. Messages can contain up to 255 characters to ensure they fit neatly on our 
										complimentary message cards. 
										<br /><br />
										We respect the privacy of our customers and will only ever disclose the contents of a card message to the recipient or customer, never to anybody else. 
										If you leave the card blank and your intended recipient contacts us to inquire about the sender, you can be assured that we will not disclose your personal 
										details without your permission. As per our privacy policy, we will contact you first before we release any information about you to the recipient, including 
										your name. 
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can I make changes to an order after I place it?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										To make changes to your order, please contact us as soon as possible. You can email the necessary amendments and your order number to us via email support ticket or 
										call our customer service department at 416-536-1349. We request that all amendment requests are made at least 24 hours prior to delivery, if possible.	
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>I changed my mind and would like to cancel my order, can I do that?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes. If we are given enough notice we can cancel your order without penalties. However, if your order has been dispatched and is on route for delivery we will be unable to 
										refund any applicable service or delivery fees. 
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can you place arrangements at cemeteries?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We will deliver your arrangement to the cemetery’s main delivery area. Placement of the arrangement, however, is entirely up to the discretion of the deceased’s family 
										and/or cemetery. If you would like to request special placement of your arrangement we recommend that you arrange these details directly with the cemetery. Any 
										applicable placement fees will be paid directly to the organizing party and not Memorial Flowers. 
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can I request where to place my order for a funeral service?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We welcome requests but cannot make any guarantees as the layout of the funeral home is up to the discretion of funeral directors and families.
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
									<p>Do you have options so I can send my sympathies to a home or office?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes. We have a wide range of plants plants, flowers and fruit baskets suitable for home or office.<br /><br />
										<b>I'm not sure what I should send, can you help me?</b> 
										Funeral flowers are generally categorized by their function; here are a few of the more commonly used arrangements to avoid any confusion when ordering:<br /><br />
										<b>* </b>Wreaths - These are circular floral arrangements, which represent eternal life.<br />
										<b>* </b>Floral arrangements - Any type of floral arrangement, from cut flowers to basket and container arrangements.<br />
										<b>* </b>Sprays - These are arrangements that allow viewing from one side only.<br />
										<b>* </b>Casket sprays - These are usually organized by direct family members and sit on top of the casket.<br />
										<b>* </b>Inside pieces - These are the items placed inside the casket, such as small floral sprays.<br /><br />
										
										There are no particular types of flowers or colors that should be sent at funerals or homes of the bereaved. There are, however, more traditional choices 
										such as carnations, chrysanthemums, gladiolas, lilies and roses. In particular, white lilies represent peace and red roses are renowned for expressing love. 
										If the deceased always loved being in the garden and had a favorite flower and color, it would obviously be very comforting for the bereaved to receive an 
										arrangement of such flowers.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>How do I know if what I'm sending is appropriate?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Traditionally, flowers are a way to represent growth, new life and movement forward. The natural beauty of flowers at a funeral and at the home of mourners 
										brings a sense of warmth and comfort to the environment.
										Today, flowers are not mandatory but they are one way people express their love for the deceased and concern for members of the family. Flowers for a 
										funeral should arrive at the funeral home before the first visiting hours - to be there when the family arrives. If time does not permit delivery before 
										visiting hours, flowers or a plant can be sent to the home of the bereaved. A potted plant has obvious symbolic meaning because it will continue to live 
										and grow.<br /><br />
										There are instances when flowers are not appropriate. Such as when the family requests that donations be made in lieu of flowers. Although flowers are 
										freely accepted by many religions and cultures at funerals, it is worth remembering that there are some which do not traditionally receive flowers such 
										as the Jewish and Islamic faiths.
										Jewish law has always demanded immediate burial - within three days - so flowers were never deemed necessary. To this day it has never been customary to 
										send any flowers, although they are not forbidden and some Jews have begun sending them for Reformed Jewish funerals. Instead it is customary to send fruit 
										and food baskets to the home of the bereaved during the mourning period. See our collection of <a href="<?php echo base_url(); ?>subcategory/sympathy-baskets">Sympathy Baskets</a>
										<br /><br />
										At Islamic funerals some people send flowers and some do not. It is, however, common to place individual flowers on graves along with palm branches and other 
										greenery. Flowers are not a traditional part of Hindu funerals, but they are not unwelcome.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can I place an order by Colour? By Price?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes! Our website is categorized to make searching as easy as possible and you can browse our catalog by colour, price or style.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Do I have the option of making changes to a piece I see on your website or can I create a custom piece?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										With sufficient notice and little to no cost at all, we are able to change the colours, flowers, or style of any arrangement. We try to accommodate 
										requests as best we can but cannot always guarantee that custom pieces will be an available option.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>I've been informed that a family member has ordered a piece, is it possible to match their chosen piece?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes, our catalog offers beautiful combinations of styles and colours that go great together. If you would like to order more than one piece or want 
										to match another piece, our pages will help you find the perfect combinations.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>What are your delivery procedures?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Funeral pieces are very delicate and we take the best care possible to ensure your arrangement arrives in perfect condition. To ensure deliveries are 
										completed in a timely fashion we prefer to deliver items within five hours of order processing. If this time frame is not allotted and we are unable 
										to deliver in time for a service, we will call you to make other arrangements to ensure you can express your condolences alternatively to a home or 
										an office.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>I was not pleased with my service or have a suggestion, who can I contact? </p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We very much appreciate and welcome customer feedback. Please direct all questions, comments or concerns to  wecare@whatabloom.com.
									</p>
									
								</div>
							</li>
						</ul>
					</div>
				
				</div>

				<div class="row sub_content">	
					
					
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<h3>Substitution</h3>
					</div>
					
					
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Will the arrangement I purchase be true to the picture on the website?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Minor substitutions may be made to your arrangement for various reasons. Specific flowers may be out of season, our product shipments may be delayed or 
										weather conditions may affect what is in stock . The following substitution rules may apply to your order:<br /><br />
										<b>* </b> Flowers: In arrangements of assorted flowers, colours are subject to availability and colour substitutions may apply. The colors shown online will be 
										used if they are available even if this means substituting other kinds of flowers of greater value.<br />
										<b>* </b> Specialty flower arrangements: Such as an all rose or all lily bouquet, we will make every attempt to match the flower type but colour is subject 
										to availability.<br />
										<b>* </b> Plants: For green and blooming plants, similar plants may be substituted of equal or greater value.<br />
										<b>* </b> Specialty plants: Such as orchids, we will make every attempt to match the plant type but colour is subject to availability.<br />
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Will I be informed of substitutions? </p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Our open substitution policy allows us to approve minor substitutions without notifying the customer. If the substitutions in question will drastically change 
										the look an an arrangement then we will typically notify you unless we are not informed by the filling florist. 
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
									<p>What if I am not happy with the substitutions made?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										We want all our customers to have a positive experience with us and will work with you to ensure satisfaction. If you are not satisfied with the substitutions applied 
										to your order we encourage you to get in touch with us within 24 hours of delivery and we will work with you to address your concerns.
									</p>
								</div>
							</li>
						</ul>
					</div>
					
				</div>
				
				<div class="row sub_content">	
					
					
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<h3>Discounts</h3>
					</div>
										
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Do you accept promotion and discount coupons?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Yes. To use a promotion or discount coupon simply enter it into the coupon box upon checkout and your discount will apply. Please note that promotion 
										coupons are case sensitive so be sure to enter your code exactly how you see it.
									</p>
								</div>
							</li>
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>Can more than one discount be applied to my order? </p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										No, discounts cannot be combined. If you have two or more discount codes you can only apply one to your order.
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
									<p>I've placed an order and forgot to apply my discount code, what can I do? </p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										If your order has already been delivered, we unfortunately cannot apply a discount to your order. We can, however, ensure remains active for a future order. 
										If your order has not been delivered, you will have to cancel your order and place a new one with your desired coupon code. 
									</p>
								</div>
							</li>
						</ul>
					</div>
				
				</div>

				<div class="row sub_content">	
					
					
					<div class="col-lg-12 col-md-12 col-sm-12">
						
						<h3>Returns</h3>
					</div>
										
					<div class="col-lg-6 col-md-6 col-sm-6">
						<ul class="clav_toggle">
							<li class="clav_list_toggle">
								<div class="clav_toggle_head">
									<div class="clav_toggle_head_sign"></div>
									<p>I am not satisfied with my order and would like a refund, what is your return policy?</p>
								</div>
								<div class="clav_toggle_content">
									<p style="text-align:justify;">
										Due to the perishable nature of our products we require a 24 notice from delivery date for complaints. If you are unsatisfied with your order we ask 
										that you file a complaint with us within 24 hours of delivery to be eligible for a full refund. If you file a complaint after 24 hours of delivery you 
										may be eligible for a partial refund. All complaints are addressed on a case by case basis so how your complaint is resolved depends on the time we 
										receive it and the nature of your concerns.
									</p>
								</div>
							</li>
						</ul>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6">
						
					</div>	
				
				</div>
			</div>
		</section>			
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>