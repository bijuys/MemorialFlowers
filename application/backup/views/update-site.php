<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <?php include_once('leftside.php');?>
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update My Affiliate Site</h2>
                <small class="title_description">Please fill in your information</small>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open_multipart(current_url()); ?>
                <div class="entry_page">
                    <div class="wide_form">
                    <h4>Your Website Settings</h4>
                    <p>
                        <label for="firstname">Site Name</label>
                        <input type="text" name="user_sitename" id="sitename" value="<?php echo $_POST ? $p->user_sitename:(isset($user) ? $user->user_sitename:'');?>" size="30" />
                        <?php echo form_error("firstname"); ?>
                    </p>
                    <p>
                        <label for="lastname">Description</label>
                        <input type="text" name="user_description" id="description" value="<?php echo $_POST ? $p->user_description:(isset($user) ? $user->user_description:'');?>" size="30" />
                    </p>
                    <?php if(isset($user) && strlen(trim($user->user_logo))) { ?>
                    <p>
                        <label for="lastname">&nbsp;</label>
                        <img src="/uploads/<?php echo $user->user_logo;?>"/>
                    </p>
                    <?php } ?>
                    <p>
                        <label for="logo" class="mandatory">Logo</label>
                        <input type="file" name="logo" id="logo" />
                    </p>
                    <p>
                        <label for="theme">Theme</label>
                       <select name="theme" id="theme">
                        <option value="Default">Default</option>
                       </select>
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
       