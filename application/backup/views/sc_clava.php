<?php
$yr = date('Y',time());
$mt = date('m',time());
$dy = date('d',time());

$mt = $mt-1;

$tday = $yr.', '.$mt.', '.$dy;

$js =<<<JS
<link href="%s/css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
JS;

$js = sprintf($js, theme_url(), theme_url());

 $dates = get_dates($product->delivery_method_id,10);
include_once('header.php'); 
?>
<?php $vaseID = $this->session->userdata('vaseID'); ?>
<div class="content">
    <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
             
    <div class="product-title"> <h1><?php echo ucwords(strtolower(rightLang($product->product_name,$product->product_name_fr)));?></h1></div>
    <?php  echo form_open_multipart(current_url()); ?>
    <div class="row-fluid" id="product-info">
    
	<div class="span8">
	    <div id="product-image" style="text-align:center;">
		<?php if($product->custom_vase==1) : ?>
		
		<div class="vasebg">
                    <img src="/images/vaseBG.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'z.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMG.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <img src="/productres/<?php echo $product->product_picture;?>" alt="<?php
echo $product->alternate_text;?>"  title="<?php echo $product->alternate_text;?>" />
                </div>
	
		<?php else : ?>
		<img src="/productres/<?php echo $product->product_picture;?>"
					alt="<?php echo $product->alternate_text;?>"
						   title="<?php echo $product->alternate_text;?>"/>
		<?php endif; ?>
	    </div>
	    <div id="product-description">
		<p style="text-align:center; font-weight:bold; color:#3299CC; font-size:18px;">Product Code: <?php echo $product->product_code;?></p>
		
		
		<br />
		
		
		
		
		
		
		
		
		
		
		
		
		
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		<div id="rel-tabs"  class="related-products clearfix">
	    <ul class="clearfix">                         
		<li><a href="#tb-1"><?php echo lang('Similar Products');?></a></li>
		<!-- <li><a href="#tb-2"><?php // echo lang('Category');?> - <?php // echo lang($product->category->category_name); ?></a></li> //-->
	    </ul>
	    <div id="tb-1">
			
			<div class="clearfix" style="margin-left:-15px; width:550px;;">
    
			    <?php foreach($sameitems as $row) : ?>
		   
			    <?php $upath =$row->category_name . '/'; ?>
						 
				<div class="product-item" style="width:80px; margin-top:-5px;">
				     <center>
				       <div class="item" style="margin-right:0px; width:100%; padding: 0px -30px 0px 0px;">
					<a href="/<?php echo $upath.$row->url;?>" class="im">
                    
                     <img src="<?php echo'/productres/'.$row->product_picture;?>" height="60px" width="80px"  alt="<?php
		   echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  /></a>
           
           
           
                    <!--<img src="<?php //echo img_resized('/productres/'.$row->product_picture, '120x100');?>" alt="<?php
		   //echo $row->alternate_text;?>"  title="<?php //echo $row->alternate_text;?>"  /></a>-->
					<!--<a class="product-name" href="/<?php //echo $upath.$row->url;?>"><?php //echo rightLang($row->product_name,$row->product_name_fr); ?></a>-->
					<br />
					<span class="oprice"></span><?php echo getRate($row->price_value);?><br />
					<span class="shopnow"><a href="/<?php echo $upath.$row->url;?>"><img border="0" width="120" height="35" src="<?php echo theme_url();?>/images/<?php echo imgLang('shopnow59x16-LN.gif');?>" alt="<?php echo lang('Shop Now');?>"/></a></span>
				   
				<!--	<br />
					<img border="0" align="left" width="178" height="10" class="dtype" src="<?php //echo theme_url();?>/images/<?php //echo imgLang('samedayfloristdelivery-LN.gif');?>" alt="<?php //echo lang('Same day florist delviery');?>"/>-->
				   
					</div><!-- Item //-->
				   </center>
				</div><!-- Product-Item //-->
				   
				   
			    <?php endforeach; ?>
		    
			</div>
		    
	    </div><!-- Tab1 //-->
	</div><!-- Tabs //-->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		 
	    </div> 
	    
	</div>
	
	
	<!-- Left Column Span8 //-->
	<div class="span16">	 
	    <div class="order-info">
		<div class="row-fluid">
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		    <div class="span12" style="width:426px;">
			
			
			
			
			
			
			<div class="product-delivery-info clearfix">                     
		    <div id="tabs" class="clearfix">
			<ul class="clearfix">   
			    <li><a href="#tab-0"><?php echo lang('Contents');?></a></li>                      
			    <li><a href="#tab-1"><?php echo lang('Delivery Policy');?></a></li>
			    <li><a href="#tab-2"><?php echo lang('Substitution Policy');?></a></li>
			</ul>
	 
			<div id="tab-0">
	
			 <?php
				echo rightLang($product->product_description,$product->product_description_fr);
					
			 ?>
			</div>
			<div id="tab-1">
	
			 <?php
					foreach($product->delivery_policy as $dpol) 
					{                             
						echo '<p>'.rightLang($dpol->message_text,$dpol->message_text_fr).'</p>';
					}
			 ?>
			</div>
			<div id="tab-2">
			<?php foreach($product->substitution_policy as $spol) 
				 {                             
					echo '<p>'.rightLang($spol->message_text,$spol->message_text_fr).'</p>';
	
				 } ?>
			</div>                     
		    </div>                     
		    <div class="clear" /></div>
		</div><!-- Product Delivery Info //-->
			
			
			
			<br />
			
			<!--
			<?php if(count($product->addons)) { ?>
			<h4>Add to your Order <em>(Optional)</em></h4>
			<div id="addons" class="clearfix">
			    <?php foreach($product->addons as $add) { ?>
			    <div class="addonbox">
				<img src="<?php echo img_format('productres/'.$add->addon_picture,'macro');?>" alt="<?php echo $add->addon_name;?>" align="left" class="img-polaroid" />
				<ul class="addon_details">	
				<span class="lead"><?php echo $add->addon_name;?></span>
				<li>
				<select name="option[<?php echo $add->addon_id;?>]" class="seladdon" style="width:180px;" id="seladdon<?php echo $add->addon_id;?>">
				    <?php if(count($add->prices)) :
						foreach($add->prices as $prc) :
				    ?>
					<option value="<?php echo $prc->addonprice_id;?>"><?php echo $prc->description;?> - <?php echo getRate($prc->price);?></option>
				    <?php 
						endforeach;
					    endif; ?>
				</select>
				<div class="input-prepend">
				    <span class="add-on">Add</span>
				    <input type="text" class="span10" name="addon[<?php echo $add->addon_id;?>]" size="4" value="<?php echo is_floral_basket($product->product_id) ? $add->default:'0';?>" id="addon<?php echo $add->addon_id;?>" />
				</div>

				</li>
				</ul>
			    </div>
			    <?php } ?>
			</div><!-- Addons //-->
			<?php } ?>  
			
			
			
			
		    </div><!-- Span10 //-->
			
			
			
		    <div class="span12" style="background-color:#E8E8E8; padding: 20px 0px 0px 20px; color:#575757; width:300px;">
			
			
			
			
			
			
			
			<p class="lead text-success" style="font-size:40px; text-align:right; padding-right:20px; color:#363636;"><strong><?php echo getRate($product->prices[0]->price_value-($product->prices[0]->price_value*$this->session->userdata('disco')));?></strong></p>
			<h4><?php echo lang('Choose Size')?></h4>
			<ul class="product-options">
			<?php
				$ct = 0;
				foreach($product->prices as $prc) {
				    $ct++;                               ?>
			<li>
				
			    <label for="price_<?php echo $prc->price_id;?>" class="radio">
				<input type="radio" name="price_id" id="price_<?php echo $prc->price_id;?>" value="<?php echo $prc->price_id; ?>" <?php echo $ct==1 ? 'checked="checked"':'';?> /> <strong><?php echo lang($prc->price_name); ?></strong> (<?php echo getRate($prc->price_value-($prc->price_value*$this->session->userdata('disco')));?>)</label></li>
			    <?php } ?>
			</ul><!-- Product Options //-->
			    
			<div id="selddates">
			    <h4><?php echo lang('Please select a delivery date');?></h4>
			    
			   <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>" />
			   <input type="hidden" name="category" value="<?php echo $category;?>" />
			    <div style="margin: 10px 0; vertical-align:middle;" class="sowcal">
			    <?php echo form_error('delivery_date'); ?>
			    <select name="upcoming" id="upcoming" onchange="upcoming_date(this.value);" style="width:185px; vertical-align:top;">
				<option value=""><?php echo lang('Choose delivery date');?></option>
				<?php $dates = get_dates($product->delivery_method_id,10);
					foreach($dates as $day) { ?>
				    <option value="<?php echo date('d-m-Y',strtotime($day)); ?>"><?php echo date('l, d F',strtotime($day));?></option>
				<?php   } ?>
				<optgroup label="....................................." class="vical"></optgroup>
				<option value="cal"><?php echo lang('View calendar');?></option>
			    </select>
			    <a href="#calendar" name="datepick" id="datepick"><img src="/templates/default/images/cal.gif"/></a>
			    <input type="hidden" id="delivery_date" name="delivery_date" value="" />
			    </div>
			</div><!-- Sel Dates //-->
				
			
			
			
			
			
			
			    
			<?php if($product->delivery_method_id==1) : ?>
			    
			    <div id="shipped-giftbox">
				<img src="<?php echo theme_url();?>/images/<?php echo imgLang('sameday-delivery-LN.png');?>" alt="<?php echo lang('Same day delivery');?>" /> 
			    </div> <!-- Giftbox //-->
			
			<?php else : ?>
			
			    <div id="shipped-giftbox">
				<img src="<?php echo theme_url();?>/images/<?php echo imgLang('giftbox-delivery-LN.png');?>" alt="<?php echo lang('Gift box delivery');?>" /> 
			    </div><!-- Giftbox //-->
			    
			<?php endif; ?>
			
			<?php if(($product->delivery_method_id==2) && (get_stoppage_time(1)>=time())) { ?>
				
			    <div class="makesameday">
				<label class="checkbox"><?php echo lang('Deliver it Today for <big>$10</big> extra'); ?>.			
				<input type="checkbox" name="special_delivery" value="1" id="special_delivery" /></label>
			       
				<p id="sameday-policy" style="display:none"><small><a href="http://www.memorialflowers.ca/shipping-policy.html">Same day Shipping Policy</a></small></p>                    
			    </div><!-- Make Sameday //-->
			     
			<?php } ?>
			<br />
			
			<p class="showing_date"><label><?php echo lang('Delivery');?>: <input type="text" id="show_date" readonly  size="30" style="background:transparent; border: none; box-shadow: none; font-size:20px; font-weight:bold;" value="" /></label></p>
			     
			<p><input type="submit" value="<?php echo lang('Add to Cart');?>" name="addtocart" id="addtocart" class="btn-large btn-inverse" /> </p>
				
			
			
			
			<br />
			

		    </div> <!-- Span6 //-->
		    
		</div><!-- Row Fluid ends //-->
	    </div><!-- Order Info //-->
		
	    
		
	</div><!-- Order Info //-->
	
	    <div class="pull-left" id="delivery-info">
		
	    </div>
	    
	</div><!-- Middle Column Span17 //-->
    
    </div><!-- End of Product Info Row-Fluid //-->

    <div class="row-fluid"><!-- Starts a new row //-->
	
	
	
	
	
	
	
	
	
	
	
	
	
    </div><!-- Row Fluid //-->

    <div id="calendarwrap">
		   
    <!-- #customize your modal window here -->
    
    <div id="calendar" class="window modalwin">
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
	<a href="#" class="close">X <img src="<?php echo theme_url().'/images/close-button.png';?>" alt="<?php echo lang('Close');?>" /></a>
    
    </div><!-- End of Calendar //-->
    <!-- Do not remove div#mask, because you'll need it to fill the whole screen --> 
    
    </div><!-- Calendar Wrap //-->

