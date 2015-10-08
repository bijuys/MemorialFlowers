<?php $totals = array('total'=>0,
                      'less'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Customer Sales Report</h2>
    <div class="report_info">
                      <span><?php echo isset($title) ? $title:'All Records'; ?></span>
    </div>
      <?php echo form_open(current_url()); ?>
   


    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Username</th>
        <th>Name</th>
        <th>Joined</th>
        <th>Email</th>
        <th>City</th>
        <th>LastLogin</th>
        <th>Orders</th>
        <th>Total</th>
        <th>Less</th>
        <th>Affiliate</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($records as $row) :
                $totals['total'] += $row->total;
                $totals['less'] += $row->less;
      ?> 
      <tr>
        <td class="left"><?php echo $row->user_name;?></td>
        <td class="left"><?php echo $row->user_firstname.' '.$row->user_lastname;?></td>
        <td class="left"><?php echo date('M-d-Y',strtotime($row->user_created));?></td>
        <td class="left"><?php echo $row->user_email;?></td>
        <td class="left"><?php echo $row->user_city;?></td>
        <td class="left"><?php echo date('M-d-Y',strtotime($row->user_lastlogin));?></td>
        <td class="right"><?php echo $row->orders;?></td>
        <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
        <td class="right"><?php echo '$'.number_format($row->less,2);?></td>
        <td class="left"><?php echo $row->affiliate ? $row->affiliate:'-';?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th>&nbsp;</th>
        <th class="left">Totals</th>
        <th class="left">&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th class="right"><?php echo '$'.number_format($totals['total'],2);?></th>
        <th class="right"><?php echo '$'.number_format($totals['less'],2);?></th>
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