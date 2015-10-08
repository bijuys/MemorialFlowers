
<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
     
            <div id="main" class="page-content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <?php if(isset($page)) { ?> 
                <?php echo ($this->session->userdata('language')=='french') ? $page->contents_fr:$page->contents; ?>
                <?php } ?>
                <h2><?php echo lang('Customer Service');?></h2>
                
                <?php if(isset($page)) { ?> 
                <?php echo ($this->session->userdata('language')=='french') ? $page->contents_fr:$page->contents; ?>
                <?php } ?>
                
                
                
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       