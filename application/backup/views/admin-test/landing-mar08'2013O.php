<?php include_once("header.php"); ?>

<?php include_once("sidebar.php"); ?>

  <div id="contents-wrapper">
    <h2>Landing Pages <a href="<?=current_url();?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create New</a>    </h2>
    
<div class="filter-options" style="text-align:center; visibility:hidden;">
      <?php echo form_open('/siteadmin/products/filtered'); ?>
      Filter By 
    Product Code&nbsp;<input type="text" name="productcode" value="<?php if($_POST) { echo $_POST['productcode']; } ?>" /> 
    Product ID&nbsp;<input type="text" name="productid" value="<?php if($_POST) { echo $_POST['productid']; } ?>" />     
    &nbsp;<select name="category"> 
      <option value="">Select Category</option>
      <?php foreach($categories as $category) : ?>
      <option value="<?php echo $category->category_id;?>" <?php if($_POST && $_POST['category']==$category->category_id) { echo 'selected="selected"'; } ?>><?php echo $category->category_name;?></option>
      <?php endforeach; ?>
    </select> 
    &nbsp;<select name="subcategory"> 
      <option value="">Select Sub category</option>
      <?php foreach($subcategories as $subcategory) : ?>
      <option value="<?php echo $subcategory->subcategory_id;?>"  <?php if($_POST && $_POST['subcategory']==$subcategory->subcategory_id) { echo 'selected="selected"'; } ?>><?php echo $subcategory->subcategory_name;?></option>
      <?php endforeach; ?>
    </select> 
    &nbsp;<select name="occasion">
      <option value="">Select Occasion</option>
      <?php foreach($occasions as $occasion) : ?>
      <option value="<?php echo $occasion->occasion_id;?>"  <?php if($_POST && $_POST['occasion']==$occasion->occasion_id) { echo 'selected="selected"'; } ?>><?php echo $occasion->occasion_name;?></option>
      <?php endforeach; ?>
    </select> 
    &nbsp;<select name="color"> 
      <option value="">Select Color</option>
      <?php foreach($colors as $color) : ?>
      <option value="<?php echo $color->color_id;?>"  <?php if($_POST && $_POST['color']==$color->color_id) { echo 'selected="selected"'; } ?>><?php echo $color->color_name;?></option>
      <?php endforeach; ?>
    </select> 
    &nbsp;<input type="submit" name="submit" value="Filter" />
      </form>
    </div>

    <?php if(count($landing_pa)): ?>
    
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%" align="center">ID</th>
       
       
        <th width="25%" align="center">Landing Group</th>
        <th width="25%" align="center">Landing City</th>
        <th width="9%" align="center">Description</th>
       
        <th width="20%" align="center">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($landing_pa as $row) : ?> 
      <tr>
        <td><?php echo $row->landing_id;?>
            
        </td>
        
       
        <td class="left"><?php echo $row->folder_name;?></td>
        <td class="left"><?php echo ucfirst($row->landing_city);?></td>
        <td class="left"><?php echo $row->landing_seo_description;?></td>
        
        <td nowrap="nowrap"><a href="<?php echo FCBASE;?>/landing/edit/<?php echo $row->landing_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$row->landing_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
    <?php else: ?>
    <div class="notfound"><h3>No Landing Pages</h3><p>Please add landing pages first!</p>.</div>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>/landing" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>