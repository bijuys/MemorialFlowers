<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  
  


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){
        $(".slidingDiv").hide();
        $(".show_hide").show();
    $('.show_hide').click(function(){
		
		if ( $("#discount_type").val() == "certificate"){
 
			 $(".slidingDiv").slideToggle();
 
		}else{
			
			 $(".slidingDiv").hide();
			}
   
    });
});
</script>

<style type="text/css">
.slidingDiv {
    height:320px;
	width:340px;
    background-color: #C5E3BF;
    padding:20px;
    margin-top:10px;
    borderm:3px solid #228B22;
}

.show_hide {
    display:none;
}
 </style>



  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Discount</h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Discount Info</th>
        </tr>
        
        <tr>
          <td class="label" width="50%" valign="top">Discount Type</td>
          <td width="50%">
            <select name="discount_type" id="discount_type">
              <option value="discount" <?php echo set_select('discount_type','discount',isset($discount) && $discount->discount_type=='discount' ? TRUE:FALSE);?> disabled="disabled">Discount</option>
              <option value="coupon" <?php echo set_select('discount_type','coupon',isset($discount) && $discount->discount_type=='coupon' ? TRUE:FALSE);?>>Coupon</option>
              <option value="certificate" <?php echo set_select('discount_type','certificate',isset($discount) && $discount->discount_type=='certificate' ? TRUE:FALSE);?>>Gift Certificate</option>
            </select>
            <span style="color:#FF0000;"> * Discounts type function deactivated for now !</span><br /><br />
   
   			<a href="#" class="show_hide">Add Customer Info</a>
			<div class="slidingDiv">
            
            
            <table>
         <tr>
          <td class="label" width="50%">Customer First Name</td>
          <td width="50%"><input name="custo_first" type="text" id="custo_first" value="<?php echo set_value('custo_first',$_POST ? $_POST['custo_first']:(isset($discount) ? $discount->discount_firstname:''));?>" /></td>
        </tr>
         <tr>
          <td class="label" width="50%">Customer Last Name</td>
          <td width="50%"><input name="custo_last" type="text" id="custo_last" value="<?php echo set_value('custo_last',$_POST ? $_POST['custo_last']:(isset($discount) ? $discount->discount_lastname:''));?>" /></td>
        </tr>
         <tr>
          <td class="label" width="50%">Discount Previous Order</td>
          <td width="50%"><input name="disc_pre_or" type="text" id="disc_pre_or" value="<?php echo set_value('disc_pre_or',$_POST ? $_POST['disc_pre_or']:(isset($discount) ? $discount->discount_orderfix:''));?>" /></td>
        </tr>
         <tr>
          <td class="label" width="50%">Discount Reason</td>
          <td width="50%"><textarea rows="10" cols="20" name="disc_reason" type="text" id="disc_reason" />
            <?php echo set_value('disc_reason',$_POST ? $_POST['disc_reason']:(isset($discount) ? $discount->discount_reason:''));?>            </textarea></td>
        </tr>
       
        </table>
				  
            
            <br />
            	
             <a href="#" class="show_hide">hide</a>
            </div>

            
          
          </td>
        </tr>
        
        
      
        
        
        
        <tr>
          <td class="label" width="50%">Discount Name/Coupon Code</td>
          <td width="50%"><input name="discount_name" type="text" id="discount_name" value="<?php echo set_value('discount_name',$_POST ? $_POST['discount_name']:(isset($discount) ? $discount->discount_name:''));?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Discount Value</td>
          <td width="50%"><input name="discount_value" size="5" type="text" id="discount_value" value="<?php
          echo set_value('discount_value',$_POST ? $_POST['discount_value']:isset($discount) ? ($discount->discount_amount>0 ? $discount->discount_amount:$discount->discount_percentage):'0');
          ?>" />
          <select name="discount_value_type">
            <option value="$" <?php echo set_select('discount_value_type','$',isset($discount) && $discount->discount_amount>0 ? TRUE:FALSE);?>>$</option>
            <option value="%" <?php echo set_select('discount_value_type','%',isset($discount) && $discount->discount_percentage>0 ? TRUE:FALSE);?>>%</option>
          </select>
          </td>
        </tr>
        <tr>
          <td class="label" width="50%">Limit usage by</td>
          <td width="50%"><input name="discount_limit" size="5" type="text" id="discount_limit" value="<?php echo set_value('discount_limit',isset($discount) ? $discount->discount_limit:'0'); ?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Minimum Purchase</td>
          <td width="50%"><input name="discount_minimum" size="5" type="text" id="discount_minimum" value="<?php echo set_value('discount_minimum',isset($discount) ? $discount->discount_minimum:'0'); ?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Start Date</td>
          <td width="50%">
            <select name="sday">
              <?php for($i=1;$i<=31;$i++) { ?>
              <option value="<?php echo sprintf("%02d",$i);?>" <?php echo set_select('sday',sprintf("%02d",$i),isset($sday) && $sday==sprintf("%02d",$i) ? TRUE:FALSE);?>><?php echo sprintf("%02d",$i);?></option>
              <?php } ?>
            </select>
            <select name="smonth">
              <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo sprintf("%02d",$i); ?>" <?php echo set_select('smonth',sprintf("%02d",$i),isset($smonth) && $smonth==sprintf("%02d",$i) ? TRUE:FALSE);?>><?php echo date('M',mkdate(2010,$i,1));?></option>
              <?php } ?>
            </select>
            <select name="syear">
              <?php for($i=date('Y',time());$i<=date('Y',time()+(60*60*24*365*3));$i++) { ?>
              <option value="<?php echo $i;?>" <?php echo set_select('syear',$i,isset($syear) && $syear==$i ? TRUE:FALSE);?>><?php echo $i;?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="label" width="50%">Expiry Date</td>
          <td width="50%">
            <select name="day">
              <?php for($i=1;$i<=31;$i++) { ?>
              <option value="<?php echo sprintf("%02d",$i);?>" <?php echo set_select('day',sprintf("%02d",$i),isset($day) && $day==sprintf("%02d",$i) ? TRUE:FALSE);?>><?php echo sprintf("%02d",$i);?></option>
              <?php } ?>
            </select>
            <select name="month">
              <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo sprintf("%02d",$i); ?>" <?php echo set_select('month',sprintf("%02d",$i),isset($month) && $month==sprintf("%02d",$i) ? TRUE:FALSE);?>><?php echo date('M',mkdate(2010,$i,1));?></option>
              <?php } ?>
            </select>
            <select name="year">
              <?php for($i=date('Y',time());$i<=date('Y',time()+(60*60*24*365*3));$i++) { ?>
              <option value="<?php echo $i;?>" <?php echo set_select('year',$i,isset($year) && $year==$i ? TRUE:FALSE);?>><?php echo $i;?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td class="label" width="50%">Available to All?</td>
          <td width="50%"><input type="checkbox" name="discount_availability" value="1" <?php echo set_checkbox('discount_availability','1',TRUE);?> /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="discount_id" type="hidden" id="discount_id" value="<?php echo set_value('discount_id',isset($discount)?$discount->discount_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="Next" /></td>
        </tr>
      </table>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/discounts" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>