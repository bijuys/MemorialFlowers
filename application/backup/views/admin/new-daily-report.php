<?php $totals = array('amount'=>0,
                      'shipping'=>0,
                      'tax'=>0,
                      'service'=>0,
                      'surcharge'=>0,
                      'coupon'=>0,
                      'discount'=>0,
                      'gtotal'=>0,
                      'commission'=>0,
                      'orders'=>0);

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

    <p><label for="start_month">From</label>
    <select name="start_month">
      <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo $i;?>" <?php
              
              if($_POST)
                echo $_POST['start_month']==$i ? 'selected="selected"':'';
              else
                echo $m==$i ? 'selected="selected"':'';
                
              ?>><?php echo date('M',strtotime('2010-'.$i.'-01'));?></option>
      <?php } ?>
    </select>
    
    <select name="start_day">
    <?php for($i=1;$i<=31;$i++) { ?>
              <option value="<?php echo $i;?>" <?php
              
              if($_POST)
                echo $_POST['start_day']==$i ? 'selected="selected"':'';
              else
                echo $i==1 ? 'selected="selected"':'';
                
              ?>><?php echo $i;?></option>
      <?php } ?>        
    </select>
    
    <select name="start_year" <?php echo $y==$i ? 'selected="selected"':'';?>>
      <?php for($i=2010;$i<=date('Y',time());$i++) { ?>
              <option value="<?php echo $i;?>" <?php
              
              if($_POST)
                echo $_POST['start_year']==$i ? 'selected="selected"':'';
              else
                echo $y==$i ? 'selected="selected"':'';
                
              ?>><?php echo $i;?></option>
      <?php } ?>      
    </select>
    
    <label for="end_month">To</label>

    <select name="end_month">
      <?php for($i=1;$i<=12;$i++) { ?>
              <option value="<?php echo $i;?>" <?php
              
              if($_POST)
                echo $_POST['end_month']==$i ? 'selected="selected"':'';
              else
                echo $m==$i ? 'selected="selected"':'';
                
              ?>><?php echo date('M',strtotime('2010-'.$i.'-01'));?></option>
      <?php } ?>      
    </select>

    <select name="end_day">
      <?php for($i=1;$i<=31;$i++) { ?>
              <option value="<?php echo $i;?>" <?php
              
              if($_POST)
                echo $_POST['end_day']==$i ? 'selected="selected"':'';
              else
                echo $i==$d ? 'selected="selected"':'';
                
              ?>><?php echo $i;?></option>
      <?php } ?>        
    </select>

    <select name="end_year">
      <?php for($i=2010;$i<=date('Y',time());$i++) { ?>
              <option value="<?php echo $i;?>"  <?php
              
              if($_POST)
                echo $_POST['end_year']==$i ? 'selected="selected"':'';
              else
                echo $y==$i ? 'selected="selected"':'';
                
              ?>><?php echo $i;?></option>
      <?php } ?>           
    </select> <input type="submit" name="submit" value="Get It!" /><input type="submit" name="submit" value="Export to Excel" /></p>    

    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Order Date</th>
        <th>No. of Orders</th>
        <th>Revenue</th>
        <th>Shipping</th>
        <th>Service</th>
        <th>Surcharge</th>
        <th>Taxes</th>
        <th>Total</th>
        <th>Discount Total</th>
        <th>Grand Total</th>
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
                $tot = $row->amount+$row->shipping+$row->tax;
                $disc = $row->coupon + $row->discount;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->service+$row->surcharge+$row->tax;
                $totals['orders'] += $row->orders;
      ?> 
      <tr>
        <td class="left"><?php echo date('d M Y',strtotime($row->order_date));?></td>
        <td><?php echo $row->orders;?></td>
        <td class="right"><?php echo '$'.number_format($row->amount,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->shipping,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->service,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->surcharge,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->tax,2);?></td>
        <td class="right"><?php echo '$'.number_format($tot,2);?></td>
        <td class="right"><?php echo '$'.number_format($disc,2);?></td>
        <td class="right"><?php echo '$'.number_format($tot-$disc,2);?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th class="left">Totals</th>
        <th style="text-align:center"><?php echo $totals['orders'];?></th>
        <th class="right"><?php echo '$'.number_format($totals['amount'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['shipping'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['service'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['surcharge'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['tax'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['amount']+$totals['tax']+$totals['shipping'],2);?></th>
        <th class="right"><?php echo '-$'.number_format($totals['coupon']+$totals['discount'],2);?></th>
        <th class="right"><?php echo '$'.number_format(($totals['amount']+$totals['tax']+$totals['shipping']+$totals['service']+$totals['surcharge'])-($totals['coupon']+$totals['discount']),2);?></th>     
      
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