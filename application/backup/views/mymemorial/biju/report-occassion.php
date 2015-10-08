<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    <div class="clearfix" id="dash">
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('Occasion Sales Report');?></h1>
          <p class="lead">Report period: &nbsp; <u><?php echo date('d M Y',strtotime($_POST['start_year'].'-'.$_POST['start_month'].'-'.$_POST['start_day']));?> to 
          <?php echo date('d M Y',strtotime($_POST['end_year'].'-'.$_POST['end_month'].'-'.$_POST['end_day']));?></u>
          <div class="contents">
            <div id="table-wrapper">
              <?php if(count($occasions)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>Occasion</th>
                  <th class="center">Sales</th>
                  <th class="center">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $sales = 0;
                        $total = 0;
                        $grandtotal = 0;
                        $commission = 0;
                  
                        foreach($occasions as $row) :
                        
                        $total += $row->total;
                        $sales += $row->sales;
                  
                        /*$grandtotal += $row->amount;
                        $commission += $row->commission;
                        $items += $row->items;*/
                  
                  ?>
                  <tr>
                    <td class="left"><?php echo $row->occasion_name;?></td>
                    <td class="center"><?php echo $row->sales;?></td>                   
                    <td class="right"><?php echo '$'.number_format($row->total,2);?></td>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr>
                      <td class="left"><strong>Total</strong></td>
                      <td class="center"><strong><?php echo $sales; ?></strong></td>
                      <td class="right"><strong><?php echo '$'.number_format($total,2); ?></strong></td>
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
