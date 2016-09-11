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
        <title>HealthPal Web</title>
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
        ===========================================================
        form validation
        ===========================================================
        -->

        <?php
        // define variables and set to empty values
       $patient_email = $_GET['email'];
       $token = $_GET['token'];
       $text="EMPTY";

        require_once('db-connect.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if(empty($_POST["wa"])) {

                    // query sts 2->ac
                    $sql = "UPDATE web_appointment SET status=2, time='".$_POST["time"]."' WHERE token='$token'";
                    $text = $sql;

                    if ($connection->query($sql) == TRUE) {
                        //mysqli_close($connection);

                        //ob_start();
                        //header('Location: appointments.php');
                        //ob_end_flush();
                        //die();
                    }
            }

            else {
                // query sts  3->wa
                    $sql = "UPDATE web_appointment SET status=3 WHERE token='$token'";

                    if ($connection->query($sql) == TRUE) {
                        //mysqli_close($connection);

                        //ob_start();
                        //header('Location: appointments.php');
                        //ob_end_flush();
                        //die();
                    }

            }

        }
            
        ?>

        
        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <?php 
            include("includes/header.html");
        ?>

        <?php

            // query
            $sql = "SELECT * FROM web_user_info WHERE email='$patient_email'";
            $result = $connection->query($sql);

            $row = $result->fetch_assoc();
            $patient_name = $row["first_name"];

            $patient_sex = $row["sex"];

            $birthDate = date('m/d/Y', $row['dob']);
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
            $patient_dob = $age." years";

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
                            <?php echo "<h2>".$text ."'s Charts</h2>";?>
                        </div>
                    </div>
                </div>
            </div>
            </section><!--/#Page header-->

                <!--data table-->
                <section id="service-page" class="pages service-page">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
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

                        <div class="col-md-4">
                        <div class="contact-form">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                
                            <div class="form-group">
                                <label>Schedule at :</label>
                                <input type="text" class="time" name="time" id="time">                                        
                            </div>

                            <div>
                                <input type="submit" name="ac" class="btn btn-default btn-send" value="Confirm">
                                <input type="submit" name="wa" class="btn btn-default btn-send" value="Decline">
                                    
                            </div>
                        </form>
                        
                        </div>
                        <script>
                                $(function() {
                                    $('#time').timepicker();
                                    $('#time').timepicker('setTime', new Date());
                                    
                                });
                        </script>
                        </div>
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
