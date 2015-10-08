<?php

include_once('header.php'); ?>
        <div id="content-wrapper" class="clearfix">
            <div class="content clearfix">
            <div id="main_content" class="clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('Sign-In to your Account');?></h2>
            <div class="content_wrapper">    
            <div class="column">
                <h3><?php echo lang('Existing Affiliate');?></h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <p>
                    <label form="username">Username</label>
                    <input type="text" name="username" autocomplete="off" />
                    <?php echo form_error('username'); ?>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" autocomplete="off" />
                    <?php echo form_error('password'); ?>
                </p>
                <p><label for="submit">&nbsp;</label>
                    <input type="submit" name="Sign In" value="Signin" class="submitbt" />
                </p>
                <?php echo form_close();?>
            </div>
            <div class="column">
                <h3>New Affiliate?</h3>
                <h4><big>Don't have an account?</big> <br/><a href="/affiliates/signup"><big>SIGNUP HERE</big></a> <br /> It's FREE</h4>
            </div>
                        <div class="center back"><p>Go back to <a href="/">Home Page</a></p></div>
            </div>
            </div> <!-- main -->

            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       