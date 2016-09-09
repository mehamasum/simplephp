<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
 
 if($auth == '01521112085') {
	
	$tables = array("stats","user_info");
	
	foreach($tables as $table){
		$sql = "INSERT INTO web_timestamp (email, table_name, time) VALUES (" . $email . ",'" . $table . "',0 );";
		
		if ($connection->query($sql) != TRUE) {
			echo "0\n";
			die();
		}
		echo "1\n";
	}
			
		
 }
	
mysqli_close($connection);
 



?>