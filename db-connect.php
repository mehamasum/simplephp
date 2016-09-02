<? php
	
	// mysql -u system -p system -h 172.30.137.179 sampledb
	
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	echo $dbhost;
	echo "<br>";
	$dbport = getenv("MYSQL_SERVICE_PORT");
	echo $dbport;
	echo "<br>";
	$dbuser = getenv("MYSQL_USER");
	echo $dbuser;
	echo "<br>";
	$dbpwd = getenv("MYSQL_PASSWORD");
	echo $dbpwd;
	echo "<br>";
	$dbname = getenv("MYSQL_DATABASE");
	echo $dbname;
	echo "<br>";

	$connection = new mysqli($dbhost, "system", "system", "sampledb");
	if ($connection->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	echo "<h1>My awesome DB test</h1>";

?>