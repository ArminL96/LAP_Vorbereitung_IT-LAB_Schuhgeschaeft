<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/userprofile_style.css">
		<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
	<?php
		$test = "";
	?>
	<!--Include the header.php-->
	<header class="header-container">
		<?php include "header.php"?>
		<div class='header-child2'>
			<ul>
				<!--Buttons for log out, products, cart-->
				<li><a href='login.php'>Log out</a></li>
				<li>
					<a href='products.php'>Products</a>
				</li>
				<li><a href='cart.php'>Cart</a></li>
				<li><a href='return.php'>Return</a></li>
			</ul>
		</div>
	</header>
	<?php
	#database server data
	$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("connection failed: ".$mysqli->connect_error);
	}
	#‎select data form database
	$sql = "SELECT firstName, lastName, shippingAddressId, billingAdressId, userId, cartId FROM customer";
	$result = $mysqli->query($sql);
	session_start();
	?>
	<form method="POST">
		<div class="profile-page-container">
			<div class="profile-container">
				<div class="profile-header">
					<?php
					//Important: the image name must match the username in the database
					//deletes all spaces from the string
					$name =  $_SESSION["na"];
					$name = str_replace(' ', '', $name);
					//checks if image exits
					if (file_exists("content/$name.jpg")) {
						//output of the image with the same name as the name of the username
						echo "<img src= content/$name.jpg>";
					}
					//else output of placeholder
					else {
						//echo element with placeholder image
						echo "<img src='content/testpic.png' />";
					}
					?>
					<!--Outputs the Name form the logged in User-->
					<p id="displayName"><?php echo $_SESSION["na"]; ?></p>
				</div>
			</div>
		</div>
		<div class="profile-main">
		
			<!--Check whether a variable is empty and if its declared-->
			<?php
				if(isset($_POST['ship_adress']))
				{
					//require statment, file is include
					require "shippingAdress.php";
				}
			?>

			<!--Output of User Shipping Adress-->
			<div class="profile-shipadd">
				<h2>Shipping Address</h2>
				<input type="text" placeholder="First Name" name="ship_firstName" id="ship_firstname"	required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Last Name" name="ship_lastName" id="ship_lastname"	required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Address" name="ship_adress" id="ship_address"	required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="City" name="ship_city" id="ship_city"	required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Country" name="ship_country" id="ship_country"	required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="ZIP Code" name="ship_zipcode" id="ship_zip"	required pattern="[0-9].{1,}"/>
				<br>
				<input type="submit" name="ship_sumit" value="Change" class="button-style"/>	<!--Change submit button-->
				<br>
			</div>
				
			<!--Check whether a variable is empty and if its declared-->	
			<?php
				if(isset($_POST['bill_adress']))
				{
					//require statment, file is include
					require "BillingAdress.php";
				}
				
			?>

			<div class="profile-billadd">
				<!--Output of User Billing Adress-->
				<h2>Billing Address</h2>
				<input type="text" placeholder="First Name" name="bill_firstName" id="bill_firstname" required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Last Name" name="bill_lastName" id="bill_lastname" required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Address" name="bill_adress" id="bill_address" required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="City" name="bill_city" id ="bill_city" required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="Country" name="bill_country" id="bill_country" required pattern="[A-Za-z].{1,}"/>
				<br>
				<input type="text" placeholder="ZIP Code" name="bill_zipcode" id="bill_zip" required pattern="[0-9].{1,}"/>
				<br>
				<input type="submit" name="bill_sumit" value="Change" class="button-style"/> <!--Change submit button-->
			</div>
		</div>
		</form>
	<footer>
		<!--the footer-->
		<div class="container-footer"> 
		<a href="impressum.php"><p>Impressum</p></a>
		</div>
	</footer>
</body>
</html>
