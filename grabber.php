<?php 

$patient_email = $_GET['email'];
$type = $_GET['type'];

include('db-connect.php');

$table = array();
$rows = array();

if($type=='bp') {

    $qry1 = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='bp_sys' LIMIT 30";
    $qry2 = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='bp_dia' LIMIT 30";
 
    $result1 = mysqli_query($connection, $qry1);
    $result2 = mysqli_query($connection, $qry2);
    
    $unit="mmHg";
    mysqli_close($connection);

    $table['cols'] = array(
        array('id' => '', 'label' => 'Date', 'type' => 'string'), 
        array('id' => '', 'label' => 'Systolic '.$unit, 'type' => 'number'),
        array('id' => '', 'label' => 'Diastolic '.$unit, 'type' => 'number')
        ); 
        

    foreach($result1 as $row1){
        $row2= $result2->fetch_assoc();

        $temp = array();
        
        $temp[] = array('v' => date('m/d/y', $row1['date']));
        
        //convert the data in case of unit conflict
        $temp[] = array('v' => doubleval($row1['data'])); 
        $temp[] = array('v' => doubleval($row2['data'])); 

        $rows[] = array('c' => $temp);
    }
}

else {

    $qry = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='$type' LIMIT 30";
 
    $result = mysqli_query($connection, $qry);
    $unit="";
    if ($first_row = $result->fetch_assoc()){
        $unit=$first_row['unit'];
    }

    mysqli_close($connection);

    $table['cols'] = array(
        //Labels for the chart, these represent the column titles
        array('id' => '', 'label' => 'Date', 'type' => 'string'), array('id' => '', 'label' => $unit, 'type' => 'number')
        ); 

    foreach($result as $row){
        $temp = array();
        
        $temp[] = array('v' => date('m/d/y', $row['date']));
        
        //convert the data in case of unit conflict
        $temp[] = array('v' => doubleval($row['data'])); 

        $rows[] = array('c' => $temp);
    }
}

 
$table['rows'] = $rows;
 
$jsonTable = json_encode($table, true);
echo $jsonTable;

?> 