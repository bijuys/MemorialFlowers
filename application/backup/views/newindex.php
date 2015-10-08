<?php

$js=<<<JS
<script src="/js/jquery.easing.1.3.js" type="text/javascript" ></script>
<script src="/js/slides.min.jquery.js" type="text/javascript" ></script>
<script type="text/javascript">

    function formatText(index, panel) {
              return index + "";
    }
    
    $(function(){
	$('#slides').slides({
		preload: true,
		preloadImage: 'img/loading.gif',
		pagination: true,
		generatePagination: true, 
		paginationClass: 'pagination', 
		play: 5000,
		pause: 2500,
		hoverPause: true
	});
    });
	
</script>

JS;
?>
<?php include_once('header.php');?>


<style>.mboxDefault { visibility:hidden; }</style>
<style type="text/css">#trsCenterContent {width:980px !important}/*Remove radiobutton and undernav text*/#undernav{display:none !important;}p {margin:10px 0px;}#likeit {display:none;}</style>

                             
<div align="center">
	


<!--###<table cellpadding="0" cellspacing="0" border="0" width ="760px" id="trsWideTable"> -->
<table id="trsWideTable" border="0" cellpadding="0" cellspacing="0"> 	
	
	<tbody><tr>
		<td colspan="3" id="trsWideContent" height="100%" align="center" valign="top">
			<!--### <div id ="trsCenterContent">-->
			<div id="trsCenterContent">
			
 <br>  
		     
		     
		   
	  
