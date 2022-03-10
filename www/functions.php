<?php


class SQLCommunicator {
	
	//MySQL server data
	private static $servername = "localhost";
	private static $username = "root";
	private static $password = "";
	
	//funktion to get user data
	function Get_user($uname, $pass) {
		try {
		//set connection
			$conn = new PDO("mysql:host=". self::$servername . ";dbname=shoeshop", self::$username, self::$password);
		
		//set Error Mode
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//create Query for getting user
			$loginquery = $conn->prepare('SELECT * FROM user WHERE (userName = :username AND passwort = :password)');
			//bind parameters (:parametername) in query to variables
			$loginquery->bindParam(':username', $uname);
			$loginquery->bindParam(':password', $pass);
			//execute query
			$loginquery->execute();
			//fetch result and save it in &result variable
			$result = $loginquery->fetch(PDO::FETCH_BOTH);
			//check if $result is an array
			if(is_array($result))
			{
				//save $result in session array
				$_SESSION['loggeduser'] = $result;
				//redirect to main page
				header("Location:index.php");
				exit;
			}
			else
			{
				//gives user an error message
				echo "username and/or password incorrect. please try again";
			}
		}
		catch (PDOExeption $e) 
		{
			//error if connection to database failed
			echo "Connection to Database failed" ;
		}
	}
	
	//function to get Product data
	function Get_Products($category, $search) {
		
		
	}
}

class Profile {
	
	//function to get the users profilepicture name
	function Get_profilepicture () {
		//get usernames out of SESSION
		$username = $_SESSION['loggeduser'][1];
		$userid = $_SESSION['loggeduser'][0];
		//checks if a user has a profile picture
		if (file_exists("content/{$username}_{$userid}.png")) {
			//echo the HTML element
			echo "<img src='content/{$username}_{$userid}.png' />";
		}
		else {
			//echo element with placeholder image
			echo "<img src='content/testpic.png' />";
		}
	}
}

class Products {
	
}

?>