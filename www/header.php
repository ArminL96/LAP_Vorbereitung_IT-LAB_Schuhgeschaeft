<?php
/*
	Header File
	Function to create the Header
	HTML Code written into a Variable
	Echo the Variable
*/
	//header when user is logged in
	function get_the_header_prof() {
		
		$header_html = "<div class='header-child1'><a href='index.php'>Shopname</a></div><div class='header-child2'><ul><li><a href='userprofile.php'>My Profile</a></li><li><a href='#'>My Orders</a></li><li><a href='#'>My Cart</a></li></ul></div>";
		echo($header_html);
	}
	//header when user is not logged in
	function get_the_header_log() {
		
		$header_html = "<div class='header-child1'><a href='index.php'>Shopname</a></div><div class='header-child2'><ul><li><a href='login.php'>Login</a></li></ul></div>";
		echo($header_html);
	}
	//header with no nav
	function get_the_header_none() {
		
		$header_html = "<div class='header-child1'><a href='index.php'>Shopname</a></div><div class='header-child2'></div>";
		echo($header_html);
	}
?>