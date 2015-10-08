<?php

include_once('header.php'); ?>
        <div id="content-wrapper">
            <div class="content">
                 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
            <div id="main_content" class="signin" >
                 <h2><?php echo lang('Order Tracking');?></h2>
                <div class="content_wrapper clearfix">
               
			   
			   <table width="100%">
			   <tr>
			   
			   <td width="50%">
				
				<div class="column" style="margin-left:80px;">
                <h3><?php echo lang('If you are registered, please sign in:');?>?</h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open('/signin','class="login_form"'); ?>
                <p>
                    <label form="username"><?php echo lang('Username');?></label>
                    <input type="text" name="username" autocomplete="off" />
                    <?php echo form_error('username'); ?>
                </p>
                <p>
                    <label for="password"><?php echo lang('Password');?></label>
                    <input type="password" name="password" autocomplete="off" />
                    <?php echo form_error('password'); ?>
                </p>
                <p><label for="submit">&nbsp;</label>
                    <input type="submit" name="submit" value="<?php echo lang('Sign-in');?>" class="submitbt" />
                </p>
                
                   <p>
                    <a href="/retrieve-account">Forget your Username or Password?</a>
                </p>
                   
                   
                <?php echo form_close();?>
            </div>
				
			   </td>
			   
			   <td width="50%" style="veritcal-align:top;" margin-left:200px; nowrap="nowrap">
			   
				<div class="column" style="position:relative; top:-50px;" width="50%">
                
                <h3><?php echo lang('New Customer');?>?</h3>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <h4><big><?php echo lang("If you know your Order Number, please enter it (Web orders only):");?></big></h4>
                <p><label>&nbsp;</label><input type="text" name="order_number" value="" /></p>
                <p><input type="submit" name="submit" value="<?php echo lang('Continue');?>" class="submitbt" style="float: none;" /></p>
                <?php echo form_close(); ?>
            </div>
			   
			   </td>
			   
			   </tr>
			   </table>
			   
            
            
                </div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>

  <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       