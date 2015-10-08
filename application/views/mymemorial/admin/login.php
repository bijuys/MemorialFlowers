<?php

include_once('../includes/user.class.php');

if($_POST)
{
	if(isset($_POST['username']) && isset($_POST['password'])) 
	{
		$user = new User();
		if($user->login($_POST))
		{
			header("Location: index.php\n\n");
			exit;				
		}
		else
		{
			$message = '<div class="error" style="text-align:center;">Username or Password is Invalid!</div>';			
		}
	}
	else
	{
		$message = '<div class="error" style="text-align:center;">Username or Password is Invalid!</div>';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php include_once('headers.php'); ?>
</head>
<body>
<div id="header-wrapper">
<div id="header" class="clearfix">
    <h1><a href="index.php"><img src="images/logo.gif" width="259" height="70" border="0" /></a></h1>
  <div id="main-menu">

  </div><!-- Main-Menu //-->
  </div><!-- Header //-->
</div><!-- Header-Wrapper //-->
<div id="wrapper">
  <div id="contents" style="height:400px;">
    <div id="login-window">
	<div class="page-title">
		<h1>Login</h1>
	</div>
      <p>&nbsp;</p>
      <form id="form1" name="form1" method="post" action="login.php">
      <?php if(isset($message)) { echo $message; } ?>
        <p><label for="username">Username</label>
          <input type="text" name="username" id="username" value="<?php if($_POST) { echo $_POST['username']; } ?>" />
        </p>
        <p><label for="password">Password</label>
          <input type="password" name="password" id="password" />
        </p>
        <p><label>&nbsp;</label>
          <input type="submit" name="submit" id="submit" value="Login" />
        </p>
      </form>
      <p>&nbsp;</p>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div id="footer">MemorialFlowers.com</div>
</body>
</html>
