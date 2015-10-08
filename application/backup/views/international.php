<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            
            <div id="main" class="page-content">
            

                
                <div id="main-countries">
                
                     <h2>Shop by Leading Countries</h2>
                	<ul class="clearfix">
                	<?php foreach($main_countries as $cn) : ?>
                    	<li><img src="/images/flags-iso/48/<?php echo strtolower($cn->short_code);?>.png"/>
                        <a href="/country/<?php echo $cn->short_code;?>"><?php echo $cn->country_name;?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>      
                
                
                
                <div id="continent-countries">
                
                    <div id="show-continents">
                    <h2>Shop By Continent</h2>                        
<img src="/images/worldmap.jpg" name="worldmap" width="700" height="330" border="0" usemap="#worldmap" id="worldmap" />
<map name="worldmap" id="worldmap">
<area shape="poly" coords="203,194,232,169,252,166,235,140,293,136,292,115,231,112,209,86,206,72,239,21,190,33,157,60,137,73,129,101,115,106,82,95,73,120,80,137,100,132,138,159,141,180,158,201,174,212,188,219,194,224,202,228,208,226,211,220,225,211" href="#" alt="North America" id="co-northamerica" class="maparea" />
<area shape="poly" coords="210,252,220,260,219,277,217,299,219,306,226,305,233,297,239,293,245,287,253,277,263,270,268,267,361,264,360,245,273,242,254,235,247,229,230,223,217,221,210,224,203,239" href="#" alt="South America" id="co-southamerica"  class="maparea" />
<area shape="poly" coords="357,104,313,145,320,173,310,179,319,187,333,178,342,173,356,174,368,186,378,183,385,182,394,170,409,152,417,125,414,113,424,105,441,66" href="#" alt="Europe"  id="co-europe"  class="maparea" />
<area shape="poly" coords="384,185,379,194,393,217,407,220,425,210,438,208,448,232,456,231,460,217,474,208,477,218,480,232,492,251,510,251,526,237,527,224,525,211,533,195,553,179,557,158,578,156,613,128,632,117,570,98,543,90,511,84,506,69,489,56,476,40,479,72,462,87,442,97,427,105,418,112,411,152" href="#" alt="Asia"  id="co-asia"  class="maparea" />
<area shape="poly" coords="526,256,506,266,503,280,508,288,533,286,548,290,567,284,568,271,560,252,552,234,618,230,616,205,537,206,532,243,541,246" href="#" alt="Oceania"  id="co-oceania"  class="maparea" />
</map>
                        
                        
                    </div>
                
                	<div class="continent" id="asia">  
                    <h3>Asia</h3> 
                    	<ul class="clearfix">
                        	<?php foreach($asia as $co) :?>
      <li><img src="/images/flags-iso/24/<?php echo strtolower($co->short_code);?>.png" /><a href="/country/<?php echo $co->short_code;?>"><?php echo $co->country_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>                  
                    </div> 
                    
                	<div class="continent" id="oceania">  
                    <h3>Oceania</h3> 
                    	<ul class="clearfix">
                        	<?php foreach($oceania as $co) :?>
      <li><img src="/images/flags-iso/24/<?php echo strtolower($co->short_code);?>.png" /><a href="/country/<?php echo $co->short_code;?>"><?php echo $co->country_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>                  
                    </div> 
                    
                	<div class="continent" id="northamerica" style="display:block;">   
                    <h3>North America</h3>
                    	<ul class="clearfix">
                        	<?php foreach($northamerica as $co) :?>
      <li><img src="/images/flags-iso/24/<?php echo strtolower($co->short_code);?>.png" /><a href="/country/<?php echo $co->short_code;?>"><?php echo $co->country_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>                  
                    </div> 

                	<div class="continent" id="southamerica">   
                    <h3>South America</h3>
                    	<ul class="clearfix">
                        	<?php foreach($southamerica as $co) :?>
      <li><img src="/images/flags-iso/24/<?php echo strtolower($co->short_code);?>.png" /><a href="/country/<?php echo $co->short_code;?>"><?php echo $co->country_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>                  
                    </div> 
                	<div class="continent" id="europe">   
                    <h3>Europe</h3>
                    	<ul class="clearfix">
                        	<?php foreach($europe as $co) :?>
      <li><img src="/images/flags-iso/24/<?php echo strtolower($co->short_code);?>.png" /><a href="/country/<?php echo $co->short_code;?>"><?php echo $co->country_name;?></a></li>
                            <?php endforeach; ?>
                        </ul>                  
                    </div>                     
                </div> 
                
                <div id="alphabetical-countries"> 
                	<h2>Shop By Country Index</h2>
                   <ul class="alpha-nav">
                	<?php $alphabets = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'); 
					foreach($alphabets as $alp) :?>
                    
                    	<li><a href="#" id="nav-<?php echo $alp ;?>" class="alpha"><?php echo $alp ;?></a> &nbsp; </li>
                    
                    <?php endforeach; ?>
                    
                    </ul>
                    
                  <?php foreach($alphacountries as $key=>$val) : ?>
                    
                    <div id="alpha-<?php echo $key;?>" class="alpha-countries" <?php if($key=='A') { echo 'style="display:block;"';}?>>
                    
                    	<h3><?php echo $key;?></h3>
                    
                    	<ul class="clearfix">
                        <?php foreach($val as $clist) :?>
                        	<li><a href="/country/<?php echo $clist->short_code;?>"><img src="/images/flags-iso/24/<?php echo strtolower($clist->short_code);?>.png" /> <?php echo $clist->country_name;?></a></li>                        
                        <?php endforeach; ?>                        
                        </ul>
                    </div>  
                    
                  <?php endforeach; ?>                

                </div>
                            
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
        
        <script>
		
			$(document).ready(function(){
				
				$(".maparea").click(function(e){
					e.preventDefault();
					var id = $(this).attr("id");
					id = id.slice(3);
					$(".continent").css("display","none");
					$("#"+id).css("display","block");
				})
				
				$(".alpha").click(function(e){
					e.preventDefault();
					var id = $(this).attr("id");
					id = id.slice(4);
					
					$(".alpha-countries").css("display","none");
					$("#alpha-"+id).css("display","block");				
				
				});
				
			});
		
		</script>
<?php include_once('footer.php'); ?>
       