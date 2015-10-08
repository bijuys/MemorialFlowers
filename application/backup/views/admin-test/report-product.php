<?php $totals = array('total'=>0,
                      'quantity'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Product Sales Report</h2>
    <div class="report_info">
                      <span><?php echo isset($title) ? $title:'All Records'; ?></span>
    </div>
      <?php echo form_open(current_url()); ?>

    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>Product</th>
        <th>Total Sales</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Delivery</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($records as $row) :
                $totals['total'] += $row->total;
                $totals['quantity'] += $row->quantity;
      ?> 
      <tr>
        <td class="left">
        <?php echo img($row->product_picture,'macro');?></td>
        <td class="left">
        <?php echo $row->product_name;?>
        <br/>
        (<?php echo $row->product_code;?>)
        </td>
        <td class="right" style="text-align:center;"><?php echo $row->quantity;?></td>
        <td class="right"><?php echo '$'.number_format($row->product_price,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
        <td class="left" style="text-align: center;"><?php echo $row->delivery_method;?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th>&nbsp;</th>
        <th class="left">Totals</th>
<th class="right" style="text-align:center;"><?php echo $totals['quantity'];?></th>
        <th>&nbsp;</th>

        <th class="right"><?php echo '$'.number_format($totals['total'],2);?></th>
        <th class="left">&nbsp;</th>      
      </tr>
      </tbody>
    </table>
</div>

    <?php else: ?>
    <p class="notfound">Sorry No Purchase Found.</p>
    <?php endif; ?>
        <?php echo form_close(); ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>