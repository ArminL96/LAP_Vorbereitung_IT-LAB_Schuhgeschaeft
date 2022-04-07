<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="style/order_style.css">
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

  <!--gets the shipping and billing adress and pastes it in the form-->
  <?php
    session_start();
    $Pricetotal = 0;
    $disabled;
    $mysqli = new mysqli("localhost", "root", "", "schuhgeschaeft");
    #checks if no connection could be established
    if($mysqli->connect_error){
      #if true the connection failed
      die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
    }
    $userID = $_SESSION["userID"];

    //gets the shipment and the billing adress from the database to paste it into the inputs
    //and gets the needed information for the order table in the database
    $sql = "SELECT `ship_adress`, `ship_country`, `ship_city`, `ship_zipcode`, `ship_firstname`, `ship_lastname`,
    	            `bill_adress`, `bill_country`, `bill_city`, `bill_zipcode`, `bill_firstname`, `bill_lastname`, customer.id, shippingAddressId, billingAdressId, cartId FROM `customer`
                  INNER JOIN shippingadress ON customer.shippingAddressId = shippingadress.id
                  INNER JOIN billingadress ON customer.billingAdressId = billingadress.id WHERE userId = '".$userID."'";

    $result = $mysqli->query($sql);


    
    while($row = $result->fetch_assoc()) { 

      //saves the the information needed to insert the order in the database
      $customerID = $row["id"];
      $shippingID = $row["shippingAddressId"];
      $billingID = $row["billingAdressId"];
      $cartID = $row["cartId"];



  ?>
<div class="all-container">
  <div class="adress-container">
    <!--Output & input of User Shipping Address-->
    <h2>Your Order</h2>
    <div class="order-shipadd">
      <h2 id="text-adress">Shipping Address</h2>
      <p>First Name: <input type="text" name="ship_firstName" id="ship_firstname" value=<?php echo $row['ship_firstname'] ?> required></p>
      <p>Last Name:  <input type="text" name="ship_lastName" id="ship_lastname" value=<?php echo $row['ship_lastname'] ?> required></p>
      <p>Address:   <input type="text" name="ship_adress" id="ship_adress" value=<?php echo $row['ship_adress'] ?> required></p>
      <p>City:      <input type="text" name="ship_city" id="ship_city" value=<?php echo $row['ship_city'] ?> required></p>
      <p>Country: <select name="ship_country">
                    <option value="Austria" <?php if ($row["ship_country"] == "Austria") {echo "selected";}?> required>Austria</option>
                    <option value="Germany" <?php if ($row["ship_country"] == "Germany") {echo "selected";}?> required>Germany</option>
                  </select>
      </p>
      <p>ZIP Code:  <input type="number" name="ship_zipcode" id="ship_zip" value=<?php echo $row['ship_zipcode'] ?> required></p>


      <button name="ship_sumit" class="button-style" type="submit">Change</button>
    </div>


    <div class="order-billadd">
      <!--Output & input of User Billing Address-->
      <h2 id="text-adress">Billing Address</h2>
      <p>First Name: <input  type="text" name="bill_firstName" id="bill_firstName" value=<?php echo $row['bill_firstname'] ?> required></p>
      <p>Last Name:  <input type="text" name="bill_lastName" id="bill_lastName" value=<?php echo $row['bill_lastname'] ?> required></p>
      <p>Address:   <input type="text" name="bill_adress" id="bill_adress" value=<?php echo $row['bill_adress'] ?> required> </p>
      <p>City:      <input type="text" name="bill_city" id="bill_city" value=<?php echo $row['bill_city'] ?> required></p>
      <p>Country: <select name="bill_country">
                    <option value="Austria" <?php if ($row["bill_country"] == "Austria") {echo "selected";}?> required>Austria</option>
                    <option value="Germany" <?php if ($row["bill_country"] == "Germany") {echo "selected";}?> required>Germany</option>
                  </select>
      </p>
      <p>ZIP Code:  <input type="number" name="bill_zipcode" id="bill_zipcode" value=<?php echo $row['bill_zipcode'] ?> required></p>

      <button name="bill_sumit" class="button-style" type="submit">Change</button>
    </div>
  </div>

<?php 
    $billing_country = $row["bill_country"];

    //checks if the change-button for the shippment adress or the billing adress was pressed
    if (isset($_POST["ship_sumit"])) {

      //changes the shippingadress in an external php file
      require "shippingAdress.php";
      //Refresh the page to load in the changed adress
      header("Refresh: 0");
    }
    else if (isset($_POST["bill_sumit"])) {

      require "Billingadress.php";
      header("Refresh: 0");
    }

  }
