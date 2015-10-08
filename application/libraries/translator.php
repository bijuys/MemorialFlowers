<?php


require_once(APPPATH.'libraries/translate.php');

class Translator {

	private $clientID = "8549f6eb-44ad-4fa3-a2b5-7fc0935fcebe";
	private $clientSecret = "lnzsGfzAExyJmLrYIGfKkEiDGZR/PUik/T1SjPS+BhM=";
	private $authUrl = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
	private $scopeUrl = "http://api.microsofttranslator.com";
	private $grantType = "client_credentials";


	function translate($text,$from='en',$to='fr') {

		/*
	    //Client ID of the application.
	    $clientID       = "8549f6eb-44ad-4fa3-a2b5-7fc0935fcebe";
	    //Client Secret key of the application.
	    $clientSecret = "lnzsGfzAExyJmLrYIGfKkEiDGZR/PUik/T1SjPS+BhM=";
	    //OAuth Url.
	    $authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
	    //Application Scope Url
	    $scopeUrl     = "http://api.microsofttranslator.com";
	    //Application grant type
	    $grantType    = "client_credentials";

		*/

	    //Create the AccessTokenAuthentication object.
	    $authObj      = new AccessTokenAuthentication();
	    //Get the Access token.

	    die($this->clientSecret);

	    $accessToken  = $authObj->getTokens($this->grantType, $this->scopeUrl, $this->clientID, $this->clientSecret, $this->authUrl);
	    //Create the authorization Header string.
	    $authHeader = "Authorization: Bearer ". $accessToken;

	   //Set the params.//
	    $fromLanguage = $from;
	    $toLanguage   = $to;
	    $inputStr     = $text;
	    $contentType  = 'text/html';
	    $category     = 'general';
	    
	    $params = "text=".urlencode($inputStr)."&to=".$toLanguage."&from=".$fromLanguage;
	    $translateUrl = "http://api.microsofttranslator.com/v2/Http.svc/Translate?$params";
	    
	    //Create the Translator Object.
	    $translatorObj = new HTTPTranslator();
	    
	    //Get the curlResponse.
	    $curlResponse = $translatorObj->curlRequest($translateUrl, $authHeader);

	    print_r($curlResponse);
	    
	    //Interprets a string of XML into an object.
	    $xmlObj = simplexml_load_string($curlResponse);
	    foreach((array)$xmlObj[0] as $val){
	        $translatedStr = $val;
	    }
	    
	    return $translatedStr;
	    
	}

}