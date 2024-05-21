<?php
include 'SubscriberService.php';
?>
<!DOCTYPE html>
<html lang="en" class=" ">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Guruhub WAP services</title>
    <meta content="Guruhub WAP services" name="description"/>
    <meta content="GIL" name="author"/>
    <!-- App Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="/app/assets/images/icons/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="/app/assets/images/icons/apple-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="/app/assets/images/icons/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="/app/assets/images/icons/apple-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="/app/assets/images/icons/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="/app/assets/images/icons/apple-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="/app/assets/images/icons/apple-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="/app/assets/images/icons/apple-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/app/assets/images/icons/apple-icon-180x180.png"/>
    <link rel="icon" type="image/png" sizes="192x192" href="/app/assets/images/icons/android-icon-192x192.png"/>
    <link rel="icon" type="image/png" sizes="512x512" href="/app/assets/images/icons/android-icon-512x512.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="/app/assets/images/icons/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="96x96" href="/app/assets/images/icons/favicon-96x96.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="/app/assets/images/icons/favicon-16x16.png"/>
    <link rel="manifest" href="/app/assets/images/icons/manifest.json"/>
    <meta name="msapplication-TileColor" content="#ffffff"/>
    <meta name="msapplication-TileImage" content="/app/assets/images/icons/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff"/>

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="/app/assets/css/preloader.css" type="text/css" rel="stylesheet" media="screen"/>

    <link href="/app/modules/materialize/materialize.min.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="/app/modules/fonts/mdi/appicon/appicon.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="/app/modules/fonts/mdi/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="/app/modules/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen"/>

    <!-- CORE CSS FRAMEWORK - END -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="/app/modules/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- CORE CSS TEMPLATE - START -->
    <link href="/app/assets/css/style.css" type="text/css" rel="stylesheet" media="screen" id="main-style"/>
    <!-- CORE CSS TEMPLATE - END -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/app/css/production.css" type="text/css" rel="stylesheet"/>
</head>
<body class="html" data-header="light" data-footer="light" data-header_align="app" data-menu_type="left"
      data-menu="light" data-menu_icons="on" data-footer_type="left" data-site_mode="light" data-footer_menu="show"
      data-footer_menu_style="light">
<div class="preloader-background">
    <div class="preloader-wrapper">
        <div class="orig">
            <div class="dot orig three"></div>
            <div class="dot orig two"></div>
            <div class="dot orig one"></div>
        </div>
    </div>
</div>
<!-- START navigation -->
<?php include 'pages/nav.php'; ?>
<!-- END navigation -->

<div class="content-area">
    <div class="container home-iconbox">
        <div class="section">
            <div class="spacer"></div>
            <div class="row">
                <div class="col s12 pad-0">
                    <!--   Icon Section   -->
                    <div class="row">
                        <div class="col s6 m6 l3">
                            <div class="icon-block block z-depth-1">
                                <div class="icon-area center primary-text">
                                    <i class="mdi mdi-speedometer"></i>
                                </div>
                                <h6 class="title-area center">Light & Fast</h6>
                                <p class="text-area center">
                                    It is designed to be super fast and light in weight. It
                                    speeds your development and helps smooth user interation.
                                </p>
                            </div>
                        </div>

                        <div class="col s6 m6 l3">
                            <div class="icon-block block z-depth-1">
                                <div class="icon-area center primary-text">
                                    <i class="mdi mdi-spotlight"></i>
                                </div>
                                <h6 class="title-area center">Creative</h6>
                                <p class="text-area center">
                                    By utilizing elements and principles of Material Design,
                                    It is designed with unique set of features.
                                </p>
                            </div>
                        </div>

                        <div class="col s6 m6 l3">
                            <div class="icon-block block z-depth-1">
                                <div class="icon-area center primary-text">
                                    <i class="mdi mdi-thumb-up-outline"></i>
                                </div>
                                <h6 class="title-area center">Quality Code</h6>
                                <p class="text-area center">
                                    It follows black box level coding standard. All the code
                                    is well formatted, commented and ready to use.
                                </p>
                            </div>
                        </div>

                        <div class="col s6 m6 l3">
                            <div class="icon-block block z-depth-1">
                                <div class="icon-area center primary-text">
                                    <i class="mdi mdi-lan"></i>
                                </div>
                                <h6 class="title-area center">Multi Purpose</h6>
                                <p class="text-area center">
                                    It can be customized and used for any niche. The vast
                                    possibilities of this template makes it multi purpose.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="container">
        <div class="section">
            <div class="row ui-mediabox  prods prods-boxed equal-height ">
                <div class="col s6 ">
                    <div class="prod-img-wrap">
                        <a class="img-wrap" href="https://sites.guruhub.tech/day1/day1_1.mp4" data-fancybox="images"
                           data-caption="30 day Yoga challenge">
                            <img alt="image" class="z-depth-1" style="width: 100%;" src="/app/img/day13_1.mp4.jpg">
                        </a>
                    </div>
                    <div class="prod-info  boxed z-depth-1">
                        <h5 class="title truncate">Yoga</h5>
                        <span class="small brand">30 day yoga challenge</span>
                        <p class="small brand saf-error"></p>
                        <div class="spacer-line"></div>
                        <div class="spacer-line"></div>
                            <form method="get" action="/app/flow.php">
                                <input type="hidden" name="name" value="30_day_yoga"/>
                                <input type="hidden" name="sid" class="sid" value=""/>
                                <input type="hidden" name="cid" class="cid" value="6613d4f2c7a8be175c74f6fa"/>
                                <input type="hidden" name="pid" class="pid" value=""/>
                                <button class="addtocart btn-small subscribe" type="submit">Subscribe</button>
                            </form>
                        <div class="spacer-line"></div>
                    </div>
                </div>
                <div class="col s6 ">
                    <div class="prod-img-wrap">
                        <a class="img-wrap" href="https://sites.guruhub.tech/day1/drum_day1_1.mp4"
                           data-fancybox="images" data-caption="Home Decor Balls">
                            <img alt="image" class="z-depth-1" style="width: 100%;" src="/app/img/drumbell/banner.png">
                        </a>
                    </div>
                    <div class="prod-info  boxed z-depth-1">
                        <a href="#">
                            <h5 class="title truncate">Dumbbell</h5>
                        </a>
                        <span class="small brand">30 day gym challenge</span>
                        <p class="small brand saf-error"></p>
                        <div class="spacer-line"></div>
                        <form method="get" action="/app/flow.php">
                            <input type="hidden" name="name" value="dumbbell"/>
                            <input type="hidden" name="sid" class="sid" value=""/>
                            <input type="hidden" name="cid" class="cid" value="6613d463c7a8be175c74f5ff"/>
                            <input type="hidden" name="pid" class="pid" value=""/>
                            <button class="addtocart btn-small subscribe" type="submit">Subscribe</button>
                        </form>
                        <div class="spacer-line"></div>
                    </div>
                </div>
