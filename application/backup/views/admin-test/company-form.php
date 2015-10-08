<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Company</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Company Info</th>
        </tr>
       <tr>
          <td>First Name</td>
          <td><input name="user_firstname" type="text" tabindex="1" id="user_firstname" value="<?php echo set_value('user_firstname',isset($company)?$company->user_firstname:''); ?>" size="30" /></td>
          <td>Address</td>
          <td><input name="user_address1" type="text" id="user_address1" tabindex="11"  value="<?php echo set_value('user_address1',isset($company)?$company->user_address1:''); ?>" /></td> 
       </tr>
        <tr>
          <td>Last Name</td>
          <td><input name="user_lastname" type="text" tabindex="2"  id="user_lastname" value="<?php echo set_value('user_lastname',isset($company)?$company->user_lastname:''); ?>" size="30" /></td>
          <td>Address Line 2</td>
          <td><input name="user_address2" type="text" id="user_address2" tabindex="12"  value="<?php echo set_value('user_address2',isset($company)?$company->user_address2:''); ?>" /></td>
        </tr>
        
        <tr>
          <td>Business Name</td>
          <td><input name="user_business" type="text" tabindex="3"  id="user_business" value="<?php echo set_value('user_business',isset($company)?$company->user_business:''); ?>" size="30" /></td>
          <td>City</td>
          <td><input name="user_city" type="text" id="user_city" tabindex="13"  value="<?php echo set_value('user_city',isset($company)?$company->user_city:''); ?>" /></td>
        </tr>
        
        <tr>
          <td>Email</td>
          <td><input name="user_email" type="text" tabindex="4"  id="user_email" value="<?php echo set_value('user_email',isset($company)?$company->user_email:''); ?>" /></td>
          <td>Postal Code</td>
          <td><input name="user_postalcode" type="text" id="user_postalcode"  tabindex="14" value="<?php echo set_value('user_postalcode',isset($company)?$company->user_postalcode:''); ?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input name="user_name" type="text"  tabindex="5"  id="user_name" value="<?php echo set_value('user_name',isset($company)?$company->user_name:''); ?>"  /></td>
          <td>Province/State</td>
          <td>          <select name="user_province" id="user_province" tabindex="15" >
            <?php 
			
			    foreach($provinces as $row): 
				$pro = $_POST ? $_POST['user_province']:($company ? $company->user_province:'');
			?>
            <option value="<?php echo $row->province_name;?>" <?php echo trim($pro==$row->province_name) ? 'selected="selected"':'';?>><?php echo $row->province_name;?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>      
        <tr>
          <td>Password</td>
          <td><input name="user_password" type="text" tabindex="6"  id="user_password" value="<?php echo set_value('user_password',isset($company)?$company->user_password:''); ?>" /></td>
          <td>Country</td>
          <td><select name="user_country_id" id="user_country_id" tabindex="16" >
          <?php foreach($countries as $row): 
		  			$cou = $company ? $company->user_country_id:set_value('user_country_id');
		  ?>
          		<option value="<?php echo $row->country_id;?>" <?php echo $cou==$row->country_id ? 'selected="selected"':'';?>><?php echo $row->country_name;?></option>
          <?php endforeach; ?>
            </select>          </td>
        </tr>      
        <tr>
          <td>Day Phone</td>
          <td><input name="user_phone1" type="text" id="user_phone1" tabindex="7"  value="<?php echo set_value('user_phone1',isset($company)?$company->user_phone1:''); ?>" />
            Ext
          <input name="user_phone1_ext" type="text" id="user_phone1_ext" tabindex="8"  value="<?php echo set_value('user_phone1_ext',isset($company)?$company->user_phone1_ext:''); ?>" size="5" /></td>
        <td>Discount</td>
          <td><input name="business_discount" type="text" id="business_discount" tabindex="17"  value="<?php echo set_value('business_discount',isset($company) ? $company->business_discount:''); ?>" size="5" />%
         </td>
        </tr>
        <tr>
          <td>Evening Phone</td>
          <td><input name="user_phone2" type="text" id="user_phone2" tabindex="9"  value="<?php echo set_value('user_phone2',isset($company)?$company->user_phone2:''); ?>" />
          Ext
          <input name="user_phone2_ext" type="text" id="user_phone2_ext" tabindex="10"  value="<?php echo set_value('user_phone2_ext',isset($company)?$company->user_phone2_ext:''); ?>" size="5" /></td>
          <td>Activate?</td>
          <td>
          <?php 
		  		$check = '';
		  		if(isset($company))
		  		{
				   $check = $company->user_status==1 ? 'checked="checked"':'';
				 }
				 elseif(isset($_POST['user_status']))
				 {
				   $check = $_POST['user_status']==1 ? 'checked="checked"':'';
				}
				
				?>
          <input type="checkbox" name="user_status" id="user_status" tabindex="18"  value="1" <?php echo $check ?> /></td>
        </tr>
	<tr>
          <td>Waive Shipping Charge</td>
	  <td>
<?php 
		  		$check = '';
		  		if(isset($company))
		  		{
				   $check = $company->waive_shipping==1 ? 'checked="checked"':'';
				 }
				 elseif(isset($_POST['waive_shipping']))
				 {
				   $check = $_POST['waive_shipping']==1 ? 'checked="checked"':'';
				}
				
				?>
          <input type="checkbox" name="waive_shipping" id="waive_shipping" tabindex="18"  value="1" <?php echo $check ?> />	    
	    
	  </td>
          <td>Payment Method</td>
          <td colspan="2"><input type="radio" name="payment_method" id="pmethod1" value="1" <?php
                        
                        if($_POST)
                        {
                            if(isset($_POST['payment_method']) && $_POST['payment_method']==1)
                                echo 'checked="checked"';
                        }
                        elseif(isset($company) && $company->customer_onaccount==1)
                        {
                            echo 'checked="checked"';
                        }              
                        
                        ?>/> On Account <br/>
			
	<input type="radio" name="payment_method" id="pmethod2" value="0" <?php
                        
                        if($_POST)
                        {
                            if(isset($_POST['payment_method']) && $_POST['payment_method']==1)
                                echo 'checked="checked"';
                        }
                        elseif(isset($company) && $company->customer_onaccount=='0')
                        {			  
                            echo 'checked="checked"';
                        }              
                        
                        ?>/>Credit Card</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input name="user_id" type="hidden" id="user_id" value="<?php echo set_value('user_id',$_POST ? $_POST['user_id']:(isset($company)?$company->user_id:'')); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" tabindex="19"  value="<?php echo $action; ?> Company" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>