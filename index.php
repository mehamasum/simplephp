<?php
    session_start();
    if(isset($_SESSION['email']))
    {
        ob_start();
        header('Location: home.php');
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


        <!--popup-->
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="css/style_popup.css" />
        
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
        ===========================================================
        form validation
        ===========================================================
        -->

        <?php
        // define variables and set to empty values
        $nameErr = $emailErr = $specialtyErr = $passwordErr = $signin_emailErr = $signin_passwordErr = "";
        $name = $email = $specialty = $password = $signin_email = $signin_password = "";
        $flag=1;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(empty($_POST["signin"])) {

                if (empty($_POST["name"])) {
                    $nameErr = "Name is required";
                    $flag=0;

                } else {
                    $name = test_input($_POST["name"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed"; 
                    $flag=0;
                    }
                }

                if (empty($_POST["specialty"])) {
                    $nameErr = "Specialty is required";
                    $flag=0;

                } else {
                    $specialty = test_input($_POST["specialty"]);
                    // check if name only contains letters and whitespace
                    if (!preg_match("/^[a-zA-Z ]*$/",$specialty)) {
                    $specialtyErr = "Only letters and white space allowed"; 
                    $flag=0;

                    }
                }
                
                if (empty($_POST["email"])) {
                    $emailErr = "Email is required";
                    $flag=0;

                } else {
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format"; 
                    $flag=0;

                    }
                }

                if (empty($_POST["password"])) {
                    $passwordErr = "Password is required";
                    $flag=0;

                } else {
                    $password = test_input($_POST["password"]);
                }

                if($flag==1) {
                    require_once('db-connect.php');
                    // query
                    $sql = "SELECT * FROM web_physician WHERE email='$email'";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $emailErr = "Email already used"; 
                    }
                    else {
                        // insert values
                        $sql = "INSERT INTO web_physician (email, name, specialist, password, degree, phone, location, visit_hour)".
                                " VALUES ('" . $email . "','" . $name . "','" . $specialty . "','" . $password . "', 'No educational info', 'No phone info', 'No location info', 'No visiting hours info');";
                        
                        if ($connection->query($sql) === TRUE) {
                            mysqli_close($connection);
                            $_SESSION['email']=$email;
                            ob_start();
                            header('Location: home.php');
                            ob_end_flush();
                            die();
                        }
                    }
                    mysqli_close($connection);

                }

            }

            else {

                

                if (empty($_POST["signin_email"])) {
                    $signin_emailErr = "Email is required";
                    $flag=0;

                } else {
                    $signin_email = test_input($_POST["signin_email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($signin_email, FILTER_VALIDATE_EMAIL)) {
                    $signin_emailErr = "Invalid email format"; 
                    $flag=0;

                    }
                }

                if (empty($_POST["signin_password"])) {
                    $signin_passwordErr = "Password is required";
                    $flag=0;

                } else {
                    $signin_password = test_input($_POST["signin_password"]);
                }

                if($flag==1) {


                    require_once('db-connect.php');

                    $sql = "SELECT * FROM web_physician WHERE email='". $signin_email . "' AND password='". $signin_password. "'";
                    $result = $connection->query($sql);
                    
                    if ($result->num_rows > 0) {
                        mysqli_close($connection);
                        $_SESSION['email']=$signin_email;
                        ob_start();
                        header('Location: home.php');
                        ob_end_flush();
                        die();
                    }
                    else {
                        $signin_emailErr = "Email and password don't match";                        
                    }
                    

                }

            }

            mysqli_close($connection);

        }
                

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>



        <!--
        ==================================================
        Header Section Start
        ================================================== -->
        <header id="top-bar" class="navbar-fixed-top animated-header">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <!-- /responsive nav button -->
                    
                    <!-- logo -->
                    <div class="navbar-brand">
                        <a href="index.php" >
                            <img src="images/logo.png" alt="">
                        </a>
                    </div>
                    <!-- /logo -->
                </div>

                <!-- main menu -->
                <nav class="collapse navbar-collapse navbar-right" role="navigation">
                    <div class="main-menu">
                        <ul class="nav navbar-nav navbar-right">

                            <li>
                                <a href="#feature" >Features</a>
                            </li>

                            <li>
                                <a href="#about" >Mobile App</a>
                            </li>
                  
                            <li><a href="#contact-section">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
                <!-- /main nav -->
            </div>
        </header>
        
        <!--
        ==================================================
        Slider Section Start
        ================================================== -->
        <section id="hero-area" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="block" >
                            
                            <!-- Slider -->
                            <section class="">
                                <h1 >
                                <span>HealthPal Web 2.1</span><br>
                                </span>
                                </h1>
                                </section> <!-- cd-intro -->
                                <!-- /.slider -->
                                <h2>
                                    A great way for physicians to be in touch with patients.<br>Monitor health data, handle appointment requests - all from one place.
                                </h2>
                                <a rel="leanModal" class="btn btn-default btn-green" data-wow-delay=".9s" href="#modal" data-section="#works" >Register or Login</a>
                                <!--<a href="#modal" class="btn">Connect</a>-->
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </section><!--/#main-slider-->


            <!--popup-->
            <div class="container">

                <div id="modal" class="popupContainer" style="display:none;">
                    <header class="popupHeader">
                        <span class="header_title">Login or Register</span>
                        <span class="modal_close"><i class="fa fa-times"></i></span>
                    </header>
                    
                    <section class="popupBody">
                        <!-- Social Login -->
                        <div class="social_login">
                            <div class="action_btns">
                                <div class="one_half_old"><a href="#" id="login_form" class="btn">Login</a></div>
                                <div class="one_half_old last"><a href="#" id="register_form" class="btn">Sign up</a></div>
                            </div>
                        </div>

                        <!-- Username & Password Login form -->
                        <div class="user_login">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
                                <label>Email</label>
                                <input type="text" name="signin_email" value="<?php echo $signin_email;?>">
                                <span class="error"><?php echo $signin_emailErr;?></span>
                                <br />

                                <label>Password</label>
                                <input type="password" name="signin_password" required title="8 to 12 characters">
                                <span class="error"><?php echo $signin_passwordErr;?></span>
                                <br />

                                <div class="checkbox">
                                    <input id="remember" type="checkbox" />
                                    <label for="remember">Remember me</label>
                                </div>

                                <div class="action_btns">
                                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                                    <div class="one_half last"><input type="submit" name="signin" class="btn" value="Sign In"></div>
                                </div>
                            </form>

                            
                        </div>

                        <!-- Register Form -->
                        <div class="user_register">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $name;?>">
                                <span class="error"><?php echo $nameErr;?></span>
                                <br />

                                <label>Area of Specialty</label>
                                <input type="text" name="specialty" value="<?php echo $specialty;?>">
                                <span class="error"><?php echo $specialtyErr;?></span>
                                <br />

                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo $email;?>">
                                <span class="error"><?php echo $emailErr;?></span>
                                <br />

                                <label>Password</label>
                                <input type="password" name="password" required title="8 to 12 characters">
                                <span class="error"><?php echo $passwordErr;?></span>
                                <br />

                                <div class="action_btns">
                                    <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
                                    <div class="one_half last"><input type="submit" name="signup" class="btn" value="Sign Up"></div>
                                    
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>



            <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
            <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
            <script type="text/javascript">

                $("a[rel*=leanModal]").leanModal({top : 120, overlay : 0.6, closeButton: ".modal_close" });
                $("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });

                $(function(){
                    // Calling Login Form
                    $("#login_form").click(function(){
                        $(".social_login").hide();
                        $(".user_login").show();
                        $(".header_title").text('Login');
                        return false;
                    });

                    // Calling Register Form
                    $("#register_form").click(function(){
                        $(".social_login").hide();
                        $(".user_register").show();
                        $(".header_title").text('Register');
                        return false;
                    });

                    // Going back to Social Forms
                    $(".back_btn").click(function(){
                        $(".user_login").hide();
                        $(".user_register").hide();
                        $(".social_login").show();
                        $(".header_title").text('Login or Register');
                        return false;
                    });

                })
            </script>
            

            
            <!--
            ==================================================
            Feature Section Start
            ================================================== -->
            <section id="feature" class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="300ms">
                <div class="container">
                <br><br><br>
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">New set of features</h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            For your ease!
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-xs-12">
                            <div class="media wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <i class="icon ion-stats-bars"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Monitor Patients</h4>
                                    <p>Monitor patients' health data synced from client side mobile app. A great way to be in touch.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="600ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <i class="icon ion-android-cloud"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Cloud Sync</h4>
                                    <p>Health data is synchronized between mobile app and cloud. Graphical visualization tools for physicians.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xs-12">
                            <div class="media wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="900ms">
                                <div class="media-left">
                                    <div class="icon">
                                        <i class="ion-android-calendar"></i>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">Online Appointments</h4>
                                    <p>Handle appointment requests directly from the web. Saves a lot of time and phone calls.</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section> <!-- /#feature -->


            <!--
            ==================================================
            About Section Start
            ================================================== -->
            <section id="about">
                <div class="container">
                <br><br><br>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInLeft" align="right" data-wow-delay=".3s" data-wow-duration="500ms">
                                <h1>
                                Works great with patient side mobile app!
                                </h1>
                                <p>
                                    HealthPal mobile app can synchronize data between mobile devices and web. Physicians can monitor their patients' data directly from the website.
                                </p>
                                
								
								<p>
                                    The mobile app itself is a powerful health monitoring tool. Having activity tracking, sleep tracking, calorie tracking, medication tracking and lots more.
                                </p>
								
								<h4> It's a "Swiss army knife" health app integrated with online functionalities!
								</h4>
								
								
								<h2>Currently available on Google Playstore.<h2>
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="block wow fadeInRight" data-wow-delay=".3s" data-wow-duration="500ms">
                                <img src="images/about/app.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- /#about -->
                            
            

            <!-- 
        ================================================== 
            Contact Section Start
        ================================================== -->
        <section id="contact-section">
            <div class="container">
                <div class="row">
                    <div class="section-heading">
                        <h1 class="title wow fadeInDown" data-wow-delay=".3s">Find Us</h1>
                        <p class="wow fadeInDown" data-wow-delay=".5s">
                            Team HealthPal is at your service 24x7!
                        </p>
                    </div>
                    
                    <div class="col-md-12" text-center>
                         <div class="map-area">
                            <div class="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14609.77511960395!2d90.3924947!3d23.7315492!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb7092a9c25197fa4!2sUniversity+of+Dhaka!5e0!3m2!1sen!2sbd!4v1473675779761" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row address-details">
                    <div class="col-md-4">
                        <div class="address wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".3s">
                            <i class="ion-ios-location-outline"></i>
                            <h5>University of Dhaka, Bangladesh</h5>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="email wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".7s">
                            <i class="ion-ios-email-outline"></i>
                            <h5>contact@healthpal.cf</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="phone wow fadeInLeft" data-wow-duration="500ms" data-wow-delay=".9s">
                            <i class="ion-ios-telephone-outline"></i>
                            <h5>+880 152 111 20 85</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!--
            ==================================================
            Contact Section Start
            ================================================== -->
            <section id="call-to-action">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block">
                                <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">Feeling the necessity of a new feature?<br>Or something is not working properly? Please let us know.</p>
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