<?php
include 'videoService.php';
include 'SubscriberService.php';
// require 'register.php';
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
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/icons/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/icons/apple-icon-60x60.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/icons/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/icons/apple-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/icons/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/icons/apple-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/icons/apple-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/icons/apple-icon-152x152.png"/>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-icon-180x180.png"/>
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/icons/android-icon-192x192.png"/>
    <link rel="icon" type="image/png" sizes="512x512" href="assets/images/icons/android-icon-512x512.png"/>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png"/>
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/icons/favicon-96x96.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png"/>
    <link rel="manifest" href="assets/images/icons/manifest.json"/>
    <meta name="msapplication-TileColor" content="#ffffff"/>
    <meta name="msapplication-TileImage" content="assets/images/icons/ms-icon-144x144.png"/>
    <meta name="theme-color" content="#ffffff"/>

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="assets/css/preloader.css" type="text/css" rel="stylesheet" media="screen"/>

    <link href="modules/materialize/materialize.min.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="modules/fonts/mdi/appicon/appicon.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="modules/fonts/mdi/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="modules/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen"/>

    <!-- CORE CSS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="modules/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- CORE CSS TEMPLATE - START -->

    <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen" id="main-style"/>
    <!-- CORE CSS TEMPLATE - END -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/production.css"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
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
<div class="menu-close"><i class="mdi mdi-close"></i></div>
<div class="content-area">
    <div class="container home-iconbox">
        <div class="section">
            <div class="spacer"></div>
            <div class="spacer"></div>
            <div class="row">
                <div class="col s6 m6 l3">
                    <div class="icon-block block z-depth-1">
                        <div class="icon-area center primary-text">
                            <i class="mdi mdi-speedometer"></i>
                        </div>
                        <?php
                        $plan = isset($_GET["name"]) ? htmlspecialchars($_GET["name"]) : '30_day_yoga';
                        $videoService = new VideoService();
                        $videoPlans = $videoService->getVideo($plan);
                        $serviceId = null;
                        foreach ($videoPlans as $vp) {
                            $serviceId = $vp['service_id'];
                            echo "<h6 class='title-area center' style='font-weight: bold; text-decoration: underline;text-transform: uppercase;'>" . strtoupper(str_ireplace("_", " ", $vp['video_name'])) . "</h6>";
                            echo "<p class='text-area center' style='font-weight: bold; text-decoration: underline;text-transform: uppercase;'>" . $vp['title'] . "</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section">
            <?php
            include 'HttpUtilClient.php';
            $heClient = new HttpUtilClient();
            $msisdn = "";
            $payload = '{"serviceId":"' . $serviceId . '","msisdn":"' . $msisdn . '"}';
            $resp = $heClient->getMaskedNumber($payload);
            print_r($resp);
            if (!empty($resp)) {
                if (array_key_exists('success', $resp) && $resp['success']) {
                    $subscribed = $resp['subscribed'];
                    $billed = $resp['billed'];
                    if ($subscribed && $billed) {
                        echo "Great. We found your number";
                        // Show video plans
                        $videoService->showVideos($plan);
                        // End of video plan
                        // show form;
                        // $subscriberService->sendActivationRequest($msisdn, $serviceId);
                    } else {
                        if (!$subscribed) {
                            // show form
                        }
                        if (!$billed) {
                            // Try billing
                        }
                        echo "Oooh noo We couldn't find your number. Please enter your number\n";
                        print_r($resp);
                    }
                } else {
                    echo "Oooh noo We couldn't find your number, try again later\n";
                }
            }
            ?>
        </div>
        <!-- Footer -->
        <?php include './pages/footer.php'; ?>
    </div>
    <!--.content-area-->
    <?php include './pages/bottom-menu.php'; ?>
    <script src="assets/js/pwa.js"></script>
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
    <!-- CORE JS FRAMEWORK - START -->
    <script src="modules/jquery/jquery-2.2.4.min.js"></script>
    <script src="modules/materialize/materialize.js"></script>
    <script src="modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/variables.js"></script>
    <!-- CORE JS FRAMEWORK - END -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="modules/fancybox/jquery.fancybox.min.js"></script>
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
    <script src="modules/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        $(".modal").modal();
        //  document.addEventListener("DOMContentLoaded", function () {
        //   var Modalelem = document.querySelector(".modal");
        //   var instance = M.Modal.init(Modalelem);
        //   instance.open();
        // });
    </script>
    <script src="assets/js/common.js"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- CORE TEMPLATE JS - START -->
    <script src="modules/app/init.js"></script>
    <script src="modules/app/settings.js"></script>
    <script src="modules/app/scripts.js"></script>
    <!-- END CORE TEMPLATE JS - END -->
    <script src="assets/js/preloader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>

</html>