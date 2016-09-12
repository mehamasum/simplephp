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

        <?php
        // define variables and set to empty values
        $email= $_SESSION['email'];
        $name = $degree = $specialist = $phone = $location = $visit_hour = "";
        $message = "Click on the fields to edit";
        $flag=1;

        require_once('db-connect.php');
        $sql = "SELECT * FROM web_physician WHERE email='$email'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        $name = $row['name'];
        $specialist = $row['specialist'];
        $degree = $row['degree'];
        $phone = $row['phone'];
        $location = $row['location'];
        $visit_hour = $row['visit_hour'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!empty($_POST['name'])) {
                $name = $_POST['name'];
            }
            if(!empty($_POST['degree'])) {
                $degree = $_POST['degree'];
            }
            if(!empty($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            if(!empty($_POST['location'])) {
                $location = $_POST['location'];
            }
            if(!empty($_POST['visit_hour'])) {
                $visit_hour = $_POST['visit_hour'];
            }
            if(!empty($_POST['specialist'])) {
                $specialist = $_POST['specialist'];
            }

            $sql = "UPDATE web_physician SET name='$name', degree='$degree', phone='$phone', location='$location', visit_hour='$visit_hour', specialist='$specialist' WHERE email='$email'";
            if ($connection->query($sql) === TRUE) {
                $message = "Records updated successfully";
            } else {
                $message = "Error updating records: " . $conn->error;
            }
        
        }

        $connection->close();

        ?>

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
                            <h2>Account Info</h2>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="index.php">
                                        <i class="ion-ios-home"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="active">Account</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>   
        </section><!--/#page-header-->


        <!-- 
        ================================================== 
            Contact Section Start
        ================================================== -->
        <section id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block">
                            <h2 class="subtitle wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".3s"><?php echo $message?></h2>
                            <p class="subtitle-des wow fadeInDown" data-wow-duration="500ms" data-wow-delay=".5s">
                                <?php echo $_SESSION['email'] ."<br>" ; ?>
                            </p>
                            <div class="contact-form">
                                <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" <?php echo "placeholder='$name'"?> class="form-control" name="name" id="name">
                                        <br />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Degree</label>
                                        <input type="text" <?php echo "placeholder='$degree'"?> class="form-control" name="degree" id="email" >
                                        <br />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Area of Specialty</label>
                                        <input type="text" <?php echo "placeholder='$specialist'"?> class="form-control" name="specialist" id="subject">
                                        <br />
                                    </div>

                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" <?php echo "placeholder='$phone'"?> class="form-control" name="phone" id="email" >
                                        <br />
                                    </div>

                                    <div class="form-group" >
                                        <label>Location</label>
                                        <input type="text" <?php echo "placeholder='$location'"?> class="form-control" name="location" id="email" >
                                        <br />
                                    </div>
                                    
                                    <div class="form-group" >
                                        <label>Visiting Hours</label>
                                        <input type="text" <?php echo "placeholder='$visit_hour'"?> class="form-control" name="visit_hour" id="subject">
                                        <br />
                                    </div>

                                    
                                    
                                    
                                    
                                    
                                    <div id="submit">
                                        <input type="submit" id="contact-submit" class="btn btn-default btn-send" value="Update">
                                    </div>                      
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>






        <!-- 
        ================================================== 
            Call To Action Section Start
        ================================================== -->
        <section id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">Have your say</h1>
                            <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Report a bug or request a feature</p>
                            <a href="" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="500ms">Contact Us</a>
                        </div>
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


