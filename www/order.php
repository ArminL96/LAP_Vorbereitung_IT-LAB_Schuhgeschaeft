<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style/order_style.css">
  <link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
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

  <div class="adress-container">
    <!--Output & input of User Shipping Address-->
    <h2>Your Order</h2>
    <div class="order-shipadd">
      <h2 id="text-adress">Shipping Address</h2>
      <p>First Name: <input type="text" name="ship_firstname" id="ship_firstname"/></p>
      <p>Last Name:  <input type="text" name="ship_lastname" id="ship_lastname"/></p>
      <p>Address:   <input type="text" name="ship_address" id="ship_address"/></p>
      <p>City:      <input type="text" name="ship_city" id="ship_city"/></p>
      <p>Country:   <input type="text"name="ship_country" id="ship_country"/></p>
      <p>ZIP Code:  <input type="text" name="ship_zip" id="ship_zip"/></p>
      <a href="" name="ship_sumit" class="button-style">Change</a>
    </div>

    <div class="order-billadd">
      <!--Output & input of User Billing Address-->
      <h2 id="text-adress">Billing Address</h2>
      <p>First Name: <input  type="text" name="ship_firstname" id="ship_firstname"/></p>
      <p>Last Name:  <input type="text" name="ship_lastname" id="ship_lastname"/></p>
      <p>Address:   <input type="text" name="ship_address" id="ship_address"/></p>
      <p>City:      <input type="text" name="ship_city" id="ship_city"/></p>
      <p>Country:   <input type="text"name="ship_country" id="ship_country"/></p>
      <p>ZIP Code:  <input type="text" name="ship_zip" id="ship_zip"/></p>
      <a href="" name="ship_sumit" class="button-style">Change</a>
    </div>
  </div>
  <!--Order View-->
  <div class="order-container">
    <div class="order-list">
      <table id="order-table" name="order-table" >
        <tr>
          <!--Header Table-->
          <th>Productname</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
        <tr>
          <!--Input of Order-->
          <td>Musterprodukt</td>
          <td>x2</td>
          <td>55.50€</td>
        </tr>
        <tr>
          <td>Musterprodukt</td>
          <td>x2</td>
          <td>55.50€</td>
        </tr>
        <tr>
          <td>Musterprodukt</td>
          <td>x2</td>
          <td>55.50€</td>
        </tr>
        <tr>
          <td>Musterprodukt</td>
          <td>x2</td>
          <td>55.50€</td>
        </tr>
      </table>
      <!--Table footer -->
      <p class ="table-foot" style="border-top: 2px solid #db6c6c;">Tax Rate: </p>
      <p class ="table-foot-text" name="tax_rate"> Austria 20%</p>
      <p class ="table-foot">Total Price: </p>
      <p class ="table-foot-text" name="total_price">5000€</p>
      <input type="submit" value="Proceed" class="button-proceed" name="proceed_button"></input>
    </div>
  </div>
  <!--Payment Options -->
  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Options</h2>
      <!--Checkboxs for Payment Options-->
      <div class="checkbox-payment">
        <input type="checkbox" name="pay_card" id="pay_card" value=""> Pay with card
        <label for="pay_card"></label>
        <br>
        <input type="checkbox" name="payment_site" id="payment_site" value=""> Payment on site
        <label for="payment_site"></label>
      </div>
    </div>
  </div>
<footer>
  <!--the footer-->
  <div class="container-footer"></div>
</footer>
</body>
</html>
