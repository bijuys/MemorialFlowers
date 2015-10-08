<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
        <h1>Dashboard</h1>
      </div>
      <div id="content" class="clearfix">
        <div id="dashboard" class="clearfix">
          <ul class="dashmenu clearfix">
            <li class="clearfix"><a href="<?php echo base_url().'admin/affiliates';?>"><img src="<?php echo base_url().'images/affiliates.png';?>"/>
            <div class="menu-content"><h3>Affiliates</h3>
            <p>Create, Edit & Delete Affiliates</p>
            </div></a>
            </li>
            <li class="clearfix"><a href="<?php echo base_url().'admin/customers';?>"><img src="<?php echo base_url().'images/customers.png';?>"/>
            <div class="menu-content"><h3>Customers</h3>
            <p>Create, Edit & Delete Customers</p>
            </div></a>
            </li>
            <li class="clearfix"><a href="<?php echo base_url().'admin/products';?>"><img src="<?php echo base_url().'images/products.png';?>"/>
            <div class="menu-content"><h3>Products</h3>
            <p>Create, Edit & Delete Products</p>
            </div></a>
            </li>
            <li class="clearfix"><a href="<?php echo base_url().'admin/orders';?>"><img src="<?php echo base_url().'images/orders.png';?>"/>
            <div class="menu-content"><h3>Orders</h3>
            <p>Process, Edit, Create & Delete Orders</p>
            </div></a>
            </li>
            <li class="clearfix"><a href="<?php echo base_url().'admin/reports';?>"><img src="<?php echo base_url().'images/reports.png';?>"/>
            <div class="menu-content"><h3>Reports</h3>
            <p>View Sales Reports</p>
            </div></a>
            </li>
            <li class="clearfix"><a href="<?php echo base_url().'admin/logout';?>"><img src="<?php echo base_url().'images/logout.png';?>"/>
            <div class="menu-content"><h3>Logout</h3>
            <p>Logout and Lock Admin section</p>
            </div></a>
            </li>
          </ul>
        </div>
      </div>
</div>
<?php include_once('sidebar.php');?>
<?php include_once("footer.php"); ?>
</body>
</html>
