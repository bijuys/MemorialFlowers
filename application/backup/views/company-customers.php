<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include('company_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Customers signed under you</h2>
                <table class="data_table" width="100%">
                    <?php 

                       if(count($customers)) { ?>
                    <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Joined</th>
                            <th>Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($customers as $customer) {
          
                            ?>
                        <tr>
                            <td align="center"><?php echo $customer->user_id;?></td>
                            <td><?php echo $customer->user_firstname.' '.$customer->user_lastname;?></td>
                            <td align="left"><?php echo $customer->user_email;?></td>
                            <td align="left"><?php echo $customer->user_city;?></td>
                            <td align="left"><?php echo date('d M-Y',strtotime($customer->user_created));?></td>
                            <td align="right"><?php echo $customer->orders;?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr>
                            <td align="center">No Customers Found</td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar"></div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       