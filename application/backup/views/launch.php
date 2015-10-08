<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Memorial Flowers</title>
</head>
<link href="<?php echo theme_url();?>/css/bootstrap.css" rel="stylesheet" />


<?php
$affiliate_comp=$this->session->userdata('referer');
//$this->session->set_userdata('logo') = $aff_id->user_logo;



if($affiliate_comp!='' && $affiliate_comp!=5886352)
{
	//echo "admin"; ?>
<link href="<?php echo theme_url();?>/css/style_affilliate.css" rel="stylesheet" />
<?php }
else { ?>
<link href="<?php echo theme_url();?>/css/style.css" rel="stylesheet" />
<?php }?>

<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">

<body class="intro">
	<div class="container">
		<div class="header">
			<div class="row">
				<div class="span10 offset14">
					<div class="topmenu pull-right">
						Registered? <a href="<?php echo base_url(); ?>mymemorial/sessions/login">Sign In</a> | <a href="#">Register here</a>
					</div>
				</div>
			</div>
		</div>
		<div class="welcome">
			<div class="row">
				<div class="span10">
					<div class="logo-div" style="margin-top:-50px;">
						<h5>
							<?php
							//echo $this->session->set_userdata('referer');
							
							if($this->session->userdata('referer') != '' && $this->session->userdata('referer')!=5886352){ ?>
							<?php //echo "admin"; ?>
								<img src="<?php echo theme_url(); ?>/images/affiliates_logo/<?php echo $aff_id->user_logo; ?>">	
								<?php //echo $affiliate_comp=$this->session->userdata('referer');
							
							//echo '<br /><br />';
						 ?>
						<div style="text-align:center; font-weight:bold; font-size:20px;">
						Served by  <br /><img src="<?php echo theme_url();?>/images/logo_2.png" width="280" height="75" />
                        </div>
								
							<?php }else{ ?>
							<div style="margin-top:50px;">
								<img src="<?php echo theme_url();?>/images/memorial-logo.png" />
								</div>
							<?php }
							?>
							

						
                        </h5>
					</div>
				</div>
				<div class="span14">
					<ul class="strips pull-right">
                    
                   
						<li><a href="#"><img src="<?php echo theme_url();?>/images/strip1.jpg" /></a></li>
						<li><a href="#"><img src="<?php echo theme_url();?>/images/strip2.jpg" /></a></li>
						<li><a href="#"><img src="<?php echo theme_url();?>/images/strip3.jpg" /></a></li>
						<li><a href="#"><img src="<?php echo theme_url();?>/images/strip4.jpg" /></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="start">
			<div class="row">
				<div class="span10">
					<div class="start-block"> 
						<h3>Select a Destination</h3>
						<p>Where you want to ship the item?</p>
					</div>
				</div>
				<div class="span7">
					<div class="start-block">
						<h3><img src="<?php echo theme_url();?>/images/canada.png" /> Canada</h3>
						<div class="input-append">
							<?php echo form_open('/location',array('class'=>'form-inline')); ?>
						    <select name="location" class="span5" />
                            
						    	<?php echo country_provinces(1);?>
							</select>
							<input class="btn btn-inverse" type="submit" value="Go!" />
							<?php echo form_close();?>
						</div>
					</div>
				</div>
				<div class="span7">
					<div class="start-block">
						<h3><img src="<?php echo theme_url();?>/images/usa.png" /> USA</h3>
						<div class="input-append">
							<?php echo form_open('/location',array('class'=>'form-inline')); ?>
						    <select name="location" class="span5" />
						    	<?php echo country_provinces(2);?>
							</select>
							<input class="btn btn-inverse" type="submit" value="Go!" />
							<?php echo form_close();?>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="welcome-text text-center">
			<p>Here at Memorial Flowers .ca we offer beautiful time tested traditional designs for the immediate family, close relatives, friends and business associates. Our floral deliveries are prompt, handled with care and professionally presented.</p>
		</div>

		<div class="copyright">
			<p class="text-center">&copy; 2007-2013 MemorialFlowers.ca All rights are reserved.
			</p>
		</div>
	</div>
</body>
</html>