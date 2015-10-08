<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Plugnpay {


    private $is_curl_compiled_into_php = "yes"; 
    // Possible answers are: 
    //  'yes' -> means that curl is compiled into PHP [DEFAULT]
    //  'no'  -> means that curl is not-compiled into PHP & must be called externally

    // If you selected 'no' to the above question, then set the absolute path to curl
    private $curl_path = "/usr/bin/curl";
    // [e.g.: '/usr/bin/curl' on Unix/Linux or 'c:/curl/curl.exe' on Windows servers] 
    // If you are unsure of this, check with your hosting company.

    // Set URL that you will post the transaction to
    private $pnp_post_url = "https://pay1.plugnpay.com/payment/pnpremote.cgi";
    // This should never need to be changed...


    /*
      This is where you build the query string to be posted to plugnpay.  You
      can replace this code with your own or you need to follow the instructions
      in the README file for calling this script.
    */
    
function pay($data)
{
    $pnp_post_values = '';

    if ($pnp_post_values == "") {
        $pnp_post_values .= "publisher-name=flowerscana&"; //flowerscana 1800flower
        $pnp_post_values .= "card-number=" . $data->cardnumber . "&";
        $pnp_post_values .= "card-cvv=" . $data->cvv . "&";
        $pnp_post_values .= "card-exp=" . $data->expiry . "&";
        $pnp_post_values .= "card-amount=" . $data->total . "&";
        $pnp_post_values .= "card-name=" . $data->nameoncard . "&";
        $pnp_post_values .= "email=" . $data->email . "&";
        $pnp_post_values .= "ipaddress=" . $data->ipaddress . "&";
        // billing address info
        $pnp_post_values .= "card-address1=" . $data->address1 . "&";
        $pnp_post_values .= "card-address2=" . $data->address2 . "&";
        $pnp_post_values .= "card-zip=" . $data->postalcode . "&";
        $pnp_post_values .= "card-city=" . $data->city . "&";
        $pnp_post_values .= "card-state=" . $data->province . "&";
        $pnp_post_values .= "card-country=" . $data->country . "&";
        // shipping address info
        $pnp_post_values .= "shipname=" . $data->nameoncard . "&";
        $pnp_post_values .= "address1=" . $data->address1 . "&";
        $pnp_post_values .= "address2=" . $data->address2 . "&";
        $pnp_post_values .= "zip=" . $data->postalcode . "&";
        $pnp_post_values .= "state=" . $data->province . "&";
        $pnp_post_values .= "country=" . $data->country . "&";
    }


    /**************************************************************************
      UNLESS YOU KNOW WHAT YOU ARE DOING YOU SHOULD NOT CHANGE THE BELOW CODE
    **************************************************************************/

    if ($this->is_curl_compiled_into_php == "no") {
      // do external PHP curl connection 
      exec("$curl_path -d \"$pnp_post_values\" https://pay1.plugnpay.com/payment/pnpremote.cgi", $pnp_result_page);
      // NOTES:
      // -- The '-k' attribute can be added before the '-d' attribute to turn off curl's SSL certificate validation feature.
      // -- Only use the '-k' attribute if you know your curl path is correct & are getting back a blank response in $pnp_result_page.

      $pnp_result_decoded = urldecode($pnp_result_page[1]);

    }
    else {
      // do internal PHP curl connection
      // init curl handle
      $pnp_ch = curl_init($this->pnp_post_url);
      curl_setopt($pnp_ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($pnp_ch, CURLOPT_POSTFIELDS, $pnp_post_values);
      #curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // Upon problem, uncomment for additional Windows 2003 compatibility

      // perform ssl post
      $pnp_result_page = curl_exec($pnp_ch);

      $pnp_result_decoded = urldecode($pnp_result_page);

     }

    // decode the result page and put it into transaction_array
    $pnp_temp_array = explode('&',$pnp_result_decoded);
    foreach ($pnp_temp_array as $entry) {
        list($name,$value) = explode('=',$entry);
        $pnp_transaction_array[$name] = $value;
    }
    
    $pnp_handle_post_process =1;

    if ($pnp_handle_post_process != "no") {
      return ($pnp_transaction_array);
    }
    
}
    
}

?>
