<?php include_once("header.php"); ?>
<?php include_once("sidebar.php"); ?>
  <div id="contents-wrapper">
    <h2>
		<?php echo $deal->socialdeal_company.' - '.$deal->socialdeal_name.' Deal'; ?><br /><br />
		
		
		<span style="font-size:20px;"><span style="color:#999;">Coupons Amount: </span><?php echo '$'.$deal->socialdeal_amount; ?></span><br />
		<span style="font-size:20px;"><span style="color:#999;">Start Date: </span><?php echo date('d M Y',strtotime($deal->socialdeal_starts));?></span><br />
		<span style="font-size:20px;"><span style="color:#999;">End Date: </span><?php echo date('d M Y',strtotime($deal->socialdeal_finish));?></span><br />
	</h2>
   
	
	<div id="shadow">
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        
        <th width="10%">Coupon Code</th>
        
        <th width="10%">Amount</th>
		<th width="10%">Activation Date</th>
		<th width="10%">Customer Name</th>
		<th width="10%">Customer Email</th>
		<th width="10%">Customer Address</th>
		<th width="10%">Customer Phone</th>
		
		<th width="10%">Used</th>
        
        <th width="10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach($discount_info as $dkey=>$dval) : ?> 
      <tr>
       
        <td class="left"><?php echo $dval->discount_name; ?></td>
		<td class="left"><?php echo '$ '.$dval->discount_amount.'.00'; ?></td>
		<td class="left"><?php echo date('d M Y',strtotime($dval->discount_activation_date));?></td>
		<td class="left"><?php echo $dval->user_firstname.' '.$dval->user_lastname; ?></td>
		<td class="left"><?php echo $dval->user_email; ?></td>
		<td class="left"><?php echo $dval->user_address1.' '.$dval->user_address2.' '.$dval->user_postalcode.' '.$dval->user_city.' '.$dval->user_province; ?></td>
		<td class="left"><?php echo $dval->user_phone1; ?></td>
		<td>
		
		<?php if($dval->discount_limit<1) : ?>
          <img src="/images/accept.png" />
        <?php else: ?>
        
        <?php endif;?>
		
		</td>
        
        
        <td><a href="http://whatabloom.com/siteadmin/discounts/edit/<?php echo $dval->discount_id;?>" class="ibutton"><img src="/images/edit.png" border="0" align="texttop" />Edit</a><a href="http://whatabloom.com/siteadmin/discounts/Delete/<?=$dval->discount_id;?>" onclick="javascript:return confirm('Are you sure to Delete?'); false;" class="ibutton"><img src="/images/delete.png" border="0" align="top" />Remove</a></td>
      
	  
	  
	  </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<div id="shadow" style="width:1090px;">
	
    <table border="0" align="center" cellpadding="0" cellspacing="0" id="result">
    <thead>
      <tr>
        <th width="10%"><center>TOTAL COUPONS</center></th>
		
        <th width="10%"><center>TOTAL AMOUNT</center></th>
		
		<th width="10%"><center>USED COUPONS</center></th>
        
        <th width="10%"><center>AMOUNT COUPONS USED</center></th>
		
		<th width="10%"><center>UNUSED COUPONS</center></th>
				
		<th width="10%"><center>AMOUNT COUPONS UNUSED</center></th>
		
		
		
		
      </tr>
      </thead>
      <tbody>
      
      <tr style="font-size:25px;">
        <td class="left" style="font-size:25px; text-align:center;"><?php echo $total1->total_customers; ?></td>
	    <td class="left" style="font-size:25px; text-align:center; color:#8B1A1A; font-weight:bold;"><?php echo '$ '.$total1->total_coupons_amount.'.00'; ?></td>
		<td class="left" style="font-size:25px; text-align:center;"><?php echo $total2->total_customers_used; ?></td>
		<td class="left" style="font-size:25px; text-align:center; color:#8B1A1A; font-weight:bold;"><?php echo '$ '.$total2->total_coupons_used.'.00'; ?></td>
		<td class="left" style="font-size:25px; text-align:center;"><?php echo $total3->total_customers_unused; ?></td>
		<td class="left" style="font-size:25px; text-align:center; color:#8B1A1A; font-weight:bold;"><?php echo '$ '.$total3->total_coupons_unused.'.00'; ?></td>
		
		
		
	  
	  </tr>
     
      </tbody>
    </table>
    
	
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <p class="back"><a href="<?php echo FCBASE;?>/socialdeals" class="button"><img src="/images/back.png" border="0" align="absmiddle" /> Back</a></p>
  </div>
  <div class="clear"></div>
  <?php include_once("footer.php");?>