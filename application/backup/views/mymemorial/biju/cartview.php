<?php
      if(count($cart)) :
      $total = 0;
      $count = 0;
?>
<table class="table">
      
<?php


      
      foreach($cart as $item) :
    
?>
    
    <tr>
      <td>#<?php echo ++$count; ?></td>
      <td><img src="<?php echo img_format('productres/'.$item->product_picture, 'stamppng');?>" /></td>
      <td><?php echo $item->product_name; ?></td>
      <td> 1 x <?php echo getRate($item->product_price); $total += $item->product_price; ?></td>
      <td>
            <button class="btn btn-danger btn-mini rem" id="rm-<?php echo $item->orderitem_id;?>"  ><?php echo lang('Remove');?></button></td>
    </tr>    
    
<?php   endforeach; ?>

</table>
<?php
  else : ?>
    
    <p> Your cart is empty! </p>
  
<?php endif; ?>
