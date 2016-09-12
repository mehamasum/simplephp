<?php
 
 // android/add-doc.php?auth=XXX
 
 $auth = $_GET['auth'];

 
 if($auth == '01521112085') {
	
	$token = $_GET['token'];
	$status = $_GET['status'];	
    $time = $_POST['time'];
	 
	require_once('db-connect.php');

    $sql = "UPDATE web_appointment SET status=$status, time='$time' WHERE token=$token";
    echo $sql;

    if ($connection->query($sql) == TRUE) {
        mysqli_close($connection);    
    }
	
 }
 
?>