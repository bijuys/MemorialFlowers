<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Affiliate</h2>
    <?php echo form_open(current_url()); ?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Affiliate Info</th>
        </tr>
        <tr>
          <td>First Name</td>
          <td><input name="user_firstname" tabindex="1" type="text" id="user_firstname" value="<?php echo set_value('user_firstname',isset($affiliate)?$affiliate->user_firstname:''); ?>" size="30" /></td>
          <td>Address</td>
          <td><input name="user_address1" type="text" tabindex="11"  id="user_address1" value="<?php echo set_value('user_address1',isset($affiliate)?$affiliate->user_address1:''); ?>" /></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input name="user_lastname" tabindex="2"  type="text" id="user_lastname" value="<?php echo set_value('user_lastname',isset($affiliate)?$affiliate->user_lastname:''); ?>" size="30" /></td>
          <td>Address Line 2</td>
          <td><input name="user_address2" type="text" id="user_address2"  tabindex="12"  value="<?php echo set_value('user_address2',isset($affiliate)?$affiliate->user_address2:''); ?>" /></td>        
        </tr>
        
        <tr>
          <td>Business Name</td>
          <td><input name="user_business" type="text" tabindex="3"  id="user_business" value="<?php echo set_value('user_business',isset($affiliate)?$affiliate->user_business:''); ?>" size="30" /></td>
             <td>City</td>
          <td><input name="user_city" type="text" id="user_city" tabindex="13"  value="<?php echo set_value('user_city',isset($affiliate)?$affiliate->user_city:''); ?>" /></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input name="user_email" type="text" tabindex="4"  id="user_email" value="<?php echo set_value('user_email',isset($affiliate)?$affiliate->user_email:''); ?>" /></td>
          <td>Postal Code</td>
          <td><input name="user_postalcode" type="text" id="user_postalcode" tabindex="14"  value="<?php echo set_value('user_postalcode',isset($affiliate)?$affiliate->user_postalcode:''); ?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input name="user_name" type="text" id="user_name" tabindex="5"  value="<?php echo set_value('user_name',isset($affiliate)?$affiliate->user_name:''); ?>"  /></td>
          <td>Province/State</td>
          <td><select name="user_province" id="user_province" tabindex="15" >
            <?php 
			
			    foreach($provinces as $row): 
				$pro = $affiliate ? $affiliate->user_province:set_value('user_province');
			?>
            <option value="<?php echo $row->province_name;?>" <?php echo $pro==$row->province_name ? 'selected="selected"':'';?>><?php echo $row->province_name;?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>      
        <tr>
          <td>Password</td>
          <td><input name="user_password" type="text" id="user_password" tabindex="6"  value="<?php echo set_value('user_password',isset($affiliate)?$affiliate->user_password:''); ?>" /></td>
          <td>Country</td>
          <td><select name="user_country_id" id="user_country_id" tabindex="16" >
          <?php foreach($countries as $row): 
		  			$cou = $affiliate ? $affiliate->user_country_id:set_value('user_country_id');
		  ?>
          		<option value="<?php echo $row->country_id;?>" <?php echo $cou==$row->country_id ? 'selected="selected"':'';?>><?php echo $row->country_name;?></option>
          <?php endforeach; ?>
            </select>          </td>
        </tr>      
        <tr>
          <td>Day Phone</td>
          <td><input name="user_phone1" type="text" id="user_phone1"  tabindex="7" value="<?php echo set_value('user_phone1',isset($affiliate)?$affiliate->user_phone1:''); ?>" />
            Ext
          <input name="user_phone1_ext" type="text" tabindex="8"  id="user_phone1_ext" value="<?php echo set_value('user_phone1_ext',isset($affiliate)?$affiliate->user_phone1_ext:''); ?>" size="5" /></td>
          <td>Commission</td>
          <td><input name="affiliate_commission" type="text" id="affiliate_commission" tabindex="17"  value="<?php echo set_value('affiliate_commission',isset($affiliate)?$affiliate->affiliate_commission:''); ?>" size="5" />%
         </td>
        </tr>
        <tr>
          <td>Evening Phone</td>
          <td><input name="user_phone2" type="text" id="user_phone2" tabindex="9"  value="<?php echo set_value('user_phone2',isset($affiliate)?$affiliate->user_phone2:''); ?>" />
          Ext
          <input name="user_phone2_ext" type="text" id="user_phone2_ext" tabindex="10"  value="<?php echo set_value('user_phone2_ext',isset($affiliate)?$affiliate->user_phone2_ext:''); ?>" size="5" /></td>
          <td>Activate?</td>
          <td>
          <?php 
		  		$check = '';
		  		if(isset($affiliate))
		  		{
				   $check = $affiliate->user_status==1 ? 'checked="checked"':'';
				 }
				 elseif(isset($_POST['user_status']))
				 {
				   $check = $_POST['user_status']==1 ? 'checked="checked"':'';
				}
				
				?>
          <input type="checkbox" name="user_status" id="user_status" value="1"  tabindex="18" <?php echo $check ?> /></td>
        </tr>
		
		<tr>
          <td></td>
          <td></td>
          <td>On Account</td>
          <td>
			<select name="user_onaccount" id="user_onaccount" tabindex="16" >
          		<option value="1" <?php echo 1==$row->customer_onaccount ? 'selected="selected"':'';?>>YES</option>
				<option value="0" <?php echo 0==$row->customer_onaccount ? 'selected="selected"':'';?>>NO</option>
            </select>          </td>
        </tr>  
		
        <tr>
            <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input name="user_id" type="hidden" id="user_id" value="<?php echo set_value('user_id',isset($affiliate)?$affiliate->user_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" tabindex="19"  value="<?php echo $action; ?> Affiliate" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>