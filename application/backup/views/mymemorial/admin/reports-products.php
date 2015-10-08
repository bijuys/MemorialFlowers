<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers Orders</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
          <h1>Products Report</h1>
      </div>
      <div id="content" class="clearfix">
      <div id="tableheader">Products sales Report</div>
        <?php if(count($products)) { ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Image</th>
            <th>Product</th>
            <th>Sales</th>
            <th>Amount</th>
          </tr>
          <?php foreach($products as $res) : ?>
          <tr>
            <td style="white-space: nowrap;"><?php echo '#'.$res->product_id;?></td>
            <td><?php if($res->picture) :?>
                    <img src="<?php echo img_format('../pictures/'.$res->picture,'thumb');?>" width="50" height="50" />
                    <?php endif;?></td>
            <td><?php echo $res->product;?></td>
            <td><?php echo $res->sales;?></td>
            <td><?php echo '$'.number_format($res->total,2);?></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php } ?>
        </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.order.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
