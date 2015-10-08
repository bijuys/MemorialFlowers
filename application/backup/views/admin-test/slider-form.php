<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Slider</h2>
    <?=form_open(current_url(),'enctype="multipart/form-data"');?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Slider Info</th>
        </tr>
        <tr>
          <td class="label">Select Product</td>
          <td><select name="product_id">
            <?php foreach($products as $product) {
              ?>
              <option value="<?php echo $product->product_id;?>" <?php
              if(isset($slider))
              {
                
                if($slider->product_id==$product->product_id)
                  echo 'selected="selected"';
              }
              
              ?>><?php echo $product->product_name;?></option>              
              <?php  }?>
            
          </select></td>
        </tr>
        <tr>
          <td class="label">Display after</td>
          <td><select name="req_order">
            <option value="0"> -- Slide Start -- </option>
            <?php foreach($slides as $slide) {
                  if(!isset($slider) || (isset($slider) && $slider->slide_id!=$slide->slide_id)) {
              ?>
              <option value="<?php echo $slide->sort_order+1;?>" <?php
              if(isset($slider))
              {
                if($slider->sort_order==$slide->sort_order+1)
                  echo 'selected="selected"';
              }
              
              ?>><?php echo $slide->product_name;?></option>              
              <?php }  }?>
            
          </select>
          <input type="hidden" name="sort_order" value="<?php echo set_value('sort_order',isset($slider)?$slider->sort_order:0); ?>" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="slide_id" type="hidden" value="<?php echo set_value('slider_id',isset($slider)?$slider->slide_id:'0'); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="Submit" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/slider" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>