<script>                         // perform JavaScript after the document is scriptable.

$(function() {                             // setup ul.to work as tabs for each div directly under div.panes

	$("#tabs").tabs();
        $("#rel-tabs").tabs();
        
    $('.seladdon').click(function(){
        var id = $(this).attr("id");
        
        id = id.slice(8);
        $("#addon"+id).val(1);
        
    });

//select all the a tag with name equal to modal
    $('#datepick').click(function(e) {
        //Cancel the link behavior
        e.preventDefault();
        //Get the A tag
        var id = $(this).attr('href');
     
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
     
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight,'top':'0px','left':'0px'});
         
        //transition effect     
        $('#mask').fadeIn(1000);    
        $('#mask').fadeTo("slow",0.8);  
     
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
               
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
     
        //transition effect
        $(id).fadeIn(2000); 
     
    });
     
    //if close button is clicked
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();
        $('#mask, .window').hide();
    });     
     
    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });


    $("#special_delivery").change(function(){
                
        if($(this).is(':checked'))
        {
            $('#selddates').css('display','none');
            $("#show_date").val('Today');
            $("#delivery_date").val('');
            $("#upcoming").val('Today');
	    $("#sameday-policy").attr("style","display:block;");
        }
        else
        {
            $('#selddates').css('display','block');
            $("#show_date").val('');
            $('.selected').removeClass('selected');
            $("#delivery_date").val('');
            $("#show_date").val(''); 
            $("#upcoming").val('');
	    $("#sameday-policy").attr("style","display:none;");
        }

    });
    
    
    
     $(".datelink").click(function(e){
     
        e.preventDefault();
    
        var thisval = $(this).attr("name");
        var thistext = $(this).html();
        
        $("#delivery_date").val(thisval);
        $("#show_date").val(thistext);
        $('.selected').removeClass('selected');
        $("#"+thisval).addClass('selected');
        $("#upcoming").val(thisval);

    });


    
    
    
    $("#upcoming").change(function(){
        $("#special_delivery").removeAttr("checked");                
        var date = $("#upcoming :selected").val();

        if(date =='cal'){
                $('#datepick').trigger("click");
        }
        else if(date =='')
        {
        
        }
        else{
        
            var selected = $("#upcoming :selected").val();
            
            $("#delivery_date").val($("#upcoming :selected").val());
            $("#show_date").val($("#upcoming :selected").html());
            $('.selected').removeClass('selected');
            $("#"+selected).addClass('selected');
        }

    });

    $('.daypick').click(function(e){

        e.preventDefault();

                    
        $("#special_delivery").removeAttr("checked");              
        $('.selected').removeClass('selected');
        $(this).addClass('selected');
        $("#delivery_date").val($(this).attr('id'));
        $("#show_date").val($(this).attr('name'));
	
	if(optionExists($(this).attr('id')))
	{
	    
	}
	else
	{
	    var sid = $(this).attr('id');
	    var name = $(this).attr('name');
	    $('<option>').val(sid).text(name).insertAfter('.vical');
	}
	
	

        $("#upcoming").val($(this).attr('id'));
        
        if($(this).attr('class').slice(8,15)=='special')
        {
            $("#special_delivery").trigger('click');    
        }

        $('#mask, .window').hide();
        

    });
    
    function optionExists(val) {
	$("#upcoming option").filter(function() {
           return this.value === val;
	}).length !== 0;
    }
        

});


</script>

</div><!-- Content //-->
	
<?php echo form_close(); ?>
<?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
<?php include_once('footer.php'); ?>
       