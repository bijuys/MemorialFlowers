<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Occasion</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Occasion Info</th>
        </tr>
        <tr>
          <td class="label">Occasion Name</td>
          <td><input name="occasion_name" type="text" id="country_id" value="<?php echo set_value('occasion_name',isset($occasions) ? $occasions->occasion_name:''); ?>" /></td>
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
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($occasions) ? $occasions->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($occasions) ? $occasions->description_fr:''); ?></textarea>
              </div>
            </div>
	  </td>
        </tr>
        <tr>
          <td class="label">Date</td>
          <td><select name="occasion_day" id="occasion_day">
          <option value="0">Select</option>
          <?php for($i=1;$i<=31;$i++): ?>
          	<option value="<?php echo sprintf("%02d",$i);?>" <?php $oday = isset($occasions->occasion_day)?$occasions->occasion_day:set_value('occasion_day'); echo ($oday==$i) ? 'selected="selected"':''; echo $oday; ?>><?php echo sprintf("%02d",$i);?></option>
          <?php endfor; ?>
          </select>
            <select name="occasion_month" id="occasion_month">
          <option value="0">Select</option>
 		<?php for($i=1;$i<=12;$i++): ?>
          	<option value="<?php echo sprintf("%02d",$i);?>" <?php $omon = isset($occasions->occasion_month)?$occasions->occasion_month:set_value('occasion_month'); echo ($omon==$i) ? 'selected="selected"':''; echo $oday; ?>><?php echo date('M',strtotime('01-'.sprintf("%02d",$i).'-2001'));?></option>
          <?php endfor; ?>
         </select></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td><input type="radio" name="occasion_status" id="radio" value="1" <?php $ostat = isset($occasions->occasion_status)?$occasions->occasion_status:set_value('occasion_status'); echo $ostat==1?'checked="checked"':'';?> />
            Enabled 
              <input type="radio" name="occasion_status" id="radio2" value="2"  <?php $ostat = isset($occasions->occasion_status)?$occasions->occasion_status:set_value('occasion_status'); echo $ostat==0 || $ostat==2 ? 'checked="checked"':'';?> /> 
          Disabled</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="checkbox" name="holiday" id="holiday" <?php
		  
		  if(isset($occasions)) 
		  {
		  		echo $occasions->occasion_type=='both' ? 'checked="checked"':'';
		  } 
		  elseif(isset($_POST['holiday']))
		  {
		  		echo 'checked="checked"';
		  }	  
		  
		  ?> /> 
            Mark as Holiday</td>
        </tr>
        <tr>
          <td class="label">Banner</td>
          <td>
	  <select name="banner_id" id="banner_id" >
	  
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($occasions) && ($occasions->banner_id=='0' || $occasions->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php
	  
	  if($_POST)
	  {
	    if($_POST['banner_id']==$bann->banner_id)
	      echo 'selected="selected"';

	  }
	  elseif(isset($occasions))
	  {
	    if($occasions->banner_id==$bann->banner_id)
	      echo 'selected="selected"';
	  }
	  
	  ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
	<tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0" <?php if(($_POST && $_POST['page_id']==0) || (isset($occasion) && ($occasion->page_id=='0' || $occasion->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $page->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($occasion) && $occasion->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
	<tr>
          <td valign="top" class="label">Assign Products</td>
          <td><div class="scroll_win" style="height:550px; width:700px;">
            <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="3">Products</th><th>Display Order</th>
               </tr> 
              <?php
	      
	      $exproducts = array();
	      
		if(count($existing))
		{
		  foreach($existing as $row)
		  {
		    $exproducts[$row->product_id] = $row->display_order ;
		  }
		  
		  
		}
		if(count($existing)) :
		foreach($existing as $row):
	      ?>
              <tr>
                <td><input name="products[]" type="checkbox" value="<?php echo $row->product_id;?>" <?php 
				
				
					if($_POST)
					{
					  if(isset($_POST['products'][$row->product_id]))
					  {
					    	echo 'checked="checked"'; 
					  }
					}
					elseif(count($existing))
					{
					   if(array_key_exists($row->product_id,$exproducts))
					   {
					    	echo 'checked="checked"'; 					        
					   }
					}		
									
				 ?>/></td>
		<td><img src="<?php echo img_format('productres/'.$row->product_picture, 'macro');?>" /></td>
                <td nowrap="nowrap"><?php echo $row->product_name; ?></td>
		<td><input type="text" name="display_order[<?php echo $row->product_id;?>]" value="<?php if(isset($exproducts[$row->product_id])) { echo $exproducts[$row->product_id]; } ?>" /></td>
              </tr>
              <?php endforeach; endif;?>
	      
	      <?php		

		foreach($products as $row):
	      ?>
              <tr>
                <td><input name="products[]" type="checkbox" value="<?php echo $row->product_id;?>" <?php 
				
				
					if($_POST)
					{
					  if(isset($_POST['products'][$row->product_id]))
					  {
					    	echo 'checked="checked"'; 
					  }
					}
					elseif(count($existing))
					{
					   if(array_key_exists($row->product_id,$exproducts))
					   {
					    	echo 'checked="checked"'; 					        
					   }
					}		
									
				 ?>/></td>
		<td><img src="<?php echo img_format('productres/'.$row->product_picture, 'macro');?>" /></td>
                <td nowrap="nowrap"><?php echo $row->product_name; ?></td>
		<td><input type="text" name="display_order[<?php echo $row->product_id;?>]" value="<?php if(isset($exproducts[$row->product_id])) { echo $exproducts[$row->product_id]; } ?>" /></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="occasion_id" type="hidden" value="<?php echo set_value('occasion_id',isset($occasions)?$occasions->occasion_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
             <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/occasions" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>