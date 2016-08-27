<!DOCTYPE html>
<html class="no-js">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" type="image/png" href="images/favicon.png">
        <title>Timer Agency Template</title>
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
            Works Section Start
        ================================================== -->
        <section class="works service-page">
            <div class="container">
                <h2 class="subtitle wow fadeInUp animated" data-wow-delay=".3s" data-wow-duration="500ms">Some Of Our Features Works</h2>
                    <p class="subtitle-des wow fadeInUp animated" data-wow-delay=".5s" data-wow-duration="500ms">
                        Aliquam lobortis. Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Nulla sit amet est. Aenean posuere <br> tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus.
                    </p>
                
                    <?php 
                    $count=0;
                    for($i=1; $i<=16; $i++) {
                        if($count==0) {
                            echo "<div class='row'>";
                        }

                        echo "
                            <div class='col-sm-3'>
                                <figure class='wow fadeInLeft animated portfolio-item' data-wow-duration='500ms' data-wow-delay='0ms'>
                                    <div class='img-wrapper'>
                                        <img src='images/portfolio/item-1.jpg' class='img-responsive' alt='this is a title' >
                                        <div class='overlay'>
                                            <div class='buttons'>
                                                <a rel='gallery' class='fancybox' href='images/portfolio/item-1.jpg'>Demo</a>        
                                                <a target='_blank' href=''>Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <figcaption>
                                        <h4>
                                            <a href='#'>
                                                Dew Drop        
                                            </a>
                                        </h4>
                                        <p>
                                            Redesigne UI Concept
                                        </p>
                                    </figcaption>
                                </figure>
                            </div> ";

                        $count++;
                        if($count==4) {
                            echo "</div>";
                            $count=0;
                        }

                    } 
                    
                    ?>


            </div>
        </section>
        
    </body>
</html>