<?php include_once(APPPATH.'views/header.php'); ?>
            <div class="content">
                <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" width="570" height="60" />
                <?php } ?>
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
                <div id="main_content">
                    <h1><?php echo lang('Affiliates Login');?></h1>
                    <div class="login-error">
                            <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
                    </div>
                    <div id="login_wrapper">
                        <h3><?php echo lang('Enter Login Info');?></h3>
                        <?php echo form_open('/mymemorial/sessions/authenticate',array('class'=>'form-horizontal')); ?>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('Username');?></label>
                                <div class="controls">
                                    <input type="text" name="username" value="<?php echo $_POST ? $_POST['username']:'';?>" size="30"  />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('Password');?></label>
                                <div class="controls">
                                    <input type="password" name="password" value="" size="30" />
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" value="1" /> <?php echo lang('Remember me');?>
                                    </label>
                                    <button type="submit" name="submit" class="btn btn-inverse btn-large" ><?php echo lang('Login');?></button>
                                    <p><br/>Forgot Password? <a href="<?php echo base_url().'contact';?>"><?php echo lang('Contact us');?></a></p>
                                </div>
                            </div>
                            
                        </form>              
                    </div>
                </div> <!-- Main Content //-->
            </div>            
<?php include_once(APPPATH.'views/footer.php'); ?>