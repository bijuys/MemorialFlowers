<?php include_once('top.php'); ?>
      <div class="container">
            <div id="breadcrumb">
                  
            </div>
            <div id="page" style="margin-left:0px;margin-right:0px;">
                  <h1>Please enter your shipping and payment information</h1>
                  <form action="" method="post">
                  <div class="content-box">
                        <div class="box-inner">
                        <div class="row">
                              <?php echo $errors; ?>
                              <div class="col-sm-7">
								  <?php if($this->session->userdata('fun_id')!=''){ ?>
									<?php $fun_home = $this->Product_model->get_fun_home($this->session->userdata('fun_id')); ?>
								  <?php } ?>
							  
                                  <?php $ship_to = 'funeral home'; if(!$_POST) { $ship_to = $this->session->userdata('ship_to'); }else{ $ship_to = $_POST['shipping_to']; } ?>
                                  <h2 style="border-bottom: 1px solid #EEE;">Shipping To</h2>
                                  <h3>
									<label>
										<input type="radio" name="shipping_to" id="shipping_to" value="funeral home" <?php echo $_POST && $_POST['shipping_to']=='funeral home' ? 'checked="checked"':(!$_POST && $ship_to == 'funeral home' ? 'checked="checked"':'');?> onClick="showFune('funeral home');"> Ship to Funeral Home 
									</label>  
                                    &nbsp; &nbsp; &nbsp;<?php //echo $ship_to; ?>
									<label>
										<input type="radio" name="shipping_to" id="shipping_to" value="home or office"  <?php echo $_POST && $_POST['shipping_to']=='home or office' ? 'checked="checked"':(!$_POST && $ship_to == 'home or office' ? 'checked="checked"':'');?> onClick="showFune('home or office');"> Ship to Home or Office 
									</label>
                                  </h3>
								  <?php 
								  /*
								  if($_POST){
									$this->session->set_userdata('ship_to',$_POST['shipping_to']);
								  }
								  $ship_to = $this->session->userdata('ship_to');
								  */
								  //echo $ship_to; ?>
								  <script>
								  function codeAddress() {
									var shi = '<?php echo $ship_to; ?>';
									/*document.getElementById('fh_name').value = '<?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?>';
									document.getElementById('fh_location').value = '<?php echo $fun_home->funeral_home;?>';*/
									if(shi.toString()=='home or office'){
										
										document.getElementById('fun_address_tex').style.display = 'none';
										document.getElementById('fun_ho_name').style.display = 'none';
										document.getElementById('fun_ho_details').style.display = 'block';
										
										<?php if($_POST){ ?>
										
											document.getElementById('fh_name').value = '<?php echo $_POST['fh_name']; ?>';
											document.getElementById('fh_address1').value = '<?php echo $_POST['fh_address1']; ?>';
											document.getElementById('fh_address2').value = '<?php echo $_POST['fh_address2']; ?>';
											document.getElementById('fh_city').value = '<?php echo $_POST['fh_city']; ?>';
											document.getElementById('fh_postalcode').value = '<?php echo $_POST['fh_postalcode']; ?>';
											document.getElementById('fh_province_id').value = '<?php echo $_POST['fh_province_id']; ?>';
											document.getElementById('fh_dayphone').value = '<?php echo $_POST['fh_dayphone']; ?>';
										
										<?php }else{ ?>
										
											document.getElementById('fh_name').value = '<?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?>';
											document.getElementById('fh_address1').value = '';
											document.getElementById('fh_address2').value = '';
											document.getElementById('fh_city').value = '';
											document.getElementById('fh_postalcode').value = '';
											document.getElementById('fh_province_id').value = '';
											document.getElementById('fh_dayphone').value = '';
										
										<?php } ?>
										
									}else{
									
										<?php if($_POST){ ?>
											
											<?php if($this->session->userdata('fun_id')!=''){ ?>
											
												<?php if($_POST['fh_name']=='' || $_POST['fh_location']=='' || $_POST['fh_address1']=='' || $_POST['fh_city']=='' || $_POST['fh_province_id']=='' || $_POST['fh_postalcode']=='' || $_POST['fh_dayphone']==''){ ?>
													document.getElementById('fun_address_tex').style.display = 'none';
													document.getElementById('fun_ho_details').style.display = 'block';
													document.getElementById('fun_ho_name').style.display = 'block';
												<?php }else{ ?>
													document.getElementById('fun_address_tex').innerHTML = '<?php echo $_POST['fh_location']; ?><br /><?php echo $_POST['fh_address1']; ?>, <?php echo $_POST['fh_city']; ?> ON <?php echo $_POST['fh_postalcode']; ?><br /><?php echo $_POST['fh_dayphone']; ?><br /><a href="javascript:;" onClick="showDetails();" style="color:#5BC5C4;font-size:13px;font-weight:bold;">Edit address</a>';
													document.getElementById('fun_address_tex').style.display = 'block';
													document.getElementById('fun_ho_details').style.display = 'none';
													document.getElementById('fun_ho_name').style.display = 'none';
												<?php } ?>
												
											<?php }else{ ?>
												
												document.getElementById('fun_address_tex').style.display = 'none';
												document.getElementById('fun_ho_details').style.display = 'block';
												document.getElementById('fun_ho_name').style.display = 'block';
											
											<?php } ?>
											
											document.getElementById('fh_name').value = '<?php echo $_POST['fh_name']; ?>';
											document.getElementById('fh_location').value = '<?php echo $_POST['fh_location']; ?>';
											document.getElementById('fh_address1').value = '<?php echo $_POST['fh_address1']; ?>';
											document.getElementById('fh_address2').value = '<?php echo $_POST['fh_address2']; ?>';
											document.getElementById('fh_city').value = '<?php echo $_POST['fh_city']; ?>';
											document.getElementById('fh_postalcode').value = '<?php echo $_POST['fh_postalcode']; ?>';
											document.getElementById('fh_province_id').value = '<?php echo $_POST['fh_province_id']; ?>';
											document.getElementById('fh_dayphone').value = '<?php echo $_POST['fh_dayphone']; ?>';
										
										<?php }else{ ?>
											
											document.getElementById('fun_address_tex').style.display = 'block';
											
											<?php if($this->session->userdata('fun_id')!=''){ ?>
												document.getElementById('fun_ho_details').style.display = 'none';
												document.getElementById('fun_ho_name').style.display = 'none';
											<?php }else{ ?>
												document.getElementById('fun_ho_details').style.display = 'block';
												document.getElementById('fun_ho_name').style.display = 'block';
											<?php } ?>
											
											document.getElementById('fh_name').value = '<?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?>';
											document.getElementById('fh_location').value = '<?php echo $fun_home->funeral_home; ?>';
											document.getElementById('fh_address1').value = '<?php echo $fun_home->address1; ?>';
											document.getElementById('fh_address2').value = '<?php echo $fun_home->address2; ?>';
											document.getElementById('fh_city').value = '<?php echo $fun_home->city; ?>';
											document.getElementById('fh_postalcode').value = '<?php echo $fun_home->postalcode; ?>';
											document.getElementById('fh_province_id').value = '9';
											document.getElementById('fh_dayphone').value = '<?php echo $fun_home->phone; ?>';
										
										<?php } ?>
										
									}
								  }
								  window.onload = codeAddress;
								  
								  
								  
								  
								  
								  function showFune(val) {
									
									var shi = val;
									
									if(shi.toString()=='home or office'){
										
										document.getElementById('fh_address1').value = '';
										document.getElementById('fh_address2').value = '';
										document.getElementById('fh_city').value = '';
										document.getElementById('fh_postalcode').value = '';
										document.getElementById('fh_province_id').value = '';
										document.getElementById('fh_dayphone').value = '';
										
										document.getElementById('fun_address_tex').style.display = 'none';
										document.getElementById('fun_ho_name').style.display = 'none';
										document.getElementById('fun_ho_details').style.display = 'block';
										
									}else{
										
										/*
										<?php if($_POST){ ?>
											
											<?php if($this->session->userdata('fun_id')!=''){ ?>
											
												<?php if($_POST['fh_name']=='' || $_POST['fh_location']=='' || $_POST['fh_address1']=='' || $_POST['fh_city']=='' || $_POST['fh_province_id']=='' || $_POST['fh_postalcode']=='' || $_POST['fh_dayphone']==''){ ?>
													document.getElementById('fun_address_tex').style.display = 'none';
													document.getElementById('fun_ho_details').style.display = 'block';
													document.getElementById('fun_ho_name').style.display = 'block';
												<?php }else{ ?>
													document.getElementById('fun_address_tex').innerHTML = '<?php echo $_POST['fh_location']; ?><br /><?php echo $_POST['fh_address1']; ?>, <?php echo $_POST['fh_city']; ?> ON <?php echo $_POST['fh_postalcode']; ?><br /><?php echo $_POST['fh_dayphone']; ?><br /><a href="javascript:;" onClick="showDetails();" style="color:#5BC5C4;font-size:13px;font-weight:bold;">Edit address</a>';
													document.getElementById('fun_address_tex').style.display = 'block';
													document.getElementById('fun_ho_details').style.display = 'none';
													document.getElementById('fun_ho_name').style.display = 'none';
												<?php } ?>
												
											<?php }else{ ?>
												
												document.getElementById('fun_address_tex').style.display = 'none';
												document.getElementById('fun_ho_details').style.display = 'block';
												document.getElementById('fun_ho_name').style.display = 'block';
											
											<?php } ?>
											
											document.getElementById('fh_name').value = '<?php echo $_POST['fh_name']; ?>';
											document.getElementById('fh_location').value = '<?php echo $_POST['fh_location']; ?>';
											document.getElementById('fh_address1').value = '<?php echo $_POST['fh_address1']; ?>';
											document.getElementById('fh_address2').value = '<?php echo $_POST['fh_address2']; ?>';
											document.getElementById('fh_city').value = '<?php echo $_POST['fh_city']; ?>';
											document.getElementById('fh_postalcode').value = '<?php echo $_POST['fh_postalcode']; ?>';
											document.getElementById('fh_province_id').value = '<?php echo $_POST['fh_province_id']; ?>';
											document.getElementById('fh_dayphone').value = '<?php echo $_POST['fh_dayphone']; ?>';
										
										<?php }else{ ?>
											
											document.getElementById('fun_address_tex').style.display = 'block';
											
											<?php if($this->session->userdata('fun_id')!=''){ ?>
												document.getElementById('fun_ho_details').style.display = 'none';
												document.getElementById('fun_ho_name').style.display = 'none';
											<?php }else{ ?>
												document.getElementById('fun_ho_details').style.display = 'block';
												document.getElementById('fun_ho_name').style.display = 'block';
											<?php } ?>
											
											document.getElementById('fh_name').value = '<?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?>';
											document.getElementById('fh_location').value = '<?php echo $fun_home->funeral_home; ?>';
											document.getElementById('fh_address1').value = '<?php echo $fun_home->address1; ?>';
											document.getElementById('fh_address2').value = '<?php echo $fun_home->address2; ?>';
											document.getElementById('fh_city').value = '<?php echo $fun_home->city; ?>';
											document.getElementById('fh_postalcode').value = '<?php echo $fun_home->postalcode; ?>';
											document.getElementById('fh_province_id').value = '9';
											document.getElementById('fh_dayphone').value = '<?php echo $fun_home->phone; ?>';
										
										<?php } ?>
										*/
										
										document.getElementById('fh_name').value = '<?php echo ucwords(strtolower(str_replace("-"," ",$this->session->userdata('memory_of')))); ?>';
										document.getElementById('fh_location').value = '<?php echo $fun_home->funeral_home; ?>';
										document.getElementById('fh_address1').value = '<?php echo $fun_home->address1; ?>';
										document.getElementById('fh_address2').value = '<?php echo $fun_home->address2; ?>';
										document.getElementById('fh_city').value = '<?php echo $fun_home->city; ?>';
										document.getElementById('fh_postalcode').value = '<?php echo $fun_home->postalcode; ?>';
										document.getElementById('fh_province_id').value = '9';
										document.getElementById('fh_dayphone').value = '<?php echo $fun_home->phone; ?>';
										
										document.getElementById('fun_address_tex').innerHTML = '<?php echo $fun_home->funeral_home; ?><br /><?php echo $fun_home->address1; ?>, <?php echo $fun_home->city; ?> ON <?php echo $fun_home->postalcode; ?><br /><?php echo $fun_home->phone; ?><br /><a href="javascript:;" onClick="showDetails();" style="color:#5BC5C4;font-size:13px;font-weight:bold;">Edit address</a>';
											
										<?php if($this->session->userdata('fun_id')!=''){ ?>
											document.getElementById('fun_address_tex').style.display = 'block';
											document.getElementById('fun_ho_details').style.display = 'none';
											document.getElementById('fun_ho_name').style.display = 'none';
										<?php }else{ ?>
											document.getElementById('fun_address_tex').style.display = 'none';
											document.getElementById('fun_ho_details').style.display = 'block';
											document.getElementById('fun_ho_name').style.display = 'block';
										<?php } ?>
											
											
										
									}
								  }
								  function showDetails(){
										document.getElementById('fun_address_tex').style.display = 'none';
										document.getElementById('fun_ho_name').style.display = 'block';
										document.getElementById('fun_ho_details').style.display = 'block';
								  }
								  </script>
								  
								  <fieldset id="shipping-funeral-home" style="width:100%;">
									
									<?php if($this->session->userdata('fun_id')!=''){ ?>
										<input type="hidden" value="<?php echo $fun_home->sci_id; ?>" id="fh_id" name="fh_id" />
									<?php }else{ ?>	
										<input type="hidden" value="0" id="fh_id" name="fh_id" />
									<?php } ?>	
									
									<div style="width:80%;">
										<!-- DISEASED NAME -->
										<div class="form-group <?php echo highlight_error(form_error('fh_name'));?>">
											<input type="text" class="form-control rec_name" value="<?php echo isset($vars) ? $vars->fh_name:''; ?>" id="fh_name" name="fh_name" placeholder="Who are the flowers for?"/>
											<?php echo form_error('fh_name','<div class="err" style="font-size:11px;">','</div>');?>
										</div>
										<!-- TEXT ADDRESS -->
										<div id="fun_address_tex" style="color:#777777;font-size:15px;">
											<?php if(!$_POST){ ?>
												<?php if($this->session->userdata('fun_id')!=''){ ?>
													<?php echo $fun_home->funeral_home;?><br />
													<?php echo $fun_home->address1;?>, <?php echo $fun_home->city;?> <?php echo $fun_home->province; ?> <?php echo $fun_home->postalcode;?><br />
													<?php echo $fun_home->phone;?><br />
													<a href="javascript:;" onClick="showDetails();" style="color:#5BC5C4;font-size:13px;font-weight:bold;">Edit address</a>
												<?php } ?>
											<?php } ?>
										</div>
										<!-- LOCATION NAME -->
										<div id="fun_ho_name">	
											<div class="form-group <?php echo highlight_error(form_error('fh_location'));?>">
												<input type="text" class="form-control" value="<?php echo isset($vars) ? $vars->fh_location:'';?>" id="fh_location" name="fh_location" style="width:100%;" placeholder="Funeral Home?"/>
												<?php echo form_error('fh_location','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
										</div>		
										<!-- DELIVERY DETAILS -->
										<div id="fun_ho_details">	
											<div class="form-group <?php echo highlight_error(form_error('fh_address1'));?>">
												<input type="text"  class="form-control"  value="<?php echo isset($vars) ? $vars->fh_address1:'';?>" id="fh_address1" name="fh_address1" placeholder="Address 1"/>
												<?php echo form_error('fh_address1','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
											<div class="form-group <?php echo highlight_error(form_error('fh_address2'));?>">
												<input type="text"  class="form-control"  value="<?php echo isset($vars) ? $vars->fh_address2:'';?>" id="fh_address2" name="fh_address2" placeholder="Address 2"/>
												<?php echo form_error('fh_address2','<div class="err">','</div>');?>
											</div>
											<div class="form-group <?php echo highlight_error(form_error('fh_postalcode'));?>">
												<input type="text" class="form-control" id="fh_postalcode" value="<?php echo isset($vars) ? $vars->fh_postalcode:'';?>" id="fh_postalcode" name="fh_postalcode" placeholder="Postal code"/>
												<?php echo form_error('fh_postalcode','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
											<div class="form-group <?php echo highlight_error(form_error('fh_city'));?>">
												<input type="text"  class="form-control"  id="fh_city" value="<?php echo isset($vars) ? $vars->fh_city:'';?>" id="fh_city" name="fh_city" placeholder="City"/>
												<?php echo form_error('fh_city','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
											<div class="form-group <?php echo highlight_error(form_error('fh_province_id'));?>">
												<select id="fh_province_id"  name="fh_province_id" class="form-control">
													<option value="">Select Province</option>
													<?php foreach($provinces as $pro) : ?>
														<option value="<?php echo $pro->province_id;?>" <?php echo isset($vars) && isset($vars->fh_province_id) && $vars->fh_province_id==$pro->province_id ? ' selected="selected" ':'';?> ><?php echo $pro->province_name;?></option>
													<?php endforeach; ?>
												</select>
												<?php echo form_error('fh_province_id','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
											<div class="form-group <?php echo highlight_error(form_error('fh_dayphone'));?>">
												<input type="text"  class="form-control"  value="<?php echo isset($vars) ? $vars->fh_dayphone:'';?>" id="fh_dayphone" name="fh_dayphone" placeholder="Phone"/>
												<?php echo form_error('fh_dayphone','<div class="err" style="font-size:11px;">','</div>');?>
											</div>
										</div>
										
										<div id="responsive" class="form-group">
											  <input type="checkbox" name="use_address"  id="use_fh" onClick="useBilling();" style="margin-top:15px;" <?php echo isset($vars->use_address) ? ' checked="checked" ':'';?> /> Use shipping address for billing address
										</div>
											
										<div id="mobile-header" class="form-group">
											<input type="checkbox" name="use_address"  id="use_fh" onClick="useBilling();" <?php echo isset($vars->use_address) ? ' checked="checked" ':'';?> /> Use shipping address for billing address
											<br /><br />
										</div>
										
									</div>
									
								  </fieldset>			
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  
								  <script>
								  function useBilling(){
									document.getElementById("nameoncard").value = document.getElementById("fh_name").value;
									document.getElementById("address1").value = document.getElementById("fh_address1").value;
									document.getElementById("address2").value = document.getElementById("fh_address2").value;
									document.getElementById("postalcode").value = document.getElementById("fh_postalcode").value;
									document.getElementById("city").value = document.getElementById("fh_city").value;
									document.getElementById("province_id").value = document.getElementById("fh_province_id").value;
									document.getElementById("dayphone").value = document.getElementById("fh_dayphone").value;
									//document.getElementById("province").value = document.getElementById("fh_province").value;
									/*var e = document.getElementById("fh_province");
									var strUser = e.options[e.selectedIndex].text;*/
									
								  }
								  function useBilling2(){
									document.getElementById("nameoncard").value = document.getElementById("ho_name").value;
									document.getElementById("address1").value = document.getElementById("ho_address1").value;
									document.getElementById("address2").value = document.getElementById("ho_address2").value;
									document.getElementById("postalcode").value = document.getElementById("ho_postalcode").value;
									document.getElementById("city").value = document.getElementById("ho_city").value;
									document.getElementById("province_id").value = document.getElementById("ho_province_id").value;
									//document.getElementById("province").value = document.getElementById("fh_province").value;
									/*var e = document.getElementById("fh_province");
									var strUser = e.options[e.selectedIndex].text;*/
									
								  }
								  </script>
								  
								 
                                        
                              </div>
							  
							<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
							<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
							<!-- Include all compiled plugins (below), or include individual files as needed -->
							<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/js/bootstrap.min.js"></script>
							<script>
								$(document).ready(function(){
									var image = '<img src="<?php echo base_url(); ?>/images/cvv_file.png" style="width:250px;"><br />';
									var tit = '<table width="100%"><tr><td width="50%">CVV Sample</td><td width="50%" align="right"><a href="javascript:;" onClick="closePop();"><i class="fa fa-times"></i></a></td></tr></table>';
									$('#popover').popover({placement: 'bottom', title: tit, content: image, html: true});
								});
								function closePop(){
									var myLink = document.getElementById('popover');
									myLink.click();
								}
							</script>	
							
							<div id="responsive">
							<style>
								.popover{
									max-width:380px;
								}
							</style>
							</div>
							
							<div id="mobile-header">
							<style>
								.popover{
									max-width:280px;
								}
							</style>
							</div>
							  
                              <div class="col-sm-5">
                                  <h2 style="border-bottom: 1px solid #EEE;">Billing Information</h2>
                                  <div class="form-group"><img src="<?php echo template_url('img/cards.gif');?>" ></div>
                                  <div class="form-group <?php echo highlight_error(form_error('nameoncard'));?>">
                                      <input type="text" class="form-control" value="<?php echo isset($vars) ? $vars->nameoncard:'';?>" id="nameoncard" name="nameoncard" placeholder="Name on card" />
                                       <?php echo form_error('nameoncard','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
                                  <div class="form-group <?php echo highlight_error(form_error('card_number'));?>">
                                      <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->card_number:'';?>" maxlength="16" id="card_number" name="card_number" placeholder="Credit card number" />
                                       <?php echo form_error('card_number','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
								  <!--
                                  <div id="responsive" class="form-group row <?php echo highlight_error(array(form_error('exp_month'),form_error('exp_year')));?>">
                                      <div class="col-sm-6">
                                          <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->exp_month:'';?>" maxlength="2" id="exp_month" name="exp_month" placeholder="MM" style="width:50px; margin-right:5px;float:left;" />
                                          <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->exp_year:'';?>" maxlength="4" id="exp_year" name="exp_year" placeholder="YYYY" style="width:80px; margin-right:5px;" />
                                          <?php echo form_error('exp_month','<span class="err" style="font-size:11px;">','</span>');?>
                                          <?php echo form_error('exp_year','<span class="err" style="font-size:11px;">','</span>');?>
                                      </div>
                                      <div class="col-sm-6 <?php echo highlight_error(form_error('cvv'));?>">
                                            <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->cvv:'';?>" maxlength="3" id="cvv" name="cvv" placeholder="CVV" style="margin-right:25px;width:60%" />
                                            <a id="popover" class="btn" rel="popover" data-content="" title="" style="margin-top:-55px;margin-left:90px;"><i class="glyphicon glyphicon-question-sign"></i></a>
											<?php echo form_error('cvv','<div class="err" style="font-size:11px;">','</div>');?>
                                      </div>
								  </div>
								  -->
								  <div class="form-group row <?php echo highlight_error(array(form_error('exp_month'),form_error('exp_year')));?>" style="padding-left:15px;">
                                      <table width="95%" border="0">
										<tr>
											<td width="25%" valign="top">
												<input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->exp_month:'';?>" maxlength="2" id="exp_month" name="exp_month" placeholder="MM" style="width:90%;margin-right:5px;" />
												<?php echo form_error('exp_month','<span class="err" style="font-size:11px;">','</span>');?>
											</td>
											<td width="40%" valign="top">
												<input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->exp_year:'';?>" maxlength="4" id="exp_year" name="exp_year" placeholder="YYYY" style="width:90%;margin-right:5px;" />
												<?php echo form_error('exp_year','<span class="err" style="font-size:11px;">','</span>');?>
											</td>
											<td width="25%" valign="top">
												<input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->cvv:'';?>" maxlength="4" id="cvv" name="cvv" placeholder="CVV" style="width:90%;margin-right:25px;" />
												<?php echo form_error('cvv','<div class="err" style="font-size:11px;">','</div>');?>
											</td>
											<td width="10%" valign="top">
												<a id="popover" class="btn" rel="popover" data-content="" title="" style=""><i class="glyphicon glyphicon-question-sign"></i></a>
											</td>
										</tr>
									  </table>
								  </div>
                                  <h3>Billing Address</h3>
                                  <div class="form-group <?php echo highlight_error(form_error('address1'));?>" >
                                        <input type="text" class="form-control" id="address1" name="address1" value="<?php echo isset($vars) ? $vars->address1:'';?>"  placeholder="Address 1" />
                                        <?php echo form_error('address1','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
                                  <div class="form-group" <?php echo highlight_error(form_error('address2'));?>>
                                        <input type="text" class="form-control" id="address2" name="address2"  value="<?php echo isset($vars) ? $vars->address2:'';?>" placeholder="Address 2 (Optional)" />
                                  </div>
                                  <div class="form-group <?php echo highlight_error(form_error('postalcode'));?>">
                                        <input type="text" class="form-control" id="postalcode" name="postalcode" value="<?php echo isset($vars) ? $vars->postalcode:'';?>"  placeholder="Postal Code" />
                                        <?php echo form_error('postalcode','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
                                  <div class="form-group <?php echo highlight_error(form_error('city'));?>">
                                        <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->city:'';?>" id="city" name="city" placeholder="City" />
                                        <?php echo form_error('city','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
                                  
                                  <div class="form-group <?php echo highlight_error(form_error('province_id'));?>">
										
										<select id="province_id" name="province_id" class="form-control">
											<option value="">Select Province</option>
											<?php foreach($provinces as $pro) : ?>
												<option value="<?php echo $pro->province_id;?>" <?php echo isset($vars) && isset($vars->province_id) && $vars->province_id==$pro->province_id ? ' selected="selected" ':'';?>><?php echo $pro->province_name;?></option>
											<?php endforeach; ?>
											<option value="" disabled></option>
											<option value="100" style="font-weight:bold;">International Customer</option>
										</select>
										<?php echo form_error('province_id','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
								  <div class="form-group <?php echo highlight_error(form_error('dayphone'));?>">
                                        <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->dayphone:'';?>" id="dayphone" name="dayphone" placeholder="Day phone" />
                                        <?php echo form_error('dayphone','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
                                  <div class="form-group <?php echo highlight_error(form_error('email'));?>">
                                        <input type="text" class="form-control"  value="<?php echo isset($vars) ? $vars->email:'';?>" id="email" name="email" placeholder="Email address" />
                                        <?php echo form_error('email','<div class="err" style="font-size:11px;">','</div>');?>
                                  </div>
							  </div>
                        </div><!-- Row //-->
                        <div class="clreafix"></div>
						<?php //if(validation_errors()) { echo '<div class="err">Your form submission contains some errors! Please check and submit again..</div>'; } ?>
                        <div id="order-summary">
                        <h2>Order Summary</h2>
						
						<div id="responsive">
                        <table border="0">
                              <tr height="30">
                                    <th width="15%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="20%" style="text-align:center;">Quantity</th>
                                    <th width="15%" style="text-align:right;">Price</th>
                                    
                                </tr>
                                <?php 
                                          $total_price = 0;
										  $total_shipping = 0;
										  $total_tax = 0;
                                          foreach($cart as $row) :
												if($row->ribbon_text!=''){
													$item_price = $row->product_price+12.99;
												}else{
													$item_price = $row->product_price;
												}
                                                $total_price = $total_price+$item_price;
												$total_shipping = $total_shipping+17.99;
												$total_tax = (($total_price+$total_shipping)*0.13);
                                  ?>
                                <tr>
                                      <td align="center">
										<div class="cart-item-picture">
											 <?php if($row->option_picture==''){ ?>
												<img src="/productres/<?php echo $row->product_picture;?>">
											  <?php }else{ ?>
												<img src="/productres/<?php echo $row->option_picture;?>">
											  <?php } ?>
										</div>
                                      </td>
                                      <td valign="top">
											<?php if($row->delivery_date!='0000-00-00'){ ?>
											<p style="line-height:140%;">
												<span style="color:#555;font-weight:bold;"><?php echo $row->product_name; ?></span>
												<?php if($row->ribbon_text!=''){ ?>
													<span style="color:#849998;font-weight:bold;"> + Ribbon ($12.99)</span>
												<?php } ?>
											</p>
											<p style="line-height:155%;font-size:12px;">
												<b>Delivery Date: </b>
												<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
												<br />
												<b>Size: </b><?php echo $row->price_name; ?>
												<br />
												<!--
												<?php if($row->card_message!=''){ ?>
												 <b>Card Message: </b>
												  <?php echo $row->card_message; ?>
												  <br />	
												<?php } ?>
												-->								
												<?php if($row->ribbon_text!=''){ ?>
												  <b>Ribbon:</b>
												  <?php echo $row->ribbon_text; ?>
												<?php } ?>
											  </p>
											<?php } ?>
												
												
												
												
                                      </td>
                                      
                                      <td valign="top" rowspan="2" align="center" style="padding-top:2px;vertical-align:top;">
										1
										
                                      </td>
                                      <td valign="top" rowspan="2" align="right" style="vertical-align:top;">
                                            <?php echo getRate($item_price)?>
                                            <!--
											<?php if($row->ribbon_text!=''){ ?>
                                            <br /><br /><br /><br /><?php echo getRate('12.99')?>
                                            <?php } ?>
											-->
                                          </td>
                                </tr>
								<tr>
                                      <td colspan="2" align="center" style="padding-top:10px;">
										<textarea rows="1" id="card_message<?php echo $row->orderitem_id;?>" name="card_message<?php echo $row->orderitem_id;?>" maxlength="150" placeholder="Enter card message..." style="width:100%;" class="form-control"><?php if($row->card_message!='0'){ echo $row->card_message; } ?></textarea> 
										<br /><br />
									  </td>
								</tr>
                              <?php endforeach; ?>
                        </table>
						</div>
						
			<div id="mobile-header">
				
				<div id="shopping-cart">
                        <table width="100%" border="0">
                              <tr>
                                    <th width="25%" style="text-align:center;">Image</th>
                                    <th width="50%">Description</th>
                                    <th width="25%" style="text-align:right;">Price</th>
                                </tr>
								<?php
                                $total_price = 0;
										  $total_shipping = 0;
										  $total_tax = 0;
                                          foreach($cart as $row) {
												if($row->ribbon_text!=''){
													$item_price = $row->product_price+12.99;
												}else{
													$item_price = $row->product_price;
												}
                                                $total_price = $total_price+$item_price;
												$total_shipping = $total_shipping+17.99;
												$total_tax = (($total_price+$total_shipping)*0.13);
												
									?>			
                                <tr>
                                      <td align="center" style="padding:0px;">
									  <div class="cart-item-picture" style="width:100%;">
									  <?php if($row->option_picture==''){ ?>
												<img src="/productres/<?php echo $row->product_picture;?>" style="width:100%;">
											  <?php }else{ ?>
												<img src="/productres/<?php echo $row->option_picture;?>" style="width:100%;">
											  <?php } ?>
									  
									  </div>
									      <p class="text-center"><a href="/shop/rem/<?php echo $row->orderitem_id;?>" onclick="javascript:return confirm('<?php echo lang('Are you sure you want to remove this item from your cart'); ?>?'); return false;" style="font-size:12px;">Remove</a></p>
                                      </td>
                                      
									  <td valign="top" style="vertical-align:top;padding:10px;">
										<?php if($row->delivery_date!='0000-00-00'){ ?>
											<p style="line-height:140%;">
												<span style="color:#555;font-weight:bold;"><?php echo $row->product_name; ?></span>
												<?php if($row->ribbon_text!=''){ ?>
													<span style="color:#849998;font-weight:bold;"> + Ribbon ($12.99)</span>
												<?php } ?>
											</p>
											<p style="line-height:155%;font-size:12px;">
												<b>Delivery Date: </b><br />
												<?php echo date("M jS, Y", strtotime($row->delivery_date)); ?>
												<br />
												<b>Size: </b><br /><?php echo $row->price_name; ?><br />
												<!--
												<?php if($row->card_message!=''){ ?>
												 <b>Card Message: </b>
												  <?php echo $row->card_message; ?>
												  <br />	
												<?php } ?>
												-->								
												<?php if($row->ribbon_text!=''){ ?>
												  <b>Ribbon:</b><br />
												  <?php echo $row->ribbon_text; ?>
												<?php } ?>
											  </p>
											<?php } ?>
									  </td>
                                      <td valign="top" align="right" style="font-size:12px;padding:0px;text-align:right;">
										<br/><?php echo getRate($item_price)?>
									
									</td>
                                     
                                </tr>
                              <?php } ?>
                        </table>
                        <div class="cart-totals text-right" style="display:none;">
                              Sub-total: &nbsp;  &nbsp;  &nbsp;  &nbsp;  
							  <strong>
									<?php echo getRate(isset($coupon) ? $total_price-$coupon->discount : $total_price);?>
								
								
							</strong> &nbsp; 
                             
                        </div>

                        
                  </div>
				
			</div>
						
						
						<br />
                        <div class="text-right">
							<table width="100%" border="0">
								<tr>
									<td width="10%">
									
									</td>
									<td width="90%">
                                                                 <?php
										             $affid=$this->session->userdata('referer');
                                                                              $bothsum=0;
                                                                              
                                                                              if($totals['coupon']>0) {
                                                                                    $bothsum=$totals['coupon']+$totals['discount'];
                                                                              }
                                                                              if($affid!='') {
                                                                                    $bothsum=0; 
                                                                              }

                                                                              $dist = $totals['coupon']+$totals['discount'];
                                                                  ?>              
										<table width="100%" border="0">
											<tr>
												<td width="90%" align="right">
													<p>Sub-total:</p>
                                                                                    <?php if($dist>0) { ?>
                                                                                                <p>Discount</p>
                                                                                    <?php }  ?>
													<?php if($totals['service']==0 || $totals['shipping']>0) { ?>
                                                                                                <p>Shipping:</p>
                                                                                      <?php } ?>
                                                                                      <?php if($totals['service']>0) : ?>
                                                                                                <p><?php echo lang('Shipping');?></p>
                                                                                      <?php endif; ?>
                                                                                      <?php if($totals['surcharge']>0) : ?>
                                                                                                <p><?php echo lang('Same day surcharge');?></p>
                                                                                      <?php endif; ?>
													<p>Taxes:</p>
													<p>Grand Total:</p>
												</td>
												<td width="10%" align="right" style="padding-right:0px;">
													<p><strong><?php echo getRate($total_price);?></strong></p>
                                                                                      <?php if($dist>0) { ?>
                                                                                                <p><?php echo getRate($total_price); ?></p>
                                                                                    <?php }  ?>
                                                                                          <p>
                                                                                                  <?php echo getRate($total_shipping); ?>
                                                                                            </p>
                                                                                       <?php if($totals['service']>0) : ?>
                                                                                                  <p>
                                                                                                        <?php echo getRate($totals['service']);?>
                                                                                                  </p>
                                                                                        <?php endif; ?>
                                                                                        <?php if($totals['surcharge']>0) : ?>
                                                                                              <p>
                                                                                                    <?php echo getRate($totals['surcharge']);?>
                                                                                              </p>
                                                                                        <?php endif; ?>
                                                                                              <p><?php echo getRate($total_tax);?></p>
                                                                                              <p><strong><?php echo getRate($total_price+$total_shipping+$total_tax);?></strong></p>
												</td>
											</tr>
										</table>
										
									</td>
								</tr>
							</table>
                        </div>
                        </div>
                        </div>                        
                  </div>
				  
				  <div id="responsive" class="text-right" style="margin-bottom: 50px; margin-right: 25px;"><br/>
                             Tracking Information will be provided in an email confirmation<br/>
                              <p style="margin-top:5px;">
								<!--<button class="btn btn-primary"  onclick="javascript: window.location='/';" >Continue Shopping</button>-->
								<button type="submit" class="btn btn-primary">Submit Order</button></p>
                        </div>
						
						<div id="mobile-header" class="text-center" style="margin-bottom: 50px;"><br/>
                              <p style="margin-top:5px;">
								<!--<button class="btn btn-primary"  onclick="javascript: window.location='/';" >Continue Shopping</button>-->
								<button class="btn btn-primary" type="submit" style="width:100%;height:50px;font-size:25px;">Submit Order</button></p>
                        </div>
				  <!--
                  <div class="form-action">
                        <p class="text-right" style="margin-top: 15px;">Tracking Information will be provided in an email confirmation</p>
                        <p class="text-right"><button type="submit" class="btn btn-primary">Submit Order</button></p>
                  </div>
				  -->
				  
					<input type="hidden" class="form-control"  value="<?php echo $total_price; ?>" id="final_pricing"  name="final_pricing" />
					<input type="hidden" class="form-control"  value="<?php echo $total_shipping; ?>" id="final_service"  name="final_service" />
					<input type="hidden" class="form-control"  value="<?php echo $total_tax; ?>" id="final_tax"  name="final_tax" />
                                              
					
                  </form>

            </div><!-- Page ends here //-->
      </div><!-- Container //-->   

      <div class="modal fade bs-example-modal-md" id="postalcodemodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
                <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h3 id="postalcodemodalLabel">Wrong Postalcode</h3>
                  </div>
                  <div class="modal-body">
                      <div id="wrong-postalcode" style="width: 500px; height: 300px;">Check the postalcode</div>
                  </div>
                  <div class="modal-footer">
                      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                      <button class="btn btn-primary">Try Again</button>
                  </div>
          </div>
        </div>
      </div>

<div class="copyright text-center" >
	
	<div class="row">
		<div class="col-lg-4">
		
		</div>
		<div class="col-lg-4">
			<p>Copyright 2015 MemorialFlowers.ca. All rights are reserved.</p>
		</div>
		<div class="col-lg-4">
		
		</div>
	</div>	
	
	<!--<small>Copyright 2015 Dignity. All rights are reserved.</small>-->
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
<script src="/templates/dignity/js/vendor/bootstrap.min.js"></script>
<script src="/templates/dignity/js/plugins.js"></script>
<script src="/templates/dignity/js/main.js"></script>
<script>

      $(function(){

            $(".rec_name").keyup(function(){
                $(".rec_name").val($(this).val());
            })
			
			/*
            $("#fh_postalcode").change(function(){
                  token ='asdfw@kasdjf';
                  $.post('/shop/getlocationinfo',{'postalcode':$(this).val(),'csrf1800':token},function(data){
                  if(data.result=='ok')
                  {
                      $("#fh_city").val(data.city);
                      $("#fh_province_id").val(data.province);
                      $('#mask').hide();
                      $('#postalcode-info').hide(); 
                  }
                  else
                  {
                      $("#wrong-postalcode").html(data.message);
                      $('#postalcodemodal').modal('show');
                  }
              },'json');

            })

            $("#ho_postalcode").change(function(){
                  token ='asdfw@kasdjf';
                  $.post('/shop/getlocationinfo',{'postalcode':$(this).val(),'csrf1800':token},function(data){
                  if(data.result=='ok')
                  {
                      $("#ho_city").val(data.city);
                      $("#ho_province_id").val(data.province);
                      $('#mask').hide();
                      $('#postalcode-info').hide(); 
                  }
                  else
                  {
                      $("#wrong-postalcode").html(data.message);
                      $('#postalcodemodal').modal('show');
                  }
              },'json');

             })

              $("#postalcode").change(function(){
                  token ='asdfw@kasdjf';
                  $.post('/shop/getlocationinfo',{'postalcode':$(this).val(),'csrf1800':token},function(data){
                  if(data.result=='ok')
                  {
                      $("#city").val(data.city);
                      $("#province_id").val(data.province);
                      $('#mask').hide();
                      $('#postalcode-info').hide(); 
                  }
                  else
                  {
                      $("#wrong-postalcode").html(data.message);
                      $('#postalcodemodal').modal('show');
                  }
              },'json');

             })
			*/
            
			
			/*
            $(".shipping_to").click(function(){
                  var selected = $(this).val()

                  if(selected=='funeral home')
                  {
                      $("#shipping-home-office").css("display","none")
                      $("#shipping-funeral-home").css("display","block")
                  }
                  else
                  {
                      $("#shipping-home-office").css("display","block")
                      $("#shipping-funeral-home").css("display","none")
                  }
            })

            $(".shipping_to:checked").trigger("click");
			*/
			
			
			

      })

</script>

