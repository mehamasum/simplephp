<?php
 
	require_once('db-connect.php');
	
	$auth = $_GET['auth'];
	$email= $_GET['email'];
	$mode = $_GET['mode'];
 
 if($auth == '01521112085') {
	
	if($mode == '0'){
		$table_name= $_POST['table_name'];
		
		$sql= "select time FROM web_timestamp WHERE table_name= '".$table_name."' and email=".$email." ;";
		$result = $connection->query($sql);
	//	echo $sql;
		
		if($result->num_rows >0){
			$row= $result->fetch_assoc();
			$time= $row['time']; 
			echo "$time\n";
		}
		else{
			echo "0";
		}
	}
	else if($mode == '1'){
		
		$table_name= $_POST['table_name'];
		$time= $_POST['time'];
		
		
		
		$sql= "UPDATE web_timestamp SET time=".$time.
			" WHERE table_name= '".$table_name."' and email=".$email." ;";
		//$result = $connection->query($sql);
		
		
			
		if($connection->query($sql)){
			echo "1\n";
		}
		else{
			echo "0\n";
		}
		
	}
	
	
		
 }
	
mysqli_close($connection);
 



?>