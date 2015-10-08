<?php

include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <div id="main_content" class="signin" >
                 <h2><?php echo lang('Register for Special offers');?></h2>
                <div class="content_wrapper clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
               
            <div class="column">
                <h3><?php echo lang('Please enter your email address:');?>?</h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open('','class="login_form"'); ?>
                <p>
                    <label form="email"><?php echo lang('Email');?></label>
                    <input type="text" name="email" autocomplete="off" />
                    <?php echo form_error('email'); ?>
                </p>
        
                <p><label for="submit">&nbsp;</label>
                    <input type="submit" name="submit" value="<?php echo lang('Register');?>" class="submitbt" />
                </p>
                
                   
                   
                <?php echo form_close();?>
            </div>
            
                </div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       