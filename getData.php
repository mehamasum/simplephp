<?php 

// mysql -u system -p system -h 172.30.137.179 sampledb

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");

$con = new mysqli($dbhost, "system", "system", "sampledb");
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//echo "My awesome DB Test"."<br>";

$qry = "SELECT temperature, humidity FROM measures";
 
$result = mysqli_query($con, $qry);
mysqli_close($con);

$table = array();
$table['cols'] = array(
    //Labels for the chart, these represent the column titles
    array('id' => '', 'label' => 'Value', 'type' => 'string'),
    array('id' => '', 'label' => 'Date', 'type' => 'number')
    ); 
	
$rows = array();
foreach($result as $row){
    $temp = array();
     
    //Values
    $temp[] = array('v' => $row['temperature']);
    //echo $row['temperature']."<br>";
    $temp[] = array('v' => (int) $row['humidity']); 
    //echo $row['humidity']."<br>";
    $rows[] = array('c' => $temp);
    }
	
$result->free();
 
$table['rows'] = $rows;
 
$jsonTable = json_encode($table, true);
echo $jsonTable;

?> 