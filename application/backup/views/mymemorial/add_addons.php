<?php
      $total = 0;
      foreach($addons as $addon) :
?>
    <div class="addon-item">
      <div class="item_pic">
        <img src="<?php echo img_format('../pictures/'.$addon->picture,'tiny');?>" width="30" height="30" />
        <p><?php echo $addon->additionalitem;?></p>
      </div>
      <div class="item_price">
        <?php echo '$'.number_format($addon->price,2);?>
      </div>
      <div class="item_quantity">
        <input type="text" name="quantity" size="3" value="0" />
      </div>
      <div class="item_action">
        <a href="#" class="remove" id="<?php echo $item['rowid'];?>">Remove</a>
      </div>
    </div>
<?php endforeach; ?>
