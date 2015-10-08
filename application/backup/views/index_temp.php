<?php

$js=<<<JS
<script src="/js/jquery.easing.1.3.js"></script>
<script src="/js/slides.min.jquery.js"></script>
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
  <div id="homescreen">
    <div id="homenav">
    	<ul class="dropdown">
        	<?php echo get_menu_entries('welcome',1,'li',isset($page) ? $page->page_name:''); ?>
        </ul>    
    </div>
    <div id="homepresent">
      <div class="table">
      	<div class="row">
        	<div class="cell"><a href="/occasion/valentines-day"><img src="<?php echo theme_url();?>/images/<?php echo imgLang('valentines-banner-LN.jpg');?>" width="597" height="327" /></a></div>
          <div class="cell">
          	
          </div>
        </div>
      </div>
      
      <div id="slideshow">
          	<div id="slides">
				<div class="slides_container">
					<?php echo get_home_sliders(); ?>
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"> > </a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"> < </a>
			</div>
        </div><!-- Slide show //-->
      
    </div>
  </div>
  <div class="full-banner"><a href="delivery/Sameday"><img src="<?php echo theme_url();?>/images/<?php echo imgLang('homepage-sameday-LN.jpg');?>" width="975" height="55" /></a></div>
  <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
  <div id="products">
	<?php foreach($group_products as $groups) : ?>
    <?php foreach($groups->products as $row) : ?>  
    <?php $upath = str_replace(' ','-',strtolower($row->occasion_name)).'/';
	  if($upath=='/') { $upath = ''; }
    ?>
  
    <div class="product-item">
        <div class="item">
      <a href="/<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>" title="<?php echo $row->alternate_text;?>" width="186" height="208"/></a>
        <a class="product-name" href="/<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a>
        <br><span class="oprice"></span><?php echo getRate($row->price_value);?><br>
    <span class="shopnow"><a href="/<?php echo $upath.$row->url;?>"><img border="0" width="59" height="16" src="<?php echo theme_url();?>/images/<?php echo imgLang('shopnow59x16-LN.gif');?>"></a></span>
    
	<div class="delvinfo">
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
		      
	</div>   
    </div>
    </div>
   
   <?php endforeach; ?>
   <?php endforeach; ?>
    
  </div>
    
  <div class="currencyselect" style="text-align: center; margin: 10px 0;">
    
      <?php echo form_open('/shop/currency',array('name'=>'setcurr'));?>
	      <span class="setcurrency" id="setcurrency">
		  <label><?php echo lang('Currency'); ?></label>
		      <?php echo getCurrencyMenu('setcurr'); ?>
	      </span>
      <?php echo form_close(); ?>
  </div>
    
  <div class="threecolbanners">
  <?php 
  		foreach($tiles as $tile) 
		{ 
	?>
    	<a href="<?php echo $tile->link_to;?>"><div class="bannercol"><img src="/banners/<?php echo $tile->banner_file;?>" /></div></a>
		
	<?php } ?>
    <div class="clear"></div>
    
  </div>
  
    <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
  
<?php include_once('footer.php'); ?>