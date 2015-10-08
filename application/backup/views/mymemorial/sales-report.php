<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<?php include_once("header.php"); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Reports');?></h1>
          <div class="contents">
            <div id="table-wrapper">
              <ul id="tabpages">
                <li <?php echo $pagename=='my_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/active';?>"><?php echo lang('my_orders');?></a></li>
                <li <?php echo $pagename=='completed_orders' ? 'class="current"':'';?>><a href="<?php echo base_url().'orders/archived';?>"><?php echo lang('completed_orders');?></a></li>
              </ul>            
            </div>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
         <?php include_once('widget_order_search.php'); ?>
         <?php include_once('widget_cart.php'); ?>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
