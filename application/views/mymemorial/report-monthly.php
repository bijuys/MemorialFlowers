<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Monthly Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo $month_year."-".$Monthly_sel;?> </u>
       
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($monthly)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                 <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Month</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Orders</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Mer. Total</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Shipping</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Tax</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Other</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
						
						$items = 0;
                        $service = 0;
						$surcharge = 0;
						$shipping = 0;
                        $tax =0;
                        $other = 0;
                        $amount = 0;
						$price_sum = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
						$totalorder = 0;
					    $ords = 0;
                  
                        foreach($monthly as $row) :
                        
							
							// $service += $row->service;
							 //$surcharge += $row->surcharge;
							 $other += $row->service+$row->surcharge;
                          $amount += $row->amount;
                          $shipping += $row->shipping;
                           $tax += $row->tax;
                          
                          $total += $row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge;
                           $ords += $row->orders;
                  
                  ?>
                  <tr>
                    <td class="center"><?php echo date('M Y',mkdate($row->year,$Monthly_sel,1));?></td>
                    <td class="center"><?php echo $row->orders;?></td>
                    <td class="center"><?php echo getRate($row->amount);?></td>
                    <td class="center"><?php echo getRate($row->shipping);?></td>
                    <td class="center"><?php echo getRate($row->tax);?></td>
                    <td class="center"><?php echo getRate($row->service+$row->surcharge);?></td>
                    <td class="center"><?php echo getRate($row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge);?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr style="background-color:#4A708B;">
                        <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><b>Total</b></td>
                        <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo $ords;?></td>
                         <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo getRate($amount);?></td>
                         <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo getRate($shipping);?></td>
                       <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo getRate($tax);?></td>
                         <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo getRate($other);?></td>
                         <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;"><?php echo getRate($total);?></td>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
              
              
                <p class="text-center">Go To <a href="reports">Report Search</a> </p>
              <?php else : ?>
              
                   <p class="text-center">Sorry No Results Found. Go Back To <a href="reports">Report Search</a></p>
              
              <?php endif; ?>
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
