<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
	
	
	if($mode == '1'){
				
		
		$sql= "select status, time FROM web_appointment WHERE token=".$_POST['token'].";";
		
			
		if(($result=$connection->query($sql))==TRUE){
			
			if ($result->num_rows > 0) {
			
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
		else{
			echo "0\n";
		}
		
	}
	else if($mode == '0'){
						
			
		$sql = "INSERT INTO web_appointment (doc_email, patient_email, date, time, status) VALUES ( '". $_POST['doc_email'] . "'," . $email . "," . $_POST['date'] . "," . "'0'" . ",". $_POST['status']  . " );";

		if ($connection->query($sql) == TRUE) {
			
			$sql1 = "SELECT MAX(token) ret FROM web_appointment WHERE patient_email=".$email.";";
			$max_token= 0;
			
			$result = $connection->query($sql1);
			
	
			if ($result->num_rows > 0) {
		
				$row = $result->fetch_assoc();
				
				echo $row['ret']."\n";
			}
				
			else{
				echo "0\n";
			}
		
		} else {
			echo "0\n";
		}	
		
	}
	
	
		
 }
	
mysqli_close($connection);
 

?>