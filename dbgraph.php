<?php

include("class/pData.class.php");
include("class/pDraw.class.php"); 
include("class/pImage.class.php"); 


// mysql -u system -p system -h 172.30.137.179 sampledb
$dbhost = getenv("MYSQL_SERVICE_HOST");
echo $dbhost;
echo "<br>";
$dbport = getenv("MYSQL_SERVICE_PORT");
echo $dbport;
echo "<br>";
$dbuser = getenv("MYSQL_USER");
echo $dbuser;
echo "<br>";
$dbpwd = getenv("MYSQL_PASSWORD");
echo $dbpwd;
echo "<br>";
$dbname = getenv("MYSQL_DATABASE");
echo $dbname;
echo "<br>";
$connection = new mysqli($dbhost, "system", "system", "sampledb");
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
echo "<h1>My awesome DB test</h1>";


// query
$sql = "SELECT * FROM measures";
$result = $connection->query($sql);

$temperature="";

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "Temperature: " . $row["temperature"]. "<br>";
		$temperature[] = $row["temperature"];
	}
} else {
	echo "0 results<br>";
}


/* Save the data in the pData array */
$myData = new pData(); 
//$myData->addPoints($temperature,"Temperature");
 $myData->addPoints(array(1,3,4,3,5));
//$myData->addPoints($humidity,"Humidity");

/* Create a pChart object and associate your dataset */ 
 $myPicture = new pImage(500,500,$myData);

 /* Choose a nice font */
 //$myPicture->setFontProperties(array("FontName"=>"../fonts/Forgotte.ttf","FontSize"=>11));

 /* Define the boundaries of the graph area */
 $myPicture->setGraphArea(60,40,670,190);

 /* Draw the scale, keep everything automatic */ 
 $myPicture->drawScale();

 /* Draw the scale, keep everything automatic */ 
 $myPicture->drawSplineChart();

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("pictures/example.basic.png");
 
 ?>
