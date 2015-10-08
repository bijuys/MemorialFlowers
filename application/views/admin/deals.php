<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Social Media Deals <a href="<?=current_url();?>/create" class="button"><img src="/images/new.png" width="24" height="24" border="0" align="top" />Create</a>    </h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="2%">ID</th>
        <th width="13%">Company</th>
        <th width="13%">Deal Name</th>
        <th width="6%" style="text-align:center;">Deal Value</th>
        <th width="8%" style="text-align:center;">Start Date</th>
        <th width="8%" style="text-align:center;">End Date</th>
        <th width="8%" style="text-align:center;">Total Coupons</th>
        <th width="8%" style="text-align:center;">Used Coupons</th>
        <th width="8%" style="text-align:center;">Unused Coupons</th>
		<th width="7%" style="text-align:center;">Status</th>
		<th width="15%" style="text-align:center;">Actions</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($deals as $dkey=>$dval) : ?> 
      <tr>
        <td><?php echo $dval->socialdeal_id;?></td>
        <td class="left"><?php echo $dval->socialdeal_company;?></td>
		<td class="left"><?php echo $dval->socialdeal_name;?></td>
        <td class="center"><?php echo '$'.$dval->socialdeal_amount;?></td>
        <td><?php echo date('d M Y',strtotime($dval->socialdeal_starts));?></td>
		<td><?php echo date('d M Y',strtotime($dval->socialdeal_finish));?></td>
        <td class="center"><?php echo $dval->socialdeal_coupons;?></td>
		<td class="center"><?php echo $dval->socialdeal_used;?></td>
        <td class="center"><?php echo $dval->socialdeal_unused;?></td>
		<td class="center"><?php if($dval->socialdeal_status==1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        <img src="/images/block.png" />
        <?php endif;?> </td>
        
        <td>
		<a href="<?php echo current_url();?>/details/<?php echo $dval->socialdeal_id;?>" class="ibutton"><img src="/images/details.png" border="0" align="texttop" />Details</a>
		<a href="<?php echo current_url();?>/edit/<?php echo $dval->socialdeal_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="<?php echo current_url();?>/Delete/<?=$dval->socialdeal_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>