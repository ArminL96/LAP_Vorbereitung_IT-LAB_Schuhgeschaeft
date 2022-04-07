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
          	<div class="return">
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
	  
	  //selects from table order if user input is an order
	  $sql = "SELECT id FROM orders WHERE id ='".$orderID."'";
	  $return = $mysqli->query($sql);
	  
	  //if theres an result
	  if ($return->num_rows > 0) {

			//looks if order has been already returned
		  $sql = "SELECT returned FROM returns WHERE orderId ='".$orderID."'";
		  $return = $mysqli->query($sql);
	  
		//if he doesnt find a row
	  if($return->num_rows < 1)
	  {
		  $sql = "INSERT INTO returns (orderId, reason, returned) VALUES ('".$orderID."', '".$reason."', '1')";
		  $mysqli->query($sql);
		  echo "<p id='return'>Order has been returned!</p>";
		
	  }
	  //if theres already an order returned
	  else
	  {
		  
		    echo "<p id='return'>Order ".$orderID." has already been returned!</p>";
	  }
	  
	  }
	  //if theres no order with that number
	  else{
		  echo "<p id='return'>Theres no order with that number!</p>";
	  }
	  
	  


    }
  ?>
		</div>

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
