<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Sales Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($de1));?> to <?php echo date('d M Y',strtotime($de2));?></u>
		    <!--  <p class="lead" style="float:right; margin-right:25px; margin-top:-50px"><a href="/mymemorial/reports/toExcel">Export in Excel</a></p>-->
             <p class="lead" style="float:right; margin-right:25px; margin-top:-50px"><a href="reports/toExcel?query=sale&affiliateid=378&d1=<?php echo $de1; ?>&d2=<?php echo $de2; ?>">Export in Excel</a></p> 
             
		 
		
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($orders)) : ?>
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
                    <tr style="background-color:#4A708B;">
                      <td>&nbsp;</td>
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:center;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo $items;?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($amount);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($shipping);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($tax);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($other);?></th>
                      <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($total);?></th>
                       <th class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($commission);?></th>
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
