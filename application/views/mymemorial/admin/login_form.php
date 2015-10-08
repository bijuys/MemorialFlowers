<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
<title>MemorialFlowers Admin Dashboard</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<div id="header-wrapper">
<div id="header" class="clearfix">
    <h1><a href="index.php"><img src="<?php echo base_url();?>/images/logo.png" border="0" /></a></h1>

  <span id="clock"></span>
  </div><!-- Header //-->
</div><!-- Header-Wrapper //-->
<div id="wrapper">
  <div id="contents" class="clearfix">
    <div id="main" class="clearfix" style="width: 100%;">
      <div class="page-title">
        <h1>Login to Administration Section</h1>
      </div>
      <div id="content" class="clearfix">
        <div id="login-window" class="shadow">
          <h1>Administrator Login</h1>
          <form action="<?php echo base_url().'admin/sessions/authenticate';?>" method="post">
          <?php if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
            <p><label for="username">Username</label>
              <input type="text" name="username" size="30" value="<?php if($_POST) { echo $_POST['username']; } ?>" id="username" />
            </p>
            <p>
              <label for="password">Password</label>
              <input type="password" name="password" size="30" value="" id="password" />
            </p>
            <p><label>&nbsp;</label>
              <input type="submit" name="submit" value="Admin Login" class="button" />
            </p>
          </form>
        </div>       
      </div>
</div>
 <div class="clear"></div>
  </div><!-- Contents //-->
</div><!--wrapper//-->
<div id="footer" class="clearfix">MemorialFlowers.com</div>
</body>
</html>
