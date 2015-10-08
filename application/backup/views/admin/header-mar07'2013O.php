<?php
define('FCBASE',base_url().'siteadmin');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>What A Bloom Administration Area</title>
<link rel="stylesheet" type="text/css" href="/admin/css/style.css" />
<?php if(isset($js)) echo $js; ?>
<script language="javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script language="javascript" src="/js/jquery.event.hover.js"></script>
<script language="javascript" src="/js/superfish.js"></script>
<script language="javascript" src="/js/fc.js"></script>

<link href="/admin/css/superfish.css" rel="stylesheet" type="text/css" />





</head>
<body>

<div id="header">
  <h1>What A Bloom</h1>
  <div id="nav-container">
  <ul id="navigation">
	      <li class="current_item"><a href="<?php echo FCBASE;?>/">Dashboard</a>
			    <ul>
				  <li><a href="../">Front End</a></li>
				  <li><a href="/siteadmin/welcome/logout">Logout</a></li>
			    </ul>
	      </li>
<?php if(accessGrant('customers') || accessGrant('affiliates') || accessGrant('companies') || accessGrant('orders')) : ?>
	      <li> <a href="#">Clients</a>
			    <ul>
<?php if(accessGrant('customers')) :?>
				  <li><a href="<?php echo FCBASE;?>/customers">Customers</a></li>
				  <li><a href="<?php echo FCBASE;?>/customers/create">New Customer</a></li>
<?php endif; if(accessGrant('affiliates')) :?>
				  <li><a href="<?php echo FCBASE;?>/affiliates">Affiliates</a></li>
				  <li><a href="<?php echo FCBASE;?>/affiliates/create">New Affiliates</a></li>
<?php endif; if(accessGrant('companies')) :?>
				  <li><a href="<?php echo FCBASE;?>/companies">Companies</a></li>
<?php endif;  if(accessGrant('orders')) :?>
				  <li><a href="<?php echo FCBASE;?>/orders/cancel">Cancel Requests</a></li>
<?php endif; ?>
			   </ul>    
	      </li>
<?php endif; ?>

<?php if(accessGrant('orders')) :?>
	      <li><a href="<?php echo FCBASE;?>/orders/browse">Orders</a>
			  <ul>
				  <li><a href="<?php echo FCBASE;?>/orders/today">Today's Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/yesterday">Yesterday's Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/month">This Month</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/browse">View All Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/pending">Pending Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/completed">Completed Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/cancelled">Cancelled Orders</a></li>
				  <li><a href="<?php echo FCBASE;?>/orders/manage">Manage Orders</a></li>

			  </ul>
	      </li>
<?php endif;?>

<?php if(accessGrant('products') || accessGrant('addons') || accessGrant('categories') || accessGrant('subcategories') ||
	 accessGrant('occasions') || accessGrant('colors') || accessGrant('productgroups') || accessGrant('deliverymethods') ||
	 accessGrant('discounts') || accessGrant('socialmedia') || accessGrant('currencies') || accessGrant('translation') || accessGrant('policies') ||
	 accessGrant('emails') || accessGrant('locationgroups') ||  accessGrant('countries') || accessGrant('provinces') || 
	  accessGrant('cities') || accessGrant('postalcodes') || accessGrant('holidays') || accessGrant('landing')) : ?>
	      <li><a href="#">Setup</a>
			  <ul>
				  <li><a href="#">Products</a>
					  <ul>
<?php if(accessGrant('products')) :?>
						    <li><a href="<?php echo FCBASE;?>/products">Main Products</a></li>
						    <li><a href="<?php echo FCBASE;?>/products/create">Add Product</a></li>
						    <li><a href="<?php echo FCBASE;?>/products/linking">Product Links</a></li>
<?php endif; if(accessGrant('addons')) :?>
						    <li><a href="<?php echo FCBASE;?>/addons">Addon Items</a></li>
<?php endif; ?>
					  </ul>  
				  </li>
<?php if(accessGrant('categories')) :?>
				  <li><a href="<?php echo FCBASE;?>/categories">Categories</a></li>
<?php endif; if(accessGrant('subcategories')) :?>
				  <li><a href="<?php echo FCBASE;?>/subcategories">Sub categories</a></li>
<?php endif; if(accessGrant('occasions')) :?>
				  <li><a href="<?php echo FCBASE;?>/occasions">Occasions</a></li>
<?php endif; if(accessGrant('colors')) :?>
				  <li><a href="<?php echo FCBASE;?>/colors">Product Colors</a></li>
<?php endif; if(accessGrant('productgroups')) :?>
				  <li><a href="<?php echo FCBASE;?>/productgroups">Product Groups</a></li>
                  
                  
                  
                  
                  <li><a href="#">Landing Pages</a>
					  <ul>
<?php //if(accessGrant('landing')) :?>
						    <li><a href="<?php echo FCBASE;?>/landing">Cities</a></li>
						   
<?php //endif; ?>
					  </ul>  
				  </li>
                  
                  
                  
                  
<?php endif; if(accessGrant('monthproducts')) :?>
				  <li><a href="<?php echo FCBASE;?>/monthproducts">Birthday Months</a></li>
