<?php $totals = array('total'=>0,
                      'less'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Company Sales Report</h2>
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
    </select>    <input type="submit" name="submit" value="Get It!" /> </p>



    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Company</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Start Date</th>
        <th>Discount</th>
        <th>Customers</th>
        <th>Orders</th>
        <th>Total</th>
        <th>Less</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($records as $row) :
      ?> 
      <tr>
        <td class="left"><?php echo $row->user_business;?></td>
        <td class="left"><?php echo $row->user_firstname.' '.$row->user_lastname;?></td>
        <td class="left"><?php echo $row->user_email;?></td>
        <td class="left"><?php echo date('M-d-Y',strtotime($row->user_created));?></td>
        <td class="right"><?php echo $row->business_discount.'%';?></td>
        <td class="left"><?php echo $row->total_users;?></td>
        <td class="left"><?php echo $row->total_orders;?></td>
        <td class="right"><?php echo '$'.number_format($row->totals,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->total_less,2);?></td>
      </tr>
      <?php endforeach; ?>
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