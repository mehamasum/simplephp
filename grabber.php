<?php 

$patient_email = $_GET['email'];
$type = $_GET['type'];

include('db-connect.php');

$table = array();
$rows = array();

if($type=='bp') {

    $qry1 = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='bp_sys' ORDER BY id DESC LIMIT 30";
    $qry2 = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='bp_dia' ORDER BY id DESC LIMIT 30";
 
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
        
        $temp[] = array('v' => date('d M', $row1['date']/1000));
        
        //convert the data in case of unit conflict
        $temp[] = array('v' => doubleval($row1['data'])); 
        $temp[] = array('v' => doubleval($row2['data'])); 

        $rows[] = array('c' => $temp);
    }
}

else {

    $qry = "SELECT data, date, unit FROM web_stats WHERE email='$patient_email' AND type='$type' ORDER BY id DESC LIMIT 30";
 
    $result = mysqli_query($connection, $qry);
    $unit="";
    if ($last_row = $result->fetch_assoc()){
        $unit=$last_row['unit'];
    }

    mysqli_close($connection);

    $table['cols'] = array(
        //Labels for the chart, these represent the column titles
        array('id' => '', 'label' => 'Date', 'type' => 'string'), array('id' => '', 'label' => $unit, 'type' => 'number')
        ); 

    foreach($result as $row){
        $temp = array();
        
        $temp[] = array('v' => date('d M', $row['date']/1000));
        
		$data= doubleval($row['data']);
		
		if(strcmp($row['unit'],$unit)!=0){
			
			if(strcmp($unit,"°F")==0){
				$data= $data*1.8 + 32;
			}
			else if(strcmp($unit,"°C")==0){
				$data= ($data-32)*0.5556;
			}
			else if(strcmp($unit,"kg")==0){
				$data= $data/2.2046;
			}
			else if (strcmp($unit,"lbs")==0){
				$data= $data*2.2046;
			}
		}
		
        //convert the data in case of unit conflict
        $temp[] = array('v' => $data); 

        $rows[] = array('c' => $temp);
    }
}

 
$table['rows'] = $rows;
 
$jsonTable = json_encode($table, true);
echo $jsonTable;

?> 