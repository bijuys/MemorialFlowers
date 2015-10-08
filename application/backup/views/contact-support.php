<?php include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content"><?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
<?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
                
            <div id="main" class="page-content">
                
                <h2><?php echo lang('Contact Support');?></h2>
                
                <?php echo form_open('',array('name'=>'customer-service','id'=>'support-contact')); ?>
                    
                    <p><label><?php echo lang('Your Email Address');?></label>
                        <input type="text" name="email" size="35" />
                    </p>
                    <p><label><?php echo lang('Order No.');?></label>
                        <input type="text" name="order-number" />
                    </p>
                    
                    <p><label><?php echo lang('Order date.');?></label>
                        <input type="text" name="order-day" size="3" />/
                        <input type="text" name="order-month" size="3" />/
                        <input type="text" name="order-year" size="5" />
                    </p>
                    
                    <p><label><?php echo lang('Your Firstname');?></label>
                        <input type="text" name="firstname" size="35" />
                    </p>
                    
                    <p><label><?php echo lang('Your Lastname');?></label>
                        <input type="text" name="lastname" size="35" />
                    </p>
                    
                    <p><label><?php echo lang('Your phone number');?></label>
                        <input type="text" name="phone-number" />
                    </p>
                    
                    <p><label><?php echo lang('Recipient Firstname');?></label>
                        <input type="text" name="rfirstname" size="35" />
                    </p>
                    
                    <p><label><?php echo lang('Recipient Lastname');?></label>
                        <input type="text" name="rlastname" size="35" />
                    </p>
                    
                    <p><label><?php echo lang('Select a Category');?></label>
                        <input type="text" name="category" />
                    </p>
                    
                    <p><label><?php echo lang('Comments');?></label>
                        <textarea name="order-number" rows="5" cols="35"></textarea>
                    </p>
                    
                    <p><label>&nbsp;</label>
                        <input type="submit" name="submit"  value="Submit" />
                    </p>    
                    
                <?php echo form_close(); ?>
                
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       