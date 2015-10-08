<?php include_once("header.php"); ?>

<?php include_once("sidebar.php"); 

//$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
  <div id="contents-wrapper">
    <h2>Products Locations</h2>
    
<div class="filter-options" style="text-align:center;">
      <?php echo form_open('/siteadmin/products/filtered_locations'); ?>
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

    <?php if(count($products)): ?>
    
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%" align="center">ID</th>
        <th width="8%" align="center">Image</th>
        <th width="20%" align="center">Product Name</th>
        <th width="8%" align="center">Category</th>
        <th width="5%" align="center">Status</th>
		<th width="14%" align="center">Price Name</th>
		<th width="14%" align="center">Customers Site</th>
		<th width="14%" align="center">Affiliates Site</th>
        <th width="20%" align="center">Action</th>
      </tr>
      </thead>
      <tbody>
	  
	  
	  
      <?php  foreach($products as $row) : ?> 
	  <?php $prices = $this->Product_model->get_product_prices($row->product_id); ?>
      
	  <form id="pros<?php echo $row->product_id; ?>" action="<?php echo base_url(); ?>siteadmin/products/update_locations" method="post">
	  <tr>
        <td>
		<input type="hidden" name="product_id" id="product_id" value="<?php echo $row->product_id; ?>" style="text-align:center;width:100%;">
		<?php echo $row->product_code;?>
        </td>
        <td align="center"><img src="<?php echo img_format('productres/'.$row->product_picture, 'macro');?>" height="80" />
        </td>
        <td class="left"><?php echo $row->product_name;?></td>
        <td class="left"><?php echo $row->category_name;?></td>
        <td><?php if($row->product_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        
        <td>
			<br />
			<table width="100%">
			<?php
			foreach($prices as $price){
			?>
			<tr>
				<td width="30%">
					<input type="text" name="price_val_<?php echo $price->price_id; ?>" id="price_val_<?php echo $price->price_id; ?>" value="<?php echo $price->price_val; ?>" style="text-align:center;width:100%;">
				</td>
				<td width="70%">
					<input type="text" name="price_name_<?php echo $price->price_id; ?>" id="price_name_<?php echo $price->price_id; ?>" value="<?php echo $price->price_name; ?>" style="text-align:center;width:100%;">
				</td>
			</tr>		
			<?php 
			}
			?>
			</table>
		</td>
		
        <td>
			<input type="checkbox" name="customer_page" id="customer_page" value="1" <?php if($row->customer_page==1){ echo 'checked="Checked"'; } ?>>
			
			<table width="100%">
			<?php
			foreach($prices as $price){
			?>
			<tr>
				<td width="100%">
					<input type="text" name="price_customer_<?php echo $price->price_id; ?>" id="price_customer_<?php echo $price->price_id; ?>" value="<?php echo $price->price_value; ?>" style="text-align:center;">
				</td>
			</tr>		
			<?php 
			}
			?>
			</table>
		</td>
		
		<td>
			<input type="checkbox" name="affiliate_page" id="affiliate_page" value="1" <?php if($row->affiliate_page==1){ echo 'checked="Checked"'; } ?>>
			
			<table width="100%">
			<?php
			foreach($prices as $price){
			?>
			<tr>
				<td width="100%">
					<input type="text" name="price_affiliate_<?php echo $price->price_id; ?>" id="price_affiliate_<?php echo $price->price_id; ?>" value="<?php echo $price->price_value_mymemorial; ?>" style="text-align:center;">
				</td>
			</tr>		
			<?php 
			}
			?>
			</table>
		</td>
        
        <td nowrap="nowrap">
			<!--
			<a href="<?php echo FCBASE;?>/products/edit/<?php echo $row->product_id;?>" class="ibutton">
				<img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$row->product_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove
			</a>
			-->
			 <button type="submit"> Save </button> 
		</td>
      </tr>
	  
	  </form>
	  
	
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
    <?php else: ?>
    <div class="notfound"><h3>No Products</h3><p>Please ad products first!</p>.</div>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>/products" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>
  
