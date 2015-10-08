<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memorial Flowers Products</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Products List</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader">Browse all Products</div>
        <?php if(count($products)) { ?>
        <form action="<?php echo base_url();?>admin/customers/upgrade" method="post" name="form" >
        <table width="700" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Product</th>
            <th>Thumbnail</th>
            <th>Sales</th>
            <th>Amount</th>
            <th>Actions</th>
          </tr>
          <?php foreach($products as $res) : ?>
          <tr class="<?php //if($res->active==1) { echo 'upgraded'; }?>" >
            <td><?php echo $res->product_id;?></td>
            <td><?php echo $res->product;?><br/>
                  <?php echo '<small><em>(From: '.date('d M Y',strtotime($res->created)).')</small></em>'; ?>
            </td>
            <td width="50">
                  <?php if(strlen($res->picture)>4) :?>
                  <img src="<?php echo img_format('../pictures/'.$res->picture,'thumb');?>" width="50" height="50" />
                  <?php else :?>
                  No Image
                  <?php endif; ?>
            </td>
            <td><?php echo $res->sales ? $res->sales:'0';?></td>
            <td><?php echo '$'.number_format($res->amount,2);?></td>
            <td style="white-space:nowrap;"><a href="<?php echo base_url().'admin/products/edit/'.$res->product_id;?>">Edit</a> | <a href="<?php echo base_url().'admin/products/del/'.$res->product_id;?>" onclick="javascript: return confirm('Are you sure to delete?');return false;">Del</a></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <div class="action-row">
            <input type="button" name="submit" value="Create New" class="button" onclick="javascript: window.location.href='<?php echo base_url().'/admin/products/create';?>';" />
        </div>
        </form>
        <?php } ?>
        </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.product.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
