<div id="home">
    <div id="home_search">
        <h2><span>Need Flowers Today?</span></h2>
	<?php echo form_open('',array('name'=>'search-form', 'id'=>'search-form')); ?>
            <input type="text" name="search" id="search" value="Enter Postalcode" class="input_text" /><input type="image" src="<?php echo theme_url();?>/images/go.gif" class="input_go" />
        <?php echo form_close(); ?>
        <ul id="main_categories">
			<li><a href="https://www.memorialflowers.ca/cgi-bin/index_old.pl">Go to Old Site</a></li>
			<li><a href="/company">Company Login</a></li>
			<li><a href="/affiliates">Affiliate Login</a></li>
			<li><a href="/products">Shop Now</a></li>
        </ul>
    </div> <!-- home search -->
    <div id="slider">
        <div class="anythingSlider">
          <div class="wrapper">
            <ul>
              <?php echo get_home_sliders(); ?>
            </ul>        
          </div>          
        </div><!--anything Slider-->
        <div class="clear"></div>
    </div> <!-- slider end -->
</div> <!-- home end -->
