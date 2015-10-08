<?php $totals = array('amount'=>0,
                      'shipping'=>0,
                      'service'=>0,
                      'surcharge'=>0,
                      'tax'=>0,
                      'coupon'=>0,
                      'discount'=>0,
                      'gtotal'=>0,
                      'commission'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Daily Sales Report</h2>
    <div class="report_info">
                      <span><?php echo isset($title) ? $title:'All Records'; ?></span>
    </div>
      <?php echo form_open(current_url()); ?>
    

    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Year</th>
        <th>Amount</th>
        <th>Coupon</th>
        <th>Less</th>
        <th>Shipping</th>
        <th>Tax</th>
        <th>Tax%</th>
        <th>Total</th>
        <th>Affiliate</th>
        <th>Comm.</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($records as $row) :
                $totals['amount'] += $row->amount;
                $totals['shipping'] += $row->shipping;
                $totals['service'] += $row->service;
                $totals['surcharge'] += $row->surcharge;
                $totals['tax'] += $row->tax;
                $totals['discount'] += $row->discount;
                $totals['coupon'] += $row->coupon;
                $totals['commission'] += $row->commission;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax;
      ?> 
      <tr>
        <td class="left"><?php echo date('d M Y',strtotime($row->order_date));?></td>
        <td class="right"><?php echo '$'.number_format($row->amount,2);?></td>
        <td class="right"><?php echo $row->coupon ? '-$'.number_format($row->coupon,2):'-';?></td>
        <td class="right"><?php echo $row->discount ? '-$'.number_format($row->discount,2):'-';?></td>
        <td class="right"><?php echo '$'.number_format($row->shipping,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->service,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->surcharge,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->tax,2);?></td>
        <td class="right"><?php echo $row->tax ? number_format(($row->tax*100)/$row->amount,1).'%':'-';?></td>
        <td class="right"><?php echo '$'.number_format($row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax,2);?></td>
        <td class="left"><?php echo $row->affiliate ? $row->affiliate:'-';?></td>
        <td class="right"><?php echo $row->commission ? '$'.number_format($row->commission,2):'-';?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th class="left">Totals</th>
        <th class="right"><?php echo '$'.number_format($totals['amount'],2);?></th>
        <th class="right"><?php echo '-$'.number_format($totals['coupon'],2);?></th>
        <th class="right"><?php echo '-$'.number_format($totals['discount'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['shipping'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['service'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['surcharge'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['tax'],2);?></th>
        <th class="right">&nbsp;</th>
        <th class="right"><?php echo '$'.number_format($totals['gtotal'],2);?></th>
        <th class="left">&nbsp;</th>
        <th class="right"><?php echo '$'.number_format($totals['commission'],2);?></th>        
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