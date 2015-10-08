<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix" >
            <div id="left-sidebar"><?php include('affiliate_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>My Commissions</h2>
                    <div class="info_div">
                        <p>Last Payment On: <?php echo $last_payment ? $last_payment:'No Payments';?></p>
                    </div>
                <table class="data_table" width="100%">
                    <?php $totalcomm = 0;
                     if(count($orders)) { ?>
                    <thead>
                        <tr>
                            <th>#Order</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>%</th>
                            <th>Earning</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalcomm = 0;
                        foreach($orders as $order) {
                            $total = $order->amount-$order->discount;
                            $totalcomm += $order->commission;
                            ?>
                        <tr>
                            <td align="center"><?php echo $order->order_id;?></td>
                            <td><?php echo date('d M Y', strtotime($order->order_date));?></td>
                            <td><?php echo $order->user_firstname.' '.$order->user_lastname;?></td>
                            <td align="right"><?php echo '$'.number_format($total,2);?></td>
                            <td align="right"><?php echo number_format($order->commission*100/$total,2).'%';?></td>
                            <td align="right"><?php echo '$'.number_format($order->commission,2);?></td>
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
                        <p>Total outstanding Amount: <?php echo '$'.number_format($totalcomm,2);?></p>
                    </div>
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar"></div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       