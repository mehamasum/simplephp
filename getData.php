<?php 

// This is just an example of reading server side data and sending it to the client.
// It reads a json formatted text file and outputs it.

$string = file_get_contents("data.json");
echo $string;

// Instead you can query your database and parse into JSON etc etc

?> 


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

// query
$sql = "SELECT humidity FROM measures";
$result = $connection->query($sql);

//create an array
$emparray = array();
while($row =mysqli_fetch_assoc($result))
{
	$emparray[] = $row;
}

echo json_encode($emparray);

$connection->close();
?>
