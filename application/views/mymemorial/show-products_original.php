<script language="JavaScript">
			
			
			function writeResult(text1,text2){
				document.getElementbyId('text2').value = text1;
			}
			
			</script>


<div id="products">
<?php foreach($products as $product) :  ?>
    <div class="product-item box-small">
      <div class="row-fluid" Style="height:100px;">
        <div class="span12" style="height:100px;">
            <?php if(strlen($product->product_picture)>4) :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php else :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php endif; ?>
			
			<?php 
			$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
			$result = mysqli_query($con,"SELECT * FROM product_prices WHERE product_id='".$product->product_id."' ORDER BY price_value DESC LIMIT 1");
					$nu = 1;
					echo '<table width="100%"><tr >';
					while($row = mysqli_fetch_array($result)){
						echo '<td style="text-align:center; width:40px;">';
						echo '<label style="font-size:20px; font-weight:bold;">C$ '.$row['price_value'].'</label>';
						if($nu == 1){
						$id2=$row['price_id'];
							//echo '<input type="radio" id="pri-'.$product->product_id.'" name="pri-'.$product->product_id.'" value="'.$row["price_id"].'" style="margin-top:-20px;" checked="checked" onclick="writeResult('.$row["price_id"].',price-'.$product->product_id.')" />';
						}else{
							//echo "<input type='radio' id='pri-".$product->product_id."' name='pri-".$product->product_id."' value='".$row["price_id"]."' style='margin-top:-20px;' onclick='writeResult(".$row["price_id"].",price-".$product->product_id.")' />";
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
			
			
			
			<input type="hidden" name="price-<?php echo $product->product_id;?>" title="<?php echo $product->product_id;?>" value="<?php echo $id2; ?>" id="price-<?php echo $product->product_id;?>" />
            
			
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
