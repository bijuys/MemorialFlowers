<?php include_once(APPPATH.'views/mymemorial-header.php'); ?>
      <div id="content" class="clearfix">
        <div id="page">
        <h1><?php echo lang('My Calendar');?></h1>
          <div class="contents">
            
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
					
						header: {
							left: 'prev',
							center: 'title',
							right: 'next'
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
							
								title: '<?php echo $toti->total."pcs - ".$toti->tim." - ".$toti->firstname." ".$toti->lastname; ?>',
								start: new Date(<?php echo $ano; ?>,<?php echo $mes; ?>,<?php echo $dia; ?>),
								className: ["office"],
								url: '<?php echo base_url(); ?>mymemorial/calendar/delivery/<?php echo $toti->delivery_date.'_'.$ti.'_'.$toti->firstname.'_'.$toti->lastname; ?>',
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
				background-color:#555555;
				border-color:#555555;
			}
				
			</style>
			
			
			<br /><br />
			
			<div id='calendar'></div>
			
          </div>
        </div><!-- Page //-->
      </div><!-- Contents //-->
<?php include_once(APPPATH.'views/footer.php'); ?>
