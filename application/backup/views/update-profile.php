<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <?php include_once('leftside.php');?>
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update My Profile</h2>
                <small class="title_description">Please fill in your information</small>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <div class="entry_page">
                    <div class="wide_form">
                    <h4>Your Profile</h4>
                    <p>
                        <label for="firstname" class="mandatory">Firstname</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:(isset($user) ? $user->user_firstname:'');?>" size="30" />
                        <?php echo form_error("firstname"); ?>
                    </p>
                    <p>
                        <label for="lastname" class="mandatory">Lastname</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:(isset($user) ? $user->user_lastname:'');?>" size="30" />
                        <?php echo form_error("lastname"); ?>
                    </p>
                    <p>
                        <label for="address1" class="mandatory">Address Line 1</label>
                        <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:(isset($user) ? $user->user_address1:'');?>" size="30" />
                        <?php echo form_error("address1"); ?>    
                    </p>
                    <p>
                        <label for="address2">Address Line 2</label>
                        <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:(isset($user) ? $user->user_address2:'');?>" size="30" />
                        <?php echo form_error("address2"); ?>
                    </p> 
                    <p>
                        <label for="postalcode">Postal Code</label>
                        <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:(isset($user) ? $user->user_postalcode:'');?>" size="10" />
                        <?php echo form_error("postalcode"); ?>
                    </p>
                    <p>
                        <label for="city" class="mandatory">City</label>
                        <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:(isset($user) ? $user->user_city:'');?>" />
                        <?php echo form_error("city"); ?>
                    </p>
                    <p><label for="province" class="mandatory">Province</label>
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
                                    echo $user->user_province==$row->province_name ? 'selected="selected"':'';
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
                        <input type="text" name="province2" id="province2" value="<?php echo $_POST ? $p->province2:(isset($user) ? $user->user_province:'');?>" />
                        <?php echo form_error("province2"); ?>
                    </p>  
                    <p>
                        <label for="country_id" class="mandatory">Country</label>
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
                                    echo $user->user_country_id==$country->country_id ? 'selected="selected"':'';
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
                        <label for="email" class="mandatory">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:(isset($user) ? $user->user_email:'');?>" size="30" />
                        <?php echo form_error("email"); ?>
                    </p>
                    <p>
                        <label for="dayphone" class="mandatory">Day Phone</label>
                        <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:(isset($user) ? $user->user_phone1:'');?>" />
                        <?php echo form_error("dayphone"); ?>
                    </p>
                    <p>
                        <label for="evephone">Evening Phone</label>
                        <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:(isset($user) ? $user->user_phone2:'');?>" />
                        <?php echo form_error("evephone"); ?>
                    </p>
                    <p>
                        <input type="hidden" name="customer_id" value="<?php echo $_POST ? $p->customer_id:(isset($user) ? $user->user_id:'');?>" />
                        <label>&nbsp;</label>
                        <input type="submit" name="Update" id="update" value="Update"/>
                        <input type="reset" name="Reset" id="reset" value="Reset"/>
                    </p>
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
       