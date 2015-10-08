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
<?php //echo $this->session->userdata('home_id'); ?>

<?php

if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
	/* JSON WEB SERVICE ACCESS */
	$json = file_get_contents('http://www.legacy.com/webservices/ns/FuneralInfo.svc/GetFuneralInfoJson?fhid='.$this->session->userdata('fhid').'&cobrand='.$this->session->userdata('cobrand').'&pid='.$this->session->userdata('pid'));
	$obj = json_decode($json);
	/*
	echo $this->session->userdata('fhid').'_'.$this->session->userdata('cobrand').'_'.$this->session->userdata('pid').'_____________';
	echo $json;
	*/
	$lfirstname = $obj->Obituary->FirstName;
	$llastname = $obj->Obituary->LastName;
	$laddress1 = $obj->FuneralHome->FHAddress1;
	$laddress2 = $obj->FuneralHome->FHAddress2;
	$lpostalcode = $obj->FuneralHome->FHZip;
	$lcity = $obj->FuneralHome->FHCity;
	$lprovince = $obj->FuneralHome->FHState;
	$llocation = 'Funeral Home';
	$llocationname = $obj->FuneralHome->FHKnownBy1;
	$lphone = $obj->FuneralHome->FHPhone;
}

?> 

<!--start wrapper-->
	<section class="wrapper">
		
		<section class="content about">
		
			<div class="container" style="margin-bottom:-70px;">
            	
				<div class="row" style="margin-bottom:20px;">
					<div id="stepi" class="col-sm-12 col-md-12 col-lg-3" style="margin-top:-20px;">
						<?php //echo $this->session->userdata('referer'); ?>
						<a href="<?php echo base_url(); ?>">
							<img src="<?php echo base_url(); ?>images/mf-logo-new.png" width="100%" />
						</a>
					</div>
					<div class="text-center col-lg-6 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;">
						<img src="<?php echo base_url('templates/clava/img/step1.jpg'); ?>" width="100%">
					</div>
					<div id="stepi" class="col-lg-3 col-md-12 col-sm-12 col-xs-12" style="margin-top:-30px;text-align:right;">
						<img src="<?php echo base_url(); ?>images/secure_checkout.png" width="75%">
					</div>
				</div>
				
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4>Checkout <i class="fa fa-chevron-right"></i> Delivery Information</h4>
							<div class="gDot"></div>
						</div>
                    </div>
				</div>	
				
				<?php echo form_open(current_url(),array('class'=>'common_form clearfix','id'=>'delivery_form')); ?>
				<?php
				$icount = 0;
				foreach($delivery as $row) {
					$icount++;

					$fhome = array();
				?>
				<?php if($row->funeral_home_id>0) 
					{
						$fhome = get_funeral_home($row->funeral_home_id);
					}


				?>

				<div class="row sub_content" style="margin-top:-30px;">
				
					<div class="col-lg-12">
						<div class="alert alert-dismissable" style="background-color:#EEEEEE;height:30px;padding:4px 5px 4px 5px;">
							<span style="font-size:15px;color:#555;font-weight:600;">Enter Delivery Information for Item <?php echo $icount;?></span>
						</div>
					</div>
				
				
					<div class="col-lg-9" style="padding-left:20px;padding-right:20px;">
						
						<?php 
						if(validation_errors())
						{
							echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
						}
						?>
						
						<div class="row">
						
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								
								<!--<p style="color:#8B1A1A;"><?php echo lang('Fields marked with (*) are mandatory.'); ?></p>-->
								
								<?php if($icount>1) { ?>
									<div class="control-group">
										<div class="controls">
											<label for="aboveaddress<?php echo $row->orderitem_id;?>" class="checkbox">
											<input style="width:20px;" type="checkbox" name="aboveaddress[]" value="1" id="aboveaddress<?php echo $icount; ?>" class="aboveaddress" /><?php echo lang('Use above address');?></label>
										</div>
									</div>                  
								<?php } ?>
								<?php

									$fclass = '';
									$value = '';
									$fedit = '';

									if($_POST)
									{
										$value = $p->location_type_name[$row->orderitem_id];

										if(isset($fhome) && $fhome->name==$p->location_type_name[$row->orderitem_id])
										{
											$fclass = 'fpopulated';
											$reada = ' greadonly="readonly" ';
											$fedit = '<a href="#" class="fedit">Edit</a>';
										}
									} 
									else
									{
										if(isset($fhome) && $fhome->id>0)
										{
											if(empty($row->location_type_name) || $fhome->name == $row->location_type_name)
											{
												$value = $fhome->name;
												$fclass = 'fpopulated';
												$reada = 'readonly="readonly"';
												$fedit = '<a href="#" class="fedit">Edit</a>';
											}
											
										}
										else
										{
											$value = $row->location_type_name;
										}
									}


								?>
                    								
								<div>
									Recipient First Name *
									<input style="height:30px;width:100%;" required type="text" name="firstname[<?php echo $row->orderitem_id;?>]" id="firstname<?php echo $icount;?>" value="<?php if($lfirstname!=''){ echo $lfirstname; }else{ echo $this->session->userdata('disease_firstname') ; } ?>" />
								</div>	
								<div style="margin-top:10px;">	
									Recipient Last Name *
									<input style="height:30px;width:100%;" required type="text" name="lastname[<?php echo $row->orderitem_id;?>]" id="lastname<?php echo $icount;?>" value="<?php if($llastname!=''){ echo $llastname; }else{ echo $this->session->userdata('disease_lastname'); } ?>" />
								</div>
								<!--
		                        <div style="display:none;margin-top:10px;">
									<input style="height:30px;width:100%;" type="text" name="location_type_name[<?php echo $row->orderitem_id;?>]" id="location_type_name<?php echo $icount;?>" value="<?php echo $_POST ? $p->location_type_name[$row->orderitem_id]:$row->location_type_name;?>" />
								</div>
								-->
								<?php

									$fclass = '';
									$value = '';
									$fedit = '';

									if($_POST)
									{
										$value = $p->address1[$row->orderitem_id];

										if(isset($fhome) && $fhome->address==$p->address1[$row->orderitem_id])
										{
											$fclass = 'fpopulated';
											$reada = ' greadonly="readonly" ';
											$fedit = '<a href="#" class="fedit">Edit</a>';
										}
									} 
									else
									{
										if(isset($fhome) && $fhome->id>0)
										{
											if(empty($row->address1) || $fhome->address == $row->address1)
											{
												$value = $fhome->address;
												$fclass = 'fpopulated';
												$reada = 'readonly="readonly"';
												$fedit = '<a href="#" class="fedit">Edit</a>';
											}
											
										}
										else
										{
											$value = $row->address1;
										}
									}


								?>
								<div style="margin-top:10px;">
									Address Line 1 *
									<input style="height:30px;width:100%;" required class="<?php echo $fclass;?>" <?php echo $reada;?> type="text" name="address1[<?php echo $row->orderitem_id;?>]" id="address1<?php echo $icount;?>" value="<?php if($laddress1!=''){ echo $laddress1; }else{ echo $value; } ?>" /><?php echo $fedit;?>
								</div>
								<div style="margin-top:10px;">
									Address Line 2
									<input style="height:30px;width:100%;" type="text" name="address2[<?php echo $row->orderitem_id;?>]" id="address2<?php echo $icount;?>" value="<?php if($laddress2!=''){ echo $laddress2; }else{ echo $_POST ? $p->address2[$row->orderitem_id]:$row->address2; } ?>" />
								</div>
								<?php

									$fclass = '';
									$value = '';
									$fedit = '';

									if($_POST)
									{
										$value = $p->postalcode[$row->orderitem_id];

										if(isset($fhome) && $fhome->postalcode==$p->postalcode[$row->orderitem_id])
										{
											$fclass = 'fpopulated';
											$reada = 'readonly="readonly" ';
											$fedit = '<a href="#" class="fedit">Edit</a>';
										}
									} 
									else
									{
										if(isset($fhome) && $fhome->id>0)
										{
											if(empty($row->postalcode) || $fhome->postalcode == $row->postalcode)
											{
												$value = $fhome->postalcode;
												$fclass = 'fpopulated';
												$reada = 'readonly="readonly"';
												$fedit = '<a href="#" class="fedit">Edit</a>';
											}
											
										}
										else
										{
											$value = $row->postalcode;
										}
									}


								?>

								<div style="margin-top:10px;">
									Postal Code *
									<input style="height:30px;width:100%;" required type="text" <?php echo $reada; ?> name="postalcode[<?php echo $row->orderitem_id;?>]" class="postalcode <?php echo $fclass;?>" id="postalcode<?php echo $icount;?>" value="<?php if($lpostalcode!=''){ echo $lpostalcode; }else{ echo $value; } ?>" /><?php echo $fedit;?>
									<?php if(form_error('postalcode['.$row->orderitem_id.']')) : ?>
										<p style="color: red;">Please enter a valid Canadian postal code. <a href="http://www.canadapost.ca/cpotools/apps/fpc/personal/findByCity?execution=e2s1" target="_blank">Click here</a> if you do not have one. If you would like to ship outside of Canada please visit our <a href="http://ww31.1800flowers.com/international-flower-delivery" target="_blank">sister site</a></p>
									<?php endif; ?>
								</div>

								<div style="margin-top:10px;">
									City *
									<input style="height:30px;width:100%;" required type="text" name="city[<?php echo $row->orderitem_id;?>]" id="city<?php echo $icount;?>" value="<?php if($lcity!=''){ echo $lcity; }else{ echo $_POST ? $p->city[$row->orderitem_id]:$row->city; } ?>" size="30"   <?php if(isset($fhome) && ($fhome->id>0)) { echo ' readonly="readonly" '; } ?> />
								</div>
								<div style="margin-top:10px;">
									Province *
									<?php
									$provinces = get_available_provinces($row->product_id);
									if(count($provinces)){ 
									?>
									<select style="height:30px;width:100%;padding-left:9px;" required name="province[<?php echo $row->orderitem_id;?>]" id="province<?php echo $icount;?>" <?php highlight(form_error("province[{$row->orderitem_id}]")); ?>  <?php if(isset($fhome)) { echo ' disabled="disabled" '; } ?>>
										<option value="" <?php
											if($_POST){
												if($p->province[$row->orderitem_id]=='')
													echo 'selected="selected"';
											}else{
												if($row->province=='' && $row->country_id<3)
													echo 'selected="selected"';
											}
											?>><?php echo lang('Please select');?></option>
											<?php foreach($provinces as $province) { ?>
												<option value="<?php echo $province->province_name;?>" <?php
												if($_POST){
													if($p->province[$row->orderitem_id]==$province->province_name || $lprovince==$province->province_name)
														echo 'selected="selected"';
												}else{
													if($lprovince==$province->province_name || $row->province==$province->province_name && $row->country_id<3)
														echo 'selected="selected"';
												}
												?>><?php echo $province->province_name;?></option>
											<?php } ?>
									</select><?php echo form_error('province'); ?>
									<?php }else{ ?>
										<input type="text" name="province[<?php echo $row->orderitem_id;?>]" id="province<?php echo $icount;?>" value="<?php echo $_POST ? $p->province[$row->orderitem_id]:$row->province;?>" size="30" />
									<?php
									}
									?>
								</div>
								<div style="margin-top:10px;">
									Country *
									<select style="height:30px;width:100%;padding-left:9px;" required name="country_id[<?php echo $row->orderitem_id;?>]" id="country_id<?php echo $icount;?>" <?php if(isset($fhome)) { echo ' disabled="disabled" '; } ?>>
										<option value="1">Canada</option>
									</select>
								</div>
								<div style="margin-top:10px;">
									<input type="checkbox" name="useaddress[<?php echo $row->orderitem_id;?>]" id="useaddress<?php echo $icount;?>" value="1"  <?php   
									if($_POST)
									{
										echo isset($_POST['useaddress']) && $_POST['useaddress']==$row->orderitem_id ? 'checked="checked"':'';
									}
									elseif($this->session->userdata('useaddress'))
									{
										echo $this->session->userdata('useaddress')==$row->orderitem_id ? 'checked="checked"':'';                            
									}
									?> class="useaddress" style="width:20px;"/> Use this address for billing
									
									<br /><br />
									
								</div>			
							</div>	

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
								
								<div>
									Location Type *
									<select style="height:30px;width:100%;padding-left:9px;" required  name="location_type[<?php echo $row->orderitem_id;?>]" id="location_type<?php echo $icount;?>" <?php highlight(form_error("location_type[{$row->orderitem_id}]")); ?> onchange="showstuff(this.value);" > 
										<?php 

										$exloc = '';

										if($_POST){
											$exloc = $_POST['location_type'][$row->orderitem_id];
										}else{
											if(isset($row) && !empty($row->location_type)){
												$exloc = $row->location_type;
											}elseif(isset($fhome) && $fhome->id>0){
												$exloc = 'Funeral Home';
											}
											else
											{
												$exloc = 'Funeral Home';
											}
										}

										?>
										<option value="Funeral Home" <?php if($exloc=='Funeral Home' || (isset($fhome) && $fhome->id>0) || ($llocation=='Funeral Home')) echo 'selected="selected"'; ?>><?php echo lang('Funeral Home');?></option>
										<option value="Residence" <?php if($exloc=='Residence') echo 'selected="selected"'; ?>><?php echo lang('Residence');?></option>
										<option value="Business" <?php if($exloc=='Business') echo 'selected="selected"'; ?>><?php echo lang('Business');?></option>
										<option value="Hospital" <?php if($exloc=='Hospital') echo 'selected="selected"'; ?>><?php echo lang('Hospital');?></option>
										<option value="Apartment" <?php if($exloc=='Apartment') echo 'selected="selected"'; ?>><?php echo lang('Apartment');?></option>
										<option value="School" <?php if($exloc=='School') echo 'selected="selected"'; ?>><?php echo lang('School');?></option>
										<option value="Church" <?php if($exloc=='Church') echo 'selected="selected"'; ?>><?php echo lang('Church');?></option>
									</select>
								</div>
								<div id="inf" <?php

                    							 		if($exloc=='Residence')
									    	{
											echo 'style="display:none;margin-top:10px;" ';
									    	}
									    	else
									    	{
									    		echo 'style="display:block;margin-top:10px;" ';
									    	}
									    	
                    								?>  >
									Location Name *
									<input style="height:30px;width:100%;" type="text" class="<?php echo $fclass;?>" <?php echo $reada; ?> name="location_type_name[<?php echo $row->orderitem_id;?>]" id="location_type_name<?php echo $icount;?>" value="<?php if($llocationname!=''){ echo $llocationname; }else{ echo $value; } ?>" /><?php echo $fedit;?>
								</div>
								<?php

									$fclass = '';
									$value = '';
									$fedit = '';


									if($_POST)
									{
										$value = $p->dayphone[$row->orderitem_id];

										if(isset($fhome) && preg_replace("/[^0-9,.]/", "", $fhome->phone)==$p->dayphone[$row->orderitem_id])
										{
											$fclass = 'fpopulated';
											$reada = 'readonly="readonly" ';
											$fedit = '<a href="#" class="fedit">Edit</a>';
										}
									} 
									else
									{
										if(isset($fhome) && $fhome->id>0)
										{
											if(empty($row->dayphone) || preg_replace("/[^0-9,.]/", "", $fhome->phone) == $row->dayphone)
											{
												$value = preg_replace("/[^0-9,.]/", "", $fhome->phone);
												$fclass = 'fpopulated';
												$reada = 'readonly="readonly"';
												$fedit = '<a href="#" class="fedit">Edit</a>';
											}											
										}
										else
										{
											$value = $row->dayphone;
										}
									}


								?>
								
								<div style="margin-top:10px;">
									Recipient's Phone *
									<input style="height:30px;width:100%;" required type="text" maxlength="10"  class="<?php echo $fclass;?>" <?php echo $reada; ?> name="dayphone[<?php echo $row->orderitem_id;?>]" id="dayphone<?php echo $icount;?>" value="<?php if($lphone!=''){ echo $lphone; }else{ echo $value; } ?>" /><?php echo $fedit;?>
									<input type="hidden" name="evephone[<?php echo $row->orderitem_id;?>]" id="evephone<?php echo $icount;?>" value="<?php echo $_POST ? $p->evephone[$row->orderitem_id]:$row->evephone;?>" />
									<input type="hidden" name="orderitem_id[]" id="orderitem_id<?php echo $icount;?>" value="<?php echo $row->orderitem_id;?>" />
								</div>
								<div style="margin-top:10px;">
									<?php if($row->special_delivery==1) : ?>
									<strong style="display:block; clear: left; text-align:left;">Today</strong>
									<input type="hidden" name="delivery_date[<?php echo $row->orderitem_id;?>]" value="<?php echo $row->delivery_date;?>"  id="delivery_date<?php echo $icount;?>" />
									<?php else : ?>
									<select class="form-control" name="delivery_date[<?php echo $row->orderitem_id;?>]" id="delivery_date<?php echo $icount;?>" style="display:none;">
									<?php $dates = get_dates($row->delivery_method_id,10);
										 $found = FALSE;
										 foreach($dates as $day) { ?>
										<option value="<?php echo $day; ?>" <?php
											  if($_POST)
											  {
												if($p->delivery_date[$row->orderitem_id]== $day)
												{
													echo 'selected="selected"';
													$found = TRUE;
												}
											  }
											  else
											  {
												if($row->delivery_date==$day)
												{
													echo 'selected="selected"';
													$found = TRUE;
												}
											  }
										?>><?php echo date('M d Y D',strtotime($day));?></option>
									<?php   }
										if(!$found)
										{
										  if($_POST)
										  {
											echo '<option value="'.$p->delivery_date[$row->orderitem_id].'" selected="selected">'.date('M d Y D',strtotime($p->delivery_date[$row->orderitem_id])).'</option>'."\n";
										  }
										  else
										  {
											echo '<option value="'.$row->delivery_date.'" selected="selected">'.date('M d Y D',strtotime($row->delivery_date)).'</option>'."\n";
										  }
										}
									?>
									</select>
									<?php endif; ?>
								</div>
								<div style="margin-top:10px;">
									Occasion
									<select style="height:30px;width:100%;padding-left:9px;" name="occasion_id[<?php echo $row->orderitem_id;?>]" id="occasion_id<?php echo $icount;?>">
										<option value=""><?php echo lang('Select an Occasion');?></option>
									<?php
									$occasions = get_occasions();
									foreach($occasions as $occasion) { ?>
									<option value="<?php echo $occasion->occasion_id;?>" <?php
									if($_POST)
									{
										if($p->occasion_id[$row->orderitem_id]===$occasion->occasion_id)
											echo 'selected="selected"';
									}
									else
									{
										if($row->occasion_id===$occasion->occasion_id)
											echo 'selected="selected"';                                
									}
									?>><?php echo lang($occasion->occasion_name);?></option>
									<?php } ?>
									</select>
								</div>
								<div style="margin-top:10px;">
									<input style="width: 20px;" type="checkbox" name="enclose_card[<?php echo $row->orderitem_id;?>]" class="enclose_card" id="enclose_card<?php echo $row->orderitem_id;?>" value="1" <?php
										if(!$_POST)
										{
											if(empty($row->delivery_detail_id) || $row->delivery_detail_id<1)
											{
												echo ' checked="checked" ';
											}
											elseif($row->enclose_card==1)
											{
												echo ' checked="checked" ';
											}
										}
										else
										{
											if((isset($_POST['enclose_card'][$row->orderitem_id]) && $_POST['enclose_card'][$row->orderitem_id]==1))
											{
												
												echo ' checked="checked" ';
											}
										}
									
									?> /> <?php echo lang('Message on Card');?>
									<textarea name="card_message[<?php echo $row->orderitem_id;?>]" id="card_message<?php echo $row->orderitem_id;?>" rows="5" <?php
											if($_POST)
											{
												if(!isset($_POST['enclose_card']))
												{
													echo 'disabled="disabled"';
												}
											}
											else
											{
												if(isset($row->delivery_detail_id) && $row->delivery_detail_id>0)
												{
													if($row->enclose_card!=1)
													{
														echo 'disabled="disabled"';
													}
												}
											}
											
									?>><?php echo isset($_POST) && isset($_POST['card_message'][$row->orderitem_id]) ? $p->card_message[$row->orderitem_id]:(isset($row->card_message) && !$_POST ? $row->card_message:'');?></textarea>
								</div>
								<div style="margin-top:10px;">
									Ribbon Message
									<textarea name="ribbon_message[<?php echo $row->orderitem_id;?>]" id="ribbon_message<?php echo $row->orderitem_id;?>" rows="4" <?php
											if($_POST)
											{
												if(!isset($_POST['enclose_card']))
												{
													echo 'disabled="disabled"';
												}
											}
											else
											{
												if(isset($row->delivery_detail_id) && $row->delivery_detail_id>0)
												{
													if($row->enclose_card!=1)
													{
														echo 'disabled="disabled"';
													}
												}
											}
											
									?>><?php echo isset($_POST) && isset($_POST['ribbon_message'][$row->orderitem_id]) ? $p->ribbon_message[$row->orderitem_id]:(isset($row->ribbon_message) && !$_POST ? $row->ribbon_message:'');?></textarea>
								</div>
								
							</div>
							
						</div>
						
						
					</div>
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 text-center" style="padding-left:10px;padding-right:20px;">
						<div style="font-size:14px;"><?php echo $row->product_name; ?></div>
						<img src="<?php echo img_format('productres/'.$row->product_picture,'thumb');?>" width="100%" />
						<span style="font-size:13px;">
							Delivery Date
							<br />
							<b><?php echo date('D, M d Y',strtotime($row->delivery_date)); ?></b>
						</span>
					</div>	
				
				</div>	
				
				<br />
				
				<?php } ?>
					
				

					
                
                
                <div class="row sub_content" style="margin-top:-50px;">
					<div class="col-lg-9">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12">
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12">
								<button type="submit" name="checkout" id="checkout" value="" class="btn btn-large btn-block btn-default" onClick="return checklocationtype();" >
									<b>Next &nbsp; <i class="fa fa-play"></i> </b> 
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
 	<script  >
	$(document).ready(function() {



        $('.useaddress').click(function(){
        
            if($(this).attr("checked"))
            {
                $('.useaddress').removeAttr("checked");
                $(this).attr("checked","checked");

            }
        });
        
        $(".aboveaddress").click(function(){
        
            if($(this).is(':checked'))
            {
            
                var id = $(this).attr("id").slice(12);
                var pid = id-1;
                
                $("#firstname"+id).val($("#firstname"+pid).val()) ;
                $("#lastname"+id).val($("#lastname"+pid).val()) ;
                $("#address1"+id).val($("#address1"+pid).val()) ;
                $("#address2"+id).val($("#address2"+pid).val()) ;
                $("#postalcode"+id).val($("#postalcode"+pid).val()) ;
                $("#city"+id).val($("#city"+pid).val()) ;
                $("#location_type"+id).val($("#location_type"+pid).val()) ;
                $("#province"+id).val($("#province"+pid).val()) ;
                $("#country_id"+id).val($("#country_id"+pid).val()) ;
                $("#dayphone"+id).val($("#dayphone"+pid).val());
                $("#evephone"+id).val($("#evephone"+pid).val()) ;
            }
        });

});


