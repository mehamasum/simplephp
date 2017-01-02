<?php

//echo 'hello world';

//$a_host= '192.168.0.107';
$a_host= 'localhost';
$a_user= 'rspbdcom';
$a_pass= '';
$a_db= 'rspbdcom_healthpal';

// Create connection
$connection = new mysqli($a_host, $a_user, $a_pass, $a_db);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
	
	echo "connected :D\n";
} 


/*if(!mysql_connect($a_host,$a_user,$a_pass) || !mysql_select_db('healthpal')){
	
	echo 'not connected';
	die();
}
else{
	echo 'connected';
}
*/


?>