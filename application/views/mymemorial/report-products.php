<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Products Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($de1));?> to 
          <?php echo date('d M Y',strtotime($de2));?></u>
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($products)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Product Code</th>
				  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Image</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Product</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Price</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Sales</th>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $sales = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
                  
                        foreach($products as $row) :
                        
                        $total += $row->total;
                        $sales += $row->sales;
                  
                        /*$grandtotal += $row->amount;
                        $commission += $row->commission;
                        $items += $row->items;*/
                  
                  ?>
                  <tr>
                    <td class="center"><?php echo $row->product_code;?></td>
                    <td class="center" width="0"><img src="<?php echo img_format('/productres/'.$row->product_picture,'stamp');?>" style="width: 30px; height: 30px;" /></td>
                    <td class="left"><?php echo $row->product_name;?></td>
                    <td class="right"><?php echo '$'.number_format($row->price,2);?></td>
                    <td class="center"><?php echo $row->sales;?></td>
                    <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr style="background-color:#4A708B;">
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px;">&nbsp;</td>
                      <td style="color:#E5E5E5; font-weight:bold; font-size:18px;">&nbsp;</td>
                      <td class="left" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><strong>Total</strong></td>
                      <td class="left" style="color:#E5E5E5; font-weight:bold; font-size:18px;">&nbsp;</td>
                      <td class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><strong><?php echo $sales; ?></strong></td>
                      <td class="right" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><strong><?php echo '$'.number_format($total,2); ?></strong></td>
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
