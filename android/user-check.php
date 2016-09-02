<?php
 
 // android/user-check.php?auth=XXX&email=XXXX
 
 $auth = $_GET['auth'];
 $email = $_GET['email'];
 
 if($auth == '01521112085') {
	require_once('db-connect.php');
	// query
	$sql = "SELECT * FROM web_user_info WHERE email='$email'";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		echo "0" . <br>;
	}
	else {
		echo "1". <br>;
	}
	mysqli_close($connection);
 }