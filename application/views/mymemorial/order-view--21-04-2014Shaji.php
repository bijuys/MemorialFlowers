<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
  <div id="content" class="clearfix">
    <div id="page">
      <h1><?php echo lang('My Orders');?></h1>
      <div class="contents">
        <h3>Invoice ID: <?php echo '#'.$order->invoice_id;?></h3>
        <p>Order Date: <?php echo date('d M Y',strtotime($order->order_date));?></p>
        <ul class="nav nav-tabs" id="myTab">
          <?php $counter = 0;
          
          foreach($order->items as $item) : $counter++; ?>
          <li <?php if($counter===1) { echo ' class="active" '; } ?>><a href="#tab<?php echo $counter;?>">Item #<?php echo $counter;?></a></li>
          <?php endforeach; ?>
        </ul>
 
        <div class="tab-content">
        <?php $counter = 0;
        foreach($order->items as $item) : $counter++; ?>
         <div class="tab-pane <?php if($counter===1) { echo ' active'; } ?>" id="tab<?php echo $counter;?>">
        <div class="row-fluid">
          <div class="span6">
            <img src="<?php echo img_format('productres/'.$item->product_picture, 'thumbpng');?>" />
            <h3><?php echo $item->product_name; ?></h3>
            <p class="lead"> 1 & <?php echo getRate($item->product_price);?> = <?php echo getRate($item->product_price);?></p>
          </div>
          <div class="span12">
            
            <div class="box">
              <p><em>Delivery On: </em><strong><span class="lead"><?php echo date('d M Y',strtotime($item->delivery_date));?></span></strong></p>
               <p><em>Delivery Time: </em><strong><span class="lead"><?php echo $item->delivery_time ;?></span></strong></p>
            </div>
            
            <div class="box">
              <p><em>Delivery To : </em><br/> <strong><?php echo $item->location_type;?></strong></p>
              <p><em>Recepient : </em> <br/> <strong><?php echo $item->firstname.' '.$item->lastname;?></strong><br/><strong><?php echo $item->address1.' '.$item->address2.' '.$item->city.' '.$item->postalcode;?>
                <?php echo $item->province.' '.$item->country_id; ?></strong>
              </p>
            </div>
            
            <div class="box">
              <p><em>Card Text :</em> <br/> <strong><?php echo $item->card_message;?></strong></p>
              <p><em>Ribbon Message:</em> <br/> <strong><?php echo $item->ribbon_text;?></strong></p>
            </div>
            
            <div class="box">
              <p><em>Ordered by :</em>  <strong><?php echo $item->order_by;?></strong></p>
              <p><em>Order PO : </em> <strong><?php echo $item->order_po; ?></strong></p>
              <p><em>Special Notes : </em><br/> <strong><?php echo $item->special_note; ?></strong></p>
            </div>
            
            <a href="/mymemorial/orders/printview/<?php echo $order->order_id;?>" class="btn btn-inverse">Print this Order</a>
            
          </div>
          <div class="span6">
            <div>
              <table class="table">
                <tr>
                  <td>Merchandise Total</td>
                  <td><?php echo getRate($order->amount);?></td>
                </tr>
                <tr>
                  <td>Shipping</td>
                  <td><?php echo getRate($order->shipping);?></td>
                </tr>
                <tr>
                  <td>Tax</td>
                  <td><?php echo getRate($order->tax);?></td>
                </tr>
                <tr>
                  <td>Grand Total</td>
                  <td><?php echo getRate($order->amount + $order->shipping + $order->tax);?></td>
                </tr>
              </table>
              
            </div>            
          </div><!-- Span6 //-->
        </div><!-- Row Fluid //-->
      </div><!-- Tab Pane //-->
        <?php endforeach; ?>
      </div><!-- Tab Content //-->
        <script>
            $(function () {
                  $('#myTab a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                  })
            })
        </script>
      </div><!-- Contents //-->
    </div><!-- Page //-->
  </div><!-- Content //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
</body>
</html>
