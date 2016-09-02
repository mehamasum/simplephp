<?php
 
 // android/user-signup.php?auth=XXX
 
 $auth = $_GET['auth'];
 
 if($auth == '01521112085') {
	 //require_once('db-connect.php');
	 echo "0 <br>";
	 
	foreach ($_POST as $param_name => $param_val) {
		echo "Param: $param_name, Value: $param_val<br>";
	}
	 
 }