<?php

include_once('header.php'); ?>
        <div id="content-wrapper" class="clearfix">
            <div class="content ">
             <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
               
             <div id="main_content" class="clearfix">
              <h2><?php echo lang('Sign-In to your Account');?></h2>  
            <div class="content_wrapper clearfix">  
            
            
          <table width="100%">
			   <tr>
			   
			   <td width="50%">
				
				<div class="column" style="margin-left:80px;">
            
            
                <h3><?php echo lang('Existing Affiliate');?></h3>
                <?php
                     if(isset($message))
                     {
                        echo '<p class="error">'.$message.'</p>';
                     }
                ?>
                <?php echo form_open(current_url(),'class="login_form"'); ?>
                <p>
                    <label form="username">Username</label>
                    <input type="text" name="username" autocomplete="off" value="" />
                    <?php echo form_error('username'); ?>
                </p>
                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" autocomplete="off" />
                    <?php echo form_error('password'); ?>
                </p>
                <p><label for="submit">&nbsp;</label>
                    <input type="submit" name="Sign In" value="Signin" class="submitbt" />
                </p>
                
                
                 <p>
                    <a href="/retrieve-account">Forget your Username or Password?</a>
                </p>
                <?php echo form_close();?>
            </div>
            </td>
            
          <td width="50%" style="veritcal-align:top;" margin-left:200px; nowrap="nowrap">
			   
				<div class="column" style="position:relative; top:-60px;" width="50%">
                
                <h3>New Affiliate?</h3><br>
                <h4><big>Don't have an account?</big></h4>
                <h4><a href="/affiliates/signup"><big>SIGNUP HERE</big></a> It's FREE</h4>
            </div>
                        <div class="center back"><p>Go back to <a href="/">Home Page</a></p></div>
                        
                        
             </td></tr></table>           
                        
            </div>
            </div> <!-- main -->

            <div id="sidebar">&nbsp;</div>
            <div class="clear"></div>
            </div> <!-- content -->
        </div> <!-- content wrapper -->
<?php include_once('footer.php'); ?>
       