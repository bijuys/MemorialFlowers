<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MemorialFlowers :: Affiliates</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div id="main" class="clearfix">
      <div class="page-title">
            <h1>Affiliates List</h1>
      </div>
      <div id="content" class="clearfix">      
        <div id="tableheader">Showing affiliates list</div>
        <?php if(count($affiliates)) { ?>
        <form action="<?php echo base_url();?>admin/affiliates/upgrade" method="post" name="form" >
        <table width="700" border="0" cellpadding="0" cellspacing="0" class="data">
          <tr>
            <th>#ID</th>
            <th>Affiliate Name</th>
            <th>Email</th>
            <th>Sales</th>
            <th>Amount</th>
            <th>Manage</th>
            <th>Upgrade?</th>
          </tr>
          <?php foreach($affiliates as $res) : ?>
          <tr class="<?php if($res->upgraded==1) { echo 'upgraded'; }?>" >
            <td><?php echo $res->affiliate_id;?></td>
            <td><?php echo $res->firstname.' '.$res->lastname;?></td>
            <td><?php echo $res->email;?></td>
            <td><?php echo $res->sales;?></td>
            <td><?php echo '$'.number_format($res->amount,2);?></td>
            <td style="white-space: nowrap;"><a href="<?php echo base_url().'admin/affiliates/edit/'.$res->affiliate_id;?>">Edit</a> | <a href="<?php echo base_url().'admin/affiliates/delete/'.$res->affiliate_id;?>" onclick="javascript: return confirm('Are you sure?'); return false;">Del</a></td>
            <td><input type="checkbox" name="affiliate[]" id="affiliate_<?php echo $res->affiliate_id;?>" value="<?php echo $res->affiliate_id ?>" <?php if($res->upgraded==1) { echo 'checked="checked"'; } ?> />
                  <input type="hidden" name="affiliate_id[<?php echo $res->affiliate_id;?>]" id="affiliateid<?php echo $res->affiliate_id;?>" valign="1" />
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
        <div class="action-row">
            <input type="submit" name="submit" value="Update Status" class="button" />
        </div>
        </form>
        <?php } ?>
        </div>

</div>
    <div id="sidebar">
<?php include_once('sidebar.affiliate.php');?>
    </div><!-- Sidebar -->
<?php include_once("footer.php"); ?>
</body>
</html>
