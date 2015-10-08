<?php
$yr = date('Y',time());
$mt = date('m',time());
$dy = date('d',time());

$mt = $mt-1;

$tday = $yr.', '.$mt.', '.$dy;

?>
<?php 

$js =<<<JS
<script src="/js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript">
	
	$(function(){
        
                   
                $("#special_delivery").click(function(){
                
                    if($(this).is(':checked'))
                    {
                        $('#selddates').css('display','none');
                        $("#show_date").val('Today');
                    }
                    else
                    {
                        $('#selddates').css('display','block');
                        $("#show_date").val('');
                    }

                });  
	
		var disabledDays = ['12-23-2011','12-24-2011','12-25-2011','12-26-2011','12-27-2011','12-28-2011','12-31-2011','1-1-2012','1-2-2012','1-3-2012'];
		
		function disabledDates(date) {
		//$('#deliveryerror').html('');
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
		
			var isWeekend = businessCalendar(date);
		
			if(isWeekend=='false'){
		
				return [false];
			}
		
			for (i = 0; i < disabledDays.length; i++) {
		
				if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1) {
		
					return [false];
		
				}
		
			}
		
			return [true];
		
		}
		
		function businessCalendar(date) {
		
			var day = date.getDay();
			var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
		
			//Below disables every Saturday =6, Sunday =0, Monday =1
		
			if( ((day == 0) || (day == 6) || (day == 1)) ){
		
				return [false];
		
			}
		
			else{
		
				return[true];
		
			}
		
		}
	
		$('#delivery_date').datepicker({
			buttonImage: '%s/images/cal.gif',
			buttonImageOnly: true,
			showOn: 'both',			
			altField: "#show_date",
			altFormat: "DD, d MM",
			dateFormat: 'dd-mm-yy',
			numberOfMonths: [2, 1],	changeMonth:true,firstDay:1,			
			beforeShowDay: disabledDates, 		
			maxDate: '+1y',					
			//Set first selectable date based on cutoff and lead date
			//Month starts at 0
			minDate: new Date({$tday})
		});
                


	
	});
	
	function upcoming_date(date){

		if(date =='cal'){
			$('#delivery_date').datepicker( "show" );
		}				
		else if(date =='')
		{
		
		}
		else{
			document.getElementById('delivery_date').value = date;
			document.getElementById('deliverydate').value = document.getElementById('delivery_date').value;
		}
                
		$("#upcoming").val(date);
		$('#delivery_date').datepicker( "setDate" , date );

	}	

</script>
<link href="%s/css/smoothness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
JS;

$js = sprintf($js, theme_url(), theme_url());

 ?> <?php 
 $dates = get_dates($product->delivery_method_id,10);
include_once('header.php'); 
?> 
<div id="main">     
<div id="product" class="clearfix">        
<?php  echo form_open_multipart(current_url()); ?>
<div class="col-left clearfix">             <div class="product-image">
<img src="/productres/<?php echo $product->product_picture;?>"  alt="<?php
echo $product->alternate_text;?>"   title="<?php echo
$product->alternate_text;?>" />
</div><!-- Product Image //-->               

<div class="product-delivery-info clearfix">                     
	<div id="tabs" class="clearfix">
		<ul class="clearfix">   
        	<li><a href="#tab-0"><?php echo lang('Contents');?></a></li>                      
			<li><a href="#tab-1"><?php echo lang('Delivery Policy');?></a></li>
			<li><a href="#tab-2"><?php echo lang('Substitution Policy');?></a></li>
		</ul>
                
               
 		<div id="tab-0">

		 <?php
			echo rightLang($product->contents,$product->contents_fr);
				
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
</div><!-- Column Left //-->                     
<div class="col-right clearfix">
<div class="details-wrapper clearfix">
    <div class="product-info clearfix">
<h2><?php echo ucwords(strtolower(rightLang($product->product_name,$product->product_name_fr)));?></h2>
<span class="header-description"><strong><?php echo lang('Product code');?>:</strong>
<?php echo $product->product_code;?>
</span>
<?php echo rightLang($product->product_description,$product->product_description_fr);?>
</div><!-- Product Info //-->
<div class="order-info">
    <div class="wrapper">
        <h1><?php echo getRate($product->prices[0]->price_value);?></h1>
