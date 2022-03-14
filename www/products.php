<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/products_page.css">
	<link rel="stylesheet" href="style/header_style.css">
	<link rel="stylesheet" href="style/footer_style.css">
</head>
<body>
	<!--Load the get_the_header() function from header.php-->
	<header class="header-container">
		<div class='header-child1'>
			<a href='index.php'>Schuhversand</a>
		</div>
		<div class='header-child2'>
			<ul>
				<li><a href='login.php'>Log out</a></li>
				<li>
					<a href='userprofile.php'>My Profile</a>
				</li>

				<li><a href='#'>My Cart</a></li>

			</ul>
		</div>

	</header>

	<form method="post">
		<div id="searchbarDiv">
			<input id="searchbar" name="search" type="text" placeholder="Search..">
		</div>

		<section class="container" id="products">
			<div class="row">
				<div class="col">
					<?php include 'product_card.php'?>
				</div>
			</div>

			<footer>
				<?php
				include "footer.php"
				?>
			</footer>
		</body>
		</html>
