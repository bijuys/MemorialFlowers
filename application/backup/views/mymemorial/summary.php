<table class="table">
<?php
      $total = 0;
      foreach($cart as $item) :
?>
      <tr>
            <td><img src="<?php echo img_format('productres/'.$item->product_picture, 'stamp');?>"  /></td>
            <td>1 x <?php echo $item->product_name;?>
              <p><em><?php echo lang('Sent On');?>:</em> <?php echo date('l d M Y',strtotime($item->delivery_date)).' : '.$item->delivery_time;?> </p>
            </td>
            <td class="right"><?php echo getRate($item->product_price*1);?></td>            
      </tr>
      
<?php endforeach; ?>



      <!--<tr>
            <th>&nbsp;</th>
            <th class="right">Service</th>
            <th class="right"><?php //echo getRate($totals['service']); ?></th>
      </tr>-->
      <tr>
            <th>&nbsp;</th>
            <th class="right">Tax</th>
            <th class="right"><?php echo getRate($totals['tax']); ?></th>
      </tr>
      <tr>
            <th>&nbsp;</th>
            <th class="right">Total</th>
            <th class="right"><?php echo getRate($totals['grandtotal']-$totals['service']);?></th>
      </tr>
      <!--<tr>
            <th>&nbsp;</th>
            <th class="right">Commision</th>
            <th class="right"><?php //echo getRate($totals['subtotal']*0.20);?></th>
      </tr>-->
</table>