<p><strong><?php echo lang('Choose Size')?></strong></p>
<ul>
<?php
        $ct = 0;
        foreach($product->prices as $prc) {
            $ct++;
            
?>
                    <li>
                            
                        <label for="price_<?php echo $prc->price_id;?>"><input type="radio" name="price_id" id="price_<?php echo $prc->price_id;?>" value="<?php echo $prc->price_id;?>" <?php echo $ct==1 ? 'checked="checked"':'';?> /> <strong><?php echo lang($prc->price_name); ?></strong> (<?php echo getRate($prc->price_value);?>)</label></li>
                        <?php } ?>
                    </ul>  
                    <div id="selddates">
                    <p><strong><?php echo lang('Please select a delivery date');?></strong></p>
                    
		   <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>" />
                    <div style="margin: 10px 0; vertical-align:middle;" class="sowcal">
                    <?php echo form_error('delivery_date'); ?>
                    <select name="upcoming" id="upcoming"  onchange="upcoming_date(this.value);" style="width:170px; vertical-align:text-middle;">
                    	<option value=""><?php echo lang('Choose delivery date');?></option>
                        <?php $dates = get_dates($product->delivery_method_id,6);
                                foreach($dates as $day) { ?>
                            <option value="<?php echo date('d-m-Y',strtotime($day)); ?>"><?php echo date('l, d F',strtotime($day));?></option>
                        <?php   } ?>
                        <option value="cal"><?php echo lang('View calendar');?></option>
                    </select>
                    <input type="hidden" id="postalcode" name="postalcode" />
                    <input type="hidden" id="delivery_date" name="delivery_date" readonly="readonly" style="position:relative; vertical-align:middle;"/>                  
                    <input type="hidden" id="deliverydate" name="deliverydate" value="" />
                    </div>
                    
                    <p><strong><?php echo lang('Upcoming Delivery dates');?></strong></p>
                    <div id="upcoming_dates"> 
                    <?php  for($i=0;$i<=2;$i++) : ?>
                     	<a href="#" onclick="javascript:upcoming_date('<?php echo date('d-m-Y',strtotime($dates[$i])); ?>')"> <?php echo lang(date('l',strtotime($dates[$i])));?>, <?php echo date('d',strtotime($dates[$i]));?> <?php echo lang(date('F',strtotime($dates[$i])));?></a> | 
                        <?php   endfor; ?>
                    </div>
                    </div>
                    <?php if($product->delivery_method_id==2) : ?>
                    <div class="makesameday">
                        
                        <input type="checkbox" name="special_delivery" value="1" id="special_delivery" /><br/>
                       
                        Deliver it Today for <big>$10</big> extra.
                                                
                    </div>
                    <?php endif; ?>
                    <p><strong><?php echo lang('Delivery');?>:</strong> <input type="text" id="show_date" readonly="readonly" size="30" style="background:transparent; border: none;" /></p>
                     <?php if(count($addons)) { ?>
                        <strong>Add to your Order</strong> <em>(Optional)</em>
                        <div id="addons" class="clearfix">
                    <?php
                          foreach($addons as $add) { ?>
                        <p><img src="<?php echo img_format('productres/'.$add->addon_picture,'macro');?>" align="left" />
                            <?php echo $add->addon_name;?><br />
                            <small>Price:</small> <?php echo '<strong>$'.number_format($add->price,2).'</strong>';?><br />
                            <small>Add <input type="text" name="addon[<?php echo $add->addon_id;?>]" size="4" value="0" id="addon<?php echo $add->addon_id;?>" /></small>
                        </p>
                    <?php } ?>
                        </div>
                    <?php
                    } ?>
                    <p>
                    <input type="submit" value="<?php echo lang('Add to Cart');?>" name="addtocart" id="addtocart" class="addbutton" />
                    </p>
                    </div>     
                </div><!-- Order Info //-->   
            </div><!-- Details wrapper //-->
            <div>
                
            <div id="rel-tabs"  class="related-products clearfix">
		<ul class="clearfix">                         
			<li><a href="#tb-1"><?php echo lang('Related Products');?></a></li>
			<!-- <li><a href="#tb-2"><?php // echo lang('Category');?> - <?php // echo lang($product->category->category_name); ?></a></li> //-->
		</ul>
		<div id="tb-1">
                    
                    <div class="clearfix">

		 <?php foreach($product->related as $row) : ?>
                              
                <div class="product-item">
                  <center>
                    <div class="item">
                  <a href="/<?php echo $row->url;?>" class="im"><img src="<?php echo img_resized('productres/'.$row->product_picture, '120x100');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  /></a>
                    <a class="product-name" href="/<?php echo $row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a>
                    <br />
                    <span class="oprice"></span><?php echo getRate($row->price_value);?><br />
                <span class="shopnow"><a href="/<?php echo $row->url;?>"><img border="0" width="59" height="16" src="<?php echo theme_url();?>/images/<?php echo imgLang('shopnow59x16-LN.gif');?>"/></a></span>
                
                <br />
                <img border="0" align="left" width="178" height="10" class="dtype" src="<?php echo theme_url();?>/images/<?php echo imgLang('samedayfloristdelivery-LN.gif');?>"/>
                
                </div><!-- Item //-->
                </center>
                </div><!-- Product-Item //-->
                
                
                <?php endforeach; ?>
                
                    </div>
                
		</div>
                <!-- // 
		<div id="tb-2">
		       <h3><?php // echo $product->category->category_name; ?></h3>
               <p><?php // echo $product->category->description; ?></p>
		</div>
                //-->
            </div>
            
            <script>                         // perform JavaScript after the document is scriptable.

$(function() {                             // setup ul.to work as tabs for each div directly under div.panes
	$("#tabs").tabs();
        $("#rel-tabs").tabs();
});


</script>


        </div><!-- Right Column //-->   
        <div class="clear"></div>   
        
                    <?php echo form_close(); ?>  
                    
            </div> <!-- product -->
  <div class="clear" /></div>
</div>
<?php include_once('footer.php'); ?>
       