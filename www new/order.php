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
    <!--Output & input of User Shipping Adress-->
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

  <div class="order-container">
    <div class="order-list">
    <table id="order-table" name="order-table" >
    <tr>
      <th>Productname</th>
      <th>Quantity</th>
      <th>Price</th>
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
    <tr>
      <td>Musterprodukt</td>
      <td>x2</td>
      <td>55.50€</td>
    </tr>
    <tfoot>
    <tr>
      <td id="no-border">Tax Rate: </td>
    </tr>
    <tr>
      <td id="no-border">Total Price: </td>
    </tr>
  </tfoot>
  </table>
  <input type="submit" value="Proceed" class="button-proceed"></input>
  </div>
  </div>

  <div class="payment-container">
    <div class="payment-options">
      <h2 id="text-payment">Payment Options</h2>
      <input type="checkbox" name="pay_card" value="" style="margin-bottom: 30px;"> Pay with card
      <br>
      <input type="checkbox" name="payment_site" value=""> Payment on site
    </div>
  </div>

</form>
<footer>
  <!--the footer-->
  <div class="container-footer"></div>
</footer>
</body>
</html>
