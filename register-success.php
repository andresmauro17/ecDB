<?php
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Login - ecDB</title>
		<?php include_once("include/analytics.php") ?>
	</head>

	<body>
		<div id="wrapper">

			<?php require_once("include/logo_wrapper.php"); ?>

			<!-- Main menu -->
			<?php $selected_menu = "Login"; include_once('include/include_main_menu.php'); ?>
			<!-- END -->

			<!-- Main content -->
			<div id="content">

				<h1>Registration success</h1>

				<b>Please login</b><br /><br />

				<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
					<table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
						<tr>
							<td width="112">Login</td>
							<td width="188"><input name="login" type="text" class="textfield" id="login" /></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input name="password" type="password" class="textfield" id="password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="Submit" value=" Login " /></td>
						</tr>
					</table>
				</form>
			</div>
			<!-- END -->

			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->

		</div>
	</body>
</html>