$(function() {



    $(".fedit").click(function(e){
    	e.preventDefault();
    	$(this).prev().removeClass('fpopulated');
    	$(this).prev().removeAttr("readonly");
    	$(this).prev().removeAttr("disabled");
    	$(this).remove();
    })

    $('#delivery_form').on('submit', function() {
	$('input, select').removeAttr('disabled', false);
    });
    
    $('.postalcode').change(function(){
        
    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
 
    //Set height and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
     
    //transition effect     
    $('#mask').fadeIn(1000);    
    $('#mask').fadeTo("slow",0.8);  
    
        
        var id = $(this).attr("id");
        id = id.slice(10);
        
        var pcode = $(this).val();
        
        var winH = $(window).height();
        var winW = $(window).width();
            
        $("#postalcode-info").css('top',  winH/2-$("#postalcode-info").height()/2);
        $("#postalcode-info").css('left', winW/2-$("#postalcode-info").width()/2);  
        
        $('#postalinfo').html('<div class="loading"></div>');
        
        //transition effect
        $("#postalcode-info").fadeIn(2000);
        
        var token = $("input[name=csrf1800]").val();
        
        $.post('/shop/getlocationinfo',{'postalcode':$(this).val(),'csrf1800':token},function(data){
            
            if(data.result=='ok')
            {
                $("#city"+id).val(data.city);
                $("#province"+id).val(data.province);
                $("#contry_id"+id).val(data.country);
                
                $('#mask').hide();
                $('#postalcode-info').hide();

                
            }
            else
            {
                $('#postalinfo').html(data.message);
            }
            
            
            
        },'json');
        
    });

    $(".postalcode").trigger("change");
    
    $('.enclose_card').click(function(){
        
        var id = $(this).attr("id");
        id = id.slice(12);
    
    if($(this).is(":checked"))
    {
        
        $('#card_message'+id).removeAttr('disabled');
    }
    else
    {
        $('#card_message'+id).val('');
        $('#card_message'+id).attr('disabled','disabled');
    }    
        
    });
    
    reinit();
    
 
        function reinit()
        {
            //if close button is clicked
            $('.closedit').click(function (e) {
                
                //Cancel the link behavior
                e.preventDefault();
                $("#postalcode-info").hide();
                $('#mask').hide();
                
            });          
            
            
        }   

});
	</script>
