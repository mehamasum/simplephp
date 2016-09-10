<?php

	require_once('db-connect.php');
	
	$create_table_stat = "CREATE TABLE web_stats( ".
       "email VARCHAR(100) NOT NULL, ".
       "id INT NOT NULL, ".
       "type VARCHAR(40), ".
       "data DOUBLE, ".
	   "unit VARCHAR(40),".
	   "date BIGINT,".
       "PRIMARY KEY ( email, id )); ";
	   
	$create_table_timestamp = "CREATE TABLE web_timestamp( ".
		"email VARCHAR(100) NOT NULL, ".
       "table_name VARCHAR(100) NOT NULL, ".
       "time BIGINT, ".
       "PRIMARY KEY ( email,table_name )); ";
	   
	   
	$create_table_user_info = "CREATE TABLE web_user_info( ".
		"email VARCHAR(30) PRIMARY KEY, ".
		"first_name VARCHAR(50), ".
		"last_name VARCHAR(50), ".
		"sex VARCHAR(8), ".
		"dob BIGINT(20), ".
		"weight DOUBLE(10,2), ".
		"height DOUBLE(10,2), ".
		"weight_unit VARCHAR(10), ".
		"height_unit VARCHAR(10), ".
		"hardwork INT(2), ".
		"password VARCHAR(40), ".
		"blood VARCHAR(5));";
	
	$create_table_appointment = "CREATE TABLE web_appointment( ".
		"token INT PRIMARY KEY AUTO_INCREMENT, ".
		"doc_email VARCHAR(50), ".
		"patient_email VARCHAR(50), ".
		"date BIGINT, ".
		"time BIGINT, ".
		"status INT );"; // 1=pending, 2= ac, 3=wa


	
	//$result = $connection->query($create_table_stat);
	$result = $connection->query($create_table_appointment);
	//$result = $connection->query($create_table_user_info);
	if ($result==TRUE) {
		echo "0\n";
	}
	else {
		echo "1\n";
	}
	mysqli_close($connection);
	  
?>