?>
  <!--Payment Options -->
  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Options</h2>
      <!--Checkboxs for Payment Options-->
      <div class="checkbox-payment">
        <input type="checkbox" name="method[]" id="pay_card" value="card" onClick="check_card('pay_card')"> Pay with card
        <label for="pay_card"></label>
        <br>
        <input type="checkbox" name="method[]" id="payment_site" value="cash" onClick="check_card('payment_site')"checked> Payment with cash
        <label for="payment_site"></label>
      </div>
    </div>
  </div>
  
  <!--Payment Informations (this structure is only for testing) -->
  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Information</h2>
      <div class="checkbox-payment">
        <input type="text" name="card_number" id="card_number" placeholder="cardnumber" disabled="disabled"/>
        <br>
        <input type="number" name="month" id="month" placeholder="month" min="1" max="12" disabled="disabled"/>
        <br>
        <input type="text" name="year" id="year" placeholder="year" pattern="[0-9]{4}" disabled="disabled"/> <!--the user have to write 4 number-->
        <br>
        <input type="text" name="securitycode" id="securitycode" placeholder="securitycode" pattern="[0-9]{4}" disabled="disabled"/>
      </div>
    </div>
  </div>
  <div class="order-container">
    <div class="order-list">
      <table id="order-table" name="order-table">
        <tr>
          <!--Header Table-->
          <th>Productname</th>
          <th>Size</th>
          <th>Price</th>
        </tr>

  <!--gets all the products form the shopcart-->
  <?php
    $pdid = $_SESSION["product_array"];

    //foreach product id in $pdid
    foreach($pdid as $id) {
      //gets the product informations
      $sql = "SELECT product.id, product.name, product.price, product.size FROM product WHERE product.id = '".$id."'";

      $result = $mysqli->query($sql);

      while($row = $result->fetch_assoc()) {  
        //add price of article in pricetotal variable    
        $Pricetotal += $row['price']; 
  ?>
  
        <tr>
          <!--products of Order-->
          <td><?php echo $row["name"]?></td>
          <td><?php echo $row["size"]?></td>
          <td><?php echo $row["price"]?>€</td>
        </tr>

  <?php 
      }
    }
    //checks what the country to calculate the totalprice with the tax
    if ($billing_country == "Austria") {
        //20% tax rate in Austria
        $Pricetotal *= 1.2;
        $tax_rate = "20%";
    }
    else {
        //19% tax rate in Austria
        $Pricetotal *= 1.19;
        $tax_rate = "19%";
    }
  ?>
  
      </table>

      <!--Table footer -->
      <p class ="table-foot" style="border-top: 2px solid #db6c6c;">Tax Rate: </p>
      <p class ="table-foot-text" name="tax_rate"><?php echo $tax_rate ?></p>
      <p class ="table-foot">Total Price: </p>
      <p class ="table-foot-text" name="total_price"><?php echo number_format($Pricetotal, 2) ?>€</p>
      <input type="submit" value="confirm order" class="button-proceed" name="order_button" id="order_button"></input> <!--writes the saved $disabled variable to disable or enable the input-->
    </div>
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
<?php

