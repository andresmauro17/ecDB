<?php
	//Start session
	session_start();

	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_IS_ADMIN']);
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");
?>
<!DOCTYPE HTML>
<html>
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
				<div class="message green center">
					You have successfully signed out of your account.
				</div>

				<div class="loginWrapper">
					<div class="left">
						<div class="aboutECDB">
							You want to build something and need some components for your project.
							You don't know if you have those components, or where they are.
							This is a problem many of us recognise.
							We want to change that for you by making a online inventory system for your electronic components that is easy to use.
							Add your components. Search to find it, and then use it!
						</div>
						<form class="globalForms" name="loginForm" method="post" action="login-exec.php">
							<div class="textInput">
								<label class="keyWord">Username</label>
								<div class="input"><input name="login" class="medium" type="text" id="login"/></div>
							</div>
							<div class="textInput">
								<label class="keyWord">Password</label>
								<div class="input"><input name="password" class="medium" type="password" id="password"/></div>
							</div>
							<div class="buttons">
								<div class="input">
									<button class="button green" name="Submit" type="submit"><span class="icon medium key"></span> Login</button>
								</div>
							</div>
						</form>
					</div>
					<div class="right"></div>
				</div>


			</div>
			<!-- END -->

			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->

		</div>
	</body>
</html>

