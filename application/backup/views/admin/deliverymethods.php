<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>Delivery methods</h2>
    <div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="5%">ID</th>
        <th width="40%">Delivery Method</th>
        <th width="10%">Days</th>
        <th width="15%">Delivery Charge</th>
	<!--
	<th width="15%">Service Charge</th>
	//-->
	<th width="10%">Stoppage</th>
        <th width="15%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
	  foreach($deliverymethods as $dkey=>$dval) : 
	  ?> 
      <tr>
        <td><?php echo $dval->delivery_method_id;?></td>
        <td class="left"><?php echo $dval->delivery_method;?></td>
        <td><?php echo $dval->delivery_within;?> day(s)</td>
        <td><?php echo '$'.number_format($dval->delivery_charge,2);?></td>
	<!--
	<td><?php // echo '$'.number_format($dval->service_charge,2);?></td>
	//-->
	<td><?php echo $dval->stoppage_time;?></td>
        <td nowrap="nowrap"><a href="<?php echo current_url();?>/edit/<?php echo $dval->delivery_method_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a></td>
      </tr>
      <?php 
	  //$tempid = $dval->parent_category_id;
	  endforeach; ?>
      </tbody>
    </table>
    </div>
    <p class="back"><a href="<?php echo FCBASE;?>" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>