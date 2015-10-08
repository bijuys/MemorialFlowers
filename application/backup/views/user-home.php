<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="userhomemenu" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <div id="myaccount_top" class="clearfix">
                <h2>My Account</h2>
                <p class="desciption center hmargined">Welcome to your account area, here you can manage your account settings.</p>
                </div>
                <div class="center_content" style="width: 300px;" />
                <?php include_once('user_menu.php'); ?>
            	</div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       