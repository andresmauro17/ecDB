<?php
	require_once('include/debug.php');
	require_once('include/login/auth.php');
	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="sv" lang="sv">
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Terms & Privacy - ecDB</title>
		<?php include_once("include/analytics.php") ?>

	<body>
		<div id="wrapper">
<?php
if(isset($_SESSION['SESS_MEMBER_ID'])==true)
{
?>
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
<?php
}
else
{

			include_once("include/include_parse_admin_options.php");
			require_once("include/logo_wrapper.php");
			?>

			<!-- Main menu -->
			<?php $selected_menu = "Terms"; include_once('include/include_main_menu.php'); ?>
			<!-- END -->
<?php
}
?>
			<div id="content">
				<h1>Terms and Conditions & Privacy Policy</h1>

					<h2>1. Terms</h2>

					By accessing this web site, you are agreeing to be bound by these web site Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this web site are protected by applicable copyright and trademark law.<br /><br />

					<h2>2. Membership</h2>

					As a condition to using the services you are required to register with ecDB. By registering with ecDB you certify that you always provide valid, and updated information, you are an individual (i.e., not a corporate entity) and that you have the legal rights to enter such an agreement. The ID and password (from now referred to as "login-data") is the sole responsibility. It is required that you, as a registered ecDB user maintain the safety of your own login-data.<br /><br />

					The System owner maintains the right to terminate your membership at any time, with or without motivation or warning. All members are responsible for the consequences of use of this website. In cases of conflict with one or more non-members or members, will ecDB not be liable for any damages caused, in the current situation or future, resulting from the conflict.<br /><br />

					As a registered ecDB user you warrant and agree to the fact that you will not contribute any content that (a) infringes, violates or otherwise interferes with any copyright or trademark of another party, (b) reveal any trade secret, unless you own the trade secret or has the owner’s permission to post it, (c) infringes any intellectual property right of another or the privacy or publicity rights of another, (d) is libelous, defamatory, abusive, threatening, harassing, hateful, offensive or otherwise violates any law or right of any third party.<br /><br />

					<h2>3. Disclaimer</h2>

					ecDB reserves all rights and disclaims all liability. ecDB makes no guarantee of reliability, safety or operation of this site.<br />
					As a registered user, you have full responsibility, without contradiction, for the information you publish and make widely available here.<br /><br />

					<h2>4. Ownership</h2>

					This project is open source, have at it!<br /><br />

					<h2>Privacy Policy</h2>

					ecDB handles your personal information in accordance with the European data protection laws.<br /><br />

					Third parties can get access to all the information you intended to make public through your settings. Your email address or other personal data is NEVER shared by us to third parties.
			</div>
				<!-- END -->
				<!-- Text outside the main content -->
					<?php include 'include/footer.php'; ?>
				<!-- END -->
		</div>
	</body>
</html>
