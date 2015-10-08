<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <?php include_once('leftside.php');?>
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <?php include_once('affiliate_menu.php');?>
                <h2>Update My Password</h2>
                <small class="title_description">Please change your Password here.</small>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open(current_url(),'class="common_form"'); ?>
                <div class="entry_page">
                    <div class="wide_form">
                    <h4>Your Profile</h4>
                    <p>
                        <label for="oldpassword" class="mandatory">Old Password</label>
                        <input type="text" name="oldpassword" id="oldpassword" value="" size="30" />
                        <?php echo form_error("oldpassword"); ?>
                    </p>
                    <p>
                        <label for="newpassword" class="mandatory">New Password</label>
                        <input type="text" name="newpassword" id="newpassword" value="" size="30" />
                        <?php echo form_error("newpassword"); ?>
                    </p>
                    <p>
                        <label for="confpassword" class="mandatory">Confirm Password</label>
                        <input type="text" name="confpassword" id="confpassword" value="" size="30" />
                        <?php echo form_error("confpassword"); ?>    
                    </p>
                    <p>
                        <input type="hidden" name="customer_id" value="<?php echo $user->user_id;?>" />
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
       