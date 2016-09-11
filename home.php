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

                                <div class="search widget">
                                    <form action="" method="get" class="searchform" role="search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"> <i class="ion-search"></i> </button>
                                            </span>
                                            </div><!-- /input-group -->
                                        </form>
                                    </div>


                                    <div class="categories widget">
                                        <h3 class="widget-head">Categories</h3>
                                        <ul>
                                            <li>
                                                <a href="">New patients</a> <span class="badge">3</span>
                                            </li>
                                            <li>
                                                <a href="">All patients</a> <span class="badge">10</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="col-md-8">

                                <section id="works">

                                        
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-12">
                                            <h1>Recent Patients</h1>
                                            <br><br>
                                            </div>
                                        </div>


                                        <?php

                                            require_once('db-connect.php');

                                            $doc_email = $_SESSION['email'];

                                            $sql = "SELECT * FROM physician_patient WHERE email_doc='". $doc_email. "' LIMIT 10 ";
                                            //echo $sql . "<br>";
                                            $result = $connection->query($sql);

                                            $n = $result->num_rows;
                                            //echo $n. " entries<br>";
                                            


                                            $count=0;
                                            for($i=1; $i<=$n; $i++) {

                                                $row = $result->fetch_assoc();
                                                $client_email = $row["email_patient"];

                                                $sql_new = "SELECT * FROM web_user_info WHERE email='$client_email'";
            

                                                $result_new = $connection->query($sql_new);

                                                $row_new = $result_new->fetch_assoc();
                                                $patient_name = $row_new["first_name"];

                                                if($count==0) {
                                                    echo "<div class='row'>";
                                                }

                                                echo "
                                                    <div class='col-sm-4'>
                                                        <figure class='wow fadeInLeft animated portfolio-item' data-wow-duration='500ms' data-wow-delay='0ms'>
                                                            <div class='img-wrapper'>
                                                                <img src='images/users/default.jpg' class='img-responsive' alt='this is a title' >
                                                                <div class='overlay'>
                                                                    <div class='buttons'>
                                                                        <a class='fancybox' href='". "patient_data.php?email=".$client_email ."'>Details</a>        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <figcaption>
                                                                <h4>
                                                                    <a href='#'>"
                                                                        .$patient_name.        
                                                                    "</a>
                                                                </h4>
                                                                <p>".
                                                                    $client_email
                                                                . "</p>
                                                            </figcaption>
                                                        </figure>
                                                    </div> ";

                                                    $count++;
                                                    if($count==3) {
                                                        echo "</div>";
                                                        $count=0;
                                                    }

                                                    

                                                } 

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