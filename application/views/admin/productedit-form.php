<?php

      if(isset($_POST) && isset($_POST['addons']))
      {
	$paddons = $_POST['addons'];
      }
      elseif(!$_POST && isset($product) && isset($product->addons) && count($product->addons))
      {
	foreach($product->addons as $row)
	{
	  $paddons[] = $row->addon_id;
	}
	
      }
      else
      {
	$paddons = array();
      }
      
?>

<?php $js = '<script language="javascript" src="/js/jquery.js" type="text/javascript"></script>
<script language="javascript" src="/js/addproducts.js" type="text/javascript"></script>'; ?>
<?php include_once("header.php"); ?>
<script src="/js/jquery-ui-1.9.0.custom.min.js"></script>
<?php include_once("sidebar.php"); ?>
<script>
<!--
$(document).ready(function(){
    
  $("#category_id").change(function(){
    
    var current = 0;
      
    $("#category_id option").each(function(){
      
      if($(this).attr('selected'))
      {
	current = $(this).val();
      }
      
    });

    $("#subcategory_id option").each(function(){
      
      $(this).removeAttr('disabled');
      $(this).css('display','');
      
      if($(this).attr('id')==current)
      {

      }
      else
      {
	$(this).attr('disabled','disabled');
	$(this).css('display','none');
	$(this).removeAttr('selected'); 
      }
    });    
    
  });
  
  $('#category_id').trigger('change');

  $("#product_name").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#product_name_fr").val(data);
      });
  });

  $("#product_description").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#product_description_fr").val(data);
      });
  });
  
  $("#landing_name").change(function(){
      $.post('/translate',{'text':$(this).val()},function(data){
          $("#landing_name_fr").val(data);
      });
  });
  

  $("#delivery_method_id").change(function(){
      var pol = $("#delivery_method_id option:selected").attr('class');
      var policies = pol.split('|');
      
      $("#delivery_policy_id").val(policies[0]+"");
      $("#substitution_policy_id").val(policies[1]+"");
  });

  
})


