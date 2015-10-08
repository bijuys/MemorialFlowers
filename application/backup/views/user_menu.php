       <?php if(!isset($current_page) || (isset($current_page) && $current_page!='user-home')) { ?>
    <div class="sidebar_info">Welcome <?php echo $this->session->userdata('user_firstname');?>, Change your account settings here. For more help please contact our <a href="/contact">support center</a></div>
    <?php } ?>
    <ul id="my_menu">
        <?php if(!isset($current_page) || (isset($current_page) && $current_page!='user-home')) { ?>
                     <li><a href="/myaccount/">My Account</a></li>       
        <?php } ?>
                    <li><a href="/">Send a Gift</a></li>
                    <li><a href="/myaccount/profile">Manage Profile</a></li>
                    <li><a href="/myaccount/password">Change Password</a></li>
                    <li><a href="/myaccount/orders">My Orders</a></li>
                    <li><a href="/myaccount/track">Track My Orders</a></li>
                    <li><a href="/myaccount/logout">Logout</a></li>     
    </ul>
