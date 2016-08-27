<?php
// mysql -u system -p system -h 172.30.137.179 sampledb

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");

$con = new mysqli($dbhost, "system", "system", "sampledb");
if ($con->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

<!DOCTYPE HTML>
<html>
<head>
	 <meta charset="utf-8">
	 <title>
	 Create Google Charts
	 </title>
	 
	 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
	 
	 <script type="text/javascript">
		 google.load("visualization", "1", {packages:["corechart"]});
		 google.setOnLoadCallback(drawChart);
		 function drawChart() {
		 var data = google.visualization.arrayToDataTable([

		 ['X', 'Y'],
		 
		 <?php 
		 $query = "SELECT humidity AS X, temperature AS Y FROM measures";

		 $exec = mysqli_query($con,$query);
		 while($row = mysqli_fetch_array($exec)){

		 echo "['".$row['Y']."',".$row['X']."],";
		 }
		 ?>
		 
		 ]);

		 var options = {
		 title: 'Test'
		 };
		 var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
		 chart.draw(data, options);
		 }
	 </script>
</head>
<body>
	 <h3>Column Chart</h3>
	 <div id="columnchart" style="width: 900px; height: 500px;"></div>
</body>
</html>