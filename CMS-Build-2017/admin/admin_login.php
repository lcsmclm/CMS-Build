<?php
	//ini_set('display_errors',1); //error reporting on mac
	//error_reporting(E_ALL);
	require_once("phpscripts/init.php");
	$ip = $_SERVER["REMOTE_ADDR"];
	//echo $ip;



	if(isset($_POST['submit'])){
		//echo "Congrats, you're a good clicker!";
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if($username != "" && $password != "") {
			//echo "all good!";
			$result = logIn($username, $password, $ip);
			$message = $result;
		}else{
			$message = "Please fill in the required fields.";
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome Company Name</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<section class='index-body'>
	<h1>CMS Login</h1>

    <?php

		if(!empty($message)){
			echo $message;
		}

	?>

    <form action="admin_login.php" method="post">
    	<label>Username:</label>
        <input class='form-field'type="text" name="username" value="">

        <label>Password:</label>
        <input class='form-field' type="password" name="password" value="">

        <input class='form-field-submit' type="submit" name="submit" value="Login">
    </form>
</div>
</body>
</html>
