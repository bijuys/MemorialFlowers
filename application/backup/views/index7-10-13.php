<?php include_once('header.php');?>
<?php //echo $this->session->userdata('location'); ?>
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
        <div class="searchbar rounded">
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
		
		
	<script type="text/javascript" language="javascript" src="css/memorial_slider/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" language="javascript" src="css/memorial_slider/js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" language="javascript" src="css/memorial_slider/js/jquery.skitter.min.js"></script>
	
	<!-- Init Skitter -->
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('.box_skitter_large').skitter({
				theme: 'clean',
				numbers_align: 'center',
				progressbar: true, 
				dots: true, 
				preview: true
			});
		});
	</script>
		
	
	
	
	
	<?php
	$col='';
	
	if(isset($_REQUEST["col"])){
	
	//if($_REQUEST["col"]!=''){
	$colo=$_REQUEST["col"];
	}
	else
	{
	$colo='red';
	}
	//echo $colo;
	
	if($colo=='red'){
		$c1 = 'border:1px solid #A02422; background-color:#A02422; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial10.jpg';
	}else{
		$c1='';
		
	}
	
	if($colo=='white'){
		$c2 = 'border:1px solid #D9D9D9; background-color:#D9D9D9; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial2.jpg';
	}else{
		$c2='';
		
	}
	
	if($colo=='blue'){
		$c3 = 'border:1px solid #104E8B; background-color:#104E8B; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial1.jpg';
	}else{
		$c3='';
		
	}
	
	if($colo=='lavander'){
		$c4 = 'border:1px solid #8B668B; background-color:#8B668B; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial3.jpg';
	}else{
		$c4='';
		
	}
	
	if($colo=='pink'){
		$c5 = 'border:1px solid #FF82AB; background-color:#FF82AB; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial4.jpg';
	}else{
		$c5='';
		
	}
	
	if($colo=='bright'){
		$c6 = 'border:1px solid #FF7722; background-color:#FF7722; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial5.jpg';
	}else{
		$c6='';
		
	}
	
	if($colo=='pastel'){
		$c7 = 'border:1px solid #DB9EA6; background-color:#DB9EA6; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial6.jpg';
	}else{
		$c7='';
		
	}
	
	if($colo=='yellow'){
		$c8 = 'border:1px solid #FCDC3B; background-color:#FCDC3B; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial7.jpg';
	}else{
		$c8='';
		
	}
	
	if($colo=='peach'){
		$c9 = 'border:1px solid #D98719; background-color:#D98719; color:#fff; font-weight:bold; font-size:22px; text-align:center; width:95%;';
		$d = 'background-color:#D9D9D9; color:#707070;';
		$im = 'memorial8.jpg';
	}else{
		$c9='';
		
	}
	
	
	?>
		
		
		
        <div class="row-fluid" id="content" style="width:100%;">
          
          <div class="span19"style="width:100%;">
           
		   
		   
		   <table style="width:100%;">
		   
		   <tr>
		   <td style="height:20px;" width="78%">
		   
			<div style="margin-left:-25px; margin-bottom:-9px; width:100%">
			<ul style="list-style-type: none;">
			
			<li style="display: inline; font-size:16px; <?php echo $c1; ?>"><a href="?col=red" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Red&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c2; ?>"><a href="?col=white" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;White&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c3; ?>"><a href="?col=blue" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Blue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c4; ?>"><a href="?col=lavander" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lavander&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c5; ?>"><a href="?col=pink" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pink&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c6; ?>"><a href="?col=bright" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bright&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c7; ?>"><a href="?col=pastel" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pastel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c8; ?>"><a href="?col=yellow" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yellow&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			<li style="display: inline; font-size:16px; <?php echo $c9; ?>"><a href="?col=peach" style="text-decoration:none; color:inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peach&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
			
			</ul>
			</div>
		   
		   </td>
		   <td rowspan="3" style="vertical-align:top; padding:0px 0px 0px 10px;" width="22%">
		   
		   <div style="margin-top:23px;">
			<a href="occasion/flowers-for-cremation"><img src="images/smallbanner1.png" style="height:240px; width:240px;" /></a>
			<br /><br />
			<a href="occasion/flowers-for-home-and-office"><img src="images/smallbanner2.png" style="height:240px; width:240px;" /></a>
		   </div>
		   
		   </td>
		   </tr>
		   
		   
		   <tr style="margin-top:-60px;">
		   <td style="background-color:#A02422; <?php echo $d; ?> padding:10px 10px 3px 10px;">
		   
				<a href="subcategory/<?php echo $colo; ?>"><img src="images/memorial/<?php echo $colo; ?>.jpg" style="width:900px; height:435px;" /></a>
		   
		   
		   </td>
		  
		   </tr>
		   
		   <tr>
		   <td style="background-color:#A02422; padding: 0px 10px 0px 10px; font-size:25px; font-weight:bold; color:#fff; height:40px; <?php echo $d; ?>">
				
	
			
			
			
			  <a style="color:#707070; text-decoration:none;" href="subcategory/<?php echo $colo; ?>"> Memorial Flowers <?php echo ucfirst($colo); ?> Collection</a>
			
			
			
		   
		   </td>
		   
		   </tr>
		   </table>
		   
		   
            <div class="products" style="width:100%; margin:0px 0px 0px 0px;">
              <?php foreach($group_products as $groups) :
			 // print_r($groups); ?>
                <?php foreach($groups->products as $row) : ?>  
                <?php $upath = str_replace(' ','-',strtolower($row->occasion_name)).'/';
                if($upath=='/') { $upath = ''; }
                ?>

              
			  <?php if($row->price_value > 299.99){
			  
			  }else{?>
			  
			  <div class="product-item text-center" style="width:16.8%;">
                <a href="/<?php echo $upath.$row->url;?>"><img src="<?php echo img_format('productres/'.$row->product_picture, 'thumb');?>" alt="<?php
echo $row->alternate_text;?>"  title="<?php echo $row->alternate_text;?>" class="img-polaroid"></a>
                <p class="product-name" style="text-align:center;"><a href="/<?php echo $upath.$row->url;?>"><?php echo rightLang($row->product_name,$row->product_name_fr); ?></a></p>
                <p class="lead text-success"><?php echo getRate($row->price_value);?></p>
                <a href="/<?php echo $upath.$row->url;?>" class="btn btn-inverse btn-mini ">Order</a>
              
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

              </div>

				<?php } ?>

               <?php endforeach; ?>
               <?php endforeach; ?>

            </div>
          </div>
        </div>
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