<div id="sidebar">
<ul id="leftnav">
<?php if(accessGrant('customers')) : ?>
    <li>
	<h3><img src="../../../../images/headicons/users.png" width="24" height="24" align="absmiddle"> Customers</h3>
	<ul>  
	    <li><a href="<?php echo FCBASE; ?>/customers/">Edit Customers</a></li>
	    <li><a href="<?php echo FCBASE; ?>/customers/create">New Customer</a></li>
	</ul>
    </li>
<?php endif; ?>

<?php if(accessGrant('affiliates')) : ?>
    <li>
	<h3><img src="../../../../images/headicons/users.png" width="24" height="24" align="absmiddle"> Affiliates</h3>
	<ul>
	    <li><a href="<?php echo FCBASE; ?>/affiliates/">Edit Affiliate</a></li>
	    <li><a href="<?php echo FCBASE; ?>/affiliates/create">New Affiliate</a></li>
	</ul>
    </li>
<?php endif; ?>

<?php if(accessGrant('orders')) : ?>

<li>
    <h3><img src="../../../../images/headicons/dollar_currency_sign.png" width="24" height="24" border="0" align="absmiddle"> Orders</h3>
	<ul>
    <li><a href="<?php echo FCBASE; ?>/orders/browse">View Orders</a></li>
    <li><a href="<?php echo FCBASE; ?>/orders/pending">Pending Orders</a></li>
     <li><a href="<?php echo FCBASE; ?>/orders/completed">Active Orders</a></li>
    <li><a href="<?php echo FCBASE; ?>/orders/cancelled">Cancel Order</a></li>
    </ul>
</li>

<?php endif; ?>

<?php if(accessGrant('products') || accessGrant('addons') || accessGrant('categories') ||
	 accessGrant('occasions') || accessGrant('holidays') || accessGrant('colors') ||
	 accessGrant('productgroups') || accessGrant('deliverymethods') ||
	 accessGrant('policies') || accessGrant('emails')) : ?>

<li>
    <h3><img src="../../../../images/headicons/tools.png" width="24" height="24" align="absmiddle">Setup</h3>
	<ul>

<?php if(accessGrant('products')) : ?>

	<li><a href="<?php echo FCBASE; ?>/products/create">New Product</a></li>
	<li><a href="<?php echo FCBASE; ?>/products">Edit Products</a></li>
	
<?php endif;?>

<?php if(accessGrant('addons')) : ?>

    <li><a href="<?php echo FCBASE; ?>/addons">Addon Items</a></li>
    <li><a href="<?php echo FCBASE; ?>/addons/create">New Addon</a></li>
    
<?php endif;?>

<?php if(accessGrant('categories')) : ?>
    <li><a href="<?php echo FCBASE; ?>/categories">Categories</a></li>
<?php endif; ?>

<?php if(accessGrant('occasions')) : ?>
    <li><a href="<?php echo FCBASE; ?>/occasions">Occasions</a></li>
<?php endif;?>

<?php if(accessGrant('holidays')) : ?>
    <li><a href="<?php echo FCBASE; ?>/holidays">Holidays</a></li>
<?php endif; ?>

<?php if(accessGrant('colors')) : ?>
    <li><a href="<?php echo FCBASE; ?>/colors">Colors</a></li>
<?php endif; ?>

<?php if(accessGrant('productgroups')) : ?>
    <li><a href="<?php echo FCBASE;?>/productgroups">Product Groups</a></li>
<?php endif; ?>

<?php //if(accessGrant('landing')) : ?>
    <li><a href="<?php echo FCBASE;?>/products">Landing Pages</a></li>
<?php //endif; ?>

<?php if(accessGrant('deliverymethods')) : ?>    
    <li><a href="<?php echo FCBASE; ?>/deliverymethods">Delivery Methods</a></li>
<?php endif;?>

<?php if(accessGrant('policies')) : ?>
     <li><a href="<?php echo FCBASE; ?>/policies">Policies</a></li>
<?php endif;?>

<?php if(accessGrant('emails')) : ?>
    <li><a href="<?php echo FCBASE; ?>/emails">Email Templates</a></li>
<?php endif; ?>

    </ul>
</li>

<?php endif;?>

<?php if(accessGrant('locationgroups') || accessGrant('countries') || accessGrant('provinces') || accessGrant('cities') || accessGrant('postalcodes')) : ?>
<li>
    <h3><img src="../../../../images/headicons/globe_warning.png" width="24" height="24" border="0" align="absmiddle">Locations</h3>
	<ul>
<?php if(accessGrant('locationgroups')) : ?>
    <li><a href="<?php echo FCBASE; ?>/locationgroups">Location Groups</a></li>
<?php endif;?>   
<?php if(accessGrant('countries')) : ?>
    <li><a href="<?php echo FCBASE; ?>/countries">Countries</a></li>
<?php endif;?>   
<?php if(accessGrant('provinces')) : ?>
     <li><a href="<?php echo FCBASE; ?>/provinces">Provinces</a></li>
<?php endif;?>    
<?php if(accessGrant('cities')) : ?>
    <li><a href="<?php echo FCBASE; ?>/cities">Cities</a></li>
<?php endif;?>    
<?php if(accessGrant('postalcodes')) : ?>
     <li><a href="<?php echo FCBASE; ?>/postalcodes">Postalcodes</a></li>
<?php endif;?>
    </ul>
</li>
<?php endif;?>

<?php if(accessGrant('menu') || accessGrant('pages') || accessGrant('banners') || accessGrant('categories') || accessGrant('slider')) : ?>

<li> <h3><img src="../../../../images/headicons/computer_process.png" width="24" height="24" border="0" align="absmiddle">Setup</h3>
	<ul>
<?php if(accessGrant('menu')) : ?>
    <li><a href="<?php echo FCBASE; ?>/menu">Menus</a></li>
<?php endif; ?>   
<?php if(accessGrant('pages')) : ?>
    <li><a href="<?php echo FCBASE; ?>/pages">Pages</a></li>
<?php endif; ?>   
<?php if(accessGrant('banners')) : ?>
    <li><a href="<?php echo FCBASE; ?>/banners">Banners</a></li>
<?php endif; ?>    
<?php if(accessGrant('categories')) : ?>
    <li><a href="<?php echo FCBASE; ?>/categories/select">Main Categories</a></li>
<?php endif; ?>    
<?php if(accessGrant('slider')) : ?>
    <li><a href="<?php echo FCBASE; ?>/slider">Product Slider</a></li>
<?php endif; ?>
    </ul>
</li>

<?php endif; ?>

</ul>
</div>