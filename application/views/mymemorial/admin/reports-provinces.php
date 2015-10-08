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
          <h1>Affiliates Report</h1>
      </div>
      <div id="content" class="clearfix">
      <div id="tableheader">Affiliates sales Report</div>
        <?php if(count($provinces)) { ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>Province</th>
            <th>Sales</th>
            <th>Total Amount</th>
          </tr>
          <?php foreach($provinces as $res) : ?>
          <tr>
            <td><?php echo $res->province;?></td>
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
