<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php echo $action; ?> Administrator</h2>
    <?=form_open(current_url());?>
    <?php echo validation_errors(); ?>
    <div id="shadow">
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="form_table">
        <tr>
          <th colspan="4">Enter Admin Info</th>
        </tr>
        <tr>
          <td>First Name</td>
          <td><input name="user_firstname" tabindex="1" type="text" id="user_firstname" value="<?php echo set_value('user_firstname',isset($admin)?$admin->user_firstname:''); ?>" size="30" /></td>
          <td>Address</td>
          <td><input name="user_address1" type="text" tabindex="11"  id="user_address1" value="<?php echo set_value('user_address1',isset($admin)?$admin->user_address1:''); ?>" /></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td><input name="user_lastname" tabindex="2"  type="text" id="user_lastname" value="<?php echo set_value('user_lastname',isset($admin)?$admin->user_lastname:''); ?>" size="30" /></td>
          <td>Address Line 2</td>
          <td><input name="user_address2" type="text" id="user_address2"  tabindex="12"  value="<?php echo set_value('user_address2',isset($admin)?$admin->user_address2:''); ?>" /></td>        
        </tr>
        
        <tr>

	<td>Email</td>
          <td><input name="user_email" type="text" tabindex="4"  id="user_email" value="<?php echo set_value('user_email',isset($admin)?$admin->user_email:''); ?>" /></td>

	 <td>City</td>
          <td><input name="user_city" type="text" id="user_city" tabindex="13"  value="<?php echo set_value('user_city',isset($admin)?$admin->user_city:''); ?>" /></td>
        </tr>
        <tr>
	<td>Username</td>
          <td><input name="user_name" type="text" id="user_name" tabindex="5"  value="<?php echo set_value('user_name',isset($admin)?$admin->user_name:''); ?>"  /></td>
                    
          <td>Postal Code</td>
          <td><input name="user_postalcode" type="text" id="user_postalcode" tabindex="14"  value="<?php echo set_value('user_postalcode',isset($admin)?$admin->user_postalcode:''); ?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
	  <td>Password</td>
          <td><input name="user_password" type="text" id="user_password" tabindex="6"  value="<?php echo set_value('user_password',isset($admin)?$admin->user_password:''); ?>" /></td>
          
          <td>Province/State</td>
          <td><select name="user_province" id="user_province" tabindex="15" >
            <?php 
			
			    foreach($provinces as $row): 
				$pro = $admin ? $admin->user_province:set_value('user_province');
			?>
            <option value="<?php echo $row->province_name;?>" <?php echo $pro==$row->province_name ? 'selected="selected"':'';?>><?php echo $row->province_name;?></option>
            <?php endforeach; ?>
          </select></td>
        </tr>      
        <tr>
	  <td>Phone</td>
          <td><input name="user_phone1" type="text" id="user_phone1"  tabindex="7" value="<?php echo set_value('user_phone1',isset($admin)?$admin->user_phone1:''); ?>" />
            
          <td>Country</td>
          <td><select name="user_country_id" id="user_country_id" tabindex="16" >
          <?php foreach($countries as $row): 
		  			$cou = $admin ? $admin->user_country_id:set_value('user_country_id');
		  ?>
          		<option value="<?php echo $row->country_id;?>" <?php echo $cou==$row->country_id ? 'selected="selected"':'';?>><?php echo $row->country_name;?></option>
          <?php endforeach; ?>
            </select>          </td>
        </tr>      
        <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
          <td>Activate?</td>
          <td>
          <?php 
		  		$check = '';
		  		if(isset($admin))
		  		{
				   $check = $admin->user_status==1 ? 'checked="checked"':'';
				 }
				 elseif(isset($_POST['user_status']))
				 {
				   $check = $_POST['user_status']==1 ? 'checked="checked"':'';
				}
				
				?>
          <input type="checkbox" name="user_status" id="user_status" value="1"  tabindex="18" <?php echo $check ?> /></td>
        </tr>
	<tr>
	  <td> Set Permissions</td>
	  <td colspan="3">
	    
	    <?php if(isset($_POST) && isset($_POST['sections']))
		  {
		    foreach($_POST['sections'] as $key=>$val)
		    {
		      $permits[] = $key;
		    }
		  }
		  elseif(isset($admin) && isset($admin->sections) && count($admin->sections))
		  {
		    foreach($admin->sections as $sec)
		    {
		      $permits[] = $sec->section_id;
		    }
		  }
		  else
		  {
		    $permits = array();
		  }
		  
		  ?>
	    
	     <?php foreach($sections as $section) :  ?>
		<label style="float:left; width:10em; height: 20px;" ><input type="checkbox" name="sections[<?php echo $section->section_id; ?>]" value="1" <?php if(in_array($section->section_id,$permits)) { echo 'checked="checked"'; } ?> /> <?php echo $section->section_name;?> </label>&nbsp; 
	    <?php endforeach; ?>
	     
	  </td>
	</tr>
        <tr>
            <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><input name="user_id" type="hidden" id="user_id" value="<?php echo set_value('user_id',isset($admin)?$admin->user_id:''); ?>" />
          <input name="button" type="submit" class="sbutton" id="button" tabindex="19"  value="<?php echo $action; ?> Administrator" /></td>
        </tr>
      </table>
      </div>
    <?=form_close();?>
    <p class="back"><a href="<?php echo FCBASE;?>/" class="hlink">Back to Home</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>