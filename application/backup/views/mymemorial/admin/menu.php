<?php $pg = isset($page) ? $page:''; ?>
<ul id="nav">
    <li <?php echo $pg=='Home' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin">Home</a></li>
    <li <?php echo $pg=='Affiliates' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin/affiliates">Affiliates</a>
        <ul>
            <li><a href="<?php echo base_url().'admin/affiliates';?>">Browse Affiliates</a></li>
            <li><a href="<?php echo base_url().'admin/affiliates/create';?>">Create Affiliate</a></li>
        </ul>
    </li>
    <li <?php echo $pg=='Customers' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin/customers">Customers</a>
        <ul>
            <li><a href="<?php echo base_url().'admin/customers';?>">Browse Customers</a></li>
            <li><a href="<?php echo base_url().'admin/customers/create';?>">Create Customer</a></li>
        </ul>
    </li>
    <li <?php echo $pg=='Products' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin/products">Products</a>
            <ul>
            <li><a href="<?php echo base_url().'admin/products';?>">Browse Products</a></li>
            <li><a href="<?php echo base_url().'admin/products/create';?>">Create Product</a></li>
        </ul>
    </li>
    <li <?php echo $pg=='Orders' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin/orders">Orders</a><ul class="clearfix">
        <li><a href="<?php echo base_url();?>admin/orders/active">Active</a></li>
        <li><a href="<?php echo base_url();?>admin/orders/completed">Completed</a></li>        
    </ul></li>
    <li><a href="<?php echo base_url();?>admin/reports">Reports</a>
        <ul>
            <li><a href="<?php echo base_url().'admin/reports/sales';?>">Sales Report</a></li>
            <li><a href="<?php echo base_url().'admin/reports/products';?>">Products Report</a></li>
            <li><a href="<?php echo base_url().'admin/reports/affiliates';?>">Affiliates Report</a></li>
            <li><a href="<?php echo base_url().'admin/reports/provinces';?>">Province Report</a></li>
            <li><a href="<?php echo base_url().'admin/reports/cities';?>">City Report</a></li>
            <li><a href="<?php echo base_url().'admin/reports/postalcodes';?>">Postalcode Report</a></li>
        </ul>
    </li>
    <li <?php echo $pg=='Logout' ? 'class="current"':''; ?>><a href="<?php echo base_url();?>admin/sessions/logout">Logout</a></li>
</ul>