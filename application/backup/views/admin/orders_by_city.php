<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php if(isset($ptitle)) { echo $ptitle; } ?> Orders by Provinces and Cities</h2>
    
    <div class="filter-options" style="text-align:center;">
      <?php echo form_open('/siteadmin/orders/advanced_filter'); ?>
     
    <select name="province" id="province"> 
      <option value="">Select a Province</option>
      <option value="ON">Ontario</option>
	  <option value="BC">British Columbia</option>
	  <option value="AB">Alberta</option>
	  <option value="PQ">Quebec</option>
	  <option value="MN">Ontario</option>
	  <option value="NS">Nova Scotia</option>
	  <option value="SK">Saskatchewan</option>
	  <option value="NB">New Brunswick</option>
	  <option value="NL">Newfoundland</option>
	  <option value="PE">Prince Edward Island</option>
	  <option value="NW">Northwest Territories</option>
	  <option value="YK">Yukon</option>
	</select> 
	
	&nbsp;&nbsp;&nbsp;
	
   <!-- <select name="city" id="city"> 
      <option value="">Select a City</option>
      <?php foreach($subcategories as $subcategory) : ?>
      <option value="<?php echo $subcategory->subcategory_id;?>"  <?php if($_POST && $_POST['subcategory']==$subcategory->subcategory_id) { echo 'selected="selected"'; } ?>><?php echo $subcategory->subcategory_name;?></option>
      <?php endforeach; ?>
    </select> -->
	
	&nbsp;&nbsp;
   
    <input type="submit" name="submit" value="Filter" />
    
	</form>
    </div>
    
    
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result" width="100%">
    <thead>
      <tr>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="22%">Canada Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Total Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Total Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Local Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Local Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">DS Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">DS Sales</th>
      </tr>
      </thead>
      <tbody>
	  <tr>
      <?php  foreach($orders_canada as $row) : ?> 
      
        <td style="font-size:24px; text-align:left; font-weight:bold;"><?php echo $row->info;?></td>
        <td style="font-size:24px; text-align:center; font-weight:bold;"><?php echo $row->total;?></td>
        <td style="font-size:24px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row->total_amount;?></td>
		
	  <?php endforeach; ?>
	  <?php  foreach($orders_canada_local as $row2) : ?> 
        <td style="font-size:24px; text-align:center; font-weight:bold;"><?php echo $row2->total;?></td>
		<td style="font-size:24px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row2->total_amount;?></td>
	  <?php endforeach; ?>	
	  <?php  foreach($orders_canada_ds as $row3) : ?> 
        <td style="font-size:24px; text-align:center; font-weight:bold;"><?php echo $row3->total;?></td>
		<td style="font-size:24px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row3->total_amount;?></td>
	  <?php endforeach; ?>
		
       
      </tr>
      
      </tbody>
    </table>
  
</div>
   
	 <br />
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php if(count($orders_city)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result" width="100%">
    <thead>
      <tr>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="22%">City Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Total Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Total Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Local Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">Local Sales</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">DS Orders</th>
        <th style="font-size:18px; text-align:center; font-weight:bold;" width="13%">DS Sales</th>
      </tr>
      </thead>
      <tbody>
	  
	  <?php $a=0; ?>
	  
      <?php  foreach($orders_city as $row) : ?> 
		<tr height="45">
        <td style="font-size:20px; text-align:left; font-weight:bold;">
		
		<?php 
		
		if($row->province == 'ON'){
		 echo 'Ontario';
		}
		if($row->province == 'PQ'){
		 echo 'Quebec';
		}
		if($row->province == 'NS'){
		 echo 'Nova Scotia';
		}
		if($row->province == 'NB'){
		 echo 'New Brunswick';
		}
		if($row->province == 'MN'){
		 echo 'Manitoba';
		}
		if($row->province == 'BC'){
		 echo 'British Columbia';
		}
		if($row->province == 'PE'){
		 echo 'Prince Edward Island';
		}
		if($row->province == 'SK'){
		 echo 'Saskatchewan';
		}
		if($row->province == 'AB'){
		 echo 'Alberta';
		}
		if($row->province == 'NL'){
		 echo 'Newfoundland';
		}
		if($row->province == 'YK'){
		 echo 'Yukon';
		}
		if($row->province == 'NW'){
		 echo 'Northwest Territories';
		 
		}
		
		
		?>
		
		</td>
        <td style="font-size:20px; text-align:center; font-weight:bold;"><?php echo $row->total;?></td>
        <td style="font-size:20px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row->total_amount;?></td>
		
		<?php $i=0; 
		foreach($orders_city_local as $row2) : 
			if($a == $i){ ?>
			
			<td style="font-size:20px; text-align:center; font-weight:bold;"><?php echo $row2->total_local;?></td>
		<td style="font-size:20px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row2->total_amount_local;?></td>
		
		<?php	
			}else{
		 } ?>
	  <?php $i=$i+1;
	  endforeach; ?>
	  
	  <?php $j=0; 
		foreach($orders_city_ds as $row3) : 
			if($a == $j){ ?>
			
			<td style="font-size:20px; text-align:center; font-weight:bold;"><?php echo $row3->total_ds;?></td>
		<td style="font-size:20px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php echo '$ '.$row3->total_amount_ds;?></td>
		
		<?php	
			}else{
		 } ?>
	  <?php $j=$j+1;
	  endforeach; ?>
		
		
		</tr>
	  <?php $a=$a+1; endforeach; ?>
	  
	  <!--<?php  foreach($orders_city_local as $row2) : ?> 
        <td style="font-size:20px; text-align:center; font-weight:bold;"><?php //echo $row2->total;?></td>
		<td style="font-size:20px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php //echo '$ '.$row2->total_amount;?></td>
	  <?php endforeach; ?>	
	  <?php  foreach($orders_city_ds as $row3) : ?> 
        <td style="font-size:20px; text-align:center; font-weight:bold;"><?php //echo $row3->total;?></td>
		<td style="font-size:20px; text-align:center; font-weight:bold; color:#8B1A1A;"><?php //echo '$ '.$row3->total_amount;?></td>
	  <?php endforeach; ?>-->
		
       
      
      
      </tbody>
    </table>
    <?php //echo isset($pagination) ? $pagination:''; ?>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No Orders Found.</p>
    <?php endif; ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>