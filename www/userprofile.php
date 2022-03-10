<?php
/*
	PHP Includes
	Load php files
*/
	session_start();
	if (!isset($_SESSION['loggeduser'])) {
		header("login.php");
	}
	
	require 'header.php';
	require 'footer.php';
	require 'functions.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/header_style.css">
		<link rel="stylesheet" href="styles/footer_style.css">
		<script src="scripts/script.js"></script>
	</head>
	<body>
		<!--Load the get_the_header() function from header.php-->
		<header class="header-container">
			<?php get_the_header_prof(); ?>
		</header>
		
		<main>
			<div class="profile-page-container">
				<div class="profile-container">
					<div class="profile-header">
						<?php Profile::Get_profilepicture(); ?>
						<h2><?php echo $_SESSION['loggeduser'][1]?></h2>
					</div>
					<div class="profile-main">
						<div class="address-container">
							<div class="profile-shipadd">
								<h2>Shipping Address</h2>
								<p>Address: <span id="shipadd-page-add">PLACEHOLDER</span></p>
								<p>City: <span id="shipadd-page-city">PLACEHOLDER</span></p>
								<p>Country: <span id="shipadd-page-country">PLACEHOLDER</span></p>
								<p>Zipcode: <span id="shipadd-page-zip">PLACEHOLDER</span></p>
								<input type="button" value="Change" onclick="openFormSA()" class="button-style"/>
							</div>
							<div class="profile-billadd">
								<h2>Billing Address</h2>
								<p>Address: <span id="billadd-page-add">PLACEHOLDER</span></p>
								<p>City: <span id="billadd-page-city">PLACEHOLDER</span></p>
								<p>Country: <span id="billadd-page-country">PLACEHOLDER</span></p>
								<p>Zipcode: <span id="billadd-page-zip">PLACEHOLDER</span></p>
								<input type="button" value="Change" onclick="openFormBA()" class="button-style"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		
		<!--Load the get_the_footer() function from footer.php-->
		<footer>
			<?php get_the_footer(); ?>
		</footer>
	</body>
</html>