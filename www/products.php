<?php
$mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
#checks if no connection could be established
if($mysqli->connect_error){
	#if true the connection failed
	die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
}

$sql = "SELECT * FROM product INNER JOIN category ON product.categoryId = category.id";

$result = $mysqli->query($sql);
?>

<?php
#goes through each column of the Products table
while($row = mysqli_fetch_assoc($result)){
	?>
	<div class="article-card">
		<?php
		//Important: the image name must match the product name in the database
		//deletes all spaces from the string
		$name = $row['name'];
		$name = str_replace(' ', '', $name);
		//output of the image with the same name as the name of the product
		echo "<img src= img/$name.jpg>"
		?>
		<div class="article-body">
			<!-- output data products: name, size, price, category-->
			<p id="name"><?php echo $row['name'];?></p>
			<div class="under">
			<p id="size">Size: <?php echo $row['size'];?></p>
			<p id="price">Price: <?php echo $row['price'];?>€</p>
			<p id="category">Category: <?php echo $row['Name']?></p>
			</div>
		</div>
		<div class="card-footer">
			<a href="" class="btn btn-shopcart">Add to Card</a>
		</div>
	</div>
	<?php
}
?>
