<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>

                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>

            <div class="centered">
            <h2><?php echo lang('Track your Order!');?></h2>
            <div id="ttp_embed">
                <?php echo form_open(current_url()); ?>
                <input type="text" name="trackingcode" value="" />
                <input type="submit" name="submit" value="Track" />
                <?php echo form_close(); ?>
            </div>
            
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
<?php die();?>
       