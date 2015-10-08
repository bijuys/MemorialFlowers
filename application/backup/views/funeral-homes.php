<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>DevBridge Autocomplete Demo</title>
    <link href="content/styles.css" rel="stylesheet" />
 <style>
	.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
	.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
	.autocomplete-selected { background: #F0F0F0; }
	.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
	.autocomplete-group { padding: 2px 5px; }
	.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
 </style>
</head>
<body>

<p>Type country name in english:</p>
<div style="position: relative; height: 80px;">
    <input type="text" name="country" id="test" style="width: 500px; padding: 5px;"/>
    
</div>
<div id="selction-ajax"></div>
        
<script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.mockjax.js"></script>
<script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
 <script>
 $(function(){
 	'use strict';

 	$('#test').autocomplete({
	        	serviceUrl: '/products/fhomes/'+$(this).val(),
    		onSelect: function (suggestion) {
       			
   		}
	});

 })

 </script>
</body>
</html>
