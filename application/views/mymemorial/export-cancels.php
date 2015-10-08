<?php

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="Cancels-RefundsReport.csv"');
$data = array('Refund Order ID,,Transaction Type,,Cancel Count,,Acct Recog Date - MM/DD/YYYY,,Refund Merchandise Value,,Origin Type,,Product Name,,Source Location Business Unit Name,,Source Location Business Unit Number,,Source Location Division Name,,Source Location Division Number,,Source Location Market Number,,Source Location Name,,Source Location Number,,Source Location Territory Name,,Source Location Territory Number');

foreach($orders as $row){
	$data[] = ($row->invoice_id.',,Refund,,-1,,'.date('m-d-Y',strtotime($row->order_date)).',,'.$row->purchase.',,Internet,,'.$row->product_name.',,0,,0,,0,,0,,0,,'.$row->location_type_name.',,'.$row->location_id.',,0,,0');
}

$fp = fopen('php://output', 'w');
foreach ( $data as $line ) {
    $val = explode(",,", $line);
    fputcsv($fp, $val);
}
fclose($fp);
?>			  