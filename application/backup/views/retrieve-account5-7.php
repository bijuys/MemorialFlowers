<?php

include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <div id="main_content" class="signin" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('Retrieve Username or Password');?></h2>
                <div class="content_wrapper">
            <div class="column">
                <h3><?php echo lang('Forget Password?');?></h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error center" style="text-align: center">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <p>
                    <label form="username"><?php echo lang('Enter username');?></label>
                    <input type="text" name="username" autocomplete="off" />
                    <?php echo form_error('username'); ?>
                </p>
                <p><label for="submit">&nbsp;</label>
                    <input type="hidden" name="retrieve" value="password" />
                    <input type="submit" name="signin" value="<?php echo lang('Retrieve Password');?>" class="submitbt" />
                </p>
                
                
                <?php echo form_close();?>
            </div>
            <div class="column">
                 <h3><?php echo lang('Forget Username?');?></h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error center" style="text-align: center">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <p>
                    <label form="username"><?php echo lang('Enter Email');?></label>
                    <input type="text" name="email" autocomplete="off" />
                    <?php echo form_error('email'); ?>
                </p>
                <p><label for="submit">&nbsp;</label>
                    <input type="hidden" name="retrieve" value="username" />
                    <input type="submit" name="signin" value="<?php echo lang('Retrieve Username');?>" class="submitbt" />
                </p>
                
                
                <?php echo form_close();?>
            </div>
                                    <div class="center back"><p><?php echo lang('Go back to');?> <a href="/"><?php echo lang('Home Page');?></a></p></div>
                </div><!-- Content Wrapper //-->
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       