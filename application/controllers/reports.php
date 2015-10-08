<?php

class Reports extends CI_Controller {

	function Reports()
	{
				
		parent::__construct();

		$this->lang->load('main',$this->session->userdata('language') ? $this->session->userdata('language'):'english');
		/*
		$this->load->Model('Category_model');
		$this->load->Model('Product_model');
		$this->load->Model('Banner_model');
		$this->load->Model('Affiliate_model');
		*/
		$this->load->Model('Report_model');
	}
	
	public function daily_report($id) 
	{
		
		$year = substr($id,0,4);
		$month = substr($id,5,2);
		$day = substr($id,8,2);
		$complem = substr($id,4,6);
		$previous_year = $year-1; 	
		$previous_year = $previous_year.''.$complem;
		
		//START PREVIOS DATE
		$ts = strtotime($year.'-'.$month.'-01');
		list($year, $week, $dow) = explode('-', date('Y-W-N', $ts));
		$format = ($year - 1) . "-W$week-$dow";
		$prev_start = date('Y-m-d', strtotime($format));
		//END PREVIOS DATE
		$ts = strtotime($year.'-'.$month.'-'.$day);
		list($year, $week, $dow) = explode('-', date('Y-W-N', $ts));
		$format = ($year - 1) . "-W$week-$dow";
		$prev_end = date('Y-m-d', strtotime($format));
		$prev_year = substr($prev_end,0,4);
		$prev_month = substr($prev_end,5,2);
		$prev_day = substr($prev_end,8,2);
		
		
		/*
		echo $id.'<br />';
		echo $prev_start.'<br />';
		echo $prev_end.'<br />';
		*/
		
		$daily_orders = $this->Report_model->get_daily_orders($year,$month,$day);
		$prev_daily_orders = $this->Report_model->get_daily_orders($prev_year,$prev_month,$prev_day);
		
		
							$html = '<html>
										<head>
											<title>Daily Report for '.date('F Y',strtotime($id)).'</title>
										</head>
										<style>
											@page {
												margin-top: 1em;
												margin-bottom: 1em;
												margin-left: 2em;
												margin-right: 2em;
											}
											.header { 
												position: fixed; 
												top: 0px; 
											}
											.footer { 
												position: fixed; 
												bottom: 0px; 
											}
											.pagenum:before { 
												content: counter(page); 
											}
										</style>
										<body style="font-family:Tahoma, Geneva, sans-serif;">
										<div class="header">
				
											<table width="100%" border="0" style="background-color:#FFF;">
												<tr>
													<td width="60%" valign="middle">
														<img src="'.base_url().'images/dignityflowers-finallogo.png" width="213" height="51" />
													</td>
													<td width="40%" align="right" valign="middle">
														<span style="font-size:17px;color:#5CC6C5;font-weight:bold;">Daily Report for '.date('F Y',strtotime($id)).'</span><br />
														<span style="font-size:10px;color:#7F8384;">Created on '.date('M jS, Y h:i a', time()).'</span>
													</td>
												</tr>
											 </table>
											
										</div>
										<div class="footer">
											
											<table width="100%">
												<tr>
													<td width="33%" valign="top">
														<span style="font-family:Trebuchet MS,Helvetica,sans-serif;font-size:9px;">
															Daily Report for '.date('F Y',strtotime($id)).'
														</span>
													</td>
													<td width="34%" valign="top">
														<span style="font-family:Trebuchet MS,Helvetica,sans-serif;font-size:9px;">
															Powered by Memorial Flowers, a division of What A Bloom
														</span>
													</td>
													<td width="33%" valign="top" align="right">
														<span style="font-family:Trebuchet MS,Helvetica,sans-serif;font-size:9px;">
															Page <span class="pagenum"></span>
														</span>
													</td>
												</tr>
											</table>
										
										</div>
										
										';
							
							$html .= '<table width="100%" style="margin-top:100px;background-color:#D5D5FF;">
										<tr>
											<td colspan="11" width="100%" style="background-color:#003366;color:#fff;padding-left:10px;padding-top:5px;padding-bottom:5px;	">
												Daily Orders for '.date('F Y',strtotime($id)).'
											</td>
										</tr>
										<tr style="font-size:8px;font-weight:bold;">
												
											<td colspan="5" align="center" style="background-color:#D5D5FF;color:#fff;padding:-2px;padding-right:2px;">
												<table style="background-color:#D5D5FF;">
													<tr style="font-size:8px;font-weight:bold;">
														<td colspan="5" width="45%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															'.date('F Y',strtotime($id)).'
														</td>
													</tr>
													<tr style="font-size:8px;font-weight:bold;">
														<td width="10%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Acct Recog Date - Day of Week
														</td>
														<td width="10%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Acct Recog Date - MM/DD/YY
														</td>
														<td width="8%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Order Taken Count
														</td>
														<td width="8%" align="center" valign="middle" style="background-color:#666699;color:#fff;padding:3px;">
															Cumulative Month
														</td>
														<td width="9%" align="center" valign="middle" style="background-color:#666699;color:#fff;padding:3px;">
															Cumulative Year
														</td>
													</tr>
													';
												
												$to_or_year = 0;
												$to_or_month = 0;
												$j=1;
												$ord = array();
												foreach($daily_orders as $do){
													$to_or_year = $to_or_year + $do->total;
													if($month==substr($do->order_date,5,2)){
														$ord[$j] = $do->total;
														$to_or_month = $to_or_month + $do->total;
															$day2=strftime("%A",strtotime($do->order_date));
											$html .=    '<tr style="font-size:8px;color:#555;">
															<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																'.date('l', strtotime($do->order_date)).'
															</td>
															<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																'.date('m/d/Y', strtotime($do->order_date)).'
															</td>
															<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																'.$do->total.'
															</td>
															<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																'.$to_or_month.'
															</td>
															<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																'.$to_or_year.'
															</td>
														 </tr>';	
													
														$j=$j+1;
													}
												}
												
									$html .=	'</table>
											</td>
											<td colspan="5" align="center" style="background-color:#D5D5FF;color:#fff;padding:-2px;padding-left:2px;">
												<table style="background-color:#D5D5FF;">
													<tr style="font-size:8px;font-weight:bold;">
														<td colspan="5" width="45%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															'.date('F Y',strtotime($previous_year)).'
														</td>
													</tr>
													<tr style="font-size:8px;font-weight:bold;">
														<td width="10%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Acct Recog Date - Day of Week
														</td>
														<td width="10%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Acct Recog Date - MM/DD/YY
														</td>
														<td width="8%" align="center" style="background-color:#666699;color:#fff;padding:3px;">
															Order Taken Count
														</td>
														<td width="8%" align="center" valign="middle" style="background-color:#666699;color:#fff;padding:3px;">
															Cumulative Month
														</td>
														<td width="9%" align="center" valign="middle" style="background-color:#666699;color:#fff;padding:3px;">
															Cumulative Year
														</td>
													</tr>';
													
													$to_or_year = 0;
													$to_or_month = 0;
													$a=1;
													$ord2 = array();
													foreach($prev_daily_orders as $prev_do){
														$to_or_year = $to_or_year + $prev_do->total;
														//$html .= '_'.$prev_start.'_'.$prev_end;
														//if($prev_month==substr($prev_do->order_date,5,2)){
														if($prev_do->order_date>=$prev_start && $prev_do->order_date<=$prev_end){
															$ord2[$a] = $prev_do->total;
															$to_or_month = $to_or_month + $prev_do->total;
												$html .=    '<tr style="font-size:8px;color:#555;">
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	'.date('l', strtotime($prev_do->order_date)).'
																</td>
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	'.date('m/d/Y', strtotime($prev_do->order_date)).'
																</td>
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	'.$prev_do->total.'
																</td>
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	'.$to_or_month.'
																</td>
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	'.$to_or_year.'
																</td>
															 </tr>';	
															
															$a=$a+1;
														}
													}
													
									$html .= '</table></td>
												<td align="center" style="background-color:#D5D5FF;color:#fff;padding:-2px;padding-left:4px;">
													<table width="100%" style="background-color:#D5D5FF;">
														<tr style="font-size:8px;font-weight:bold;">
															<td width="100%" height="35" align="center" style="background-color:#666699;color:#fff;padding:3px;">
																Variance (%) Day vs Prior Year
															</td>
														</tr>';
													$perce = 0;
													for($i=1;$i<=$j-1;$i++){
														if($ord2[$i]!=0){
															if($ord[$i]!=0){
																$perce = number_format(((($ord[$i]*100)/$ord2[$i])-100),1);
															}else{
																$perce = -100;	
															}
														}else{
															if($ord[$i]!=0){
																$perce = 100;
															}else{
																$perce = 0;	
															}
														}
														if($perce<0){
															$co = 'color:#FC1501;';
															$vi = '('.$perce.'%)';
														}else{
															$co = '';
															$vi = $perce.'%';
														}
													$html .= '<tr style="font-size:8px;color:#555;">
																<td align="center" style="padding-top:3px;padding-bottom:3px;background-color:#fff;">
																	<span style="'.$co.'">'.$vi.'</span>
																</td>
															 </tr>';
													}		
													
										$html .= 	'</table>	
												</td>
										</tr>';
										
										
										
										
							$html .= '</table>';





										 
								$html .= '</body></html>';
		
		if(!empty($html))
		{	
		$this->load->library('dompdf_lib');		
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('letter', 'portrait');
		$this->dompdf->render();	
		$this->dompdf->stream("Daily Report for ".date('F Y',strtotime($id)).".pdf",array('Attachment'=>0));
		}
		else
		{			
			echo  <<<EOD
			<script> alert("Sorry, Too Much Data To Process, Please Select Less !"); window.history.back();</script>
EOD;
			exit;
		}
	
			
		
			
	
		
	}
	
	
	
	
	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */