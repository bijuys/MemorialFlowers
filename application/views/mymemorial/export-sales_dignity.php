 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/csv; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
//header("Content-type: application/octet-stream");
header('Content-Type: application/csv');
header("Content-Disposition: attachment; filename=OrdersReport.xls");
//header("Content-Disposition: attachment; filename=SaleReport_".date('d M Y',strtotime($de1))."-".date('d M Y',strtotime($de2)).".xls");

header("Pragma: no-cache");
header("Expires: 0");
?>
<h1><?php echo lang('Orders Report');?></h1>
<p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($de1));?> to <?php echo date('d M Y',strtotime($de2));?></u></p>

 <table class="table table-striped table-bordered">
               <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order ID</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order Date</th>
                  <!--<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Items</th>-->
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Merchandise Value</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Origin Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Product Name</th>
                </tr>
                </thead>
                <tbody>
                  <?php
					$tot = 0;
					foreach($orders as $row) :
						$tot += $row->purchase;
                  ?>
                  <tr>
                    <th class="center" style="font-weight:normal;">
						<?php echo $row->invoice_id;?>
					</th>
					<th class="center" style="font-weight:normal;">
						Order
					</th>
                    <th class="center" style="font-weight:normal;">
						<?php echo date('m-d-Y',strtotime($row->order_date)); ?>
					</th>
					<!--
                    <th class="center">
						<?php echo $row->items;?>
					</th>
					-->
                    <th class="center" style="font-weight:normal;">
						<?php echo getRate($row->purchase);?>
					</th>
					<th class="center" style="font-weight:normal;">
						Internet
					</th>
					<th style="font-weight:normal;text-align:left;" align="left">
						<?php echo $row->product_name;?>
					</th>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr style="background-color:#4A708B;">
                      <td colspan="3" style="color:#E5E5E5; font-weight:bold; font-size:15px; text-align:right;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:15px;"><?php echo getRate($tot);?></th>
                      <th colspan="2" class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"></th>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
                
              </body></html>