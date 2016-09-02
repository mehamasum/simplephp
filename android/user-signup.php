<?php
 
 // android/user-signup.php?auth=XXX
 
 $auth = $_GET['auth'];
 
 if($auth == '01521112085') {
	 require_once('db-connect.php');
	 
	 
	 // insert values
	$sql = "INSERT INTO web_user_info (email, first_name, last_name, sex, dob, weight, height, weight_unit, height_unit, hardwork, password, blood) VALUES ('".$_POST['email']."','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['sex']."',".$_POST['dob'].", ".$_POST['weight']." , ".$_POST['height']." ,'".$_POST['weight_unit']."','".$_POST['height_unit']."', ".$_POST['hardwork'].", '".$_POST['password']."','".$_POST['blood']."');";
	
	if ($connection->query($sql) === TRUE) {
		echo "New records created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error."<br>";
	}
	
	// query
	$sql = "SELECT * FROM web_user_info";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "User: " . $row['email']. " dob: " . $row['dob']. " W: ".$row['weight']."<br>";
		}
	} else {
		echo "0 results<br>";
	}
	 
	/*foreach ($_POST as $param_name => $param_val) {
		echo "Param: $param_name, Value: $param_val<br>";
	}*/
	 
 }