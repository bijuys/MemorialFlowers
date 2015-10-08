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
  <div id="contents-wrapper" style="margin-left:0px; width: 100%; float: left; padding-left: 0px;">
    <h2>Refund Report</h2>
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
        <th>Order ID</th>
        <th>Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>Postalcode</th>
        <th>Subtotal</th>
        <th>Tax</th>
        <th>Shipping</th>
        <th>Service</th>
        <th>Surcharge</th>
        <th>Total</th>
        <th>Products</th>
        <th>Skus</th>
        <th>Occasion</th>
        <th>Channel</th>
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
        <td><?php echo $row->invoice_id;?></td>
        <td><?php echo date('d-m-Y',strtotime($row->order_date));?></td>
        <td class="left"><?php echo $row->firstname;?></td>
        <td class="left"><?php echo $row->lastname;?></td>
        <td class="right"><?php echo $row->email;?></td>
        <td class="right"><?php echo $row->address1 .' '.$row->address2;?></td>
        <td class="right"><?php echo $row->city;?></td>
        <td class="right"><?php echo $row->province;?></td>
        <td class="right"><?php echo $row->postalcode;?></td>
        <td class="right"><?php echo '$'.number_format($row->amount,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->tax,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->shipping,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->service,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->surcharge,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->tax+$row->shipping+$row->service+$row->surcharge+$row->amount,2);?></td>
        <td class="left"><?php echo $row->products;?></td>
        <td class="left"><?php echo $row->skus;?></td>
        <td class="left"><?php echo $row->occasion_name;?></td>
        <td class="left"></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th class="left">Totals</th>
        <th class="left">&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th class="right"><?php echo '$'.number_format($totals['amount'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['tax'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['shipping'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['service'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['surcharge'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['amount']+$totals['tax']+$totals['shipping']+$totals['service']+$totals['surcharge'],2);?></th>
        <th class="left">&nbsp;</th>
        <th class="right"></th>
        <th class="left">&nbsp;</th>
        <th class="left"></th>
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