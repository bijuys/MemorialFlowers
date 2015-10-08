<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Customer</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Customer Info</th>
        </tr>
        <tr>
          <td>First Name</td>
          <td><input  name="user_firstname" type="text" id="user_firstname" tabindex="1" value="<?php echo set_value('user_firstname',isset($customer)?$customer->user_firstname:''); ?>" size="30" /></td>
         <td>Address</td>
          <td><input name="user_address1" type="text" id="user_address1" value="<?php echo set_value('user_address1',isset($customer)?$customer->user_address1:''); ?>" /></td>        
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input name="user_lastname" type="text" id="user_lastname"  tabindex="2" value="<?php echo set_value('user_lastname',isset($customer)?$customer->user_lastname:''); ?>" size="30" /></td>
         <td>Address Line 2</td>
          <td><input name="user_address2" type="text" id="user_address2" value="<?php echo set_value('user_address2',isset($customer)?$customer->user_address2:''); ?>" /></td>
        </tr>
    
        <tr>
          <td>Business Name</td>
          <td><input name="user_business" type="text" id="user_business"  tabindex="3"  value="<?php echo set_value('user_business',isset($customer)?$customer->user_business:''); ?>" size="30" /></td>
         <td>City</td>
          <td><input name="user_city" type="text" id="user_city" value="<?php echo set_value('user_city',isset($customer)?$customer->user_city:''); ?>" /></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input name="user_email" type="text" id="user_email"   tabindex="4" value="<?php echo set_value('user_email',isset($customer)?$customer->user_email:''); ?>" /></td>
         <td>Postal Code</td>
          <td><input name="user_postalcode" type="text" id="user_postalcode" value="<?php echo set_value('user_postalcode',isset($customer)?$customer->user_postalcode:''); ?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input name="user_name" type="text" id="user_name"  tabindex="5"  value="<?php echo set_value('user_name',isset($customer)?$customer->user_name:''); ?>"  /></td>
        <td>Province/State</td>
          <td><select name="user_province" id="user_province">
            <?php 
			
			    foreach($provinces as $row): 
				$pro = $customer ? $customer->user_province:set_value('user_province');
			?>
            <option value="<?php echo $row->province_name;?>" <?php echo $pro==$row->province_name ? 'selected="selected"':'';?>><?php echo $row->province_name;?></option>
            <?php endforeach; ?>
          </select></td>
        
        </tr>      
        <tr>
          <td>Password</td>
          <td><input name="user_password" type="text" id="user_password"  tabindex="6"  value="<?php echo set_value('user_password',isset($customer)?$customer->user_password:''); ?>" /></td>
        <td>Country</td>
          <td><select name="user_country_id" id="user_country_id">
          <?php foreach($countries as $row): 
		  			$cou = $customer ? $customer->user_country_id:set_value('user_country_id');
		  ?>
          		<option value="<?php echo $row->country_id;?>" <?php echo $cou==$row->country_id ? 'selected="selected"':'';?>><?php echo $row->country_name;?></option>
          <?php endforeach; ?>
            </select>          </td>      </tr>              
        <tr>
          <td>Day Phone</td>
          <td><input name="user_phone1" type="text" id="user_phone1" value="<?php echo set_value('user_phone1',isset($customer)?$customer->user_phone1:''); ?>" />
            Ext
          <input name="user_phone1_ext" type="text" id="user_phone1_ext" value="<?php echo set_value('user_phone1_ext',isset($customer)?$customer->user_phone1_ext:''); ?>" size="5" /></td>
             <td>Activate?</td>
          <td>
          <?php 
		  		$check = '';
		  		if(isset($customer))
		  		{
				   $check = $customer->user_status==1 ? 'checked="checked"':'';
				 }
				 elseif(isset($_POST['user_status']))
				 {
				   $check = $_POST['user_status']==1 ? 'checked="checked"':'';
				}
				
				?>
          <input type="checkbox" name="user_status" id="user_status" value="1" <?php echo $check ?> /></td> 
        </tr>
        <tr>
          <td>Evening Phone</td>
          <td><input name="user_phone2" type="text" id="user_phone2" value="<?php echo set_value('user_phone2',isset($customer)?$customer->user_phone2:''); ?>" />
          Ext
          <input name="user_phone2_ext" type="text" id="user_phone2_ext" value="<?php echo set_value('user_phone2_ext',isset($customer)?$customer->user_phone2_ext:''); ?>" size="5" /></td>
        <td>Customer Discount (%)</td>
	<td><input type="text" name="user_discount" value="<?php echo set_value('user_discount',isset($customer)?$customer->user_discount:''); ?>" size="6" /></td>
        </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="2"><input name="user_id" type="hidden" id="user_id" value="<?php echo set_value('user_id',isset($customer)?$customer->user_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" value="<?php echo $action; ?> Customer" /></td>	  
	</tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>