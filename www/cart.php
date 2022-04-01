<?php
	session_start();
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
	}
	
	//"function" for the remove button
	//REQUEST_METHOD checks if the button was pressed
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['delete_from_shopcart'])) {
		//This ID of the CartItem is saved in the value of their remove button
		$idProd = $_POST['delete_from_shopcart'];
		
		//there we find the Cart ID of the currently logged in user
		$sql = "SELECT cartId FROM customer WHERE cartId = '".$_SESSION['userID']."'";
		$result = $mysqli->query($sql);
		
		//if there is a user with the searched cardID
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//saves the cartId in $cartID
				$cartID = $row['cartId'];
			}
		}	
		//when this button got pressed the item got removed	
		$sql = "DELETE FROM cartitem WHERE id = '".$idProd."'";
		$mysqli->query($sql);
	}
	
	//Pricetotal variable
	$Pricetotal = 0;
	?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/cart_style.css">
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
					<li><a href='products.php'>Products</a></li>
				</ul>
				
				
			</div>
		</header>
		<main>
		<form method="post">
		<?php
		//Array to save all Product IDs
		$pdid = array();
		//Now we have find the Cart ID of the currently logged in user
		$sql = "SELECT cartId FROM customer WHERE userId = '".$_SESSION['userID']."'";
		$result = $mysqli->query($sql);
		
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//If the ID was found it gets saved in $cartID
				$cartID = $row['cartId'];
			}
			
			//With $cartID we search for the cartitems in the Cart
			$sql = "SELECT productId FROM cartitem WHERE cartId = '".$cartID."'";
			$result = $mysqli->query($sql);
			
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//if items are found they get saved in their dedicated array
					array_push($pdid, $row['productId']);
				}
			}
			$_SESSION["product_array"] = $pdid;

			
			//foreach product id in $pdid
			foreach($pdid as $id) {
				//it joins the product table, cartitem tabel, and category table
				//you save the cart items in the product ID
				$sql = "SELECT cartitem.id AS cartitemId, product.id, product.name, product.price, product.size, product.color, product.categoryid, category.name AS catName FROM product INNER JOIN category ON product.categoryId = category.id INNER JOIN cartitem ON product.id = cartitem.productId WHERE product.id = '".$id."'";
				$result = $mysqli->query($sql);
				
				
				$row = $result->fetch_assoc()
				?>
				<div class="article-card">
					<?php
					//Important: the image name must match the product name in the database
					//deletes all spaces from the string
					$name = $row['name'];
					$name = str_replace(' ', '', $name);
					//output of the image with the same name as the name of the product
					echo "<img src='img/$name.jpg' alt="?><?php echo $name;?><?php echo">";
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
						<!-- button to delete article-->
						<button type="submit" name="delete_from_shopcart" class="button-card" value="<?php echo $row['cartitemId'] ?>">DELETE</button> 
						
					</div>
				</div>
				<?php
						$Pricetotal += $row['price']; //add price of article in pricetotal variable
					
				}
			
			}	

			?>	
			<!--Proceed to Checkout button-->
			<div class="proceed-checkout">
				<a href="order.php" id="proceed" class="proceed">Proceed to Checkout</a>
				<p id="price_totalId" name="price_total"> Price without MwSt.: <?php echo $Pricetotal;?>€</p> <!--Output from the total-->
			</div>		
		</form>
	</main>
	<footer>
		<!--the footer-->
		<div class="container-footer"> 
		<a href="impressum.php"><p>Impressum</p></a>
		</div>
	</footer>
</body>
</html>
