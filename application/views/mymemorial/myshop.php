<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    
	<br />
	
	<div id="content" class="clearfix">
	
		<span style="color:#770922;font-size:30px;">Account</span>
		<br /><br />
	
        <div id="page">
          <div class="contents clearfix">
              <div>
                <?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
                <?php if(validation_errors()) echo '<ul class="errlist">'.validation_errors().'</ul>'; ?>
                <div class="formdiv">
                  <?php echo form_open('',array('class'=>'horizontal')); ?>
                    <div class="row-fluid">
                      
                  <div class="span12 form-horizontal">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Company Name');?></label>
                    <div class="controls">
                      <input type="text" name="user_business" id="business_name" value="<?php echo $settings->user_business;?>" size="25" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Address');?></label>
                    <div class="controls">
                      <input type="text" name="user_address1" id="address" value="<?php echo $settings->user_address1;?>" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('City');?></label>
                    <div class="controls">
                      <input type="text" name="user_city" id="city" value="<?php echo $settings->user_city;?>" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Postalcode');?></label>
                    <div class="controls">
                      <input type="text" name="user_postalcode" id="postalcode" value="<?php echo $settings->user_postalcode;?>" />
                      </div>
                    </div>                 
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Province');?></label>
                    <div class="controls">
                      <select name="province_id" name="user_province">
                      <option value=""><?php echo lang('select_one');?></option>
                      <?php foreach($provinces as $row) :?>
                        <option value="<?php echo $row->province_name;?>" <?php
                          if($settings->user_province==$row->province_name)
                          {
                            echo 'selected="selected"';
                          }
                        
                        ?>><?php echo $row->province_name;?></option>                      
                      <?php endforeach; ?>
                    </select>
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                        <select name="country_id" name="user_country_id">
                          <option value="1">Canada</option>
                        <option value="">Select One</option>
                      <?php foreach($countries as $row) :?>
                        <option value="<?php echo $row->country_id;?>" <?php
                      
                          if($settings->user_country_id==$row->country_id)
                          {
                            echo 'selected="selected"';
                          }                       
                        
                        ?>><?php echo $row->country;?></option>                      
                      <?php endforeach; ?>
                      </select>
                      </div>
                      </div>
                  </div>
                  <div class="span12 form-horizontal">
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Contact Person');?></label>
                    <div class="controls">
                      <input type="text" name="user_firstname" id="firstname" value="<?php echo $settings->user_firstname;?>" size="25" />
                    <input type="text" name="user_lastname" id="lastname" value="<?php echo $settings->user_lastname;?>" size="25" />
                      </div>
                    </div>  
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Phone');?></label>
                    <div class="controls">
                      <input type="text" name="user_phone1" id="telephone" value="<?php echo $settings->user_phone1;?>" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Email');?></label>
                    <div class="controls">
                      <input type="text" name="user_email" id="email" value="<?php echo $settings->user_email;?>" size="25" />
                      </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Password');?></label>
                    <div class="controls">
                      <input type="text" name="user_password" id="password" value="<?php echo $settings->user_password;?>" />
                    <input type="hidden" name="cpassword" id="cpassword" value="<?php echo $settings->user_password;?>" />
                      </div>
                    </div>
                  <!--<p>
                    <label><?php echo lang('Retype Password');?></label>
                    
                  </p> //-->
                  <div class="control-group">
                    <label class="control-label"><?php echo lang('Language');?></label>
                    <div class="controls">
                      <select name="language" id="language">
                      <option value="english"><?php echo lang('English');?></option>
                      <option value="french"><?php echo lang('French');?></option>
                    </select>
                      </div>
                    </div>
                  <div class="control-group">
                      <div class="controls">
                     <input type="submit" name="submit" value="<?php echo lang('Save Settings');?>" class="btn btn-inverse" />
                      </div>
                      </div>
                  </div>
                    </div>
                  </form>
                </div><!-- Form Div //-->
              </div>              
            </div>
         
        </div><!-- Page //-->
      </div><!-- Contents //-->
   
<?php //include_once(APPPATH.'views/footer.php'); ?>