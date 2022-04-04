<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/return_style.css">
  <link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
  <form method="POST">
    <!--Header-->
    <header class="header-container">
      <?php include "header.php"?>
      <div class='header-child2'>
        <ul>
          <!--Buttons for log out, userprofile, Cart-->
          <li><a href='login.php'>Log out</a></li>
          <li>
            <a href='userprofile.php'>My Profile</a>
          </li>
          <li><a href='cart.php'>Cart</a></li>
        </ul>
      </div>
    </header>

      <!--Input of Address-->
      <h2 id="text-return">Return</h2>
      <h2>Your Address</h2>
        <div class="return-container">
          <!--Input of Address-->
          <p>First Name: <input type="text" name="firstname" id="firstname"/></p>
          <p>Last Name:  <input type="text" name="lastname" id="lastname"/></p>
          <p>Address:   <input type="text" name="address" id="address"/></p>
          <p>City:      <input type="text" name="city" id="city"/></p>
          <p>Country:   <input type="text"name="country" id="country"/></p>
          <p>ZIP Code:  <input type="text" name="zip" id="zip"/></p>
          <p>order number:  <input type="text" name="orderID" id="orderID"/></p>
          <h2>Reason of Return</h2>
          <textarea placeholder="Write the Reason of the return here" name="return_text" id="return_text"></textarea>
          <input type="submit" name="sumit_cancel" value="Cancel" class="button-style"/>
          <input type="submit" name="sumit_return" value="Return" class="button-style"/>
          
  <?php
    //if the submit button is pressed
    if (isset($_POST["orderID"])) {
      $orderID = $_POST["orderID"];
      $reason = $_POST["return_text"];

      $mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
      if($mysqli->connect_error){
        #if true the connection failed
        die("connection failed: ".$mysqli->connect_error);
      }

      //checks if the query throws an error
      //Inserts the orderid, reason and the returned into the returns table
      if (!$mysqli -> query("INSERT INTO `returns` (`orderId`, `reason`, `returned`) VALUES ($orderID, '$reason', 1)")) {

        echo "<p>the ordernumber entered does not exsist or is already returned</p>";
        #echo $mysqli -> error;
      }

    }
  ?>
        </div>
  </form>
   <footer>
		<!--the footer-->
		<div class="container-footer"> 
		<a href="impressum.php"><p>Impressum</p></a>
		</div>
	</footer>

</body>

  <!--prevents the browser from resending the data on a reload-->
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
