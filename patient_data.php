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
        <title>LiveHealthy Web</title>
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
        <!-- google chart js -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        
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
    </head>
    <body>
        
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <?php 
            include("includes/header.html");
        ?>

        <?php
            $patient_email = $_GET['email'];

            include('db-connect.php');

            // query
            $sql = "SELECT * FROM web_user_info WHERE email='$patient_email'";
            

            $result = $connection->query($sql);

            $row = $result->fetch_assoc();
            $patient_name = $row["first_name"];

            $patient_sex = $row["sex"];

            $birthDate = date('Y-m-d', $row['dob']/1000);
            //$dob='1981-10-07';
            $diff = (date('Y') - date('Y',strtotime($birthDate)));
            $patient_dob = $diff." years";

            $patient_blood = $row["blood"];

            $patient_weight = $row["weight"]." ".$row["weight_unit"];
            $patient_height = $row["height"]." ".$row["height_unit"];

        ?>


        <!--
        ==================================================
        Global Page Section Start
        ================================================== -->
        <section class="global-page-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <?php echo "<h2>".$patient_name ."'s Charts</h2>";?>
                        </div>
                    </div>
                </div>
            </div>
            </section><!--/#Page header-->

                <!--data table-->
                <section id="service-page" class="pages service-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block">
                                
                                <div class="row service-parts">
                                    <div class="col-md-3">
                                        <div class="block wow fadeInUp animated" data-wow-duration="400ms" data-wow-delay="600ms">
                                            <i class="ion-information-circled"></i>
                                            <?php echo"<h4>$patient_sex</h4>"?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="block wow fadeInUp animated" data-wow-duration="400ms" data-wow-delay="600ms">
                                            <i class="ion-calendar"></i>
                                            <?php echo"<h4>$patient_dob</h4>"?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="block wow fadeInUp animated" data-wow-duration="400ms" data-wow-delay="600ms">
                                            <i class="ion-speedometer"></i>
                                            <?php echo"<h4>$patient_weight</h4>"?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="block wow fadeInUp animated" data-wow-duration="400ms" data-wow-delay="600ms">
                                            <i class="ion-waterdrop"></i>
                                            <?php echo"<h4>$patient_blood</h4>"?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            
            <!--data chart-->
            <?php
                for($i=0; $i<6 ; $i++) {
                
                $type=$title=$v_title="";

                if($i==0) {$type="heart_rate"; $title="Heart rate";}
                else if($i==1) {$type="temperature"; $title="Body Temperature";}
                else if($i==2) {$type="bp";  $title="Blood Pressure"; }
                else if($i==3) {$type="bs_fast";  $title="Blood Sugar (Fasting)"; }
                else if($i==4) {$type="bs_rest";  $title="Blood Sugar (Regular)"; }
                else if($i==5) {$type="weight";  $title="Weight";}


                echo "<div class='row'>";
                echo "
                        <div id='chart_div".$i."' style='width: auto; height: 600px;'></div>
                        <script type='text/javascript'>
                        
                        // Load the Visualization API and the piechart package.
                        google.load('visualization', '1', {'packages':['corechart']});
                        
                        // Set a callback to run when the Google Visualization API is loaded.
                        google.setOnLoadCallback(drawChart);
                        
                        function drawChart() {
                        var jsonData = $.ajax({
                            url: 'grabber.php?email=$patient_email&type=$type',
                            dataType:'json',
                            async: false
                            }).responseText;
                            
                        // Create our data table out of JSON data loaded from server.
                        var data = new google.visualization.DataTable(jsonData);
                        
                        var options = {
                                    title: '$title',
                                    hAxis: {
                                    title: 'Timeline'
                                    },
                                    vAxis: {
                                        title: 'Reading'
                                    }
                                    };";     

                if($i==0 || $i==1 || $i==3 || $i==4 || $i==5) {         
                        echo "
                        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div".$i."'));
                        chart.draw(data, options);
                        ";

                }
                else if($i==2) {
                    echo "
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div".$i."'));
                        chart.draw(data, options);
                        ";
                }  

                echo "} </script>";                
                echo "</div>";
                }
            ?>

            
        
            <!--
            ==================================================
            Footer Section Start
            ================================================== -->
            <?php include("includes/footer.html"); ?>
                
            </body>
        </html>
    </html>
