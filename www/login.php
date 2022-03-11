<?php
/*
	PHP Includes
	Load php files
*/
	//starts the session and looks if a user is already loggend in
	session_start();
	if (isset($_SESSION['loggeduser'])) {
		header("Location:userprofile.php");
	}
	//includes php files
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
				get_the_header_none();
			?>
		</header>
		
		<main>
			<div class="login-page-container">
				<div class="login-container">
					<h1>Log-in</h1>
					<!--Check if all Fields are set and Call Database Communicator for Login-->
					<?php
						if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['login'])) {
							SQLCommunicator::Get_user($_POST['uname'], $_POST['password']);
						}
					?>
					<!--Form fol login-->
					<form method="POST">
						<div class="label-container">
							<label for="uname">Username:</label>
							<input type="text" placeholder="Username" name="uname" id="login-uname" required/>
						</div>
						<div class="label-container">
							<label for="password">Password:&nbsp;</label>
							<input type="password" placeholder="Password" name="password" id="login-pass" required/>
						</div>
							<input type="submit" name="login" value="Login" class="button-style"/>
					</form>
				</div>
			</div>
		</main>
		
		<!--Load the get_the_footer() function from footer.php-->
		<footer>
			<?php get_the_footer(); ?>
		</footer>
	</body>
</html>