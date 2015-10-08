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
    <h2><?php echo $action; ?> Social Media Deal</h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Discount Info</th>
        </tr>
        
        <tr>
          <td class="label" width="50%" valign="top">Social Media Company</td>
          <td width="50%">
            <select name="socialdeal_company" id="discount_type">
              <option value="TeamBuy" <?php echo set_select('socialdeal_company','TeamBuy',isset($deal) && $deal->socialdeal_company=='TeamBuy' ? TRUE:FALSE);?>>TeamBuy</option>
              <option value="Buytopia" <?php echo set_select('socialdeal_company','Buytopia',isset($deal) && $deal->socialdeal_company=='Buytopia' ? TRUE:FALSE);?>>Buytopia</option>
              <option value="Dealfine" <?php echo set_select('socialdeal_company','Dealfine',isset($deal) && $deal->socialdeal_company=='Dealfine' ? TRUE:FALSE);?>>Dealfine</option>
            </select>
            
          </td>
        </tr>
        
        
      
        
        
        
        <tr>
          <td class="label" width="50%">Social Deal Name</td>
          <td width="50%"><input name="socialdeal_name" type="text" id="socialdeal_name" value="<?php echo set_value('socialdeal_name',$_POST ? $_POST['socialdeal_name']:(isset($deal) ? $deal->socialdeal_name:''));?>" /></td>
        </tr>
        <tr>
          <td class="label" width="50%">Coupons Value $</td>
          <td width="50%"><input name="socialdeal_amount" size="5" type="text" id="socialdeal_amount" value="<?php echo set_value('socialdeal_amount',isset($deal) ? $deal->socialdeal_amount:'0'); ?>" /></td>
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
          <td class="label" width="50%">Activate Deal?</td>
          <td width="50%"><input type="checkbox" name="socialdeal_status" value="1" <?php echo set_checkbox('socialdeal_status','1',TRUE);?> /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="socialdeal_id" type="hidden" id="socialdeal_id" value="<?php echo set_value('socialdeal_id',isset($deal)?$deal->socialdeal_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="Next" /></td>
        </tr>
      </table>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/discounts" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>