//-->
</script>





  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Product</h2>
    <?php  echo form_open_multipart(current_url()); ?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Product Info</th>
        </tr>
        <tr>
          <td>Product Name English/French</td>
          <td>
	    
	    <div id="title-tabs">
              <ul class="multilangsel">
                  <li><a href="#title-1">English</a></li>
                  <li><a href="#title-2">French</a></li>
              </ul>
              <div id="title-1">
                <input name="product_name" type="text" id="product_name" tabindex="1" size="45" value="<?php echo isset($product) ? $product->product_name: $_POST['product_name']; ?>" />
              </div>
              <div id="title-2">
                <input name="product_name_fr" type="text" id="product_name_fr" tabindex="1" size="45" value="<?php echo isset($product) ? $product->product_name_fr: $_POST['product_name_fr']; ?>" />
              </div>
            </div>     
          </td>
	  <td>Alternate Text</td>
          <td><input name="alternate_text" type="text" id="alternate_text" tabindex="1" size="45" value="<?php echo isset($product) ? $product->alternate_text: $_POST['alternate_text']; ?>" /></td>
        </tr>
        <tr>
          <td>Product Code</td>
          <td><input type="text" name="product_code" id="product_code" tabindex="2"  value="<?php echo isset($product) ? $product->product_code: $_POST['product_code']; ?>" /></td>
            <td>Delivery Method</td>
          <td><select name="delivery_method_id" id="delivery_method_id" tabindex="10" >
            <?php foreach($delivery_methods as $row):  
			$def = isset($product) ? $product->delivery_method_id:$_POST['delivery_method_id'];
			?>
            <option value="<?php echo $row->delivery_method_id;?>"  class="<?php echo $row->delivery_policy_id.'|'.$row->substitution_policy_id;?>" <?php echo $def==$row->delivery_method_id ? 'selected="selected"':''; ?>><?php echo $row->delivery_method;?></option>
            <?php endforeach; ?>
          </select></td>

        </tr>
        <tr>
          <td>Select a Category</td>
          <td><select name="category_id" id="category_id" tabindex="3" >
          <?php foreach($categories as $row):  
		    $def = isset($product) ? $product->category_id:$_POST['category_id'];
	  ?>
            <option value="<?php echo $row->category_id;?>" <?php echo $def==$row->category_id ? 'selected="selected"':'';?>><?php
	    echo $row->category_name;?></option>
          <?php endforeach; ?>
          </select></td>
           	  
	  <td>Location Group</td>
          <td><select name="group_id[]" id="group_id" tabindex="11" multiple="multiple" >
            <?php
	    
	    $loc = array();
				  
		 if(isset($_POST['group_id']))
		 {
		    $loc = $_POST['group_id'];
		 }
		 else
		 {
		    foreach($product->locations as $lo)
		    {
		      $loc[]= $lo->group_id;
		    }
		 }
		 
		    foreach($locgroups as $row):  
			
		  ?>
            <option value="<?php echo $row->group_id;?>" <?php echo in_array($row->group_id,$loc) ? 'selected="selected"':''; ?> ><?php echo $row->group_name;?></option>
            <?php endforeach; ?>
          </select></td>
	   
	   
        </tr>
        <tr>
          <td>Select a Sub category</td>
          <td><select name="subcategory_id[]" id="subcategory_id"  tabindex="3" multiple="multiple" >
	  <?php
	  
	  
	  if(isset($product))
	  {
	    
	    $subcats = array();

	    foreach($product->subcategories as $row)
	    {
	      $subcats[] = $row->subcategory_id;
	    }	    
	  }
	  else
	  {
	    $subcats[] = $_POST['subcategory_id'];
	  }

	
	  ?>
          <?php foreach($subcategories as $row):  ?>
            <option value="<?php echo $row->subcategory_id;?>" id="<?php echo $row->category_id;?>" <?php if(in_array($row->subcategory_id,$subcats)) { echo 'selected="selected"'; } ?> ><?php
	    echo $row->subcategory_name;?></option>
          <?php endforeach; ?> 
          </select>          </td>
	<td>Delivery Policy</td>
          <td>

	    <select name="delivery_policy_id" id="delivery_policy_id" tabindex="12" >
            <?php foreach($policies as $row):
			$def = isset($product) ? $product->delivery_policy_id:$_POST['delivery_policy_id'];
			?>
            <option value="<?php echo $row->message_id;?>" <?php echo $def==$row->message_id ? 'selected="selected"':''; ?>><?php echo $row->message_title;?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>
        <tr>
          <td>Attributes </td>
          <td><input name="preserved_item" type="checkbox" id="preserved_item" tabindex="4"  value="1" <?php
	    if(isset($_POST))
	    {
	      if(isset($_POST['preserved_item']))
		echo ' checked="checked" ';
	    }
	    else
	    {
	      if($product->preserved_item==1)
		echo ' checked="checked" ';
	    }
	  ?> />
            Preserved? 
            <input name="seasonal_item" type="checkbox" id="seasonal_item" value="1" tabindex="6"   <?php
	    if(isset($_POST))
	    {
	      if(isset($_POST['seasonal_item']))
		echo ' checked="checked" ';
	    }
	    else
	    {
	      if($product->seasonal_item==1)
		echo ' checked="checked" ';
	    }
	  ?> />
            Seasonal?</td>
          <td>Substitution Policy</td>
          <td><select name="substitution_policy_id" id="substitution_policy_id" tabindex="13" >
        <?php
		
		foreach($policies as $row):  
		$def = isset($product) ? $product->substitution_policy_id:$_POST['substitution_policy_id'];
		?>
            <option value="<?php echo $row->message_id;?>" <?php echo $def==$row->message_id ? 'selected="selected"':''; ?>><?php echo $row->message_title;?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>
