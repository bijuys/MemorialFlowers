

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
					
						<option value="">Select</option>
                <?php /*for($t=6;$t<=23;$t++) :
                        for($m=0;$m<=45;$m=$m+30) :
                            $time = date(mktime($t,$m));?>                            
                            <!--<option value="<?php //echo date('h:ia',$time);?>" <?php //if(date('h:ia',$time)==$row->delivery_time){ echo 'selected="selected"'; } ?>><?php //echo date('h:ia',$time);?></option>-->
							
                <?php   endfor;
                      endfor; */?>
					  
					  
			<?php
			for($t=7;$t<=11;$t++) {
			
				
				$time = $t.'am';
			
					/*		$time .= $t;
							if($m == 0) {
							$time .= '0';
							}
							$time .= ':00';*/
					?>
						<option value="<?php echo $time; ?>" <?php if($time == $row->delivery_time) { echo'selected="selected"'; } ?>><?php echo $time; ?></option>
						
				<?php				
				
				//}
			
			}
			
			?>
			<option value="12pm" <?php if('12pm' == $row->delivery_time) { echo'selected="selected"'; } ?>>12pm</option>
			<?php
			for($t=1;$t<=11;$t++) {
			
				
				$time = $t.'pm';
			
					/*		$time .= $t;
							if($m == 0) {
							$time .= '0';
							}
							$time .= ':00';*/
					?>
						<option value="<?php echo $time; ?>" <?php if($time == $row->delivery_time) { echo'selected="selected"'; } ?>><?php echo $time; ?></option>
						
				<?php				
				
				//}
			
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
   				 <label class="radio inline">Ribbon Color:</label>
				 <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="No Ribbon" checked="checked" /> No ribbon</label>
    			 <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Match" /> Match With Item</label>
                  <label class="radio inline"> <input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="White" /> White</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Red" /> Red</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Blue" /> Blue</label> 
                
                
              
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Pink" /> Pink</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Yellow" /> Yellow</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                 <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Dark Blue" /> Dark Blue</label> 
                
                
               <label class="radio inline"> <input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Peach"  /> Peach</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Purple" /> Purple</label>
                <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Burgundy" /> Burgundy</label> 
                 <label class="radio inline"><input type="radio" name="ribbon_color[<?php echo $row->orderitem_id;?>]" value="Lavender" /> Lavender</label> 
                
                <br />
                 <label class="radio inline"><?php echo lang('Ribbon Text');?> <?php echo lang('(Maximum 25 chars)');?> </label>
                
                
                
    <div class="ribbon-frame">
    <input type="text" id="ribbontext<?php echo $count;?>" name="ribbontext[<?php echo $row->orderitem_id;?>]" class="span24 ribbontxt" value="<?php echo $row->ribbon_text;?>" maxlength="25" placeholder="Click here and type your Ribben text" />
    </div> 







	
</div>
</div>
<input type="hidden" name="rb" id="rb<?php echo $count;?>" value="<?php echo $row->orderitem_id;?>" />
<?php endforeach; ?>
<input type="hidden" name="dt_count" id="datepicker_count" value="<?php echo $count;?>" />
</div>
</div>





	
	
	
	
	


<script>
<!--

    $('#prodtabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })

//-->    
