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
          <h1>Customer Sales Report</h1>
      </div>
      <div id="content" class="clearfix">
      <div id="tableheader">Customer sales Report</div>
        <?php if(count($customers)) { ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>Csutomer</th>
            <th>City</th>
            <th>Postalcode</th>
            <th>Sales</th>
            <th>Amount</th>
          </tr>
          <?php foreach($customers as $row) : ?>
          <tr>
                    <td class="left"><?php echo $row->name;?></td>
                    <td class="left"><?php echo $row->city;?></td>
                    <td class="right"><?php echo $row->postalcode;?></td>
                    <td class="center"><?php echo $row->sales;?></td>
                    <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
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
