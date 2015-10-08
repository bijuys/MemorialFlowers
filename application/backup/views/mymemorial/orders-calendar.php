<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('My Orders');?></h1>
          <div class="contents">
            <div id="table-wrapper">
            <!--  <ul id="tabpages">
                <li><a href="<?php echo base_url().'orders/create';?>"><?php echo lang('New Order');?></a></li>
                <li <?php echo $pagename=='my_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/active';?>"><?php echo lang('My Orders');?></a></li>
              </ul> //-->
           
            
            <div id="order_search" style="display:none;">
              <?php echo form_open('/mymemorial/orders/browse',array('class'=>'form-search')); ?>
                <input type="text" name="invoice_id" id="search" value="" class="search-query input-small" placeholder="Invoice #" />
                <button type="submit" name="submit" class="btn btn-success">Filter</button>              
              <?php echo form_close();?>
            </div>
            
            <div class="tablebg">
            <table class="table table-hover" width="100%">
              <thead>
                <tr style="text-align:center; background-color:#A9A9A9;">
				  <th width="4%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Invoice</th>
				  <!--<th width="8%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Customer</th>-->
				  <th width="9%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Recipient</th>
				  <th width="4%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">City</th>
				  <th width="4%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Image</th>
				  <th width="9%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Product</th>
				  <!--<th width="5%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">By</th>-->
				  <th width="13%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Delivery</th>
				  <!--<th width="5%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Status</th>-->
				  <th width="12%" style="text-align:center; color:#EDEDED; background-color:#4D4D4D;">Total</th>
				</tr>
              </thead>
              <tbody>
			  
			
            <?php foreach($totals_orders as $order) : ?>
              <tr>
                <td class="first" style="text-align:center;">
					<?php echo $order->invoice_id; ?>
				</td>
				<td><?php echo $order->recipient; ?></td>
                <td><?php echo $order->city2; ?></td>
                <td style="text-align:center;">
					<img src="<?php echo base_url(); ?>/productres/<?php echo $order->product_picture; ?>" width="80" height="70" alt="" title="" />
				</td>
                <td style="text-align:center;"><?php echo $order->product_name; ?></td>
                <td style="text-align:center;">
					<?php echo date('d M Y',strtotime($order->delivery_date)); ?>
                </td>
				<td style="text-align:center;">
					<?php echo $order->total; ?>
                </td>
				
              </tr>
            <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            <div class="pagenav">
            <?php //echo $links; ?> <?php //echo $totalpages.' Orders in Total'; ?>
            </div>
            
            
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
