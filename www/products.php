<?php
	session_start();
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
	}

	#if you press the "Add to Shopcart" button the item will be saved in the Database
	//the REQUEST_METHOD check if the button was pressed
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['add_to_cart'])) {
		$idProd = $_POST['add_to_cart'];

		//query to find the cart of the user
		$sql = "SELECT cartId FROM customer WHERE cartId = '".$_SESSION['userID']."'";
		$result = $mysqli->query($sql);

		//if there is a user with the searched cardID
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//saves the cartId in $cartID
				$cartID = $row['cartId'];
			}
		}
		//now the cartitem is saved in the database
		$sql = "INSERT INTO cartitem(quantity, price, cartId, productId) VALUES ('1','1','".$cartID."', '".$idProd."')";
		$mysqli->query($sql);
	}
	?>

<!DOCTYPE html>
<html>
<head>
		<!--css file is called-->
	<link rel="stylesheet" href="style/products_style.css">
		<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>

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

		#sql query select all products where product name like the selected Value and input search
		$sql = "SELECT product.id, product.name, product.price, product.size, product.color, product.categoryid, category.name AS catName FROM product INNER JOIN category ON product.categoryId = category.id WHERE category.Name LIKE'%{$in}%' and product.name LIKE '%{$input_search}%'";
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
					<p id="nameID" name="name_item"><?php echo $row['name'];?></p>
					<div class="under">
						<p id="sizeID" name="size_item">Size: <?php echo $row['size'];?></p>
						<p id="priceID" name="price_item">Price: <?php echo $row['price'];?>€</p>
						<p id="categoryID" name="category_item">Category: <?php echo $row['catName']?></p>
					</div>
				</div>
				<div class="card-footer">
					<!-- button add to card-->
					<button type="submit" name="add_to_cart" class="button-card" value="<?php echo $row['id'] ?>">Add to cart</button>

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
