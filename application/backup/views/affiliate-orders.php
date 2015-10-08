<?php include_once('header.php'); ?>

<?php $gtotal=0.00; ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include('affiliate_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>My Order History</h2>
                <table class="data_table" width="100%">
                    <?php 

                       if(count($orders)) { ?>
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Tax + Shipping</th>
                            <th>Discount</th>
                            <th>Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($orders as $order) {
                            $gtotal += $order->amount+$order->tax + $order->shipping-$order->discount; 
                            ?>
                        <tr>
                            <td align="center"><?php echo $order->order_id;?></td>
                            <td><?php echo date('d M Y', strtotime($order->order_date));?></td>
                            <td align="right"><?php echo '$'.number_format($order->amount,2);?></td>
                            <td align="right"><?php echo '$'.number_format($order->tax + $order->shipping,2);?></td>
                            <td align="right"><?php echo '$'.number_format($order->discount,2);?></td>
                            <td align="right"><?php echo '$'.number_format($order->amount+$order->tax + $order->shipping-$order->discount,2);?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr>
                            <td align="center">No Orders Found</td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                    <div class="info_div right-align">
                        <p>Grand Total: <?php echo '$'.number_format($gtotal,2);?></p>
                        
                    </div>
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar"></div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       