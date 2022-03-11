<?php
/*
	PHP Includes
	Load php files
*/
	//session is started
	session_start();
	//check if user is logged in and if not go to login page
	if (!isset($_SESSION['loggeduser'])) {
		header("login.php");
	}
	
	//include backend as well as header and fuuter functions
	require 'header.php';
	require 'footer.php';
	require 'functions.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<!--linclude css files-->
		<link rel="stylesheet" href="styles/style.css">
		<link rel="stylesheet" href="styles/header_style.css">
		<link rel="stylesheet" href="styles/footer_style.css">
	</head>
	<body>
		<!--Load the get_the_header() function from header.php-->
		<header class="header-container">
			<?php get_the_header_prof(); ?>
		</header>
		
		<main>
			<!--page code (without header or footer)-->
		</main>
		
		<!--Load the get_the_footer() function from footer.php-->
		<footer>
			<?php get_the_footer(); ?>
		</footer>
	</body>
</html>