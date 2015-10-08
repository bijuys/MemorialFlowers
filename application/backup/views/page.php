<?php include_once('header.php'); ?>
    <div class="content">
        <div id="main">
            <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
            <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
            <?php } ?>
            <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
            <div id="pagecontents">
                <?php echo ($this->session->userdata('language')=='french') ? $page->contents_fr:$page->contents; ?>
            </div>
        </div> <!-- main -->
    </div> <!-- content -->
<?php include_once('footer.php'); ?>
       