<?php endif; if(accessGrant('deliverymethods')) :?>
				  <li><a href="<?php echo FCBASE;?>/deliverymethods">Delivery Methods</a></li>
<?php endif; if(accessGrant('discounts')) :?>
				  <li><a href="<?php echo FCBASE;?>/discounts">Discounts</a></li>
<?php endif; // if(accessGrant('socialmedia')) :?>
				  <li><a href="<?php echo FCBASE;?>/socialmedia">Social Media</a></li>				  
<?php /* endif; */ if(accessGrant('currencies')) :?>
				  <li><a href="<?php echo FCBASE;?>/currencies">Currencies</a></li>
<?php endif; if(accessGrant('translation')) :?>
				  <li><a href="<?php echo FCBASE;?>/translation">Translation</a></li>
<?php endif; if(accessGrant('policies')) :?>
				  <li><a href="<?php echo FCBASE;?>/policies">Policies</a></li>
<?php endif; if(accessGrant('emails')) :?>
				  <li><a href="<?php echo FCBASE;?>/emails">Email Templates</a></li>
<?php endif; ?>
  
				  <li><a href="#">Locations</a>
 
					  <ul>
<?php if(accessGrant('locationgroups')) :?>
						     <li><a href="<?php echo FCBASE;?>/locationgroups">Location Groups</a></li>
<?php endif; if(accessGrant('countries')) :?>
						    <li><a href="<?php echo FCBASE;?>/countries">Countries</a></li>
<?php endif; if(accessGrant('provinces')) :?>
						    <li><a href="<?php echo FCBASE;?>/provinces">Provinces/States</a></li>
<?php endif; if(accessGrant('cities')) :?>
						    <li><a href="<?php echo FCBASE;?>/cities">Cities</a></li>
<?php endif;  if(accessGrant('postalcodes')) :?>
						    <li><a href="<?php echo FCBASE;?>/postalcodes">Postal/Zip Codes</a></li>
<?php endif;?>
					  </ul>
				  </li>
<?php if(accessGrant('holidays')) :?>
				  <li><a href="<?php echo FCBASE;?>/holidays">Holidays</a></li>
<?php endif;?>
			  </ul>
		</li>
<?php endif; ?>

<?php if(accessGrant('menu') || accessGrant('pages') || accessGrant('banners') || accessGrant('tiles') || accessGrant('categories') || 
	 accessGrant('slider') || accessGrant('admins')) : ?>
		<li><a href="#">Site</a>
			  <ul>
<?php  if(accessGrant('menu')) :?>
				  <li><a href="<?php echo FCBASE;?>/menu">Menus</a></li>
<?php endif; if(accessGrant('pages')) :?>
				  <li><a href="<?php echo FCBASE;?>/pages">Pages</a></li>
<?php endif; if(accessGrant('banners')) :?>
				  <li><a href="<?php echo FCBASE;?>/banners">Banners</a></li>
<?php endif; if(accessGrant('tiles')) :?>
				  <li><a href="<?php echo FCBASE;?>/tiles">Home page Tiles</a></li>
				  <!--  <li><a href="#">Front Page</a></li>
<?php endif; if(accessGrant('categories')) :?>
				  <li><a href="#">Main Tabs</a></li> -->
				  <li><a href="<?php echo FCBASE;?>/categories/select">Main Categories</a></li>
				  <!--  <li><a href="#">Sidebar</a></li> -->
<?php endif; if(accessGrant('slider')) :?>
				  <li><a href="<?php echo FCBASE;?>/slider">Product Slider</a></li>
<?php endif; if(accessGrant('sitemap')) :?>
				  <li><a href="<?php echo FCBASE;?>/sitemap">Sitemap.xml</a></li>
<?php endif; if(accessGrant('robots')) :?>
				  <li><a href="<?php echo FCBASE;?>/robots">Robots.txt</a></li>
<?php endif; if(accessGrant('admins')) :?>
				  <li><a href="<?php echo FCBASE;?>/admins">Administrators</a></li>
<?php endif; ?>

			  </ul>    
    
		</li>
		
<?php endif; ?>

<?php if(accessGrant('reports')) :?>
		<li><a href="<?php echo FCBASE;?>/reports/view/sales">Reports</a>
			  <ul>
			    <!--
				  <li><a href="<?php echo FCBASE;?>/reports/wizard">Report Wizard</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/wizard">New Reports</a>
				       <ul>
					//-->
					 <li><a href="<?php echo FCBASE;?>/reports/product_report">Product Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/dailysales_report">Daily Sales Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/orders_report">Orders Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/coupons_report">Coupons Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/allusers_report">All Users Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/delivery_report">Delivery Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/search_report">Search Terms Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/multipleorders_report">One/Two time User Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/refund_report">Refund Report</a></li>
					 <li><a href="<?php echo FCBASE;?>/reports/newemail_report">New Email Addresses</a></li>
				       
			  <!-- </ul>
				  </li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/sales">Sales Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/customer">Customer Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/affiliate">Affiliates Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/company">Company Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/product">Product Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/coupon">Coupon Report</a></li>
				  <li><a href="<?php echo FCBASE;?>/reports/view/income">Income Report</a></li>
			  //-->
			  </ul>
		</li>
<?php endif; ?>
	</ul>
  
  </div><span class="clear"></span>
</div>
<div id="container">
