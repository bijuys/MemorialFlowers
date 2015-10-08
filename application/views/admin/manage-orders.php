<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2><?php if(isset($ptitle)) { echo $ptitle; } ?> Orders</h2>
    <?php if(count($orders)): ?>
    <div id="shadow">
      <?php echo form_open('/siteadmin/orders/bulkdelete'); ?>
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>#ID</th>
        <th>Customer</th>
        <th>Date & Time</th>
        <th>Items</th>
        <th>Total</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($orders as $row) : ?> 
      <tr>
        <td><input type="checkbox" name="order[<?php echo $row->order_id;?>]" value="1" class="check" /></td>
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
        <td class="right"><?php echo '$'.number_format(($row->amount+$row->tax+$row->shipping+$row->service+$row->surcharge-$row->coupon-$row->discount-$row->company_less),2);?></td>
        <td class="left"><?php echo $row->status_code;?></td>
        <td class="left">
            <a href="/siteadmin/orders/view/<?php echo $row->order_id;?>">Details</a> <?php if($row->status_id=='0') : ?>|  <a href="/siteadmin/orders/uncancel_order/<?php echo $row->order_id;?>">Uncancel</a> <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
      <tr>
        <td colspan="1"><input type="checkbox" name="checkall" value="1" class="checkall"/></td>
        <td colspan="7"><?php echo isset($pagination) ? $pagination:''; ?></td>
      </tr>
      <tr>
        <td colspan="8" style="text-align:left;"><input type="submit" style="padding: 7px; color: red; font-weight: bold;" value="Delete Selected Orders" name="submit" /></td>
      </tr>
    </table>
    <?php echo form_close(); ?>
    <script>
    <!--
    
    $(function(){
      
      
      $(".checkall").click(function(){
          $(".check").attr("checked","checked");       
      });
      
      
    });
    
    
    
    //-->   
    </script>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No Orders Found.</p>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="hlink">Back to Home</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>