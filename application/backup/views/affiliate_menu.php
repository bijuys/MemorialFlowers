 <?php if(!isset($current_page) || (isset($current_page) && $current_page!='affiliate-home')) { ?>  
    <div class="sidebar_info">Welcome <?php echo $this->session->userdata('user_firstname');?>, Change your account settings here. For more help please contact our <a href="/contact">support center</a></div>
<?php } ?>
    <ul id="my_menu">
        <?php if(!isset($current_page) || (isset($current_page) && $current_page!='affiliate-home')) { ?>
                     <li><a href="/affiliates/">Affiliate Home</a></li>       
        <?php } ?>
                    <li><a href="/affiliates/site">Setup Your Site</a></li>
                    <li><a href="/affiliates/integration">Integration Code</a></li>
                    <li><a href="/affiliates/profile">Manage Profile</a></li>
                    <li><a href="/affiliates/password">Change Password</a></li>
                    <li><a href="/affiliates/orders">My Orders</a></li>
                    <li><a href="/affiliates/commissions">My Commissions</a></li>
                    <li><a href="/affiliates/reports">Reports</a></li>
                    <li><a href="/affiliates/logout">Logout</a></li>     
    </ul>
