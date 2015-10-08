<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <div id="main" style="width:980px;" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>

                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>

            <div class="centered">
            <h2><?php echo lang('Thank you');?></h2>
            <p><?php echo lang('Thank you for Contacting us');?></p>
            <p>&nbsp;</p>
            <p><small><a href="<?php echo site_url();?>"><?php echo lang('Back to Home');?></a></small></p>
            </div>
            
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
<?php die();?>
       