<?php
    session_start();
    if(!isset($_SESSION['email']))
    {
        die();
    }
?>

<?php
 $auth = $_GET['auth'];

 if($auth == '01521112085') {
	$doc_email = $_SESSION['email'];
    $q=$_GET["q"];

    //echo $doc_email . " q: ".$q."<br>";


    require_once('db-connect.php');
    $sql = "SELECT * FROM physician_patient WHERE email_doc='". $doc_email. "'";
    $result = $connection->query($sql);
    $total = $result->num_rows;
    //echo $total."<br>";



    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
    $hint="";
    for($i=0; $i<$total; $i++) {
        $row = $result->fetch_assoc();                                             
        $client_email=$row["email_patient"];
        
        $sql_new = "SELECT * FROM web_user_info WHERE email='$client_email'";
        $result_new = $connection->query($sql_new);
        $row_new = $result_new->fetch_assoc();
        $y = $row_new["first_name"]." ".$row_new["last_name"];
        //echo $y;



        $z="patient_data.php?email=".$client_email;
        
        //find a link matching the search text
        if (stristr($y, $q)) {
            if ($hint=="") {
            $hint="<a href='" . 
            $z. 
            "' target='_blank'>" . 
            $y. "</a>";
            } 
            else {
            $hint=$hint . "<br /><a href='" . 
            $z. 
            "' target='_blank'>" . 
            $y. "</a>";
            }
        }
    }
    }

    // Set output to "no suggestion" if no hint was found
    // or to the correct values
    if ($hint=="") {
    $response="No matching patient";
    } else {
    $response=$hint;
    }

    //output the response
    echo $response;
 }
?>