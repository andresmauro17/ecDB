<?php
	require_once('include/login/auth.php');
	require_once('include/debug.php');

	require_once('include/mysql_connect.php');
	include_once("include/include_parse_admin_options.php");

	if($_SESSION['SESS_IS_ADMIN'] == 0)
	{
		header("location: index.php");
		exit();
	}

	$executesql = array();
	$executesql['opt_blog_tab_show'] = $opt_blog_tab_show;
	$executesql['opt_blog_tab_title'] = $opt_blog_tab_title;
	$executesql['opt_blog_tab_url'] = $opt_blog_tab_url;
	$executesql['opt_register_tab_show'] = $opt_register_tab_show;
	$executesql['opt_donate_tab_show'] = $opt_donate_tab_show;

?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Viwe all your added components."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Home - ecDB</title>
		<?php include_once("include/analytics.php") ?>

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		  <link rel="stylesheet" href="/resources/demos/style.css">
		  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		  <script>
		  $( function() {
		    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		    $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  } );
		  </script>
	</head>
	<body>
		<div id="wrapper">
			<!-- Header -->
			<?php include 'include/header.php'; ?>
			<!-- END -->
			<!-- Main menu -->
			<?php include 'include/menu.php'; ?>
			<!-- END -->
			<!-- Main content -->
			<div id="content">
				<div class="subMenu">

					<form class="globalForms" method="post" action="">

						<div class="textInput">
							<label class="keyWord">Project name</label>
							<div class="input"><input name="init" id="datepicker" type="text" class="medium"/></div>
						</div>

						<div class="textInput">
							<label class="keyWord">Project name</label>
							<div class="input"><input name="init" id="datepicker2" type="text" class="medium"/></div>
						</div>						
						<div class="buttons">
							<div class="input">
								<button class="button green" name="submit" type="submit"><span class="icon medium eye"></span> ver</button>
							</div>
						</div>
					</form>

				



				</div>
				<p>mundo</p>
				<table class="globalTables" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>
							</th>
							<th>
								<a >id</a>
							</th>
							<th>
								<a >who_id</a>
							</th>
							<th>
								<a >data_id</a>
							</th>
							<th>
								<a >name</a>
							</th>
							<th>
								<a >past_qty</a>
							</th>
							<th>
								<a >actual_qty</a>
							</th>
							<th>
								<a >past_$</a>
							</th>
							<th>
								<a >actual_$</a>
							</th>
							<th>
								<a >past_order</a>
							</th>
							<th>
								<a >actual_order</a>
							</th>
							<th>
								<a >was_deleted</a>
							</th>
							<th>
								<a >was_created</a>
							</th>
							<th>
								<a >was_updated</a>
							</th>
							<th>
								<a >date_operation</a>
							</th>


<!-- 
							<th>
								<a href="?by=name&order=<?php
								if(isset($_GET['order'])){
									$order = $_GET['order'];
									if ($order == 'asc'){
										echo 'desc';
									}
									else {
										echo 'asc';
									}
								}
								else {
									echo 'desc';
								}
								?>">Name</a>
							</th>

							<th>
								Image
							</th> -->

						</tr>
					</thead>
					<tbody>
					<?php
						include('include/include_track_data.php');

						$Index = new ShowComponents;
						$Index->Index();
					?>
					</tbody>
				</table>
			</div>
	
		</div>


	</body>
<?php include 'include/footer.php'; ?>

</html>
