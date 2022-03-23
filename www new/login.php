<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/login_style.css">
	<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
	<div class="login-page-container">
		<div class="login-container">
			<h1>Log-in</h1>
			<!--Form for login-->
			<form method="POST">
				<div class="label-container">
					<!--Inputs for Username and Password-->
					<label for="uname">Username:</label>
					<input type="text" placeholder="Username" name="uname" id="login-uname" required/>
				</div>
				<div class="label-container">
					<label for="password">Password:&nbsp;</label>
					<input type="password" placeholder="Password" name="password" id="login-pass" required/>
				</div>
				<?php
				#database server data
				$mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
				#checks if no connection could be established
				if($mysqli->connect_error){
					#if true the connection failed
					die("connection failed: ".$mysqli->connect_error);
				}
				#session start
				session_start();
				#if input username and password is not empty
				if (!empty($_POST['uname']) and !empty($_POST['password']) ) {
					#Read the input fields
					$login_username =  $_POST['uname'];
					$login_password =  $_POST['password'];
					#Session transfer to userprofile to get username
					$_SESSION["na"] = $login_username;
				}
				?>
				<input type="submit" name="login" value="Login" class="button-style"/>
				<?php
				#if button login is klicked
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					#‎select data form database
					$sql = "SELECT
					userName,
					passwort,
					id
					#‎select data form user where username like the login username
					FROM user WHERE userName= '".login_username."'";
					$result = $mysqli->query($sql);

					#if a username exists in the database
					if ($result->num_rows > 0)
					{
						#gets the result of
						$row = mysqli_fetch_array($result);
						#get the hash from the database
						$hash = $row["passwort"];
						#check if the entert password matches the hash
						if (password_verify($login_password, $hash))
						{
							#Session transfer to get userID
							$_SESSION["userID"] = $row["id"];
							#if password is true then redirects to the products page
							header('Location: ../www/products.php');
						}
						#else output an error
						else
						{
							echo '<br> <span style="color:red;font-size: 16px;">Incorrect Password or Username</span></br>';
						}
					}
					else
					{
						echo '<br> <span style="color:red;font-size: 16px;">Incorrect Password or Username</span></br>';
					}
				}
				?>
			</form>
		</div>
	</div>
</body>
</html>
