<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="header_style.css">
	<link rel="stylesheet" href="footer_style.css">
</head>
<body>
	<header class="header-container">
			<div class='header-child1'><a href='index.php'>Schuhgeschäft</a></div><div class='header-child2'></div>
	</header>

	<?php
	#database server data
	$mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
	#checks if no connection could be established
	if($mysqli->connect_error){
		#if true the connection failed
		die("connection failed: ".$mysqli->connect_error);
	}

	$sql = "SELECT
	userName,
	passwort
	FROM user";
	$result = $mysqli->query($sql);
	?>
		<div class="login-page-container">
			<div class="login-container">
				<h1>Log-in</h1>
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
					<?php
					if (empty($_POST['uname']) or empty($_POST['password']) ) {
					}
					else {
						#Read the input fields
						$login_username =  $_POST['uname'];
						$login_password =  $_POST['password'];
					}
					?>
					<input type="submit" name="login" value="Login" class="button-style"/>
					<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST")
					{
						#if a username exists in the database
						if ($result->num_rows > 0)
						{
							$row = mysqli_fetch_array($result);
							#get the hash from the database
							$hash = $row["passwort"];
							#check if the entert password matches the hash
							if (password_verify($login_password, $hash))
							{
								#save $result in session array
								$_SESSION['loggeduser'] = $result;
								#redirects to the products page
								header('Location: products.php');
							}
							#else output error
							else
							{
								echo '<br> <span style="color:red;font-size: 16px;">Incorrect Password or Username</span></br>';
							}
						}
					}
					?>
				</form>
			</div>
		</div>
	<footer>
		<?php
				include "footer.php"
		 ?>
	</footer>
</body>
</html>
