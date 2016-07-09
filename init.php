<?php
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$connection = new mysqli($dbhost, "system", "system", "sampledb");
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

// create table
$sql = "CREATE TABLE userdb (
username VARCHAR(30) NOT NULL PRIMARY KEY,
password VARCHAR(50) NOT NULL
)";

if ($connection->query($sql) === TRUE) {
	echo "Table \"userdb\" created successfully<br>";
} else {
	echo "Error creating table: " . $connection->error."<br>";
}

// insert values
$sql = "INSERT INTO userdb (username, password)
VALUES ('mehamasum', 'secretpassword');";
$sql .= "INSERT INTO userdb (username, password)
VALUES ('maliha', 'malihasecretpassword');";
$sql .= "INSERT INTO userdb (username, password)
VALUES ('fahim', 'hosneara')";

if ($connection->multi_query($sql) === TRUE) {
	echo "New records created successfully<br>";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error."<br>";
}

$connection->close();
?>