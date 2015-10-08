<?php include_once('header.php'); ?>
            <div class="content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
            <div id="main_content">
                
                <h2><?php echo lang('Sign-In to your Account');?></h2>
                
                <div class="row-fluid">
                    
                    <div class="span12">
                        <h3 class="text-center"><?php echo lang('Are You an Existing Customer');?>?</h3>
                        <?php
                             if(isset($message))
                             {
                                echo '<p class="error center" style="text-align: center">'.$message.'</p>';
                             }
                        ?>
                        <?php echo form_open(current_url(),'class="form-horizontal"'); ?>
                        <div class="control-group">
                            <label form="username" class="control-label"><?php echo lang('Username');?></label>
                            <div class="controls">
                                <input type="text" name="username" autocomplete="off" />
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="password" class="control-label"><?php echo lang('Password');?></label>
                            <div class="controls">
                                <input type="password" name="password" autocomplete="off" />
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="signin" value="<?php echo lang('Sign In');?>" class="btn btn-large btn-inverse"><?php echo lang('Sign In');?></button>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <div class="controls">
                                <a href="/retrieve-account">Forget your Username or Password?</a>
                            </div>
                        </div>
                        
                        <?php echo form_close();?>
                    </div>
                    
                    <div class="span12 text-center">
                        <h3><?php echo lang('Are You a New Customer');?>?</h3>
                        <h4><big><?php echo lang("Don't have an account");?>?</big> <br/><a href="/signup"><big><?php echo lang('SIGNUP HERE');?></big></a> <br /> <?php echo lang("It's FREE");?></h4>
                    </div>
                    
                    
                    
                </div>
                                    
                    <div class="text-center"><p><?php echo lang('Go back to');?> <a href="/"><?php echo lang('Home Page');?></a></p></div>

            </div> <!-- main -->
  <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
            </div> <!-- content -->
<?php include_once('footer.php'); ?>
       