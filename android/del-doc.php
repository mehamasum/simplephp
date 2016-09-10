<?php
 
 // android/add-doc.php?auth=XXX
 
 $auth = $_GET['auth'];

 
 if($auth == '01521112085') {
	
	$email = $_POST['email'];
	$doc = $_POST['doc'];	
	 
	require_once('db-connect.php');
	
	// query
	$sql = "DELETE FROM physician_patient WHERE email_doc='". $doc . "' AND email_patient='". $email. "'";
	
	if ($connection->query($sql) == FALSE) echo "0";
	else echo '$doc';
	
	mysqli_close($connection);
 }
	
?>