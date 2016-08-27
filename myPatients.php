<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$id = intval($_GET['id']);
echo $id . "<br>";

$connection = new mysqli("localhost", "system", "system", "sampledb");
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
echo "<h1>My awesome DB test</h1>";

// query
$sql = "SELECT PAT_ID FROM doc_patient WHERE DOC_ID = '".$id."'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "id: " . $row["PAT_ID"]. "<br>";

        $temp = "SELECT name FROM allpatients WHERE ID = '" . $row["PAT_ID"] . "'";
        $name_result = $connection->query($temp);

        if ($result->num_rows > 0) {
            $namerow = $name_result->fetch_assoc();
            echo "name: " . $namerow["name"]. "<br>";
        }
        else {
            echo "No name<br>";
        }

	}
} else {
	echo "0 results<br>";
}


$connection->close();

?>
</body>
</html>