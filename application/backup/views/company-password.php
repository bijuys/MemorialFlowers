<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include_once('company_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update My Password</h2>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <p class="mandatory_notice">Fields marked with <span class="mandatory">*</span> are mandatory.</p>
                <div class="entry_page clearfix">
                    <div class="wide_form clearfix">
                    <h4>Your Profile</h4>
                    <p>
                        <label for="oldpassword">Old Password<span class="mandatory">*</span></label>
                        <input type="password" name="oldpassword" id="oldpassword" value="" size="30" />
                        <?php echo form_error("oldpassword"); ?>
                    </p>
                    <p>
                        <label for="newpassword">New Password<span class="mandatory">*</span></label>
                        <input type="password" name="newpassword" id="newpassword" value="" size="30" />
                        <?php echo form_error("newpassword"); ?>
                    </p>
                    <p>
                        <label for="confpassword">Confirm Password<span class="mandatory">*</span></label>
                        <input type="password" name="confpassword" id="confpassword" value="" size="30" />
                        <?php echo form_error("confpassword"); ?>    
                    </p>
                    <p>
                        <input type="hidden" name="customer_id" value="<?php echo $user->user_id;?>" />
                        <label>&nbsp;</label>
                        <input type="submit" name="Update" id="update" value="Update" class="submitbt" />
                        <input type="reset" name="Reset" id="reset" value="Reset" class="resetbt" />
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
       