<?php if(count($cart)) :
    $total = 0;
    foreach($cart as $item) : ?>
    <div class="row-fluid sidebar-cart-item">
      <div class="span8">
        <img src="<?php echo img_format('productres/'.$item->product_picture, 'stamppng');?>" />
      </div>
      <div class="span16">
        <?php echo $item->product_name; ?> <br/>
        1 x <?php echo getRate($item->product_price); $total += $item->product_price; ?> <br/>
        <button class="btn btn-danger btn-mini remove" id="rem-<?php echo $item->orderitem_id;?>"  ><?php echo lang('Remove');?></button>
      </div>
    </div>
    
    
<?php   endforeach; ?>

<div class="sidebar-cart-total"> Total: <?php echo getRate($total); ?></div>  

<?php
  else : ?>
    
    <p> Your cart is empty! </p>
  
<?php endif; ?>