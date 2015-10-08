<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>

<div id="content" class="clearfix">

    <div id="page">

		<h1>Create Order</h1>
		
			
			
			
		
        	<div class="contents">
				
				<div id="table-wrapper">
					
					<table width="100%" border="0">
					
						<tr>
						
							<td width="80%">
							
								<h2><b>1. </b>Search Product(s)</h2>
							
								<div style="padding-left:30px;">
							
									<div id="order_search">
										<?php echo form_open('/mymemorial/orders/createnew_order',array('class'=>'form-search')); ?>
											<input type="text" name="product_sear" id="product_sear" value="" placeholder="Product Code or Name" style="width:300px;" />
											<button type="submit" name="submit" class="btn btn-success">Filter</button>              
										<?php echo form_close();?>
									</div>
									
									<br />
									
									<span style="font-size:18px; color:red;">NOTE: Please, search for a product before continuing</span>
									
								</div>
								
								
								
								
								
								<br /><br />
								
							</td>
							
							<td width="3%">
							
							</td>
							
							<td width="17%">
							
							</td>
						
						</tr>
					
					</table>
	
				</div>
			  
			</div>
		 
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
