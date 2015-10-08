<?php
include_once('header.php'); ?>
        <div id="content-wrapper" class="clearfix">
            <div class="content clearfix">
            <div class="clearfix">
                                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <div id="myaccount_top">
                <h2><?php echo $firstname."'s Affiliate Account";?></h2>
                <p class="description">Welcome to your account area, here you can manage your account settings and View your commissions.<br/> Please choose a menu Item you want to go.</p>
                </div>
                <div class="center_content" style="width: 300px;" />
                <?php include_once('affiliate_menu.php');?>
                </div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       