<?php 

$patient_email = $_GET['email'];
$type = $_GET['type'];

include('db-connect.php');

$qry = "SELECT data, date FROM web_stats WHERE email='$patient_email' AND type='$type' LIMIT 30";
 
$result = mysqli_query($connection, $qry);
mysqli_close($connection);

$table = array();
$table['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Date', 'type' => 'string'), array('id' => '', 'label' => 'Reading', 'type' => 'number')
    ); 
	
$rows = array();
foreach($result as $row){
    $temp = array();
     
    //Values
    $temp[] = array('v' => date('m/d/y', $row['date']));
    //echo $row['temperature']."<br>";
    $temp[] = array('v' => doubleval($row['data'])); 
    //echo $row['humidity']."<br>";
    $rows[] = array('c' => $temp);
    }
	
$result->free();
 
$table['rows'] = $rows;
 
$jsonTable = json_encode($table, true);
echo $jsonTable;

?> 