<tr>
          <td>Occasions</td>
          <td><div class="scroll_win" style="height:100px; width:250px;">
            <table border="0" cellpadding="0" cellspacing="0" id="result" style="width:230px;">
            <?php
					$ocs = array();
					$order = array();
					
							if(isset($product->occasions))
							{
								foreach($product->occasions as $row) 
								{
									$order[$row->optionrecord_id] = $row->display_order;
									$ocs[] = $row->optionrecord_id;
								
								}							
							}			
						
			?>
            <?php foreach($occasions as $row) {  ?>
              <tr>
                <td><input type="checkbox"  tabindex="7" name="occasions[<?php echo $row->occasion_id;?>]" id="occasion_<?php echo $row->occasion_id;?>" <?php if(isset($_POST['occasions'][$row->occasion_id])) {

							echo 'checked="checked"'; 
						} else {
							echo in_array($row->occasion_id,$ocs) ? 'checked="checked"':'';									
						}
				?> />
		    <input type="hidden" name="occasion_order[<?php echo $row->occasion_id;?>]" value="<?php echo isset($order[$row->occasion_id]) ? $order[$row->occasion_id]:'0';?>" />
		</td>
                <td><?php echo $row->occasion_name;?></td>
              </tr>
            <?php } ?>
            </table>
          </div></td>
        <td>Colors</td>
          <td><div class="scroll_win" style="height:100px; width:250px;">
            <table border="0" cellpadding="0" cellspacing="0" id="result" style="width:230px;">
            
            <?php
					$cls = array();
					
							if(isset($product->colors))
							{
								foreach($product->colors as $row) 
								{
								
									$cls[] = $row->optionrecord_id;
								
								}							
							}			
						
			?>
            
              <?php foreach($colors as $row) { ?>
              <tr>
                <td><input type="checkbox"  tabindex="14"  name="colors[<?php echo $row->color_id;?>]" id="color_<?php echo $row->color_id;?>" <?php if(isset($_POST['colors'][$row->color_id])) {
				
							echo 'checked="checked"'; 
				
						} else {
							echo in_array($row->color_id,$cls) ? 'checked="checked"':'';									
						}
				?> /></td>
                <td><?php echo $row->color_name;?></td>
              </tr>
              <?php } ?>
            </table>
          </div></td>        
        </tr>
        <tr>
          <td>Picture</td>
          <td>
	    <img src="<?php if(!$_POST) { echo img_format('productres/'.$product->product_picture, 'stamp'); } ?>" alt="Current Picture" /> <br />
	    <input type="file" name="product_picture" id="product_picture" tabindex="8"  /></td>
        <td>Option/Price</td>
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
            <input type="file" name="option_picture[]" />
            <input type="hidden" name="existing_picture[]" value="<?php echo $_POST ? $_POST['existing_picture'][$row]:''; ?>">
	  <?php if($i>1) { ?>
	      <!--<small>[<a href="##" class="deloption">Del</a>]</small>-->	  
	  <?php } ?>
	  </p>
          <?php 
		  			}
		  			}
		  	  	} 
				elseif(isset($product->prices))  
				{
					$i = 0;
					foreach($product->prices as $row)
					{
					  $i++;
		   ?>
          <p>
			<!--
            <img src="/productres/<?php echo $row->option_picture;?>" style="width:30px;height:30px;float:left; margin-right: 5px;"><input type="text" name="option[<?php echo $row->price_id; ?>]" tabindex="16"  id="option[]" value="<?php echo $row->price_name; ?>" />
            <input name="price[<?php echo $row->price_id; ?>]" type="text" tabindex="16"  id="price[]" size="7" value="<?php echo $row->price_value; ?>" />
          	<input type="file" name="option_picture[<?php echo $row->price_id; ?>]" />
            <input type="hidden" name="existing_picture[<?php echo $row->price_id; ?>]" value="<?php echo $row->option_picture; ?>">
			-->
			<img src="/productres/<?php echo $row->option_picture;?>" style="width:30px;height:30px;float:left; margin-right: 5px;">
			<input type="text" name="option<?php echo $i; ?>" tabindex="16"  id="option<?php echo $i; ?>" value="<?php echo $row->price_name; ?>" />
            <input name="price<?php echo $i; ?>" type="text" tabindex="16"  id="price<?php echo $i; ?>" size="7" value="<?php echo $row->price_value; ?>" />
          	<input type="file" name="option_picture<?php echo $i; ?>" id="option_picture<?php echo $i; ?>" />
            <input type="hidden" name="existing_picture<?php echo $i; ?>" id="existing_picture<?php echo $i; ?>" value="<?php echo $row->option_picture; ?>">
			
          <?php if($i>1) { ?>
	      <!--<small>[<a href="##" class="deloption">Del</a>]</small>-->	  
	  <?php } ?>
	  </p>
          <?php
		  			} ?>
				<input type="text" id="to_pri" name="to_pri" value="<?php echo $i; ?>">	
			<?php		
		  		}
			?>
			</div>
		<p style="margin:5px; padding:0px;"><small><a href="##" id="addmore">Add More</a></small></p>
	        
	    </td>
        </tr>
        
        <tr>
          <td colspan="2" valign="top"><label>Description</label>
	    <div id="description-tabs">
              <ul class="multilangsel">
                  <li><a href="#desctab-1">English</a></li>
                  <li><a href="#desctab-2">French</a></li>
              </ul>
              <div id="desctab-1">
                <textarea name="product_description" id="product_description" cols="70" tabindex="9"  rows="15"><?php echo isset($product) ? $product->product_description:$_POST['product_description']; ?></textarea>
              </div>
              <div id="desctab-2">
                <textarea name="product_description_fr" id="product_description_fr" cols="70" tabindex="9"  rows="15"><?php echo isset($product) ? $product->product_description_fr:$_POST['product_description_fr']; ?></textarea>
              </div>
            </div>
          </td>
        <td valign="top">Related Products</td>
          <td valign="top">
	    <div class="scroll_win" style="height:300px; width:250px;">
            <table border="0" cellpadding="0" cellspacing="0" id="result" style="width:230px;">
            
            <?php
					$rels = array();
					
					
							if(isset($product->related))
							{
								foreach($product->related as $row) 
								{
								
									$rels[] = $row->related_id;
								
								}							
							}			
					
			?>
            
              <?php foreach($products as $row) { ?>
              <tr>
                <td><input type="checkbox"  tabindex="14"  name="related[<?php echo $row->product_id;?>]" id="related_<?php echo $row->product_id;?>" <?php if(isset($_POST['products'][$row->product_id])) {
				
							echo 'checked="checked"'; 
				
						} else {
							echo in_array($row->product_id,$rels) ? 'checked="checked"':'';									
						}
				?> /></td>
                <td><?php echo $row->product_name;?></td>
              </tr>
              <?php } ?>
            </table>
          </div>
	  
	  </td>
        </tr>
	<tr>
          <td>Contents</td>
          <td>
	    
	    <div id="contents-tabs">
              <ul class="multilangsel">
                  <li><a href="#contab-1">English</a></li>
                  <li><a href="#contab-2">French</a></li>
              </ul>
	      <div id="contab-1">
	    <textarea name="contents" id="contents"  rows="7" cols="30"><?php if(isset($_POST) && isset($_POST['contents'])) {
							      echo $_POST['contents'];
	    } elseif(isset($product)) { echo $product->contents; } ?></textarea>
	      </div>
	      <div id="contab-2">
	    <textarea name="contents_fr" id="contents_fr"  rows="7" cols="30"><?php if(isset($_POST) && isset($_POST['contents_fr'])) {
							      echo $_POST['contents_fr'];
	    } elseif(isset($product)) { echo $product->contents_fr; } ?></textarea>
	      </div>  
	    </div>
	  </td>
	  <td>SEO Title</td>
	  <td><input type="text" name="seo_title" id="seo_title" value="<?php if(isset($_POST) && isset($_POST['seo_title'])) {
							      echo $_POST['seo_title'];
	    } elseif(isset($product)) { echo $product->seo_title; } ?>"/></td>
        </tr>
	<tr>
          <td>SEO Description</td>
          <td>
	    <textarea name="seo_description" id="seo_description"  rows="7" cols="30"><?php if(isset($_POST) && isset($_POST['seo_description'])) {
							      echo $_POST['seo_description'];
	    } elseif(isset($product)) { echo $product->seo_description; } ?></textarea>
	     
	  </td>
          <td>SEO Keywords</td>
          <td>
	    <textarea name="seo_keywords" id="seo_keywords"  rows="7" cols="30"><?php if(isset($_POST) && isset($_POST['seo_keywords'])) {
							      echo $_POST['seo_keywords'];
	    } elseif(isset($product)) { echo $product->seo_keywords; } ?></textarea>
	     
	  </td>
        </tr>
	<tr>
          <td>Addon Products<br/>
	  <small>(Ctrl+Click to select/deselect Items)</small>
	  </td>
          <td>
	    <input type="radio" name="addon_linking" value="include" <?php if(($_POST && $_POST['addon_linking']=='include') || (!$_POST && isset($product) && $product->addon_linking=='include')) { echo 'checked="checked"'; } ?> /> Include
	    <input type="radio" name="addon_linking" value="exclude" <?php if(($_POST && $_POST['addon_linking']=='exclude') || (!$_POST && isset($product) && $product->addon_linking=='exclude')) { echo 'checked="checked"'; } ?> /> Exclude
	    <input type="radio" name="addon_linking" value="default" <?php if(($_POST && $_POST['addon_linking']=='include') || (!$_POST && isset($product) && $product->addon_linking=='default')) { echo 'checked="checked"'; } ?> /> Default
	    <p>
	      <select name="addons[]" id="addons" multiple="multiple">
		<?php foreach($addons as $addon) : ?>
		  <option value="<?php echo $addon->addon_id;?>" <?php if(in_array($addon->addon_id,$paddons)) { echo 'selected="selected"'; } ?>><?php echo $addon->addon_name;?></option>	      
		<?php endforeach; ?>	      
	      </select>
	    </p>
	    </td>
          <td>&nbsp;</td>
          <td>&nbsp;
	    
	  </td>
        </tr>
	<tr>

	   <td>Activate Product?</td>
          <td colspan="3"><input name="product_status" type="checkbox" id="product_status" value="1" tabindex="15"  <?php 
		  if(isset($product)) 
		  {
		  		if($product->product_status==1) { echo 'checked="checked"'; }  
		  } elseif(isset($_POST['product_status'])) { echo 'checked="checked"'; }
		  
		  ?>  /></td>
          
          
          </tr>
          
          
          
          
          
          
          <tr>
          <td>Landing Page?</td>
          <td colspan="3"><input name="landing_status" type="checkbox" id="landing_status" value="1" tabindex="15"  <?php 
		  if(isset($product)) 
		  {
		  		if($product->landing_status==1) { echo 'checked="checked"'; }  
		  } elseif(isset($_POST['landing_status'])) { echo 'checked="checked"'; }
		  
		  ?>  /></td>
         </tr>
         
         <tr>
          <td>Landing Product Name English/French</td>
          <td colspan="3">
	    
	    <div id="landing-tabs">
              <ul class="multilangsel">
                  <li><a href="#title-10">English</a></li>
                  <li><a href="#title-20">French</a></li>
              </ul>
              <div id="title-10">
                <input name="landing_name" type="text" id="landing_name" tabindex="1" size="45" value="<?php echo isset($product) ? $product->landing_name: $_POST['landing_name']; ?>" />
              </div>
              <div id="title-20">
                <input name="landing_name_fr" type="text" id="landing_name_fr" tabindex="1" size="45" value="<?php echo isset($product) ? $product->landing_name_fr: $_POST['landing_name_fr']; ?>" />
              </div>
            </div>     
          </td>
         </tr>
         
         
          
          <tr>
          <td>&nbsp;</td> 
          <td>&nbsp;</td> 
	  <td colspan="2"><input name="product_id" type="hidden" id="user_id" value="<?php echo isset($product)?$product->product_id:$_POST['product_id']; ?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?> Product" /></td>
	  </tr>
      </table>
            <script>
          $(function() {
              $("#title-tabs" ).tabs();
	      $("#description-tabs" ).tabs();
		   $("#landing-tabs" ).tabs();
	      $("#contents-tabs" ).tabs();
          });
      </script>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>