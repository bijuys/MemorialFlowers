<?php
if(isset($_REQUEST['testname']))
{
$name=$_REQUEST['testname'];
}
//else { 
//$name=9;
//}

$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
//$con=mysqli_connect("localhost","root","","funeral_test_new");
$sql = mysqli_query($con,"SELECT * from affiliate_locations where location_id=".$name);
$r=mysqli_fetch_assoc($sql); 
?>
<table>
					<tr>
					<td>
					
						<div class="span12">
                   <div class="formcol1 form-horizontal">     
                    <div class="control-group">
                      <label for="firstname" class="control-label"><?php echo lang('Disease Firstname');?></label>
                      <div class="controls">
                      <?php  echo '<input type="text" name="firstname" size="30" id="firstname" value="'.$r['contact_firstname'].'" class="rounded" />'; ?>
                      </div>  
                    </div>
                    
                    <div class="control-group">
                      <label for="lastname" class="control-label"><?php echo lang('Disease Lastname');?></label>
                      <div class="controls">
                       <?php echo '<input type="text" name="lastname" size="30" id="lastname" value="'.$r['contact_lastname'].'"/>';  ?>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="phone" class="control-label"><?php echo lang('Phone');?></label>
                      <div class="controls">
                       <?php  echo '<input type="text" name="phone" size="30" id="phone" value="'.$r['phone'].'"  />';  ?>
                      </div>
                    </div>
					
					 <div class="control-group">
                      <label for="address" class="control-label"><?php echo lang('Address');?></label>
                      <div class="controls">
                       <?php echo '<input type="text" name="address" size="30" id="address" value="'.$r['address'].'"  />'; ?>
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
                      
                        <?php   echo '<input type="text" name="postalcode" size="30" id="postalcode" value="'.$r['postalcode'].'"  />'; ?>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="city" class="control-label"><?php echo lang('City');?></label>
                      <div class="controls">
                         <?php  echo '<input type="text" name="city" id="city"  size="30" value="'. $r['city'].'"  />'; ?>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="province_id" class="control-label"><?php echo lang('Province');?></label>
                      <div class="controls">
                      
                      
                      <?php $sql3 = mysqli_query($con,"SELECT * from provinces  where  country_id=".$r['country']);
					 // echo $rs['province'];
					   echo '<select name="province" id="province" >';
						while($r3=mysqli_fetch_assoc($sql3)) { 
						
						$gpm=explode("-",$r3['short_code']);
						if($gpm[1]==$r['province']) {
							echo '<option value="'.$gpm[1].'" selected>'.$r3['province_name']. '</option>';
							}
							else {
							echo '<option value="'.$gpm[1].'" >'.$r3['province_name']. '</option>';
							}
						}
						echo '</select>';
                      ?>
                      
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="country_id" class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                    
                    
                    
<?php   
					 $sql4 = mysqli_query($con,"SELECT * from countries" );
					echo '<select name="country_id" id="country_id" >';
					while($r4=mysqli_fetch_assoc($sql4)) { 
						if($r4['country_id']==$r['country']) {
						echo '<option value="'.$r4['country_id'].'" selected>'.$r4['country_name']. '</option>';
						}
						else {
						echo '<option value="'.$r4['country_id'].'">'.$r4['country_name']. '</option>';
						}
							
					}
					echo '</select>';
					
   ?>                 
                    
                    
                    
                  
                      </div>
                    </div>
                  </div>
                  </div>
						
					</td>
					</tr>
					</table>


