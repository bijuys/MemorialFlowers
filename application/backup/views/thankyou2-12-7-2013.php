<?php

$body = <<<BODY

<script type="text/javascript">
	document.write(unescape("%3Cscript src='"
		+ ((document.location.protocol == "https:") ? "https:" : "http:")
		+ "//p.bm23.com/bta.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	var bta = new __bta('bvvqnvtvffundtrubmhhrsjocigpbmg');
	bta.setHost("email.memorialflowers.ca");
</script>

BODY;

$footer = <<<FOOTER

<script type="text/javascript">
	// Uncomment one of the following to track conversions
	 
	// 1) Legacy conversion tracking
	 {conversion}

	// 2) New, more detailed conversion tracking
	/*
	bta.addConversion({ "order_id": "", "date": "", "items": [
		{ "item_id":"item1", "desc":"description", "amount":"$123.33", "quantity":"1" },
		{ "item_id":"item2", "desc":"description 2", "amount":"$10.25", "quantity":"1" }
	]});
	*/

</script>

FOOTER;

$footer = str_replace('{conversion}',$conversion,$footer);



?>

<?php include_once('header.php'); ?>
<script src="https://thesearchagency.net/tsawaypoint.php?siteid=855&wayid=7685 " language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol ) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
  var pageTracker = _gat._getTracker("UA-36491898-1");
  pageTracker._trackPageview();
  
  <?php echo $googlecode; ?>

   pageTracker._trackTrans(); //submits transaction to the Analytics servers
} catch(err) {}
</script>

<!-- Google Code for Transaction Conversion Page --> <script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1063231275;

var google_conversion_language = "en";

var google_conversion_format = "2";

var google_conversion_color = "ffffff";

var google_conversion_label = "4dzoCM-GiwIQq77--gM"; var google_conversion_value = 0;

/* ]]> */

</script>

<script type="text/javascript" 

src="https://www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">
  

<img height="1" width="1" style="border-style:none;" alt="" 

src="https://www.googleadservices.com/pagead/conversion/1063231275/?value=<?php echo $invoiceTotal; ?>&amp;label=4dzoCM-GiwIQq77--gM&amp;guid=ON&amp;script=0"/>

</div>

</noscript>

        <div id="content-wrapper">
            <div class="content">
            <div id="main" style="width:980px;" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>

                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
		<?php echo $tsa; ?>
		<img src="https://325618.r.msn.com/?dedup=1&domainId=325618&type=1&actionid=101978" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none">

            <div class="centered">
            <h2><?php echo lang('Thank you');?></h2>
            <p><?php echo $message;?> <?php echo lang('Invoice No');?>: <?php echo $invoice_number;?></p>
            <p>&nbsp;<?php echo $linkimg; ?>
                
                <?php echo $emlimg; ?>
            
            </p>
	    <div class="order-summary">
	            <h3><?php echo lang('Invoice Summary');?></h3>
		    <hr />
                     <p class="address">
                        <?php echo $billing->firstname.' '.$billing->lastname;?><br />
                        <?php echo $billing->address1.' '.$billing->address2;?><br />
                        <?php echo $billing->city.' - '.$billing->postalcode;?><br />
                        <?php echo $billing->province;?><br />
                        <?php echo $billing->dayphone.' '.$billing->evephone;?><br />
                        <?php echo $billing->email;?></p>

                    <table border="0" cellpadding="15" cellspacing="0" class="shopping_cart" width="480" >
                        <?php $total_price =0;
                        foreach($items as $item) { ?>
                        <tr><th colspan="3"><?php echo ucwords(strtolower($item->product_name));?> <small></small></th>
                        <tr>
                        <td class="thumb"><img src="<?php echo img_format('productres/'.$item->product_picture,'stamp');?>"/></td>
                        <td>
                            <p>
                            <em><?php echo lang('Ships to');?>:</em>
                                <?php echo $item->address1.' '.$item->address2.'<br /> '.$item->city.'-'.$item->postalcode;?><br />
                                <?php echo $item->province.' '.$item->dayphone;?>
                                <?php echo empty($item->evephone) ? '':' '.$item->evephone;?><br />
                                <?php echo $item->email;?></p>
                         <p><?php echo lang('On');?>: <?php echo date('l d M Y',strtotime($item->delivery_date));?></p>
                        <p><em><?php echo lang('Message');?>:</em> <?php echo $item->card_message;?></p>
                        </td>
                        <td>
                            <p><?php echo getRate($item->product_price);?></p>
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
                            <?php echo getRate($addon->addon_price*$addon->addon_quantity)?></td>
                        </tr>
                        <?php
                            }
                         } ?>
                        </table>
		    <table cellpadding="3" cellspacing="0" class="payment_info" border="0" >
                        <tr>
                            <td><?php echo lang('Product Total');?></td>
                            <td class="price"><?php echo getRate($totals['itemtotal']);?></td>
                        </tr>
                        <?php 
                         if(($totals['discount']+$totals['coupon'])>0) {
                        ?>
                        <tr>
                            <td><?php echo lang('Discount');?></td>
                            <td class="price">-<?php echo getRate($totals['discount']+$totals['coupon']);?></td>
                        </tr>
                        <?php 
                        }
                        
                         if($totals['companyless']>0) {
                        ?>
                        <tr>
                            <td><?php echo lang('Company Customer Less');?></td>
                            <td class="price">-<?php echo getRate($totals['companyless']);?></td>
                        </tr> 
                        <?php
                        }
                        
                        ?>
                        <tr>
                            <td><?php echo lang('Shipping');?></td>
                            <td class="price"><?php echo getRate($totals['shipping']);?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('Tax');?></td>
                            <td class="price"><?php echo getRate($totals['tax']);?></td>
                        </tr>
                        <tr>
                            <td class="gtotal"><strong><?php echo lang('Grand Total');?></strong></td>
                            <td class="gtotal price"><strong><?php echo getRate($totals['grandtotal']);?></strong></td>
                        </tr>
                    </table>
	    </div>
            <p>&nbsp;</p>
            <p><small><a href="<?php echo site_url();?>"><?php echo lang('Back to Home');?></a></small></p>
            </div>
            
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
<?php die();?>
       