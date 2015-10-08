<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content clearfix" id="main-wrapper">
            <div id="left-sidebar"><?php include_once('user_menu.php');?></div>
            <div id="content-main" class="clearfix" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2><?php echo lang('My Order');?> #<?php echo $billing->invoice_id;?></h2>
                <div class="myorder-wrapper">
                    <div id="myorder-items">
                        <h3><?php echo lang('Ordered Items');?></h3>
                            <table border="0" cellpadding="15" cellspacing="0" class="my_cart" width="480" >
                                <?php $total_price =0;
                                foreach($items as $item) { ?>
                                <td class="thumb"><img src="<?php echo img_format('productres/'.$item->product_picture,'stamp');?>"/></td>
                                <td>
                                    <h4><?php echo ucwords(strtolower($item->product_name));?></h4>
                                    <p>
                                    <em><?php echo lang('Sent to');?>:</em> <strong><?php echo $item->firstname.' '.$item->lastname; ?></strong><br/>
                                        <?php echo $item->address1.' '.$item->address2.'<br /> '.$item->city.' '.strtoupper($item->postalcode) . ' ' .$item->province; ?><br/>
                                        <?php echo 'Phone: '.$item->dayphone;?>
                                        <?php echo empty($item->evephone) ? '':' '.$item->evephone;?><br />
                                        <?php echo $item->email;?></p>
                                 <p><em><?php echo lang('Sent On');?>:</em> <strong><?php echo date('l d M Y',strtotime($item->delivery_date));?></strong></p>
                                <p><em><?php echo lang('Message');?>:</em> <?php echo $item->card_message;?></p>
                                </td>
                                <td>
                                    <p><strong><?php echo getRate($item->product_price);?></strong></p>
                                </td>
                                </tr>
                                <?php foreach($item->addons as $addon) {
                                        $total_price += $addon->addon_price*$addon->addon_quantity;                        
                                ?>
                               <tr>
                                    <td class="addonrow">&nbsp;</td>
                                    <td class="addonrow">
                                    [<big>+</big>] <?php echo ucfirst(strtolower($addon->addon_name)); ?> (<?php echo getRate($addon->addon_price); ?>) x <?php echo $addon->addon_quantity;?>
                                    </td>
                                    <td class="addonrow">
                                    <strong><?php echo getRate($addon->addon_price*$addon->addon_quantity)?></strong></td>
                                </tr>
                                <?php
                                    }
                                 } ?>
                            </table>
                             <div class="trackthis">
                                
                                <a href="/myaccount/trackorder/<?php echo $billing->invoice_id;?>"><img src="<?php echo imgLang(theme_url().'/images/trackthis-LN.gif');?>" /></a>
                    
                             </div>
                    </div>
                    <div id="myorder-summary">
                        <h3><?php echo lang('Billing Summary');?></h3>
                        <div class="billing-summary">
                            <?php echo $billing->firstname.' '.$billing->lastname;?><br/>
                            <?php echo $billing->address1.' '.$billing->address2;?><br/>
                            <?php echo $billing->city.' '.$billing->postalcode.' '.$billing->province;?><br/>
                            <?php echo $billing->dayphone.' '.$billing->evephone;?></br>
                            <?php echo $billing->email;?><br/>
                        </div>
                    <ul class="mycart_figures">
                        <li>Total Amount <span><?php echo getRate($billing->amount);?></span></li>
                        <li>Shipping <span><?php echo getRate($billing->shipping);?></span></li>
                        <?php if($billing->service>0) : ?>
                            <li>Service Fee <span><?php echo getRate($billing->service);?></span></li>
                        <?php endif; ?>
                         <?php if($billing->surcharge>0) : ?>
                            <li>Same day surcharge <span><?php echo getRate($billing->surcharge);?></span></li>
                        <?php endif; ?>
                        <li>Tax <span><?php echo getRate($billing->tax);?></span></li>
                        <?php $discount = $billing->discount + $billing->coupon; ?>
                        <?php if($discount>0) : ?>
                        <li>Discount <span><?php echo getRate($discount);?></span></li>
                        <?php endif; ?>
                    </ul>
                    <div class="grandtotal">
                        Grand Total: <?php echo getRate($billing->amount+$billing->shipping+$billing->service+$billing->surcharge+$billing->tax-$discount); ?>
                    </div>
                    </div>
                </div><!-- My Order Wrapper //-->
               
                
            </div> <!-- main -->
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       