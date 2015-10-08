<?php $js = '<script language="javascript" src="/js/jquery.js" type="text/javascript"></script>'; ?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Addon</h2>
    <?php  echo form_open_multipart(current_url()); ?>
    <?php echo validation_errors(); ?>
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Addon Info</th>
        </tr>
        <tr>
          <td>Addon Name</td>
          <td><input name="addon_name" type="text" id="price" size="45" value="<?php echo isset($addon) ? $addon->addon_name:(isset($_POST['addon_name']) ? $_POST['addon_name']:'').'';?>" /></td>
        </tr>
        <tr>
          <td>Addon Price</td>
          <td>
        <div id="price-div">
          <?php if(isset($_POST['option']) && count($_POST['option'])) 
          {
          $i=0;
            foreach($_POST['option'] as $row=>$val) {
            $i++;
          if($val!='' || $_POST['price'][$row]!='') {
       ?>
          <p>
            <input type="text" name="option[]" id="option[]" value="<?php echo $val; ?>" tabindex="16"  />
            <input name="price[]" type="text" id="price[]" size="7"  tabindex="16" value="<?php echo $_POST['price'][$row]!='' ? $_POST['price'][$row]:'0.00'; ?>" />
    <?php if($i>1) { ?>
        <small>[<a href="##" class="deloption">Del</a>]</small>   
    <?php } ?>
    </p>
          <?php 
            }
            }
            } 
        elseif(isset($addon->prices))  
        {

          $i = 0;
          foreach($addon->prices as $row)
          {
            $i++;
       ?>
          <p>
            <input type="text" name="option[<?php echo $row->addonprice_id; ?>]" tabindex="16"  id="option[]" value="<?php echo $row->description; ?>" />
            <input name="price[<?php echo $row->addonprice_id; ?>]" type="text" tabindex="16"  id="price[]" size="7" value="<?php echo $row->price; ?>" />
          <?php if($i>1) { ?>
        <small>[<a href="##" class="deloption">Del</a>]</small>   
    <?php } ?>
    </p>
          <?php
            }
          }
      ?>
      </div>
    <p style="margin:5px; padding:0px;"><small><a href="##" id="addmore">Add More</a></small></p>


          </td>
        </tr>
        <tr>
          <td>Picture</td>
          <td>
	    <?php echo isset($addon) ? img($addon->addon_picture,'macro').'<br />':''; ?>
	    <input type="file" name="addon_picture" id="addon_picture" /></td>
        </tr>
        <tr>
	    <td>Delivery Methods</td>
	    <td>&nbsp;
	    <?php
	    $i=0; 
	    
	    foreach($delivery_methods as $dmethod) :
	    
	    ?>
	      <label><input type="checkbox" name="delivery_method_id[]" value="<?php echo $dmethod->delivery_method_id;?>" <?php
	      
	      if($_POST)
	      {
		if(isset($_POST['delivery_method_id'][$i])) { echo ' checked="checked" '; }
	      }
	      elseif(isset($addon) && isset($addon->delivery_methods))
	      {
		  if(in_array($dmethod->delivery_method_id,$addon->delivery_methods))
		  {

		    echo ' checked="checked" ';
		  }
	      }
	      
	      $i++;
	      
	      ?>/> <?php echo $dmethod->delivery_method;?></label>
	    <?php endforeach; ?>	    
	    </td>
	</tr>
	
        <tr>
          <td valign="top"><label>Description</label></td>
            <td><textarea name="description" id="description" cols="50" rows="15"><?php echo isset($addon) ? $addon->description:(isset($_POST['description']) ? $_POST['description']:'').'';?></textarea></td>
	</tr>

        <tr>
          <td>&nbsp;</td>
          <td><input type="hidden" name="addon_id" id="addon_id" value="<?php echo isset($addon) ? $addon->addon_id:(isset($_POST['addon_id']) ? $_POST['addon_id']:'').'';?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?=$this_class;?>" class="button"><img src="<?php echo theme_url();?>/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>