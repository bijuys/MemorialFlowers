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
            <h1>Sales Report</h1>
      </div>
      <div id="content" class="clearfix">
      <div id="tableheader">Sales Report</div>
        <?php if(count($invoices)) { ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Items</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Affiliate</th>
            <th>Commission</th>
          </tr>
          <?php foreach($invoices as $res) : ?>
          <tr>
            <td style="white-space: nowrap;"><?php echo '#'.$res->invoice_id;?></td>
            <td><?php echo $res->items;?></td>
            <td><?php echo date('d M Y',strtotime($res->orderdate));?></td>
            <td><?php echo '$'.number_format($res->amount,2);?></td>
            <td><?php echo $res->firstname.' '.$res->lastname;?></td>
            <td><?php echo $res->affiliate_commission;?></td>
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
