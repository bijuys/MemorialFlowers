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


	<br />
		
      <div id="content" class="clearfix">
		
		<span style="color:#770922;font-size:30px;">Dashboard</span>
		<br /><br />
		
		<table width="100%" border="0">
			<tr>
				<td width="20%" valign="top">
					
					<ul class="dashmenu" style="width:250px;">
						<li>
							<a href="/mymemorial" style="color:#770922;">
								<img src="/images/dashboard-icon.png" width="70" height="70"/>
								<p>Dashboard</p>
							</a>	
						</li>
						<li>
							<a href="/mymemorial/orders" style="color:#770922;">
								<img src="/images/invoice-icon.png" width="70" height="70"/>
							<p>Orders</p>
							</a>	
						</li>
						<li>
							<a href="/mymemorial/products/browse" style="color:#770922;">
								<img src="/images/flow.png" width="70" height="70"/>
							<p>Products</p>
							</a>	
						</li>
					  
						<li>
							<a href="/mymemorial/calendar" style="color:#770922;">
								<img src="/images/delivery-icon.png" width="70" height="70"/>
								<p>Deliveries</p>
							</a>	
						</li>
						<li>
							<a href="/mymemorial/settings" style="color:#770922;">
								<img src="/images/myaccount-icon.png" width="70" height="70"/>
							<p>Account</p>
							</a>	
						</li>
						<li>
							<a href="/mymemorial/reports" style="color:#770922;">
								<img src="/images/reports-icon.png" width="70" height="70"/>
								<p>Reports</p>
							</a>	
						</li>
						<!--
						<li>
							<a href="/mymemorial/sessions/logout" style="color:#770922;">
								<img src="/images/logout-icon.png" width="70" height="70"/>
							<p>Log Out</p>
							</a>	
						</li>
						-->
					</ul>
					
				</td>
				<td width="30%" valign="top" style="padding-left:10px;padding-right:10px;">
					
					<table class="dashboard-table table" style="color:#555;">
						<tr>
							<th colspan="3" style="color:#fff;background-color:#770922;">My Information</th>
						</tr>
						<tr>
							<td>Company</td>
							<td>:</td>
							<td><?php echo $affiliate->user_business; ?></td>                    
						</tr>
						<tr>
							<td>Joined</td>
							<td>:</td>
							<td><?php echo date('d M Y',strtotime($affiliate->user_created));?></td>                    
						</tr>
					</table> 
					
					<table class="dashboard-table table" style="color:#555;">
						<tr>
							<th colspan="3" style="color:#fff;background-color:#770922;">Recent Purchases</th>
						</tr>
						<?php foreach($recent_orders as $order) : ?>
						<tr>
							<td><?php echo '#'.$order->invoice_id;?></td>
							<td><?php echo date('d M y',strtotime($order->order_date));?></td>
							<td class="center"><?php echo getRate($order->amount);?></td>                    
						</tr>
						<?php endforeach; ?>
					</table>
					
				</td>
				<td width="50%" valign="top" style="padding-left:10px;padding-right:10px;">
					
					<script>
					var barChartData = {
						labels : [
								<?php 
								foreach($ventas as $venta){ 
									echo '"'.date("M",strtotime($venta->monthofyear)).'",';
								}
								?>
						],
						datasets : [
							{
								fillColor : "rgba(220,220,220,0.75)",
								strokeColor : "rgba(220,220,220,0.75)",
								highlightFill: "rgba(91,197,195,1)",
								highlightStroke: "rgba(91,197,195,1)",
								data : [
										<?php 
										foreach($ventas as $venta){ 
											echo $venta->total.',';
										}
										?>
								
								]
							},
						]

					}
					window.onload = function(){
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myBar = new Chart(ctx).Bar(barChartData, {
							responsive : true
						});
					}
					</script>
					
					<table class="dashboard-table table" style="color:#555;width:550px;">
						<tr>
							<th colspan="3" style="color:#fff;background-color:#770922;">Monthly Sales (C$)</th>
						</tr>
						<tr>
							<td colspan="3">
								<canvas id="canvas" width="500" height="270"></canvas>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
		</table>
	  
      </div><!-- Contents //-->
	  
	  <br />
	  
<?php //include_once(APPPATH.'views/footer.php'); ?>

<script src="<?php echo base_url(); ?>js/Chart.js"></script>
