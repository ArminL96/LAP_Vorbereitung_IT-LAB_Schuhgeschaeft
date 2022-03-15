<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/products_page.css">
</head>
<body>
	<?php
	$mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
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
				<li><a href='#'>Cart</a></li>
			</ul>
		</div>

	</header>
	<form method="post">
		<div id="searchbarDiv">
			<!--searchbar to search products -->
			<input id="searchbar" name="search" type="text" placeholder="Search..">
			<!--dropdown for category -->
			<select id="drop" name=”color”>
				<option value=”herren”>Herren</option>
				<option value=”damen”>Damen</option>
				<option value=”kinder”>Kinder</option>
			</select>
		</div>
		<?php
		#if search is empty
		if (empty($_POST['search'])) {
			?>
			<!--all produts output -->
			<section class="container" id="products">
				<div class="row">
					<div class="col">
						<!--the product-->
						<?php include 'product_card.php'?>
					</div>
				</div>
				<?php
			}
			#else if search is not empty
			else {
				#Read the search input field
				$input_search =  $_POST['search'];
				#sql query select all products where product name like the search input
				$sql = "SELECT * FROM product INNER JOIN category ON product.categoryId = category.id WHERE product.name LIKE '%{$input_search}%'";
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
							<a href="" class="btn btn-shopcart">Add to Card</a>
						</div>
					</div>
					<?php
				}
			}
			?>
			<footer>
				<!--the footer-->
				<?php include "footer.php"?>
			</footer>
		</body>
		</html>
