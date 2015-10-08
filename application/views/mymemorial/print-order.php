<html>
  <head>
    <title>Your Order</title>
    <style>
    body, td, th {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }
    </style>
  </head>
  <body>
<div id="print-frame">
<div style="width:595px;height:842px;max-height:842px;border:#e1e1e1 1px solid;padding:15px">
<div style="float:right">
    <big>Call Support: <strong>1-877-537-8610</strong></big>
  </div>
  <h2>MemorialFlowers.ca</h2>
  <hr />
  <h3>Your Order: #<?php echo $order->order_id;?></h3>
  <hr>
  
<h4>Product Details</h4>
  <table width="595" border="0" cellspacing="0" cellpadding="0" style="border:#000000 1px solid;padding:10px">
    <tbody>
      <tr>
        <td height="32">ID</td>
        <td>Name</td>
        <td>Value</td>
      </tr>
      <tr>
        <td width="98" height="27">
          <?php if($order->picture) :?>
                    <img src="<?php echo img_format('../pictures/'.$order->picture,'stamp');?>" width="70" height="70" />
                    <?php endif;?>
        </td>
        <td width="347">
          <strong> <?php echo $order->product_id;?> -  <?php echo $order->product;?></strong>
        </td>
        <td width="148">
          <strong> <?php echo '$'.number_format($order->price,2);?></strong>
        </td>
      </tr>
    </tbody>
  </table>
  <h4>Order Details</h4>
  <table width="595" border="0" cellspacing="0" cellpadding="0" style="border:#000000 1px solid;padding:10px">
    <tbody>
      <tr>
        <td height="32">Occasion:</td>
        <td>
          <span class="style1"><strong><?php echo $order->occassion;?></strong></span>
        </td>
        <td width="102">Location type:</td>
        <td width="210">
          <strong> <?php echo $order->locationtype;?></strong>
        </td>
      </tr>
      <tr>
        <td width="134" height="31">Ribbon Text:</td>
        <td width="147">
          <strong><?php echo $order->ribbontext;?></strong>
        </td>
        <td>Date & Time: </td>
        <td>
          <strong><big><?php echo date('d M Y',strtotime($order->orderdate));?> - <?php echo $order->gtime;?></big></strong>
        </td>
      </tr>
      <tr>
        <td width="134" height="31">Order PO:</td>
        <td width="147">
          <strong><?php echo $order->businessname;?></strong>
        </td>
        <td>Ordered by: </td>
        <td>
          <strong><big><?php echo $order->orderedby;?></big></strong>
        </td>
      </tr>
    </tbody>
  </table>
  <h4>Recipient Details</h4>
  <table width="595" height="130" border="0" cellpadding="0" cellspacing="0" style="border:#000000 1px solid;padding:10px">
    <tbody>
      <tr>
        <td width="124" height="35">Recipient Name:    </td>
        <td width="194">
          <strong><?php echo $order->firstname.' '.$order->lastname;?></strong>
        </td>
        <td>&nbsp;</td>
        <td width="275" rowspan="4" style="vertical-align:top;">
            <strong>
               <?php echo $order->address;?>
              <br>
               <?php echo $order->city;?>
              <br>
               <?php echo $order->country;?>
              <br>
               <?php echo $order->postalcode;?>
              <br>
            </strong>
        </td>
      </tr>
      <tr>
        <td width="124" height="31">Telephone:</td>
        <td>
          <strong> <?php echo $order->phone;?></strong>
        </td>
      </tr>
    </tbody>
  </table>
  <h4>Message Card</h4>
  <table width="595" border="0" cellspacing="0" cellpadding="0" style="border:#000000 1px solid;padding:10px">
    <tbody>
      <tr>
        <td colspan="1">
          <p> <?php echo $order->message;?></p>
        </td>
      </tr>
    </tbody>
  </table>
<h4>Special Notes</h4>
  <table width="595" border="0" cellspacing="0" cellpadding="0" style="border:#000000 1px solid;padding:10px">
    <tbody>
      <tr>
        <td colspan="1">
          <p> <?php echo $order->specialnotes;?></p>
        </td>
      </tr>
    </tbody>
  </table>
  
  
</div>
</div>
  </body>
</html>