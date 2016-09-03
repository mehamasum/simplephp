<?php
 
 // android/user-login.php?auth=XXX
 
 $auth = $_GET['auth'];

 
 if($auth == '01521112085') {
	
	$email = $_GET['email'];
	$pass = $_GET['pass'];	
	 
	require_once('db-connect.php');
	
	// query
	$sql = "SELECT * FROM web_user_info WHERE email='$email' AND password='$pass'";
	$result = $connection->query($sql);
	
	if ($result->num_rows > 0) {
		
		while($row = mysqli_fetch_array($result)) {
			array_push( $reply, 
			array('first_name'=>$row['first_name'],
			'last_name'=>$row['last_name'],
			'sex'=>$row['sex'],
			'dob'=>$row['dob'],
			'weight'=>$row['weight'],
			'height'=>$row['height'],
			'weight_unit'=>$row['weight_unit'],
			'height_unit'=>$row['height_unit'],
			'hardwork'=>$row['hardwork'],
			'blood'=>$row['blood']) );
		}

		echo json_encode(array("reply"=>$reply)); 
	}
	else {
		echo "0";
	}
	
 }
	
mysqli_close($connection);
 
?>