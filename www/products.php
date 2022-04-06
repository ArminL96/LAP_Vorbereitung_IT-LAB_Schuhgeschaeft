<!DOCTYPE html>
<html>
<head>
	<!-- scripts and stylesheets for the popup box -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<!--favicon and own css-->
	<link rel="stylesheet" href="style/products_style.css">
	<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
	
</head>
<form method="post">
<?php
	//prevents the document from expiring
	ini_set('session.cache_limiter', 'private');
	session_start();
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
	}

	#if you press the "Add to Shopcart" button the item will be saved in the Database
	//the REQUEST_METHOD check if the button was pressed
	if (isset($_POST['add_to_cart'])) {
		$idProd = $_POST['add_to_cart'];

		//query to find the cart of the user
		$sql = "SELECT cartId FROM customer WHERE id = '".$_SESSION['userID']."'";
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

	
		<div id="searchbarDiv">
			<!--searchbar to search products -->
			<input id="searchbar" name="search" type="text" placeholder="Search..">

			<!--this button prevents the 'add to cart'-button to be pressed when the user pressed enter to search an article in the searchbar-->
			<button style="display:none"></button>

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
		$sql = "SELECT product.id, product.name, product.price, product.size, product.color, product.categoryid, product.description, category.name AS catName FROM product 
				INNER JOIN category ON product.categoryId = category.id WHERE category.Name LIKE'%{$in}%' and product.name LIKE '%{$input_search}%'";
		$result = $mysqli->query($sql);
		#goes through each column of the Product table
		while($row = mysqli_fetch_assoc($result)){
			?>
			<div class="article-card">
				<?php
				//Important: the image name must match the product name in the database
				//deletes all spaces from the string
				//takes the name and description of the product out of database
				$description = $row['description'];
				$name = $row['name'];
				$name = str_replace(' ', '', $name);
				$description = str_replace(' ', '', $description);
				//output of the picture from the product and description if theres no picture found
				echo "<img src='img/$name.jpg' alt="?><?php echo $description;?><?php echo">";
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
				//if the got redirectet from the order-page the SESSION variable is true and a "order confirmed" popup shows up
				$orderd = $_SESSION["order_confirm"];
				if (isset($orderd) AND $orderd == 1) {
					echo '<script type="text/javascript">toastr.success("Order confirmed!")</script>';
					$_SESSION["order_confirm"] = false;
			
				}
		}
		?>
	</form>
	<footer>
		<!--the footer-->
		<div class="container-footer"> 
		<a href="impressum.php"><p>Impressum</p></a>
		</div>
	</footer>
</body>
</html>
