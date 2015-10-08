	

<div class="show-error">
                  <?php if(validation_errors()) { echo '<div class="error">Please correct the errors...</div>'; } ?>
</div>
<div class="row-fluid">
<div class="span12">
<div class="formcol1 form-horizontal">

<?php 
/*$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$postalcode=$_POST['postalcode'];
$city=$_POST['city'];
$province_id=$_POST['province_id'];
$country_id=$_POST['country_id'];
*/




?>
    <script type="text/javascript">

				function displayDiv2(id,sel){
				 
					for(var i=0;i<sel.length;i++){
						document.getElementById('mydiv'+i).style.display = 'none'; }
						 var mydiv2 = document.getElementById(id+sel.selectedIndex);
						//alert(div2);
					
					 if (mydiv2) {
					 div2.style.display = 'block';
					 } 
				 
				}

			</script>              
                    <div class="control-group">
                      <label for="locationtype" class="control-label"><?php echo lang('Location Type');?></label>
                     
                      <div class="controls">
                     
                  
                        <select id="locationtype" name="locationtype" onChange="displayDiv2('mydiv',this)">
                   
					 	 <?php $con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test"); 
					  $loctype = $_POST['locationtype'];
							  
					  $getloc_type_result = mysqli_query($con,"SELECT * from affiliate_locations where affiliate_id=".$this->session->userdata('affiliate_id')." order by location_id ASC");
					  $a = 1;
						while($getloc_type_rows = mysqli_fetch_array($getloc_type_result)){
						$loctype1= $getloc_type_rows['name'];
						
						if($loctype==$loctype1) {
							
							
					 ?>
                          <option value="<?php echo $loctype; ?>" selected="selected" ><?php echo $loctype; ?></option>
                        <?php 
						}
						else { ?>
						  <option value="<?php echo $loctype1; ?>" ><?php echo $loctype1; ?></option>
							
                       <?php } ?>
                       <?php $a=$a+1; }  ?>          
                        </select>
                        
                        
                         
                      </div>
                    </div> 
				
				
				
				
				
				
				
				<?php 
				if($loctype!='') {
				//$getloc_type_result2 = mysqli_query($con,"SELECT * from affiliate_locations where name='".$loctype."'  order by location_id ASC");
				$getloc_type_result2 = mysqli_query($con,"SELECT dd.* FROM order_items oi LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id WHERE oi.cart_id=".$ord_ite);
				
				}
				else {
					$getloc_type_result2 = mysqli_query($con,"SELECT dd.* FROM order_items oi LEFT JOIN delivery_details dd ON oi.orderitem_id=dd.orderitem_id WHERE oi.cart_id=".$ord_ite);
				}
						$ii = 0;
						while($getloc_type_rows2 = mysqli_fetch_array($getloc_type_result2)){
						if($ii == 0 ){
						$hi = '';
						}else{
						$hi = 'style="display:none;"';
						}
						
				?>
				
				
					<div id="mydiv<?php echo $ii?>" name="mydiv<?php echo $ii?>" <?php echo $hi; ?>>
				
					<table>
					<tr>
					<td>
				
						<div class="span12">
                   <div class="formcol1 form-horizontal">     
                    <div class="control-group">
                      <label for="firstname" class="control-label"><?php echo lang('Disease Firstname');?></label>
                      <div class="controls">
                        <input type="text" name="firstname" size="30" id="firstname" value="<?php 
						//if($fname=='') {
						 echo $getloc_type_rows2['firstname'];
						//}
						//else {
						//echo  $fname; ?>" class="rounded" />
                        <?php //} ?>
                      </div>  
                    </div>
                    
                    <div class="control-group">
                      <label for="lastname" class="control-label"><?php echo lang('Disease Lastname');?></label>
                      <div class="controls">
                        <input type="text" name="lastname" id="lastname" size="30"  value="<?php echo $getloc_type_rows2['lastname']; ?>" />
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="phone" class="control-label"><?php echo lang('Phone');?></label>
                      <div class="controls">
                        <input type="text" name="phone" id="phone" size="30"  value="<?php echo $getloc_type_rows2['dayphone']; ?>" />
                      </div>
                    </div>
					
					 <div class="control-group">
                      <label for="address" class="control-label"><?php echo lang('Address');?></label>
                      <div class="controls">
                        <input type="text" name="address" id="address" size="30"  value="<?php echo $getloc_type_rows2['address1']; ?>" />
                      </div>  
                    </div>
                    
                  </div>
                 
                  </div>
					
					</td>
					<td>
					
							<div class="span12">
                  <div class="formcol2 form-horizontal">
                   
                    <div class="control-group">
                      <label for="postalcode" class="control-label"><?php echo lang('Postalcode');?></label>
                      <div class="controls">
                        <input type="text" name="postalcode" id="postalcode" size="30"  value="<?php echo $getloc_type_rows2['postalcode']; ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="city" class="control-label"><?php echo lang('City');?></label>
                      <div class="controls">
                        <input type="text" name="city" id="city"  size="30" value="<?php echo $getloc_type_rows2['city']; ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="province_id" class="control-label"><?php echo lang('Province');?></label>
                      <div class="controls">
                      <select name="province" id="province">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($provinces) && count($provinces)): foreach($provinces as $province) : ?>
                        <option value="<?php echo substr($province->short_code, 3, 2);?>" <?php
                        
                        if($getloc_type_rows2['province'])
                        {
                          if($getloc_type_rows2['province']==substr($province->short_code, 3, 2))
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $province->province_name;?></option>
                        <?php endforeach; endif; ?>
                      </select>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="country_id" class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                      <select name="country_id" id="country_id">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($countries) && count($countries)): foreach($countries as $country) : ?>
                        <option value="<?php echo $country->country_id;?>" <?php
                        
                        if($getloc_type_rows2['country_id'])
                        {
                          if($getloc_type_rows2['country_id']==$country->country_id)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $country->country_name;?></option>
                        <?php endforeach; endif; ?>                      
                      </select>
                      </div>
                    </div>
                  </div>
                  </div>
						
					</td>
					</tr>
					</table>
				
				</div>
                  
				 <?php 
				 $ii = $ii + 1;
				 } ?> 
				  
				  
                  
                </div>