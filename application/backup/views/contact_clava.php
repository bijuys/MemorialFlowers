<?php 
include_once('header_clava.php');
?>	
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
		
		<section class="content about" style="margin-bottom:-50px;">
			<div class="container">
				
				<div class="row sub_content">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4>Contact US</h4>
							<div class="gDot"></div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12">
						
                        
                        
<table width="100%">
				
			
		<tbody>
			<tr>
				<td width="20%" valign="top">
					<span class="subtitle"> Memorial Flowers Head Office:</span><br />
					<br />
					Attn. Customer Service<br />
					65A Wingold Avenue<br />
					North York, Ontario, Canada<br />
					M6B 1P8<br />
					Phone: 416-516-1569<br />
					Fax: 416-537-6392<br /><br />
					
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5768.470009941751!2d-79.45531451666925!3d43.705665041492566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b33e9d1837775%3A0x44b45f051bf341e!2s65+Wingold+Ave%2C+North+York%2C+ON+M6B+1P8!5e0!3m2!1sen!2sca!4v1433964014127" width="225" height="150" frameborder="0" style="border:0"></iframe>
					
					<br /><br /><br />
					
					  <span class="subtitle">Memorial Flowers Oshawa:</span><br />
					<br />
					Attn. Customer Service<br />
									843 King Street West<br />
									Oshawa, ON<br />
									L1J 2L5<br />
									Phone:905-605-3233<br />

              
                               	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d718.8312954057432!2d-78.8950875!3d43.89053139999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d51db194e8d3d9%3A0x9fcf81fdaf86a5b7!2s843+King+St+W%2C+Oshawa%2C+ON+L1J!5e0!3m2!1sen!2sca!4v1427296621732" width="225" height="150" frameborder="0" style="border:0"></iframe>		
								 <br /><br />
								
					
                                        &nbsp;</td>
				<td width="5%">&nbsp;
					</td>
				<td width="20%" valign="top">
					<span class="subtitle">Memorial Flowers Toronto Production Center:</span><br />
					<br />
					494 Gilbert Ave<br />
									Toronto, ON<br />
									M6E 4X5<br/>
				                    Phone: 416-516-1569 ext.7249<br />
                                        <br/><br />
                                 	 <iframe width="225" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?hl=en&amp;q=494+Gilbert+Ave+Toronto,+ON+M6E+4X5&amp;ie=UTF8&amp;hq=&amp;hnear=494+Gilbert+Ave,+York,+Ontario+M6E+2C7&amp;t=m&amp;z=14&amp;ll=43.691366,-79.46307&amp;output=embed"></iframe><br /><small><a href="https://maps.google.ca/maps?hl=en&amp;q=494+Gilbert+Ave+Toronto,+ON+M6E+4X5&amp;ie=UTF8&amp;hq=&amp;hnear=494+Gilbert+Ave,+York,+Ontario+M6E+2C7&amp;t=m&amp;z=14&amp;ll=43.691366,-79.46307&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
								
                                </td>
				<td width="5%">&nbsp;
					</td>
				<td width="30%" valign="top">
					<span class="subtitle">Memorial Flowers Calgary:</span><br />
					<br />
					Attn. Customer Service<br />
					343 -3750-46 AVE SE<br />
					Calgary, AB<br />
					T2B 0L1<br />
					Phone:587-885-1033 <br /><br />

              
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2510.1624843169484!2d-113.9754671!3d51.013147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53717a5bda02a631%3A0xe58a1a66edd65d92!2s3750+46+Ave+SE%2C+Calgary%2C+AB+T2B+0L1!5e0!3m2!1sen!2sca!4v1434029024300" width="225" height="150" frameborder="0" style="border:0"></iframe>
				  <br /><br />  
                                </td>
				<td width="5%">&nbsp;
					</td>
				<td width="30%" valign="top">
					<span class="subtitle">Memorial Flowers Montreal:</span><br />
					<br />
					Attn. Customer Service<br />
					4525 Chemin de la Cote-des-Neiges<br />
					Montreal, QC<br />
					H3V 1E7<br />
					Phone:514-360-1230<br/>

              
                                <iframe width="225" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?hl=en&amp;q=4525+Ch.+De+La+Cote-Des-Neiges,+Montreal&amp;ie=UTF8&amp;hq=&amp;hnear=4525+Chemin+de+la+C%C3%B4te-des-Neiges,+Montr%C3%A9al,+Montreal,+Qu%C3%A9bec+H3V+1E7&amp;t=m&amp;z=14&amp;ll=45.495767,-73.606887&amp;output=embed"></iframe><br /><small><a href="https://maps.google.ca/maps?hl=en&amp;q=4525+Ch.+De+La+Cote-Des-Neiges,+Montreal&amp;ie=UTF8&amp;hq=&amp;hnear=4525+Chemin+de+la+C%C3%B4te-des-Neiges,+Montr%C3%A9al,+Montreal,+Qu%C3%A9bec+H3V+1E7&amp;t=m&amp;z=14&amp;ll=45.495767,-73.606887&amp;source=embed" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                                <br /><br />
                                        &nbsp;</td>
               
                        </tr>
						
						<tr height="50">
						<td>
						</td>
						</tr>
						
						<tr>
				<td width="20%" colspan="1" style="text-align:left;">
					
                                        &nbsp;</td>
<td width="5%">&nbsp;
					</td>
				<td width="20%">
					
                                </td>
<td width="5%">&nbsp;
					</td>
				<td width="20%">
					  
					
                                </td>

<td width="5%">&nbsp;
					</td>
				<td width="20%">
					
					</td>

               
                       		 </tr>
			
		

		</tbody>

	</table>                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
					</div>
				</div>
			</div>
		</section>			
		
	</section>
	<!--end wrapper-->
	
<?php include_once('footer_clava.php'); ?>