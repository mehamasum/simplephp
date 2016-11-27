<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
				
		
	$sql= "select token, doc_email, date, time, status FROM web_appointment WHERE patient_email=".$email.";";
	
		
	if(($result=$connection->query($sql))==TRUE){
		
		$jsonData = array();
		
		while ($array = mysqli_fetch_row($result)) {
			$jsonData[] = $array;
		}
		
		echo json_encode($jsonData)."\n";			
	}
	else{
		echo "0\n";
	}
		
	
	
		
 }
	
	mysqli_close($connection);
 

?>