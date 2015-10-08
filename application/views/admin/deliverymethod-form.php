<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Delivery Method</h2>
    <?=form_open_multipart(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Delivery Method Info</th>
        </tr>
        <tr>
          <td width="50%" class="label">Delivery Method</td>
          <td width="50%"><input type="text" name="delivery_method" id="delivery_method" value="<?php echo set_value('delivery_method',isset($deliverymethod)?$deliverymethod->delivery_method:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Description</td>
          <td>
	    <div id="description-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($deliverymethod) ? $deliverymethod->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($deliverymethod) ? $deliverymethod->description_fr:''); ?></textarea>
              </div>
            </div>
	        </td>
        </tr>
        <tr>
          <td width="50%" class="label">Info Text</td>
          <td width="50%"><input type="text" name="infotext" id="infotext" value="<?php echo set_value('infotext',isset($deliverymethod) ? $deliverymethod->infotext:''); ?>" /></td>
        </tr>
        <tr>
          <td class="label">Delivery in</td>
          <td>
          <select name="delivery_within" id="delivery_within">
          <?php 
	      $dwn = $deliverymethod ? $deliverymethod->delivery_within:set_value('delivery_within');
	      for($i=0;$i<=30;$i++) { ?>
	      <option value="<?php echo $i;?>" <?php echo $dwn==$i ? 'selected="selected"':''; ?>><?php echo $i;?></option>
          <?php } ?>
          </select>
           day(s)</td>
        </tr>
        <tr>
          <td class="label">Delivery Charge</td>
          <td><input name="delivery_charge" type="text" id="delivery_charge" size="7" value="<?php echo isset($deliverymethod) ? $deliverymethod->delivery_charge:set_value('delivery_charge');?>" /></td>
        </tr>
	<!--
	<tr>
          <td class="label">Service Charge</td>
          <td><input name="service_charge" type="text" id="service_charge" size="7" value="<?php echo isset($deliverymethod) ? $deliverymethod->service_charge:set_value('service_charge');?>" /></td>
        </tr>
	//-->
        <tr>
          <td class="label">Week Days</td>
          <td><select name="delivery_days[]" size="5" multiple="multiple" id="delivery_days[]">
          <?php 
		        $ddy = isset($deliverymethod) ? $deliverymethod->delivery_days:$_POST['delivery_days'];
				$ddy = count($ddy)<1 ? array():$ddy;
		  		
		  			$days = array('1'=>'Sunday', '2'=>'Monday','3'=>'Tuesday','4'=>'Wednesday','5'=>'Thursday','6'=>'Friday','7'=>'Saturday');
		        for($i=1;$i<=7;$i++) {   ?>
                 <option value="<?php echo $i;?>" <?php echo in_array($i,$ddy)?'selected="selected"':''; ?>><?php echo $days[$i];?></option>
            <?php } ?>
          </select>          </td>
        </tr>
        
        <tr>
          <td class="label">Stoppage Time</td>
          <td><select name="delivery_hour" id="delivery_hour">
          <?php 
		  $dm = $deliverymethod ? $deliverymethod->delivery_hour:set_value('delivery_hour');
		  for($i=0;$i<=23;$i++) { ?>
          		<option value="<?php echo $i; ?>" <?php echo $dm==$i ? 'selected="selected"':''; ?>><?php echo sprintf("%02d",$i);?></option>
          <?php } ?>
          </select>
            <select name="delivery_minute" id="delivery_minute">
          <?php $dm = $deliverymethod ? $deliverymethod->delivery_minute:set_value('delivery_minute');
		  		 for($i=0;$i<=59;$i=$i+15) { ?>
          		<option value="<?php echo $i; ?>" <?php echo $dm==$i ? 'selected="selected"':''; ?>><?php echo sprintf("%02d",$i);?></option>
          <?php } ?>
                        </select></td>
        </tr>
        <tr>
        		<td class="label">Icon Image</td>
        		<td><input type="file" name="icon_image" id="icon_image"/></td>
        </tr>
	<tr>
		<td class="label">Delivery Policy</td>
		<td>
		  <select name="delivery_policy_id" id="delivery_policy_id">
			<?php foreach($policies as $policy) : ?>
			      <option value="<?php echo $policy->message_id;?>" <?php
			      
			      $dpolicy = isset($_POST['delivery_policy_id']) ? $_POST['delivery_policy_id']:(isset($deliverymethod) ? $deliverymethod->delivery_policy_id:'');
			      echo $dpolicy==$policy->message_id ? 'selected="selected"':'';   
			      
			      ?>><?php echo $policy->message_title;?></option>
			<?php endforeach; ?>
                  </select>
		  
		</td>  
	</tr>
	<tr>
		<td class="label">Substitution Policy</td>
		<td>
		  <select name="substitution_policy_id" id="substitution_policy_id">
			<?php foreach($policies as $policy) : ?>
			      <option value="<?php echo $policy->message_id;?>" <?php
			      
			      $dpolicy = isset($_POST['substitution_policy_id']) ? $_POST['substitution_policy_id']:(isset($deliverymethod) ? $deliverymethod->substitution_policy_id:'');
			      echo $dpolicy==$policy->message_id ? 'selected="selected"':'';   
			      
			      ?>><?php echo $policy->message_title;?></option>
			<?php endforeach; ?>
                  </select>
		</td>  
	</tr>
        <tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($deliverymethod) && ($deliverymethod->banner_id=='0' || $deliverymethod->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($deliverymethod) && $deliverymethod->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
	<tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0" <?php if(($_POST && $_POST['page_id']==0) || (isset($deliverymethod) && ($deliverymethod->page_id=='0' || $deliverymethod->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $page->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($deliverymethod) && $deliverymethod->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="delivery_method_id" type="hidden" id="delivery_method_id" value="<?php echo set_value('delivery_method_id',isset($deliverymethod)?$deliverymethod->delivery_method_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
             <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php echo strtolower($this_class);?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>