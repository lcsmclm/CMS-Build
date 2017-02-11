<?php

	//echo "login.php";

	function logIn($username, $password, $ip) {
		require_once("connect.php");
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		$loginString = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
		$user_set = mysqli_query($link, $loginString);
		$attemptString = "SELECT user_attempt FROM tbl_user WHERE user_name='{$username}'";
		$users_attempts = mysqli_query($link, $attemptString);
		//echo $user_attempts;
		//echo $attemptString;
		//echo mysqli_num_rows($user_set); //was there a match
 date_default_timezone_set('US/Eastern');
		if(mysqli_num_rows($user_set)){
			$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			//echo $found_user ['user_fname'];
			$id = $found_user['user_id'];
			$_SESSION['users_creds'] = $id;
			$_SESSION['users_mylgn'] = $found_user['user_lstlgn'];
			$_SESSION['users_name'] = $found_user['user_name'];
			$_SESSION['users_fname'] = $found_user['user_fname'];
			//$userloginAttempts = "UPDATE tbl_user SET user_attempt='{$currentAttempt}' WHERE user_id={$id}";
			if(mysqli_query($link, $loginString)) {
				$updateString = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
				$updateQuery = mysqli_query($link, $updateString);
				$currDate = date('Y-m-d H:i:s');
				$userloginTime = "UPDATE tbl_user SET user_lstlgn='{$currDate}' WHERE user_id={$id}";

				$updateQueryTime = mysqli_query($link, $userloginTime);
			//$updateQueryLogins = "UPDATE tbl_user SET user_attempt = 0 user_name = '{$username}'"; //reset count on successful login
			$updateQueryLogins = "UPDATE tbl_user SET user_attempt = '0' WHERE user_id = '{$id}'";
$updateQueryLoginsToDB = mysqli_query($link, $updateQueryLogins);
			}

			redirect_to("admin_index.php");

		} else {
			$users_attempts = mysqli_query($link, $attemptString);
			$attemptString = "SELECT user_attempt FROM tbl_user WHERE user_name='{$username}'";
				$expirDate = date('Y-m-d H:i:s');
//$found_user = mysqli_fetch_array($attemptString, MYSQLI_ASSOC); //Errors
//JP Helped me figure out that I needed to restate everything down here and base my content off of $username and not try to get the $id again
$found_user = mysqli_fetch_array($users_attempts, MYSQLI_ASSOC);
$failed_attempts = $found_user['user_attempt'];

if ($failed_attempts > 2) {
	echo "locked";
	$updateAttempt = "UPDATE tbl_user SET user_attempt = user_attempt + 1 WHERE user_name = '{$username}'";
	$userloginTime = "UPDATE tbl_user SET user_expir='{$expirDate}' WHERE user_name = '{$username}'";
} else{
	$updateAttempt = "UPDATE tbl_user SET user_attempt = user_attempt + 1 WHERE user_name = '{$username}'";
	$userloginTime = "UPDATE tbl_user SET user_expir='{$expirDate}' WHERE user_name = '{$username}'";
}
	$updateQueryTime = mysqli_query($link, $updateAttempt);
	$userExpiredDate = mysqli_query($link, $userloginTime);


			//for ($userAttempt = 0; $userAttempt <= 3;$userAttempts++){
				//$currentAttempt = $userAttempt;
		//$userloginAttempts = "UPDATE tbl_user SET user_attempt='{$currentAttempt}' WHERE user_id={$id}";
		//$updateQueryAttempts = mysqli_query($link, $userloginAttempts);

		//$found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
		//echo $found_user ['user_fname'];
		$message = "Username or password was incorrect. Please try again.";
	//echo $currentAttempt;

	//if($currentAttempt > 3){
	//echo "oml";
	//}

			return $message;

		}


		mysqli_close($link);
	}

?>
