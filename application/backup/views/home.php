<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>FlowersCanada Welcomes you</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">
<body>
    <div id="container" >
        <div id="toprow">
            <small>16:30 April 4 2010 EST | Welcome Guest</small>
            <ul>
                <?php foreach($topmenu as $row) { ?>
                <li<?php echo strtoupper($row->menuitem)==strtoupper($current_page) ? ' class="current"':'';?>><a href="<?php echo $row->menulink;?>" ><?php echo $row->menuitem;?></a></li>            
                <?php } ?>
            </ul>
        </div>
        <div id="header">
            <a href="/"><h1><span>memorialflowers.ca</span></h1></a>
            <div class="call">Call 9894035671</div>
            <div id="tinycart">Your cart contains 3 items | <a href="#">View Cart</a> <br /> Total Amount $136.50 | <a href="#">Checkout</a></div>
        </div> <!-- header ends -->
        <ul id="navigation">
            <?php foreach($mainmenu as $row) { ?>
            <li<?php echo strtoupper($row->menuitem)==strtoupper($current_page) ? ' class="current"':'';?>><a href="<?php echo $row->menulink;?>" ><?php echo $row->menuitem;?></a></li>            
            <?php } ?>
        </ul>
        <div id="home">
            <div id="home_search">
                <h2><span>Need Flowers Today?</span></h2>
                <?php echo form_open('',array('name'=>'search-form','id'=>'search-form')); ?>
                    <input type="text" name="search" id="search" value="Enter Postalcode" class="input_text" /><input type="image" src="/images/go.gif" class="input_go" />
                <?php echo form_close(); ?>
                <ul id="main_categories">
                    <?php foreach($maincategories as $row) { ?>
                    <li><a href="#"><?php echo $row->category_name;?> <?php if(strlen($row->category_name)<8) { echo 'Collection'; } ?></a></li>                        
                    <?php } ?>
                </ul>
            </div> <!-- home search -->
            <div id="slider">
                <img src="/images/temp.jpg" />
            </div> <!-- slider end -->
        </div> <!-- home end -->
        <div id="content-wrapper">
            <div id="content">
            <div id="top_banners" class="category_banners" >
                <img src="/images/banner1.jpg" /><img src="/images/banner2.jpg" /><img src="/images/banner3.jpg" class="last" />
            </div> <!-- small_banners -->
            
            <div id="middle_banners">
                <img src="/images/discount.jpg" /><img src="/images/shopnow.gif" />
            </div> <!-- middle_banners... -->
            <div id="products" >
            <?php foreach($group_products as $groups) : ?>
            <?php foreach($groups->products as $row) : ?>
                <p class="product">
                    <a href="/products/item/<?php echo $row->product_code.'';?>">
                    <img src="/products/<?php echo $row->product_thumbnail;?>" width="180" height="220" border="0"  alt="<?php echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  /></a>
                    <span><?php echo getRate($row->price_value); ?></span>
                </p>
            <?php endforeach; ?>
            <div class="clear" /></div>
            <?php endforeach; ?>
            <div class="clear" /></div>
            </div> <!-- products -->
            <div id="bottom_banners">
                <img src="/images/purchase.gif" />
            </div> <!-- middle_banners... -->
            </div> <!-- content -->
        </div> <!-- content wrapper -->
        <div id="footer">
            <p class="footer_nav">
            <?php $seperator = '';
                  foreach($footermenu as $row)
                  {
                    if($row->menuitem=='<br/>')
                    {
                        $seperator = '';
                        echo $row->menuitem;
                    }
                    else
                    {
                        echo $seperator;
            ?>
              <a href="<?php echo $row->menulink;?>" ><?php echo $row->menuitem;?></a>            
            <?php   $seperator = '|';
                    }
                }
            ?>
            </p>
            <p class="copyright">
                &copy; 2010 memorialflowers.ca All rights are reserved.<br />
                <big>memorialflowers.ca</big>
            </p>
            <div class="clear"></div>
        </div> <!--footer-->
        
    </div> <!-- container -->
</body>
</html>
