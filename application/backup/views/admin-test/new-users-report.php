<?php $totals = array('total'=>0,
                      'less'=>0);

      list($y,$m,$d) = explode('-',date('Y-n-j',time()));

?>
<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>All Users Report</h2>
    <div class="report_info">
                      <span><?php echo isset($title) ? $title:'All Records'; ?></span>
    </div>
      <?php echo form_open(current_url()); ?>
   <input type="submit" name="submit" value="Export to Excel" />


    <?php if(count($records)): ?>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Registration Email</th>
        <th>Registration Date</th>
        <th>Last Login Date</th>
        <th>Last Order Date</th>
      </tr>
      </thead>
      <tbody>
      <?php  foreach($records as $row) :
      ?> 
      <tr>
        <td class="left"><?php echo $row->user_firstname . ' ' . $row->user_lastname;?></td>
        <td class="left"><?php echo $row->user_email;?></td>
        <td class="left"><?php echo strtotime($row->user_created) > 0 ? date('M-d-Y',strtotime($row->user_created)):'';?></td>
        <td class="left"><?php echo strtotime($row->user_lastlogin) > 0 ? date('M-d-Y',strtotime($row->user_lastlogin)):'';?></td>
        <td class="left"><?php echo strtotime($row->lastorderdate) > 0 ? date('M-d-Y',strtotime($row->lastorderdate)):'';?></td>
      </tr>
      <?php endforeach; ?>
      <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>   
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