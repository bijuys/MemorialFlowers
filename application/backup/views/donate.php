<?php include_once('header.php');?>

  <div id='homebox' style="height:220px;">
        <div class="row-fluid" style="height:220px;">
          <div class="span4" style="height:220px;">
            <div id="sidemenu" class="rounded">
              <ul>
                <?php echo get_menu_entries('welcome',1,'li',isset($page) ? $page->page_name:''); ?>
              </ul>
            </div>
          </div>
		  
          <div class="span20" id="welcomeimg" style="height:220px;">
            <div class="part1" style="height:220px;">
              <img src="<?php echo theme_url();?>/images/welcome-image.jpg" style="height:220px; width:750px;" />
            </div>
            <div class="part2" style="height:220px;">
                  <div id="myCarousel" class="carousel slide">
                      <?php echo get_home_sliders(); ?>
                  </div>
            </div>
          </div>
        </div>
      </div><!-- Homebox //-->

      <div id="contents">
        <div class="searchbar rounded" style="display:none;">
          <div class="row-fluid">
            <div class="span10">
              <div class="orderbyphone">
                Order by Phone : 1-877-537-8610
              </div>
            </div>
            <div>
              <?php echo form_open('/search',array('class'=>'form-inline pull-right')); ?>
                <label for="search">Can't find a product? </label>
                <div class="input-append">
                  
                  <input type="text" name="search" class="input" placeholder="Enter a keyword" />
                  <input type="submit" class="btn btn-inverse" value="SEARCH" />
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
	
		<br />
	
		<h2>Memorial Flowers Donation Causes </h2>
	
		<?php //echo $d_id; ?>
		<br />
	
		<table width="100%" border="0">
		
			<tr height="220">
			
				<td width="2%">
				
				</td>
				
				<td width="2%">
				
					<a href="http://www.cbcf.org/ontario/GetInvolved/Donate/Pages/default.aspx" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/can-breast-cancer-foundation.jpg" />
					</a>
				
				</td>
				
				<td width="4%">
				
				</td>
				
				<td width="2%">
				
					<a href="https://secure.e2rm.com/registrant/memoriam.aspx?eventid=39119" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/ovarian-cancer-canada.jpg" />
					</a>
				
				</td>
				
				<td width="2%">
				
				</td>
			
			</tr>
			
			<tr height="220">
			
				<td width="2%">
				
				</td>
				
				<td width="2%">
				
					<a href="http://www.heartandstroke.com/site/c.ikIQLcMWJtE/b.3479069/k.1A2C/Donate_to_the_Heart_and_Stroke_Foundation.htm" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/heart-and-stroke-foundation.jpg" />
					</a>
				
				</td>
				
				<td width="4%">
				
				</td>
				
				<td width="2%">
				
					<a href="https://www.kidney.ca/SSLPage.aspx?pid=1185" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/kidney-foundation.jpg" />
					</a>
				
				</td>
				
				<td width="2%">
				
				</td>
			
			</tr>
			
			
			<tr height="220">
			
				<td width="2%">
				
				</td>
				
				<td width="2%">
				
					<a href="http://madd.ca/madd2/en/giving/giving_donate_now_memoriam.html" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/madd.jpg" />
					</a>
				
				</td>
				
				<td width="4%">
				
				</td>
				
				<td width="2%">
				
					<a href="http://www.sickkidsfoundation.com/donate/" target="_blank">
						<img src="<?php echo base_url();?>/images/donate/sick-kids.jpg" />
					</a>
				
				</td>
				
				<td width="2%">
				
				</td>
			
			</tr>
		
		</table>
		
		
		
        
      </div>
<script>
// Load this when the DOM is ready
$(function(){
  // You used .myCarousel here. 
  // That's the class selector not the id selector,
  // which is #myCarousel
  $('#myCarousel').carousel();
});
</script>
<?php include_once('footer.php'); ?>