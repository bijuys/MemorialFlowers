<h3><?php echo lang('your_cart');?></h3>
<div class="sidebar-item" id="side-cart">
   <?php if(isset($this->cart) && $this->cart->total_items()>0) : ?>
   <div class="sidebar-cart">
      <?php foreach($this->cart->contents() as $cart) : ?>
      <div class="sidecart-item">
            <p><img src="<?php echo img_format('../pictures/'.$cart['options']['picture'],'stamp');?>" width="50" height="50" /></p>
            <p><em><?php echo $cart['name'];?></em></p>
            <p><em><?php echo $cart['qty'] . ' x $'. number_format($cart['price'],2) ;?></em></p>
      </div>
      <?php endforeach; ?>
      <div class="total"><span>Total:</span> <?php echo '$'.number_format($this->cart->total(),2);?></div>
   </div>
   <?php else : ?>
    <div class="bigmessage">
       <span class="big">No items in your Cart!</span>
       <span><a href="<?php echo base_url().'orders/create';?>">Order a product</a></span>
    </div>   
   <?php endif; ?>
</div>