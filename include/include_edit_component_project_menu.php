<?php
class AddMenuProj {
	public function MenuProj() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$owner	=	$_SESSION['SESS_MEMBER_ID'];
		$id 	= 	(int)$_GET['edit'];

		$ProjectNameQuery = "SELECT * FROM projects ORDER by project_name ASC";
		$sql_exec_projname = mysqli_query($GLOBALS["___mysqli_ston"], $ProjectNameQuery);

		$CategoryName = "SELECT * FROM projects_data WHERE component_id = ".$id;
		$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

		while ($Project = mysqli_fetch_array($sql_exec_projname)) {
			echo '<option ';

			while($showDetailsCat = mysqli_fetch_array($sql_exec_catname)) {
				$projid = $showDetailsCat['project_id'];
			}

			if (isset($projid)) {
				if($projid == $Project['project_id']){
					echo 'selected ';
				}
			}

			echo 'value="';
			echo $Project['project_id'];
			echo '">';
			echo $Project['project_name'];
			echo '</option>';
		}
	}
}
?>
