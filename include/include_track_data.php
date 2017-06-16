<?php
class ShowComponents {
	public function Index()
	{
		require_once('login/auth.php');
		include('mysql_connect.php');

		$owner = $_SESSION['SESS_MEMBER_ID'];
		$is_admin = $_SESSION['SESS_IS_ADMIN'];
		//$qry = "SELECT id, name, category, package, pins, datasheet, url1, smd, price, quantity, comment, bin_location FROM data WHERE owner = ".$owner." ORDER by ";
		$qry = "SELECT d.id, d.who_id, d.data_id, d.name, d.past_quantity, d.actual_quantity, d.past_price, d.actual_price, d.past_order_quantity, d.actual_order_quantity, d.was_deleted, d.was_created, d.was_updated, d.date_operation FROM track_data d";

		$GetDataComponentsAll = $qry;
		$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $GetDataComponentsAll);

		while($showDetails = mysqli_fetch_array($sql_exec))
		{
			echo "<tr>";
				echo '<td class="edit">';
					if ($is_admin === $_SESSION['SESS_IS_ADMIN'])
					{
						echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
					}
					else
					{
						echo '&nbsp;';
					}
				echo '</td>';

				echo '<td>';
				echo $showDetails['id'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['who_id'];
				echo "</td>";

				echo '<td><a href="component.php?view=';
				echo $showDetails['data_id'];
				echo '">';
				echo $showDetails['data_id'];
				echo "</a></td>";

				echo '<td>';
				echo $showDetails['name'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['past_quantity'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['actual_quantity'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['past_price'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['actual_price'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['past_order_quantity'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['actual_order_quantity'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['was_deleted'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['was_created'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['was_updated'];
				echo "</td>";

				echo '<td>';
				echo $showDetails['date_operation'];
				echo "</td>";





				
			echo "</tr>";
		}

	}

	public function Category()
	{
		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		$owner = $_SESSION['SESS_MEMBER_ID'];
		$is_admin = $_SESSION['SESS_IS_ADMIN'];

		if(isset($_GET['cat']))
		{
			$cat = (int)$_GET['cat'];

			$CategoryName = "SELECT * FROM category_sub WHERE category_id = ".$cat."";
			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

			if(isset($_GET['by'])) {

				$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
				$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

				if($order_q == 'desc' or $order_q == 'asc') {
					$order = $order_q;
				}
				else {
					$order = 'asc';
				}

				if($by == 'price' or $by == 'pins' or $by == 'quantity')
				{
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.category_id = ".$cat." ORDER by ".$by." +0 ".$order."";
				}
				elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd')
				{
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.category_id = ".$cat." ORDER by ".$by." ".$order."";
				}
				else
				{
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.category_id = ".$cat." ORDER by name ASC";
				}
			}
			else
			{
				$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.category_id = ".$cat." ORDER by name ASC";
			}

			$sql_exec_component = mysqli_query($GLOBALS["___mysqli_ston"], $ComponentsCategory);

			while ($showDetails = mysqli_fetch_array($sql_exec_component)) {
				echo "<tr>";

				echo '<td class="edit">';
				if ($is_admin === $_SESSION['SESS_IS_ADMIN'])					
				{
					echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
				}
				else
				{
					echo '&nbsp;';
				}
				echo '</td>';

				echo '<td><a href="component.php?view=';
				echo $showDetails['id'];
				echo '">';
				echo $showDetails['name'];
				echo "</a></td>";

				echo "<td>";
				$subcatid = $showDetails['category'];

				$CategoryName = "SELECT * FROM category_sub WHERE id = ".$subcatid."";
				$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

				while($showDetailsCat = mysqli_fetch_array($sql_exec_catname)) {
					$catname = $showDetailsCat['subcategory'];
				}

				echo "<a href='category.php?subcat=$subcatid'>$catname</a>";
				echo "</td>";

				echo "<td>";
				$package = $showDetails['package'];
					if ($package == ""){
						echo "-";
					}
					else{
						echo $package;
					}
				echo "</td>";

				echo "<td>";
				$pins = $showDetails['pins'];
					if ($pins == ""){
						echo "-";
					}
					else{
						echo $pins;
					}
				echo "</td>";

				echo '<td>';
				$image = $showDetails['url1'];
				if ($image==""){
					echo "-";
				}
				else{
					echo '<a class="thumbnail" href="';
					echo $image;
					echo '"><span class="icon medium picture"></span><span class="imgB"><img src="';
					echo $image;
					echo '" /></span></a></td>';
				}

				echo '<td>';
				$datasheet = $showDetails['datasheet'];
				if ($datasheet==""){
					echo "-";
				}
				else{
					echo '<a href="';
					echo $datasheet;
					echo '" target="_blank"><span class="icon medium document"></span></a></td>';
				}

				echo "<td>";
				$smd = $showDetails['smd'];
					if ($smd == "No"){
						echo '<span class="icon medium checkboxUnchecked"></span>';
					}
					else{
						echo '<span class="icon medium checkboxChecked"></span>';
					}
				echo "</td>";

				echo "<td class='priceCol'>";
				$price = $showDetails['price'];
					if ($price == ""){
						echo "-";
					}
					else{
						echo $price;
					}
				echo "</td>";

				echo "<td>";
				$quantity = $showDetails['quantity'];
					if ($quantity == ""){
						echo "-";
					}
					else{
						echo $quantity;
					}
				echo "</td>";

				echo '<td>';
				$bin_location = $showDetails['bin_location'];
				if ($bin_location == "")
				{
					echo "-";
				}
				else
				{
					echo $bin_location;
				}
				echo '</td>';

				$comment = $showDetails['comment'];
				if ($comment == ""){
					echo '<td class="comment"><div>';
					echo "-";
					echo '</span></div></td>';
				}
				else{
					echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
					echo $showDetails['comment'];
					echo '</span></div></td>';
				}
				echo "</tr>";
			}
		}


		if(isset($_GET['subcat']))
		{
			$subcat = (int)$_GET['subcat'];

			$CategoryName = "SELECT * FROM category_sub WHERE id = ".$subcat."";
			$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

			if(isset($_GET['by'])) {

				$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
				$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

				if($order_q == 'desc' or $order_q == 'asc') {
					$order = $order_q;
				}
				else {
					$order = 'asc';
				}

				if($by == 'price' or $by == 'pins' or $by == 'quantity') {
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.id = ".$subcat." ORDER by ".$by." +0 ".$order."";
				}
				elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd') {
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.id = ".$subcat." ORDER by ".$by." ".$order."";
				}
				else {
					$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.id = ".$subcat." ORDER by name ASC";
				}
			}
			else {
				$ComponentsCategory = "SELECT d.id, d.name, d.category, d.package, d.pins, d.datasheet, d.url1, d.smd, d.price, d.quantity, d.comment, d.bin_location FROM data d, category_sub c WHERE d.category = c.id and c.id = ".$subcat." ORDER by name ASC";
			}

			$sql_exec_component = mysqli_query($GLOBALS["___mysqli_ston"], $ComponentsCategory);

			while ($showDetails = mysqli_fetch_array($sql_exec_component)) {
				echo "<tr>";

				echo '<td class="edit">';
				if ($is_admin === $_SESSION['SESS_IS_ADMIN'])
				{
					echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
				}
				else
				{
					echo '&nbsp;';
				}
				echo '</td>';

				echo '<td><a href="component.php?view=';
				echo $showDetails['id'];
				echo '">';
				echo $showDetails['name'];
				echo "</a></td>";

				echo "<td>";
					while($showDetailsCat = mysqli_fetch_array($sql_exec_catname)) {
						$catname = $showDetailsCat['subcategory'];
					}
					echo $catname;
				echo "</td>";

				echo "<td>";
				$package = $showDetails['package'];
					if ($package == ""){
						echo "-";
					}
					else{
						echo $package;
					}
				echo "</td>";

				echo "<td>";
				$pins = $showDetails['pins'];
					if ($pins == ""){
						echo "-";
					}
					else{
						echo $pins;
					}
				echo "</td>";

				echo '<td>';
				$image = $showDetails['url1'];
				if ($image==""){
					echo "-";
				}
				else{
					echo '<a class="thumbnail" href="';
					echo $image;
					echo '"><img src="img/picture.png" /><span class="imgB"><img src="';
					echo $image;
					echo '" /></span></a></td>';
				}

				echo '<td>';
				$datasheet = $showDetails['datasheet'];
				if ($datasheet==""){
					echo "-";
				}
				else{
					echo '<a href="';
					echo $datasheet;
					echo '" target="_blank"><img src="img/document.png" alt="Download PDF"/></a></td>';
				}

				echo "<td>";
				$smd = $showDetails['smd'];
					if ($smd == "No"){
						echo '<img src="img/checkbox_unchecked.png">';
					}
					else{
						echo '<img src="img/checkbox_checked.png">';
					}
				echo "</td>";

				echo "<td class='priceCol'>";
				$price = $showDetails['price'];
					if ($price == ""){
						echo "-";
					}
					else{
						echo $price;
					}
				echo "</td>";

				echo "<td>";
				$quantity = $showDetails['quantity'];
					if ($quantity == ""){
						echo "-";
					}
					else{
						echo $quantity;
					}
				echo "</td>";

				echo '<td>';
				$bin_location = $showDetails['bin_location'];
				if ($bin_location == "")
				{
					echo "-";
				}
				else
				{
					echo $bin_location;
				}
				echo '</td>';

				$comment = $showDetails['comment'];
				if ($comment == ""){
					echo '<td class="comment"><div>';
					echo "-";
					echo '</span></div></td>';
				}
				else{
					echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
					echo $showDetails['comment'];
					echo '</span></div></td>';
				}
				echo "</tr>";
			}
		}
	}

	public function Search()
	{

		if(isset($_GET['q']))
		{
			require_once('include/login/auth.php');
			include('include/mysql_connect.php');

			$owner = $_SESSION['SESS_MEMBER_ID'];
			$is_admin = $_SESSION['SESS_IS_ADMIN'];

			$query = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['q']);
			$query1 = strtoupper($query);
			$query2 = strip_tags($query1);
			$find = trim($query2);


			if ($find == "") {
				echo '<div class="message red">';
					echo "You forgot to enter a search term.";
				echo '</div>';
			}
			else {


				if (isset($_GET['by'])){
					$by			=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["by"]));
					$order_q	=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET["order"]));

					if($order_q == 'desc' or $order_q == 'asc')
					{
						$order = $order_q;
					}
					else
					{
						$order = 'asc';
					}

					if($by == 'price' or $by == 'pins' or $by == 'quantity')
					{
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') ORDER by $by +0 $order";
					}
					elseif($by == 'name' or $by == 'category' or $by =='package' or $by =='smd' or $by =='manufacturer') {
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') ORDER by $by $order";
					}
					else
					{
						$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') ORDER by name ASC";
					}
				}
				else
				{
					$SearchQuery = "SELECT * FROM data WHERE (name LIKE'%$find%' OR package LIKE'%$find%' OR manufacturer LIKE'%$find%' OR pins LIKE'%$find%' OR location LIKE'%$find%' OR comment LIKE'%$find%') ORDER by name ASC";
				}

				$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $SearchQuery);
				$anymatches = mysqli_num_rows($sql_exec);
				if ($anymatches == 0) {
					echo '<div class="message red">';
						echo "Sorry, but we can not find an entry to match your query.";
					echo '</div>';
				}

				while($showDetails = mysqli_fetch_array($sql_exec)) {
					echo "<tr>";

					echo '<td class="edit">';					
					if ($is_admin === $_SESSION['SESS_IS_ADMIN'])
					{
						echo '<a href="edit_component.php?edit='.$showDetails['id'].'"><span class="icon medium pencil"></span></a>';
					}
					else
					{
						echo '&nbsp;';
					}
					echo '</td>';

					echo '<td><a href="component.php?view=';
					echo $showDetails['id'];
					echo '">';

					echo $showDetails['name'];
					echo "</a></td>";

					echo "<td>";
						$head_cat_id = $showDetails['category'];

						$CategoryName = "select c.name h, c.id cid, cs.subcategory s, cs.id csid from category c, category_sub cs where c.id = cs.category_id and cs.id = ".$head_cat_id."";
						//$CategoryName = "SELECT * FROM category_head WHERE id = ".$head_cat_id."";
						$sql_exec_catname = mysqli_query($GLOBALS["___mysqli_ston"], $CategoryName);

						while($showDetailsCat = mysqli_fetch_array($sql_exec_catname))
						{
							$catname = $showDetailsCat['h'];
						}

					echo $catname;
					echo "</td>";

					echo "<td>";
					$manufacturer = $showDetails['manufacturer'];
						if ($manufacturer == ""){
							echo "-";
						}
						else{
							echo $manufacturer;
						}
					echo "</td>";

					echo "<td>";
					$package = $showDetails['package'];
						if ($package == ""){
							echo "-";
						}
						else{
							echo $package;
						}
					echo "</td>";

					echo "<td>";
					$pins = $showDetails['pins'];
						if ($pins == ""){
							echo "-";
						}
						else{
							echo $pins;
						}
					echo "</td>";

					echo '<td>';
					$image = $showDetails['url1'];
					if ($image==""){
						echo "-";
					}

					else{
						echo '<a class="thumbnail" href="';
						echo $image;
						echo '"><span class="icon medium picture"></span><span class="imgB"><img src="';
						echo $image;
						echo '" /></span></a></td>';
					}

					echo '<td>';
					$datasheet = $showDetails['datasheet'];
					if ($datasheet==""){
						echo "-";
					}
					else{
						echo '<a href="';
						echo $datasheet;
						echo ' target="_blank""><span class="icon medium document"></span></a></td>';
					}

					echo "<td>";
					$smd = $showDetails['smd'];
						if ($smd == "No"){
							echo '<img src="img/checkbox_unchecked.png">';
						}
						else{
							echo '<img src="img/checkbox_checked.png">';
						}
					echo "</td>";

					echo "<td  class='priceCol'>";
					$price = $showDetails['price'];
						if ($price == ""){
							echo "-";
						}
						else{
							echo $price;
						}
					echo "</td>";

					echo "<td>";
					echo $showDetails['quantity'];
					echo "</td>";

					$comment = $showDetails['comment'];
					if ($comment == ""){
						echo '<td class="comment"><div>';
						echo "-";
						echo '</span></div></td>';
					}
					else{
						echo '<td class="comment"><div><span class="icon medium spechBubbleSq"></span><span class="comment">';
						echo $showDetails['comment'];
						echo '</span></div></td>';
					}
					echo "</tr>";
				}
			}
		}
	}
	public function Add() {

		require_once('include/login/auth.php');
		include('include/mysql_connect.php');

		if(isset($_POST['submit']) or isset($_POST['update'])) {
			$owner = $_SESSION['SESS_MEMBER_ID'];
			$is_admin = $_SESSION['SESS_IS_ADMIN'];
			if (empty($_GET['edit'])) {
				$id				=	'';
			}
			else{
				$id				= 	(int)$_GET['edit'];
			}

			if (empty($_POST['name'])) {
				$name = '';
			}
			else{
				$name			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['name']));
			}

			if (empty($_POST['quantity'])) {
				$quantity = 0;
			}
			else{
				$quantity			=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['quantity'])));
			}

			if (empty($_POST['category'])) {
				$category = '';
			}
			else{
				$category		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['category']));
			}

			if (empty($_POST['project'])) {
				$project = '';
			}
			else{
				$project		=	strip_tags(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['project']));
			}

			$comment			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['comment']));
			$order_quantity		=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['orderquant'])));
			$project_quantity	=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['projquant'])));
			$price				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['price'])));
			$location			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bin_location']));
			$manufacturer		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['manufacturer']));
			$package			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['package']));
			$pins				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['pins'])));
			$scrap				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['scrap']));
			$smd				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['smd']));
			$width				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['width'])));
			$height				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['height'])));
			$depth				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['depth'])));
			$weight				=	str_replace(',', '.', strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['weight'])));
			$datasheet			=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['datasheet']));
			$url1				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url1']));
			$url2				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url2']));
			$url3				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url3']));
			$url4				=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['url4']));

			$bin_location		=	strip_tags( mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['bin_location']));



			if ($name == '') {
				echo '<div class="message red">';
				echo 'You have to specify a name!';
				echo '</div>';
			}
			elseif ($category == '') {
				echo '<div class="message red">';
				echo 'You have to choose a category!';
				echo '</div>';
			}
			elseif (!empty($project_quantity) && empty($project)) {
				echo '<div class="message red">';
				echo 'You have to choose a project!';
				echo '</div>';
			}
			elseif (!empty($project) && empty($project_quantity)) {
				echo '<div class="message red">';
				echo 'You have to specify a quantity for this component to add to the project!';
				echo '</div>';
			}
			elseif (strlen($comment) >= 2500) {
				echo '<div class="message red">';
				echo 'Max 2500 characters in the comment!';
				echo '</div>';
			}
			elseif (!empty($_POST['quantity']) && !is_numeric($quantity)) {
				echo '<div class="message red">';
				echo 'The quantity must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['pins']) && !is_numeric($pins)) {
				echo '<div class="message red">';
				echo 'The pin-count must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['price']) && !is_numeric($price)) {
				echo '<div class="message red">';
				echo 'The price must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['orderquant']) && !is_numeric($order_quantity)) {
				echo '<div class="message red">';
				echo 'The order quantity must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['weight']) && !is_numeric($weight)) {
				echo '<div class="message red">';
				echo 'The weight must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['width']) && !is_numeric($width)) {
				echo '<div class="message red">';
				echo 'The width must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['depth']) && !is_numeric($depth)) {
				echo '<div class="message red">';
				echo 'The depth must only be a number!';
				echo '</div>';
			}
			elseif (!empty($_POST['height']) && !is_numeric($height)) {
				echo '<div class="message red">';
				echo 'The height must only be a number!';
				echo '</div>';
			}
			else {
				if(isset($_POST['submit'])) {
					$sql="INSERT into data (owner, name, manufacturer, package, pins, smd, quantity, location, scrap, width, height, depth, weight, datasheet, comment, category, url1, url2, url3, url4, price, order_quantity, bin_location)
					VALUES
					('$owner', '$name', '$manufacturer', '$package', '$pins', '$smd', '$quantity', '$location', '$scrap', '$width', '$height', '$depth', '$weight', '$datasheet', '$comment', '$category', '$url1', '$url2', '$url3', '$url4', '$price', '$order_quantity', '$bin_location')";

					$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
					$component_id = ((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

					


					$sql = " INSERT INTO track_data (who_id,data_id,name,past_quantity,actual_quantity,past_price,actual_price,past_order_quantity,actual_order_quantity,was_deleted,was_created,was_updated)
						VALUES 
						('$owner','$component_id','$name',0,'$quantity',0,'$price',0,'$order_quantity','0','1','0');";


					$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);






					if (!empty($project) && !empty($project_quantity)) {
						$proj_add="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
							VALUES
							('$owner', '$project', '$component_id', '$project_quantity')";

						$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add);
					}

					/*------------------------------------------------------------------------------------------
					$proj =	$_POST['project'];

					foreach ($proj as $quantity){
						$project = array_search($quantity, $proj);
						//echo $quantity;	// Quantity
						//echo ' - ';
						//echo $project;	// Project ID.
						//echo ' <br />';
						if ($quantity == 0){
							echo 'None';
						}
						else{
							$proj_add="INSERT into projects_data (owner_id, project_id, component_id, quantity)
							VALUES
							('$owner', '$project', '$component_id', '$quantity')";

							$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add);

							echo 'Inserted';
						}
					}
					------------------------------------------------------------------------------------------*/

					echo '<div class="message green center">';
					echo 'Component added! - <a href="component.php?view=';
					echo $component_id;
					echo '">View component (';
						$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT name FROM data WHERE id = '$component_id'");
						$name = mysqli_fetch_array($result);
						echo $name['name'];
					echo ')</a>';
					echo '</div>';
				}

				if(isset($_POST['update'])) {
					$sql = "UPDATE data SET
					name = '$name', manufacturer = '$manufacturer', package = '$package', pins = '$pins', smd = '$smd', quantity = '$quantity', location = '$location',	scrap = '$scrap', width = '$width', height = '$height', depth = '$depth', weight = '$weight', datasheet = '$datasheet', comment = '$comment', category = '$category', url1 = '$url1', url2 = '$url2',  url3 = '$url3', url4 = '$url4', price = '$price', order_quantity = '$order_quantity', bin_location = '$bin_location'	WHERE id = '$id'";

					$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);


					
					$quantity_before	= $_POST['quantity_before'];
					$quantity_after=$quantity;

					$price_before	= $_POST['price_before'];
					$price_after=$price;

					$order_quanty_before	= $_POST['orderquant_before'];
					$order_quanty_after=$order_quantity;

					if ($quantity_before != $quantity_after or $price_before != $price_after or $order_quanty_before != $order_quanty_after ) {

						$sql = " INSERT INTO track_data (who_id,data_id,name,past_quantity,actual_quantity,past_price,actual_price,past_order_quantity,actual_order_quantity,was_deleted,was_created,was_updated)
						VALUES 
						('$owner','$id','$name','$quantity_before','$quantity_after','$price_before','$price_after','$order_quanty_before','$order_quanty_after','0','0','1');";



						$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
						
					}

					

					if (!empty($project) && !empty($project_quantity)) {
						$proj_add="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
							VALUES
							('$owner', '$project', '$id', '$project_quantity')";

						$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_add) or die(((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
						echo $project;
						echo ' Owner ';
						echo $owner;
						echo ' id ';
						echo $id;
						echo ' projquant ';
						echo $project_quantity;
					}

					if (isset($_POST['projquantedit'])) {
						$proj =	$_POST['projquantedit'];

						foreach ($proj as $quantity_proj_add){
							$projects = array_search($quantity_proj_add, $proj);
							$sqlDeleteProject = "DELETE FROM projects_data WHERE projects_data_component_id = '$id' AND projects_data_project_id = '$projects'";
							$sql_exec_project_delete = mysqli_query($GLOBALS["___mysqli_ston"], $sqlDeleteProject);

							if ($quantity_proj_add == 0){
								echo 'None';
							}
							else{
								$proj_edit="INSERT into projects_data (projects_data_owner_id, projects_data_project_id, projects_data_component_id, projects_data_quantity)
								VALUES
								('$owner', '$projects', '$id', '$quantity_proj_add')";

								$sql_exec = mysqli_query($GLOBALS["___mysqli_ston"], $proj_edit);

								/*
								echo 'Projid: ';
								echo $project;
								echo ' Quantity: ';
								echo $quantity;
								echo ' Id: ';
								echo $id;
								echo '<br>';
								*/
							}
						}
					}
					header("location: " . $_SERVER['REQUEST_URI']);
				}
			}
		}
	}
}
?>

