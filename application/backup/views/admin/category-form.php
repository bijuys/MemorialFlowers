<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Category</h2>
    <?=form_open_multipart(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="2">Enter Category Info</th>
        </tr>
        <tr>
          <td class="label">Category Name</td>
          <td><input name="category_name" type="text" size="35" id="category_id" value="<?php echo set_value('category_name',isset($category)?$category->category_name:''); ?>" /></td>
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
                <textarea name="description" id="description" rows="5" cols="45"><?php echo set_value('description',isset($category)?$category->description:''); ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="description_fr" id="description_fr" rows="5" cols="45"><?php echo set_value('description_fr',isset($category)?$category->description_fr:''); ?></textarea>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label">Banner</td>
          <td><select name="banner_id" id="banner_id" >
          <option value="0" <?php if(($_POST && $_POST['banner_id']==0) || (isset($category) && ($category->banner_id=='0' || $category->banner_id==''))) { echo 'selected="selected"'; } ?>>No Banner</option>
          <?php foreach($banners as $bann)
          { ?>
          <option value="<?php echo $bann->banner_id;?>" <?php if(($_POST && $_POST['banner_id']==$bann->banner_id) || (isset($category) && $category->banner_id==$bann->banner_id)) { echo 'selected="selected"'; } ?>><?php echo $bann->banner_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
	<tr>
          <td class="label">Page</td>
          <td><select name="page_id" id="page_id" >
          <option value="0" <?php if(($_POST && $_POST['page_id']==0) || (isset($category) && ($category->page_id=='0' || $category->page_id==''))) { echo 'selected="selected"'; } ?>>No Page</option>
          <?php foreach($pages as $page)
          { ?>
          <option value="<?php echo $page->page_id;?>" <?php if(($_POST && $_POST['page_id']==$page->page_id) || (isset($category) && $category->page_id==$page->page_id)) { echo 'selected="selected"'; } ?>><?php echo $page->page_name;?></option>
          <?php } ?>          
          </select>    
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="radio" name="category_status" id="radio" value="1" <?php $ostat = isset($category->category_status)?$category->category_status:set_value('category_status'); echo $ostat==1?'checked="checked"':'';?> />
            Enabled 
              <input type="radio" name="category_status" id="radio2" value="2"  <?php $ostat = isset($category->category_status)?$category->category_status:set_value('category_status'); echo $ostat==0 || $ostat==2 ? 'checked="checked"':'';?> /> 
          Disabled</td>
        </tr>
        <?php if(count($catproducts)) : ?>
        <tr>
          <td valign="top" class="label">Products Display Order</td>
          <td><div class="scroll_win" style="height:550px; width:700px;">
            <table border="0" cellspacing="0" cellpadding="0" id="result" class="result">
               <tr>
               <th colspan="2">Products</th><th>Display Order</th>
               </tr>
	      <?php foreach($catproducts as $row): ?>
              <tr>
                <td>
                  <img src="<?php echo img_format('productres/'.$row->product_picture, 'macro');?>" /></td>
                <td nowrap="nowrap"><?php echo $row->product_name; ?></td>
		<td><input type="text" name="display_order[<?php echo $row->product_id;?>]" value="<?php if(isset($row->display_order)) { echo $row->display_order; } else { echo '0'; } ?>" /></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div></td>
        </tr>
        <?php endif; ?>
        <tr>
          <td>&nbsp;</td>
          <td><input name="category_id" type="hidden" value="<?php echo set_value('category_id',isset($category)?$category->category_id:''); ?>" /><input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?>" /></td>
        </tr>
      </table>
      
       <script>
          $(function() {
              $("#description-tabs" ).tabs();
          });
      </script>
       
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/categories" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>