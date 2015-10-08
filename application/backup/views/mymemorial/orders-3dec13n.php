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
            <?php if(count($orders)) :?>
            
            <div id="order_search">
              <?php echo form_open('/mymemorial/orders/browse',array('class'=>'form-search')); ?>
                <input type="text" name="invoice_id" id="search" value="" class="search-query input-small" placeholder="Invoice #" />
                <button type="submit" name="submit" class="btn btn-success">Filter</button>              
              <?php echo form_close();?>
            </div>
            
            <div class="tablebg">
            <table class="table table-hover">
              <thead>
                <tr style="text-align:center; background-color:#A9A9A9;">
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Invoice');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Recepient');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Address');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Order Date');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Value');?></th>
                  <th style="text-align:center; color:#2E2E2E; font-weight:bold;"><?php echo lang('Status');?></th>
                </tr>
              </thead>
              <tbody>
            <?php foreach($orders as $order) : ?>
              <tr>
                <td class="first" style="text-align:center;">
                  <a href="/mymemorial/orders/show/<?php echo $order->order_id;?>"><?php echo $order->invoice_id;?></a>
                  <!--<a href="#" class="showdet" rel="<?php //echo $order->invoice_id;?>"><img src="<?php //echo base_url().'images/expand.png';?>" /></a></td>-->
                <td><?php echo $order->firstname.' '.$order->lastname; ?></td>
                <td><?php echo $order->address1. ' ' . $order->address2.', '.$order->city.' '.$order->postalcode.'<br/>'.$order->province.' '.$order->country_name; ?></td>
                <td style="text-align:center;"><?php echo date('d M Y',strtotime($order->order_date));?>
                </td>
                <td style="text-align:center;"><?php echo '$'.number_format($order->amount,2);?></td>
                <td style="text-align:center;">
                  <div class="buttonwrap">
                  <a href="<?php echo base_url().'mymemorial/orders/printview/'.$order->order_id;?>" class="btn btn-inverse btn-small"><?php echo lang('Print Order');?></a></div>
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