<!--                <div class="col s6 ">
                    <div class="prod-img-wrap">
                        <a class="img-wrap" href="#" data-fancybox="images"
                           data-caption="Women Sandals">
                            <img alt="image" class="z-depth-1" style="width: 100%;" src="img/edu.jpeg">
                        </a>
                    </div>
                    <div class="prod-info  boxed z-depth-1">
                        <a href="#">
                            <h5 class="title truncate">Education</h5>
                        </a> <span class="small brand">Coming soon</span>
                        <div class="spacer-line"></div>
                        <span class="addtocart btn-small">Subscribe</span>
                        <div class="spacer-line"></div>
                    </div>
                </div>
                <div class="col s6 ">
                    <div class="prod-img-wrap">
                        <a class="img-wrap" href="#" data-fancybox="images"
                           data-caption="Modern Man Shoes">
                            <img alt="image" class="z-depth-1" style="width: 100%;" src="img/commedy.jpeg">
                        </a>
                    </div>
                    <div class="prod-info  boxed z-depth-1">
                        <a href="#">
                            <h5 class="title truncate">Commedy</h5>
                        </a> <span class="small brand">Coming soon</span>
                        <div class="spacer-line"></div>
                        <span class="addtocart btn-small">Subscribe</span>
                        <div class="spacer-line"></div>
                    </div>
                </div>-->
            </div>
        </div>
        <!-- Footer -->
        <?php include 'pages/footer.php'; ?>
        <div class="backtotop">
            <a class="btn-floating btn primary-bg">
                <i class="mdi mdi-chevron-up"></i>
            </a>
        </div>
    </div>
    <!--.content-area-->
    <?php include 'pages/bottom-menu.php'; ?>
    <script src="/app/assets/js/pwa.js"></script>

    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

    <!-- CORE JS FRAMEWORK - START -->
    <script src="/app/modules/jquery/jquery-2.2.4.min.js"></script>
    <script src="/app/modules/materialize/materialize.js"></script>
    <script src="/app/modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/app/assets/js/variables.js"></script>
    <!-- CORE JS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="/app/modules/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".carousel-fullscreen.carousel-slider").carousel({
                fullWidth: true,
                indicators: true,
            });
            setTimeout(autoplay, 3500);

            function autoplay() {
                $(".carousel").carousel("next");
                setTimeout(autoplay, 3500);
            }

            $(".slider3").slider({
                indicators: false,
                height: 200,
            });
        });
    </script>

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="/app/modules/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(".modal").modal();
        //  document.addEventListener("DOMContentLoaded", function () {
        //   var Modalelem = document.querySelector(".modal");
        //   var instance = M.Modal.init(Modalelem);
        //   instance.open();
        // });
    </script>
    <script src="/app/assets/js/common.js"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- CORE TEMPLATE JS - START -->
    <script src="/app/modules/app/init.js"></script>
    <script src="/app/modules/app/settings.js"></script>
    <script src="/app/modules/app/scripts.js"></script>
    <script src="/app/js/msisdn.js?ver"></script>
    <!-- END CORE TEMPLATE JS - END -->
    <script src="/app/assets/js/preloader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>
</html>