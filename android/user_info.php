<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
	
	
	if($mode == '0'){
				
		
		$sql= "select email, password, first_name, last_name, sex, blood, weight_unit, height_unit, hardwork, dob, weight, height FROM web_user_info WHERE email=".$email.";";
		
			
		if(($result=$connection->query($sql))==TRUE){
			
			$jsonData = array();
			
			while ($array = mysqli_fetch_row($result)) {
				$jsonData[] = $array;
			}
			
			echo json_encode($jsonData)."\n";			
		}
		else{
			//echo mysqli_error($connection);
		}
		
	}
	else if($mode == '1'){
		
		$sql = "delete FROM web_user_info WHERE email=".$email.";";
		
		$str= $_POST['allData'];
		
		//echo $str."\n";
		
		if(($result=$connection->query($sql))==TRUE){
			
			
			$json_a=json_decode($str,true);
	
			foreach($json_a['datas'] as $p){
				
			//	echo "foreach\n";
				$sql1 = "INSERT INTO web_user_info (email, password, first_name, last_name, sex, blood, weight_unit, height_unit, hardwork, dob, weight, height) VALUES (" . $email . ",'" . $p['password'] . "','" . $p['first_name'] . "','" . $p['last_name'] 
						."','". $p['sex'] . "', '". $p['blood'] . "', '". $p['weight_unit'] . "', '". $p['height_unit'] . "', ". $p['hardwork'] . ", ". $p['dob'] . ", ". $p['weight'] . ", ".$p['height'] . ");";
	
				if ($connection->query($sql1) == TRUE) {
					echo "1\n";
				} else {
					echo mysqli_error($connection);
				}
			}	
		}
		else{
			echo mysqli_error($connection);
		}

		
	}
	
		
 }
	
mysqli_close($connection);
 



?>