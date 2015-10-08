<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <?php include_once('leftside.php');?>
            <div id="main" class="clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Company Signup, Its FREE!</h2>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                 <p class="mandatory_notice">Fields marked with <span class="mandatory">*</span> are mandatory.</p>
                <div class="entry_page">
          
                    <div class="wide_form">
                    <fieldset>
                    <h4>Enter Account Information</h4>
              
                    <p>
                        <label for="username">Username<span class="mandatory">*</span></label>
                        <input type="text" name="username" id="username" value="<?php echo $_POST ? $p->username:(isset($user) ? $user->username:'');?>" />
                        <?php echo form_error("username"); ?>
                    </p>
                    <p>
                        <label for="password">Password<span class="mandatory">*</span></label>
                        <input type="password" name="password" id="password" value="<?php echo $_POST ? $p->password:(isset($user) ? $user->password:'');?>" />
                        <?php echo form_error("password"); ?>
                    </p>
                    <p>
                        <label for="password2">Confirm Password<span class="mandatory">*</span></label>
                        <input type="password" name="password2" id="password2" value="<?php echo $_POST ? $p->password2:(isset($user) ? $user->password2:'');?>" />
                        <?php echo form_error("password2"); ?>
                    </p>
                    <p>
                        <label for="email">Email<span class="mandatory">*</span></label>
                        <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:(isset($user) ? $user->email:'');?>" size="30" />
                        <?php echo form_error("email"); ?>
                    </p> 
                    </fieldset>
                    <fieldset>
                    <h4>Enter Company Information</h4> 
						  <p>
                        <label for="business">Company Name<span class="mandatory">*</span></label>
                        <input type="text" name="business" id="business" value="<?php echo $_POST ? $p->business:(isset($user) ? $user->business:'');?>" size="30" />
                        <?php echo form_error("business"); ?>
                    </p>                   
                   
                    <p>
                        <label for="firstname">Contact Name</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:(isset($user) ? $user->firstname:'');?>" size="30" />
                    </p>
                    <p>
                        <label for="address1">Address Line<span class="mandatory">*</span></label>
                        <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:(isset($user) ? $user->address1:'');?>" size="30" />
                        <?php echo form_error("address1"); ?>    
                    </p>
                    <p>
                        <label for="address2">Address Line 2</label>
                        <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:(isset($user) ? $user->address2:'');?>" size="30" />
                        <?php echo form_error("address2"); ?>
                    </p> 
                    <p>
                        <label for="postalcode">Postal Code</label>
                        <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:(isset($user) ? $user->postalcode:'');?>" size="10" />
                        <?php echo form_error("postalcode"); ?>
                    </p>
                    <p>
                        <label for="city">City<span class="mandatory">*</span></label>
                        <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:(isset($user) ? $user->city:'');?>" />
                        <?php echo form_error("city"); ?>
                    </p>
                    <p><label for="province">Province<span class="mandatory">*</span></label>
                        <select name="province" id="province">
                       <?php 
                            foreach($provinces as $row): 
                        ?>
                       <option value="<?php echo $row->province_name;?>" <?php
                       
                       
                            if($_POST)
                            {
                                echo ($p->province==$row->province_name) ? 'selected="selected"':'';
                            }
                            else
                            {
                                if(isset($user))
                                {
                                    echo $user->province==$row->province_name ? 'selected="selected"':'';
                                }
                                else
                                {
                                    echo strtoupper($row->province_name)==strtoupper('ALBERTA') ? 'selected="selected"':'';
                                }
                            }
                                            
                                          ?>><?php echo $row->province_name;?></option>
                       <?php endforeach; ?>
                        <option value="">Other/International</option>
                     </select>
                        <?php echo form_error("province"); ?>
                    </p>
                    <p>
                        <label for="province2">Other/International</label>
                        <input type="text" name="province2" id="province2" value="<?php echo $_POST ? $p->province2:(isset($user) ? $user->province2:'');?>" />
                        <?php echo form_error("province2"); ?>
                    </p>  
                    <p>
                        <label for="country_id">Country<span class="mandatory">*</span></label>
                        <select name="country_id" id="country_id">
                            <?php foreach($countries as $country) { ?>
                            <option value="<?php echo $country->country_id;?>" <?php
                            
                            if($_POST)
                            {
                                echo ($p->country_id==$country->country_id) ? 'selected="selected"':'';
                            }
                            else
                            {
                                if(isset($user))
                                {
                                    echo $user->country_id==$country->country_id ? 'selected="selected"':'';
                                }
                                else
                                {
                                    echo strtoupper($country->country_name)==strtoupper('CANADA') ? 'selected="selected"':'';
                                }
                            }
                            
                            
                            ?>><?php echo $country->country_name;?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error("country_id"); ?>
                    </p>
                    <p>
                        <label for="dayphone">Phone<span class="mandatory">*</span></label>
                        <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:(isset($user) ? $user->phone1:'');?>" />
                        <?php echo form_error("dayphone"); ?>
                    </p>
                    <p>
                        <label for="evephone">Phone #2</label>
                        <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:(isset($user) ? $user->phone2:'');?>" />
                        <?php echo form_error("evephone"); ?>
                    </p>
                    <p>
                        <label>&nbsp;</label>
                        <input type="submit" name="Signup" id="signup" value="Signup"/>
                        <input type="reset" name="Reset" id="reset" value="Reset"/>
                    </p>
                    <p class="center">
								<small>A FREE Corporate account will be registered by submitting this form.</small>                    
                    </p>
                    </fieldset>
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>

       
