<?php
 
 // android/add-doc.php?auth=XXX
 
 $auth = $_GET['auth'];

 
 if($auth == '01521112085') {
	
	$email = $_POST['email'];
	$doc = $_POST['doc'];	
	 
	require_once('db-connect.php');
	
	
	$sql = "SELECT * FROM web_physician WHERE email='". $doc."'";
	$result = $connection->query($sql);
	if ($result->num_rows==0) { //no doc !
		echo "0";
		die();
	}
	
	// query
	$sql = "SELECT * FROM physician_patient WHERE email_doc='". $doc . "' AND email_patient='". $email. "'";
	$result = $connection->query($sql);
	
	if ($result->num_rows==0) { //add to the list
		// query
		$sql = "INSERT INTO physician_patient (email_doc, email_patient) VALUES ('$doc', '$email')";
		$result = $connection->query($sql);
		if ($connection->query($sql) == FALSE) {
			echo "1";
			die();
		}
	}
	
	// send the doc info
	$sql = "SELECT * FROM web_physician WHERE email='". $doc."'";
	$new_result = $connection->query($sql);
	$row = $new_result->fetch_assoc();
	
	$reply = array('name'=>$row['name'],
		'degree'=>$row['degree'],
		'specialist'=>$row['specialist'],
		'phone'=>$row['phone'],
		'location'=>$row['location'],
		'visit_hour'=>$row['visit_hour']);

	echo json_encode($reply); 
	
	mysqli_close($connection);
	
 }
	

 
?>