<?php

$result = "";

#database connention
$mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
#checks if no connection could be established
if($mysqli->connect_error){
  #if true the connection failed
  die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
}

#if result is empty
if ($result=="") {
	  //Update Billingadress in DATABASE
    $stmt = $mysqli->prepare("UPDATE billingadress SET bill_adress = (?), bill_country = (?), bill_city = (?), bill_zipcode = (?), bill_firstName = (?), bill_lastName = (?) WHERE id = '".$_SESSION["userID"]."'");
    #Binds variables to the parameter placeholders of a SQL statement prepared with mysqli_prepare()
    $stmt->bind_param("sssiss", $_POST["bill_adress"],$_POST["bill_country"], $_POST["bill_city"], $_POST["bill_zipcode"], $_POST["bill_firstName"], $_POST["bill_lastName"]);
    #executes the sql query
    $stmt->execute();
}
  #i - integer , d - double, s - string
