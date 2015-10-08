<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
            <?php include_once('leftside.php');?>
            <div id="main" >
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <h2>Affiliate Integration Code</h2>
                <small class="title_description">Please fill in your information</small>
                <?php echo validation_errors() ? '<div id="messenger" class="error">Please correct Errors</div>':'';  ?>
                <?php echo form_open_multipart(current_url()); ?>
                <div class="entry_page">
                    <div class="wide_form" style="text-align:center;">
                    <h4>Your Website Settings</h4>
                    <p>Plain Link<br/>
                        <textarea cols="60" rows="2">&lt;a href=&quot;http://www.memorialflowers.ca/aff=<?php echo $user->user_id;?>&quot;&gt;My FlowerSite&lt;/a&gt;</textarea>
                    </p>
                    <p>As IFrame<br/>
                        <textarea cols="60" rows="2">&lt;iframe src=&quot;http://www.memorialflowers.ca/aff=<?php echo $user->user_id;?>&quot; width=&quot;100%&quot; height=&quot;800&quot;&gt;
  &lt;p&gt;Your browser does not support iframes.&lt;/p&gt;
&lt;/iframe&gt;</textarea>
                    </p>
                    <p><a href="/myaccount">Back to My Account</a></p>
                    
                    </div><!-- common_form-->
                    <div class="clear"></div>
                </div> <!-- delivery_details -->
                <?php echo form_close(); ?>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       