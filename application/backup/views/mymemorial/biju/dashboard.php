<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      <div id="content" class="clearfix">
        <div id="page">
          <div class="contents" id="dashboard">
           <div class="row-fluid">
              <div class="span8">
               <ul class="dashmenu">
                  <li>
                      <a href="/mymemorial/products">
                        <img src="/images/products.png" width="70" height="70"/>
                      <p>Products</p>
                      </a>
                  </li>
                  <li>
                       <a href="/mymemorial/orders">
                        <img src="/images/orders.png" width="70" height="70"/>
                      <p>My Orders</p>
                       </a>
                  </li>
                  <li>
                       <a href="/mymemorial/orders/create">
                        <img src="/images/shopnow.png" width="70" height="70"/>
                      <p>Create Order</p></a>
                   </li>
                  <li>
                       <a href="/mymemorial/settings">
                        <img src="/images/myshop.png" width="70" height="70"/>
                      <p>My Shop</p></a>
                   </li>
                  <li>
                       <a href="/mymemorial/reports">
                        <img src="/images/reports.png" width="70" height="70"/>
                      <p>Reports</p>
                       </a>
                     </li>
                  <li>
                       <a href="/mymemorial/sessions/logout">
                        <img src="/images/logout.png" width="70" height="70"/>
                      <p>Logout</p>
                       </a>
                  </li>
               </ul>
              </div>
              <div class="span8">
                <table class="dashboard-table table">
                  <tr>
                    <th colspan="3">Recent Purchases</th>
                  </tr>
                  <?php foreach($recent_orders as $order) : ?>
                  <tr>
                    <td><?php echo '#'.$order->invoice_id;?></td>
                    <td><?php echo date('d M y',strtotime($order->order_date));?></td>
                    <td class="center"><?php echo getRate($order->amount);?></td>                    
                  </tr>
                  <?php endforeach; ?>
                </table>
                <table class="dashboard-table table">
                  <tr>
                    <th colspan="3">Recently purchased items</th>
                  </tr>
                  <?php foreach($recent_items as $item) : ?>
                  <tr>
                    <td><?php echo $item->product_name;?></td>
                    <td><?php echo getRate($item->product_price);?></td>
                    <td></td>                    
                  </tr>
                  <?php endforeach; ?>
                </table>
                
                <table class="dashboard-table table">
                  <tr>
                    <th colspan="3">My Statitics</th>
                  </tr>
                  <tr>
                    <td>Joined</td>
                    <td>:</td>
                    <td><?php echo date('d M Y',strtotime($affiliate->user_created));?></td>                    
                  </tr>
                  <tr>
                    <td>Last Login</td>
                    <td>:</td>
                    <td><?php echo date('d M Y',strtotime($affiliate->user_lastlogin));?></td>                    
                  </tr>
                  <tr>
                    <td>Total Sales</td>
                    <td>:</td>
                    <td><?php echo $sales;?></td>                    
                  </tr>
                   <tr>
                    <td>Total Amount</td>
                    <td>:</td>
                    <td><?php echo getRate($total);?></td>                    
                  </tr>
                </table>           
                
              </div>
              <div class="span8">
                <div id="chart_div"></div>
                    <!--Load the AJAX API-->
                    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
                    <script type="text/javascript">
                
                      // Load the Visualization API and the piechart package.
                      google.load('visualization', '1.0', {'packages':['corechart']});
                
                      // Set a callback to run when the Google Visualization API is loaded.
                      google.setOnLoadCallback(drawChart);
                
                      // Callback that creates and populates a data table,
                      // instantiates the pie chart, passes in the data and
                      // draws it.
                      function drawChart() {
                
                        // Create the data table.
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Month');
                        data.addColumn('number', 'Sales C$');
                        data.addRows([
                          <?php foreach($monthly_sales as $monthly) : ?>
                          ['<?php echo date('M',mkdate($monthly->year,$monthly->month,1));?>', <?php echo number_format($monthly->sales,0);?>],
                          <?php endforeach; ?>
                        ]);
                
                        // Set chart options
                        var options = {'title':'Last Six Month Sales',
                                       'width':350,
                                       'height':300};
                
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                      }
                    </script>
                 
              </div>
           </div>
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
