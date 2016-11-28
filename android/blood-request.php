<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
	
	
	if($mode == '1'){
		
		
				
		
		$sql= "select * FROM web_request WHERE blood='".$_POST['blood']."' and is_fulfilled=0".";";
		
			
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
		
			
			
		$sql = "INSERT INTO web_request (reqfrom, name, sex, time, bags, urgent, reason, phone, latitude, longitude, is_fulfilled, blood)
		VALUES ( ". $email . ",'" . $_POST['name'] . "','" . $_POST['sex'] . "',". $_POST['time'] . "," . $_POST['bags'] . ",". $_POST['urgent'] . ",'". $_POST['reason'] . "','". $_POST['phone'] . "',". $_POST['latitude'] . ",". $_POST['longitude'] . ",". $_POST['is_fulfilled'] . ",'". $_POST['blood']  . "' );";

		if ($connection->query($sql) == TRUE) {
			
			echo "1\n";
		
		} else {
			echo "0\n";
		}	
		
	}
	
	
		
 }
	
mysqli_close($connection);
 

?>