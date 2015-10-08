<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Sub category</h2>
    <?php echo form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Sub Category Info</th>
        </tr>
        <tr>
          <td class="label">Parent Category</td>
          <td>
	    <select name="category_id" id="category_id">
          <?php $cat = isset($subcategory) ? $subcategory->category_id:set_value('category_id'); ?>
           <?php
	   print_r($categories);
		  	foreach($categories as $crow) {
			  ?>
          		<option value="<?php echo $crow->category_id;?>" <?php if($cat==$crow->category_id) { echo 'selected="selected"'; } ?> ><?php echo $crow->category_name;?></option>
          <?php
	  } ?>
          </select>
          </td>
        </tr>
        <tr>
          <td class="label">Sub Category Name</td>
          <td><input name="subcategory_name" type="text" id="subcategory_name" value="<?php echo set_value('subcategory_name',isset($subcategory)?$subcategory->subcategory_name:''); ?>" /></td>
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
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($subcategory) ? $subcategory->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($subcategory) ? $subcategory->description_fr:''); ?></textarea>
              </div>
            </div>
	   </td>
        </tr>
        <tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($subcategory) && ($subcategory->banner_id=='0' || $subcategory->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($subcategory) && $subcategory->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>     
        <tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0" <?php if(($_POST && $_POST['page_id']==0) || (isset($subcategory) && ($subcategory->page_id=='0' || $subcategory->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $page->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($subcategory) && $subcategory->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="radio" name="subcategory_status" id="radio" value="1" <?php $ostat = isset($subcategory->subcategory_status)?$subcategory->subcategory_status:set_value('subcategory_status'); echo $ostat==1?'checked="checked"':'';?> />
            Enabled 
              <input type="radio" name="subcategory_status" id="radio2" value="2"  <?php $ostat = isset($subcategory->subcategory_status)?$subcategory->subcategory_status:set_value('subcategory_status'); echo $ostat==0 || $ostat==2 ? 'checked="checked"':'';?> /> 
          Disabled</td>
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
          <td><input name="subcategory_id" type="hidden" value="<?php echo set_value('subcategory_id',isset($subcategory)?$subcategory->subcategory_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
             <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?php echo form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/categories" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>