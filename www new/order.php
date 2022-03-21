<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/products_page.css">
	<link rel="shortcut icon" href="../www/img/favicon.ico" type="image/x-icon">
</head>
<body>
	<!--Header-->
	<header class="header-container">
		<?php include "header.php"?>
  </header>
  <div class="profile-main">
      <!--Output of User Shipping Adress-->
      <div class="profile-shipadd">
        <h2>Shipping Address</h2>
        <input type="text" placeholder="First Name" name="ship_firstname" id="ship_firstname"/>
        <br>
        <input type="text" placeholder="Last Name" name="ship_lastname" id="ship_lastname"/>
        <br>
        <input type="text" placeholder="Address" name="ship_address" id="ship_address"/>
        <br>
        <input type="text" placeholder="City" name="ship_city" id="ship_city"/>
        <br>
        <input type="text" placeholder="Country" name="ship_country" id="ship_country"/>
        <br>
        <input type="text" placeholder="ZIP Code" name="ship_zip" id="ship_zip"/>
        <br>
        <input type="submit" name="ship_sumit" value="Change" class="button-style"/>
        <br>
      </div>
	</form>
	<footer>
		<!--the footer-->
		<div class="container-footer"></div>
	</footer>
</body>
</html>
