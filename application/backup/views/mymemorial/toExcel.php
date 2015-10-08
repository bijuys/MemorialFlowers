<?php

$con=mysqli_connect("localhost","flowercrazy","fc883","funeral_test");
// Check connection
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
   

 <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Invoice</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Date</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Items</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Mer. Total</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Shipping</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Tax</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Other</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Total</th>
                   <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Commission</th>
                </tr>
                </thead>
                <tbody>
                <?php
				//and orders.order_date >=".$d1. "and orders.order_date <=".$d2."
				//00:00:01  23:59:59
                        $items = 0;
                        $shipping = 0;
                        $tax =0;
                        $other = 0;
                        $amount = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
						
						 $totalitems=0;
						 $Mer_total=0;
						 $Shipping_total=0;
						 $Tax_total=0;
						 $Others_total=0;
						 $Grand_total =0;
						 $Commission_total=0; 
                  
					
				  $sales_result = mysqli_query($con,"SELECT orders.*, COUNT( order_items.orderitem_id ) AS items FROM orders LEFT JOIN order_items ON order_items.cart_id = orders.cart_id WHERE orders.affiliate_id =". $affiliateid."   GROUP BY orders.order_id");
						while($sales_result_row = mysqli_fetch_array($sales_result)){
				
						$invoice_id=$sales_result_row['invoice_id'];
						$order_date=$sales_result_row['order_date'];
						
						$amount=$sales_result_row['amount'];
						$items=$sales_result_row['items'];
						$shipping=$sales_result_row['shipping'];
						$tax=$sales_result_row['tax'];
						$service=$sales_result_row['service'];
						
						$surcharge=$sales_result_row['surcharge'];
						$commission=$sales_result_row['commission'];
				  
				   $totalitems +=$items;
				   $Mer_total += $amount;
				   $Shipping_total +=$shipping;
				    $Tax_total +=$tax;
                  $Others_total +=$service+$surcharge;
				   $Grand_total +=$amount+$shipping+$tax+$service+$surcharge;
                  $Commission_total +=$commission;
                  ?>
                  <tr>
                    <th class="center"><?php echo $invoice_id;?></th>
                    <th class="center"><?php echo date('d M Y',strtotime($order_date));?></th>
                    <th class="center"><?php echo $items;?></th>
                    <th class="right"><?php echo getRate($amount);?></th>
                    <th class="right"><?php echo getRate($shipping);?></th>
                    <th class="right"><?php echo getRate($tax);?></th>
                    <th class="right"><?php echo getRate($service+$surcharge);?></th>
                    <th class="right"><?php echo getRate($amount+$shipping+$tax+$service+$surcharge);?></th>
                      <th class="right"><?php echo getRate($commission);?></th>
                  </tr>
                  <?php }?>
                  <tfoot>
                    <tr>
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center; background-color:#4A708B;">&nbsp;</td>
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center; background-color:#4A708B;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo $totalitems;?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Mer_total);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Shipping_total);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Tax_total);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Others_total);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Grand_total);?></th>
                       <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($Commission_total);?></th>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
</body>
</html>

