<?php include_once('header.php'); ?> 
<?php $vaseID = $this->session->userdata('vaseID'); ?>
<?php $dts = get_next_dates(); ?>
              
			  
			  
			  <?php 
			  //echo $_SERVER['REQUEST_URI'];
			  
			  $as1='';
			  if(isset($_SERVER['REQUEST_URI'])){
				  
			  
			  if($_SERVER['REQUEST_URI']!='/products' && $_SERVER['REQUEST_URI']!='/search'){
			  
			$inf = $_SERVER['REQUEST_URI']; 
			$in = explode("/", $inf);
			$as1 = $in[1]; 
			
			if($in[2]=='red'){
				$d = 'background-color:#A02422; color:#fff;';
			}
			if($in[2]=='white'){
				$d = 'background-color:#D9D9D9; color:#707070;';
			}
			if($in[2]=='blue'){
				$d = 'background-color:#104E8B; color:#fff;';
			}
			if($in[2]=='lavander'){
				$d = 'background-color:#8B668B; color:#fff;';
			}
			if($in[2]=='pink'){
				$d = 'background-color:#FF82AB; color:#fff;';
			}
			if($in[2]=='bright'){
				$d = 'background-color:#FF7722; color:#fff;';
			}
			if($in[2]=='pastel'){
				$d = 'background-color:#DB9EA6; color:#fff;';
			}
			if($in[2]=='yellow'){
				$d = 'background-color:#FCDC3B; color:#fff;';
			}
			if($in[2]=='peach'){
				$d = 'background-color:#D98719; color:#fff;';
			}
			
			  }else{
			  
			  }
			  
			  
			  }
			  
			  if($as1!='subcategory') {
			  
			        // echo "products list";   
                if(isset($rec) && count($rec) && !empty($rec->banner_file)) :
                    echo '';
                    
                    if($this->session->userdata('language')=='french') :
                        echo '<div id="bannerhead" style="height:110px; background: url('.img_resized('/banners/'.$rec->banner_file_fr,'1500x100').'); background-size:1165px 110px;">';
                    else :
                        echo '<div id="bannerhead" style="height:110px; background: url('.img_resized('/banners/'.$rec->banner_file,'1500x100').'); background-size:1165px 110px;">';
                    endif;
                    
                    if(!empty($rec->description)) :
                    
                        echo '<div class="category-desc" style="margin-top:2px;"><div class="innerbox" style="margin: 0px 0px 0px 470px; width:410px; padding-top:15px;">';
                        
                        if($this->session->userdata('language')=='french') :
                            echo '<p>'.$rec->description_fr.'</p>';
                        else :
                            echo '<p>'.$rec->description.'</p>';
                        endif;
                        
                        echo '</div></div>';
                    
                    endif;                    
                    
                    echo '</div>';
                else :
                  echo '';
                endif;               
               

			   }else{ ?>
				
				
				<?php
				
				/*if($in[2]=='red'){
				
				}*/
				
				
				?>
				
				
				
				<div style="margin:1px 0px 0px 0px; padding: 15px 15px 15px 15px; text-align:center; font-size:34px; font-weight:bold; <?php echo $d; ?>">
				<img src="<?php echo base_url(); ?>images/memorial/<?php echo $in[2]; ?>.jpg" style="width:1200px; height:470px;" usemap="#Map" />
				<map name="Map" id="Map">
				  <?php if($in[2] == 'white') { ?>	
				  <area shape="poly" coords="66,57,50,60,25,73,9,91,21,136,33,155,47,175,70,192,91,208,116,196,126,180,147,162,162,124,154,88,138,75,114,62,90,67" href="<?php echo base_url(); ?>white/white-heart" title="White Heart" />
				  <area shape="poly" coords="202,127,182,147,152,170,135,197,97,239,122,266,147,271,166,269,193,271,209,263,239,269,268,270,293,260,299,228,252,189" href="<?php echo base_url(); ?>white/heartfelt-sympathies-standing-basket-white" title="Heartfelt Sympathies Standing Basket White" />
				  <area shape="poly" coords="283,43,265,51,244,65,230,82,222,100,221,119,223,139,234,156,246,172,256,185,274,197,296,206,324,205,341,194,355,189,372,178,377,162,384,143,391,120,389,100,379,78,356,60,332,48,309,43" href="<?php echo base_url(); ?>white/serene-blessings-standing-wreath-white" title="Serene Blessings Standing Wreath White" />
				  <area shape="poly" coords="359,257,336,272,321,289,291,301,280,315,281,346,258,368,245,407,271,430,304,423,324,411,336,402,337,420,346,430,367,427,385,419,389,402,403,410,429,417,477,418,476,386,458,337,415,304" href="<?php echo base_url(); ?>white/heartfelt-tribute-floor-basket-arrangement-white" title="Heartfelt Tribute Floor Basket Arrangement White" />
				  <area shape="poly" coords="632,16,614,10,601,29,590,43,571,47,556,69,573,87,593,91,601,94,600,104,603,147,611,175,624,174,639,150,642,121,644,99,647,83,662,83,675,71,676,56,664,48,640,48,640,29" href="<?php echo base_url(); ?>white/peace-and-prayers-standing-cross-white" title="Peace And Prayers Standing Cross White" />
				  <area shape="poly" coords="702,112,682,122,666,131,657,138,646,150,637,161,630,181,623,195,633,210,644,223,660,231,679,237,694,243,712,251,732,247,749,248,768,245,784,237,798,222,810,208,800,187,793,170,788,151,776,136,765,130,750,122" href="<?php echo base_url(); ?>white/cherished-memories-half-casket-cover-white" title="Cherished Memories Half Casket Cover White" />
				  <area shape="poly" coords="744,276,742,301,736,305,726,295,726,309,728,324,718,329,709,322,700,319,708,337,704,345,694,349,688,356,664,379,666,400,663,421,673,438,700,443,722,448,742,448,758,448,773,451,795,450,811,449,830,448,853,442,863,416,839,397,850,369,837,356,830,338,818,320,801,308,783,314,778,301,774,289,765,277" href="<?php echo base_url(); ?>white/thoughts-and-prayers-fireside-basket-white" title="Thoughts And Prayers Fireside Basket White" />
				  <area shape="poly" coords="852,53,831,51,817,51,805,58,795,63,788,78,787,92,785,111,786,126,793,147,808,162,821,175,832,187,850,198,867,196,889,184,906,176,923,157,939,134,942,109,945,85,935,67,913,56,891,51,875,51,863,63" href="<?php echo base_url(); ?>white/always-remember-floral-heart-tribute-white" title="Always Remember Floral Heart Tribute White" />
				  <area shape="poly" coords="937,183,927,206,916,195,914,208,899,207,887,219,876,228,879,239,863,241,856,264,856,287,873,300,892,309,892,321,919,326,940,327,963,325,974,325,978,306,996,304,1006,292,1012,270,990,249,985,233,975,211,964,202,954,209,943,208" href="<?php echo base_url(); ?>white/white-sympathy-arrangement-in-basket" title="White Sympathy Arrangement In Basket" />
				  <area shape="poly" coords="1051,22,1034,29,1022,37,1023,50,1023,60,1014,65,1004,58,991,59,985,69,979,80,968,91,972,105,984,108,997,111,986,116,971,131,966,140,967,158,971,169,972,184,980,197,986,213,997,230,1011,242,1026,251,1037,240,1050,224,1061,230,1075,231,1085,240,1113,254,1128,241,1129,219,1158,225,1179,206,1160,178,1175,153,1176,124,1170,94,1166,73,1151,55,1146,31,1124,19,1110,20,1091,3,1071,5,1068,17" href="<?php echo base_url(); ?>white/deepest-sympathies-standing-spray-white" title="Deepest Sympathies Standing Spray White" />
				  <?php } ?>
				  
				  <?php if($in[2] == 'blue') { ?>
				  <area shape="poly" coords="129,127,114,150,95,164,76,165,75,185,63,201,48,193,35,206,24,221,16,241,8,257,23,273,37,273,61,265,77,267,94,270,105,274,117,278,137,288,159,285,174,267,185,273,210,270,230,262,236,243,232,221,236,197,209,192,210,172,188,161,171,151,185,163,153,142" href="<?php echo base_url(); ?>blue/heartfelt-sympathies-standing-basket-blue-and-white" title="Heartfelt Sympathies Standing Basket Blue And White" />
			      <area shape="poly" coords="273,56,254,46,236,39,217,48,202,64,195,83,195,106,202,117,207,133,215,145,225,158,235,165,245,173,258,182,272,189,279,195,288,189,302,179,317,172,330,152,343,141,351,122,356,106,356,82,348,56,336,44,316,39,298,34,284,40" href="<?php echo base_url(); ?>blue/always-remember-floral-heart-tribute-blue-and-white" title="Always Remember Floral Heart Tribute Blue And White" />
				  <area shape="poly" coords="716,141,687,144,673,151,654,164,635,174,616,185,598,194,612,203,631,213,633,235,634,249,648,244,661,246,679,246,690,249,701,268,716,275,739,272,759,258,766,248,783,249,796,244,813,239,832,233,845,216,841,200,831,184,801,167,777,154,749,143" href="<?php echo base_url(); ?>blue/cherished-memories-half-casket-cover-blue-and-white" title="Cherished Memories Half Casket Cover Blue And White" />
				  <area shape="poly" coords="894,43,865,51,842,61,830,78,823,98,818,125,827,149,836,166,851,176,869,184,885,187,904,187,918,189,933,186,947,175,966,168,976,152,985,134,991,114,986,92,979,72,963,60,945,47,919,38" href="<?php echo base_url(); ?>blue/serene-blessings-standing-wreath-blue-and-white" title="Serene Blessings Standing Wreath Blue And White" />
				  <area shape="poly" coords="1092,9,1054,28,1041,50,1027,61,1011,78,1002,91,1000,106,998,127,999,155,1003,185,1018,212,1024,227,1037,249,1052,261,1073,270,1092,275,1108,273,1127,263,1143,245,1159,229,1167,209,1175,196,1182,179,1186,153,1192,133,1192,109,1188,91,1175,65,1155,39,1139,19,1117,9" href="<?php echo base_url(); ?>blue/deepest-sympathies-standing-spray-blue-and-white" title="Deepest Sympathies Standing Spray Blue And White" />
				  <area shape="poly" coords="908,261,880,276,867,293,842,307,827,321,813,335,799,351,786,361,792,379,780,400,780,419,805,433,826,438,854,422,872,432,864,453,889,457,917,458,942,456,946,432,975,434,1003,435,1025,423,1021,393,1001,361,983,321,963,289,932,284" href="<?php echo base_url(); ?>blue/heartfelt-tribute-floor-basket-arrangement" title="Heartfelt Tribute Floor Basket Arrangement" />
				  <?php } ?>	

				  <?php if($in[2] == 'lavander') { ?>
				  <area shape="poly" coords="302,13,274,25,257,25,248,37,237,47,219,63,216,87,214,115,217,140,222,170,229,200,250,224,274,241,291,250,320,246,343,237,364,221,378,198,393,180,392,155,398,133,394,112,394,80,386,54,369,35,333,16" href="<?php echo base_url(); ?>lavander/deepest-sympathies-standing-spray-lavender" title="Deepest Sympathies Standing Spray Lavender" />
				  <area shape="poly" coords="104,52,85,41,61,42,39,48,18,56,10,71,10,91,7,115,15,136,25,152,33,163,48,174,65,184,80,194,95,205,111,215,125,206,144,197,158,188,179,178,192,157,203,141,204,128,211,112,210,97,203,78,193,64,182,51,162,43,138,40,117,41" href="<?php echo base_url(); ?>lavander/always-remember-floral-heart-tribute-lavender" title="Always Remember Floral Heart Tribute Lavender" />
				  <area shape="poly" coords="226,256,219,280,201,290,183,295,164,300,158,318,147,333,136,351,137,373,127,393,111,403,108,424,120,442,144,441,173,437,198,439,200,457,205,468,225,466,244,466,272,466,275,444,275,422,294,423,312,427,326,420,339,419,362,417,373,405,360,387,337,383,338,367,349,349,354,334,339,322,325,306,306,305,298,286,288,285,268,268,247,272" href="<?php echo base_url(); ?>lavander/heartfelt-tribute-floor-basket-arrangement-lavander" title="Heartfelt Tribute Floor Basket Arrangement Lavander" />
				  <area shape="poly" coords="643,11,625,20,605,21,599,33,603,47,590,48,584,51,580,66,586,78,588,92,607,92,624,94,617,107,617,132,619,149,619,164,633,168,652,164,663,156,669,136,665,114,669,96,683,101,694,90,702,80,707,69,704,54,696,42,677,42,658,43,662,28,658,11" href="<?php echo base_url(); ?>lavander/peace-and-prayers-standing-cross-lavender" title="Peace And Prayers Standing Cross Lavender" />
				  <area shape="poly" coords="735,128,712,132,699,139,689,138,676,157,667,160,656,180,653,193,636,198,636,214,656,215,654,228,646,247,662,260,679,267,698,283,720,286,740,287,766,290,792,290,808,281,828,279,850,271,860,252,856,230,848,200,813,174,794,153,778,134,758,127" href="<?php echo base_url(); ?>lavander/cherished-memories-half-casket-cover-lavender" title="Cherished Memories Half Casket Cover Lavender" />
				  <area shape="poly" coords="868,43,850,53,831,56,817,67,807,87,798,108,801,130,810,147,821,164,836,181,855,192,882,201,899,204,923,198,941,183,953,166,967,148,975,128,981,101,965,78,951,57,934,45,904,36,887,31" href="<?php echo base_url(); ?>lavander/serene-blessings-standing-wreath-lavender" title="Serene Blessings Standing Wreath Lavender" />
				  <area shape="poly" coords="1050,116,1032,136,1012,140,996,141,984,156,977,172,960,182,952,191,949,213,934,221,926,227,915,251,938,268,961,275,978,278,985,301,998,310,1023,296,1041,303,1064,311,1084,307,1097,296,1123,304,1147,309,1157,298,1184,285,1189,264,1186,234,1175,208,1153,179,1133,157,1098,130" href="<?php echo base_url(); ?>lavander/heartfelt-sympathies-standing-basket-lavender" title="Heartfelt Sympathies Standing Basket Lavender" />
				  <?php } ?>
				  
				  <?php if($in[2] == 'pink') { ?>
				  <area shape="poly" coords="130,50,105,57,83,63,64,72,48,85,35,102,28,119,28,145,42,167,55,179,73,192,86,201,104,203,120,208,138,210,159,210,180,209,193,205,217,195,227,186,243,172,254,143,254,119,245,95,228,78,209,64,181,55,160,48" href="<?php echo base_url(); ?>pink/serene-blessings-standing-wreath-pink" title="Serene Blessings Standing Wreath Pink" />
				  <area shape="poly" coords="342,85,333,75,312,75,295,80,282,86,271,94,265,106,264,117,270,137,281,154,294,164,304,176,318,187,332,192,350,188,367,177,383,167,399,152,408,138,412,122,412,100,403,87,389,74,364,73" href="<?php echo base_url(); ?>pink/pink-mixed-flower-heart" title="Pink Mixed Flower Heart" />
				  <area shape="poly" coords="288,212,278,212,246,221,235,233,218,250,199,260,184,273,181,293,170,312,152,328,150,348,144,371,179,368,202,355,217,344,226,356,250,360,272,362,295,363,318,366,340,366,359,356,370,351,388,352,409,348,429,340,434,325,424,309,405,289,378,273,377,261,361,244,342,228,313,214" href="<?php echo base_url(); ?>pink/sincerest-sympathies-fireside-basket-pink" title="Sincerest Sympathies Fireside Basket Pink" />
				  <area shape="poly" coords="465,175,451,179,446,194,455,207,465,216,476,219,492,219,502,216,508,203,508,188,504,174,494,167,483,165,475,173" href="<?php echo base_url(); ?>pink/pink-satin-heart-casket-pillow" title="Pink Satin Heart Casket Pillow" />
				  <area shape="poly" coords="741,146,713,148,697,161,676,169,658,183,642,196,654,207,669,223,683,236,704,249,724,262,743,266,762,263,786,267,807,260,826,248,840,237,858,219,861,203,841,183,814,169,797,151,766,143" href="<?php echo base_url(); ?>pink/cherished-memories-half-casket-cover-pink" title="Cherished Memories Half Casket Cover Pink" />
				  <area shape="poly" coords="869,74,850,67,835,67,809,72,803,93,803,109,805,128,815,139,827,151,843,159,856,171,865,177,876,181,898,172,920,160,929,147,940,128,944,104,938,82,926,70,905,65,888,68" href="<?php echo base_url(); ?>pink/pink-open-heart" title="Pink Open Heart" />
				  <area shape="poly" coords="1046,12,1013,24,992,33,979,46,977,66,960,90,961,104,956,132,952,161,957,183,963,203,966,222,976,235,998,247,1006,251,1029,260,1051,263,1076,265,1106,261,1125,247,1141,233,1153,221,1165,203,1164,180,1168,154,1172,124,1171,95,1157,74,1149,49,1132,32,1106,17,1081,9" href="<?php echo base_url(); ?>pink/deepest-sympathies-standing-spray-pink" title="Deepest Sympathies Standing Spray Pink" />
				  <area shape="poly" coords="894,295,873,311,851,327,834,343,820,362,804,379,795,401,786,424,777,438,811,451,841,456,870,459,903,459,936,463,969,464,990,464,1030,461,1059,458,1041,431,1015,402,996,374,980,344,955,328,930,310" href="<?php echo base_url(); ?>pink/thoughts-and-prayers-fireside-basket-pink" title="Thoughts And Prayers Fireside Basket Pink" />
			      <?php } ?>

				
				  <?php if($in[2] == 'bright') { ?>
				  <area shape="poly" coords="131,127,102,139,82,153,47,173,26,206,19,235,15,272,24,294,59,297,96,286,129,278,163,283,202,285,218,267,237,257,249,234,236,201,223,174,196,148,172,138" href="<?php echo base_url(); ?>bright/heartfelt-sympathies-standing-basket-bright" title="Heartfelt Sympathies Standing Basket Bright" />
				  <area shape="poly" coords="311,59,291,46,261,42,249,54,231,65,224,78,219,109,228,127,239,146,253,157,270,171,290,182,311,186,332,180,345,171,362,159,375,147,381,129,387,116,392,95,385,70,368,49,345,38,322,42" href="<?php echo base_url(); ?>bright/always-remember-floral-heart-tribute-bright" title="Always Remember Floral Heart Tribute Bright" />
				  <area shape="poly" coords="308,212,281,224,267,236,255,248,246,260,233,276,232,290,237,311,253,326,271,334,292,336,315,339,349,343,369,341,379,317,384,286,382,270,375,252,357,234,339,226" href="<?php echo base_url(); ?>bright/always-remember-floral-heart-tribute-bright" />
				  <area shape="poly" coords="472,143,453,150,446,166,448,181,459,191,475,198,486,197,499,189,509,174,510,159,502,148,489,141" href="<?php echo base_url(); ?>bright/bright-satin-heart-casket-pillow" title="Bright Satin Heart Casket Pillow" />
				  <area shape="poly" coords="512,284,493,308,466,323,456,341,446,355,427,371,415,403,405,429,415,444,440,450,466,453,490,455,526,465,550,461,581,459,592,453,615,445,631,425,618,394,608,367,595,347,568,332,552,316,541,300,530,287" href="<?php echo base_url(); ?>bright/thoughts-and-prayers-fireside-basket-bright" title="Thoughts And Prayers Fireside Basket Bright" />
				  <area shape="poly" coords="634,15,620,22,603,39,586,48,579,62,579,81,598,87,618,93,619,106,618,126,622,145,627,159,645,160,660,154,665,136,666,115,671,87,682,76,701,74,700,56,690,46,671,43,662,43,661,26,656,12,640,9" href="<?php echo base_url(); ?>bright/peace-and-prayers-standing-cross-bright" title="Peace And Prayers Standing Cross Bright" />
				  <area shape="poly" coords="718,130,689,140,666,155,646,166,626,181,628,196,643,214,656,228,681,240,708,247,735,253,761,243,774,235,805,224,818,215,831,198,820,178,801,160,780,154,764,138,741,130" href="<?php echo base_url(); ?>bright/cherished-memories-half-casket-cover-bright" title="Cherished Memories Half Casket Cover Bright" />
				  <area shape="poly" coords="874,54,846,56,826,66,813,84,801,100,798,122,809,146,819,164,831,171,852,181,867,188,890,185,910,179,929,175,942,163,954,145,955,122,955,101,948,79,931,69,915,58,894,50" href="<?php echo base_url(); ?>bright/serene-blessings-standing-wreath-brightness" title="Serene Blessings Standing Wreath Brightness" />
				  <area shape="poly" coords="1059,9,1028,22,1005,40,987,69,980,104,976,132,981,164,990,200,1005,222,1023,242,1046,260,1071,267,1097,267,1130,262,1140,243,1155,228,1169,202,1174,178,1181,145,1181,120,1176,91,1169,67,1152,40,1132,18,1094,12" href="<?php echo base_url(); ?>bright/deepest-sympathies-standing-spray-bright" title="Deepest Sympathies Standing Spray Bright" />
				  <area shape="poly" coords="966,241,943,251,921,268,895,288,878,307,852,338,840,370,841,391,853,407,892,407,923,400,938,411,942,429,959,438,979,438,1016,441,1023,429,1028,408,1046,407,1072,406,1106,404,1116,383,1103,360,1090,335,1076,312,1061,292,1035,275,999,256" href="<?php echo base_url(); ?>bright/heartfelt-tribute-floor-basket-arrangement-bright" title="Heartfelt Tribute Floor Basket Arrangement Bright" />
				  <?php } ?>
						
					<?php if($in[2] == 'pastel') { ?>	
					<area shape="poly" coords="121,115,91,126,59,143,36,160,20,186,15,218,16,244,24,264,45,271,71,268,101,265,136,260,168,258,195,256,223,250,234,241,248,216,245,194,230,164,214,147,185,138,156,125" href="<?php echo base_url(); ?>pastel/heartfelt-sympathies-standing-basket-pastel" title="Heartfelt Sympathies Standing Basket Pastel" />
					<area shape="poly" coords="304,61,279,54,262,56,241,66,235,78,230,90,228,104,227,122,239,142,252,153,269,167,283,176,298,184,311,187,333,179,357,167,363,147,378,123,382,98,380,74,369,57,343,45,323,53" href="<?php echo base_url(); ?>pastel/always-remember-floral-heart-tribute-pastel" title="Always Remember Floral Heart Tribute Pastel" />
					<area shape="poly" coords="294,250,268,261,249,273,230,286,222,300,212,324,199,345,188,371,175,392,194,406,218,411,248,411,268,401,268,422,270,434,287,438,303,439,325,437,338,428,341,406,342,395,356,392,369,393,390,395,408,388,429,378,443,368,444,354,428,330,404,305,376,282,357,268,321,252" href="pastel/heartfelt-tribute-floor-basket-arrangement-pastel" title="Heartfelt Tribute Floor Basket Arrangement Pastel" />
					<area shape="poly" coords="620,14,601,24,592,30,578,34,571,45,567,57,565,73,573,85,589,86,598,88,598,107,599,124,600,143,605,162,615,163,630,158,642,147,648,137,652,120,652,102,652,81,663,79,676,77,680,65,675,57,667,47,655,43,646,43,642,31,643,18,629,12" href="<?php echo base_url(); ?>pastel/peace-and-prayers-standing-cross-pastel" title="Peace And Prayers Standing Cross Pastel" />
					<area shape="poly" coords="695,125,672,139,663,147,640,158,628,168,614,187,619,207,641,221,665,232,684,238,702,245,729,246,751,243,766,235,787,222,802,205,806,191,783,165,756,140,726,125" href="<?php echo base_url(); ?>pastel/cherished-memories-half-casket-cover-pastel" title="Cherished Memories Half Casket Cover Pastel" />
					<area shape="poly" coords="655,253,638,268,605,278,594,293,575,314,556,333,543,358,538,386,527,421,529,437,561,452,593,457,645,460,677,461,719,461,752,454,773,445,778,429,757,391,748,361,741,328,723,304,687,268" href="<?php echo base_url(); ?>pastel/thoughts-and-prayers-fireside-basket-pastel" title="Thoughts And Prayers Fireside Basket Pastel" />
					<area shape="poly" coords="848,51,829,55,813,56,794,67,780,77,773,89,768,112,766,134,778,155,795,163,816,176,846,184,871,179,895,177,924,161,933,142,940,119,936,88,923,71,892,53,875,50" href="<?php echo base_url(); ?>pastel/serene-blessings-standing-wreath-pastel" title="Serene Blessings Standing Wreath Pastel" />
					<area shape="poly" coords="920,190,894,203,878,218,865,235,848,257,845,274,848,289,860,307,879,319,900,319,933,320,969,320,994,320,1007,315,1018,312,1033,304,1036,283,1022,252,1005,225,974,202,944,193" href="<?php echo base_url(); ?>pastel/pastel-sympathy-basket" title="Pastel Sympathy Basket" />
					<area shape="poly" coords="1070,9,1031,23,1006,33,966,64,968,81,958,108,959,130,965,147,972,176,987,198,1014,222,1038,240,1068,251,1105,250,1138,247,1152,232,1171,212,1187,192,1195,163,1191,101,1186,70,1167,42,1140,20,1108,13" href="<?php echo base_url(); ?>pastel/deepest-sympathies-standing-spray-pastel" title="Deepest Sympathies Standing Spray Pastel" />
					 <?php } ?>					
						
					<?php if($in[2] == 'yellow') { ?>	
					<area shape="poly" coords="105,51,64,63,33,81,21,106,12,135,12,153,23,179,40,196,69,215,89,225,114,231,148,230,169,216,191,203,206,181,220,162,221,131,223,107,202,85,183,66,138,52" href="<?php echo base_url(); ?>yellow/serene-blessings-standing-wreath-yellow" title="Serene Blessings Standing Wreath Yellow" />
					<area shape="poly" coords="274,128,260,138,241,152,221,173,216,189,208,201,190,214,183,231,169,259,169,281,172,303,177,313,209,304,232,295,249,292,259,295,264,309,280,311,320,312,336,302,341,288,354,285,382,285,395,280,402,265,379,240,358,206,318,168,294,146" href="<?php echo base_url(); ?>yellow/heartfelt-sympathies-standing-basket-yellow" title="Heartfelt Sympathies Standing Basket Yellow" />
					<area shape="poly" coords="375,70,366,66,347,61,329,65,317,74,305,84,304,99,302,122,316,147,332,172,347,184,363,200,379,218,395,215,410,203,429,189,440,169,450,149,457,133,458,111,455,92,439,71,421,57,395,58" href="<?php echo base_url(); ?>yellow/always-in-my-heart-floral-heart-yellow" title="Always In My Heart Floral Heart Yellow" />
					<area shape="poly" coords="456,252,431,271,411,290,392,310,372,336,362,355,349,381,344,403,344,423,364,433,392,439,419,439,449,441,473,442,514,444,534,438,562,428,580,414,590,398,587,371,557,328,536,282,490,263" href="<?php echo base_url(); ?>yellow/heartfelt-tribute-floor-basket-arrangement-Yellow" title="Heartfelt Tribute Floor Basket Arrangement Yellow" />
					<area shape="poly" coords="658,28,640,39,627,52,613,60,609,70,603,85,612,95,629,99,638,104,639,124,639,148,641,171,654,172,669,167,677,151,684,127,694,112,695,100,712,94,714,80,711,68,703,57,690,55,682,55,678,38,670,28" href="<?php echo base_url(); ?>yellow/peace-and-prayers-standing-cross-yellow" title="Peace And Prayers Standing Cross Yellow" />
					<area shape="poly" coords="735,142,706,149,687,160,667,172,655,183,647,200,654,216,671,238,689,253,710,262,729,269,760,271,785,261,810,250,827,241,835,219,830,199,809,179,775,157" href="<?php echo base_url(); ?>yellow/cherished-memories-half-casket-cover-yellow" title="Cherished Memories Half Casket Cover Yellow" />
					<area shape="poly" coords="842,73,822,69,804,69,779,86,780,114,782,132,794,152,812,171,830,183,850,193,866,189,883,179,906,161,919,139,922,116,920,93,906,76,875,67" href="<?php echo base_url(); ?>yellow/always-remember-floral-heart-tribute-yellow" title="Always Remember Floral Heart Tribute Yellow" />
					<area shape="poly" coords="807,289,781,311,761,329,746,342,724,358,705,384,695,408,695,430,692,453,725,460,769,469,810,468,849,464,891,464,928,456,930,438,915,402,909,376,895,347,857,321,841,302" href="<?php echo base_url(); ?>yellow/sincerest-sympathies-fireside-basket-yellow" title="Sincerest Sympathies Fireside Basket Yellow" />
					<area shape="poly" coords="938,180,917,182,903,186,884,198,880,208,873,225,872,247,881,263,895,281,914,290,921,308,926,320,940,326,960,327,970,317,971,294,975,280,995,276,1012,264,1011,233,1006,207,993,182,963,176" href="<?php echo base_url(); ?>yellow/beautiful-blessings-vase-arrangement-yellow" title="Beautiful Blessings Vase Arrangement Yellow" />
					<area shape="poly" coords="1074,9,1044,28,1014,40,1001,52,983,73,978,99,975,122,974,155,986,175,1001,204,1015,234,1027,259,1042,272,1061,286,1076,292,1096,294,1117,274,1144,241,1161,216,1174,194,1191,165,1199,133,1187,97,1184,66,1154,39,1114,15" href="<?php echo base_url(); ?>yellow/deepest-sympathies-standing-spray-yellow" title="Deepest Sympathies Standing Spray Yellow" />
					 <?php } ?>	


					<?php if($in[2] == 'peach') { ?>	
					  <area shape="poly" coords="123,47,78,54,35,64,30,80,21,97,6,123,14,151,28,171,59,193,89,208,125,212,150,204,190,200,211,184,225,167,238,135,240,108,225,82,195,53,164,46" href="<?php echo base_url(); ?>peach/serene-blessing-standing-wreath-peach-orange-white" title="Serene Blessing Standing Wreath Peach Orange White" />
						<area shape="poly" coords="257,189,241,206,215,225,190,242,163,266,146,297,137,325,133,349,149,363,189,363,215,356,263,358,305,357,342,359,371,354,384,348,388,326,385,305,375,274,360,245,347,227,299,196" href="<?php echo base_url(); ?>peach/sincerest-sympathy-fireside-basket" title="Sincerest Sympathy Fireside Basket" />
						<area shape="poly" coords="321,74,302,71,278,76,258,76,251,88,246,105,250,127,263,148,276,163,292,171,310,183,335,199,352,184,372,171,378,158,396,133,396,110,396,93,379,75,368,65,338,65" href="<?php echo base_url(); ?>peach/white-heart-with-peach-rose-break" title="White Heart With Peach Rose Break" />
						<area shape="poly" coords="724,131,690,138,660,152,650,164,639,182,632,199,642,217,669,230,691,241,720,251,755,254,771,248,823,242,850,231,861,210,863,189,837,177,800,155,776,141,755,129" href="<?php echo base_url(); ?>peach/cherished-memories-half-casket-cover-peach-white" title="Cherished Memories Half Casket Cover Peach White" />
						<area shape="poly" coords="869,26,855,28,849,37,840,46,836,61,819,61,809,65,802,74,801,87,812,99,829,105,844,105,839,118,842,141,845,157,848,172,862,182,878,182,900,173,906,150,905,130,905,107,925,101,943,92,940,77,934,64,909,59,900,59,900,47,897,36,886,22" href="<?php echo base_url(); ?>peach/peace-and-prayers-standing-cross-peach" title="Peace And Prayers Standing Cross Peach" />
						<area shape="poly" coords="946,286,927,297,903,315,888,321,873,337,860,355,852,376,842,399,844,421,863,437,900,442,934,446,962,448,1004,451,1042,451,1074,450,1083,435,1083,414,1070,389,1053,369,1036,344,1003,319,986,306" href="<?php echo base_url(); ?>peach/thoughts-and-prayer-fireside-basket" title="Thoughts And Prayer Fireside Basket" />
						<area shape="poly" coords="1046,15,1013,38,993,49,979,55,965,70,962,79,948,106,948,130,945,159,947,184,963,203,976,219,996,239,1015,248,1037,254,1061,255,1086,255,1122,251,1135,231,1146,213,1158,193,1158,173,1165,153,1162,134,1160,105,1159,86,1151,65,1136,45,1100,31,1081,25" href="<?php echo base_url(); ?>peach/deepest-sympathy-standing-spray-peach-orange-and-white" title="Deepest Sympathy Standing Spray Peach Orange And White" />
					 <?php } ?>		
		

					<?php if($in[2] == 'red') { ?>
					<area shape="poly" coords="85,34,59,39,45,49,31,59,18,78,9,98,6,122,19,151,30,169,47,181,71,191,95,197,121,193,144,183,162,171,178,148,177,116,178,97,168,72,152,56,124,43" href="<?php echo base_url(); ?>red/serene-blessings-standing-wreath-red" title="Serene Blessings Standing Wreath Red" />
					<area shape="poly" coords="261,19,225,16,202,21,183,47,178,64,180,89,178,129,191,145,209,160,229,185,250,196,268,200,294,190,316,175,332,153,345,108,356,75,350,54,332,26,285,11" href="<?php echo base_url(); ?>red/red-rose-bleeding-heart" title="Red Rose Bleeding Heart" />
					<area shape="poly" coords="366,181,350,183,347,193,349,212,358,230,370,242,390,237,404,214,405,198,400,187,379,178" href="<?php echo base_url(); ?>red/red-and-white-satin-heart-casket-pillow" title="Red And White Satin Heart Casket Pillow" />
					<area shape="poly" coords="433,100,420,104,392,101,373,100,356,103,355,116,352,131,366,152,383,166,407,178,420,188,440,205,460,204,479,192,489,183,497,173,510,154,519,140,528,130,536,122,543,109,527,96,491,97,458,99" href="red/large-rosary-with-red-spray-roses" title="Large Rosary With Red Spray Roses" />
					<area shape="poly" coords="667,137,639,143,608,153,593,168,575,183,569,196,586,210,602,225,625,237,649,247,669,251,693,246,717,236,743,225,765,215,768,197,745,179,710,149,692,138" href="<?php echo base_url(); ?>red/cherished-memories-half-casket-cover-red" title="Cherished Memories Half Casket Cover Red" />
					<area shape="poly" coords="768,43,745,34,714,38,704,51,695,70,695,87,698,112,706,136,723,151,746,166,766,175,780,182,805,174,823,159,845,116,851,96,852,73,838,50,821,40,797,36" href="<?php echo base_url(); ?>red/always-remember-floral-heart-tribute-red" title="Always Remember Floral Heart Tribute Red" />
					<area shape="poly" coords="913,7,903,12,890,21,887,35,880,49,861,55,851,57,848,77,854,89,874,93,894,97,896,121,894,144,894,163,903,178,923,188,938,188,946,171,947,153,952,131,953,105,964,94,978,87,987,78,986,63,972,52,949,44,941,32,941,14,932,6" href="<?php echo base_url(); ?>red/peace-and-prayers-standing-cross-red" title="Peace And Prayers Standing Cross Red" />
					<area shape="poly" coords="915,301,889,311,870,334,857,353,839,371,827,397,815,433,830,447,872,459,912,462,942,463,978,463,1021,464,1038,450,1026,416,1013,379,993,346,953,315" href="<?php echo base_url(); ?>red/sincerest-sympathies-fireside-basket-red" title="Sincerest Sympathies Fireside Basket Red" />
					<area shape="poly" coords="1063,27,1044,37,1026,50,1010,65,994,84,977,119,978,137,981,176,996,201,1017,228,1044,252,1066,264,1089,255,1111,234,1132,216,1152,196,1174,163,1181,128,1168,100,1148,67,1114,40,1086,27" href="<?php echo base_url(); ?>red/deepest-sympathies-standing-spray-red" title="Deepest Sympathies Standing Spray Red" />
					<?php } ?>	
					
				</map>
				
				
				<style>
				
				#navlist li
				{
				display: inline;
				list-style-type: none;
				padding-right: 20px;
				font-size:24px;
				}
				
			
				</style>
				
				
				
				
				
				
				
				<div style="margin-top:15px;"> <?php //echo ucfirst($in[2]); ?> 
				
				
				<ul id="navlist">
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/red">Red</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/white">White</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/blue">Blue</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/lavander">Lavander</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/pink">Pink</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/bright">Bright</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/pastel">Pastel</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/yellow">Yellow</a></li>
				<li><a style="color:#fff;  text-decoration: none;"  href="/subcategory/peach">Peach</a></li>
				</ul>
				
				
				
				
				</div>
				</div>
				
				<?php 
				} 
				
				
				?>
				
				
				<?php //echo $this->session->userdata('referer'); ?>
				
              <?php /*if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } */?> 
            
			<?php 
			if($as1=='subcategory') {
			?>
			
			
			<table width="100%" border="0" style="margin-top:2px;">
			<tr>
			
			<td width="18%" style="<?php echo $d; ?> vertical-align:top; padding:10px 5px 0px 5px;">
			<span style="font-size:20px; font-weight:bold;"><?php //echo ucfirst($in[2]); ?> Categories</span><br /><br />
			<ul style="list-style-type: none;">
				<!--<li><a href="<?php //echo $in[2]; ?>" style="color:inherit;">All Products</a></li>-->
				<li><a href="<?php echo base_url(); ?>category/casket-sprays" style="color:inherit;">Casket Sprays</a></li>
				<li><a href="<?php echo base_url(); ?>category/standing-sprays" style="color:inherit;">Standing Sprays</a></li>
				<li><a href="<?php echo base_url(); ?>category/wreaths" style="color:inherit;">Wreaths</a></li>
				<li><a href="<?php echo base_url(); ?>category/hearts" style="color:inherit;">Hearts</a></li>
								
			</ul>	
			<br /><br />
			<span style="font-size:20px; font-weight:bold;"><?php //echo ucfirst($in[2]); ?> Occasions</span><br /><br />
			<ul style="list-style-type: none;">
				<li><a href="<?php echo base_url(); ?>occasion/flowers-for-service" style="color:inherit;">For Service</a></li>
				<li><a href="<?php echo base_url(); ?>occasion/flowers-for-home-and-office" style="color:inherit;">For Home & Office</a></li>
				<li><a href="<?php echo base_url(); ?>occasion/flowers-for-cremation" style="color:inherit;">For Cremation</a></li>
				
				
			</ul>	
			
			<br /><br />
			<span style="font-size:20px; font-weight:bold;">Other Collections</span><br /><br />
			<ul style="list-style-type: none;">
				<li><a href="white" style="color:inherit;">White</a></li>
				<li><a href="blue" style="color:inherit;">Blue</a></li>
				<li><a href="lavander" style="color:inherit;">Lavander</a></li>
				<li><a href="pink" style="color:inherit;">Pink</a></li>
				<li><a href="bright" style="color:inherit;">Bright</a></li>
				<li><a href="pastel" style="color:inherit;">Pastel</a></li>
				<li><a href="yellow" style="color:inherit;">Yellow</a></li>
				<li><a href="peach" style="color:inherit;">Peach</a></li>
				<li><a href="red" style="color:inherit;">Red</a></li>
				
			</ul>	
			
			
			
			</td>
			
			<td width="82%">
			
			
			
			<div class="row-fluid" style="width:110%;">
              <div class="span24">
                <div id="products">
                  <?php foreach($products as $row) : ?>    
                  <?php
                    
                      if(!isset($path) || empty($path))
                      {
                        if(!empty($row->occasion_name))
                        {
                          $upath = base_url().url_title(strtolower($row->occasion_name)).'/';
                        }
                        else
                        {
                          $upath = base_url().url_title(strtolower($row->category_name)).'/';
                        }
                        
                      }
                      else
                      {
                        $upath = base_url().$path.'/';
                      }
                  ?>
              
			  
			  
			  
			 
			  <?php if($row->price_value > 299.99 && $this->session->userdata('referer')==378){
			  
			  }else{
			  
			   if($row->alternate_text == '378'){
			   if($this->session->userdata('referer')==378){
			  ?>
                <div class="product-item text-center" style="width:159px; height:330px;" >
                  <?php if($row->custom_vase==1) : ?>
                  <div class="vasebg">
                    <img src="/images/vaseBGc.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMGc.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>
                  </div>
                  
                  <?php else : ?>
                   <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>                 
                  
                  <?php endif; ?>
                      
                    <p class="product-name" style="text-align:center; font-size:18px;"><a href="<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a></p>
                    <p class="lead"><?php echo getRate($row->price_value);?></p>
                <a href="<?php echo $upath.$row->url;?>" class="btn btn-inverse btn-mini"><?php echo lang('Order');?></a>
                
                <p class="delvinfo">
                  <?php
                
                if($row->delivery_method_id==1)
                {
                  echo lang('Same-Day Local Florist Delivery');
                }
                else
                {
                  echo lang('Shipped in a Giftbox');
                }
                
                ?>
                  
                </p>
                
                </div><!-- Product-Item //-->
					
					
				<?php	
				}else{
			   
			   
			   }
			   
			   }else{	
				?>
		
				
				<div class="product-item text-center" style="width:159px; height:330px;" >
                  <?php if($row->custom_vase==1) : ?>
                  <div class="vasebg">
                    <img src="/images/vaseBGc.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMGc.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>
                  </div>
                  
                  <?php else : ?>
                   <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>                 
                  
                  <?php endif; ?>
                      
                    <p class="product-name" style="text-align:center; font-size:18px;"><a href="<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a></p>
                    <p class="lead"><?php echo getRate($row->price_value);?></p>
                <a href="<?php echo $upath.$row->url;?>" class="btn btn-inverse btn-mini"><?php echo lang('Order');?></a>
                
                <p class="delvinfo">
                  <?php
                
                if($row->delivery_method_id==1)
                {
                  echo lang('Same-Day Local Florist Delivery');
                }
                else
                {
                  echo lang('Shipped in a Giftbox');
                }
                
                ?>
                  
                </p>
                
                </div><!-- Product-Item //-->
		
		
               <?php }} endforeach; ?>
               <div class="clear" /></div>
                </div>
            </div>
			
			</td>
			
			</tr>
			</table>
			
			
			
			<?php }else{ ?> 
			
			
			
			<div class="row-fluid" style="width:100%;" >
              <div class="span24" style="padding: 0px 0px 0px 20px;">
                <div id="products" >
                  <?php foreach($products as $row) : ?>    
                  <?php
                    
                      if(!isset($path) || empty($path))
                      {
                        if(!empty($row->occasion_name))
                        {
                          $upath = base_url().url_title(strtolower($row->occasion_name)).'/';
                        }
                        else
                        {
                          $upath = base_url().url_title(strtolower($row->category_name)).'/';
                        }
                        
                     }
                      else
                      {
                        $upath = base_url().$path.'/';
					//	echo "List wise"; 
                      }
                  ?>
              
			  
			  <?php if($row->price_value > 299.99 && $this->session->userdata('referer')==378){
			 
			  }else{
			 
			  if($row->alternate_text == '378'){
			                  if($this->session->userdata('referer')==378){
				  // echo $this->session->userdata('referer');
			  ?>
			  
                <div class="product-item text-center" style="width:16.5%;">
                  <?php if($row->custom_vase==1) : ?>
                  <div class="vasebg">
                    <img src="/images/vaseBGc.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMGc.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>
                  </div>
                  
                  <?php else : ?>
                   <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>                 
                  
                  <?php endif; ?>
                      
                    <p class="product-name" style="text-align:center;"><a href="<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a></p>
                    <p class="lead"><?php echo getRate($row->price_value);?></p>
                <a href="<?php echo $upath.$row->url;?>" class="btn btn-inverse btn-mini"><?php echo lang('Order');?></a>
                
                <p class="delvinfo">
                  <?php
                
                if($row->delivery_method_id==1)
                {
                  echo lang('Same-Day Local Florist Delivery');
                }
                else
                {
                  echo lang('Shipped in a Giftbox');
                }
                
                ?>
                  
                </p>
                
                </div><!-- Product-Item //-->
        
               <?php }else{
			   
			   
			   }
			   
			   }else{
			   
			   ?>
			   
			   
			   <div class="product-item text-center" style="width:16.5%;">
                  <?php if($row->custom_vase==1) : ?>
                  <div class="vasebg">
                    <img src="/images/vaseBGc.jpg" />
                  </div>
                  <div class="vase">
                    <?php if($vaseID>0) : ?>
                      <img src="http://cdn.vaseexpressions.com/renders/<?php echo $vaseID.'c.png'; ?>" />
                    <?php else : ?>
                    <img src="/images/vaseIMGc.png" />
                    <?php endif; ?>
                  </div>
                  <div class="vaseproduct">
                  <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumbpng');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>
                  </div>
                  
                  <?php else : ?>
                   <a href="<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>"  width="186" height="208"/></a>                 
                  
                  <?php endif; ?>
                      
                    <p class="product-name" style="text-align:center;"><a href="<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a></p>
                    <p class="lead"><?php echo getRate($row->price_value);?></p>
                <a href="<?php echo $upath.$row->url;?>" class="btn btn-inverse btn-mini"><?php echo lang('Order');?></a>
                
                <p class="delvinfo">
                  <?php
                
                if($row->delivery_method_id==1)
                {
                  echo lang('Same-Day Local Florist Delivery');
                }
                else
                {
                  echo lang('Shipped in a Giftbox');
                }
                
                ?>
                  
                </p>
                
                </div><!-- Product-Item //-->
			   
			   <?php
			   }} endforeach; ?>
               <div class="clear" /></div>
                </div>
            </div>
			
			
			
			
			
			<?php  } ?>
			
			
            </div>
			
			
			
			
                  <div class="currencyselect" style="text-align: center; margin: 10px 0; display:none;">
                     <?php echo form_open('/shop/currency',array('name'=>'setcurr')); ?>
                              <span class="setcurrency" id="setcurrency">
                                  <label><?php echo lang('Currency'); ?></label>
                                      <?php echo getCurrencyMenu('setcurr'); ?>
                              </span>
                      <?php echo form_close(); ?>
                  </div>
                  
                  <?php //if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 

<?php include_once('footer.php'); ?>
       