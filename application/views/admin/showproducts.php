<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Create New Order</h2>
    <h3>Step 1: Select Products</h3>
    <?php if(count($products)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
      <tbody>
        <tr>
      <?php  $i=0;
            foreach($products as $row) :
            $i++;
            ?> 
        <td class="product-container"><img src="/products/<?php echo $row->product_thumbnail;?>" />
            <?php echo $row->product_name; ?> <br />
            <small>Price: </small><strong><?php echo '$'.number_format($row->price_value,2); ?></strong>
            <p><a href="<?php echo FCBASE;?>/order/item/<?php echo $row->product_id;?>" class="button">Select</a></p>
        </td>
      <?php
            if($i>=5) { echo '</tr><tr>'; $i=0; }
            endforeach; ?>
        </tr>
      </tbody>
    </table>
</div>
    <?php else: ?>
    <p class="notfound">Sorry No <?php echo $this_class; ?> Found.</p>
    <?php endif; ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>