<table class="contentnoside" height="100%" border="0" cellpadding="0" cellspacing="0" width="760">
	<tbody>
	<tr height="100%">
		<td colspan="2" zone="1" align="center" valign="top">
			<link rel="stylesheet" type="text/css" href="<?php echo theme_url();?>/sympathy_files/flowers_sympathy-10052012.css">
			<style type="text/css">
			/*hide drapes*/body {	background: url('<?php echo theme_url();?>/images/sympathy_bkgrnd.jpg') no-repeat #ffffff top center !important;	_background-position-y: 1px;#background-position-y: 1px;}#trsWideTable {	margin-top:-10px !important;	_margin-top:-15px !important;	background:none;	z-index:0;}
            </style>
            <div id="symp-wrapper">
              <div class="symp-page"> <!-- LIVE CHAT -->    
                 
                 
                     <!-- HEADER -->    <div class="symp-header">  
                     
                     
                         <h1 title="Sympathy &amp; Funeral Flowers and Gifts">
                          <img src="<?php echo theme_url();?>/sympathy_files/title-sympathy.gif" alt="Sympathy &amp; Funeral Flowers and Gifts" border="0">
                          </h1>
                  </div>   
                   <!-- HERO -->    <div class="symp-hero">      
                   <div class="symp-herotxt"> <img src="<?php echo theme_url();?>/sympathy_files/herotxt-expressions-of-sympathy.png" alt="Our White Glove Sympathy Services help you offer comfort and support" border="0"> </div>
                   <div class="symp-herolinks"> <a href="#fortheservice" name="symphero_fortheservice"><img src="<?php echo theme_url();?>/sympathy_files/herolink-for-the-service.png" alt="For Funeral Services" border="0"></a><br>
                     <a href="#forthehome" name="symphero_forthehome"><img src="<?php echo theme_url();?>/sympathy_files/herolink-for-the-home.png" alt="For Home or Office" border="0"></a><br> 
                     <a href="#cremationservices" name="symphero_cremationservices"><img src="<?php echo theme_url();?>/sympathy_files/herolink-cremation-services.png" alt="For Cremation Services" border="0"></a><br>  
                  </div>
                  <div class="symp-search-box">
                          <form name="symFinder1" id="symFinder1"> 
                                   <select id="destination" name="menu">            
                                   <option selected="selected" value="">--Choose Destination--</option>            
                                   <option value="funeral">For the Funeral Service</option>            
                                   <option value="home">For the Home/Office</option>          
                                   </select>         
                              
                                    <select id="relation" name="menu1">            
                                    <option selected="selected" value="">--Choose Relation--</option>    
                                      <option value="Immediate Family Member">Immediate Family Member</option>
                                        <option value="Close Relative">Close Relative</option>
                                          <option value="Friend/Colleague">Friend/Colleague</option>
                                    
                                    </select>          
                                    <input class="button" onclick="checkForm();" type="button">        
                       </form>      
                 </div>      
                 <div class="symp-whiteglove"> <img src="<?php echo theme_url();?>/sympathy_files/herotxt-white-glove-promise.png" alt="White Glove Service Promise" border="0"> </div>
                 </div>    <!-- MID SECTION -->    
                 
                 <div class="symp-mid"> <!-- FOR THE FUNERAL SERVICE -->      
                      <div class="symp-fortheservice"> <a name="fortheservice"></a>        
                      		<h2><img src="<?php echo theme_url();?>/sympathy_files/title-for-the-service.gif" alt="Sympathy for Funeral Service" class="title"></h2>   
     
     
     
             <div class="fortheservice-viewall"> <a href="http://ww10.1800flowers.com/allfuneralarrangements?cm_sp=sympathy1-_-funeral-viewall-button-_-10216" name="sympathy_funeral_viewall">
             <img src="<?php echo theme_url();?>/sympathy_files/btn-viewall.gif" alt="Sympathy for Funeral Service - View All" border="0"></a>
              </div>
  
   		<div class="content-fortheservice">
    		<h3>Celebrate a beautiful life with truly original arrangements that add warmth to the service and help express your sympathy directly to the family.</h3>          
            
       <!-- COLOR COLLECTIONS -->          
       		<div class="color-collections">
             <!-- WHITE -->            
                <div id="c-white" style="display:block;"> 
                            		<a href="http://ww10.1800flowers.com/white-funeral-flowers?cm_sp=sympathy1-_-funeral-color-white-_-10524" name="sympathy_color_white"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-white.jpg" alt="White Sympathy Flowers" border="0"></a>              
                   <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-red');hideMe('c-white');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              	  <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-lavender');hideMe('c-white');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>              </div> 
                <!-- LAVENDER -->           
               <div id="c-lavender" style="display:none;"> <a href="http://ww10.1800flowers.com/lavender-sympathy?cm_sp=sympathy1-_-funeral-color-lavender-_-11506" name="sympathy_color_pink"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-lavender.jpg" alt="Lavender Sympathy Flowers" border="0"></a>              
               <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-white');hideMe('c-lavender');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-pink');hideMe('c-lavender');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>            
               <!-- PINK -->           
               <div id="c-pink" style="display:none;"> <a href="http://ww10.1800flowers.com/sympathy-color-pink?cm_sp=sympathy1-_-funeral-color-pink-_-10272" name="sympathy_color_pink"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-pink.jpg" alt="Pink Sympathy Flowers" border="0"></a>             
                <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-lavender');hideMe('c-pink');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-bright');hideMe('c-pink');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>            
                
            <!-- BRIGHT -->            
           <div id="c-bright" style="display:none;"> <a href="http://ww10.1800flowers.com/sympathy-multicolored?cm_sp=sympathy1-_-funeral-color-bright-_-10269" name="sympathy_color_bright"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-bright.jpg" alt="Bright Sympathy Flowers" border="0"></a>              
          
           <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-pink');hideMe('c-bright');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-pastel');hideMe('c-bright');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>           
            <!-- PASTEL -->            
            <div id="c-pastel" style="display:none;"> <a href="http://ww10.1800flowers.com/pastel-mixed-floral?cm_sp=sympathy1-_-funeral-color-pastel-_-11505" name="sympathy_color_pastel"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-pastel.jpg" alt="Pastel Sympathy Flowers" border="0"></a>             
           <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-bright');hideMe('c-pastel');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>           <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-yellow');hideMe('c-pastel');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>           </div>            
           <!-- YELLOW -->            
           <div id="c-yellow" style="display:none;"> <a href="http://ww10.1800flowers.com/sympathy-color-yellow?cm_sp=sympathy1-_-funeral-color-yellow-_-10273" name="sympathy_color_yellow"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-yellow.jpg" alt="Yellow Sympathy Flowers" border="0"></a>              
              <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-pastel');hideMe('c-yellow');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-peach');hideMe('c-yellow');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>            
             <!-- PEACH -->            
             <div id="c-peach" style="display:none;"> <a href="http://ww10.1800flowers.com/sympathy-color-peach?cm_sp=sympathy1-_-funeral-color-peach-_-11044" name="sympathy_color_peach"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-peach.jpg" alt="Peach Sympathy Flowers" border="0"></a>              
              <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-yellow');hideMe('c-peach');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-patriotic');hideMe('c-peach');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>            
            <!-- PATRIOTIC -->            
            <div id="c-patriotic" style="display:none;"> <a href="http://ww10.1800flowers.com/patriotic-color-sympathy?cm_sp=sympathy1-_-funeral-color-patriotic-_-11413" name="sympathy_color_patriotic"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-patriotic.jpg" alt="Patriotic Sympathy Flowers" border="0"></a>              
            <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-peach');hideMe('c-patriotic');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>            <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-blue');hideMe('c-patriotic');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>           
            <!-- BLUE -->            
            <div id="c-blue" style="display:none;"> <a href="http://ww10.1800flowers.com/blue-sympathy-11414?cm_sp=sympathy1-_-funeral-color-blue-_-11414" name="sympathy_color_blue"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-blue.jpg" alt="Blue Sympathy Flowers" border="0"></a>              
            <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-patriotic');hideMe('c-blue');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>            <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-red');hideMe('c-blue');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>             </div>            
            
            <!-- BLUE -->            
            <div id="c-blue" style="display:none;"> <a href="http://ww10.1800flowers.com/blue-sympathy-11414?cm_sp=sympathy1-_-funeral-color-blue-_-11414" name="sympathy_color_blue"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-blue.jpg" alt="Blue Sympathy Flowers" border="0"></a>              
            <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-patriotic');hideMe('c-blue');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>            <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-red');hideMe('c-blue');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>            </div>            
            <!-- RED -->            
            <div id="c-red" style="display:none;"> <a href="http://ww10.1800flowers.com/sympathy-color-red?cm_sp=sympathy1-_-funeral-color-red-_-10271" name="sympathy_color_red"><img src="<?php echo theme_url();?>/sympathy_files/color-thumb-red.jpg" alt="Red Sympathy Flowers" border="0"></a>             
              <div class="btn-prev"><a href="#" name="sympathy_color_prev" onclick="toggle('c-blue');hideMe('c-red');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-prev.png" alt="Previous" border="0"></a></div>              <div class="btn-next"><a href="#" name="sympathy_color_next" onclick="toggle('c-white');hideMe('c-red');return false;"><img src="<?php echo theme_url();?>/sympathy_files/btn-color-next.png" alt="Next" border="0"></a></div>             </div>            
              
            <div style="position:absolute;top:294px;width:390px;left:90px;background:#FFF;font:11px Arial, Helvetica, sans-serif;text-align:center;">View More Color Selections!</div>         
         
     </div>          <!-- END COLOR COLLECTIONS -->
      <!-- FOR THE FUNERAL SERVICE -->          
      <div class="fortheservice-sentiment">            
      <p>Before you begin, ensure you have the Funeral Home name and address. Use our <a href="javascript:wmpopup('/zipcodefind.do',500,500,'YES',50,50);" name="sympathy_zipcodefinder">Zip Code Finder</a>
     for help. Note: if placing an order after 5pm in the recipient's time zone for an early morning delivery (9am - 12 pm), we encourage you to call us at 1-866-538-2259 to place your order.</p>            
      <p><img src="<?php echo theme_url();?>/sympathy_files/title-find-the-right-sentiment.gif" alt="Find the right sentiment" border="0"><br>              
      <input name="funeral-all" onclick="showMe('funeral-2');hideMe('funeral-1','funeral-3');" type="radio" checked="checked">              Close Relative<br>  
      <input name="funeral-all" onclick="showMe('funeral-1');hideMe('funeral-2','funeral-3');"  type="radio">              Immediate Family Member<br>              
      <input name="funeral-all" onclick="showMe('funeral-3');hideMe('funeral-1','funeral-2');" type="radio">              Friend/Colleague<br>            </p>
      <div class="sentiment-funeral">
       <!-- IMMEDIATE FAMILY MEMBER -->              
       <div id="funeral-1">                
            <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralfloorbaskets-12172?cm_sp=sympathy1-_-funeral-browselink-ifm-_-12172" name="sympathy_funeral_ifm_floorbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91212Lc.jpg" alt="Funeral Floor Baskets" border="0"><br>                  Funeral Floor Baskets</a> </div>               
             <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingbaskets-12176?cm_sp=sympathy1-_-funeral-browselink-ifm-_-12176" name="sympathy_funeral_ifm_standingbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91266Lc.jpg" alt="Funeral Standing Baskets" border="0"><br>                  Funeral Standing Baskets</a> </div>               
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralsprays?cm_sp=sympathy1-_-funeral-browselink-ifm-_-10218" name="sympathy_funeral_ifm_standingsprays"><img src="<?php echo theme_url();?>/sympathy_files/91408Lc.jpg" alt="Funeral Standing Spray" border="0"><br>                  Funeral Standing Sprays</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralflowers?cm_sp=sympathy1-_-funeral-browselink-ifm-_-10214" name="sympathy_funeral_ifm_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/91391c.jpg" alt="Funeral Vase Arrangements" border="0"><br>                  Funeral Vase Arrangements</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralplants?cm_sp=sympathy1-_-funeral-browselink-ifm-_-10217" name="sympathy_funeral_ifm_plants"><img src="<?php echo theme_url();?>/sympathy_files/4215c.jpg" alt="Funeral Plants" border="0"><br>                  Funeral Plants</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingcross-12178?cm_sp=sympathy1-_-funeral-browselink-ifm-_-12178" name="sympathy_funeral_ifm_standingcrosses"><img src="<?php echo theme_url();?>/sympathy_files/91199c.jpg" alt="Funeral Standing Crosses" border="0"><br>                  Funeral Standing Crosses</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandinghearts-12170?cm_sp=sympathy1-_-funeral-browselink-ifm-_-12170" name="sympathy_funeral_ifm_standinghearts"><img src="<?php echo theme_url();?>/sympathy_files/91405c.jpg" alt="Funeral Standing Hearts" border="0"><br>                  Funeral Standing Hearts</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingwreaths-12174?cm_sp=sympathy1-_-funeral-browselink-ifm-_-12174" name="sympathy_funeral_ifm_standingwreaths"><img src="<?php echo theme_url();?>/sympathy_files/91304Lc.jpg" alt="Funeral Standing Wreaths" border="0"><br>                  Funeral Standing Wreaths</a> </div>                
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeral-casket-sprays?cm_sp=sympathy1-_-funeral-browselink-ifm-_-10215" name="sympathy_funeral_ifm_casketflowers"><img src="<?php echo theme_url();?>/sympathy_files/91233c.jpg" alt="Funeral Casket Flowers" border="0"><br>                  Funeral Casket Flowers</a> </div>                
              
              <div class="collection-box"> <a href="http://ww10.1800flowers.com/patriotic-color-sympathy?cm_sp=sympathy1-_-funeral-browselink-ifm-_-11413" name="sympathy_funeral_ifm_patriotic"><img src="<?php echo theme_url();?>/sympathy_files/thumb-sym-patriotic.gif" alt="Patriotic Sympathy Flowers" border="0"><br>                  Patriotic Sympathy Flowers</a> </div>              
              </div>             
               <!-- CLOSE RELATIVE -->             
               <div id="funeral-2">                
               <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralfloorbaskets-12172?cm_sp=sympathy1-_-funeral-browselink-cr-_-12172" name="sympathy_funeral_cr_floorbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91208Lc.jpg" alt="Funeral Floor Baskets" border="0"><br>                  Funeral Floor Baskets</a> </div>               
               
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingbaskets-12176?cm_sp=sympathy1-_-funeral-browselink-cr-_-12176" name="sympathy_funeral_cr_standingbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91269Lc.jpg" alt="Funeral Standing Baskets" border="0"><br>                  Funeral Standing Baskets</a> </div>                
                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralsprays?cm_sp=sympathy1-_-funeral-browselink-cr-_-10218" name="sympathy_funeral_cr_standingsprays"><img src="<?php echo theme_url();?>/sympathy_files/91293Lc.jpg" alt="Funeral Standing Spray" border="0"><br>                  Funeral Standing Sprays</a> </div>                <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralflowers?cm_sp=sympathy1-_-funeral-browselink-cr-_-10214" name="sympathy_funeral_cr_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/91298c.jpg" alt="Funeral Vase Arrangements" border="0"><br>                  Funeral Vase Arrangements</a> </div>                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralplants?cm_sp=sympathy1-_-funeral-browselink-cr-_-10217" name="sympathy_funeral_cr_plants"><img src="<?php echo theme_url();?>/sympathy_files/4214lc.jpg" alt="Funeral Plants" border="0"><br>                  Funeral Plants</a> </div>                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingcross-12178?cm_sp=sympathy1-_-funeral-browselink-cr-_-12178" name="sympathy_funeral_cr_standingcrosses"><img src="<?php echo theme_url();?>/sympathy_files/91198c.jpg" alt="Funeral Standing Crosses" border="0"><br>                  Funeral Standing Crosses</a> </div>                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandinghearts-12170?cm_sp=sympathy1-_-funeral-browselink-cr-_-12170" name="sympathy_funeral_cr_standinghearts"><img src="<?php echo theme_url();?>/sympathy_files/91237c.jpg" alt="Funeral Standing Hearts" border="0"><br>                  Funeral Standing Hearts</a> </div>                
                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingwreaths-12174?cm_sp=sympathy1-_-funeral-browselink-cr-_-12174" name="sympathy_funeral_cr_standingwreaths"><img src="<?php echo theme_url();?>/sympathy_files/91392Lc.jpg" alt="Funeral Standing Wreaths" border="0"><br>                  Funeral Standing Wreaths</a> </div>                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/patriotic-color-sympathy?cm_sp=sympathy1-_-funeral-browselink-cr-_-11413" name="sympathy_funeral_cr_patriotic"><img src="<?php echo theme_url();?>/sympathy_files/thumb-sym-patriotic.gif" alt="Patriotic Sympathy Flowers" border="0"><br>                  Patriotic Sympathy Flowers</a> </div>                
                
                <div class="collection-box"> <a href="http://ww10.1800flowers.com/allfuneralarrangements?cm_sp=sympathy1-_-funeral-browselink-cr-_-10216" name="sympathy_funeral_cr_viewall"><img src="<?php echo theme_url();?>/sympathy_files/91212Lc_002.jpg" alt="Close Relative - View All" border="0"><br>                  VIEW ALL</a> </div>              
                
         </div>              
         <!-- FRIEND/COLLEAGUE -->              
         <div id="funeral-3">                
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralfloorbaskets-12172?cm_sp=sympathy1-_-funeral-browselink-fc-_-12172" name="sympathy_funeral_fc_floorbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91207Lc.jpg" alt="Funeral Floor Baskets" border="0"><br>                  Funeral Floor Baskets</a> </div>                
         
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/funeralstandingbaskets-12176?cm_sp=sympathy1-_-funeral-browselink-fc-_-12176" name="sympathy_funeral_fc_standingbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91272Lc.jpg" alt="Funeral Standing Baskets" border="0"><br>                  Funeral Standing Baskets</a> </div>                
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralsprays?cm_sp=sympathy1-_-funeral-browselink-fc-_-10218" name="sympathy_funeral_fc_standingsprasy"><img src="<?php echo theme_url();?>/sympathy_files/91287Lc.jpg" alt="Funeral Standing Spray" border="0"><br>                  Funeral Standing Sprays</a> </div>                
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/patriotic-color-sympathy?cm_sp=sympathy1-_-funeral-browselink-fc-_-11413" name="sympathy_funeral_fc_patriotic"><img src="<?php echo theme_url();?>/sympathy_files/thumb-sym-patriotic.gif" alt="Patriotic Sympathy Flowers" border="0"><br>                  Patriotic Sympathy Flowers</a> </div>                
         
         <br clear="all">
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralflowers?cm_sp=sympathy1-_-funeral-browselink-fc-_-10214" name="sympathy_funeral_fc_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/91302c.jpg" alt="Funeral Vase Arrangements" border="0"><br>                  Funeral Vase Arrangements</a> </div>                
         <div class="collection-box"> <a href="http://ww10.1800flowers.com/funeralplants?cm_sp=sympathy1-_-funeral-browselink-fc-_-10217" name="sympathy_funeral_fc_plants"><img src="<?php echo theme_url();?>/sympathy_files/4213lc.jpg" alt="Funeral Plants" border="0"><br>                  Funeral Plants</a> </div>               
          <div class="collection-box"> <a href="http://ww10.1800flowers.com/allfuneralarrangements?cm_sp=sympathy1-_-funeral-browselink-fc-_-10216" name="sympathy_funeral_fc_viewall"><img src="<?php echo theme_url();?>/sympathy_files/91382Lc.jpg" alt="Close Relative - View All" border="0"><br>                  VIEW ALL</a> </div>             
           </div>              
           <br clear="all">    </div>           
            <br clear="all">            <p></p>            
            <div class="fortheservice-left"> <img src="<?php echo theme_url();?>/sympathy_files/title-were-here-to-help.gif" alt="We're here to help" border="0"><br>              <a href="http://ww10.1800flowers.com/Sympathy-Commonly-Asked-Questions?cm_sp=sympathy1-_-funeral-help-link-_-faq" name="sympathy_funeralfaq">Commonly Asked Funeral Flower Questions</a><br>              <a href="http://ww10.1800flowers.com/Sympathy-Whats-Appropriate?cm_sp=sympathy1-_-funeral-help-link-_-appropriate" name="sympathy_funeralflowers">Funeral Flowers: What is Appropriate?</a><br>              <a href="http://ww10.1800flowers.com/Sympathy-Sympathy-Etiquette?cm_sp=sympathy1-_-funeral-help-link-_-etiquette" name="sympathy_funeraletiquette">Funeral Etiquette</a><br>              <a href="http://ww10.1800flowers.com/international-flower-delivery?cm_sp=sympathy1-_-funeral-help-link-_-international" name="sympathy_international">International Flower Delivery Options</a><br>            </div>            <div class="fortheservice-right"> <img src="<?php echo theme_url();?>/sympathy_files/title-alternate-sympathy-options.gif" alt="Alternate Sympathy Options" border="0"><br>              <a href="http://ww10.1800flowers.com/sympathy/sameday/11826?cm_sp=sympathy1-_-funeral-options-link-_-11826" name="sympathy_funeralsamedaydelivery">Same-Day Delivery</a><br>              <a href="http://ww10.1800flowers.com/breast-cancer-awareness?cm_sp=sympathy1-_-funeral-options-link-_-11516" name="sympathy_funeralpinkribbon">Pink Ribbon Collection for Breast Cancer Awareness</a> </div>            <br clear="all">          </div>        
            </div>     
         </div>      <!-- END FOR THE FUNERAL SERVICE --> <!-- FOR THE HOME/OFFICE -->      
     <div class="symp-forthehome"> <a name="forthehome"></a>        <h2><img src="<?php echo theme_url();?>/sympathy_files/title-for-the-home.gif" alt="Sympathy for Home or Office" class="title"></h2>        <div class="forthehome-viewall"> <a href="http://ww10.1800flowers.com/allsympathyflowersgifts?cm_sp=sympathy1-_-home-viewall-button-_-10223" name="sympathy_home_viewall"><img src="<?php echo theme_url();?>/sympathy_files/btn-viewall.gif" alt="Sympathy for Home of Office - View All" border="0"></a> </div> 

 <div class="content-forthehome">          <h3>Offering your support after the service is as important as during the service. Our wide selection of sympathy flowers and gifts provide lasting comfort and support.</h3>         <a href="http://ww10.1800flowers.com/allsympathyflowersgifts?cm_sp=sympathy1-_-home-viewall-image-_-10223"><img src="<?php echo theme_url();?>/sympathy_files/img-for-the-home.jpg" alt="For the Home or Office" hspace="23" border="0"></a>
 <br>
  <div class="forthehome-sentiment">
   <img src="<?php echo theme_url();?>/sympathy_files/title-find-the-right-sentiment.gif" alt="Find the right sentiment" border="0"><br>
               <input name="home-all" onclick="showMe('home-1');hideMe('home-2','home-3');" type="radio" checked="checked" >            Immediate Family Member<br>            
			   <input name="home-all" onclick="showMe('home-2');hideMe('home-1','home-3');" type="radio">            Close Relative<br> 
               <input name="home-all" onclick="showMe('home-3');hideMe('home-1','home-2');" type="radio">            Friend/Colleague<br> 
        
        
                <div class="sentiment-home"> <!-- IMMEDIATE FAMILY MEMBER --> 
                      <div id="home-1">
                          <div class="collection-box">
                         <a href="http://ww10.1800flowers.com/sympathyflowers?cm_sp=sympathy1-_-home-browselink-ifm-_-10222" name="sympathy_home_ifm_sympathyflowers"><img src="<?php echo theme_url();?>/sympathy_files/95410Lc.jpg" alt="Sympathy Flowers" border="0"><br> Sympathy Flowers</a>
                          </div>
                          <div class="collection-box">
                          <a href="http://ww10.1800flowers.com/sympathy/flowerbaskets-11875?cm_sp=sympathy1-_-home-browselink-ifm-_-11875" name="sympathy_home_ifm_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/95419Lc.jpg" alt="Sympathy Basket Arrangements" border="0"><br> Sympathy Basket Arrangements</a> 
                          </div>                
                         
                          <div class="collection-box"> 
                          <a href="http://ww10.1800flowers.com/sympathyplants?cm_sp=sympathy1-_-home-browselink-ifm-_-10224" name="sympathy_home_ifm_plants"><img src="<?php echo theme_url();?>/sympathy_files/3999Lc.jpg" alt="Sympathy Plants" border="0"><br>                  Sympathy Plants</a> 
                          </div>
                           <div class="collection-box">
                            <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-home-browselink-ifm-_-10221" name="sympathy_home_ifm_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/96275c.jpg" alt="Sympathy Gift Baskets" border="0"><br>                  Sympathy Gift Baskets</a>
                             </div> 
                              <div class="collection-box">
                               <a href="http://ww10.1800flowers.com/sympathyremembrance?cm_sp=sympathy1-_-home-browselink-ifm-_-10220" name="sympathy_home_ifm_giftsandremembrance"><img src="<?php echo theme_url();?>/sympathy_files/97343z.jpg" alt="Sympathy Gifts &amp; Remembrance" border="0"><br>                  Sympathy Gifts &amp; Remembrance</a>
                                </div>
                               <div class="collection-box">
                               <a href="http://ww10.1800flowers.com/sympathy/trees-12499?cm_sp=sympathy1-_-home-browselink-ifm-_-12499" name="sympathy_home_ifm_sympathytrees"><img src="<?php echo theme_url();?>/sympathy_files/18885Lc.jpg" alt="Memorial Trees" border="0"><br>                  Memorial Trees</a> 
                               </div>
                               
                           </div>                
                           
                           
 <!-- CLOSE RELATIVE -->       <div id="home-2">
                              
                                <div class="collection-box">
                                 <a href="http://ww10.1800flowers.com/sympathyflowers?cm_sp=sympathy1-_-home-browselink-cr-_-10222" name="sympathy_home_cr_sympathyflowers"><img src="<?php echo theme_url();?>/sympathy_files/95409Lc.jpg" alt="Sympathy Flowers" border="0"><br>                  Sympathy Flowers</a>
                                  </div>
                                <div class="collection-box"> 
                                <a href="http://ww10.1800flowers.com/sympathy/flowerbaskets-11875?cm_sp=sympathy1-_-home-browselink-cr-_-11875" name="sympathy_home_cr_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/95425Lc.jpg" alt="Sympathy Basket Arrangements" border="0"><br>                  Sympathy Basket Arrangements</a>
                                 </div>
                                   <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathyplants?cm_sp=sympathy1-_-home-browselink-cr-_-10224" name="sympathy_home_cr_plants"><img src="<?php echo theme_url();?>/sympathy_files/18538mc.jpg" alt="Sympathy Plants" border="0"><br>                  Sympathy Plants</a>
                                   </div>
                                   <div class="collection-box">
                                    <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-home-browselink-cr-_-10221" name="sympathy_home_cr_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91497XLc_002.jpg" alt="Sympathy Gift Baskets" border="0"><br>                  Sympathy Gift Baskets</a>
                                     </div>                <!--div class="collection-box">                            	<a href="/sympathy-cremation-urn-arrangements?cm_sp=sympathy1-_-home-browselink-cr-_-10175" name="sympathy_home_cr_cremation-wreaths"><img src="http://media2.1800flowers.com/800f_assets/images/flowers/images/shop/catalog/95435c.jpg" border="0" alt="Cremation Wreaths" /><br />                                Cremation Wreaths</a>                            </div--> 
                                       <div class="collection-box">
                                        <a href="http://ww10.1800flowers.com/sympathyremembrance?cm_sp=sympathy1-_-home-browselink-cr-_-10220" name="sympathy_home_cr_giftsandremembrance"><img src="<?php echo theme_url();?>/sympathy_files/97343z.jpg" alt="Sympathy Gifts &amp; Remembrance" border="0"><br>                  Sympathy Gifts &amp; Remembrance</a>
                                         </div>
                                         <div class="collection-box"> <a href="http://ww10.1800flowers.com/sympathy/trees-12499?cm_sp=sympathy1-_-home-browselink-cr-_-12499" name="sympathy_home_cr_sympathytrees"><img src="<?php echo theme_url();?>/sympathy_files/18885Lc.jpg" alt="Memorial Trees" border="0"><br>                  Memorial Trees</a> 
                                         </div>
                                        
                                        </div>
        <!-- FRIEND/COLLEAGUE -->       <div id="home-3">
        
        				                <div class="collection-box">
                                         <a href="http://ww10.1800flowers.com/sympathyflowers?cm_sp=sympathy1-_-home-browselink-fc-_-10222" name="sympathy_home_fc_sympathyflowers"><img src="<?php echo theme_url();?>/sympathy_files/95378Lc.jpg" alt="Sympathy Flowers" border="0"><br>                  Sympathy Flowers</a>
                                        </div>
                                        <div class="collection-box">
                                         <a href="http://ww10.1800flowers.com/sympathy/flowerbaskets-11875?cm_sp=sympathy1-_-home-browselink-fc-_-11875" name="sympathy_home_fc_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/95413Lc.jpg" alt="Sympathy Basket Arrangements" border="0"><br>                  Sympathy Basket Arrangements</a>
                                         </div>
                                         <div class="collection-box">
                                          <a href="http://ww10.1800flowers.com/sympathyplants?cm_sp=sympathy1-_-home-browselink-fc-_-10224" name="sympathy_home_fc_plants"><img src="<?php echo theme_url();?>/sympathy_files/4214lc.jpg" alt="Sympathy Plants" border="0"><br>                  Sympathy Plants</a>
                                         </div>
                                         <div class="collection-box"> 
                                         <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-home-browselink-fc-_-10221" name="sympathy_home_fc_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/93867c.jpg" alt="Sympathy Gift Baskets" border="0"><br>                  Sympathy Gift Baskets</a>
                                          </div> 
                                          
                                          <div class="collection-box">
                                           <a href="http://ww10.1800flowers.com/sympathyremembrance?cm_sp=sympathy1-_-home-browselink-fc-_-10220" name="sympathy_home_fc_giftsandremembrance"><img src="<?php echo theme_url();?>/sympathy_files/18213c.jpg" alt="Sympathy Gifts &amp; Remembrance" border="0"><br>                  Sympathy Gifts &amp; Remembrance</a>
                                           </div> 
                                           <div class="collection-box">
                                           <a href="http://ww10.1800flowers.com/sympathy/trees-12499?cm_sp=sympathy1-_-home-browselink-fc-_-12499" name="sympathy_home_fc_sympathytrees"><img src="<?php echo theme_url();?>/sympathy_files/18885Lc.jpg" alt="Memorial Trees" border="0"><br>                  Memorial Trees</a>
                                           </div>
                                           
                                           </div>              <br clear="all">            </div>
                             
                             
                             
                             
                             
                   <p>Many funeral homes cannot accept food deliveries. Fruit Baskets and Gourmet Baskets should always be sent to the family's home or office.</p>
                   <p><img src="<?php echo theme_url();?>/sympathy_files/title-were-here-to-help.gif" alt="We're here to help" border="0"><br> 
                    <a href="http://ww10.1800flowers.com/Sympathy-Grief-in-the-Workplace?cm_sp=sympathy1-_-home-help-link-_-griefwork" name="sympathy_griefintheworkplace">Grief in the Workplace</a><br> 
                    <a href="http://ww10.1800flowers.com/Sympathy-Article-Grief-and-the-Holidays?cm_sp=sympathy1-_-home-help-link-_-griefholiday" name="sympathy_griefandtheholidays">Grief and the Holidays</a><br>                    <a href="http://ww10.1800flowers.com/Sympathy-Comforting-the-Grieving?cm_sp=sympathy1-_-home-help-link-_-griefcomfort" name="sympathy_comfortthegrieving">How to Comfort The Grieving</a><br>                    <a href="http://ww10.1800flowers.com/Sympathy-Shiva-Call?cm_sp=sympathy1-_-home-help-link-_-shiva" name="sympathy_shiva">Paying a Shiva</a><br>              
                    <a href="http://ww10.1800flowers.com/Sympathy-Creating-A-Memory-Garden?cm_sp=sympathy1-_-home-help-link-_-memorygarden" name="sympathy_memorygarden">Creating a Memory Garden</a><br>
                  </p> 
                 
                 <p><img src="<?php echo theme_url();?>/sympathy_files/title-alternate-sympathy-options.gif" alt="Alternate Sympathy Options" border="0"><br>              
                 <a href="http://ww10.1800flowers.com/sympathy/sameday/11826?cm_sp=sympathy1-_-home-options-link-_-11826" name="sympathy_homesamedaydelivery">Same-Day Delivery</a><br>              
                 <a href="http://ww10.1800flowers.com/breast-cancer-awareness?cm_sp=sympathy1-_-home-options-link-_-11516" name="sympathy_homepinkribbon">Pink Ribbon Collection for Breast Cancer Awareness</a> 
                 </p>
                 
                 </div>
                           <br clear="all">        </div>      </div>      <!-- END FOR THE HOME/OFFICE --> <br clear="all">    </div>    <!-- END MIDSECTION --> 
                           
                  <!-- CREMATION SERVICES -->    
                   <div class="symp-cremationservices"> <a name="cremationservices"></a>      <h2>
						<img src="<?php echo theme_url();?>/sympathy_files/title-cremation-services.gif" alt="Sympathy for Funeral Service" class="title"></h2>
                       <div class="cremationservices-viewall"> <a href="http://ww10.1800flowers.com/sympathy/cremation-11835?cm_sp=sympathy1-_-cremation-viewall-button-_-11835" name="sympathy_cremation_viewall">
						<img src="<?php echo theme_url();?>/sympathy_files/btn-viewall.gif" alt="Sympathy for Cremation Services - View All" border="0"></a> 
                        </div>
                     
                      <div class="content-cremationservices">   
                           <div class="cremation-left">          <h3>Show that your thoughts and prayers are with them by sending a special gift to the funeral home, public cremation service or to the grieving family's home.</h3>
                           	  <a href="http://ww10.1800flowers.com/sympathy/cremation-11835?cm_sp=sympathy1-_-cremation-image-link-_-11835" name="img_cremationservices">
                              <img src="<?php echo theme_url();?>/sympathy_files/img-cremation-services.jpg" class="symp-image" alt="Cremation Services" border="0"></a>
                          </div>
                        
                          <div class="cremation-center"> <img src="<?php echo theme_url();?>/sympathy_files/title-find-the-right-sentiment.gif" alt="Find the right sentiment" border="0">
                          
                          <br><input name="cremation-all" onclick="showMe('cremation-1');hideMe('cremation-2','cremation-3');" checked="checked" type="radio">          Immediate Family Member
                          <br><input name="cremation-all" onclick="showMe('cremation-2');hideMe('cremation-1','cremation-3');" type="radio">          Close Relative
                          <br><input name="cremation-all" onclick="showMe('cremation-3');hideMe('cremation-1','cremation-2');" type="radio">          Friend/Colleague
  <br><div class="sentiment-cremation"> <!-- IMMEDIATE FAMILY MEMBER -->
              <div id="cremation-1" style="position:relative;width:630px;"> 
                           <div class="collection-box" style="margin-right:5px;">
                           	 <a href="http://ww10.1800flowers.com/sympathy-cremation-urn-arrangements?cm_sp=sympathy1-_-cremation-browselink-ifm-_-10175" name="sympathy_cremation_ifm_cremation-wreaths">
                             <img src="<?php echo theme_url();?>/sympathy_files/95411Lc.jpg" alt="Cremation Wreaths" border="0"><br> Cremation Wreaths</a>
                            </div> 
                           <div class="collection-box" style="margin-right:5px;">
                           <a href="http://ww10.1800flowers.com/sympathy/cremationvasearrangements-12182?cm_sp=sympathy1-_-cremation-browselink-ifm-_-12182" name="sympathy_cremation_ifm_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/95444Lc.jpg" alt="Cremation Vase Arrangements" border="0"><br>                Cremation Vase Arrangement</a>
                          </div> 
                         <div class="collection-box" style="margin-right:5px;"> <a href="http://ww10.1800flowers.com/sympathy/cremationstandingsprays-12190?cm_sp=sympathy1-_-cremation-browselink-ifm-_-12190" name="sympathy_cremation_ifm_standingsprays"><img src="<?php echo theme_url();?>/sympathy_files/91390Lc.jpg" alt="Cremation Standing Sprays" border="0"><br>                Cremation Standing Sprays</a>
                          </div>
                          
                          <div class="collection-box" style="margin-right:5px;"> <a href="http://ww10.1800flowers.com/sympathy/cremationbaskets-12188?cm_sp=sympathy1-_-cremation-browselink-ifm-_-12188" name="sympathy_cremation_ifm_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/91204c.jpg" alt="Cremation Basket Arrangements" border="0"><br>                Cremation Basket Arrangements</a>
                           </div>    
                          <div class="collection-box" style="margin-right:5px;"> <a href="http://ww10.1800flowers.com/sympathy/cremationplants-12189?cm_sp=sympathy1-_-cremation-browselink-ifm-_-12189" name="sympathy_cremation_ifm_plants"><img src="<?php echo theme_url();?>/sympathy_files/4213lc_002.jpg" alt="Cremation Plants" border="0"><br>                Cremation Plants</a>
                           </div>
                          
                           <div class="collection-box" style="margin-right:5px;"> <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-cremation-browselink-ifm-_-10221" name="sympathy_cremation_ifm_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91499XLc.jpg" alt="Sympathy Gift Baskets" border="0"><br>                Sympathy Gift Baskets</a>
                            </div>
                            
                    </div>            <!-- CLOSE RELATIVE --> 
                    
                    
                       <div id="cremation-2" style="position:relative;width:630px;">  
                                   <div class="collection-box" style="margin-right:5px;">
                                    <a href="http://ww10.1800flowers.com/sympathy-cremation-urn-arrangements?cm_sp=sympathy1-_-cremation-browselink-cr-_-10175" name="sympathy_cremation_cr_cremation-wreaths"><img src="<?php echo theme_url();?>/sympathy_files/95445Lc.jpg" alt="Cremation Wreaths" border="0"><br>                Cremation Wreaths</a>
                                     </div>
                                    
                                     <div class="collection-box" style="margin-right:5px;">
                                      <a href="http://ww10.1800flowers.com/sympathy/cremationvasearrangements-12182?cm_sp=sympathy1-_-cremation-browselink-cr-_-12182" name="sympathy_cremation_cr_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/95404c.jpg" alt="Cremation Vase Arrangements" border="0"><br>                Cremation Vase Arrangement</a>
                                       </div>
                                      
                                      <div class="collection-box" style="margin-right:5px;">
                                       <a href="http://ww10.1800flowers.com/sympathy/cremationstandingsprays-12190?cm_sp=sympathy1-_-cremation-browselink-cr-_-12190" name="sympathy_cremation_cr_standingsprays"><img src="<?php echo theme_url();?>/sympathy_files/91288Lc.jpg" alt="Cremation Standing Sprays" border="0"><br>                Cremation Standing Sprays</a>
                                       </div>
                                       
                                         <div class="collection-box" style="margin-right:5px;"> 
                                         <a href="http://ww10.1800flowers.com/sympathy/cremationbaskets-12188?cm_sp=sympathy1-_-cremation-browselink-cr-_-12188" name="sympathy_cremation_cr_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/91235c.jpg" alt="Cremation Basket Arrangements" border="0"><br>                Cremation Basket Arrangements</a> 
                                         </div>
                                         
                                          <div class="collection-box" style="margin-right:5px;"> 
                                          <a href="http://ww10.1800flowers.com/sympathy/cremationplants-12189?cm_sp=sympathy1-_-cremation-browselink-cr-_-12189" name="sympathy_cremation_cr_plants"><img src="<?php echo theme_url();?>/sympathy_files/3999Lc.jpg" alt="Cremation Plants" border="0"><br>                Cremation Plants</a>
                                           </div>
                                            <div class="collection-box" style="margin-right:5px;"> 
                                            <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-cremation-browselink-cr-_-10221" name="sympathy_cremation_cr_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91497XLc.jpg" alt="Sympathy Gift Baskets" border="0"><br>                Sympathy Gift Baskets</a> 
                                            </div>
                      </div>            <!-- FRIEND/COLLEAGUE --> 
                      
                      
                    <div id="cremation-3" style="position:relative;width:630px;">
                                  <div class="collection-box" style="margin-right:5px;"> 
                                  <a href="http://ww10.1800flowers.com/sympathy/cremationvasearrangements-12182?cm_sp=sympathy1-_-cremation-browselink-fc-_-12182" name="sympathy_cremation_fc_vasearrangements"><img src="<?php echo theme_url();?>/sympathy_files/95414Lc.jpg" alt="Cremation Vase Arrangements" border="0"><br>                Cremation Vase Arrangement</a> 
                                  </div>              
                                  
                                  <div class="collection-box" style="margin-right:5px;"> 
                                  <a href="http://ww10.1800flowers.com/sympathy/cremationstandingsprays-12190?cm_sp=sympathy1-_-cremation-browselink-fc-_-12190" name="sympathy_cremation_fc_standingsprays"><img src="<?php echo theme_url();?>/sympathy_files/91291Lc.jpg" alt="Cremation Standing Sprays" border="0"><br>                Cremation Standing Sprays</a> 
                                  </div>              
                                  
                                  <div class="collection-box" style="margin-right:5px;"> 
                                  <a href="http://ww10.1800flowers.com/sympathy/cremationbaskets-12188?cm_sp=sympathy1-_-cremation-browselink-fc-_-12188" name="sympathy_cremation_fc_basketarrangements"><img src="<?php echo theme_url();?>/sympathy_files/91386c.jpg" alt="Cremation Basket Arrangements" border="0"><br>                Cremation Basket Arrangements</a> 
                                  </div>              
                               
                                  <div class="collection-box" style="margin-right:5px;"> <a href="http://ww10.1800flowers.com/sympathy/cremationplants-12189?cm_sp=sympathy1-_-cremation-browselink-fc-_-12189" name="sympathy_cremation_fc_plants"><img src="<?php echo theme_url();?>/sympathy_files/4215c.jpg" alt="Cremation Plants" border="0"><br>                Cremation Plants</a> 
                                  </div>
                              
                              <div class="collection-box" style="margin-right:5px;"> 
                              <a href="http://ww10.1800flowers.com/sympathygiftbasketsfoodgifts?cm_sp=sympathy1-_-cremation-browselink-fc-_-10221" name="sympathy_cremation_fc_giftbaskets"><img src="<?php echo theme_url();?>/sympathy_files/91499XLc.jpg" alt="Sympathy Gift Baskets" border="0"><br>                Sympathy Gift Baskets</a> 
                              </div>
                       
                       
                   </div>  
                   
                   
                           </div>        </div>     
            <div class="cremation-right" style="float:right;position:absolute;left:600px;"> 
            <img src="<?php echo theme_url();?>/sympathy_files/title-alternate-sympathy-options.gif" alt="Alternate Sympathy Options" border="0"><br>          <a href="http://ww10.1800flowers.com/sympathy/sameday/11826?cm_sp=sympathy1-_-cremation-options-link-_-11826" name="sympathy_cremationsamedaydelivery">Same-Day Delivery</a><br> 
           </div> 
           
                  <br clear="all">      </div>    </div>    <!-- END CREMATION SERVICES --> <!-- BOT SECTION -->  
        
        
           <!-- END BOT SECTION --></div></div>



<script language="javascript">
function toggle(ids) {		var ele = document.getElementById(ids);		if (ele.style.display == "block") {		ele.style.display = "none";	} else {		ele.style.display = "block";	}}
</script>
<script type="text/javascript">
function showMe(){for(var i = 0,e = arguments.length;i < e;i++) {var myDiv = document.getElementById(arguments[i]).style;myDiv.display = "block";	}}function hideMe(){for(var i = 0,e = arguments.length;i < e;i++) {var myDiv = document.getElementById(arguments[i]).style;myDiv.display = "none";	}}
</script>
<script src="<?php echo theme_url();?>/sympathy_files/jquery-1.js"></script>
<script src="<?php echo theme_url();?>/sympathy_files/jquery.js"></script>
<script src="<?php echo theme_url();?>/sympathy_files/wmpopup.js"></script>

</td>


	</tr>
</tbody></table>
 


			</div>
		</td>
	</tr>
</tbody></table>


	
		
					
		
		 
		




<!-- ww10  17-->




</div>

<?php include_once('footer.php'); ?>
	


			



