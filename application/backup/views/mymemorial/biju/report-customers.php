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
        <h1><?php echo lang('customer-report');?></h1>
          <div class="contents">
            <div id="table-wrapper">
              <table class="report">
                <thead>
                <tr>
                  <th>Customer</th>
                  <th>City</th>
                  <th>Postalcode</th>
                  <th>Sales</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  
                  $sales = 0;
                  $total = 0;
                  
                        foreach($customers as $row) :
                        
                        $total += $row->total;
                        $sales += $row->sales;
                  
                          /*$grandtotal += $row->amount;
                          $commission += $row->commission;
                          $items += $row->items;*/
                  
                  ?>
                  <tr>
                    <td class="left"><?php echo $row->name;?></td>
                    <td class="left"><?php echo $row->city;?></td>
                    <td class="right"><?php echo $row->postalcode;?></td>
                    <td class="center"><?php echo $row->sales;?></td>
                    <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr>
                      <td>&nbsp;</td>
                      <td class="left">Grand Total</td>
                      <td class="left">&nbsp;</td>
                      <td class="center"><?php echo $sales; ?></td>
                      <td class="right"><?php echo '$'.number_format($total,2); ?></td>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- Page //-->
        <div id="sidebar">
         <?php include_once('widget_products_search.php'); ?>
         <?php include_once('widget_order_search.php'); ?>
         <?php include_once('widget_cart.php'); ?>
        </div><!-- Sidebar //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once("footer.php"); ?>
</body>
</html>
