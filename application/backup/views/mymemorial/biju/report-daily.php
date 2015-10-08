<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Sales Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($_POST['start_year'].'-'.$_POST['start_month'].'-'.$_POST['start_day']));?> to 
          <?php echo date('d M Y',strtotime($_POST['end_year'].'-'.$_POST['end_month'].'-'.$_POST['end_day']));?></u>
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($orders)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Invoices</th>
                  <th>Orders</th>
                  <th class="right">Mer. Total</th>
                  <th class="right">Shipping</th>
                  <th class="right">Tax</th>
                  <th class="right">Other</th>
                  <th class="right">Total</th>
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
                        $ords = 0;
                  
                        foreach($orders as $row) :
                        
                          $amount += $row->amount;
                          $shipping += $row->shipping;
                          $tax += $row->tax;
                          $other += $row->service+$row->surcharge;
                          $total += $row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge;
                          $ords += $row->orders;
                  
                  ?>
                  <tr>
                    <td><?php echo $row->day;?></td>
                    <td><?php echo $row->invoices;?></td>
                    <td class="center"><?php echo $row->orders;?></td>
                    <td class="right"><?php echo getRate($row->amount);?></td>
                    <td class="right"><?php echo getRate($row->shipping);?></td>
                    <td class="right"><?php echo getRate($row->tax);?></td>
                    <td class="right"><?php echo getRate($row->service+$row->surcharge);?></td>
                    <td class="right"><?php echo getRate($row->amount+$row->shipping+$row->tax+$row->service+$row->surcharge);?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Total</td>
                      <td class="center"><?php echo $ords;?></td>
                      <td class="right"><?php echo getRate($amount);?></td>
                      <td class="right"><?php echo getRate($shipping);?></td>
                      <td class="right"><?php echo getRate($tax);?></td>
                      <td class="right"><?php echo getRate($other);?></td>
                      <td class="right"><?php echo getRate($total);?></td>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
              
              <?php else : ?>
              
                <p class="text-center">Sorry No Results Found.</p>
              
              <?php endif; ?>
            </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
    </div><!-- Dash //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
