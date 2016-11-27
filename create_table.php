<?php

	//require 'connect.inc.php';
	require 'db-connect.php';
	
	$create_table_stat = "CREATE TABLE web_stats( ".
       "email VARCHAR(100) NOT NULL, ".
       "id INT NOT NULL, ".
       "type VARCHAR(40), ".
       "data DOUBLE, ".
	   "unit VARCHAR(40),".
	   "date VARCHAR(50),". // --> changed from BIGINT
       "PRIMARY KEY ( email, id )); ";
	   
	$create_table_timestamp = "CREATE TABLE web_timestamp( ".
		"email VARCHAR(100) NOT NULL, ".
       "table_name VARCHAR(100) NOT NULL, ".
       "time BIGINT, ".  // ---> unchanged
       "PRIMARY KEY ( email,table_name )); ";
	   
	   
	$create_table_user_info = "CREATE TABLE web_user_info( ".
		"email VARCHAR(30) PRIMARY KEY, ".
		"first_name VARCHAR(50), ".
		"last_name VARCHAR(50), ".
		"sex VARCHAR(8), ".
		"dob BIGINT(20), ". // ---> unchanged
		"weight DOUBLE(10,2), ".
		"height DOUBLE(10,2), ".
		"weight_unit VARCHAR(10), ".
		"height_unit VARCHAR(10), ".
		"hardwork INT(2), ".
		"password VARCHAR(40), ".
		"photo VARCHAR(60), ". //added
		"phone VARCHAR(40), ". //added
		"latitude DOUBLE(10,2), ". //added
		"longitude DOUBLE(10,2), ". //added
		"prefer_dis DOUBLE(10,2), ". //added
		"is_donor INT(2), ". //added
		"blood VARCHAR(5));";
		

	$create_table_request = "CREATE TABLE web_request( ".
		"reqid INT PRIMARY KEY AUTO_INCREMENT, ".
		"reqfrom VARCHAR(50), ".
		"name VARCHAR(50), ".
		"sex VARCHAR(8), ".
		"time BIGINT(20), ". 
		"bags INT, ".
		"urgent INT(2), ".
		"reason VARCHAR(40), ".
		"phone VARCHAR(40), ". 
		"latitude DOUBLE(10,2), ". 
		"longitude DOUBLE(10,2), ". 
		"is_fulfilled INT(2), ". 
		"blood VARCHAR(5));";
	
		/*
		
		
		// *************************************************************************		
			//request table
			 Field       | Type         | Null | Key | Default | Extra          |
		+-------------+--------------+------+-----+---------+----------------+
		| reqid       | int(6)       | NO   | PRI | NULL    | auto_increment |
		| reqfrom     | varchar(50)  | YES  |     | NULL    |                |
		| name        | varchar(30)  | YES  |     | NULL    |                |
		| phone       | varchar(20)  | YES  |     | NULL    |                |
		| bloodgroup  | varchar(20)  | YES  |     | NULL    |                |
		| urgent      | varchar(10)  | YES  |     | NULL    |                |
		| lattitude   | double       | YES  |     | NULL    |                |
		| longitude   | double       | YES  |     | NULL    |                |
		| time        | bigint(20)   | YES  |     | NULL    |                |
		| bags        | int(6)       | YES  |     | NULL    |                |
		| reason      | varchar(200) | YES  |     | NULL    |                |
		| isfulfilled | int(6)       | YES  |     | NULL    |                |
		+-------------+--------------+------+-----+---------+----------------+

		//***************************************************************************


		*/

	
	$create_table_appointment = "CREATE TABLE web_appointment( ".
		"token INT PRIMARY KEY AUTO_INCREMENT, ".
		"doc_email VARCHAR(50), ".
		"patient_email VARCHAR(50), ".
		"date VARCHAR(50), ". // --> changed from BIGINT
		"time VARCHAR(50), ". // --> changed from BIGINT
		"status INT );";
		
	$create_table_physician_patient= "CREATE TABLE physician_patient ( ".
		"id MEDIUMINT NOT NULL AUTO_INCREMENT, ".
		"email_doc VARCHAR(30), ".
		"email_patient VARCHAR(30), ".
		"PRIMARY KEY (id) );";
	
	$create_table_physician= "CREATE TABLE web_physician( ".
		"email VARCHAR(30) PRIMARY KEY, ".
		"name VARCHAR(50), ".
		"degree VARCHAR(100), ".
		"specialist VARCHAR(100), ".
		"password VARCHAR(40), ".
		"phone VARCHAR(40), ".
		"location VARCHAR(200), ".
		"visit_hour VARCHAR(200)); ";

		
	$example= date('d M Y', 1474480800-(20*60*60));

	//echo $example;
	$result = $connection->query($create_table_stat);
	$result = $connection->query($create_table_timestamp);
	$result = $connection->query($create_table_user_info);
	$result = $connection->query($create_table_appointment);
	$result = $connection->query($create_table_physician_patient);
	$result = $connection->query($create_table_physician);
	$result = $connection->query($create_table_request);
	
	if ($result==TRUE) {
		echo "0\n";
	}
	else {
		echo mysqli_error($connection);
	}
	mysqli_close($connection);
	  
?>