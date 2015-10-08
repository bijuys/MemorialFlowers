				<div id="footer">
					<div class="row-fluid">
						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer1',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer2',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer3',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span4">
							<?php echo get_menu_entries_with_heading('footer4',1,'',isset($page) ? $page->page_name:''); ?>
						</div>

						<div class="span8">
							<h4>Signup for Special Offers</h4>
							
							

							<?php echo form_open('/support/subscribe');?>
								<div class="input-append">

									<input type="text" name="email" placeholder="Enter Email Address" class="input-large" />
									<input type="submit" name="submit" value="Signup" class="btn btn-inverse" />
								</div>
							<?php echo form_close(); ?>
							<p>
							<img src="<?php echo theme_url();?>/images/memorial-name.png" /></p>
							<p>Order by Phone: <strong><big>1-877-537-8610</big></strong></p>


						</div> <!-- Span8 //-->

					</div><!-- Row Fluid //-->
			</div><!-- Footer //-->
			<div class="copyright text-center">
				&copy; 2007-2013 MemorialFlowers.ca All rights are reserved.
			</div><!-- Copyright //-->
	</div><!-- Wrapper //-->
</div><!-- Container //-->
<div id="mask"></div>
<?php if(isset($footer)) { echo $footer; } ?>
</body>
</html>
<!--
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker( "option", "dateFormat", ' );
    
  });
  </script>-->