<html>
<head>
<title>Administrator Login</title>
</head>
<body>
	<?php echo form_open('/siteadmin/login'); ?>
		<div  style="margin-top: 150px; text-align:center;">
		&nbsp;
		<?php if(isset($error)) { echo '<p style="color:red;">'.$error.'</p>'; } ?>
                        
                        
		</div>
<table border="0" cellpadding="5" cellspacing="0" align="center">
	<thead>
		<tr><th colspan="2">Administrator Login</th></tr>
	</thead>
	<tbody>
	<tr>
		<td>Username</td><td><input type="text" value="" autocomplete="off" name="uname" /><?php echo form_error("uname"); ?></td>
	</tr>
	<tr>
		<td>Password</td><td><input type="password" value="" autocomplete="off" name="pword" /><?php echo form_error("pword"); ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td><td><input type="submit" value="Login" name="submit" /></td>
	</tr>
	</tbody>
	</form>
</table>
</body>
</html>
