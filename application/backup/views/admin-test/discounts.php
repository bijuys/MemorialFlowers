<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Discounts <a href="http://www.whatabloom.com/siteadmin/discounts/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="2%">ID</th>
        <th width="15%">Discount/Coupon</th>
        <th width="11%">Type</th>
        <th width="7%">Value</th>
        <th width="12%">Start</th>
        <th width="10%">Minimum</th>
        <th width="5%">Limit</th>
        <th width="12%">Expiry</th>
        <th width="25%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($discounts as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->discount_id;?></td>
        <td class="left"><?php echo $dval->discount_name;?></td>
        <td class="left"><?php echo ucfirst($dval->discount_type);?></td>
        <td><?php echo $dval->discount_amount>0 ? '$'.number_format($dval->discount_amount,2):number_format($dval->discount_percentage,2).'%';?></td>
        <td><?php echo date('d M Y',strtotime($dval->discount_start));?></td>
        <td><?php echo '$'.number_format($dval->discount_minimum,2);?></td>
        <td><?php echo $dval->discount_limit;?></td>
        <td><?php echo date('d M Y',strtotime($dval->discount_expiry));?></td>
        <td><a href="<?php echo current_url();?>/edit/<?php echo $dval->discount_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$dval->discount_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>