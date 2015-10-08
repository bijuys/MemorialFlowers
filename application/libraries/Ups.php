<?php

class Ups {
	
	private $url = 'https://www.ups.com/ups.app/xml/Track';
	private $access = '1CAAEABF39D0910A';
	private $user = 'cesarioginjo';
	private $password = 'B1ggqt43';

function upsTrack($trackingNumber) {
$data ="<?xml version=\"1.0\"?>
        <AccessRequest xml:lang='en-US'>
                <AccessLicenseNumber>".$this->access."</AccessLicenseNumber>
                <UserId>".$this->user."</UserId>
                <Password>".$this->password."</Password>
        </AccessRequest>
        <?xml version=\"1.0\"?>
        <TrackRequest>
                <Request>
                        <TransactionReference>
                                <CustomerContext>
                                        <InternalKey>blah</InternalKey>
                                </CustomerContext>
                                <XpciVersion>1.0</XpciVersion>
                        </TransactionReference>
                        <RequestAction>Track</RequestAction>
                </Request>
        <TrackingNumber>$trackingNumber</TrackingNumber>
        </TrackRequest>";

         $form = array
         (
             'http' => array
             (
                 'method' => 'POST',
                 'header' => 'Content-type: application/x-www-form-urlencoded',
                 'content' => "$data"
             )
         );

          $request = stream_context_create($form);



$browser = fopen($this->url , 'rb' , false , $request);

$response = stream_get_contents($browser);
         fclose($browser);


// echo '<!-- '. $result. ' -->';
$data = strstr($response, '<?');
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
 if ($xml_elem['type'] == 'open') {
if (array_key_exists('attributes',$xml_elem)) {
         list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
} else {
         $level[$xml_elem['level']] = $xml_elem['tag'];
}
 }
 if ($xml_elem['type'] == 'complete') {
$start_level = 1;
$php_stmt = '$params';
while($start_level < $xml_elem['level']) {
         $php_stmt .= '[$level['.$start_level.']]';
         $start_level++;
}
$php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
eval($php_stmt);
 }
}

return $params;
}


function getStatus($trackingNumber)
{
	$result = $this->upsTrack($trackingNumber);
	
	return $result['TRACKRESPONSE']['SHIPMENT']['PACKAGE']['ACTIVITY']['STATUS']['STATUSTYPE']['DESCRIPTION'];
}

}
?>