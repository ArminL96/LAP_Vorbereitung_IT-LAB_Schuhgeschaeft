<?php

class SQLCommunicator {
	private static $result = array();
	
	function Login($uname, $email, $pass) {
		//MySQL server data
		$servername = "localhost";
		$username = "root";
		$password = "";
		try {
		//set connection
			$conn = new PDO("mysql:host=$servername;dbname=shoeshop", $username, $password);
		
		//set Error Mode
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			$loginquery = $conn->prepare('SELECT * FROM user WHERE (userName = :username AND passwort = :password)');
			$loginquery->bindParam(':username', $uname);
			$loginquery->bindParam(':password', $pass);
			$loginquery->execute();
			self::$result = $loginquery->fetch(PDO::FETCH_BOTH);
			if(is_array(self::$result))
			{
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

	function GetUserData() {
		return self::$result;
	}
}

?>