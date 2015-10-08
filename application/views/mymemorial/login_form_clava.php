<?php 
include_once('application/views/header_clava.php');
?>	
	<section class="wrapper">
		
		<section class="content about">
			<div class="container">
				
				<div class="row sub_content">
				
					<div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="dividerLatest">
							<h2><?php echo lang('Affiliates Login');?></h2>	
							<div class="gDot"></div>
						</div>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12">
                    
                    <div id="login_wrapper" class=" pager">
                                           <div class="login-error">
                            <?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
                    </div>
                        <?php echo form_open('/mymemorial/sessions/authenticate',array('class'=>'form-horizontal', 'style'=> 'width: 400px;')); ?>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('Username');?></label>
                                <div class="controls">
                                    <input type="text" name="username" value="<?php echo $_POST ? $_POST['username']:'';?>" style="width: 300px;"   />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('Password');?></label>
                                <div class="controls">
                                    <input type="password" name="password" value="" size="30" style="width: 300px;" />
                                </div>
                            </div>
                             <div class="control-group">
                             <label style="width: 180px; padding: 5px 5px 5px 30px;" class="checkbox">
                                        <input style="width: 25px; margin-left: 10%;" name="remember" value="1" type="checkbox"><?php echo lang('Remember me');?>                                    </label>
                                
                            </div>                           
                            
                            
                            
                            <div class="control-group">
                                <div class="controls">
                                   
                                    <button type="submit" name="submit" class="btn btn-danger btn-large" ><?php echo lang('Login');?></button>
                                    <p><br/>Forgot Password? <a href="<?php echo base_url().'contact';?>"><?php echo lang('Contact us');?></a></p>
                                    
                                    <?php //echo $_SERVER['HTTP_REFERER'] ; ?>
                                </div>
                            </div>
                          <?php echo form_close();?>  
                                      
                    </div>
						
					</div>
				
					

						
					
					
                    
				</div>
				
				
			</div>
		</section>			
		
	</section>
	<!--end wrapper-->
	
<?php include_once('application/views/footer_clava.php'); ?>