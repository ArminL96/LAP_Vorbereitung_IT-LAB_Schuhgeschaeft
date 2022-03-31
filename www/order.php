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
    $country = null;
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

      //checks if the country is Austria or Germany and saves it in a variable
      if ($row["ship_country"] == "Austria") {
        $country = "Austria";
      }
      else if ($row["ship_country"] == "Germany")  {
        $country = "Germany";
      }

  ?>

  <div class="adress-container">
    <!--Output & input of User Shipping Address-->
    <h2>Your Order</h2>
    <div class="order-shipadd">
      <h2 id="text-adress">Shipping Address</h2>
      <p>First Name: <input type="text" name="ship_firstName" id="ship_firstname" value=<?php echo $row['ship_firstname'] ?>></p>
      <p>Last Name:  <input type="text" name="ship_lastName" id="ship_lastname" value=<?php echo $row['ship_lastname'] ?>></p>
      <p>Address:   <input type="text" name="ship_adress" id="ship_adress" value=<?php echo $row['ship_adress'] ?>></p>
      <p>City:      <input type="text" name="ship_city" id="ship_city" value=<?php echo $row['ship_city'] ?>></p>
      <p>Country:   <input type="text"name="ship_country" id="ship_country" value=<?php echo $row['ship_country'] ?>></p>
      <p>ZIP Code:  <input type="text" name="ship_zipcode" id="ship_zip" value=<?php echo $row['ship_zipcode'] ?>></p>
      <?php
      if ($country == null) {
        echo "<p style='color:red'>Invalid Country, please choose between Austria or Germany</p>"; 
        $country = NULL;
      }
      ?>
      <button name="ship_sumit" class="button-style" type="submit">Change</button>
    </div>

    <div class="order-billadd">
      <!--Output & input of User Billing Address-->
      <h2 id="text-adress">Billing Address</h2>
      <p>First Name: <input  type="text" name="bill_firstName" id="bill_firstName" value=<?php echo $row['bill_firstname'] ?>></p>
      <p>Last Name:  <input type="text" name="bill_lastName" id="bill_lastName" value=<?php echo $row['bill_lastname'] ?>></p>
      <p>Address:   <input type="text" name="bill_adress" id="bill_adress" value=<?php echo $row['bill_adress'] ?>></p>
      <p>City:      <input type="text" name="bill_city" id="bill_city" value=<?php echo $row['bill_city'] ?>></p>
      <p>Country:   <input type="text"name="bill_country" id="bill_country" value=<?php echo $row['bill_country'] ?>></p>
      <p>ZIP Code:  <input type="text" name="bill_zipcode" id="bill_zipcode" value=<?php echo $row['bill_zipcode'] ?>></p>
      <button name="bill_sumit" class="button-style" type="submit">Change</button>
    </div>
  </div>

<?php 
    }
?>
  <div class="order-container">
    <div class="order-list">
      <table id="order-table" name="order-table" >
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
    //checks if the change-button for the shippment adress or the billing adress was pressed
    if (isset($_POST["ship_sumit"])) {
      require "shippingAdress.php";
      header("Refresh: 0");
    }
    else if (isset($_POST["bill_sumit"])) {
      require "Billingadress.php";
      header("Refresh: 0");
    }
    //checks what the country to calculate the totalprice with the tax
    if ($country == "Austria") {
        //20% tax rate in Austria
        $Pricetotal *= 1.2;
        $tax_rate = "20";
    }
    else {
        //19% tax rate in Austria
        $Pricetotal *= 1.19;
        $tax_rate = "19";
    }
  ?>
  
      </table>

      <!--Table footer -->
      <p class ="table-foot" style="border-top: 2px solid #db6c6c;">Tax Rate: </p>
      <p class ="table-foot-text" name="tax_rate"><?php echo $tax_rate ?>%</p>
      <p class ="table-foot">Total Price: </p>
      <p class ="table-foot-text" name="total_price"><?php echo number_format($Pricetotal, 2) ?>€</p>
      <input type="submit" value="Proceed" class="button-proceed" name="proceed_button"></input>
    </div>
  </div>

  <!--Payment Options -->
  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Options</h2>
      <!--Checkboxs for Payment Options-->
      <div class="checkbox-payment">
        <input type="checkbox" name="method[]" id="pay_card" value="card"> Pay with card
        <label for="pay_card"></label>
        <br>
        <input type="checkbox" name="method[]" id="payment_site" value="cash"> Payment on site
        <label for="payment_site"></label>
      </div>
    </div>
  </div>
  
</form>


  <!--Payment Informations (this structure is only for testing) -->
  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Information</h2>
      <div class="checkbox-payment">
        <input type="text" name="card_number" id="card_number" placeholder="cardnumber"/>
        <br>
        <input type="text" name="month" id="month" placeholder="month"/>
        <br>
        <input type="text" name="year" id="year" placeholder="year"/>
        <br>
        <input type="text" name="securitycode" id="securitycode" placeholder="securitycode"/>
      </div>
    </div>
  </div>


<footer>
		<!--the footer-->
		<div class="container-footer"> 
		<a href="impressum.php"><p>Impressum</p></a>
		</div>
	</footer>
</body>
<?php

//checks if the proceed-button is pressed
if (isset($_POST["proceed_button"])) {

    //gets the checked value from the checkboxes for the paymentmethod
    foreach($_POST['method'] as $value){
        echo $value;
    }

    //update query for the total price in the shopingcart
    //shopingcart and customer gets joined to only update where the userId in the database matches the current userID
    $sql = "UPDATE shopingcart 
            INNER JOIN customer ON shopingcart.id = customer.cartId
            SET shopingcart.totalPrice = $Pricetotal
            WHERE customer.userId = '".$_SESSION["userID"]."'";

    //sql Update totalprice of the cart is updatet here
    $result = $mysqli->query($sql);

    //inserts the cardId, customerId, billAddId and the shipAddId into the order table
    $sql = "INSERT INTO `orders` (`cartId`, `customerId`, `billAddId`, `shipAddId`, `paymentMethod`) VALUES ($cartID, $customerID, $billingID, $shippingID, '$value' );";
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
}                                                               
?>
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>
</html>
