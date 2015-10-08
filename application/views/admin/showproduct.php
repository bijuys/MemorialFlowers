<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Create New Order</h2>
    <h3>Step 1: Add this to your order?</h3>
    <div id="shadow">
    <?php  echo form_open_multipart(current_url()); ?>
    <table border="0" align="center" cellpadding="5" cellspacing="0">
      <tr>
        <td width="15%" align="left" valign="top"><img src="/products/<?php echo $product->product_picture; ?>" /></td>
        <td valign="top" align="left"><h3><?php echo $product->product_name;?></h3>
          <ul class="price">
          <?php foreach($product->prices as $row) { $sel = isset($sel) ? '':'checked="checked"';  ?>
           <li><input type="radio" name="price" value="<?php echo $row->price_id;?>" id="price<?php echo $row->price_id;?>" <?php echo $sel; ?> /><label><big> <?php echo $row->price_name;?> - <strong><?php echo '$'.number_format($row->price_value,2);?></strong></big></label> </li>
          <?php } ?>
          <li>&nbsp;</li>
          <li><input type="submit" class="sbutton" name="submit" value="Add to Order" /></li>
          </ul>
        <?php if($product->allow_addons) {
                if(count($addons)) { echo '<h4>Select addons</h4>'; }
            foreach($addons as $add) {
          ?>
           <p> <img src="/products/<?php echo $add->addon_thumbnail; ?>" width="70" height="70" align="left" style="margin-right:5px;" />
            <big><?php echo $add->addon_name;?></big>
            <br /><small>Price: <?php echo '$'.number_format($add->price,2);?></small>
            <br /><input type="text" name="addon[<?php echo $add->addon_id;?>]" value="0" size="5" />
            <br clear="all" /></p>
        <?php }
              } ?>
     <?php echo $product->product_description; ?>
     <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>" />
     </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>

    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>