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
            <h1><?php echo $pagename;?></h1>
      </div>
      <div id="content" class="clearfix">
            <div class="recinfo">Showing <?php echo $start; ?> - <?php echo $start+$recs; ?> of <?php echo $totalpages;?> Records</div>
        <div id="tableheader">Orders Listing</div>
        <?php if(count($orders)) { ?>
        <form action="<?php echo base_url();?>admin/customers/upgrade" method="post" name="form" >
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Item</th>
            <th>Customer / Recipient</th>
            <th>Date & Time</th>
            <th>Affiliate</th>
            <th>Action</th>
          </tr>
          <?php foreach($orders as $res) : ?>
          <tr class="<?php if($res->cstatus=='CM') { echo 'upgraded'; }?>" >
            <td style="white-space: nowrap;"><a href="<?php echo base_url().'admin/orders/view/'.$res->invoice_item_id;?>"><?php echo $res->invoice_id;?>-<?php echo $res->invoice_item_id;?></a></td>
            <td><?php if($res->picture) :?>
                    <img src="<?php echo img_format('../pictures/'.$res->picture,'thumb');?>" width="50" height="50" />
                    <?php endif;?></td>
            <td><?php echo $res->firstname.' '.$res->lastname;?></td>
            <td><?php echo date('d M Y',strtotime($res->orderdate)).' '.$res->gtime;?></td>
            
            <td><?php echo $res->affiliate;?></td>
            <td style="white-space: nowrap;"><a href="<?php echo base_url().'admin/orders/edit/'.$res->invoice_item_id;?>">Edit</a> | <a href="<?php echo base_url().'admin/orders/del/'.$res->invoice_item_id;?>">Del</a></td>
          </tr>
          <?php endforeach; ?>
        </table>
        </form>
        <?php } ?>
        <div class="pagination">
            <?php echo $links; ?>
        </div>
        </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.order.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
