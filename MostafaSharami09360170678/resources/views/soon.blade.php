<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Soon &mdash; 100% Free Fully Responsive HTML5 Template by FREEHTML5.co</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
    <meta name="author" content="FREEHTML5.CO" />

    <!--
      //////////////////////////////////////////////////////

      FREE HTML5 TEMPLATE
      DESIGNED & DEVELOPED by FREEHTML5.CO

      Website: 		http://freehtml5.co/
      Email: 			info@freehtml5.co
      Twitter: 		http://twitter.com/fh5co
      Facebook: 		https://www.facebook.com/fh5co

      //////////////////////////////////////////////////////
       -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <!-- <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,600,400italic,700' rel='stylesheet' type='text/css'> -->
    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">

    <!-- Animate.css -->
    <script src="{{ asset('soon/css/animate.css') }}"></script>
    <!-- Icomoon Icon Fonts-->
    <script src="{{ asset('soon/css/icomoon.css') }}"></script>
    <!-- Bootstrap  -->
    <script src="{{ asset('soon/css/bootstrap.css') }}"></script>
    <!-- Theme style  -->
    <script src="{{ asset('soon/css/style.css') }}"></script>

    <!-- Modernizr JS -->
    <script src="{{ asset('soon/js/modernizr-2.6.2.min.js') }}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{ asset('soon/js/espond.min.js') }}"></script>
    <![endif]-->

</head>
<body>

<div class="fh5co-loader"></div>

<div id="page">

    <div id="fh5co-container" class="js-fullheight">
        <div class="countdown-wrap js-fullheight">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="display-t js-fullheight">
                        <div class="display-tc animate-box">
                            <nav class="fh5co-nav" role="navigation">
                                <div id="fh5co-logo"><a href="index.html">Soon<strong>.</strong></a></div>
                            </nav>
                            <h1>We Are Coming Soon!</h1>
                            <h2>Free html5 templates Made by <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></h2>
                            <div class="simply-countdown simply-countdown-one"></div>
                            <div class="row">
                                <div class="col-md-12 desc">
                                    <h2>Our webiste is opening soon. <br> Please register to notify you when it's ready!</h2>
                                    <form class="form-inline" id="fh5co-header-subscribe">
                                        <div class="col-md-12 col-md-offset-0">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email" placeholder="Get notify by email">
                                                <button type="submit" class="btn btn-primary">Subscribe</button>
                                            </div>
                                        </div>
                                    </form>
                                    <ul class="fh5co-social-icons">
                                        <li><a href="#"><i class="icon-twitter-with-circle"></i></a></li>
                                        <li><a href="#"><i class="icon-facebook-with-circle"></i></a></li>
                                        <li><a href="#"><i class="icon-linkedin-with-circle"></i></a></li>
                                        <li><a href="#"><i class="icon-dribbble-with-circle"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-cover js-fullheight" style="background-image:url({{ asset('soon/js/images/img_bg_1.jpg') }});">

        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
    <script src="{{ asset('soon/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
    <script src="{{ asset('soon/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
    <script src="{{ asset('soon/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
    <script src="{{ asset('soon/js/jquery.waypoints.min.js') }}"></script>

<!-- Count Down -->
    <script src="{{ asset('soon/js/simplyCountdown.js') }}"></script>
<!-- Main -->
    <script src="{{ asset('soon/js/main.js') }}"></script>

<script>
    var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

    // default example
    simplyCountdown('.simply-countdown-one', {
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate()
    });

    //jQuery example
    $('#simply-countdown-losange').simplyCountdown({
        year: d.getFullYear(),
        month: d.getMonth() + 1,
        day: d.getDate(),
        enableUtc: false
    });
</script>

</body>
</html>

