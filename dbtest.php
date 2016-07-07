<?php
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("MYSQL_USER");
$dbpwd = getenv("MYSQL_PASSWORD");
$dbname = getenv("MYSQL_DATABASE");

$connection = mysql_connect($dbhost.":".$dbport, $dbuser, $dbpwd);

if ($connection->connect_errno) {
    echo "db connect korte error"
    exit();
}
echo "<br><br><br><br>My awesome PHP test";

$dbconnection = mysql_select_db($dbname);
mysql_close();
?>
