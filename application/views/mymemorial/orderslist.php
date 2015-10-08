<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
<script type="text/javascript">
<!--

  $(function(){
    
    $(".showdet").click(function(event){
    event.preventDefault();
    var id = $(this).attr("rel");
      $("#ord"+id).lightbox_me({destroyOnClose:false,
                               overlayCSS:{background: 'black',opacity: .7}});
    });

  });

//-->
</script>
</head>
<body>
<?php include_once("header.php"); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang($pagename);?></h1>
          <div class="contents">
            <div id="table-wrapper">
              <ul id="tabpages">
                <li <?php echo $pagename=='my_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/active';?>"><?php echo lang('my_orders');?></a></li>
                <li <?php echo $pagename=='completed_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/archived';?>"><?php echo lang('completed_orders');?></a></li>
                <li><a href="<?php echo base_url().'orders/create';?>">New Order</a></li>
              </ul>
            <?php if(count($orders)) :?>
            <div class="tablebg">
            <div class="table" id="orderlist">
              <div class="row headrow">
                <div class="cell">&nbsp;</div>
                <div class="cell"><?php echo lang('order_summary');?></div>
                <div class="cell"><?php echo lang('recipient');?></div>
                <div class="cell"><?php echo lang('address');?></div>
                <div class="cell"><?php echo lang('delivery_on');?></div>
                <div class="cell"><?php echo lang('value');?></div>
                <div class="cell"><?php echo lang('status');?></div>
              </div>
            <?php foreach($orders as $order) : ?>
              <div class="row bodyrow">
                <div class="cell first"><a href="#" class="showdet" rel="<?php echo $order->invoice_item_id;?>"><img src="<?php echo base_url().'images/expand.png';?>" /></a><!--<div class="expandbutton"><a href="#" class="showdet"  rel="<?php echo $order->invoice_item_id;?>">Details</a></div> //--></div>
                <div class="cell"><?php if($order->picture) :?>         
                    <img src="<?php echo img_format('../pictures/'.$order->picture,'stamp');?>" width="70" height="70" />
                    <?php endif;?></div>
                <div class="cell"><?php echo $order->firstname.'<br/>'.$order->lastname; ?></div>
                <div class="cell"><?php echo $order->address.'<br/>'.$order->city.' '.$order->postalcode.'<br/>'.$order->province.' '.$order->country; ?></div>
                <div class="cell"><?php echo date('d M Y',strtotime($order->deliverydate));?><br/>
                <?php echo $order->gtime;?>
                </div>
                <div class="cell"><?php echo '$'.number_format($order->price,2);?></div>
                <div class="cell" style="text-align:center;">
                  <div class="buttonwrap">
                    <?php if($order->sendtime=='') { ?>
                  <a href="<?php echo base_url().'orders/send/'.$order->invoice_item_id;?>" class="send_button"><?php echo lang('send_item');?></a>
                  <?php } else { ?>
                  <!-- 
                  <a href="<?php echo base_url().'orders/confirm/'.$order->invoice_item_id;?>" class="send_button"><?php echo lang('confirm_delivery');?></a> //--> 
                  <?php } ?>
                  </div>
                  <div class="buttonwrap">
                  <a href="<?php echo base_url().'orders/printitem/'.$order->invoice_item_id;?>" class="print_button"><?php echo lang('print_order');?></a></div>
                </div>
              </div>

                <div class="order_details clearfix" id="ord<?php echo $order->invoice_item_id;?>" style="display: none;" >
                <div class="wrapper">
                  <h1><?php echo lang('order_details');?> (#<?php echo $order->invoice_item_id;?>)<span class="closethis"><a href="#" class="close"><img src="<?php echo base_url().'images/close.png';?>" /></a></span></h1>
                  <div class="inner-wrapper">
                  <div class="prodimage clearfix">
                    <?php if($order->picture) :?>
                    <img src="<?php echo '/pictures/'.$order->picture;?>" width="300" height="300" />
                    <?php endif;?>
                    <div class="prodname">
                      <h2><?php echo $order->product;?> (<?php echo $order->product_id;?>)</h2>
                      <p><big>Qty: <?php echo $order->quantity . ' x $'. number_format($order->amount,2);?></big></p>
                    </div>
                  </div>
                  <div class="proddetails clearfix">
                    <div>
                    <p><?php echo lang('delivery_on');?>: <strong><?php echo date('d M Y',strtotime($order->orderdate));?> <?php echo $order->gtime;?></strong></p>
                    <p><?php echo lang('location_type');?>: <strong><?php echo $order->locationtype;?></strong></p>
                    </div>
                    <div>
                    <p><?php echo lang('card_message');?>: <strong> <?php echo $order->message; ?></strong></p>
                    <p><?php echo lang('ribbon_text');?>: <strong><?php echo $order->ribbontext;?></strong></p>
                    </div>
                  <div class="deladdress">
                    <p><?php echo lang('recipient_name');?>: <strong> <?php echo $order->firstname.' '.$order->lastname;?></strong></p>
                    <p><?php echo lang('delivery_address');?>: <strong><br/> <?php echo $order->address;?><br/>
                    <?php echo $order->city;?><br/>
                    <?php echo $order->postalcode;?><br/>
                    <?php echo $order->province;?><br/>
                    <?php echo $order->country;?></strong>
                    </p>                   
                  </div>
                  <div class="delmessages">
                    <p><?php echo lang('ordered_by');?>: <strong><?php echo $order->orderedby;?></strong></p>
                    <p><?php echo lang('order_po');?>: <strong><?php echo $order->businessname;?></strong></p>
                    <p><?php echo lang('special_notes');?>: <strong><?php echo $order->specialnotes;?></strong></p>
                  </div>
 <?php if($order->sendtime=='') { ?>
                  <a href="<?php echo base_url().'orders/send/'.$order->invoice_item_id;?>" class="send_button"><?php echo lang('send_item');?></a>
                  <?php } else { ?>
                  <a href="<?php echo base_url().'orders/confirm/'.$order->invoice_item_id;?>" class="send_button"><?php echo lang('confirm_delivery');?></a>
                  <?php } ?> 
                  <a href="<?php echo base_url().'orders/printitem/'.$order->invoice_item_id;?>" class="print_button"><?php echo lang('print_order');?></a>
                  </div>
                  <div class="clear"></div>
                  </div>
                </div>
                </div><!-- Order Detail //-->
            <?php endforeach; ?>
            </div><!-- Table Row-->
            </div>
            <div class="pagenav">
            <?php echo $links; ?> <?php echo $totalpages.' Orders in Total'; ?>
            </div>
            <?php else : ?>
            <div class="table" id="orderlist">
              <div class="row">
                <div class="cell norecords"><p>Sorry no order found!</p></div>
              </div>
            </div>
            
            
            <?php endif; ?>
            
            </div>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
         <?php include_once('widget_order_search.php'); ?>
         <?php include_once('widget_cart.php'); ?>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
