<div id="products">
<?php foreach($products as $product) :  ?>
    <div class="product-item box-small">
      <div class="row-fluid">
        <div class="span12">
            <?php if(strlen($product->product_picture)>4) :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php else :?>
            <img src="<?php echo img_format('productres/'.$product->product_picture, 'sthumb');?>" />
            <?php endif; ?>
        </div>
        <div class="span12">
            <p class="pname"><?php echo $product->product_name;?></p>
            <p><?php echo '#'.$product->product_code;?></p>
            <p class="price"><?php $prc = $product->prices[0]->price_value; echo '$'.number_format($product->prices[0]->price_value,2);?>
              <input type="hidden" name="price_id" title="<?php echo $product->product_id;?>" value="<?php echo $product->prices[0]->price_id; ?>" id="price-<?php echo $product->product_id;?>" />
            </p>            
            <p class="select">
              <a href="#" id="<?php echo $product->product_id;?>" class="selectbox btn btn-inverse btn-mini"><?php echo lang('order');?></a>
              <!-- <input type="image" name="select[]" src="<?php echo base_url().'images/ordernow.gif';?>" id="select" class="selectbox" value="<?php echo $product->product_id;?>" /> //-->
            </p>
        </div><!-- Span14 //-->
        
      </div><!-- Row Fluid //-->

    </div><!-- Product Item //-->
<?php endforeach; ?>
</div>
