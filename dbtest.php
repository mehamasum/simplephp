<?php
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
echo "<br><br><br><br><h1>My awesome PHP test</h1>";
$query = "SELECT * from users";
$rs = $connection->query($query);
while ($row = $rs->fetch_array(MYSQLI_ASSOC)) {
    echo $row['user_id'] . " " . $row['username'] . "\n";
}
$rs->close();
$connection->close();
?>