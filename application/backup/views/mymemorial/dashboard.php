<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>

<?php include("FusionCharts.php"); 

$affi_cod = $affiliate->user_id;
?>	
		
		
		
		<link href="<?php echo base_url();?>charts/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url();?>charts/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>charts/lib.js"></script>
        <!--[if IE 6]>
        <script type="text/javascript" src="<?php echo base_url();?>charts/DD_belatedPNG_0.0.8a-min.js"></script>

<script>
          /* select the element name, css selector, background etc */
          DD_belatedPNG.fix('img');

          /* string argument can be any CSS selector */
        </script>
        <![endif]-->



      <div id="content" class="clearfix">
        <div id="page">
          <div class="contents" id="dashboard">
           <div class="row-fluid">
              <div class="span8">
			  
			  
			  
			  
			  
			  
               <ul class="dashmenu" style="width:250px;">
                  <!--<li>
                      <a href="/mymemorial/products">
                        <img src="/images/products.png" width="70" height="70"/>
                      <p>Products</p>
                      </a>
                  </li>-->
                  <li>
                       <a href="/mymemorial/orders">
                        <img src="/images/orders.png" width="70" height="70"/>
                      <p>My Orders</p>
                       </a>	
                  </li>
                  <?php if($affiliate->user_id!=5886327){ ?>
				  <li>
                       <a href="/mymemorial/orders/createnew">
                        <img src="/images/shopnow.png" width="70" height="70"/>
                      <p>Create Order</p></a>
                  </li>
				  <?php } ?> 
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
                       <a href="/mymemorial/calendar">
                        <img src="/images/calendar.png" width="70" height="70"/>
                      <p>Calendar</p>
                       </a>
                  </li> 
                  <li>
                       <a href="/mymemorial/sessions/logout">
                        <img src="/images/logout.png" width="70" height="70"/>
                      <p>LogouT</p>
                       </a>
                  </li>
               </ul>
			   
			   
				<!--<div id="MyLiveChatContainer"></div>
				<script type="text/javascript" src="https://mylivechat.com/chatbutton.aspx?hccid=73301220"></script>-->

			   
			   
              </div>
              <div class="span8" style="margin-left:-120px; width:330px;">
			  
			  
			  <table class="dashboard-table table">
                  <tr>
                    <th colspan="3">My Information</th>
                  </tr>
				  <tr>
                    <td>Affiliate Name</td>
                    <td>:</td>
                    <td><?php echo $affiliate->user_business; ?></td>                    
                  </tr>
				  <tr>
                    <td>Joined</td>
                    <td>:</td>
                    <td><?php echo date('d M Y',strtotime($affiliate->user_created));?></td>                    
                  </tr>
                  <!--<tr>
                    <td>Orders this Month</td>
                    <td>:</td>
                    <td><?php //echo $sales;?></td>                    
                  </tr>
                   <tr>
                    <td>Sales this Month</td>
                    <td>:</td>
                    <td><?php //echo getRate($total);?></td>                    
                  </tr>-->
                </table> 
			  
			  
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
                
                          
                
              </div>
			  
			  
              <div class="span8" style="width:560px;">
			  
			  
					 <div class="content-area">
                <div id="content-area-inner-main">
                   
                    <div class="gen-chart-render">
					
                        <?php

                        $strXML  = "<chart caption='Sales for ".$year." - Pie Chart' xAxisName='Days of the Month' yAxisName='Canadian Dollars' showValues='1' numberPrefix='$' formatNumberScale='0' showBorder='1' rotateValues='1' placeValuesInside='1' forceYAxisValueDecimals='1'  yAxisValueDecimals='2'>";
                        
						
					$mon_result = mysqli_query($con,"SELECT SUBSTRING(SUBSTRING_INDEX( order_date , ' ', 1), 1, 7) AS date_month, TRUNCATE(SUM(amount+tax+shipping+service-coupon-discount+surcharge), 2) AS total
FROM orders WHERE status_id=2 AND affiliate_id=".$affi_cod." GROUP BY date_month ORDER BY date_month ASC");
						$z = 1;
						$mo = '';
						while($mon_row = mysqli_fetch_array($mon_result)){ 
						
						$mo = date('F', strtotime($mon_row['date_month']));
						
						$strXML .= "<set label='".$mo."' value='".$mon_row['total']."' />";
						
						$z=$z+1;
						}
						
                        $strXML .= "</chart>";

                        echo renderChartHTML("http://integration.flowercrazy.com/assets/charts/Pie2D.swf", "", $strXML, "myNext", "100%", 470, false);
                        ?>
                    </div>
                    <div class="clear"></div>
                    <p>&nbsp;</p>
                  

                    <div class="underline-dull"></div>
                </div>
            </div>
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
                <div id="chart_div" style="display:none;"></div>
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
