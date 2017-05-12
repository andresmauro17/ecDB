<?php
	$db_host = "www.mdo.net.co";
	$db_username = "isotronica";
	$db_pass = "1s0tr0n1c4";
	$db_name = "inventario";

	($GLOBALS["___mysqli_ston"] = mysqli_connect($db_host,  $db_username,  $db_pass)) or die ("Could not connect connect to MySQL Server");
	((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE $db_name")) or die ("No database");
	mysqli_set_charset($GLOBALS["___mysqli_ston"], 'utf8');
?>
