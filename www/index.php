<?php
/*
	PHP Includes
	Load php files
*/
	session_start();
	
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
	</head>
	<body>
		<!--Load the get_the_header() function from header.php-->
		<header class="header-container">
			<?php 
			if (isset($_SESSION['loggeduser'])) {
				get_the_header_prof();
			}
			else {
				get_the_header_log();
			}
			?>
		</header>
		<main>
			<h1>TEST</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus bibendum felis fermentum, luctus nisi non, convallis neque. Cras ipsum orci, varius sed massa a, viverra suscipit nisl. Praesent ipsum mi, lacinia vitae enim sit amet, euismod aliquam dolor. Vivamus dapibus aliquet blandit. Morbi ac tellus sed orci facilisis scelerisque. Nullam at ligula et quam ultricies auctor sed et ligula. Quisque non massa pretium erat venenatis volutpat.</p>
		</main>
		<!--Load the get_the_footer() function from footer.php-->
		<footer>
			<?php get_the_footer(); ?>
		</footer>
	</body>
</html>