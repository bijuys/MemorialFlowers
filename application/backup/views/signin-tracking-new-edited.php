<?php

include_once('header.php'); ?>

<link rel="stylesheet" type="text/css" href="<?echo theme_url();?>css/reset.css">
        <div id="content-wrapper">
            <div class="content">
            <div id="main_content" class="signin" >
                 <h2><?php echo lang('Order Tracking');?></h2>
                <div class="content_wrapper clearfix">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
               
            <div class="column" width="49%" style="margin-right:30px;" >
                <h3><?php echo lang('If you are registered, please sign in:');?>?</h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open('/signin','class="login_form"'); ?>
              		<table border="0" style="position:relative; right:-130px;">
  			
  		<tr>
    		<td>  
                      <span><label witdh="40"form="username"><?php echo lang('Username:');?><input  type="text" name="username" autocomplete="off" /></label></span>
                    <?php echo form_error('username'); ?></td>
  		</tr>
   		  <tr>		 
		<td><span><label witdh="40" for="password"><?php echo lang('Password:');?><input  type="password" name="password" autocomplete="off" /></label></span>
                    <?php echo form_error('password'); ?></td>
  		 <tr>
		
		 <td>
                <input type="submit" name="submit" value="<?php echo lang('Sign-in');?>" class="submitbt" />
		</br>
             <a href="/retrieve-account">Forget your Username or Password?</a>
                </td>
                </tr>
		</table>
       
                             
                <?php echo form_close();?>
		 
              
            </div>
            <div class="column"  width="49%" style="position:relative; top:-255px; right:-480px;">
                
                <h3><?php echo lang('New Customer');?>?</h3>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <h4><big><?php echo lang("If you know your Order Number, please enter it (Web orders only):");?></big></h4>
                <p><label>Order Number:</label><input type="text" name="order_number" value="" /></p>
                <p><input type="submit" name="submit" value="<?php echo lang('Continue');?>" class="submitbt" style="float: none;" /></p>
                <?php echo form_close(); ?>
            </div>
                </div>
            </div> <!-- main -->
            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       