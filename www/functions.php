<?php


class SQLCommunicator {
	
	
	private static $servername = "localhost";
	private static $username = "root";
	private static $password = "";
	
	function Get_user($uname, $pass) {
		//MySQL server data
		try {
		//set connection
			$conn = new PDO("mysql:host=". self::$servername . ";dbname=shoeshop", self::$username, self::$password);
		
		//set Error Mode
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$loginquery = $conn->prepare('SELECT * FROM user WHERE (userName = :username AND passwort = :password)');
			$loginquery->bindParam(':username', $uname);
			$loginquery->bindParam(':password', $pass);
			$loginquery->execute();
			$result = $loginquery->fetch(PDO::FETCH_BOTH);
			if(is_array($result))
			{
				$_SESSION['loggeduser'] = $result;
				header("Location:userprofile.php");
				exit;
			}
			else
			{
				echo "username and/or password incorrect. please try again";
			}
		}
		catch (PDOExeption $e) {
			echo "Connection to Database failed" ;
		}
	}
	
	function Get_Products($category, $search) {
		
		
	}
}

class Profile {
	
	function Get_profilepicture () {
		$username = $_SESSION['loggeduser'][1];
		$userid = $_SESSION['loggeduser'][0];
		if (file_exists("content/{$username}_{$userid}.png")) {
			echo "<img src='content/{$username}_{$userid}.png' />";
		}
		else {
			echo "<img src='content/testpic.png' />";
		}
	}
}

class Products {
	
}

?>