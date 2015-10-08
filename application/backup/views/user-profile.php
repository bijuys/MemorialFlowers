<?php include_once('header.php'); ?>
        <div id="content-wrapper" class="clearfix">
            <div id="main-wrapper" class="content clearfix">
            <div id="left-sidebar"><?php include_once('user_menu.php');?></div>
            <div id="content-main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('Update My Profile');?></h2>
                <?php if($this->session->flashdata('message')) { echo '<div id="messenger">'.$this->session->flashdata('message').'</div>'; } ?>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open(current_url()); ?>
                
                <div class="entry_page clearfix">
                    <div class="wide_form clearfix">
                    <fieldset>
                    <div class="form-control">
                        <label for="firstname" class="form-label"><?php echo('Firstname');?></label>
                        <div class="form-field">
                            <input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:(isset($user) ? $user->user_firstname:'');?>" size="30" />
                            <?php echo form_error("firstname"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="lastname" class="form-label"><?php echo('Lastname');?></label>
                        <div class="form-field">
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:(isset($user) ? $user->user_lastname:'');?>" size="30" />
                            <?php echo form_error("lastname"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="address1" class="form-label"><?php echo('Address Line 1');?></label>
                        <div class="form-field">
                            <input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:(isset($user) ? $user->user_address1:'');?>" size="30" />
                            <?php echo form_error("address1"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="address2" class="form-label"><?php echo('Address Line 2');?></label>
                        <div class="form-field">
                            <input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:(isset($user) ? $user->user_address2:'');?>" size="30" /> (<?php echo lang('Optional'); ?>)
                            <?php echo form_error("address2"); ?>
                        </div>
                    </div> 
                    <div class="form-control">
                        <label for="postalcode" class="form-label"><?php echo('Postal Code');?></label>
                        <div class="form-field">
                            <input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:(isset($user) ? $user->user_postalcode:'');?>" size="10" /> (<?php echo lang('Optional'); ?>)
                            <?php echo form_error("postalcode"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="city" class="form-label"><?php echo('City');?></label>
                        <div class="form-field">
                            <input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:(isset($user) ? $user->user_city:'');?>" />
                            <?php echo form_error("city"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="province" class="form-label"><?php echo('Province/State');?></label>
                        <div class="form-field">
                            <select name="province" id="province">
                                <?php echo province_options($_POST ? $_POST['province']:(isset($user) ? $user->user_province:'')); ?>
                            </select>
                            <?php echo form_error("province"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="country_id" class="form-label"><?php echo('Country');?></label>
                        <div class="form-field">
                            <select name="country_id" id="country_id" class="countryselect">
                                <?php echo country_options($_POST ? $_POST['country_id']:(isset($user) ? $user->user_country_id:'')); ?>
                            </select>
                            <?php echo form_error("country_id"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="email" class="form-label"><?php echo('Email');?></label>
                        <div class="form-field">
                            <input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:(isset($user) ? $user->user_email:'');?>" size="30" />
                            <?php echo form_error("email"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="dayphone" class="form-label"><?php echo('Day Phone');?></label>
                        <div class="form-field">
                            <input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:(isset($user) ? $user->user_phone1:'');?>" />
                            <?php echo form_error("dayphone"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <label for="evephone" class="form-label"><?php echo('Evening Phone');?></label>
                        <div class="form-field">
                            <input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:(isset($user) ? $user->user_phone2:'');?>" /> (<?php echo lang('Optional'); ?>)
                            <?php echo form_error("evephone"); ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="form-field">
                            <input type="hidden" name="customer_id" value="<?php echo $_POST ? $p->customer_id:(isset($user) ? $user->user_id:'');?>" />
                            <input type="image" name="Update" id="update" src="<?php echo theme_url();?>/images/<?php echo imgLang('update_profile-LN.gif');?>" />
                        </div>
                    </div>
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
       