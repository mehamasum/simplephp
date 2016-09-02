<?php

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



// create table
$sql = "CREATE TABLE web_user_info(
email VARCHAR(30) PRIMARY KEY,
first_name VARCHAR(50),
last_name VARCHAR(50),
sex VARCHAR(8),
dobirth BIGINT(20),
weight DOUBLE(10,2),
height DOUBLE(10,2),
weight_unit VARCHAR(10),
height_unit VARCHAR(10),
hardwork INT(2),
password VARCHAR(40),
blood VARCHAR(5))";

if ($connection->query($sql) === TRUE) {
	echo "Table created successfully<br>";
} else {
	echo "Error creating table: " . $connection->error."<br>";
}

/*
// insert values
$sql = "INSERT INTO users (username, password)
VALUES ('mehamasum', 'secretpassword');";
$sql .= "INSERT INTO users (username, password)
VALUES ('Mary', 'Moe');";
$sql .= "INSERT INTO users (username, password)
VALUES ('Julie', 'Dooley')";

if ($connection->multi_query($sql) === TRUE) {
	echo "New records created successfully<br>";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error."<br>";
}

*/

/*
// query
$sql = "SELECT username, password FROM users";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "id: " . $row["id"]. " - User: " . $row["username"]. " Password: " . $row["password"]. "<br>";
	}
} else {
	echo "0 results<br>";
}
*/




$connection->close();
?>
