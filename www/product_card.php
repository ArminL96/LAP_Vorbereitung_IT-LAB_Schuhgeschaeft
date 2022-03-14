<?php
$mysqli = new mysqli("localhost", "root", "", "Schuhgeschaeft");
#überprüft ob keine verbindung hergestellt werden konnte
if($mysqli->connect_error){
	#wenn ja ist die verbindung fehlgeschlagen
	die("Verbindung fehlgeschlagen: ".$mysqli->connect_error);
}
#‎daten aus einer datenbank‎ werden in eine variable gespeichert
$sql = "SELECT * FROM product INNER JOIN category ON product.categoryId = category.id";

#spalten aus der datenbank auswählen wo die product_category Blumenstrauß ist
$result = $mysqli->query($sql);
?>

<?php
#geht jede spalte der Tabelle Products durch
while($row = mysqli_fetch_assoc($result)){
	?>
	<div class="article-card">
		<?php
		//Wichtig: der Bildname muss mit dem Produktnamen in der Datenbank übereinstimmen
		//löscht alle leerzeichen aus dem String
		$name = $row['name'];
		$name = str_replace(' ', '', $name);
		echo "<img src= $name.jpg>"
		?>
		<div class="article-body">
			<!-- ausgabe der daten -->
			<p>Name: <?php echo $row['name'];?></p>
			<p>Size: <?php echo $row['size'];?></p>
			<p>Color: <?php echo $row['color'];?></p>
			<p>Price: <?php echo $row['price'];?>€</p>
			<p>Category: <?php echo $row['Name']?></p>
		</div>
		<div class="card-footer">
			<a href="" class="btn btn-shopcart">Add to Card</a>
		</div>
	</div>
	<?php
}
?>
