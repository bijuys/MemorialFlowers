<?php include_once('header.php'); ?>

<?php $gtotal=0.00; ?>
        <div id="content-wrapper">
            <div class="content clearfix">
            <div id="left-sidebar"><?php include('affiliate_menu.php');?></div>
            <div id="main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Affiliate Reports Product Sales</h2>
                <table class="data_table" width="100%">
                    <?php 

                       if(count($records)) { ?>
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Product</th>
                            <th>Total Sales</th>
                            <th>Amount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($records as $row) {
                             
                            ?>
                        <tr>
                            <td align="center"><?php echo $row->product_id;?></td>
                            <td align="left"><?php echo $row->product_name;?></td>
                            <td align="center"><?php echo $row->sales;?></td>
                            <td align="right"><?php echo '$'.number_format($row->product_price,2);?></td>
                            <td align="right"><?php echo '$'.number_format($row->product_price*$row->sales,2);?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } else { ?>
                    <tbody>
                        <tr>
                            <td align="center">No Records Found</td>
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
       