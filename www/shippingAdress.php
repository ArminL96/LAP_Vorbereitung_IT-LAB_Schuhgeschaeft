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
    #Update shippingadress in DATABASE
    $stmt = $mysqli->prepare("UPDATE shippingadress SET ship_adress = (?), ship_country = (?), ship_city = (?), ship_zipcode = (?), ship_firstName = (?), ship_lastName = (?) WHERE id = '".$_SESSION["userID"]."'");
    #Binds variables to the parameter placeholders of a SQL statement prepared with mysqli_prepare()
    $stmt->bind_param("sssiss", $_POST["ship_adress"], $_POST["ship_country"], $_POST["ship_city"],$_POST["ship_zipcode"], $_POST["ship_firstName"], $_POST["ship_lastName"]);
    #executes the sql query
    $stmt->execute();
}
#i - integer , d - double, s - string
