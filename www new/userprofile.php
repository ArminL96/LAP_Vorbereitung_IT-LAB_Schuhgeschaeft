<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/userprofile_style.css">
</head>
<body>
	<!--Include the header.php-->
	<header class="header-container">
		<?php include "header.php"?>
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
	$sql = "SELECT *
	FROM cumstomer";
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
			<!--Output of User Shipping Adress-->
			<div class="profile-shipadd">
				<h2>Shipping Address</h2>
				<input type="text" placeholder="First Name" name="ship_firstname" id="ship_firstname"/>
				<br>
				<input type="text" placeholder="Last Name" name="ship_lastname" id="ship_lastname"/>
				<br>
				<input type="text" placeholder="Address" name="ship_address" id="ship_address"/>
				<br>
				<input type="text" placeholder="City" name="ship_city" id="ship_city"/>
				<br>
				<input type="text" placeholder="Country" name="ship_country" id="ship_country"/>
				<br>
				<input type="text" placeholder="ZIP Code" name="ship_zip" id="ship_zip"/>
				<br>
				<input type="submit" name="ship_sumit" value="Change" class="button-style"/>
				<br>
			</div>
			<div class="profile-billadd">
				<!--Output of User Billing Adress-->
				<h2>Billing Address</h2>
				<input type="text" placeholder="First Name" name="bill_firstname" id="bill_firstname"/>
				<br>
				<input type="text" placeholder="Last Name" name="bill_lastname" id="bill_lastname"/>
				<br>
				<input type="text" placeholder="Address" name="bill_address" id="bill_address"/>
				<br>
				<input type="text" placeholder="City" name="bill_city" id="bill_city"/>
				<br>
				<input type="text" placeholder="Country" name="bill_country" id="bill_country"/>
				<br>
				<input type="text" placeholder="ZIP Code" name="bill_zip" id="bill_zip"/>
				<br>
				<input type="submit" name="ship_sumit" value="Change" class="button-style"/>
			</div>
		</div>
		<!--footer-->
		<footer>
			<div class="container-footer"></div>
		</footer>
	</form>
</body>
</html>
