<div class="show-error">
                  <?php if(validation_errors()) { echo '<div class="error">Please correct the errors...</div>'; } ?>
</div>
<div class="row-fluid">
<div class="span12">
<div class="formcol1 form-horizontal">
                  
                    <div class="control-group">
                      <label for="locationtype" class="control-label"><?php echo lang('Location Type');?></label>
                      <?php if(isset($session['locationtype']))
                            {
                              $loctype = $_POST['locationtype'];
                            }
                            else
                            {
                              $loctype = '';                              
                            }                        
                      ?>
                      <div class="controls">
                        <select id="locationtype" name="locationtype">
                          
                          <option value="Funeral Home" selected="selected" <?php if($loctype=='Funeral Home') { echo 'select="select"'; } ?>><?php echo lang('Funeral Home');?></option>
                          <option value="Chapel" <?php if($loctype=='Chapal') { echo 'select="select"'; } ?>><?php echo lang('Chapel');?></option>                          
                        </select><?php echo form_error('locationtype'); ?>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="firstname" class="control-label"><?php echo lang('Firstname');?></label>
                      <div class="controls">
                        <input type="text" name="firstname" size="30" id="firstname" value="<?php echo $_POST['firstname']; ?>" class="rounded" />
                                    <?php echo form_error('firstname'); ?>
                      </div>  
                    </div>
                    
                    <div class="control-group">
                      <label for="lastname" class="control-label"><?php echo lang('Lastname');?></label>
                      <div class="controls">
                        <input type="text" name="lastname" id="lastname" size="30"  value="<?php echo $_POST['lastname']; ?>" />
                        <?php echo form_error('lastname'); ?>
                      </div>
                    </div>
                    
                    <div class="control-group">
                      <label for="phone" class="control-label"><?php echo lang('Phone');?></label>
                      <div class="controls">
                        <input type="text" name="phone" id="phone" size="30"  value="<?php echo $_POST['phone']; ?>" />
                        <?php echo form_error('phone'); ?>
                      </div>
                    </div>
                    
                  </div>
</div>
<div class="span12">
                  <div class="formcol2 form-horizontal">
                    <div class="control-group">
                      <label for="address" class="control-label"><?php echo lang('Address');?></label>
                      <div class="controls">
                        <input type="text" name="address" id="address" size="30"  value="<?php echo $_POST['address']; ?>" />
                        <?php echo form_error('address'); ?>
                      </div>  
                    </div>
                    <div class="control-group">
                      <label for="postalcode" class="control-label"><?php echo lang('Postalcode');?></label>
                      <div class="controls">
                        <input type="text" name="postalcode" id="postalcode" size="30"  value="<?php echo $_POST['postalcode']; ?>" />
                        <?php echo form_error('postalcode'); ?>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="city" class="control-label"><?php echo lang('City');?></label>
                      <div class="controls">
                        <input type="text" name="city" id="city"  size="30" value="<?php echo $_POST['city']; ?>" />
                        <?php echo form_error('city'); ?>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="province_id" class="control-label"><?php echo lang('Province');?></label>
                      <div class="controls">
                      <select name="province" id="province">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($provinces) && count($provinces)): foreach($provinces as $province) : ?>
                        <option value="<?php echo $province->province_name;?>" <?php
                        
                        if($_POST['province'])
                        {
                          if($_POST['province']==$province->province_name)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $province->province_name;?></option>
                        <?php endforeach; endif; ?>
                      </select><?php echo form_error('province'); ?>
                      </div>
                    </div>
                    <div class="control-group">
                      <label for="country_id" class="control-label"><?php echo lang('Country');?></label>
                      <div class="controls">
                      <select name="country_id" id="country_id">
                        <option value="0"><?php echo lang('Select One');?></option>
                        <?php if(isset($countries) && count($countries)): foreach($countries as $country) : ?>
                        <option value="<?php echo $country->country_id;?>" <?php
                        
                        if($_POST['country_id'])
                        {
                          if($_POST['country_id']==$country->country_id)
                          {
                            echo ' selected="selected" ';
                          }
                        }
                        
                        ?>><?php echo $country->country_name;?></option>
                        <?php endforeach; endif; ?>                      
                      </select><?php echo form_error('country_id'); ?>
                      </div>
                    </div>
                  </div>
</div>                
</div><!-- Row Fluid //-->
