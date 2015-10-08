<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers New Product</title>
<?php include_once('headers.php'); ?>
<script src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
<script>

      function init(){
            
            $(".removeprice").click(function(){
                  $(this).parent().remove();
            });
      }

      $(document).ready(function(){
            $("#addmore").click(function(){
                  var newprice = $(".prices .priceitem:last").clone();
                  newprice.html('<input name="title[]"type="text" value="" /><input type="text" name="price[]" value="0.0" size="7" /><input type="text" name="price_details[]" value="" size="35"/><input type="button" name="del" class="removeprice" value="Remove"/>');
                  newprice.insertAfter(".prices .priceitem:last");
                  init();
            });
            
            init();
      });
      
</script>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Products</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader"><?php echo $action; ?> Product</div>
        <form name="entry-form" id="entry-form" action="" enctype="multipart/form-data" method="post">
        <?php // echo validation_errors(); ?>
        <fieldset>
            <legend>Product Info</legend>
        <p><label for="product_id">Product ID</label>
            <input type="text" name="product_id" size="35" value="<?php if($_POST) { echo $_POST['product_id']; } elseif(isset($product)) { echo $product->product_id; } ?>" id="product_id" />
        <?php echo form_error('product_id'); ?></p>
        <p><label for="product">Product</label>
            <input type="text" name="product" size="35"  value="<?php if($_POST) { echo $_POST['product']; } elseif(isset($product)) { echo $product->product; } ?>" id="product" />
        <?php echo form_error('product'); ?>
        </p>
            <p><label for="description">Description</label>
            <textarea name="description" cols="60" rows="10"><?php if($_POST) { echo $_POST['description']; } elseif(isset($product)) { echo $product->description; } ?></textarea>
        </p>
        </p>
            <p><label for="detail">Details</label>
            <textarea name="detail" cols="60" rows="5"><?php if($_POST) { echo $_POST['detail']; } elseif(isset($product)) { echo $product->detail; } ?></textarea>
        </p>
        <p><label for="type_id">Product Type</label>
            <select name="type_id">
                  <?php if(count($types)) : ?>
                        <?php foreach($types as $row) : ?>
                              <option value="<?php echo $row->type_id;?>"><?php echo $row->type;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        </p>
        <p><label for="category_id">Category</label>
            <select name="category_id">
                  <?php if(count($categories)) : ?>
                        <?php foreach($categories as $row) : ?>
                              <option value="<?php echo $row->category_id;?>"><?php echo $row->category;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        </p>
        
        <p>
            <label for="delivery_id">Delivery Type</label>
            <select name="delivery_id">
                  <option value="1">Sameday</option>
                  <option value="2">Grower Direct</option>
                  <option value="3">International</option>
            </select>
        </p>
        <?php if(isset($product) && strlen($product->picture)>4) : ?>
        <p><label>&nbsp;</label>
            <img src="<?php echo img_format('../pictures/'.$product->picture,'stamp');?>" /></p>
        <?php endif; ?>
        <p><label for="picture">Product Image</label>
            <input type="file" name="picture" size="35" />
        </p>

        <p><label for="active">Activate?</label>
            <input type="checkbox" name="active" value="1" <?php if(isset($_POST) && isset($_POST['active'])) { echo ' checked="checked" '; } elseif(isset($product) && $product->active==1) { echo ' checked="checked" '; } ?>" id="active" />
        </p>       
        
        </fieldset>

        
        <fieldset>
            <legend>Product Prices</legend>
            <label>Variant / Value / Details</label>
            <div class="prices">
                  <?php if($_POST) :
                        $icount = 0;
                         foreach($_POST['title'] as $row) : ?>
                         <div class="priceitem">
                              <input name="title[]"type="text" value="<?php echo $_POST['title'][$icount];?>" />
                              <input type="text" name="price[]" value="<?php echo $_POST['price'][$icount];?>" size="7" />
                              <input type="text" name="price_details[]" value="<?php echo $_POST['price_details'][$icount];?>"  size="35"  />
                              <?php if($icount>0) : ?>
                              <input type="button" name="del" class="removeprice" value="Remove"/>
                              <?php endif; ?>
                         </div>
                        <?php $icount++;
                              endforeach; ?>
                  <?php elseif(isset($product)) :
                        $icount = 0;
                        foreach($product->prices as $price) :
                        ?>
                         <div class="priceitem">
                              <input name="title[]"type="text" value="<?php echo $price->title;;?>" />
                              <input type="text" name="price[]" value="<?php echo $price->price;?>" size="7" />
                              <input type="text" name="price_details[]" value="<?php echo $price->details;?>"  size="35"  />
                              <?php if($icount>0) : ?>
                              <input type="button" name="del" class="removeprice" value="Remove"/>
                              <?php endif; ?>
                         </div> 
                        <?php
                        $icount++;
                        endforeach;
                        else : ?>
                  <div class="priceitem">
                        <input name="title[]"type="text" value="" />
                        <input type="text" name="price[]" value="0.0" size="7" />
                        <input type="text" name="price_details[]" value=""  size="35"  />
                  </div>
                  <?php endif; ?>
                  <div class="addprice">
                        <input type="button" name="addmore" value="Add More" id="addmore" />
                  </div>
            </div>   
        </fieldset>
        <fieldset>
            <legend>Additional Informaiton</legend>
        <p><label for="color_id">Colors</label>
            <select name="color_id[]" multiple="multiple" rows="4">
                  <?php if(count($colors)) : ?>
                        <?php foreach($colors as $row) : ?>
                              <option value="<?php echo $row->color_id;?>" <?php
                              
                              if($_POST)
                              {
                                    $colrs = isset($_POST['color_id']) ? $_POST['color_id']:array();
                                    if(in_array($row->color_id,$colrs)) { echo 'selected="selected"'; }
                              }
                              elseif(isset($product))
                              {
                                    $colrs = $product->color_id;
                                    if(in_array($row->color_id,$colrs)) { echo 'selected="selected"'; }
                              }
                              
                              ?>><?php echo $row->color;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        </p>

        <p><label for="occassion_id">Occassions</label>
            <select name="occassion_id[]" multiple="multiple" rows="4">
                  <?php if(count($occassions)) : ?>
                        <?php foreach($occassions as $row) : ?>
                              <option value="<?php echo $row->occassion_id;?>" <?php
                              
                              if($_POST)
                              {
                                    $occs = isset($_POST['occassion_id']) ? $_POST['occassion_id']:array();
                                    if(in_array($row->occassion_id,$occs)) { echo 'selected="selected"'; }
                              }
                              elseif(isset($product))
                              {
                                    $occs = $product->occassion_id;
                                    if(in_array($row->occassion_id,$occs)) { echo 'selected="selected"'; }
                              }
                              
                              ?>><?php echo $row->occassion;?></option>
                        <?php endforeach; ?>                  
                  <?php endif; ?>
            </select>
        </p>

        <p><label for="additem">Add Items?</label>
            <input type="checkbox" name="additem" value="1" <?php if(isset($_POST) && isset($_POST['additem'])) { echo ' checked="checked" '; } elseif(isset($product) && $product->additem==1) { echo ' checked="checked" '; } ?>" id="additem" />
        </p>  
        <p><label for="preserved">Preserved?</label>
            <input type="checkbox" name="preserved" value="1" <?php if(isset($_POST) && isset($_POST['preserved'])) { echo ' checked="checked" '; } elseif(isset($product) && $product->preserved==1) { echo ' checked="checked" '; } ?>" id="preserved" />
        </p>
        <p><label for="seasonal">Seasonal?</label>
            <input type="checkbox" name="seasonal" value="1" <?php if(isset($_POST) && isset($_POST['seasonal'])) { echo ' checked="checked" '; } elseif(isset($product) && $product->seasonal==1) { echo ' checked="checked" '; } ?>" id="seasonal" />
        </p>
        <p><label for="premier">Premier?</label>
            <input type="checkbox" name="premier" value="1" <?php if(isset($_POST) && isset($_POST['premier'])) { echo ' checked="checked" '; } elseif(isset($product) && $product->premier==1) { echo ' checked="checked" '; } ?>" id="premier" />
        </p>  
        </fieldset>
        <p><label>&nbsp;</label>
            <input type="submit" name="submit" id="submit" value="<?php echo $action; ?> Product" class="button"/>
        </p>
        </form>      
      </div><!-- Content //-->
</div><!-- Main //-->
    <div id="sidebar">
<?php include_once('sidebar.affiliate.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
