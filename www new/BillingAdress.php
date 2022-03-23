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
	  //Update Billingadress in DATABASE
    $stmt = $pdo->prepare("UPDATE billingadress SET bill_adress = (?), bill_country = (?), bill_city = (?), bill_zipcode = (?), bill_firstName = (?), bill_lastName = (?) WHERE id = '".$_SESSION["userID"]."'");
	
    $stmt->execute([$_POST["bill_adress"], $_POST["bill_country"], $_POST["bill_city"],$_POST["bill_zipcode"], $_POST["bill_firstName"], $_POST["bill_lastName"]]);
	
  } catch (Exception $ex) { $result = $ex->getMessage(); }
}