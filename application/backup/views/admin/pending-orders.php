<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php if(isset($ptitle)) { echo $ptitle; } ?> Orders</h2>
    <?php if(count($orders)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>#ID</th>
        <th>Customer</th>
        <th>Date & Time</th>
        <th>Items</th>
        <th>Total</th>
        <th>Affiliate</th>
        <th>Pay By</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($orders as $row) : ?> 
      <tr>
        <td><?php echo $row->invoice_id;?></td>
        <td class="left"><?php
        if($row->cfirstname!='') {
            echo ucwords($row->cfirstname .' '.$row->clastname);
        } else {
            echo ucwords($row->bfirstname .' '.$row->blastname.' (Unregistered)');            
        }
        
        ?></td>
        <td class="left"><?php echo date('d M Y - g:ia',strtotime($row->order_date));?></td>
        <td><?php echo $row->items;?></td>
        <td class="right"><?php echo '$'.number_format(($row->amount+$row->tax+$row->shipping-$row->coupon-$row->discount-$row->company_less),2);?></td>
        <td class="left"><?php echo $row->user_name;?></td>
        <td><?php
        switch($row->payment_method)
        {
          case 'credit_card':
          {
            echo 'CC';
            break;
          }
          case 'company_pay':
            {
              echo 'AC';
              break;
            }         
        }
        
        ?></td>
        <td class="left"><?php echo $row->status_code;?></td>
        <td class="left"><input type="button" value="Details" name="details" onclick="javascript: window.location='/siteadmin/orders/view/<?php echo $row->order_id;?>';" /></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php echo isset($pagination) ? $pagination:''; ?>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No Orders Found.</p>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>