<?php $pg = isset($page) ? $page:''; ?>
<ul>
    <li <?php echo $pg=='Products' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>products"><?php echo lang('products');?></a></li>
    <li <?php echo $pg=='My Orders' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>orders"><?php echo lang('my_orders');?></a></li>
    <li <?php echo $pg=='Create Order' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>orders/create"><?php echo lang('create_order');?></a></li>
    <li <?php echo $pg=='My Shop' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>settings"><?php echo lang('my_shop');?></a></li>
    <li <?php echo $pg=='My Shop' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>reports"><?php echo lang('reports');?></a></li>
</ul>