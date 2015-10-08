<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <?php include_once('leftside.php');?>
            <div id="main_content" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <div id="myaccount_top" class="clearfix">
                <h2>My Account</h2>
                <p class="desciption">Welcome to your account area, here you can manage your account settings and View your commissions</p>
                </div>
                <div class="center_content" style="width: 300px;" />
                <ul id="my_menu">
                    <li><a href="/myaccount/site">Setup Your Site</a></li>
                    <li><a href="/myaccount/integration">Integration Code</a></li>
                    <li><a href="/myaccount/profile">Manage Profile</a></li>
                    <li><a href="/myaccount/password">Change Password</a></li>
                    <li><a href="/myaccount/orders">My Orders</a></li>                    
                </ul>
            	</div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       