//checks if the confirm order-button is pressed
if (isset($_POST["order_button"])) {

    //gets the checked value from the checkboxes for the paymentmethod
    foreach($_POST['method'] as $paymentmethod);

    
    //if the user checked "pay with card" as the payment option the inputs fields for the cardinformation gets saved in varibales
    if ($paymentmethod == "card") {
      $cardnumber = $_POST["card_number"];
      $month = $_POST["month"];
      $year = $_POST["year"];
      $securitycode = $_POST["securitycode"];

      //updates the credit-cart information
      //set the date to the first day of the entert month
      $sql = "UPDATE `creditcart` 
      INNER JOIN customer ON customer.creditId = creditcart.id
      SET `cardnumber` = '$cardnumber',
      `securitycode` = '$securitycode',
      `expiredate` = '$year"."-".$month."-01'
      WHERE customer.userId = '".$_SESSION["userID"]."'";
      $result = $mysqli->query($sql);
    }

    //update query for the total price in the shopingcart
    //shopingcart and customer gets joined to only update where the userId in the database matches the current userID
    $sql = "UPDATE shopingcart 
            INNER JOIN customer ON shopingcart.id = customer.cartId
            SET shopingcart.totalPrice = $Pricetotal
            WHERE customer.userId = '".$_SESSION["userID"]."'";

    $result = $mysqli->query($sql);


    //inserts the cardId, customerId, billAddId and the shipAddId into the order table
    $sql = "INSERT INTO `orders` (`cartId`, `customerId`, `billAddId`, `shipAddId`, `paymentMethod`) VALUES ($cartID, $customerID, $billingID, $shippingID, '$paymentmethod' );";
    $mysqli->error;
    $result = $mysqli->query($sql); 


    //creates a new shopingcart for the user
    //a new shopingcart has to be created so the old shopingcart doesnt get overwritten
    $sql = "INSERT INTO `shopingcart` (`totalPrice`) VALUES (0)";
    $result = $mysqli->query($sql); 


    //Selects the last shopingcart to save the id in an variable
    $sql = "SELECT `id` FROM `shopingcart` ORDER BY id DESC LIMIT 1;";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $newShopCartID = $row["id"];    


    //Updates the cardId in the customer-table to the id of the newly created shopingcart
    $sql = "UPDATE customer SET cartId = $newShopCartID WHERE id = '".$_SESSION['userID']."'";
    $result = $mysqli->query($sql);

    //create a SESSION variable so the the popup gets shown on the product-page
    $_SESSION["order_confirm"] = true;

    //redirects the user to the products-page after his order
    $URL="userprofile.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';

   
  }                                                              
?>
  <script type="text/javascript">
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    //shows the form for the credit card information if the user chooses to pay with the card
    //if the user pays with cash the form will be disabled
    function check_card(id)
	  {
      document.getElementById("pay_card").checked = false;
      document.getElementById("payment_site").checked = false;
      document.getElementById(id).checked = true;

      const credit = document.querySelector('#pay_card');
	  const cash = document.querySelector('#payment_site');

      document.getElementById("pay_card").checked = false;
      document.getElementById("payment_site").checked = false;
      document.getElementById(id).checked = true;

      if (credit.checked == true) { 
        //enable inputs
				document.getElementById("card_number").disabled = false;
				document.getElementById("month").disabled = false;
				document.getElementById("year").disabled = false;
				document.getElementById("securitycode").disabled = false;

        //enable required
        document.getElementById("card_number").required = true;
				document.getElementById("month").required = true;
				document.getElementById("year").required = true;
				document.getElementById("securitycode").required = true;
			}  

      if (cash.checked == true) {
        //disable inputs 
				document.getElementById("card_number").disabled = true;
				document.getElementById("month").disabled = true;
				document.getElementById("year").disabled = true;
				document.getElementById("securitycode").disabled = true;

        //disable required
				document.getElementById("card_number").required = false;
				document.getElementById("month").required = false;
				document.getElementById("year").required = false;
				document.getElementById("securitycode").required = false;
      }
	}

    //if the order button is disabled set the opactiy to 0.5 so the user can see that the button is disabled
    if (document.getElementById('order_button').disabled) {
      document.getElementById('order_button').style.opacity = '0.5';
    }

  </script>
</html>
  
