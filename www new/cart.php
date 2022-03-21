<?php
	session_start();
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST[''])) {
		
	}
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
		<form method="post">
		<?php
		$pdid = array();
		$sql = "SELECT cartId FROM customer WHERE userId = '".$_SESSION['userID']."'";
		$result = $mysqli->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$cartID = $row['cartId'];
			}
			
			$sql = "SELECT productId FROM cartitem WHERE cartId = '".$cartID."'";
			$result = $mysqli->query($sql);
			
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($pdid, $row['productId']);
				}
			}
			
			foreach($pdid as $id) {
				$sql = "SELECT product.id, product.name, product.price, product.size, product.color, product.categoryid, category.name AS catName FROM product INNER JOIN category ON product.categoryId = category.id WHERE product.id = '".$id."'";
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
						<button type="submit" name="" class="button-card" value="<?php echo $row['id'] ?>">DELETE</button> 
						
					</div>
				</div>
				<?php
					}
				}
			}	
			?>	
		</form>
	</body>
	<footer>
			<!--footer-->
		<div class="container-footer"></div>
</footer>
</form>
</body>
</html>
