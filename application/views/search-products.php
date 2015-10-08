<?php include_once('top.php'); ?>
      <div class="container">
		
		<?php 
		$fin_que = '';
		if($e_color==''){
			$fin_que.='/all';
		}else{
			$fin_que.='/'.$e_color;
		}
		if($e_min==''){
			$fin_que.='/0';
		}else{
			$fin_que.='/'.$e_min;
		}
		if($e_max==''){
			$fin_que.='/1000';
		}else{
			$fin_que.='/'.$e_max;
		}
		?>
		
		
		<?php
		$n1 = ((($pagi*15)+1)-15);
		$n2 = $pagi*15;
		?>
		
			<?php include('top-banner.php');?>
			<!--
			<div id="responsive">
				<table width="100%" border="0">
					<tr>
						<td width="100%">
							<br />
						</td>	
					</tr>
				</table>
			</div>
			-->
            <div id="page" class="row">
			
				<div id="responsive" class="col-sm-12">
                          <div class="row products-navigation" style="margin-left:0px;margin-right:0px;">
                                  <div class="col-sm-9">
                                      <!--<h1 class="heading"><span style="font-size:20px;padding-left:5px;"><a href="<?php echo base_url(); ?>">Home</a> > <?php echo $search_string.' > '; ?></span></h1>-->
                                      <span class="heading" style="font-size:20px;padding-left:5px;"><a href="<?php echo base_url(); ?>">Home</a> > Search results for "<?php echo $search_string; ?>"</span>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php if($ti2=='blue' || $ti2=='lavender' || $ti2=='pink' || $ti2=='pastel' || $ti2=='white' || $ti2=='yellow' || $ti2=='peach' || $ti2=='Red'){ ?>
											<button class="button" type="button" onClick="goToHome();" style="background-color:transparent;color:#929998;"><?php echo ucwords($ti2); ?> &nbsp; <i class="fa fa-times"></i></button>
											&nbsp;
											<?php } ?>
											<?php if($e_color!='' && $e_color!='all'){ ?>
											<button class="button" type="button" onClick="removeColor();" style="background-color:transparent;color:#929998;"><?php echo ucwords($e_color); ?> &nbsp; <i class="fa fa-times"></i></button>
											&nbsp;
											<?php } ?>
											<?php if(($e_min!='' && $e_min!=0) || ($e_max!='' && $e_max!=1000)){ ?>
											<button class="button" type="button" onClick="removePriceRange();" style="background-color:transparent;color:#929998;">
												<?php 
												if($e_min!='' && $e_min!=0){
													if($e_max!='' && $e_max!=1000){
														echo 'C$'.number_format($e_min,2).' - C$'.number_format($e_max,2);
													}else{
														echo 'C$'.number_format($e_min);
													}
													
												}else{
													if($e_max!='' && $e_max!=1000){
														echo 'C$'.number_format($e_max);
													}else{
														
													}
												}
												?>	
												&nbsp; <i class="fa fa-times"></i>
											</button>
											&nbsp;
											<?php } ?>
											
								  </div>
                                  <div class="col-sm-3">
									    <div class=" pull-right">
											  <button class="button dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background-color:transparent;color:#929998;">Sort By: <?php echo $e_orderby; ?> &nbsp; <span class="caret"></span></button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="listing-nav">
                                                    <li><a onClick="changeSortBy('BM');" href="javascript:;" <?php if($e_orderby=='Best Match'){ echo 'style="font-weight:bold;"'; } ?>>Best Match</a></li>
                                                    <li><a onClick="changeSortBy('DESC');" href="javascript:;" <?php if($e_orderby=='Highest Price'){ echo 'style="font-weight:bold;"'; } ?>>Highest Price</a></li>
                                                    <li><a onClick="changeSortBy('ASC');" href="javascript:;" <?php if($e_orderby=='Lowest Price'){ echo 'style="font-weight:bold;"'; } ?>>Lowest Price</a></li>	
                                              </ul>
                                        </div>
								  </div>
                          </div>
                  </div>
				  
				  <div id="mobile-header" class="col-sm-12" style="margin-top:-10px;">
					<div class="row products-navigation">
						<div class="col-sm-12">
							<h1 class="heading"><span style="font-size:14px;padding-left:5px;"><a href="<?php echo base_url(); ?>">Home</a> > <?php echo $location.' > '.$val; ?></span></h1>
						</div>
					</div>
                  </div>
			<div id="responsive" class="col-sm-12">
			     <div class="col-sm-3 sidebar">
                          <?php include_once('left-sidebar.php');?>
                 </div>
                 <div class="col-sm-9">
					
					<!--
					<div class="row">
						<div class="col-lg-12">
							<table width="100%" style="border:1px solid #FE9900;">
								<tr height="30">
									<td width="5%" align="center" style="background-color:#FE9900;">
										<i class="fa fa-flag" style="color:#fff;"></i>
									</td>
									<td width="95%" style="padding-left:10px;">
										<span style="color:#555;">We didn't find any flowers in your price range. Search again.</span>
									</td>
								</tr>
							</table>	
						</div>
					</div>
					-->	
					
                          <div class="row" id="products-listing">
								
								
								<?php if($no_pros=='0'){ ?>
									<div class="col-lg-12">
										<table width="100%" style="border:2px solid #FE9900;">
											<tr height="30">
												<td width="5%" align="center" style="background-color:#FE9900;">
													<i class="fa fa-flag" style="color:#fff;"></i>
												</td>
												<td width="95%" style="padding-left:10px;">
													<span style="color:#555;">We didn't find any flowers based on your criteria. Search again.</span>
												</td>
											</tr>
										</table>	
									</div>
									
									<br /><br /><br />
									
								<?php } ?>
						  
                                <?php if(count($products)) : ?>
								
								<?php $procount = 0; ?>
                                <?php foreach($products as $row) : 

								list($width, $height, $type, $attr) = getimagesize(''.base_url().'productres/'.$row->product_picture);
								?>
								
								<?php $procount++; ?>
								
								<?php if($procount>0){ ?>

                                <?php $upath = str_replace(' ','-',strtolower($row->occasion_name)).'/';
                                      if($upath=='/') { $upath = ''; }
                                  ?>

                                   <div class="col-sm-4 product-item">
                                            <div class="product-picture">
                                                <a href="/<?php echo $upath.$row->url;?>"><img src="/productres/<?php echo $row->product_picture;?>" style="width:100%;height:100%;" /></a>
												<!--
												<br />
												<div class="text-center">
													<?php echo $width.' x '.$height.' - '.$row->product_id; ?>
												</div>
												-->
											</div>
                                            <p class="product-name">
                                                <a href="/<?php echo $upath.$row->url;?>"><?php echo $row->product_name;?></a>
                                            </p>
                                            <p class="product-price">
                                                <?php echo getRate($row->price_value).' - '.$row->product_id; ?>
												<?php //echo getRate($row->price_value); ?>
                                            </p>
                                   </div>

                                   <?php if($procount % 3 == 0) : ?>
                                          <div class="clearfix"></div>
                                   <?php endif; ?>

								<?php } ?>
 
                              <?php endforeach; ?>
                              <?php else : ?>
								
								
								
								<!--
								<div class="col-lg-12 text-center">
									<br /><br />
									<span style="font-size:25px;">Sorry no products are available at the moment !</span>
								</div>
                                -->

                            <?php endif;?>

                          </div><!-- Products Listing //-->
						  
						  <?php if(count($products)) { ?>
						  
						  <?php if($tot_pag>1){ ?>
						  
						  <div class="row" style="margin-left:0px;margin-right:0px;">
							<div class="col-lg-4">
								
							</div>
							<div class="col-lg-8">
								
								<br />
								
								<div class="row">
									
									<?php 
									if($pagi<=4){
										//$vi = $tot_pag + 2;
										if($tot_pag==2){
											$vi = 8;
										}
										if($tot_pag==3){
											$vi = 7;
										}
										if($tot_pag==4){
											$vi = 6;
										}
										if($tot_pag>=5){
											$vi = 5;
										}
									}else{
										if($tot_pag>=$pagi+2){
											//$vi = $tot_pag + 2;
											$vi = 5;
										}
										if($tot_pag==$pagi+1){
											$vi = 6;	
										}
										if($tot_pag==$pagi){
											$vi = 7;	
										}
										/*
										if($tot_pag>=$pagi+2)
										$vi = $tot_pag + 2;
										$vi = 12-$vi;
										*/
									}	
									?>
									
									<div class="col-lg-<?php echo $vi; ?> col-md-<?php echo $vi; ?> col-sm-<?php echo $vi; ?>">
										
									</div>
									
									<div class="col-lg-1 col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
										<table width="100%">
											<tr>
												<td width="100%" align="center">
													<?php if($pagi==1){ ?>
													<a href="javascript:;">
														<div style="background-color:#FFFFFF;color:#999999;width:100%;height:30px;padding-top:6px;">
															<i class="fa fa-chevron-left"></i>
														</div>
													</a>
													<?php }else{ ?>
													<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $pagi-1; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>">
														<div style="background-color:#FFFFFF;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
															<i class="fa fa-chevron-left"></i>
														</div>
													</a>
													<?php } ?>
												</td>
											</tr>
										</table>
									</div>
									
									<?php if($pagi<=4){ ?>
										
										<?php for($w=1;$w<=5;$w++){ ?>
										
											<?php if($w<=$tot_pag){ ?>
											<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
												<table width="100%">
													<tr>
														<td width="100%" align="center">
															<?php if($pagi==$w){ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																	<div style="background-color:#e74c3c;color:#fff;width:100%;height:30px;padding-top:6px;">
																		<?php echo $w; ?>
																	</div>
																</a>	
															<?php }else{ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																	<div style="background-color:#F0F0F0;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																		<?php echo $w; ?>
																	</div>
																</a>
															<?php } ?>
															
														</td>
													</tr>
												</table>
											</div>
											<?php } ?>
										
										<?php } ?>
									
									<?php } ?>
									
									<?php if($pagi>=5){ ?>
									
										<?php for($w=$pagi-2;$w<=$pagi+2;$w++){ ?>
										
											<?php if($w<=$tot_pag){ ?>
											<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
												<table width="100%">
													<tr>
														<td width="100%" align="center">
															<?php if($pagi==$w){ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																	<div style="background-color:#e74c3c;color:#fff;width:100%;height:30px;padding-top:6px;">
																		<?php echo $w; ?>
																	</div>
																</a>	
															<?php }else{ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																	<div style="background-color:#F0F0F0;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																		<?php echo $w; ?>
																	</div>
																</a>
															<?php } ?>
															
														</td>
													</tr>
												</table>
											</div>
											<?php } ?>
											
										<?php } ?>
									
									<?php } ?>
									
									<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
										<table width="100%">
											<tr>
												<td width="100%" align="center">
													<?php if($pagi==$tot_pag){ ?>
													<a href="javascript:;">
														<div style="background-color:#FFFFFF;color:#999999;width:100%;height:30px;padding-top:6px;">
															<i class="fa fa-chevron-right"></i>
														</div>
													</a>
													<?php }else{ ?>
													<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $pagi+1; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>">
														<div style="background-color:#FFFFFF;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
															<i class="fa fa-chevron-right"></i>
														</div>
													</a>
													<?php } ?>
												</td>
											</tr>
										</table>
									</div>
									
								</div>
								
							</div>
						  </div>
						  
						  <?php } ?>
						  
						  <?php } ?>
						  
						  <br /><br />
						  
						  
                 </div><!-- Content //-->
			</div>	 
				 
			<div id="mobile-header" class="row">
					<br /><br />
					<div class="col-lg-12" id="products-listing">
						
						<table width="100%" border="0">
							<?php //if(count($group_products)) : ?>
							<?php $procount = 0; ?>
							<?php foreach($products as $row) : ?>
								<?php $procount++; ?>
								<?php if($procount>=($n1+$pagi-1) && $procount<=$n2+$pagi){ ?>
							
							<?php if($procount==1 || $procount%2==1){ ?>
								<tr>
							<?php } ?>
									<td width="50%" valign="top">
										<div class="col-sm-12 product-item">
                                            <div class="product-picture">
                                                <!--<a href="/<?php echo $upath.$row->url;?>"><img src="/productres/<?php echo $row->product_picture;?>" style="width:100%;height:240px;"></a>-->
												<a href="/<?php echo $upath.$row->url;?>"><img src="/productres/<?php echo $row->product_picture;?>" style="width:100%;" class="orienta" ></a>
											</div>
                                            <p class="product-name">
                                                <a href="/<?php echo $upath.$row->url;?>"><?php echo $row->product_name;?></a>
                                            </p>
                                            <p class="product-price">
                                                <?php //echo getRate($row->price_value).' - '.$row->product_id; ?>
												<?php echo getRate($row->price_value); ?>
                                            </p>
										</div>
									</td>
									
							<?php if($procount%2==0){ ?>
								</tr>
							<?php } ?>
								
								<?php } ?>
								
							<?php endforeach; ?>
							
							  <tr>
								<td colspan="2">
									<?php if(count($products)) { ?>
						  
									  <?php if($tot_pag>1){ ?>
									  
									  <div class="row" style="margin-left:2%;margin-right:2%;">
										<div class="col-lg-4">
											
										</div>
										<div class="col-lg-8">
											
											<br />
											
											<div class="row">
									
												<?php 
												$tot_pag=(intval($procount/16))+1;
												
												if($pagi<=4){
													
													if($tot_pag==2){
														$vi = 8;
													}
													if($tot_pag==3){
														$vi = 7;
													}
													if($tot_pag==4){
														$vi = 6;
													}
													if($tot_pag>=5){
														$vi = 5;
													}
													
												}else{
													if($tot_pag>=$pagi+2){
														//$vi = $tot_pag + 2;
														$vi = 5;
													}
													if($tot_pag==$pagi+1){
														$vi = 6;	
													}
													if($tot_pag==$pagi){
														$vi = 7;	
													}
													/*
													if($tot_pag>=$pagi+2)
													$vi = $tot_pag + 2;
													$vi = 12-$vi;
													*/
												}	
												?>
												
												<div class="col-lg-<?php echo $vi; ?> col-md-<?php echo $vi; ?> col-sm-<?php echo $vi; ?>">
													
												</div>
												
												<div class="col-lg-1 col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
													<table width="100%">
														<tr>
															<td width="100%" align="center">
																<?php if($pagi==1){ ?>
																<a href="javascript:;">
																	<div style="background-color:#FFFFFF;color:#999999;width:100%;height:30px;padding-top:6px;">
																		<i class="fa fa-chevron-left"></i>
																	</div>
																</a>
																<?php }else{ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $pagi-1; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>">
																	<div style="background-color:#FFFFFF;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																		<i class="fa fa-chevron-left"></i>
																	</div>
																</a>
																<?php } ?>
															</td>
														</tr>
													</table>
												</div>
												
												<?php if($pagi<=4){ ?>
													
													<?php for($w=1;$w<=5;$w++){ ?>
													
														<?php if($w<=$tot_pag){ ?>
														<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
															<table width="100%">
																<tr>
																	<td width="100%" align="center">
																		<?php if($pagi==$w){ ?>
																			<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																				<div style="background-color:#e74c3c;color:#fff;width:100%;height:30px;padding-top:6px;">
																					<?php echo $w; ?>
																				</div>
																			</a>	
																		<?php }else{ ?>
																			<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																				<div style="background-color:#F0F0F0;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																					<?php echo $w; ?>
																				</div>
																			</a>
																		<?php } ?>
																		
																	</td>
																</tr>
															</table>
														</div>
														<?php } ?>
													
													<?php } ?>
												
												<?php } ?>
												
												<?php if($pagi>=5){ ?>
												
													<?php for($w=$pagi-2;$w<=$pagi+2;$w++){ ?>
													
														<?php if($w<=$tot_pag){ ?>
														<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
															<table width="100%">
																<tr>
																	<td width="100%" align="center">
																		<?php if($pagi==$w){ ?>
																			<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																				<div style="background-color:#e74c3c;color:#fff;width:100%;height:30px;padding-top:6px;">
																					<?php echo $w; ?>
																				</div>
																			</a>	
																		<?php }else{ ?>
																			<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $w; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>" style="text-decoration:none;">
																				<div style="background-color:#F0F0F0;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																					<?php echo $w; ?>
																				</div>
																			</a>
																		<?php } ?>
																		
																	</td>
																</tr>
															</table>
														</div>
														<?php } ?>
														
													<?php } ?>
												
												<?php } ?>
												
												<div class="col-lg-1 row-pagi col-md-1 col-sm-1" style="padding-right:4px;padding-left:4px;">
													<table width="100%">
														<tr>
															<td width="100%" align="center">
																<?php if($pagi==$tot_pag){ ?>
																<a href="javascript:;">
																	<div style="background-color:#FFFFFF;color:#999999;width:100%;height:30px;padding-top:6px;">
																		<i class="fa fa-chevron-right"></i>
																	</div>
																</a>
																<?php }else{ ?>
																<a href="<?php echo base_url(); ?><?php echo $ti; ?>/<?php echo $ti2; ?>/<?php echo $pagi+1; ?><?php echo $fin_que; ?>/<?php echo $sortby_val; ?>">
																	<div style="background-color:#FFFFFF;color:#e74c3c;width:100%;height:30px;padding-top:6px;">
																		<i class="fa fa-chevron-right"></i>
																	</div>
																</a>
																<?php } ?>
															</td>
														</tr>
													</table>
												</div>
												
											</div>
											
										</div>
									  </div>
									  
									  <?php } ?>
									  
									  <?php } ?>
									  
									  <br /><br />
								</td>
							  </tr>
							
                              <tr>
								<td colspan="2">
									<br />
									<div class="text-center" style="width:100%;border-top:2px solid #A9A9A9;">
										<br />
										<span style="font-size:18px;">Get Live Help</span>
										<p style="font-size:20px;font-weight:bold;">Call 1-888-980-8840</p>
								  </div>
								</td>
							  </tr>
						</table>
						
						<br />
						
						
						
						
					</div>
					
					
					
					
				</div>	 
				
				
				 
            </div><!-- Page //-->
      </div><!-- Container //-->
	  
	  
	  
	  
	  
	  
	  
	  
<?php include_once('footer.php'); ?>

