<?php

// $header = file_get_contents("http://www.memorialflowers.ca/system/application/views/header.php");







// $header = ereg_replace("<!--con-->",$str,$header);
// echo $header;
 include_once('header.php'); ?>

        <div id="content-wrapper">
            <div class="content">
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Contact us</h2>
				
				
						<!-- Codes by Quackit.com -->
		<script type="text/javascript">
		// Popup window code
		
		</script>
		
		

				
                <?php echo $page->contents;?>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       