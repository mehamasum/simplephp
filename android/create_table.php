<?php

	require 'connect.inc.php';
	
	$create_table_stat = "CREATE TABLE web_stats( ".
       "email VARCHAR(100) NOT NULL, ".
       "id INT NOT NULL, ".
       "type VARCHAR(40), ".
       "data DOUBLE, ".
	   "unit VARCHAR(40),".
	   "date BIGINT,".
       "PRIMARY KEY ( email, id )); ";
	   
	$create_table_timestamp = "CREATE TABLE web_timestamp( ".
       "table_name VARCHAR(100) NOT NULL, ".
       "time BIGINT, ".
       "PRIMARY KEY ( table_name )); ";
	
	$result = $connection->query($create_table_stat);
	$result = $connection->query($create_table_timestamp);

	if ($result==TRUE) {
		echo "0\n";
	}
	else {
		echo "1\n";
	}
	mysqli_close($connection);
	  
?>