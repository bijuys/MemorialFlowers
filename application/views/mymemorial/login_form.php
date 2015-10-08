<?php include_once(APPPATH.'views/mymemorial-top.php'); ?>

	 <div class="container">
		<div id="page" class="row">
			<div class="col-lg-4">
			
			</div>
			<div class="col-lg-4">
				
				<br /><br />
				
				<h2 class="text-center" style="font-size:20px;"><?php echo lang('Enter Login Info');?></h2>
				<br />
				
				<?php echo form_open('/mymemorial/sessions/authenticate',array('class'=>'form-horizontal')); ?>
				
					<div class="control-group">
						<label class="control-label"><?php echo lang('Username');?></label>
						<div class="controls">
							<input type="text" name="username" value="<?php echo $_POST ? $_POST['username']:'';?>" size="30" style="width:100%;" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php echo lang('Password');?></label>
						<div class="controls">
							<input type="password" name="password" value="" size="30" style="width:100%;" />
						</div>
					</div>
					<div class="control-group text-center">
						<br />
						<button type="submit" class="btn btn-primary">Log In &nbsp; <i class="fa fa-arrow-circle-right"></i></button>
					</div>
								
				</form>
				
			</div>
			<div class="col-lg-4">
			
			</div>
		</div>
	 </div>

                       
<?php //include_once(APPPATH.'views/footer.php'); ?>