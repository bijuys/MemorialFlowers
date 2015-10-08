<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('My Delivery Addresses');?>
                     <a href="<?php echo base_url(); ?>mymemorial/addresses/create" class="btn btn-inverse btn-small"><?php echo lang('Create New Address');?></a>
                     
					  </h1>
          <div class="contents">
            <div id="table-wrapper">
            <!--  <ul id="tabpages">
                <li><a href="<?php echo base_url().'orders/create';?>"><?php echo lang('New Order');?></a></li>
                <li <?php echo $pagename=='my_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/active';?>"><?php echo lang('My Orders');?></a></li>
              </ul> //-->
            <?php if(count($orders)) :?>
            
            <div id="order_search" style="display:none;">
              <?php echo form_open('/mymemorial/orders/browse',array('class'=>'form-search')); ?>
                <input type="text" name="invoice_id" id="search" value="" class="search-query input-small" placeholder="Invoice #" />
                <button type="submit" name="submit" class="btn btn-success">Filter</button>              
              <?php echo form_close();?>
            </div>
            
            <div class="tablebg">
            <table class="table table-hover">
              <thead>
                <tr style="text-align:center; background-color:#A9A9A9;">
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Location Name');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Address');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('City');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Postal Code');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Province');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Country');?></th>
				  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Contact Name');?></th>
				  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Phone');?></th>
				  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Email');?></th>
				  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Type');?></th>
				  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Actions');?></th>
                </tr>
              </thead>
              <tbody>
            <?php foreach($orders as $order) : ?>
              <tr>
                <td class="first" style="text-align:center;">
                  <?php echo $order->name; ?>
				</td>  
                <td class="first" style="text-align:center;">
                  <?php echo $order->address; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->city; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->postalcode; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->province; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->country; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->contact_firstname.' '.$order->contact_lastname; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->phone; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php echo $order->email; ?>
				</td>  
				<td class="first" style="text-align:center;">
                  <?php
					if($order->type == 1) {
						echo 'Primary';
					}else{
						echo 'Secondary';
					}
					?>
				</td>  
				
				
                <td style="text-align:center;">
                  <div class="buttonwrap">
                  <a href="<?php echo base_url().'mymemorial/addresses/edit/'.$order->location_id;?>" class="btn btn-inverse btn-small"><?php echo lang('Edit');?></a></div>
                </td>
              </tr>
            <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            <div class="pagenav">
            <?php //echo $links; ?> <?php //echo $totalpages.' Orders in Total'; ?>
            </div>
            <?php else : ?>
            <div class="table" id="orderlist">
              <div class="row">
                <div class="cell norecords"><p>Sorry no order found!</p></div>
              </div>
            </div>
            
            
            <?php endif; ?>
            
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
