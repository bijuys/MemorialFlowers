<?php
/*
include "simple_html_dom.php";
$table = '<table class="table table-striped table-bordered">
                <tr>
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order ID</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Order Date</th>
                  <!--<th class="center" style="font-weight:bold; background-color:#A1A1A1; color:#2E2E2E;">Items</th>-->
                  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Merchandise Value</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Origin Type</th>
				  <th class="center" style="font-weight:bold; background-color:#C2C2C2; color:#2E2E2E;">Product Name</th>
                </tr>';
					$tot = 0;
					foreach($orders as $row){
						$tot += $row->purchase;
                  $table .= '<tr>
                    <th class="center" style="font-weight:normal;">
						'.$row->invoice_id.'
					</th>
					<th class="center" style="font-weight:normal;">
						Order
					</th>
                    <th class="center" style="font-weight:normal;">
						'.date('m-d-Y',strtotime($row->order_date)).'
					</th>
					<!--
                    <th class="center">
						'.$row->items.'
					</th>
					-->
                    <th class="center" style="font-weight:normal;">
						'.getRate($row->purchase).'
					</th>
					<th class="center" style="font-weight:normal;">
						Internet
					</th>
					<th style="font-weight:normal;text-align:left;" align="left">
						'.$row->product_name.'
					</th>
                  </tr>';
                  }
				  
                  $table .= '
                    <tr style="background-color:#4A708B;">
					  <th style="color:#E5E5E5; font-weight:bold; font-size:15px; text-align:right;"></th>
					  <th style="color:#E5E5E5; font-weight:bold; font-size:15px; text-align:right;"></th>		
                      <th style="color:#E5E5E5; font-weight:bold; font-size:15px; text-align:right;">Total</th>
                      <th class="center" style="color:#E5E5E5; font-weight:bold; font-size:15px;">'.getRate($tot).'</th>
                      <th colspan="2" class="center" style="color:#E5E5E5; font-weight:bold; font-size:18px;"></th>
                    </tr>
              </table>';
			  

$html = str_get_html($table);
 
 
 
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=OrdersReport.csv');

$fp = fopen("php://output", "w");

foreach($html->find('tr') as $element)
{
    $td = array();
    foreach( $element->find('th') as $row)  
    {
        $td [] = $row->plaintext;
    }
    fputcsv($fp, $td);

    $td = array();
    foreach( $element->find('td') as $row)  
    {
        $td [] = $row->plaintext;
    }
    fputcsv($fp, $td);
}


fclose($fp);
*/



/*
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

$list = array (
    array('Order ID','Order ID','Order ID','Order ID','Order ID','Order ID','Order ID'),
	$tot = 0;
	foreach($orders as $row){
		$tot += $row->purchase;
		array('12','12','12','12','12','12','12')
    }
);

$fp = fopen('php://output', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
*/







header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="OrdersReport.csv"');
$data = array('Order ID,,Order Type,,Acc Recog Date - MM/DD/YYYY,,Order Taken Merchandise Value,,Origin Type,,Product Name,,Source Location Business Unit Name,,Source Location Business Unit Number,,Source Location Division Name,,Source Location Division Number,,Source Location Market Number,,Source Location Name,,Source Location Number,,Source Location Territory Name,,Source Location Territory Number');

foreach($orders as $row){
	$data[] = ($row->invoice_id.',,Order,,'.date('m-d-Y',strtotime($row->order_date)).',,'.$row->purchase.',,Internet,,'.$row->product_name.',,0,,0,,0,,0,,0,,'.$row->location_type_name.',,'.$row->location_id.',,0,,0');
}

$fp = fopen('php://output', 'w');
foreach ( $data as $line ) {
    $val = explode(",,", $line);
    fputcsv($fp, $val);
}
fclose($fp);


?>