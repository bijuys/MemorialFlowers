<?php include_once('header_clava.php');?>
	
	<!--start wrapper-->
	<section class="wrapper  topwrapper">
		
		<section class="content about" style="margin-top:-25px;margin-bottom:-70px;">
			<div class="container">
			
				<?php echo form_open_multipart(current_url(), 'id="site-searchform"'); ?>
				
				<div class="row sub_content">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="dividerLatest">
							<h4><?php echo ucwords(strtolower(rightLang($product->product_name,$product->product_name_fr)));?> </h4>
							<div class="gDot"></div>
						</div>
					</div>
					
					<div class="col-lg-1">
							
					</div>
					
					<div class="col-lg-5">
						<div class="prod-view-picture">
							<img src="<?php echo base_url(); ?>productres/<?php echo $product->product_picture;?>" alt="profile img" id="productpic" width="100%" height="100%" />
						</div>
						<div class="profile text-center">
							<span style="font-size:15px;font-weight:900;"><?php echo $product->product_code;?></span>
						</div>

						<div class="additional-pictures">
						        <div class="row">
				                                        <?php foreach($product->prices as $prc) : ?>
				                                          <?php if(!empty($prc->option_picture)) : ?>
				                                            <div class="col-sm-4"><div class="thumb prod-view-picture"><a href="/productres/<?php echo $prc->option_picture;?>" class="set-picture" id="pic<?php echo $prc->price_id;?>"><img src="/productres/<?php echo $prc->option_picture;?>"></a></div></div>
				                                          <?php endif; ?>
				                                      <?php endforeach; ?>
				                                      <div class="clearfix"></div>
				                                  </div>
						</div>
						
						<br/>
						<br/>
						<br/>

						<div class="row" id="simi_pro">
						<?php foreach($sameitems as $row){ ?>
							<div class="col-lg-4 text-center">
								<a href="<?php echo base_url().$row->url; ?>" style="color:inherit;">
									<div class="thumb"><img src="<?php echo base_url(); ?>productres/<?php echo $row->product_picture; ?>" width="100%" height="110" />
									</div>
									<span style="font-weight:500;"><?php echo getRate($row->price_value); ?></span>
									<br />
									<a href="<?php echo base_url().$row->url;?>" class="btn btn-small btn-block btn-success"><i class="fa fa-search"></i>View</a>
								</a>	
							</div>	
						<?php } ?>
						</div>
						
					</div>
					
					<div class="col-lg-5">
						
						<input type="hidden" name="product_id" value="<?php echo $product->product_id;?>" />
						<input type="hidden" name="category" value="<?php echo $category;?>" />
			   
						
						<span id="price_se" name="price_se" style="font-size:35px;font-weight:790;padding:5px 5px 5px 5px;" class="pull-right"><?php echo getRate($product->prices[0]->price_value-($product->prices[0]->price_value*$this->session->userdata('disco')));?></span>
						<br /><br />
						<div style="margin-top:20px;">
							<span style="font-size:20px;font-weight:780;">Choose Size:</span>
						</div>
						
						<table width="100%" style="margin-top:10px;">
						<?php
						$ct = 0;
						foreach($product->prices as $prc) {
						$ct++;                               
						?>	
							<tr height="30">
								<td width="10%">
									<input type="radio" name="price_id" id="price_<?php echo $prc->price_id;?>"  data-id="<?php echo $prc->price_id;?>" onClick="selectPrice('<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>');" value="<?php echo $prc->price_id; ?>" <?php echo $ct==1 ? 'checked="checked"':'';?> />
								</td>
								<td width="90%">
									<span style="font-size:15px;">
										<?php echo lang($prc->price_name); ?>
										<span>(<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>)</span>
									</span>	
								</td>
							</tr>
						<?php 
						} 
						?>
						</table>
						<div style="margin-top:30px;">
							<span style="font-size:20px;font-weight:780;">Select Delivery Date:</span>
						</div>
						<div id="delidrop" class="row" style="margin-top:10px;">
							<div class="col-lg-8">
								<select name="upcoming" id="upcoming"  onchange="upcoming_date(this.value);" style="height:40px;width:100%;">
									<option value=""><?php echo lang('Choose delivery date');?></option>
									<?php $dates = get_dates($product->delivery_method_id,30);
										foreach($dates as $day) { ?>
										<option value="<?php echo date('d-m-Y',strtotime($day)); ?>"><?php echo date('l, d F',strtotime($day));?></option>
									<?php   } ?>
									<optgroup label="....................................." class="vical"></optgroup>
									<option value="cal"><?php echo lang('View calendar');?></option>
								</select>
								<input type="hidden" id="delivery_date" name="delivery_date" value="" />
							</div>
							<div class="col-lg-4">
								<!--
								<a href="#calendar" name="datepick" id="datepick" class="btn btn-medium btn-block btn-info"><i class="fa fa-calendar"></i>Calendar</a>
								<input type="hidden" id="delivery_date" name="delivery_date" value="" />
								-->
							</div>
						</div>
						<br/>
						<div class="row" style="display:none;">
							<div class="col-sm-8">
								<a name="datepick" id="datepick" href="#myModal" class="btn btn-success btn-large" role="button" data-toggle="modal">
									<i class="fa fa-calendar"></i> &nbsp; Pick A Delivery Date &nbsp;
								</a> 
							</div>
							<div class="col-sm-4">
								<input type="hidden" id="show_date2" readonly size="30" style="background:transparent; border: none;" />
							</div>
						</div>

						<!-- Modal HTML -->

					    <div id="myModal" class="modal fade">
					        <div class="modal-dialog">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					                    <h4 class="modal-title">Choose Delivery Date</h4>
					                </div>

					                <div class="modal-body">
					                    <div id="calendarwrap">
					             
					            		<!-- #customize your modal window here -->
					         
					            		<div id="calendar" class="window">
					             
						             <?php
						                
						                	$tmonth = date('m',time());
						                	$tyear = date('y',time());
						                
							                if($tmonth<12)
							                {
							                    $nmonth = $tmonth+1;
							                    $nyear = $tyear;
							                }
							                else
							                {
							                    $nmonth = 1;
							                    $nyear = $tyear+1;
							                }
						                
							    	echo showCalendar($product->delivery_method_id,25);

						                
						             ?> 
						              <!--  <a href="#" class="close">Close it</a>-->
						         
						            </div>
						            <!-- Do not remove div#mask, because you'll need it to fill the whole screen --> 

							</div>

						                </div>

						                <div class="modal-footer">

						                </div>

						            </div>

						        </div>

					    </div>
						
						<!--
						<table width="100%" style="margin-top:10px;">
							<tr height="30">
								<td width="60%" style="padding-left:15px;">
									
								</td>
								<td width="40%">
									
								</td>
							</tr>
						</table>
						-->

						<!--
						<p class="showing_date">
							<label>
								<?php echo lang('Delivery');?>: 
								<input type="text" id="show_date" readonly  size="30" style="background:transparent; border: none; box-shadow: none; font-size:20px; font-weight:bold;" value="" />
							</label>
						</p>
						-->
						<!--
						<img src="<?php echo theme_url();?>/images/<?php echo imgLang('sameday-delivery-LN.png');?>" width="100%" alt="<?php echo lang('Same day delivery');?>" /> 
						-->

						<div class="prod-ribbon-box">
							<span style="font-size:20px;font-weight:780;"><?php echo lang('Add a Ribbon (+ $12.99)');?></span> <a id="popover" href="#" rel="popover" data-content="" title=""><i class="fa fa-question-circle"></i></a>
							<div style="float: right">Characters: <span id="chars-left" style="color:red;">35</span></div>
						<textarea style="width:100%; height: 50px;" id="ribbon-text" name="ribbon_text"></textarea>

						</div>
						
						<?php

						if($this->session->userdata('fhid') && $this->session->userdata('cobrand') && $this->session->userdata('pid')){ 
							/* JSON WEB SERVICE ACCESS */
							$json = file_get_contents('http://www.legacy.com/webservices/ns/FuneralInfo.svc/GetFuneralInfoJson?fhid='.$this->session->userdata('fhid').'&cobrand='.$this->session->userdata('cobrand').'&pid='.$this->session->userdata('pid'));
							$obj = json_decode($json);
							/*
							echo $this->session->userdata('fhid').'_'.$this->session->userdata('cobrand').'_'.$this->session->userdata('pid').'_____________';
							echo $json;
							*/
							echo '<br />';
							echo '<span style="font-size:20px;font-weight:bold;color:#8D0352;">Funeral Home</span><br />';
							echo '<span style="color:#8A8A8A;font-size:14px;">';
							echo $obj->FuneralHome->FHKnownBy1.'<br />';
							echo $obj->FuneralHome->FHAddress1.' '.$obj->FuneralHome->FHAddress2.'<br />';
							echo $obj->FuneralHome->FHCity.', '.$obj->FuneralHome->FHState.' '.$obj->FuneralHome->FHZip.'<br />';
							echo '</span><br /><br />';
						}else{

						?> 
						
						<div style="margin: 15px 0px;">
							<div style="margin-top:0px;">
								<span style="font-size:20px;font-weight:780;">Find Funeral Home</span>
							</div>
							<input type="text" name="country" id="home" class="form-control" placeholder="Type Funeral Home Name" />
							<input type="hidden" name="home_name" id="home-name" value="" />
							<input type="hidden" name="home_address"  id="home-address" value="" />
							<input type="hidden" name="home_postalcode" id="home-postalcode"  value="" />
							<input type="hidden" name="home_city"  id="home-city" value="" />
							<input type="hidden" name="home_province"  id="home-province" value="" />
							<input type="hidden" name="home_phone"  id="home-phone" value="" />
							<input type="hidden" name="home_id"  id="home-id" value="" />
						</div>
						
						<?php 
						}
						
						?>

						<div id="act" style="display:none;">
							<button type="submit" class="btn btn-large btn-block btn-default"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
						</div>	
						<div id="noact">
							<a class="btn btn-large btn-block"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
						</div>	
						
						<br /><br />
						
						<div id="tabs">
							<ul class="tabs">  
								<li style="width:auto;"><a href="#tab1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
								<!--
								<li style="width:auto;"><a href="#tab2">&nbsp;&nbsp;&nbsp;Delivery Policy&nbsp;&nbsp;&nbsp;</a></li>
								<li style="width:auto;"><a href="#tab3">&nbsp;&nbsp;&nbsp;Substitution Policy&nbsp;&nbsp;&nbsp;</a></li>
								-->
							</ul>
							<div class="tab_container">	
								<div id="tab1" class="tab_content"> 
									<?php echo rightLang($product->product_description,$product->product_description_fr); ?>
								</div> 
								<!--
								<div id="tab2" class="tab_content">	 
									<?php
									foreach($product->delivery_policy as $dpol){                             
										echo rightLang($dpol->message_text,$dpol->message_text_fr);
									}
									?>
								</div>
								<div id="tab3" class="tab_content">	 
									<?php 
									foreach($product->substitution_policy as $spol){                             
										echo rightLang($spol->message_text,$spol->message_text_fr);
									} 
									?>
								</div>
								-->
							</div>
						</div>	

						<div class="clearfix"></div>

						

					</div>
					<div class="col-lg-1">
							
					</div>
					
				</div>

				
				
				</form>
				
			</div>
		</section>

	</section>
	<!--end wrapper-->
	
	
	
