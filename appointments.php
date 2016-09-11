<?php
    session_start();
    if(!isset($_SESSION['email']))
    {
        ob_start();
        header('Location: index.php');
        ob_end_flush();
        die();
    }
?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>HealthPal Web Home</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Template CSS Files
        ================================================== -->
        <!-- Twitter Bootstrs CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Ionicons Fonts Css -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
        <!-- Hero area slider css-->
        <link rel="stylesheet" href="css/slider.css">
        <!-- owl craousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/jquery.fancybox.css">
        <!-- template main css file -->
        <link rel="stylesheet" href="css/main.css">
        <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
        
        <!-- Template Javascript Files
        ================================================== -->
        <!-- modernizr js -->
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- jquery -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- owl carouserl js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- bootstrap js -->

        <script src="js/bootstrap.min.js"></script>
        <!-- wow js -->
        <script src="js/wow.min.js"></script>
        <!-- slider js -->
        <script src="js/slider.js"></script>
        <script src="js/jquery.fancybox.js"></script>
        <!-- template main js -->
        <script src="js/main.js"></script>

        <!--date picker-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script type="text/javascript" src="js/jquery.timepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

        <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />

        <script type="text/javascript" src="lib/site.js"></script>
        <link rel="stylesheet" type="text/css" href="lib/site.css" />

    </head>
    <body>
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
         <?php include("includes/header.html"); ?>



        <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
        <section class="global-page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2>HealthPal Web 2.1</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="ion-ios-home"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            </section><!--/#Page header-->


            <section id="blog-full-width">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sidebar">

                                <div class="categories widget">
                                        <h3 class="widget-head">Categories</h3>
                                        <ul>
                                            <li>
                                                <a href="">New requests</a> <span class="badge">3</span>
                                            </li>
                                            <li>
                                                <a href="">All pending</a> <span class="badge">10</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="col-md-8">

                                <section id="works">
                                        
                                        <div class="row">
                                            <div class="col-sm-8 col-xs-12">
                                            <h1>Appointment Requests</h1>
                                            <br><br>
                                            </div>
                                        </div>


                                        <?php

                                            require_once('db-connect.php');

                                            $doc_email = $_SESSION['email'];

                                            $sql = "SELECT * FROM web_appointment WHERE doc_email='". $doc_email. "' AND status=1";
                                            //echo $sql . "<br>";
                                            $result = $connection->query($sql);

                                            $n = $result->num_rows;
                                            //echo $n. " entries<br>";
                                            
                                            $token = array();


                                            $count=0;
                                            for($i=0; $i<$n; $i++) {

                                                $row = $result->fetch_assoc();
                                                $client_email = $row["patient_email"];
                                                array_push($token, $row['token']);

                                                $sql_new = "SELECT * FROM web_user_info WHERE email='$client_email'";
            

                                                $result_new = $connection->query($sql_new);

                                                $row_new = $result_new->fetch_assoc();
                                                $patient_name = $row_new["first_name"];

                                                echo "<div class='row' id='row'".$i.">";

                                                echo "
                                                    
                                                    <div class='col-sm-12'>
                                                    <figure class='wow fadeInLeft animated portfolio-item' data-wow-duration='500ms' data-wow-delay='0ms'>
                                                        
                                                        <figcaption>
                                                            <h3>
                                                                ".$patient_name."
                                                            </h3>
                                                            <h4>
                                                                Date : ".$row["date"]."
                                                            </h4>                            
                                                            <br>

                                                             <p id='status".$i."'>
                                                                Status : Pending
                                                            </p> 
                                                            <br> 


                                                            <div class='contact-form'>
                                                                <form>
                                                        
                                                                    <div class='form-group'>
                                                                        <label>Schedule at :</label>
                                                                        <input type='text' class='time' name='time' id='time".$i."'>                                        
                                                                    </div>

                                                                    <div>
                                                                        
                                                                        <button class='btn btn-default btn-send' type='button' onclick='AC(".$i.", ".$token[$i].")'>Confirm</button>
                                                                        <button class='btn btn-default btn-send' type='button' onclick='WA(".$i.", ".$token[$i].")'>Decline</button>
                                                                            
                                                                    </div>
                                                                </form>
                                                            
                                                            </div>

                                                            

                                                            <script>
                                                                    $(function() {
                                                                        $('#time".$i."').timepicker();
                                                                        $('#time".$i."').timepicker('setTime', new Date());               
                                                                    });
                                                            </script>
                                                            </div>
                                                                                                                  
                                                        </figcaption>
                                                                    
                                                    </figure>
                                                    

                                                    </div>";
                                                    

                                                } 

                                                $i=0;

                                                echo "
                                                
                                                <script>
                                                    function AC(x, token) {
                                                        var timeval =  $('#time'.concat(x.toString())).val();
                                                        //document.getElementById('status'.concat(x.toString())).innerHTML = 'FUCK';

                                                        var ajaxurl = 'android/responder_ajax.php?auth=01521112085&token='.concat(token.toString()).concat('&status=2'),
                                                        data =  {'time': timeval};
                                                        $.post(ajaxurl, data, function (response) {
                                                            document.getElementById('status'.concat(x.toString())).innerHTML = 'Status: Scheduled';
                                                            //alert(response);
                                                        });
                                                    }
                                                    </script>

                                                    <script>
                                                    function WA(x, token) {
                                                        var timeval =  $('#time'.concat(x.toString())).val();
                                                        //document.getElementById('status'.concat(x.toString())).innerHTML = 'FUCK';

                                                        var ajaxurl = 'android/responder_ajax.php?auth=01521112085&token='.concat(token.toString()).concat('&status=3'),
                                                        data =  {'time': timeval};
                                                        $.post(ajaxurl, data, function (response) {
                                                            document.getElementById('status'.concat(x.toString())).innerHTML = 'Status: Declined';
                                                            //alert(response);
                                                        });
                                                    }
                                                </script>
                                                
                                                ";

                                                mysqli_close($connection);
                                            
                                            ?>


                                </section> <!-- #works -->
                                
                            </div>
                        </div>
                    </section>
                    <!--
                    ==================================================
                    Footer Section Start
                    ================================================== -->
                    <?php include("includes/footer.html"); ?>


                </body>
            </html>
        </html>