<html lang="en">
<head>
<meta name="robots" content="noodp,noydir" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Details <?php echo '#'.$order->invoice_id;?> - MemorialFlowers.ca</title>
<link href="<?php echo theme_url();?>/css/bootstrap.css" rel="stylesheet" />
<style>

body {

}

#content {
  width: 780px;
  margin: 15px;

}

body, td, th {
    font-size: 90%;
}

.table th {
  background-color: #FAFAFA;
  font-weight: normal;
}

.table td {
  font-weight: bold;
}

h2 {
  font-size: 150%;
  margin: 0px;
  
}

h3 {
  font-size: 130%;
  margin: 0px;
}

h4 {
  font-size: 110%;
  margin: 10px 0px;
}

</style>
<script>

  window.print();


</script>
</head>
<body>
  <div id="content" class="clearfix">
    <div id="page">
      <h2 style="text-align:center; border-bottom: 1px solid #CCCCCC;"><?php echo lang('Order Details');?></h2>
      <div class="contents">
        <h3>Invoice ID: <?php echo '#'.$order->invoice_id;?></h3>
        <p>Order Date: <?php echo date('d M Y',strtotime($order->order_date));?></p>
        
        <div class="row-fluid">
          <div class="span16">
              <?php $counter = 0;
                    foreach($order->items as $item) : $counter++; ?>
                        <div  id="tab<?php echo $counter;?>" style="border: 1px solid #CCC; padding: 15px; margin: 15px 0;">
                            <div class="row-fluid">
                                <div class="span10">
                                  <img src="<?php echo img_format('productres/'.$item->product_picture, 'thumbpng');?>" />
                                  <h4 style="line-height: 140%;"><?php echo $item->product_name; ?></h4>
                                  <p> 1 & <?php echo getRate($item->product_price);?> = <?php echo getRate($item->product_price);?></p>
                                </div>
                                
                                <div class="span14">
                
                                  <table class="table">
                                      <tr>
                                        <th>Delivery on</th>
                                        <td><?php echo date('d M Y',strtotime($item->delivery_date));?></td>
                                      </tr>
                                      <tr>
                                        <th>Delivery to</th>
                                        <td><?php echo $item->location_type;?></td>
                                      </tr>
                                      <tr>
                                        <th>Recepient</th>
                                        <td><?php echo $item->firstname.' '.$item->lastname;?>
                                          <br/><?php echo $item->address1.' '.$item->address2.' '.$item->city.' '.$item->postalcode;?><br/>
                                          <?php echo $item->province.' '.$item->country_id; ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Card Text</th>
                                        <td><?php echo $item->card_message;?></td>
                                      </tr>
                                      <tr>
                                        <th>Ribbon Message</th>
                                        <td><?php echo $item->ribbon_text;?></td>
                                      </tr>
                                      <tr>
                                        <th>Ordered by</th>
                                        <td><?php echo $item->order_by;?></td>
                                      </tr>
                                      <tr>
                                        <th>Order PO</th>
                                        <td><?php echo $item->order_po; ?></td>
                                      </tr>
                                      <tr>
                                        <th>Special Notes</th>
                                        <td><?php echo $item->special_note; ?></td>
                                      </tr>
                                    </table>
                                  </div><!-- End of Span //-->
                                </div><!-- Row Fluid //-->          
                          </div><!-- Tab Pane //-->
                  <?php endforeach; ?>
        </div><!-- End of Span //-->
                  
        <div class="span8">
          <div  style="border: 1px solid #CCC; padding: 15px; margin: 15px 0;">
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
          </div>
        </div>
      </div><!-- Contents //-->
    </div><!-- Page //-->
  </div><!-- Content //-->
  </body>
</html>
