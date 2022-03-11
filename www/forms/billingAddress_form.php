<!--this is not a full page but a popup for changing the billingadress-->

<!--link css file-->
<link rel="stylesheet" href="../styles/style.css">
<!--popup html container-->
<div class="profile-shipadd-container">
	<!--input container (repeated for every input)-->
	<div class="label-container">
		<!--input label-->
		<label for="address">Address:</label>
		<!--input as text-->
		<input type="text" placeholder="Address" name="address" id="billadd-add" required/>
	</div>
	<div class="label-container">
		<label for="city">City:</label>
		<input type="text" placeholder="City" name="city" id="billadd-city" required/>
	</div>
	<div class="label-container">
		<label for="country">Country:</label>
		<input type="text" placeholder="Country" name="country" id="billadd-country" required/>
	</div>
	<div class="label-container">
		<label for="zipcode">Zipcode:</label>
		<input type="text" placeholder="Zipcode" name="zipcode" id="billadd-zipcode" required/>
	</div>
	<!--buton to submit changes-->
	<input type="button" value="Change" onclick="" class="button-style"/>
</div>