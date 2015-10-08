<?php if($this->session->userdata('fun_id')!=''){ ?>

<?php $fun_home = $this->Product_model->get_fun_home($this->session->userdata('fun_id')); ?>

<style>
@media screen and (min-width : 1000px) {
    .ta-image{
		background-image: url(<?php echo base_url(); ?>templates/dignity/img/dignity-mem-banner-2.jpg); 
		max-width:100%;
		height:89px;
	}
	.mar-te{
		padding-left:27%;
	}
}
@media screen and (max-width : 999px) {
    .ta-image{
		background-image: url(<?php echo base_url(); ?>templates/dignity/img/dignity-mem-banner-2b.jpg); 
		max-width:100%;
		height:89px;
	}
	.mar-te{
		padding-left:34%;
	}
}

</style>

			<div id="responsive" class="horizontal-banner">
                 <!--<a href="#"><img src="<?php echo template_url('img/banner.jpg');?>" alt="Dignity Flowers"></a>-->
				 <div>
					<table width="100%" border="0" class="ta-image" style="">
						<tr>
							<td width="100%" class="mar-te">
								<span style="color:#45BECC;font-size:17px;font-weight:bold;"><?php echo $fun_home->funeral_home; ?></span><br />
								<span style="font-size:14px;"><?php echo $fun_home->address1; ?>, <?php echo $fun_home->city; ?>, <?php echo $fun_home->province; ?> <?php echo $fun_home->postalcode; ?> | <?php echo $fun_home->phone; ?></span><br />
								<?php if($this->session->userdata('memory_of')!='No'){ ?>
									<span style="font-size:14px;">In Memory of <?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?></span><br />
								<?php } ?>
							</td>
						</tr>
					</table>
				 </div>
            </div>
			
			<div id="mobile-header" class="horizontal-banner">
                 <div>
					<table width="100%" border="0">
						<tr>
							<td width="100%">
								<span style="color:#45BECC;font-size:17px;font-weight:bold;"><?php echo $fun_home->funeral_home; ?></span><br />
								<span style="font-size:14px;"><?php echo $fun_home->address1; ?><br />
								<?php echo $fun_home->city; ?>, <?php echo $fun_home->province; ?> <?php echo $fun_home->postalcode; ?> | <?php echo $fun_home->phone; ?></span><br />
								<?php if($this->session->userdata('memory_of')!='No'){ ?>
									<span style="font-size:14px;">In Memory of <?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?></span>
								<?php } ?>
							</td>
						</tr>
					</table>
				 </div>
            </div>
			
<?php }else{ ?>
<!--
<div class="horizontal-banner text-center">
                 <div style="background-image: url(<?php echo base_url(); ?>templates/dignity/img/dignity-mem-banner-2.jpg); height:89px; width:100%;text-align:left;padding-top:10px;">
					<table width="100%">
						<tr>
							<td width="28%">
							
							</td>
							<td width="72%">
								<span style="color:#45BECC;font-size:17px;font-weight:bold;">Stonewall Memory Gardens</span><br />
								<span style="font-size:14px;">65A Wingold Avenye, North York, ON M6B 1P8 | 416-516-1569</span><br />
								<span style="font-size:14px;">In Memory of Not Defined</span><br />
							</td>
						</tr>
					</table>
				 </div>
            </div>
-->
	
	
<?php } ?>	

<div id="mobile-header" class="horizontal-banner">
	<div>
		<table width="100%" border="0">
			<tr>
				<td width="100%" align="center">
					<a onClick="openMenu2();" class="btn btn-primary">Categories &nbsp; <i class="fa fa-chevron-down"></i></a>
					<?php if($ti!=''){ ?>
					<a onClick="openMenu3();" class="btn btn-primary">Sort &nbsp; <i class="fa fa-chevron-down"></i></a>
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="men3" class="row" style="display:none;margin-top:-10px;margin-bottom:10px;">		
		<div class="col-lg-12">
		
			<table width="100%">
				<tr height="40">
					<td width="100%" align="center" style="background-color:#e74c3c;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a href="javascript:;" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Sort By</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a onClick="changeSortBy('BM');" href="javascript:;" style="color:inherit;font-size:14px;color:#e74c3c;">
							<div style="width:100%;">Best Match</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a onClick="changeSortBy('DESC');" href="javascript:;" style="color:inherit;font-size:14px;color:#e74c3c;">
							<div style="width:100%;">Highest Price</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;border-left:1px solid #fff;border-right:1px solid #fff;">
						<a onClick="changeSortBy('ASC');" href="javascript:;" style="color:inherit;font-size:14px;color:#e74c3c;">
							<div style="width:100%;">Lowest Price</div>
						</a>	
					</td>
				</tr>
			</table>
			
				
			
		</div>
	</div>

<div id="men" class="row" style="display:none;margin-top:-10px;margin-bottom:10px;">		
		<div class="col-lg-12" style="border: 1px solid #e74c3c; padding: 0px; margin: 0px 15px;">
		
			<table width="100%">
				<tr height="40">
					<td width="100%" align="center" style="background-color:#e74c3c;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-service/1" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Flowers for the Service</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/standing-sprays/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Standing Sprays</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/wreaths-&-hearts/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Wreaths & Hearts</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/crosses/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Crosses</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/vase-arrangements/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Vase Arrangements</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/tributes/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Tributes</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets-service/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Sympathy Baskets</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/urn-spray/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Urn Spray</div>
						</a>	
					</td>
				</tr>
				<tr height="40">
					<td width="100%" align="center" style="background-color:#e74c3c;">
						<a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office/1" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Flowers for Home & Office</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/vase-arrangements/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Vase Arrangements</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>subcategory/sympathy-baskets/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Sympathy Baskets</div>
						</a>	
					</td>
				</tr>
				<tr height="35">
					<td width="100%" align="center" style="background-color:#ffffff;">
						<a href="<?php echo base_url(); ?>category/plants/1" style="color:inherit;font-size:14px;color:#444;">
							<div style="width:100%;">Plants</div>
						</a>	
					</td>
				</tr>
				<tr height="40">
					<td width="100%" align="center" style="background-color:#e74c3c;">
						<a href="javascript:;" style="color:inherit;font-size:14px;color:#fff;">
							<div style="width:100%;">Colors Collection</div>
						</a>	
					</td>
				</tr>
				<tr height="90">
					<td width="100%" align="center" style="background-color:#ffffff;">
						
						<table width="100%" border="0">
							<tr height="10">
								<td colspan="9">
								
								</td>
							</tr>
							<tr>
								<td width="1%">
									
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/blue/1">
										<div style="background-color:#1F50A9;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/lavender/1">
										<div style="background-color:#846FAB;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/pink/1">
										<div style="background-color:#CB476B;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/pastel/1">
										<div style="background-color:#E0D2E5;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="1%">
								
								</td>
							</tr>
							<tr height="10">
								<td colspan="9">
								
								</td>
							</tr>
							<tr>
								<td width="1%">
									
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/white/1">
										<div style="background-color:#F6F0DE;width:80%;height:40px;">
										
										</div>
									</a>	
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/yellow/1">
										<div style="background-color:#EFDF49;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/peach/1">
										<div style="background-color:#F1BC82;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="2%">
								
								</td>
								<td width="23%" align="center">
									<a href="<?php echo base_url(); ?>subcategory/red/1">
										<div style="background-color:#C51A1B;width:80%;height:40px;">
										
										</div>
									</a>
								</td>
								<td width="1%">
								
								</td>
							</tr>
							<tr height="10">
								<td colspan="9">
								
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
				
				
			</table>
			
				
			
		</div>
	</div>
		