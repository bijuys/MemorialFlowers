<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Product Group</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Product Group Info</th>
        </tr>
        <tr>
          <td class="label">Product Group Name</td>
          <td><input name="productgroup_name" type="text" id="productgroup_id" value="<?php echo set_value('productgroup_name',isset($productgroup)?$productgroup->productgroup_name:''); ?>" size="35" /></td>
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
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($productgroup) ? $productgroup->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($productgroup) ? $productgroup->description_fr:''); ?></textarea>
              </div>
            </div>
	  </td>
        </tr>
        <tr>
          <td valign="top" class="label">Assign Products</td>
          <td><div class="scroll_win" style="height:350px;">
            <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="2">Products</th>
               </tr> 
              <?php
		foreach($products as $row):
	      ?>
              <tr>
                <td><input name="product_id[<?php echo $row->product_id;?>]" type="checkbox" id="product_id[<?php echo $row->product_id;?>]" value="1" <?php 
				
				
					if($_POST)
					{
					  if(isset($_POST['product_id'][$row->product_id]))
					  {
					    	echo 'checked="checked"'; 
					  }
					  die('ere');
					}
					elseif(isset($productgroup))
					{
					   if(in_array($row->product_id,$productgroup->products))
					   {
					    	echo 'checked="checked"'; 					        
					   }
					}		
									
				 ?>/></td>
                <td nowrap="nowrap"><?php echo $row->product_name; ?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div></td>
        </tr>
	<tr>
	  <td class="label">Publish at Home Page</td>
	  <td><input type="checkbox" name="publish_home" value="1" <?php if($_POST) { echo isset($_POST['publish_post']) ? ' checked="checked" ':''; } elseif(isset($productgroup)) { echo $productgroup->publish_home==1 ? ' checked="checked" ':''; } ?> id="publish_home" /></td>
	</tr>
	<tr>
	  <td class="label">Display Order</td>
	  <td><input type="text" name="display_order" value="<?php if($_POST) { echo $_POST['display_order']; } elseif(isset($productgroup)) { echo $productgroup->display_order; } else { echo '0'; } ?>" id="display_order" /></td>
	</tr>
	<tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($productgroup) && ($productgroup->banner_id=='0' || $productgroup->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($productgroup) && $productgroup->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr> 
        	<tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0"<?php if(($_POST && $_POST['page_id']==0) || (isset($productgroup) && ($productgroup->page_id=='0' || $productgroup->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $page->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($productgroup) && $productgroup->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>



	<tr>
          <td>&nbsp;</td>
          <td><input name="productgroup_id" type="hidden" id="productgroup_id" value="<?php echo isset($productgroup) ? $productgroup->productgroup_id:($_POST ? $_POST['productgroup_id']:'');  ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/<?php $this_class;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>