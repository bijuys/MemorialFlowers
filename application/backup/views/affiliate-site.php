<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include('affiliate_menu.php');?></div>
            <div id="main" class="clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Update My Affiliate Site</h2>
                <?php if($this->session->flashdata('message')) { ?>
                 <div id="messenger"><?php echo $this->session->flashdata('message');?></div>               
                <?php } ?>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open_multipart(current_url()); ?>
                <div class="entry_page clearfix">
                    <div class="wide_form">
                    <fieldset>
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
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" id="logo" />
                    </p>
                    <p>
                        <label for="theme">Theme</label>
                       <select name="theme" id="theme">
                        <option value="Default">Default</option>
                        <option value="White">White</option>
                        <option value="Blue">Blue</option>
                        <option value="Green">Green</option>
                        <option value="Orange">Orange</option>
                        <option value="Multi">Multi</option>
                       </select>
                    </p>                     
                    <p>
                        <input type="hidden" name="customer_id" value="<?php echo $_POST ? $p->customer_id:(isset($user) ? $user->user_id:'');?>" />
                        <label>&nbsp;</label>
                        <input type="submit" name="Update" id="update" value="Update" class="submitbt"/>
                        <input type="reset" name="Reset" id="reset" value="Reset" class="resetbt"/>
                    </p>
                    </fieldset>
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar"></div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       