<script type="text/javascript"> 
			function showstuff(element){ 

				
				
				if (element == "Business") {
					document.getElementById("inf").style.display = ""; 
					}
				else if (element == "Funeral Home") {
					document.getElementById("inf").style.display = ""; 
					}
				else if (element == "Hospital") {
					document.getElementById("inf").style.display = ""; 
					}
				else if (element == "School") {
					document.getElementById("inf").style.display = ""; 
					}
				else if (element == "Church") {
					document.getElementById("inf").style.display = ""; 
					}
				else{
					document.getElementById("inf").style.display = "none"; 
				}
				
				//style.display = "";
				//document.getElementById("look").style.display = element=="look"?"block":"none"; 
			}
			</script>  
			
<script>
			  function checklocationtype()
				{
				for(var i=1; i<2; i++){
					 var lotype = document.getElementById("location_type"+i).value;
					if((lotype == "Business") || (lotype == "Funeral Home")|| (lotype == "Hospital") ||(lotype == "School") || (lotype == "Church")) {
						
						 var lotypename = document.getElementById("location_type_name"+i).value;
							if(lotypename==''){
								alert("Please enter Location Name!");
								document.getElementById("inf").style.display = ""; 
								return false;
							}
						
						}
					
				}
				 
				 
				}
			</script>   

<script>
			  function countChar(val) {
				var len = val.value.length;
				if (len >= 120) {
				  val.value = val.value.substring(0, 120);
				} else {
				  $('#charNum').text(120 - len);
				}
			  };
			  
			  function countCharp(val) {
				var len = val.value.length;
				if (len >= 6) {
				  val.value = val.value.substring(0, 6);
				} else {
				  $('#charNum').text(6 - len);
				}
			  };
			</script> 		

<!-- Activity name for this tag: WhataBloom --> <script type='text/javascript'> var axel = Math.random()+""; var a = axel * 10000000000000; document.write('<img src="" width=1 height=1 border=0/>'); </script> <noscript> <img src="" width=1 height=1 border=0/> </noscript>

			
</body>
</html>
	
<?php // include_once('footer_clava.php'); ?>