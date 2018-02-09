<html lang="en" class="full-height">
<?php
session_start();
include('header.php');
include('navBar.php');
?>
<style>
        /* TEMPLATE STYLES */
        .flex-center {
            color: #fff;
        }
        .intro-1 {
            background: url("Background.jpg")no-repeat center center;
            background-size: cover;
        }
        .navbar .btn-group .dropdown-menu a:hover {
            color: #000 !important;
        }

        .navbar .btn-group .dropdown-menu a:active {
            color: #fff !important;
        }

</style>
<body style="background-color:#008080">
	<header>
	 <!--Intro Section-->
        <section class="view intro-1 hm-black-strong">
            <div style = "background-color: rgba(0,0,0,.3);"class="full-bg-img flex-center">
                <div class="container">
                    <ul>
                        <li>
                            <h1 class="h1-responsive font-bold wow fadeInDown" data-wow-delay="0.2s">Team 3476: Code Orange</h1></li>

                        <li>
                            <a target="_blank" href="https://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default btn-lg wow fadeInRight" data-wow-delay="0.2s" rel="nofollow">Learn about our Team</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
	</header>
    <!-- Main container-->
    <div class="container">

        <div class="divider-new pt-5">
            <h2 style="color:White;"><b>Quick Links<b></h2>
        </div>

        <!--Section: Best features-->
        <section id="best-features">

            <div class="row pt-3">

                <!--First columnn-->
                <div class="col-lg-4 mb-r">

                    <!--Card-->
                    <div class="card wow fadeIn">

                        <!--Card image-->
                        <img class="img-fluid" src="images/first.jpg" alt="Card image cap">

                        <!--Card content-->
                        <div class="card card-cascade">
                            <!--Title-->
                            <h4 class="card-title text-center"><b>FIRST</b></h4>
                            <hr>
                            <!--Text-->
							<a href="#" class="btn btn-primary">Learn More</a>
                        </div>

                    </div>
                    <!--/.Card-->
                </div>
                <!--First columnn-->

                <!--Second columnn-->
                <div class="col-lg-4 mb-r">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.2s">

                        <!--Card image-->
                        <img class="img-fluid" src="images/steamworks.jpg" alt="Card image cap">

                        <!--Card content-->
                        <div class="card card-dark">
                            <!--Title-->
                            <h4 class="card-title text-center"><b>FIRST Steamworks</b></h4>
                            <hr>
                            <!--Text-->
							<a href="#" class="btn btn-primary">Learn More</a>
                        </div>

                    </div>
                    <!--/.Card-->
                </div>
                <!--Second columnn-->

                <!--Third columnn-->
                <div class="col-lg-4 mb-r">
                    <!--Card-->
                    <div class="card wow fadeIn" data-wow-delay="0.4s">

                        <!--Card image-->
                        <img class="img-fluid" src="images/rincon.jpg" alt="Card image cap">

                        <!--Card content-->
                        <div class="card card-dark">
                            <!--Title-->
                            <h4 class="card-title text-center"><b>Rincon</b></h4>
                            <hr>
                            <!--Text-->
							<a href="#" class="btn btn-primary">Learn More</a>
                        </div>

                    </div>
                    <!--/.Card-->
                </div>
                <!--Third columnn-->
            </div>

        </section>
        <!--/Section: Best features-->

    </div>
    <!--/ Main container-->
<?php
include("footer.php");
?>
    <!-- Animations init-->
    <script>
        new WOW().init();
    </script>


</body>

</html>