<?php include_once('footer_clava.php'); ?>
<script>
	$(document).ready(function(){
		var image = '<img src="/images/mf1-15b.jpg" style="width:250px;height:auto;"><br />';
		var tit = '<table width="100%"><tr><td width="50%">Ribbon Sample</td><td width="50%" align="right"><a href="javascript:;" onClick="closePop();"><i class="fa fa-times"></i></a></td></tr></table>';
		$('#popover').popover({placement: 'top', title: tit, content: image, html: true});
	});
	
	function closePop(){
		var myLink = document.getElementById('popover');
		myLink.click();
	}
</script>	
<script>

 $(function(){
 	'use strict';

 	$(".changepic").click(function(){
	          var prid = $(this).attr("id");
	          prid = prid(5)

	          alert(prid)
	})

	      $('input:radio[name="price_id"]').change(
	        function(){
	            if ($(this).is(':checked')) {
	                var id = $(this).attr("data-id");
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


 	$('#home').autocomplete({
	        	serviceUrl: '/products/fhomes',
   		forceFixPosition:true,
   		onSearchStart: function(){
   			$("#home").attr("style","background: url(/images/loader.gif) right center no-repeat;")
   		},
   		onSearchComplete: function() {
   			$("#home").removeAttr("style")
   		},
   		onSelect: function(suggestion) {
   			$("#home-name").val(suggestion.name)
		            $("#home-address").val(suggestion.address)
		            $("#home-postalcode").val(suggestion.postalcode)
		            $("#home-city").val(suggestion.city)
		            $("#home-province").val(suggestion.province)
		            $("#home-phone").val(suggestion.phone)
		            $("#home-id").val(suggestion.data)
   		}
	});
 })

</script>

<script> 

function upcoming_date(id){
	$("#delivery_date").val(id);

	if(id=='cal')
	{
		$('#myModal').modal('show');
		//document.getElementById('delidrop').style.display = 'none';
		document.getElementById('viewcale').style.display = 'block';
		
	}
	else
	{
		if(id!=''){
			$("#delivery_date").val(id);
        			$("#show_date").val(id); 
			document.getElementById('act').style.display = 'block';
			document.getElementById('noact').style.display = 'none';
		}else{
			
			document.getElementById('act').style.display = 'none';
			document.getElementById('noact').style.display = 'block';
		}
	}
}

function selectPrice(id){
	document.getElementById('price_se').innerHTML = id;
}

$(function() {   

     $("#ribbon-text").keyup(function(){
     	var charcount = $(this).val().length;
     	var maxchars = 35;

     	if(charcount > maxchars)
     	{
     		$(this).val($(this).val().substring(0,35))
     	}
     	else
     	{
     		$("#chars-left").html(maxchars - charcount)
     	}
     })
   

    $('.daypick').click(function(e){
        e.preventDefault();
        $('#myModal').modal('hide');
                    
        $("#special_delivery").removeAttr("checked");              
        $('.selected').removeClass('selected');
        $(this).addClass('selected');



        var dt = $(this).attr("id");
	
        $("#delivery_date").val($(this).attr('id'));
        $("#show_date").val($(this).attr('name')); 

        $("#upcoming").val($(this).attr('id'));
		
		//CALENDAR
		$("#upcoming option[value='cal']").remove();
		$("#upcoming").append('<option value="'+dt+'" selected="selected">'+$(this).attr('name')+'</option>');
		$("#upcoming").append('<option value="cal">View Calendar</option>');
		//CALENDAR
        if($(this).attr('class').slice(8,15)=='special')
        {
            $("#special_delivery").trigger('click');    
        }

	if(dt!=''){
		document.getElementById('act').style.display = 'block';
		document.getElementById('noact').style.display = 'none';
	}else{
		document.getElementById('act').style.display = 'none';
		document.getElementById('noact').style.display = 'block';
	}

    });

 });

</script>