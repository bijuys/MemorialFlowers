<?php include_once("header.php"); ?>

<?php include_once("sidebar.php"); 

//$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
  <div id="contents-wrapper">
    <h2>Products Merchandise <a href="<?php echo current_url(); ?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create New</a>    </h2>
<!--    
<div class="filter-options" style="text-align:center;">
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
-->	
	<script>
	function changeColorSe(val,id){
		//alert(val+"_"+id);
		$.post("<?php echo base_url(); ?>siteadmin/products/update_color/"+id+"_"+val);
	}
	
	function saveProductInfo(product_id,price_id)
	{
		price_name = document.getElementById('price_name'+price_id).value;
		price_value = document.getElementById('price_value'+price_id).value;
		//alert(product_id + " _ " + price_id + " _ " + price_name + " _ " + price_value);
		$.post("<?php echo base_url(); ?>siteadmin/products/update_product_info_new/"+product_id+"_"+price_id+"_"+price_name+"_"+price_value);
	}
	
	function updateProductCustomer(id,val)
	{
		//alert(id+"_"+val);
		$.post("<?php echo base_url(); ?>siteadmin/products/update_product_customer_status/"+id+"_"+val);
	}
	</script>
	
    <?php if(count($products)): ?>
    
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="6%" align="center" style="text-align:center;">Code</th>
        <th width="15%" align="center" style="text-align:center;">Product Name</th>
        <th width="5%" align="center" style="text-align:center;">Status</th>
        <th width="9%" align="center" style="text-align:center;">Category</th>
		<th width="9%" align="center" style="text-align:center;">Sub-Categories</th>
		<th width="9%" align="center" style="text-align:center;">Occasions</th>
        <th width="7%" align="center" style="text-align:center;">Image</th>
        <th width="10%" align="center" style="text-align:center;">Price Name</th>
        <th width="10%" align="center" style="text-align:center;">Price Value</th>
		<th width="10%" align="center" style="text-align:center;">On Website</th>
		<th width="10%" align="center" style="text-align:center;">Action</th>
	  </tr>
      </thead>
      <tbody>
      <?php  
	  $t='';
	  foreach($products as $row) : ?> 
	  
	  <?php if($row->product_id!=$t){ ?>
	  
	  <tr height="30" style="background-color:#EED5D2;">
		<td colspan="11">
		
		</td>
	  </tr>
	  
	  <?php 
	  $t=$row->product_id;
	  } ?>
	  
      <tr>
        <td><a href="<?php echo base_url(); ?><?php echo $row->url; ?>" target="_blank"><?php echo $row->product_code;?></a></td>
        <td class="left"><?php echo $row->product_name;?></td>
		<td><?php if($row->product_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?>        </td>
        <td align="center"><?php echo $row->category_name;?></td>
        <td align="center"></td>
		<td align="center"></td>
		<td align="center">
			<!--<img src="<?php echo img_format('productres/'.$row->product_picture, 'macro');?>" width="60" height="70" />-->
			<img src="<?php echo img_format('productres/'.$row->option_picture, 'macro');?>" width="60" height="70" />
        </td>
        <td class="left">
			<input type="text" id="price_name<?php echo $row->price_id; ?>" name="price_name<?php echo $row->price_id; ?>" value="<?php echo $row->price_name; ?>" style="text-align:center;">
		</td>
        <td class="left">
			<input type="text" id="price_value<?php echo $row->price_id; ?>" name="price_value<?php echo $row->price_id; ?>" value="<?php echo $row->price_value; ?>" style="text-align:center;">
		</td>
		<td class="left" style="text-align:center;">
		
			<select id="customer_page" name="customer_page" onChange="updateProductCustomer('<?php echo $row->product_id; ?>',this.value);">
				<option value="0">Inactive</option>
				<option value="1" <?php if($row->customer_page==1){ echo 'selected'; } ?>>Active</option>
				
			</select>
			
			<?php //echo $row->landing_name;?>
		
		</td>
        
		
        
        
        
        <td nowrap="nowrap">
			<a href="javascript:;" onClick="saveProductInfo('<?php echo $row->product_id; ?>',<?php echo $row->price_id; ?>);" class="ibutton">Update Product</a>
		</td>
      
		
	  </tr>
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