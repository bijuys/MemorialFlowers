<?php include_once('top.php'); ?>

	<?php //$che = $this->Product_model->insert_similar_product($this->session->userdata('session_id'),$product->product_id); ?>	

      <div class="container">
            <div id="breadcrumb">
                  <h2 style="font-size:16px;">
					<a href="<?php echo base_url(); ?>">Home <?php //echo $this->session->userdata('session_id'); ?></a> 
					<?php if($link_back_condi=='category' || $link_back_condi=='occasion' || $link_back_condi=='subcategory' || $link_back_condi=='criteria'){ ?>
						> 
						<a href="<?php echo base_url(); ?><?php echo $link_back; ?>"><?php echo $subti; ?></a> 
					<?php }else{ ?>
						>
						<?php echo $category->category_name; ?>	
					<?php } ?>
					 
					<?php //echo $product->product_name;?>
					
				  </h2>
            </div>
			
			<script>
			function revCheckInfo(id){
				//alert('test');
				var myLink = document.getElementById('price_'+id);
				myLink.click();
				//$($('#price_'+id).click());
				//document.getElementById('price_'+id).checked = 'checked';
			}
			</script>
			
            <div id="page" class="white-box">
                <div class="row" id="product-info">
                      <div class="col-sm-5">
							<div id="mobile-header">
								<p style="font-size:16px;"><?php echo $product->product_name;?></p>
                            </div>
							<div class="product-picture text-center">
								<!--<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture;?>" id="productpic" style="width:22.4em;"><br />-->
								<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture;?>" id="productpic" style="width:100%;height:100%;"><br />
							</div>
							<div class="text-center" style="margin-top:-20px;">
								<div id="mobile-header">
									<table width="100%">
										<tr>
											<td width="100%">
												<select onChange="revCheckInfo(this.value);" required style="margin-bottom:7px;width:100%;height:40px;padding:5px;font-size:16px;background-color:transparent;color:#B8B8B8;border:1px solid #D3D3D3;">
													<option value="">Select Size</option>
												<?php foreach($product->prices as $prc){ ?>
													<option value="<?php echo $prc->price_id; ?>"><?php echo $prc->price_name.' - C$'.$prc->price_value; ?></option>
												<?php } ?>
												</select>
												<select onChange="revCheckInfo2(this.value);" required style="margin-bottom:7px;width:100%;height:40px;padding:5px;font-size:16px;background-color:transparent;color:#B8B8B8;border:1px solid #D3D3D3;">
													<option value="">Ship To</option>
													<option value="">Funeral Home</option>
													<option value="">Home & Office</option>
												</select>
												<br />
											</td>
										</tr>
									</table>
									
								</div>
								<?php //echo '<span style="font-size:15px;">SKU: <b>'.$product->product_code.'</b></span><br /><br />'; ?>
                            </div>
							<div id="responsive" class="product-alt-pictures">
                                  <ul>
                                        <?php foreach($product->prices as $prc) : ?>
                                          <?php if(!empty($prc->option_picture)) : ?>
                                            <li><div class="thumb"><a href="<?php echo base_url(); ?>productres/<?php echo $prc->option_picture;?>" class="set-picture" id="pic<?php echo $prc->price_id;?>"><img src="/productres/<?php echo $prc->option_picture;?>"></a></div></li>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                  </ul>
                            </div>
                      </div>

                      <div class="col-sm-7">
                              <?php echo form_open(); ?>
                              <div id="responsive">
								<h1><?php echo $product->product_name;?> | <?php echo $product->product_code; ?><br/> <?php echo getRate($product->prices[0]->price_value);?></h1>
                              </div>
							  
							  <div id="responsive" class="row product-options">
                                    <div class="col-sm-12">
                                        
                                    </div>
                                    <div class="col-sm-6">
                                          <h4><?php echo lang('Please select size');?></h4>
                                          <ul class="price-options">
                                                <?php
                                                            $ct = 0;
                                                          foreach($product->prices as $prc)  :    
                                                                $ct++;                      
                                                ?>
                                                <li><label for="price_<?php echo $prc->price_id;?>"><input type="radio" class="changepic" name="price_id" id="price_<?php echo $prc->price_id;?>" data-id="<?php echo $prc->price_id;?>"  value="<?php echo $prc->price_id; ?>__<?php echo $prc->price_name; ?>" <?php echo $ct==1 ? 'checked="checked"':'';?>> <?php echo lang($prc->price_name); ?> (<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>)</label></li>
                                              <?php endforeach; ?>
                                          </ul>
                                    </div>
                                    <div class="col-sm-6">
                                           <h4><?php echo lang('Ship to');?></h4>
                                          <ul class="ship-options">
                                                <li><label><input type="radio" name="ship" value="funeral home" checked="checked"> <?php echo lang('Funeral Home');?></label></li>
                                                <li><label><input type="radio" name="ship" value="home or office"> <?php echo lang('Home or Office');?></label></li>
                                          </ul>
                                    </div>
                              </div>
							  
							  <!--
							  <h4>Card Message</h4>
							   <div class="action">
								<textarea rows="2" id="card_message" name="card_message" placeholder="Enter card message..." style="width:70%;" class="form-control"></textarea> 
							   </div>
							  -->
							
							<?php $re = $this->Product_model->is_product_flowerforservice($product->product_id); ?>
							
							<?php if($re->total>0){ ?>	
							
							<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
							<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
							<!-- Include all compiled plugins (below), or include individual files as needed -->
							<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0-rc2/js/bootstrap.min.js"></script>
							
							<script>
									$(document).ready(function(){
										var image = '<img src="<?php echo base_url(); ?>/images/ribbonb.jpg" style="width:100%;"><br />';
										var tit = '<table width="100%"><tr><td width="50%">Ribbon Sample</td><td width="50%" align="right"><a href="javascript:;" onClick="closePop();"><i class="fa fa-times"></i></a></td></tr></table>';
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
									
							  <input type="hidden" name="card_message" id="card_message" value="">		
									
							  <h4>Add Ribbon (+ $12.99) 
									<a id="popover" class="btn" rel="popover" data-content="" title=""><i class="glyphicon glyphicon-question-sign"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <span style="font-size:12px;">Characters: <span style="color:#5BC5C3;" id="charNum">35</span></span></h4>
							   <div class="action" style="margin-top:-10px;">
								<table width="100%">
									<tr>
										<!--
										<td width="10%" align="center" valign="middle">
											<input type="checkbox" name="ribbon_val" id="ribbon_val" value="1" onClick="verifyArea();">
										</td>
										-->
										<script src="http://code.jquery.com/jquery-1.5.js"></script>
										<script>
										  function countChar(val) {
											var len = val.value.length;
											if (len >= 36) {
											  val.value = val.value.substring(0, 35);
											} else {
											  $('#charNum').text(35 - len);
											}
										  };
										</script>
										
										<td width="100%" align="center" valign="middle">
											<textarea rows="2" id="ribbon_text" name="ribbon_text" maxlength="150" onkeyup="countChar(this)" placeholder="Enter ribbon message..." class="form-control"><?php echo $ribbon_textito; ?></textarea> 
										</td>
									</tr>
								</table>
                                  <script>
									function verifyArea(){
										val = document.getElementsByName("ribbon_text").value;
										if(val==''){
											document.getElementsByName("ribbon_text").disabled=false;
										}else{
											document.getElementsByName("ribbon_text").disabled=true;
										}
									}
                                  </script>
                                      
                              </div>
							  
							  <?php }else{ ?>
							  
							  	<input type="hidden" id="ribbon_text" name="ribbon_text" /> 
								
							  <?php } ?>
							  
                              <h4>Please select a delivery date</h4>
                              <?php echo form_error('delivery_date','<div class="err">','</div>'); ?>
                              <div class="action">
                                      <a href="#" class="btn btn-default" id="datepicker"><span id="show_date">Delivery Date</span>  &nbsp; <span class="caret" style="color: #FFF;"></span></a> &nbsp;  &nbsp;  &nbsp; <button type="submit" class="btn btn-primary">Add to Cart</button>
                                      
                                      <input type="hidden" name="delivery_date" id="delivery_date" value="" >
                                      <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>">
                                      <div class="calendar-container">
                                            <div id="calendar">
                                                  <?php echo calendars(); ?>
                                            </div>
                                      </div>
                              </div>
                              <div id="reduced_des" class="product-description" style="text-align:justify;">
									<?php if(strlen(rightLang($product->product_description,$product->product_description_fr))>390){ ?>
										<?php echo substr(rightLang($product->product_description,$product->product_description_fr),0,390).' ... ';  ?>
										<a href="javascript:;" onClick="showInf1();">see more</a>
									<?php }else{ ?>
										<?php echo rightLang($product->product_description,$product->product_description_fr);  ?>
									<?php } ?>
							  </div>
							  <div id="long_des" class="product-description" style="text-align:justify;display:none;">
									<?php echo rightLang($product->product_description,$product->product_description_fr);  ?>
									<!--
									<div class="pull-right">
										<a href="javascript:;" onClick="showInf2();">See less</a>
									</div>	
									<br /><br />
									-->
							  </div>
                              <?php echo form_close(); ?>
							  
							  <script>
								function showInf1(){
									document.getElementById('reduced_des').style.display = 'none';
									document.getElementById('long_des').style.display = 'block';
								}
								/*
								function showInf2(){
									document.getElementById('reduced_des').style.display = 'block';
									document.getElementById('long_des').style.display = 'none';
								}
								*/
							  </script>
                      </div>
                </div><!-- Product Info ends here //-->
                
            </div><!-- Page ends here //-->
				
				<script>
				function addToSimilar(id,id2){
					//alert(val+"_"+id);
					$.post("<?php echo base_url(); ?>shop/add-last-visited/"+id+"_"+id2);
				}
				</script>
				
            <div id="similar-products">
                        <h4>Related Products</h4>
                        <div id="responsive" class="row">
                              <?php foreach($sameitems as $row) : ?>
							 
                              <?php $upath =$row->category_name . '/'; ?>
                              <div class="col-sm-2">
                                      <div class="similar-item">
                                            <div class="product-picture">
                                                    <a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>"><img src="<?php echo '/productres/'.$row->product_picture;?>" alt="<?php
       echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>" style="width:100%;height:100%;"></a>
                                              </div>
                                              
                                        </div>
										
										<p class="product-name" style="text-align:center;">
											<?php $le = strlen($row->product_name); ?>	
											
											<a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>" style="font-size:12px;">
												<?php 
												if($le<=20){
													echo $row->product_name.'<br />';
												}elseif($le>=21 && $le<=35){
													echo $row->product_name;
												}else{
													echo substr($row->product_name,0,35).' ...';
												}
												?>
												<?php //echo substr(rightLang($row->product_name,$row->product_name_fr),0,37).' ...'; ?>
											</a>
											<br />
											<span style="font-size:13px;color:#888888;"><b>C$<?php echo $row->price_value; ?></b></span>
										</p>
                              </div>
                              <?php endforeach;?>
							  
							  
							  
                        </div>
						
						<div id="mobile-header2" class="row">
                              
                              <div class="col-sm-12">
									<table width="100%" border="0">
										
											<?php 
											$w=0;
											foreach($sameitems as $row){ 
											$w=$w+1;
											?>
											<?php $upath =$row->category_name . '/'; ?>
											<tr>
												<td width="100%" valign="top">
													
													<div class="similar-item" style="max-width::auto;width:100%;">
														<div class="product-picture">
																<a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>"><img src="<?php echo '/productres/'.$row->product_picture;?>" alt="<?php
				   echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>" style="width:100%;"></a>
														  </div>
														  
													</div>
													
													<p class="product-name" style="text-align:center;">
														<?php $le = strlen($row->product_name); ?>	
														
														<a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>" style="font-size:12px;">
															<?php 
															if($le<=20){
																echo $row->product_name.'<br />';
															}elseif($le>=21 && $le<=35){
																echo $row->product_name;
															}else{
																echo substr($row->product_name,0,35).' ...';
															}
															?>
															<?php //echo substr(rightLang($row->product_name,$row->product_name_fr),0,37).' ...'; ?>
														</a>
														<br />
														<span style="font-size:13px;color:#888888;"><b>C$<?php echo $row->price_value; ?></b></span>
													</p>
													
												</td>
											</tr>
											<?php } ?>
										
									</table>
                                      
                              </div>
                              
							  
							  
                        </div>
						
						
						
						
						<div id="ipad-header" class="row">
                              
                              <div class="col-sm-12">
									<table width="100%" border="0">
										<tr>
											<?php 
											$w=0;
											foreach($sameitems as $row){ 
											$w=$w+1;
											?>
											<?php $upath =$row->category_name . '/'; ?>
											
												<td width="30%" valign="top">
													
													<div class="similar-item" style="max-width::auto;width:100%;">
														<div class="product-picture">
																<a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>"><img src="<?php echo '/productres/'.$row->product_picture;?>" alt="<?php
				   echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>" style="width:100%;"></a>
														  </div>
														  
													</div>
													
													<p class="product-name" style="text-align:center;">
														<?php $le = strlen($row->product_name); ?>	
														
														<a onClick="addToSimilar('<?php echo $this->session->userdata('session_id'); ?>','<?php echo $row->product_id; ?>');" href="<?php echo base_url(); ?><?php echo $row->url;?>" style="font-size:12px;">
															<?php 
															if($le<=20){
																echo $row->product_name.'<br />';
															}elseif($le>=21 && $le<=35){
																echo $row->product_name;
															}else{
																echo substr($row->product_name,0,35).' ...';
															}
															?>
															<?php //echo substr(rightLang($row->product_name,$row->product_name_fr),0,37).' ...'; ?>
														</a>
														<br />
														<span style="font-size:13px;color:#888888;"><b>C$<?php echo $row->price_value; ?></b></span>
													</p>
													
												</td>
												
												<?php if($w<=2){ ?>
													<td width="5%">
													
													</td>
												<?php } ?>
											
											<?php } ?>
										</tr>
									</table>
                                      
                              </div>
                              
							  
							  
                        </div>
						
						<br /><br />
						
						 <?php $sims = $this->Product_model->get_sim_pro($this->session->userdata('session_id'),$product->product_id,6); ?>
						
						<?php if($sims){ ?>
						
						<h4>Recently Viewed</h4>
						
						<div class="row">
						
							
							  
							  
							  
							  <?php foreach($sims as $sim) : ?>
							 
                              <?php //$upath =$sim->category_name . '/'; ?>
                              <div class="col-sm-2">
                                      <div class="similar-item" style="margin-right:auto;">
                                            <div class="product-picture">
                                                    <a href="<?php echo base_url(); ?><?php echo $sim->url;?>"><img src="<?php echo '/productres/'.$sim->product_picture;?>" alt="<?php
       echo $sim->alternate_text;?>"  title="<?php echo $sim->alternate_text;?>"></a>
                                              </div>
                                              
                                        </div>
										<p class="product-name" style="text-align:center;">
											<?php $le2 = strlen($row->product_name); ?>	
											
											<a href="<?php echo base_url(); ?><?php echo $sim->url;?>" style="font-size:12px;">
												<?php 
												if($le2<=20){
													echo $row->product_name.'<br />';
												}elseif($le2>=21 && $le2<=35){
													echo $row->product_name;
												}else{
													echo substr($row->product_name,0,35).' ...';
												}
												?>
												<?php //echo rightLang($sim->product_name,$sim->product_name_fr); ?>
											</a>
											<br />
											<span style="font-size:13px;color:#888888;"><b>C$<?php echo $sim->price_value; ?></b></span>
										</p>
                              </div>
                              <?php endforeach;?>
						
						</div>
						
						<?php } ?>
						
                </div>
                
      </div><!-- Container //-->
	 










































	  
<?php include_once('bottom.php'); ?>
<script type="text/javascript">
  $(function(){
      
      $("#datepicker").click(function(e){
		      e.preventDefault();
              $("#calendar").toggle();
			  $(".month-calendar").first().css("display","block");
			  //$(".month-calendar").second().css("display","block");
              return false;   
      })
	  
	  $(".changepic").click(function(){
          var prid = $(this).attr("id");
          prid = prid(5)

          alert(prid)
      })

      $('input:radio[name="price_id"]').change(
        function(){
            if ($(this).is(':checked')) {
                var id = $(this).attr("data-id")
               $("#pic"+ id).trigger('click')
            }
        });

      $(".set-picture").click(function(e){
            e.preventDefault();

            var id = $(this).attr("id");
            id = id.slice(3);

            var src = $(this).attr("href");
            $(".set-picture").parent().removeClass("currentpic");
            $(this).parent().addClass("currentpic");
            $("#productpic").attr("src",src);
            $('*[data-id="'+id+'"]').prop("checked",true);
      })

      $(".set-picture:first").trigger("click");

      $(".prev").click(function(e){
              e.preventDefault();
              if($(this).attr("href")!='#')
              {
                  $('.month-calendar').css("display","none");
                  $($(this).attr("href")).css("display","block");
              }
      })

      $(".next").click(function(e){
              e.preventDefault();
              if($(this).attr("href")!='#')
              {
                  $('.month-calendar').css("display","none");
                  $($(this).attr("href")).css("display","block");
              } 
      })

      $(".day-link").click(function(e){
              e.preventDefault();
              $(".day-link").removeClass('selected');
              var dt = $(this).attr("name");
              $(this).addClass('selected');
              $("#delivery_date").val(dt);

              var res = dt.split('-');
              $("#show_date").html(res[2]+'/'+res[1]+'/'+res[0]);
              $("#calendar").toggle();
      })

      $('html').click(function() {
            $("#calendar").css("display","none")
      });

      $('#calendar').click(function(event){
          event.stopPropagation();
      });
	
  })
</script>

<?php include_once('footer.php'); ?>

