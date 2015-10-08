<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> <?php echo $month->name;?> Products</h2>
    <?=form_open_multipart(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2"><?php echo $month->name;?></th>
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
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($month) ? $month->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($month) ? $month->description_fr:''); ?></textarea>
              </div>
            </div>
	  </td>
        </tr>
        <tr>
          <td valign="top" class="label">Assign Products</td>
          <td><div class="scroll_win" style="height:350px; width:550px;">
            <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="2">Products</th><th>Display Order</th>
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
                <td nowrap="nowrap"><?php echo $row->product_name; ?></td>
		<td><input type="text" name="display_order[<?php echo $row->product_id;?>]" value="<?php if(isset($exproducts[$row->product_id])) { echo $exproducts[$row->product_id]; } ?>" /></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div></td>
        </tr>
	<tr>
	  <td class="label">Picture</td>
	  <td>
	    <div id="pics-tabs">
              <ul class="multilangsel">
                  <li><a href="#pic-1">English</a></li>
                  <li><a href="#pic-2">French</a></li>
              </ul>
              <div id="pic-1">
               <input name="picture" type="file" /><br/>
	       <?php if(!empty($month->picture)) { echo '<img src="/productres/'.$month->picture.'" width="75" height="75" />'; } ?>
              </div>
              <div id="pic-2">
                 <input name="picture_fr" type="file" /><br/>
		 <?php if(!empty($month->picture)) { echo '<img src="/productres/'.$month->picture_fr.'" width="75" height="75" />'; } ?>
              </div>
            </div>
	  </td>	  
	</tr>
	<tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($month) && ($month->banner_id=='0' || $month->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($month) && $month->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr> 
        <tr>
          <td>&nbsp;</td>
          <td><input name="month_id" type="hidden" id="month_id" value="<?php echo isset($month) ? $month->month_id:($_POST ? $_POST['month_id']:'');  ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      <script>
          $(function() {
              $("#description-tabs" ).tabs();
	      $("#pics-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php $this_class;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>