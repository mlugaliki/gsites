<?php
  require 'app/videoService.php';
  require 'app/register.php';
?>
<!DOCTYPE html>
<html lang="en" class=" ">
<head>
  <!-- 
         * @Package: Alix Mobile App 
         * @Author: themepassion
         * @Version: 1.0
        -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Guruhub WAP services</title>
  <meta content="Guruhub WAP services" name="description" />
  <meta content="themepassion" name="author" />
  <!-- App Icons -->
  <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/icons/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/icons/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/icons/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/icons/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/icons/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/icons/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/icons/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/icons/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/icons/apple-icon-180x180.png" />
  <link rel="icon" type="image/png" sizes="192x192" href="../assets/images/icons/android-icon-192x192.png" />
  <link rel="icon" type="image/png" sizes="512x512" href="../assets/images/icons/android-icon-512x512.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icons/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/icons/favicon-96x96.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/icons/favicon-16x16.png" />
  <link rel="manifest" href="../assets/images/icons/manifest.json" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="assets/images/icons/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />

  <!-- CORE CSS FRAMEWORK - START -->
  <link href="../assets/css/preloader.css" type="text/css" rel="stylesheet" media="screen" />

  <link href="../modules/materialize/materialize.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="../modules/fonts/mdi/appicon/appicon.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="../modules/fonts/mdi/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="../modules/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen" />

  <!-- CORE CSS FRAMEWORK - END -->

  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
  <link href="../modules/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

  <!-- CORE CSS TEMPLATE - START -->

  <link href="../assets/css/style.css" type="text/css" rel="stylesheet" media="screen" id="main-style" />
  <!-- CORE CSS TEMPLATE - END -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="../css/production.css" rel="stylesheet" type="text/css"/>
    <link href="../styles/pure-min.css" rel="stylesheet" type="text/css"/>
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
    <?php include 'pages/nav.php';?>
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
                    $day = htmlspecialchars($_GET["fn_day"]);
                    echo "<h6 class='title-area center'  style='font-weight: bold; text-decoration: underline';text-transform: uppercase;>DAY - ".$day."</h6>";
                    $categoryId = htmlspecialchars($_GET["plan-id"]);
                    $video = new VideoService();
                    $fnDay = htmlspecialchars($_GET["fn_day"]);
                    $activityDay = $video->getVideoPlanByDay($fnDay, $categoryId);
                    foreach ($activityDay as $ad){
                        echo "<p class='title-area center'  style='font-weight: bold; text-decoration: underline; text-transform: uppercase;'>".$ad['category_name']."</p>";
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
          $planVideos = $video->getVideoByCategoryId($categoryId);
          $j = 1;
          if($planVideos != null){
              foreach($planVideos as $pv) {
                  if ($j ==1){
                      echo "<div class='row ui-mediabox  prods prods-boxed equal-height'>";
                  }
                  echo "<div class='col-md-6 s6'>
            <div class='prod-img-wrap'>
                <app src='" . $pv['video_url'] . "' poster='" . $pv['image'] . "' class='j-app'  style='width: 100%;'></app>
                <img src='../img/ic_play.svg'  alt='app' class='icon-play j-play'>
            </div>
            <div class='prod-info  boxed z-depth-1'>
                <h5 class='title truncate'>" .$pv['item_name']."</h5>
                <p>Duration: ".$pv['duration']."</p>
            </div>
          </div>";
                  if ($j ==2 || sizeof($planVideos) == 1){
                      echo "<div class='spacer-xlarge'></div>"
                          ."</div>";
                      $j=1;
                  }else{
                      $j++;
                  }
              }
          }
          ?>
      </div>
    </div>

      <!-- Footer -->
      <?php include './pages/footer.php'; ?>
    </div>
    <!--.content-area-->
    <?php include './pages/bottom-menu.php'; ?>
    <script src="../assets/js/pwa.js"></script>
    <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
    <!-- CORE JS FRAMEWORK - START -->
    <script src="../modules/jquery/jquery-2.2.4.min.js"></script>
    <script src="../modules/materialize/materialize.js"></script>
    <script src="../modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/variables.js"></script>
    <!-- CORE JS FRAMEWORK - END -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="../modules/fancybox/jquery.fancybox.min.js"></script>
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
    <script src="../modules/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
      $(".modal").modal();
      //  document.addEventListener("DOMContentLoaded", function () {
      //   var Modalelem = document.querySelector(".modal");
      //   var instance = M.Modal.init(Modalelem);
      //   instance.open();
      // });
    </script>
    <script src="../assets/js/common.js"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- CORE TEMPLATE JS - START -->
    <script src="../modules/app/init.js"></script>
    <script src="../modules/app/settings.js"></script>
    <script src="../modules/app/scripts.js"></script>
    <!-- END CORE TEMPLATE JS - END -->
    <script src="../assets/js/preloader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>
      <script>
          var SELF = JSON.parse('{\x22assets_host\x22:\x22\x22,\x22theme_color\x22:\x22#673AB7\x22,\x22title\x22:\x22Beginners Yoga\x22,\x22icon\x22:\x22\/assets\/pages\/portal\/app\/yoga\/assets\/img\/ic_logo.png\x22,\x22title_detail\x22:\x2230 Days Yoga Courses for Beginners\x22,\x22banner_width\x22:16,\x22banner_height\x22:9,\x22link_account\x22:\x22\x22,\x22self\x22:\x22\x22,\x22sp\x22:\x22\x22,\x22country\x22:\x22th\x22,\x22bid\x22:0,\x22domain\x22:\x22http:\/\/wap.guruhub.tech\x22,\x22show_outline\x22:false,\x22mode\x22:\x22\x22,\x22manifest\x22:\x22\x22,\x22link\x22:\x22\x22,\x22text_back_to_top\x22:\x22BACK TO TOP\x22,\x22text_day\x22:\x22DAY\x22,\x22text_part\x22:\x22PART\x22,\x22text_duration\x22:\x22DURATION\x22,\x22text_size\x22:\x22size\x22,\x22text_more_info\x22:\x22more\x22,\x22text_menu_1\x22:\x22Popular\x22,\x22text_menu_2\x22:\x22\x22,\x22text_menu_3\x22:\x22Random\x22,\x22text_new_trending\x22:\x22Trending\x22,\x22text_recommend_for_you\x22:\x22Recommend for you\x22,\x22text_loved\x22:\x22loved\x22,\x22text_likes\x22:\x22heart\x22,\x22text_download\x22:\x22Download\x22,\x22text_tab_1\x22:\x22Popular\x22,\x22text_tab_2\x22:\x22Selected\x22,\x22text_tab_3\x22:\x22New\x22,\x22text_tab_4\x22:\x22Random\x22,\x22text_next_page\x22:\x22NEXT\x22,\x22text_start_play\x22:\x22Play\x22,\x22text_today_choice\x22:\x22Today Choice\x22,\x22text_most_star\x22:\x22Most Star\x22,\x22text_play\x22:\x22Play\x22,\x22text_game_description\x22:\x22Description\x22,\x22text_home\x22:\x22Home\x22,\x22text_history\x22:\x22History\x22,\x22text_ranking\x22:\x22Ranking\x22,\x22text_editor_choice\x22:\x22Editor Choice\x22,\x22text_players\x22:\x22players\x22,\x22text_stars\x22:\x22stars\x22,\x22text_views\x22:\x22views\x22,\x22text_about\x22:\x22About\x22,\x22text_rank\x22:\x22Rank\x22,\x22text_popular\x22:\x22Popular\x22,\x22text_new\x22:\x22New\x22,\x22template_type\x22:1,\x22content_type\x22:1,\x22watermark\x22:0,\x22menu_1_category\x22:\x22popular\x22,\x22menu_2_category\x22:\x22random\x22,\x22menu_3_category\x22:\x22random\x22,\x22tab_1_category\x22:\x22random\x22,\x22tab_2_category\x22:\x22popular\x22,\x22tab_3_category\x22:\x22new\x22,\x22tab_4_category\x22:\x22random\x22,\x22text_tap_tap_mix_title_1\x22:\x22Amazing games you should never miss\x22,\x22text_tap_tap_mix_title_2\x22:\x22Puzzle games classic\x22,\x22text_tap_tap_mix_title_3\x22:\x22Find and enjoy most played games\x22,\x22has_bottom_nav\x22:false,\x22bottom_nav_items\x22:[{\x22title\x22:\x22title-a\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-a\x22},{\x22title\x22:\x22title-b\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-b\x22},{\x22title\x22:\x22title-c\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-c\x22}]}');
          var bannerRatio = 9 / 16
      </script>
      <script src="../scripts/zepto.min.js"></script>
      <script src="../scripts/data.min.js"></script>
      <script src="../scripts/detail.min.js"></script>
</body>

</html>