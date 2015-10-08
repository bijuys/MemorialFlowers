<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      
	  <br />
	  
	  <link href='<?php echo base_url(); ?>css/fullcalendar/fullcalendar.css' rel='stylesheet' />
			<link href='<?php echo base_url(); ?>css/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
			<script src='<?php echo base_url(); ?>css/lib/jquery.min.js'></script>
			<script src='<?php echo base_url(); ?>css/lib/jquery-ui.custom.min.js'></script>
			<script src='<?php echo base_url(); ?>css/fullcalendar/fullcalendar.min.js'></script>
			<script>

				$(document).ready(function() {
				
					var date = new Date();
					var d = date.getDate();
					var m = date.getMonth();
					var y = date.getFullYear();
					
					
					$('#calendar').fullCalendar({
						height: 795,
						header: {
							/*
							left: 'prev',
							center: 'title',
							right: 'next'
							*/
							left: 'prev,next today',
							center: 'title',
							right: 'month,agendaWeek,agendaDay'
						},
						editable: true,
						events: [
							<?php foreach($totals_orders as $toti) { 
				
								$ano = substr($toti->delivery_date,0,4);
								$mes = substr($toti->delivery_date,5,2)-1;
								$dia = substr($toti->delivery_date,8,2);
								
								$ti = str_replace(":","-",$toti->tim);
							
							?>
							{
							
								title: '<?php echo $toti->total."pcs - ".$toti->firstname." ".$toti->lastname; ?>',
								start: new Date(<?php echo $ano; ?>,<?php echo $mes; ?>,<?php echo $dia; ?>),
								className: ["office"],
								//url: '<?php echo base_url(); ?>orders/review-invoice/<?php echo $toti->invoice_id; ?>',
							},
							<?php } ?>
						]
					});
					
				});

			</script>
			<style>
			#calendar {
				width: 100%;
				margin: 0 auto;
			}
			.office {
				background-color:#770922;
				border-color:#770922;
			}
			</style>
	  
	  <div id="content" class="clearfix">
	  
		<span style="color:#770922;font-size:30px;">Deliveries</span>
		<br /><br />
	  
		<table width="100%">
			<tr>
				<td width="100%">
					
					<div id="calendar"></div>
					
				</td>
			</tr>
		</table>
		
      </div><!-- Contents //-->
<?php //include_once(APPPATH.'views/footer.php'); ?>
