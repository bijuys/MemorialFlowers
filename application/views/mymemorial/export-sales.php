 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=SaleReport.xls");
//header("Content-Disposition: attachment; filename=SaleReport_".date('d M Y',strtotime($de1))."-".date('d M Y',strtotime($de2)).".xls");

header("Pragma: no-cache");
header("Expires: 0");
?>
<h1><?php echo lang('Sales Report');?></h1>
<p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($de1));?> to <?php echo date('d M Y',strtotime($de2));?></u></p>

 <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Invoice</th>
				  <?php if($this->session->userdata('affiliate_id')==5886400){ ?>
					<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Newspaper</th>
				  <?php } ?>
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
                        $items = 0;
                        $shipping = 0;
                        $tax =0;
                        $other = 0;
                        $amount = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
                  
                        foreach($orders as $row) :
                        
                          $amount += $row->amount;
                          $items += $row->items;
                          $shipping += $row->shipping;
                          $tax += $row->tax;
                          $other += $row->service+$row->surcharge;
                          $total += $row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge;
						  $commission += $row->commission;
                  
                  ?>
                  <tr>
                    <th class="center"><?php echo $row->invoice_id;?></th>
					<?php if($this->session->userdata('affiliate_id')==5886400){ ?>
					<th class="center">
						<?php if($row->cobrand!=''){ echo $row->cobrand; }else{ echo 'Not Defined'; } ?>
					</th>
					<?php } ?>
                    <th class="center"><?php echo date('d M Y',strtotime($row->order_date));?></th>
                    <th class="center"><?php echo $row->items;?></th>
                    <th class="right"><?php echo getRate($row->amount);?></th>
                    <th class="right"><?php echo getRate($row->shipping);?></th>
                    <th class="right"><?php echo getRate($row->tax);?></th>
                    <th class="right"><?php echo getRate($row->service+$row->surcharge);?></th>
                    <th class="right"><?php echo getRate($row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge);?></th>
                      <th class="right"><?php echo getRate($row->commission);?></th>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr >
                       <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center; background-color:#4A708B;">&nbsp;</td>
					    <?php if($this->session->userdata('affiliate_id')==5886400){ ?>
						<td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center; background-color:#4A708B;">&nbsp;</td>
				  <?php } ?>
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center; background-color:#4A708B;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo $items;?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($amount);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($shipping);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($tax);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($other);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($total);?></th>
                       <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px; background-color:#4A708B;"><?php echo getRate($commission);?></th>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
                
              </body></html>