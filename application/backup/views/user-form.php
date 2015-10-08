<?php include_once('header.php'); ?>
            <div class="content">
		
		 <?php if(isset($page) && strlen($page->banner_file)>5) { ?>
                <img src="/banners/<?php echo $page->banner_file;?>" class="bannerimage" />
                <?php } ?>
                <?php if(isset($page) && !empty($page->h1)) { echo '<h1>'.rightLang($page->h1,$page->h1_fr).'</h1>'; } ?>
  <?php if(isset($page) && $page->content_position=='top') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
       
            <div id="main_content">
               
                <h2><?php echo lang('Signup for an Account, Its FREE!');?></h2>
		                <?php 
                    if(validation_errors())
                    {
                        echo '<div id="messenger" class="error">'.lang('Fields marked with a * are required.').'</div>';   
                    }
                    ?>
		<div class="row-fluid">
		    
		    <div class="span12 offset6">
			 <h3><?php echo lang('Enter Account Information');?></h3>
		                            <div class="form-warning">
                            <?php echo lang('Fields marked with (*) are mandatory.'); ?>
                       </div>
			 <?php echo form_open(current_url(),'class="form-horizontal"'); ?>
			 
			 <div class="control-group">
			    <label for="username" class="control-label"><?php echo lang('Username');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="username" id="username" value="<?php echo $_POST ? $p->username:(isset($user) ? $user->username:'');?>" autocomplete="off" />
				<?php echo form_error("username"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="password" class="control-label"><?php echo lang('Password');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="password" name="password" id="password" value="<?php echo $_POST ? $p->password:(isset($user) ? $user->password:'');?>" autocomplete="off" />
				<?php echo form_error("password"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="password2" class="control-label"><?php echo lang('Confirm Password');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="password" name="password2" id="password2" value="<?php echo $_POST ? $p->password2:(isset($user) ? $user->password2:'');?>" />
				<?php echo form_error("password2"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="email" class="control-label"><?php echo lang('Email');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="email" id="email" value="<?php echo $_POST ? $p->email:(isset($user) ? $user->email:'');?>" size="30" />
				<?php echo form_error("email"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="firstname" class="control-label"><?php echo lang('Firstname');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="firstname" id="firstname" value="<?php echo $_POST ? $p->firstname:(isset($user) ? $user->firstname:'');?>" size="30" />
				<?php echo form_error("firstname"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="lastname" class="control-label"><?php echo lang('Lastname');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="lastname" id="lastname" value="<?php echo $_POST ? $p->lastname:(isset($user) ? $user->lastname:'');?>" size="30" />
				<?php echo form_error("lastname"); ?>
			    </div>
			</div>
    
    
			<div class="control-group">
			    <label for="address1" class="control-label"><?php echo lang('Address Line 1');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="address1" id="address1" value="<?php echo $_POST ? $p->address1:(isset($user) ? $user->address1:'');?>" size="30" />
				<?php echo form_error("address1"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="address2" class="control-label"><?php echo lang('Address Line 2');?></label>
			    <div class="controls">
				<input type="text" name="address2" id="address2" value="<?php echo $_POST ? $p->address2:(isset($user) ? $user->address2:'');?>" size="30" />
				<?php echo form_error("address2"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="postalcode" class="control-label"><?php echo lang('Postal Code');?></label>
			    <div class="controls">
				<input type="text" name="postalcode" id="postalcode" value="<?php echo $_POST ? $p->postalcode:(isset($user) ? $user->postalcode:'');?>" size="10" />
				<?php echo form_error("postalcode"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="city" class="control-label"><?php echo lang('City');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="city" id="city" value="<?php echo $_POST ? $p->city:(isset($user) ? $user->city:'');?>" />
				<?php echo form_error("city"); ?>
			    </div>
			</div>
			
			<div class="control-group">
			    <label for="province" class="control-label"><?php echo lang('Province/State');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<select name="province" id="province">
				    <?php echo province_options(isset($_POST) ? $_POST['province']:''); ?>
				</select>
			    <?php echo form_error("province"); ?>
			    </div>
			</div>
		       <div class="control-group">
			    <label for="country_id" class="control-label"><?php echo lang('Country');?><span class="mandatory">*</span></label>
			    <div class="controls"><select name="country_id" id="country_id" style="width: 150px;">
				<?php echo country_options(isset($_POST) ? $_POST['country_id']:''); ?>
				</select>
				<?php echo form_error("country_id"); ?>
			    </div>
			</div>
		       <div class="control-group">
			    <label for="dayphone" class="control-label"><?php echo lang('Day Phone');?><span class="mandatory">*</span></label>
			    <div class="controls">
				<input type="text" name="dayphone" id="dayphone" value="<?php echo $_POST ? $p->dayphone:(isset($user) ? $user->phone1:'');?>" />
				<?php echo form_error("dayphone"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <label for="evephone" class="control-label"><?php echo lang('Evening Phone');?></label>
			    <div class="controls">
				<input type="text" name="evephone" id="evephone" value="<?php echo $_POST ? $p->evephone:(isset($user) ? $user->phone2:'');?>" />
				 <?php echo form_error("evephone"); ?>
			    </div>
			</div>
			<div class="control-group">
			    <div class="controls">
				<input type="submit" name="Signup" id="signup" value="<?php echo lang('Signup');?>" class="submitbt"/>
				<input type="reset" name="Reset" id="reset" value="Reset" class="resetbt"/>
			    </div>
			</div>
			<p class="text-center">
								    <small><?php echo lang('Your FREE account will be registered by submitting this form.');?></small>                    
			</p>
			<?php echo form_close(); ?>
		    </div><!-- Span12 //-->
		    
		</div><!-- Row Fluid //-->
		
            </div> <!-- main -->
  <?php if(isset($page) && $page->content_position=='bottom') { echo '<div id="pagecontents">'.rightLang($page->contents,$page->contents_fr).'</div>'; } ?> 
            </div> <!-- content -->
<?php include_once('footer.php'); ?>

       
