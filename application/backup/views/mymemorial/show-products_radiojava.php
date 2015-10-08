<script language="JavaScript">
			
			
			function writeResult(text1,text2){
				document.getElementbyId("price-BF100").value = 3036;
				
				//alert(text1+' '+text2);
				//alert("Hello! I am an alert box!"+text1+text2);
				//return true;
			}
			
			</script>


<div id="products">
<?php foreach($products as $product) :  ?>
    <div class="product-item box-small">
      <div class="row-fluid">
        <div class="span12" style="height:600px;">
            <?php if(strlen($product->product_picture)>4) :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php else :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php endif; ?>
			
			<?php 
			$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
			$result = mysqli_query($con,"SELECT * FROM product_prices WHERE product_id='".$product->product_id."' ORDER BY price_value ASC");
					$nu = 1;
					echo '<table width="100%"><tr >';
					while($row = mysqli_fetch_array($result)){
						echo '<td style="text-align:center; width:40px;">';
						echo '<label style="font-size:16px; font-weight:bold;">$'.$row['price_value'].'</label>';
						if($nu == 1){
							$id2=$row['price_id'];
							$idd = $row['price_id'];
							$idd3 = $product->product_id;
							echo '<input type="radio" id="pri-'.$product->product_id.'" name="pri-'.$product->product_id.'" value="'.$row["price_id"].'" style="margin-top:-20px;" checked="checked" onclick="writeResult(\''. $idd. '\', \''. $idd3 .'\')">';
						}else{
							$id2=$row['price_id'];
							$idd = $row['price_id'];
							$idd3 = $product->product_id;
							//$id2=$row['price_id'];
							//echo $idd;
							//echo '<input type="radio" id="pri-'.$product->product_id.'" name="pri-'.$product->product_id.'" value="'.$row["price_id"].'" style="margin-top:-20px;" checked="checked" onclick="writeResult(\''.$idd.'\')" >';
							echo '<input type="radio" id="pri-'.$product->product_id.'" name="pri-'.$product->product_id.'" value="'.$row["price_id"].'" style="margin-top:-20px;" onclick="writeResult(\''. $idd. '\', \''. $idd3 .'\')">';
																																																	// onClick="check(\''. $id. '\', \''. $brand .'\')">';	

								
							//echo '<input type="radio" id="pri-'.$product->product_id.'" name="pri-'.$product->product_id.'" value="'.$row["price_id"].'" style="margin-top:-20px;" checked="checked" onclick="writeResult(\'' + $idd + '\')" />';
							//echo "<input type='radio' id='pri-".$product->product_id."' name='pri-".$product->product_id."' value='".$row["price_id"]."' style='margin-top:-20px;' onclick='writeResult(\"" + $idd + "\")' />";
																																																		
						}
						echo "</td>";
						
					$nu = $nu+1;	
					}
					echo '</tr></table>';
					
					/*echo '<br /><br />';
					echo $product->prices[0]->price_id;
					echo '<br /><br />';
					echo $id2;*/
			?>
			
			
			
			<input type="text" name="price-<?php echo $product->product_id; ?>" title="<?php echo $product->product_id;?>" value="<?php echo $id2; ?>" id="price-<?php echo $product->product_id;?>" placeholder="price-<?php echo $product->product_id;?>" />
			
            
			
        </div>
        <div class="span12">
            <p class="pname"><?php echo $product->product_name;?></p>
            <p><?php echo '#'.$product->product_code;?></p>
            <p class="price">
			
			
			
			
			<?php /*$prc = $product->prices[0]->price_value; 
			echo '$'.number_format($product->prices[0]->price_value,2);*/
			?>
              <!--<input type="hidden" name="price_id" title="<?php //echo $product->product_id;?>" value="<?php //echo $product->prices[0]->price_id; ?>" id="price-<?php //echo $product->product_id;?>" />-->
            
			
			
			
			
			</p>            
            <p class="select">
              <a href="#" id="<?php echo $product->product_id;?>" class="selectbox btn btn-inverse btn-mini"><?php echo lang('order');?></a>
              <!-- <input type="image" name="select[]" src="<?php echo base_url().'images/ordernow.gif';?>" id="select" class="selectbox" value="<?php echo $product->product_id;?>" /> //-->
            </p>
        </div><!-- Span14 //-->
        
		
		
		
		
      </div><!-- Row Fluid //-->

    </div><!-- Product Item //-->
<?php endforeach; ?>
</div>
