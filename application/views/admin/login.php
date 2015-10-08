<html>
<head>
<title>Administrator Login</title>
</head>
<link href="<?php echo theme_url();?>/css/login.css" rel="stylesheet" type="text/css" />

<body style="background-color:#000;">
	<div style="margin:0 0 0 0;">
	<?php echo form_open('/siteadmin/login'); ?>
		



<table width="100%">
<tr>
<td width="35%">
</td>
<td width="50%">
<img src="<?php echo base_url();?>/images/admin_logo.png" />
</td>
<td width="15%">
</td>
</tr>


<tr>
<td>
</td>
<td>
<div id="login-box">

<H2>Login</H2>

<?php if(isset($error)) { echo '<p style="color:red;">'.$error.'</p>'; } ?>
<table>
<tr>
<td>
<div id="login-box-name" style="margin-top:20px;">Username:<br />
<input type="text" value="" autocomplete="off" name="uname" size="20" maxlength="1000" />
<span style="color:red;"><?php echo form_error("uname"); ?> </span> 
</div>
</td>
</tr>
<tr>
<td>
<div id="login-box-name">Password:<br />
<input type="password" value="" autocomplete="off" name="pword" size="20" maxlength="1000" />
<span style="color:red;"><?php echo form_error("pword"); ?> </span>
</div>
</td>
</tr>
</table>
<br />
<span style="text-align:center;cursor:hand;"><input type="submit" value="Login Now" class="myButton" name="submit" /></span><br />







</div>

</td>

<td>
</td>
</tr>
</table>

</form>
</div>
</body>
</html>
