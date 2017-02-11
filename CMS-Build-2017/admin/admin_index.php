<?php
	require_once('phpscripts/init.php');
	require_once('phpscripts/connect.php');
	confirm_logged_in();

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to your Admin Panel</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div id="info-footer">
		<?php echo "<h3>It is currently: ";
		echo date("h:i:s");
		echo "</h3>";
		//$loginString = "SELECT user_lstlgn FROM tbl_user WHERE id={$_SESSION['users_creds']}";
		//$_SESSION['users_lastlogin']  = mysqli_query($link, $loginString);
		//echo $result;
		//echo $_SESSION['users_name'];
		//echo $found_user['user_lstlgn'];
		//echo $loginString;
		echo "<h3> And your last login was at: {$_SESSION['users_mylgn']}</h3>"; ?>
	</div>
	<section class="index-body">
	<h1>Welcome <?php echo $_SESSION['users_name']; ?> to your admin panel</h1>
	<?php
 date_default_timezone_set('US/Eastern');
// http://stackoverflow.com/questions/11147746/php-mysql-display-time-since-users-last-login
// http://php.net/manual/en/function.date.php
// http://stackoverflow.com/questions/5632662/saving-timestamp-in-mysql-table-using-php


$time = date("H:i:s");
if ($time > 6 && $time < 12){
	echo "Good Morning {$_SESSION['users_name']}!";
} if ($time > 12 && $time < 16){
	echo "Good Afternoon {$_SESSION['users_name']}!";
} if ($time > 17 || $time < 3){
	echo "Good Evening {$_SESSION['users_name']}!";
}

?>
	<br>
    <a href="phpscripts/caller.php?caller_id=logout">Sign Out</a>
	</section>


</body>
</html>
