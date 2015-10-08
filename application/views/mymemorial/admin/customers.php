<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers Customers</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Customers List</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader">Showing customers list</div>
        <?php if(count($customers)) { ?>
        <form action="<?php echo base_url();?>admin/customers/upgrade" method="post" name="form" >
        <table width="700" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Sales</th>
            <th>Amount</th>
            <th>ACtions</th>
          </tr>
          <?php foreach($customers as $res) : ?>
          <tr>
            <td><?php echo $res->customer_id;?></td>
            <td><?php echo $res->firstname.' '.$res->lastname;?></td>
            <td><?php echo $res->email;?></td>
            <td><?php echo $res->sales;?></td>
            <td><?php echo '$'.number_format($res->amount,2);?></td>
            <td><a href="<?php echo base_url().'admin/customers/edit/'.$res->customer_id;?>">Edit</a> | <a href="<?php echo base_url().'admin/customers/delete/'.$res->customer_id;?>" onclick="javascript: return confirm('Are you sure to delete?');return false;">Del</a></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <div class="action-row">
            <input type="button" name="submit" value="Create Customer" class="button" onclick="javascript: window.location.href='<?php echo base_url().'admin/customers/create';?>';" />
        </div>
        </form>
        <?php } ?>
        </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.customer.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
