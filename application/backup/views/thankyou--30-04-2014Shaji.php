<?php

$body = <<<BODY



BODY;

$footer = <<<FOOTER



FOOTER;

$footer = str_replace('{conversion}',$conversion,$footer);



?>

<?php

$gtrack = <<<GTRACK



GTRACK;

?>


<?php include_once('header.php'); ?>

            <div class="content">
            <div id="main-content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>

                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
		
                
            <div>
            <h2 class="text-center"><?php echo rightLang($page->contents,$page->contents_fr);?></h2>
            <p class="lead text-center"><?php echo lang('Invoice #');?>: <?php echo $invoice_number;?></p>
            <p>&nbsp;</p>
	    
            <div class="row-fluid">
                <div class="span12">
                    <table border="0" cellpadding="15" cellspacing="0" class="table" >
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
                    
                </div>
                <div class="span12">
                    <div id="text-left">
                        <table class="table">
                            <tr>
                                <td colspan="2"> <?php echo $billing->firstname.' '.$billing->lastname;?><br/>
                                    <?php echo $billing->address1.' '.$billing->address2;?><br/>
                                    <?php echo $billing->city.' '.$billing->postalcode.' '.$billing->province;?><br/>
                                    <?php echo $billing->dayphone.' '.$billing->evephone;?></br>
                                     <?php echo $billing->email;?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Amount</td>
                                <td class="right"><?php echo getRate($totals['itemtotal']);?></td>
                            </tr>
                            <!--<tr>
                                <td>Shipping</td>
                                <td class="right"><?php //echo getRate($totals['shipping']);?></td>
                            </tr>-->
                            <?php if($totals['service']>0) : ?>
                            <tr>
                                <td>Delivery fee </td>
                                <td class="right"><?php echo getRate($totals['service']);?></td>
                            </tr>
                            <?php endif; ?>
                            <?php //if($totals['surcharge']>0) : ?>
                            <!--<tr>
                                <td>Same day surcharge</td>
                                <td class="right"><?php //echo getRate($totals['surcharge']);?></td>
                            </tr>-->
                            <?php //endif; ?>
                            <tr>
                                <td>Tax</td>
                                <td class="right"><?php echo getRate($totals['tax']);?></td>
                            </tr>
                            <?php //$discount = $totals['discount']+$totals['coupon']; ?>
                            <?php // if($discount>0) : ?>
                           <!-- <tr>
                                <td>Discount</td>
                                <td class="right"><?php// echo getRate($discount);?></td>
                            </tr>-->
                            
                            
                               <?php //if(($totals['coupon']+$totals['discount'])>0) : 
                            //san code here. for actual file take a look on server named file thankyou-12-7-2013
                            $affid=$this->session->userdata('referer');
							$bothsum=0;
                            if($totals['coupon']>0){
								
							$bothsum=$totals['coupon']+$totals['discount'];
							}
							if($affid!='') {
							$bothsum=0;	
							}
							?>
                             <?php 
								
								
								//if($bothsum>0) { ?>
                          
                           
                           <tr>
                                <td>
								
								<?php 
								$dist = $totals['coupon']+$totals['discount'];
								echo lang('Discount');?></td>
                                <td class="right">-<?php echo getRate($dist);
								//echo getRate($bothsum);
								
								?></td>
                            </tr>
                            
                            <?php //} //endif; ?>
                            
                           
                            <tr>
                                <th>Grand Total:</th>
                                <th class="right"><?php echo getRate($totals['grandtotal']); ?></th>
                        </table>

                    </div>
                    
                </div><!-- Span 12 //-->
            </div><!-- Row Fluid //-->
                
  

                </div><!-- My Order Wrapper //-->
         <!--   <p class="text-center"><small><a href="<?php //echo site_url();?>"><?php //echo lang('Back to Home');?></a></small></p>-->
            
             <p class="text-center"><small><a href="http://www.funeralflowers.ca/affiliate/mf"><?php echo lang('Back to Home');?></a></small></p>
            </div>
            
            </div> <!-- main -->

            </div> <!-- content -->

<?php include_once('footer.php'); ?>
<?php die();?>
       