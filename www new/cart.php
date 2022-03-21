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
				<!-- article-->
			<div class="article-card">
				<img src= ../www/img/BirkenstockPantolette.jpg>
					<!-- article inputs-->
				<div class="article-body">
					<!-- output daten -->
					<p>Name: </p>
					<p>Price: </p>
					<p>Category: </p>
				</div>
				<!--cart footer-->
				<div class="card-footer">
					<a href="" class="button-card">Remove</a>
				</div>
			</div>
			<!--Proceed to Checkout button-->
			<div class="proceed-checkout">
				<a href="" class="proceed">Proceed to Checkout</a>
				<p> Price: </p>
			</div>
		</form>
	</body>
	<footer>
			<!--footer-->
		<div class="container-footer"></div>
</footer>
</form>
</body>
</html>
