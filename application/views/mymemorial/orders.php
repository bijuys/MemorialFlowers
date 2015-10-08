<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      
	  <br />
	  
	  <div id="content" class="clearfix">
	  
		<span style="color:#770922;font-size:30px;">Orders</span>
		<br /><br />
		
		<table width="100%" border="0">
			<tr>
				<td width="100%" valign="top">
					
					<div id="order_search">
						<?php echo form_open('/mymemorial/orders/browse',array('class'=>'form-search')); ?>
							<input type="text" name="invoice_id" id="invoice_id" value="" class="search-query input-small" placeholder="Invoice" />
							<input type="hidden" name="funeral_home" id="funeral_home" value="" class="search-query input-small" placeholder="Invoice" />
							&nbsp;
							<button type="submit" name="submit" class="btn btn-success">Search Orders</button>              
						<?php echo form_close();?>
					</div>
					
				</td>
			</tr>
			<tr>
				<td width="100%" valign="top">
					
						<table class="dashboard-table table" style="color:#555;">
								<tr style="text-align:center; background-color:#A9A9A9;">
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Invoice');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Order Date');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Recepient');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Address');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Status');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Purchase');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Delivery');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Tax');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"><?php echo lang('Total');?></th>
									<th style="text-align:center;color:#fff;background-color:#770922;"></th>
								</tr>
							<?php foreach($orders as $order) : ?>
								<tr>
									<td class="first" style="text-align:center;vertical-align:middle;">
										<?php echo $order->invoice_id;?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo date('M d Y',strtotime($order->order_date));?>
									</td>
									<td style="vertical-align:middle;">
										<?php echo $order->firstname.' '.$order->lastname; ?>
									</td>
									<td style="vertical-align:middle;">
										<?php if($order->location_type_name!=''){ ?>
										
											<?php echo $order->location_type_name.'<br />'; ?>
											<span style="font-size:14px;color:#787878;"><?php echo $order->address1. ' ' . $order->address2.', '.$order->city.' '.$order->province.' '.$order->postalcode; ?></span>
										
										<?php }else{ ?>
										
											<?php echo $order->address1.' '.$order->address2.'<br />'; ?>
											<span style="font-size:14px;color:#787878;"><?php echo $order->city.' '.$order->province.' '.$order->postalcode; ?></span>
										
										<?php } ?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<?php if($order->status_id==2){ ?>
											<img src="/images/okay-icon.png" width="20" height="20"/>
										<?php }else{ ?>
											<img src="/images/cancel-icon.png" width="20" height="20"/>
										<?php } ?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo '$'.number_format($order->amount,2);?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo '$'.number_format($order->service,2);?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<?php echo '$'.number_format($order->tax,2);?>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<span style="font-size:20px;font-weight:bold;"><?php echo '$'.number_format($order->amount+$order->service+$order->tax,2);?></span>
									</td>
									<td style="text-align:center;vertical-align:middle;">
										<div class="buttonwrap">
											<a href="<?php echo base_url(); ?>orders/review-invoice/<?php echo $order->invoice_id;?>" class="btn btn-inverse btn-small" target="_blank"><?php echo lang('View');?></a>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</table>
					
				</td>
			</tr>
		</table>		
	  
      </div><!-- Contents //-->
<?php //include_once(APPPATH.'views/footer.php'); ?>
