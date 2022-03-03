<?php
/*
	Header File
	Function to create the Header
	HTML Code written into a Variable
	Echo the Variable
*/

	function get_the_header() {
		$header_html = '<div class="header-child1"><a href="index.php">Shopname</a></div><div class="header-child2"><ul><li><a href="login.php">Login</a></li><li><a href="userprofile.php">Profile</a></li><li><a href="#">Cart</a></li></ul></div>';
		echo($header_html);
	}
?>