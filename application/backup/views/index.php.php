<?php include_once('header.php');
        include_once('homebox.php');
?>
        <div id="content-wrapper">
            <div id="content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
            
            <div id="middle_banners">
                <img src="/images/discount.jpg" /><img src="/images/shopnow.gif" />
            </div> <!-- middle_banners... -->
            <div id="products" >
            <?php foreach($products as $row)
            { ?>
                <p class="product">
                    <a href="#"><img src="/products/<?php echo $row->product_thumbnail;?>" width="180" height="220" border="0" /></a><span><?php $prc = number_format($row->price_value,2);
                            list($amt,$dec) = explode('.',$prc);
                            echo '$'.$amt.'.';
                    ?><em><?php echo $dec; ?></em></span>
                </p>
            <?php } ?>
            <div class="clear" /></div>
            </div> <!-- products -->
            <div id="bottom_banners">
                <img src="/images/purchase.gif" />
            </div> <!-- middle_banners... -->
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php   include_once('footer.php'); ?>
       