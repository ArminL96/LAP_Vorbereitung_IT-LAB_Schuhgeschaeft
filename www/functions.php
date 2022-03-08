<?php


function SQLCommunicator_Login($uname, $email, $pass) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	try {
		$conn = new PDO("mysql:host=$servername;dbname=shoeshop", $username, $password);
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected to Database successfully" ;
	}
	catch (PDOExeption $e) {
		echo "Connection to Database failed" ;
	}
}

?>