<?php

	// mysql -u system -p -h 172.30.141.253
	// system 
	// use sampledb
	
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");

	$connection = new mysqli($dbhost, "system", "system", "sampledb");
	if ($connection->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}

?>