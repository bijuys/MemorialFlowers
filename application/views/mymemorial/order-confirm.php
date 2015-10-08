<div style="width:700px;">

 <table width="100%" style="background:#4A8BC2; color:#FFF;" cellpadding="5">
	 <tbody>
	 	<tr>
	 		<td style="width: 50%;"><p>Dear <?php echo $billing->firstname;?><br>
				Thank you for choosing <a target="_blank" href="www.memorialflowers.ca"><span class="il">Memorial Flowers</span></a></p>
                
                
              <!--  <a target="_blank" href="http://whatabloom.com"><span class="il">whatabloom</span>.com</a>.</p>-->
	 
	 			<p>Invoice number: <span style="font-weight:bold;font-size:17px;color:#db2929"><?php echo $order->invoice_id;?></span></p>
	 		</td>
	 		<td align="right" style="width: 50%; text-align:right;">
            	<!--<img  src="/img/logo.png" alt="" style="height: 50px;width:auto;" / >-->
         
       			<a target="_blank" href="www.memorialflowers.ca"><img  src="<?php echo base_url(); ?>images/mem_logo.png" alt="" style="height: 50px;width:auto;" border="0" / ></a> 
            
            
           <!-- <img src="http://admin.bloomcommand.com/img/websites/<?php //echo $wfolder; ?>/logo.png" alt="<?php //echo $website->website_name; ?>" width="250" height="70" />-->
            
	 			<!--<img src="http://admin.bloomcommand.com/img/websites/<?php //echo $wfolder; ?>/logo.png" alt="<?php //echo $website->website_name; ?>" width="250" height="70" />-->
	 		</td>
	 	</tr>
	 </tbody>
 </table>

 <table width="100%" cellpadding="5" style="border:2px solid #DDDDDD;">
 	<thead style="background: #EEEEEE;">
 		<tr>
 			<th style="width: 50%;">Billing Information</th>
 			<th style="width: 50%;">Recepient Information</th>
 		</tr>
 	</thead>
 	<tbody>
 		<tr>
 			<td><?php echo $billing->firstname,' ',$billing->lastname;?><br/>
 				<?php echo $billing->address1,' ',$billing->address2;?><br/>
 				<?php echo $billing->city,' ',$billing->postalcode;?><br/>
 				<?php echo $billing->province,' Canada';?><br/>
 				<?php echo $billing->dayphone,' ',$billing->evephone;?><br/>
 				<?php echo $billing->email;?>
 			</td>
 			<td><?php echo $items[0]->firstname,' ',$items[0]->lastname;?><br/>
				Location type: <?php echo $items[0]->location_type;?><br/>
 				<?php echo $items[0]->address1,' ',$items[0]->address2;?><br/>
 				<?php echo $items[0]->city,' ',$items[0]->postalcode;?><br/>
 				<?php echo $items[0]->province,' Canada';?><br/>
 				<?php echo $items[0]->dayphone,' ',$items[0]->evephone;?><br/>
 				
 			</td>
 		</tr>
 	</tbody>
 </table>

  <table width="100%" cellpadding="5" style="border: 2px solid #DDDDDD; border-collapse:collapse;">
 	<thead style="background:#EEEEEE;">
 		<tr>
 			<th colspan="2">Item Description</th>
 			<th>Qty</th>
 			<th>Total</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php foreach($items as $item) : ?>
 		<tr>
      
 		
 			<td style="border:1px solid #DDDDDD; border-collapse:collapse;"><img src="http://admin.bloomcommand.com/productres/<?php echo $website->website_folder;?>/<?php echo $item->product_picture;?>" style="width:70px; height: 70px;" /></td>
            
            <?php $website = getWebsite($order->db_id);?>
 			<td style="border:1px solid #DDDDDD; border-collapse:collapse;">
 				<?php echo $item->product_name,' ('.$item->product_code.') ';?>
 				 @ <strong><?php echo '$',number_format($item->product_price,2);?></strong><br/>
 				<strong style="color:#DD0000; font-size:90%;">Delivery on: <?php echo date('d M Y',strtotime($item->delivery_date));?></strong>
				<?php if(count($item->addons)) :
					foreach($item->addons as $addon) : ?>
					<br/>
					<?php echo '+ '.$addon->addon_name.'('.$addon->addon_quantity.') @ '.'$'.number_format($addon->addon_price,2); ?>
				
				<?php
					endforeach;
				      endif; ?> 				
 			</td>
 			<td style="border:1px solid #DDDDDD; border-collapse:collapse; text-align:center;">
 				<?php 	if(isset($item->qty))
				{
				$qty=$item->qty;
				}
				else {
				$qty=1;	
					
				}
				
				echo $qty;
				?>
 			</td>
 			<td style="border:1px solid #DDDDDD; border-collapse:collapse; text-align:right;">
 				<?php //echo number_format($item->product_price*$item->qty,2);?>
                <?php echo number_format($item->product_price*$qty,2);?>
 			</td>
 		</tr>
 		<tr>
 			<td colspan="4">
 			<em>Message:</em> <?php echo $item->card_message;?>
 			</td>
 		</tr>
 		<?php endforeach; ?>
 	</tbody>
 </table>

 <table width="100%" cellpadding="5" style="border: 2px solid #DDDDDD;">
 	<tbody>
 		<tr>
 			<td style="border-bottom:1px solid #DDDDDD;">Item Total</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->amount,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
 			<td style="border-bottom:1px solid #DDDDDD;">Discount</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->discount,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
 			<td style="border-bottom:1px solid #DDDDDD;">Coupon Discount</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->coupon,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
 			<td style="border-bottom:1px solid #DDDDDD;">Service Charge</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->service,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
 			<td style="border-bottom:1px solid #DDDDDD;">Surcharge</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->surcharge,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
 			<td style="border-bottom:1px solid #DDDDDD;">Tax</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD;"><?php echo '$',number_format($order->tax,2);?></td>
 		</tr>
 		<tr style="border-bottom:1px solid #DDDDDD;">
        
        <?php
		//$gtotal = $order->amount + $order->shipping + $order->tax + $order->service + $order->surcharge - $order->discount - $order->coupon;
		$gtotalwddiscount = $order->amount  - $order->discount - $order->coupon;
		if($gtotalwddiscount <0)
		{
		$gtotalwddiscount=0;	
		}
		$gtotal = $gtotalwddiscount + $order->shipping + $order->tax + $order->service + $order->surcharge;
		
		
		?>
 			<td style="border-bottom:1px solid #DDDDDD; font-weight:bold;">Grand Total</td>
 			<td style="text-align:right;border-bottom:1px solid #DDDDDD; font-weight: bold;"><?php echo '$',number_format($gtotal,2);?></td>
 		</tr>
 	</tbody>
 </table>

 <p>Thank you for ordering with us</p>

 </div>