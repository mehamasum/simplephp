<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
	
	
 if($auth == '01521112085') {
	
	
	$sql = "SELECT email_doc FROM physician_patient WHERE email_patient=". $email. ";";
	
	if(($result = $connection->query($sql))==FALSE){
		echo "0\n";
	}
	
	if ($result->num_rows==0) { //add to the list
		
		echo "0\n";
		die();
		
	}
	else{
		//echo "here";
		$error= 0;
		$jsonData = array();
		
		foreach($result as $row){
			$sql_doc_detail = "SELECT email,name,degree,specialist,visit_hour,phone,location FROM web_physician WHERE email='". $row['email_doc']."'";
			
			if(($result_doc_detail=$connection->query($sql_doc_detail))==TRUE){
			
				while ($array = mysqli_fetch_row($result_doc_detail)) {
					$jsonData[] = $array;
				}	
			}else{
				$error= 1;
			}
		}
		if($error==0){
			echo json_encode($jsonData)."\n";
		}else{
			echo "0\n";
		}
	}
	
 }
 else{
	 
	 echo "0\n";
 }
	
	
	mysqli_close($connection);

?>