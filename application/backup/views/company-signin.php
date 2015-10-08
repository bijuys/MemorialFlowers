<?php

include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
           <?php include_once('leftside.php');?>
            <div id="main_content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Corporate Login</h2>
            <div class="column clearfix">
                <h3>Existing Company Login</h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error center" style="text-align: center;">'.$message.'</p>';
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
                    <input type="submit" name="Signin" value="Sign In" class="submitbt" />
                </p>
                <?php echo form_close();?>
            </div>
            <div class="column clearfix">
                <h3>New Company Signup</h3>
                <h4><big>Don't have an account?</big> <br/><a href="/company/signup"><big>SIGNUP HERE</big></a> <br /> It's FREE</h4>
            </div>
                        <div class="center back"><p>Go back to <a href="/">Home Page</a></p></div>
            </div> <!-- main -->

            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       
