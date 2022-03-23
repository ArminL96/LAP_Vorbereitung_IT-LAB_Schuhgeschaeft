<?php
// (A) PROCESS RESULT
$result = "";

// (B) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
$dbhost = "localhost";
$dbname = "schuhgeschaeft";
$dbchar = "utf8";
$dbuser = "root";
$dbpass = "";
try {
  $pdo = new PDO(
    "mysql:host=$dbhost;dbname=$dbname;charset=$dbchar",
    $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (Exception $ex) { $result = $ex->getMessage(); }

// (C) SAVE ORDER TO DATABASE
if ($result=="") {
  try {
    $stmt = $pdo->prepare("UPDATE shippingadress SET ship_adress = (?), ship_country = (?), ship_city = (?), ship_zipcode = (?), ship_firstName = (?), ship_lastName = (?) WHERE id = '".$_SESSION["userID"]."'");
	
    $stmt->execute([$_POST["ship_adress"], $_POST["ship_country"], $_POST["ship_city"],$_POST["ship_zipcode"], $_POST["ship_firstName"], $_POST["ship_lastName"]]);
	
  } catch (Exception $ex) { $result = $ex->getMessage(); }
}


