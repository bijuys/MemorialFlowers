<div>
<ul class="nav nav-tabs" id="prodtabs">
<?php
    $count = 0;
    foreach($cartitems as $row) :
        $count++;
?>
    <li class="<?php if($count==1) { echo ' active'; } ?>"><a href="#itemtab-<?php echo $count;?>"  data-toggle="tab" id="tabclick<?php echo $count;?>"><?php echo 'Item #'.$count; ?></a></li>
<?php endforeach; ?>
</ul>
<div class="tab-content">
<?php
    $count = 0;
    foreach($cartitems as $row) :
        $count++;   
		
		
		//echo $count;
		//echo "<br>";
		//die;
		
		
		 
?>
<div id="itemtab-<?php echo $count; ?>" class="tab-pane<?php if($count==1) { echo ' active'; } ?>">
<div class="row-fluid">
    <div class="span8">
        <h4><?php echo lang('item_details');?></h4>
        <p><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" /></p>
        <p><strong><?php echo $row->product_name; ?> <br/>(<?php echo '#'.$row->product_code;?>)</strong> </p>  
    </div>
    <div class="span8">
        <h4><?php echo lang('Select a Delivery Date');?></h4>
        <input type="hidden" name="delivery_date[<?php echo $row->orderitem_id;?>]" id="delivery_date<?php echo $count;?>" value="" />
        <p><label for="datepicker"><?php echo lang('Delivery Date');?></label>
        <?php //echo $row->delivery_time; ?>
        <input type="text" name="datepicker[<?php echo $row->orderitem_id;?>]" id="datepicker<?php echo $count;?>" value="<?php echo $row->delivery_date;?>" />&nbsp;&nbsp;  
        </p>
        <p><label for="deliverytime"><?php echo lang('Delivery Time'); ?></label>
            <select name="deliverytime[<?php echo $row->orderitem_id;?>]" id="deliverytime<?php echo $count;?>">
                <?php /*for($t=6;$t<=23;$t++) :
                        for($m=0;$m<=45;$m=$m+30) :
                            $time = date(mktime($t,$m));?>                            
                            <!--<option value="<?php //echo date('h:ia',$time);?>" <?php //if(date('h:ia',$time)==$row->delivery_time){ echo 'selected="selected"'; } ?>><?php //echo date('h:ia',$time);?></option>-->
							
                <?php   endfor;
                      endfor; */?>
					  
					  
			<?php
			for($t=6;$t<=23;$t++) {
			
				for($m=0;$m<=45;$m=$m+30) { 
				
					$time = '';
					if($t < 10) {
							$time .= '0';
							}
							$time .= $t.':'.$m;
							if($m == 0) {
							$time .= '0';
							}
							$time .= ':00';
					?>
						<option value="<?php echo $time; ?>" <?php if($time == $row->delivery_time) { echo'selected="selected"'; } ?>><?php echo $time; ?></option>
						
				<?php				
				
				}
			
			}
			
			?>
					  
					  
            </select>
			<div style="width:260px;">
			<span style="color:#A02422;">Note: It is recommended to order with 3 hours prior the time expected</span>
			</div>
		</p>        
    </div>
    <div class="span8">
        <h4><?php echo lang('Delivery Details');?></h4>
        <p class="clearfix"><label for="businessname">Order PO</label><input type="text" name="businessname[<?php echo $row->orderitem_id;?>]" id="businessname<?php echo $count;?>" value="<?php echo $row->order_po;?>" /></p>
        <p class="clearfix"><label for="orderby">Order By</label><input type="text" name="orderby[<?php echo $row->orderitem_id;?>]" id="orderby<?php echo $count;?>" value="<?php echo $row->order_by;?>" /></p>
    </div>
</div>
<div class="row-fluid">

    <div class="span8 offset8">
      <label><?php echo lang('Card Message');?></label>
      <textarea name="message[<?php echo $row->orderitem_id;?>]" rows="10"><?php echo $row->card_message;?></textarea>        
      
    </div>
    <div class="span8">
      <label><?php echo lang('Note');?></label>
      <textarea name="specialnotes[<?php echo $row->orderitem_id;?>]" rows="10"><?php echo $row->special_note;?></textarea>                   
    </div>                
</div><!-- Row Fluid //-->
<div class="ribbon_text">
    <label class="radio inline"><?php echo lang('Ribbon Text');?> <?php echo lang('(Maximum 25 chars)');?> </label> <label class="radio inline">Ribbon Color:</label> <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="white" checked="checked" /> White</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="red" /> Red</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="blue" /> Blue</label> 
    <div class="ribbon-frame">
    <input type="text" name="ribbontext[<?php echo $row->orderitem_id;?>]" class="span24 ribbontxt" value="<?php echo $row->ribbon_text;?>" maxlength="25" placeholder="Click here and type your Ribben text" />
    </div> 







	
</div>
</div>
<?php endforeach; ?>
</div>
</div>





	
	
	
	
	


<script>
<!--

    $('#prodtabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })

//-->    
</script>