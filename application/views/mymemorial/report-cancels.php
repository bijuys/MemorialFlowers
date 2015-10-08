<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
    
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css" />
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker();
		$( "#datepicker2" ).datepicker();
	});
	</script>
	
	<br />

	<div id="content" class="clearfix">
	  
		<span style="color:#770922;font-size:30px;">Cancels - Refunds Reports</span>
		<br /><br />
		
		<table width="100%">
			<tr>
				<td width="100%">
					
					<div id="order_search">
						<?php echo form_open('',array('class'=>'form-horizontal')); ?>
							<table width="100%">
								<tr>
									<td width="15%">
										<label>Start date</label>
										<input type="text" name="datepicker1" id="datepicker1" class="search-query" style="width:72%;" required value="<?php echo $de1; ?>">
										<input type="hidden" name="funeral_home" id="funeral_home" value="" class="search-query" style="width:72%;">
									</td>
									<td width="15%">
										<label>End date</label>
										<input type="text" name="datepicker2" id="datepicker2" class="search-query" style="width:72%;" required value="<?php echo $de2; ?>">
									</td>
									<td width="15%">
										<label>Report Type</label>
										<select name="report_type" id="report_type" class="search-query" style="width:100%;">
											<option value="2" <?php if($report_type==2){ echo 'selected'; } ?>>Orders</option>
											<option value="0" <?php if($report_type==0){ echo 'selected'; } ?>>Cancels - Refunds</option>
										</select>
									</td>
									<td width="15%">
										<label>&nbsp;</label>
										&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-success">Create Report</button>       
									</td>
									<td width="40%">
										&nbsp; 
									</td>
								</tr>
							</table>
						<?php echo form_close();?>
					</div>
					
				</td>
			</tr>
		</table>
		
		<br />
		
		<table width="100%">
			<tr>
				<td width="50%">
					<span style="color:#4188CC;font-size:23px;">From <?php echo date('d M Y',strtotime($de1));?> to <?php echo date('d M Y',strtotime($de2));?></span>
				</td>
				<td width="50%" align="right">
					<!--
					<a href="reports/toExcel?funeralhome=<?php echo $funeral_home; ?>&d1=<?php echo $de1; ?>&d2=<?php echo $de2; ?>&reporttype=<?php echo $report_type; ?>" style="text-decoration:none;font-size:23px;">Export in Excel</a>
					-->
				</td>
			</tr>
		</table>
		
		
		<div id="table-wrapper">
              <?php if(count($orders)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E; font-size:16px;">Order ID</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E; font-size:16px;">Transaction Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E; font-size:16px;">Cancel Count</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order Date</th>
                  <!--<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Items</th>-->
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Merchandise Value</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Origin Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Product Name</th>
                </tr>
                </thead>
                <tbody>
                  <?php
					$tot = 0;
					foreach($orders as $row) :
						$tot += $row->purchase;
                  ?>
                  <tr>
                    <th class="center" style="font-weight:normal;">
						<?php echo $row->invoice_id;?>
					</th>
					<th class="center" style="font-weight:normal;">
						Refund
					</th>
					<th class="center" style="font-weight:normal;">
						-1
					</th>
                    <th class="center" style="font-weight:normal;">
						<?php echo date('m-d-Y',strtotime($row->order_date)); ?>
					</th>
					<!--
                    <th class="center">
						<?php echo $row->items;?>
					</th>
					-->
                    <th class="center" style="font-weight:normal;">
						<?php echo getRate($row->purchase);?>
					</th>
					<th class="center" style="font-weight:normal;">
						Internet
					</th>
					<th class="left" style="font-weight:normal;">
						<?php echo $row->product_name;?>
					</th>
                  </tr>
                  <?php endforeach; ?>
                  <tfoot>
                    <tr style="background-color:#4A708B;">
                      <td colspan="4" style="color:#E5E5E5; font-weight:bold; font-size:18px; text-align:right;">Total</td>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"><?php echo getRate($tot);?></th>
                      <th colspan="3" class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"></th>
                    </tr>
                  </tfoot>
                </tbody>
              </table>
                
              <?php else : ?>
              
                <p class="text-center">Sorry No Results Found. Go Back To <a href="reports">Report Search</a></p>
              
              <?php endif; ?>
            </div>
		
	</div>	
	
<?php //include_once(APPPATH.'views/footer.php'); ?>
