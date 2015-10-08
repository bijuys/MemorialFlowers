<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix" id="main-wrapper">
            <div id="left-sidebar"><?php include_once('user_menu.php');?></div>
            <div id="content-main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('My Order');?> #<?php echo $order->invoice_id;?> </h2>
                <div class="myorder-wrapper">
                    <?php foreach($items as $item) : ?>
                        <div class="status_box">
                            <?php if($item->delivered) { ?><img src="<?php echo theme_url();?>/images/right.gif" style="vertical-align: middle;" /> <span class="green">Delivered</span><?php } ?>
                        </div>
                    <h3><?php echo lang('Item Tracking No');?>: <?php echo $item->tracking_code;?> </h3>
                    <table border="0" cellpadding="15" cellspacing="0" class="data_table" width="100%" >
                        <tr>
                            <th width="27%">Product</th>
                            <th width="27%">Recepient</th>
                            <th width="26%">Status</th>
                            <th width="11%">Date</th>
                            <th width="9%">Time</th>
                        </tr>     
                        <?php
                                if(count($item->tracking)) :
                                    foreach($item->tracking as $track) :
                                    
                                    $ltime = explode('|',$track->activity_time);
                                    
                                    ?>
                        <tr>
                            <td class="left"><?php echo $item->product_name; ?></td>
                            <td><?php echo $item->firstname.' '.$item->lastname; ?></td>
                            <td class="left"><?php echo $track->activity; ?></td>
                            <td class="left"><?php echo $ltime[0]; ?></td>
                            <td class="left"><?php echo isset($ltime[1]) ? $ltime[1]:''; ?></td>
                        </tr>
                            <?php
                                endforeach;
                                endif;
                                ?>
                    </table>
                    <br />
                    <?php   
                            endforeach;   
                    ?>
                </div><!-- My Order Wrapper //-->
               
                
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       