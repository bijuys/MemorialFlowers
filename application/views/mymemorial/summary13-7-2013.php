<table class="table">
<?php
      $total = 0;
      foreach($cart as $item) :
?>
      <tr>
            <td><img src="<?php echo img_format('productres/'.$item->product_picture, 'stamp');?>"  /></td>
            <td>1 x <?php echo $item->product_name;?></td>
            <td class="right"><?php echo getRate($item->product_price*1);?></td>            
      </tr>
      
<?php endforeach; ?>



      <tr>
            <th>&nbsp;</th>
            <th class="right">Shipping</th>
            <th class="right"><?php echo getRate($totals['shipping']); ?></th>
      </tr>
      <tr>
            <th>&nbsp;</th>
            <th class="right">Tax</th>
            <th class="right"><?php echo getRate($totals['tax']); ?></th>
      </tr>
      <tr>
            <th>&nbsp;</th>
            <th class="right">Total</th>
            <th class="right"><?php echo getRate($totals['grandtotal']);?></th>
      </tr>
      <tr>
            <th>&nbsp;</th>
            <th class="right">Commision</th>
            <th class="right"><?php echo getRate('0');?></th>
      </tr>
</table>
