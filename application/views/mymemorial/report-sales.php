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
	  
		<span style="color:#770922;font-size:30px;">Orders Reports</span>
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
										<input type="text" name="datepicker1" id="datepicker1" value="<?php echo $de1; ?>" class="search-query" style="width:72%;" required>
										<input type="hidden" name="funeral_home" id="funeral_home" value="" class="search-query" style="width:72%;">
									</td>
									<td width="15%">
										<label>End date</label>
										<input type="text" name="datepicker2" id="datepicker2" value="<?php echo $de2; ?>" class="search-query" style="width:72%;" required>
									</td>
									<td width="15%">
										<label>Report Type</label>
										<select name="report_type" id="report_type" class="search-query" style="width:100%;">
											<option value="2">Orders</option>
										</select>
									</td>
									<?php if($this->session->userdata('affiliate_id')==5886400){ ?>
									<td width="15%">
										<label>Newspaper</label>
										<?php $newspapers = $this->Report_model->getnewspaper(); ?>	
										<select name="newspaper" id="newspaper">
											<option value="">All Newspapers</option>
											<?php foreach($newspapers as $newspaper){ ?>
											<option value="<?php echo $newspaper->cobrand; ?>" <?php if($newspaper2==$newspaper->cobrand){ echo 'selected="selected"'; }?>><?php echo $newspaper->cobrand; ?></option>
											<?php } ?>                                    
										</select>
									</td>
									<?php }else{ ?>
									
									<input type="hidden" name="newspaper" id="newspaper" value="">
									
									<?php } ?>
									<td width="15%">
										<label>&nbsp;</label>
										&nbsp;&nbsp;&nbsp;<button type="submit" name="submit" class="btn btn-success">Create Report</button>       
									</td>
									<td width="25%">
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
					<a href="reports/toExcel?query=sale&affiliateid=<?php echo $this->session->userdata('affiliate_id'); ?>&d1=<?php echo $de1; ?>&d2=<?php echo $de2; ?>&newspaper=<?php echo $newspaper2; ?>" style="text-decoration:none;font-size:23px;">Export as CSV</a>
				</td>
			</tr>
		</table>
		
		
		<div id="table-wrapper">
              <?php if(count($orders)) : ?>
              <table class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Invoice</th>
				  <?php if($this->session->userdata('affiliate_id')==5886400){ ?>
					<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Newspaper</th>
				  <?php }else{ ?>
					<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E; font-size:16px;">Order Type</th>
				  <?php } ?>
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
					<th class="center">
					
						 <?php if($this->session->userdata('affiliate_id')==5886400){ ?>
							<?php if($row->cobrand!=''){ echo $row->cobrand; }else{ echo 'Not Defined'; } ?>
						 <?php }else{ ?>
								<?php if($row->user_id == $row->affiliate_id){
									echo 'Director Order';
								}
								else
								{
									echo 'Web Order';
								}
								?>
						 <?php } ?>
								
									
					</th>
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
                
              <?php else : ?>
              
                <p class="text-center">Sorry No Results Found. Go Back To <a href="reports">Report Search</a></p>
              
              <?php endif; ?>
            </div>
		
	</div>	
	
<?php //include_once(APPPATH.'views/footer.php'); ?>
