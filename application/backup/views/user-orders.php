<?php include_once('header.php'); ?>

<?php $gtotal=0.00; ?>
        <div id="content-wrapper">
            <div class="content clearfix" id="main-wrapper">
            <div id="left-sidebar"><?php include_once('user_menu.php');?></div>
            <div id="content-main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo('My Order History');?></h2>
                <table class="data_table">
                    <?php 

                       if(count($orders)) { ?>
                    <thead>
                        <tr>
                            <th><?php echo('Order No');?></th>
                            <th><?php echo('Date');?></th>
                            <th><?php echo('Items');?></th>
                            <th><?php echo('Send To');?></th>
                            <th><?php echo('Invoice Total');?></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($orders as $order) {
                            $gtotal += $order->amount+$order->tax + $order->shipping-$order->discount; 
                            ?>
                        <tr>
                            <td align="center"><a href="/myaccount/view/<?php echo $order->order_id;?>"><?php echo $order->invoice_id;?></a></td>
                            <td><?php echo date('d M Y', strtotime($order->order_date));?></td>
                            <td><?php echo $order->items;?></td>
                            <td style="text-align:left;"><?php echo ucfirst(strtolower($order->firstname)); ?></td>
                            <td align="right"><?php echo '$'.number_format($order->amount+$order->tax+$order->shipping+$order->service+$order->surcharge-$order->discount,2);?></td>
                            <td><a href="/myaccount/view/<?php echo $order->order_id;?>"><?php echo lang('View Details');?></a></th>                        
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo lang('No Orders Found');?></td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       