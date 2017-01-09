<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
	
	
	if($mode == '0'){
				
		
		$sql= "select id,type,data,unit,date FROM web_stats WHERE email=".$email.";";
		
			
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
		
		$sql = "delete FROM web_stats WHERE email=".$email.";";
		
		$str= $_POST['allData'];
		
		//echo $str."\n";
		
		if(($result=$connection->query($sql))==TRUE){
			
			
			$json_a=json_decode($str,true);
	
			foreach($json_a['datas'] as $p){
				
			//	echo "foreach\n";
				$sql1 = "INSERT INTO web_stats (email, id, type, data, unit, date) VALUES (" . $email . "," . $p['id'] . ",'" . $p['type'] . "'," . $p['data'] . ",'". $p['unit'] . "', '".$p['date'] . "');";
	
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