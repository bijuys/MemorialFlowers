<?php $totals = array('amount'=>0,
                      'shipping'=>0,
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
    <h2>Sales Report</h2>
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
    </select> <input type="submit" name="submit" value="Get Report!" /></p>

    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>No.</th>
        <th>Billing</th>
        <th>User</th>
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
                $totals['tax'] += $row->tax;
                $totals['discount'] += $row->discount;
                $totals['coupon'] += $row->coupon;
                $totals['commission'] += $row->commission;
                $totals['gtotal'] += $row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax;
      ?> 
      <tr>
        <td><?php echo $row->order_id;?></td>
        <td class="left"><?php echo $row->firstname.' '.$row->lastname;?></td>
        <td class="left"><?php echo $row->user_name;?></td>
        <td class="right"><?php echo '$'.number_format($row->amount,2);?></td>
        <td class="right"><?php echo $row->coupon ? '-$'.number_format($row->coupon,2):'-';?></td>
        <td class="right"><?php echo $row->discount ? '-$'.number_format($row->discount,2):'-';?></td>
        <td class="right"><?php echo '$'.number_format($row->shipping,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->tax,2);?></td>
        <td class="right"><?php echo $row->tax ? number_format(($row->tax*100)/$row->amount,1).'%':'-';?></td>
        <td class="right"><?php echo '$'.number_format($row->amount-$row->coupon-$row->discount+$row->shipping+$row->tax,2);?></td>
        <td class="left"><?php echo $row->affiliate ? $row->affiliate:'-';?></td>
        <td class="right"><?php echo $row->commission ? '$'.number_format($row->commission,2):'-';?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th>&nbsp;</th>
        <th class="left">Totals</th>
        <th class="left">&nbsp;</th>
        <th class="right"><?php echo '$'.number_format($totals['amount'],2);?></th>
        <th class="right"><?php echo '-$'.number_format($totals['coupon'],2);?></th>
        <th class="right"><?php echo '-$'.number_format($totals['discount'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['shipping'],2);?></th>
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
    <div class="page-nav">
    <?php if($offset>0) { ?>
    <input type="submit" name="navigate" value="Previous"/>
    <?php } ?>
    Pages 
    <select name="page">
        <?php for($i=1;$i<=$pages;$i++) { ?>
            <option value="<?php echo $i; ?>" <?php echo $offset==($i*$per_pg)-$per_pg ? 'selected="selected"':'';?>  ><?php echo $i; ?></option>
        <?php } ?>
    </select> 
    <input type="submit" name="navigate" value="Go"/>
    <?php if($offset<($pages*$per_pg)-$per_pg) { ?>
    <input type="submit" name="navigate" value="Next"/>
    <?php } ?>
    <input type="hidden" name="offset" value="<?php echo $offset; ?>" />
    </div>
    <?php echo form_close(); ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>