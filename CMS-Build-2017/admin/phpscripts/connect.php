<?php
	// Set up connection credentials
	$user = "root";
	$pass = ""; //PC
	//$pass = "root"; //MAC
	$url = "localhost";
	$db = "db_movies";

	$link = mysqli_connect($url, $user, $pass, $db); //PC
	//$link = mysqli_connect($url, $user, $pass, $db, "8889"); //Mac 8889


	/* check connection */
	if(mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
