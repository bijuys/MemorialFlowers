 <?php if(!isset($current_page) || (isset($current_page) && $current_page!='company-home')) { ?>  
    <div class="sidebar_info">Welcome <?php echo $this->session->userdata('user_firstname');?>, Change your account settings here. For more help please contact our <a href="/contact">support center</a></div>
<?php } ?>
    <ul id="my_menu">
                    <li class="shopbutton"><a href="/products">Go Shopping!</a></li> 
        <?php if(!isset($current_page) || (isset($current_page) && $current_page!='company-home')) { ?>
                    
                    <li><a href="/company/">Corporate Home</a></li>       
        <?php } ?>
                    <li><a href="/company/profile">Company Profile</a></li>
                    <li><a href="/company/discount">Discount Settings</a></li>
                    <li><a href="/company/password">Change Password</a></li>
                    <li><a href="/company/customers">Customer List</a></li>
                    <li><a href="/company/orders">Order History</a></li>
                    <li><a href="/company/logout">Logout</a></li>     
    </ul>
