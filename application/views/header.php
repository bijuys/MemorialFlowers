<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
		<!--
		<script src="//assets.adobedtm.com/8d740009008e38036f0c26fda2f972adc6416704/satelliteLib-810fe15b5cb184ba02827e004431953947fbcb88.js"></script>
		<script type="text/javascript">var _kmq = _kmq || []; var _kmk = _kmk || '0207277375ba6bb540a16c2fd23a056e54621e29'; function _kms(u){ setTimeout(function(){ var d = document, f = d.getElementsByTagName('script')[0], s = d.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = u; f.parentNode.insertBefore(s, f); }, 1); } _kms('//i.kissmetrics.com/i.js'); _kms('//scripts.kissmetrics.com/' + _kmk + '.2.js'); </script>
		-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="robots" content="noodp,noydir"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php if(isset($page) && !empty($page->page_title))
                                 {
                                    echo $page->page_title;
                                 }
                                 elseif(isset($title))
                                 {
                                echo $title;
                                 }
                                 else
                                 {
                                echo 'Memorial Flowers - Online flowers Canada';
                                 }
        ?></title>
        <meta name="description" content="<?php if(isset($description))
                             {
                                //echo $description;
								echo 'Order flowers, roses, and gift baskets online & send same day flower delivery for birthdays and anniversaries from trusted florist Dignity Flowers.';
							 }
								elseif(isset($page) && !empty($page->description))
							{
								//echo $page->description;
								echo 'Order flowers, roses, and gift baskets online & send same day flower delivery for birthdays and anniversaries from trusted florist Dignity Flowers.';
							}
                             else
                             {
                            echo 'Order flowers, roses, and gift baskets online & send same day flower delivery for birthdays and anniversaries from trusted florist Dignity Flowers.';
                             }
        ?>" />
        <meta name="keywords" content="<?php if(isset($keywords))
                         {
                            echo $keywords;
                         }
                         elseif(isset($page) && !empty($page->keywords))
                         {
                        echo $page->keywords;
                         }
                         else
                         {
                        echo 'Flowers, flower delivery, birthday flowers, mother’s day flowers, gift baskets, roses';
                         }
                    ?>" />
            <link rel="canonical" href="<?php if(isset($canonical))
                     {
                         echo $canonical;
                     }
                     elseif(isset($page) && !empty($page->canonical))
                     {
                    echo $page->canonical;
                     }
                     else
                     {
                    echo current_url();
                     }
                ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="<?php echo template_url('css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo template_url('css/bootstrap-theme.min.css');?>">
        
        <link rel="stylesheet" href="<?php echo template_url('css/datepicker.css');?>">
        <link rel="stylesheet" href="<?php echo template_url('css/main.css');?>">
        <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="<?php echo template_url('css/font-awesome.css');?>">
        <script src="<?php echo template_url('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js');?>"></script>
    </head>
    <body>
	
	<?php //echo $this->session->userdata('referer'); ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->