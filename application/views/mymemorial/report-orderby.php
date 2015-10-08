<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Order By Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($de1));?> to 
          <?php echo date('d M Y',strtotime($de2));?></u>
		  
		  
		
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($orderby)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Order By</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">No. Of Orders</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Mer. Total</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Shipping</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Tax</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Other</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $items = 0;
                        $shipping = 0;
                        $tax =0;
                        $other = 0;
                        $amount = 0;
						 $price_sum = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
						$totalorder = 0;
						
                  
                        foreach($orderby as $row) :
                        
                          $amount += $row->amount;
                          $totalorder += $row->totalorder;
						  $price_sum += $row->price_sum;
                          $shipping += $row->shipping;
                          $tax += $row->tax;
                          $other += $row->service+$row->surcharge;
                          $total += $row->price_sum+$row->shipping+$row->tax+$row->service+$row->surcharge;
                  
                  ?>
                  <tr>
                    <th class="center"><?php echo $row->order_by;?></th>
                   
                    <th class="center"><?php echo $row->user_items;?></th>
                    <th class="right"><?php echo getRate($row->price_sum);?></th>
                    <th class="right"><?php echo getRate($row->shipping);?></th>
                    <th class="right"><?php echo getRate($row->tax);?></th>
                    <th class="right"><?php echo getRate($row->service+$row->surcharge);?></th>
                    <th class="right"><?php echo getRate($row->price_sum+$row->shipping+$row->tax+$row->service+$row->surcharge);?></th>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr style="background-color:#4A708B;">
                      
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo $totalorder;?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($price_sum);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($shipping);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($tax);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($other);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($total);?></th>
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
