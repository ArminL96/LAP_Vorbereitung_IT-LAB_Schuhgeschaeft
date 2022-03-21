<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/products_page.css">
		<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
	<?php
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
	}
	?>
	<!--Header-->
	<header class="header-container">
		<?php include "header.php"?>
		<div class='header-child2'>
			<ul>
				<!--Buttons for log out, userprofile, Cart-->
				<li><a href='login.php'>Log out</a></li>
				<li>
					<a href='userprofile.php'>My Profile</a>
				</li>
				<li><a href='cart.php'>Cart</a></li>
			</ul>
		</div>
	</header>

	<form method="post">
		<div id="searchbarDiv">
			<!--searchbar to search products -->
			<input id="searchbar" name="search" type="text" placeholder="Search..">
				<p id="category-title">Category</p>
			<select  type="submit" name="category-selection" id="drop" onchange="form.submit()">
				<option value=""></option>
				<option value="herren">Herren</option>
				<option value="damen">Damen</option>
				<option value="kinder">Kinder</option>

				<?php
				$in = "";
				#Read the inputs form searchbar and dropdown
				$input_search =  $_POST['search'];
				$selectedValue = $_POST['category-selection'];

				#query of the selection
				if ($selectedValue == 'herren') {
					$in = "herren";
				}
				if ($selectedValue == 'damen') {
					$in = "damen";
				}

				if ($selectedValue == 'kinder') {
					$in = "kinder";
				}
				?>
			</select>
		</div>
		<?php
		#checks if one input input is empty
		if(empty($input_search))
		{
			#if one query is empty, the command of the other is queried
			#sql query select all products where product name like the selected Value input
			$sql = "SELECT * FROM product INNER JOIN category ON product.categoryId = category.id WHERE category.Name LIKE'%{$in}%'";
		}

		if(empty($selectedValue))
		{
			#sql query select all products where product name like the search input
			$sql = "SELECT * FROM product INNER JOIN category ON product.categoryId = category.id WHERE product.name LIKE '%{$input_search}%'";
		}
		$result = $mysqli->query($sql);
		#goes through each column of the Product table
		while($row = mysqli_fetch_assoc($result)){
			?>
			<div class="article-card">
				<?php
				//Important: the image name must match the product name in the database
				//deletes all spaces from the string
				$name = $row['name'];
				$name = str_replace(' ', '', $name);
				//output of the image with the same name as the name of the product
				echo "<img src= img/$name.jpg>"
				?>
				<div class="article-body">
					<!-- output data products: name, size, price, category-->
					<p id="name"><?php echo $row['name'];?></p>
					<div class="under">
						<p id="size">Size: <?php echo $row['size'];?></p>
						<p id="price">Price: <?php echo $row['price'];?>€</p>
						<p id="category">Category: <?php echo $row['Name']?></p>
					</div>
				</div>
				<div class="card-footer">
					<!-- button add to card-->
					<a href="" class="button-card">Add to Card</a>
				</div>
			</div>
			<?php
		}
		?>
	</form>
	<footer>
		<!--the footer-->
		<div class="container-footer"></div>
	</footer>
</body>
</html>
