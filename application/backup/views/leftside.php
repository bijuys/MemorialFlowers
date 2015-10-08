<div id="left_nav" class="clearfix">
    <ul>
    <li><img src="<?php echo theme_url();?>/images/collapse.gif" name="lm1" width="12" height="12" class="lmenu" id="lm1" />Occasions
    	<ul>
     	<?php echo get_menu_entries('sidemenu1',0,'li',isset($page) ? $page->page_name:''); ?>
     	</ul>
     </li>
     <li><img src="<?php echo theme_url();?>/images/collapse.gif" name="lm1" width="12" height="12" class="lmenu" id="lm1" />Categories
     	<ul>
     	<?php echo get_menu_entries('sidemenu2',0,'li',isset($page) ? $page->page_name:''); ?>
     	</ul>
     </li>
     <li><img src="<?php echo theme_url();?>/images/collapse.gif" name="lm1" width="12" height="12" class="lmenu" id="lm1" />Pages
     	<ul>
     	<?php echo get_menu_entries('sidemenu3',0,'li',isset($page) ? $page->page_name:''); ?>
     	</ul>
     </li>
     </ul>
    
    <div id="color-wheel">
	<h3>Choose by Color</h3>
	<img src="<?php echo theme_url();?>/images/colors.png" width="150" height="195" border="0" usemap="#Map" />
<map name="Map" id="Map">
<area shape="poly" coords="93,50,99,54,103,59,112,55,122,50,128,47,133,41,135,34,135,27,132,20,127,16,120,14,113,14,106,17,101,22,97,34" href="/color/Yellow" />
<area shape="poly" coords="103,81,113,84,119,86,126,89,132,89,139,85,144,79,146,72,145,64,140,57,133,53,125,52,116,55,109,58,105,60,107,68,106,74" href="/color/Orange" />
<area shape="poly" coords="103,82,99,85,93,90,88,91,93,103,96,113,101,120,109,124,118,125,125,121,131,114,132,104,130,97,124,91" href="/color/Red" />
<area shape="poly" coords="85,92,80,93,73,93,65,90,61,102,57,110,56,118,59,126,64,131,72,134,79,134,86,130,91,125,93,119,93,110" href="/color/Pink" />
<area shape="poly" coords="61,89,57,87,52,83,49,77,42,81,32,86,24,92,20,98,20,107,22,113,26,118,32,122,38,123,44,122,51,117,54,113" href="/color/Purple" />
<area shape="poly" coords="49,60,47,65,46,71,48,75,34,83,26,86,18,86,10,82,5,76,3,70,3,64,6,57,11,52,18,49,27,50" href="/color/Blue" />
<area shape="poly" coords="51,58,55,54,60,51,65,49,57,31,50,19,38,14,28,17,21,24,19,33,20,40,23,46" href="/color/Green" />
<area shape="poly" coords="69,47,75,46,80,47,85,48,90,40,95,28,97,18,94,11,90,6,81,2,72,2,63,9,59,17,59,25" href="/color/White" />
<area shape="poly" coords="77,46" href="#" /><area shape="poly" coords="74,93,87,92,99,87,104,78,107,68,104,59,95,51,86,48,76,47,65,49,54,55,47,64,46,74,55,86" href="/products" />
</map>
    </div>
     
</div>


