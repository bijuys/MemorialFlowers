<?php $totals = array('total'=>0,
                      'quantity'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Product Sales Report</h2>
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
    </select> <input type="submit" name="submit" value="Get It!" /></p>


    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Code#</th>
        <th>&nbsp;</th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
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
        <td class="left"><?php echo $row->product_code;?></td>
        <td class="left"><?php echo img($row->product_picture,'macro');?></td>
        <td class="left"><?php echo $row->product_name;?></td>
        <td class="right"><?php echo '$'.number_format($row->product_price,2);?></td>
        <td class="right"><?php echo $row->quantity;?></td>
        <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
        <td class="left"><?php echo $row->delivery_method;?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th class="left">Totals</th>
        <th>&nbsp;</th>
        <th class="right"><?php echo $totals['quantity'];?></th>
        <th class="right"><?php echo '$'.number_format($totals['total'],2);?></th>
        <th class="left">&nbsp;</th>      
      </tr>
      </tbody>
    </table>
</div>
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
    <?php else: ?>
    <p class="notfound">Sorry No Purchase Found.</p>
    <?php endif; ?>
        <?php echo form_close(); ?>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
    <div class="clear"></div>
  <?php include_once("footer.php");?>