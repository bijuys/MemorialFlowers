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
            <?php echo lang('An email containing the requested information was sent to the email address on file');?>.
                                    <div class="center back"><p><?php echo lang('Go back to');?> <a href="index.php"><?php echo lang('Home Page');?></a></p></div>
                </div><!-- Content Wrapper //-->
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       