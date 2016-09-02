<? php
	
	// mysql -u system -p system -h 172.30.137.179 sampledb
	
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	echo $dbhost."<br>";
	$dbport = getenv("MYSQL_SERVICE_PORT");

	$connection = new mysqli($dbhost, "system", "system", "sampledb");
	if ($connection->connect_errno) {
		echo $mysqli->connect_error."<br>";
		exit();
	}
?>