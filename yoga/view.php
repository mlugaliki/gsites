<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beginners Yoga</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="img/ic_logo.png" rel="icon">
    <link href="styles/pure-min.css" rel="stylesheet">
    <link href="/assets/pages/portal/assets/manifest/46.json" rel="manifest">
    <link href="styles/detail.min.css" rel="stylesheet">
    <link href="img/ic_logo.png" rel="Shortcut Icon" type="image/x-icon">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="pure-g">

            <div class="pure-u-1-1">
                <div class="pure-g">
                    <div class="pure-u-1-1 header j-header">
                        <img alt="back" class="ic-back"
                            src="img/ic_back.svg">
                        <span class="j-title">
                            DAY - echo htmlspecialchars($_GET["fn_day"]);
                            <?php $categoryId = htmlspecialchars($_GET["plan-id"]);
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="pure-u-1-1 items">
                <div class="pure-g j-items">
                    <div class="pure-u-1-1 item">
                    <?php
                        include './videos.php';
                        $video = new Videos();
                        $stmt = $video->getVideoByCategoryId($categoryId);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                           echo "<div class='img-container j-item-container'><br/>"
                            ."<video src='".$video_url."' poster='".$image."' class='j-video'></video><br/>"
                            ."<img src='img/ic_play.svg'  alt='video' class='icon-play j-play'><br/>"
                        ."</div>"
                        ."<div class='info'><br/>"
                        ."    <div class='title'>".$item_name."</div><br/>"
                        ."    <div class='desc'>DURATION:".$duration."</div><br/>"
                        ."</div>";
                        }
                ?>
                        
                    </div>
                </div>
            </div>

            <div class="pure-u-1-1 back-top-container">
                <div class="pure-button pure-button-primary ic-back" style="background-color: #673AB7;">
                    HOME MENU
                </div>
            </div>
        </div>
    </div>

    <script>
        var SELF = JSON.parse('{\x22assets_host\x22:\x22\x22,\x22theme_color\x22:\x22#673AB7\x22,\x22title\x22:\x22Beginners Yoga\x22,\x22icon\x22:\x22\/assets\/pages\/portal\/video\/yoga\/assets\/img\/ic_logo.png\x22,\x22title_detail\x22:\x2230 Days Yoga Courses for Beginners\x22,\x22banner_width\x22:16,\x22banner_height\x22:9,\x22link_account\x22:\x22\x22,\x22self\x22:\x22\x22,\x22sp\x22:\x22\x22,\x22country\x22:\x22th\x22,\x22bid\x22:0,\x22domain\x22:\x22http:\/\/wap.guruhub.tech\x22,\x22show_outline\x22:false,\x22mode\x22:\x22\x22,\x22manifest\x22:\x22\x22,\x22link\x22:\x22\x22,\x22text_back_to_top\x22:\x22BACK TO TOP\x22,\x22text_day\x22:\x22DAY\x22,\x22text_part\x22:\x22PART\x22,\x22text_duration\x22:\x22DURATION\x22,\x22text_size\x22:\x22size\x22,\x22text_more_info\x22:\x22more\x22,\x22text_menu_1\x22:\x22Popular\x22,\x22text_menu_2\x22:\x22\x22,\x22text_menu_3\x22:\x22Random\x22,\x22text_new_trending\x22:\x22Trending\x22,\x22text_recommend_for_you\x22:\x22Recommend for you\x22,\x22text_loved\x22:\x22loved\x22,\x22text_likes\x22:\x22heart\x22,\x22text_download\x22:\x22Download\x22,\x22text_tab_1\x22:\x22Popular\x22,\x22text_tab_2\x22:\x22Selected\x22,\x22text_tab_3\x22:\x22New\x22,\x22text_tab_4\x22:\x22Random\x22,\x22text_next_page\x22:\x22NEXT\x22,\x22text_start_play\x22:\x22Play\x22,\x22text_today_choice\x22:\x22Today Choice\x22,\x22text_most_star\x22:\x22Most Star\x22,\x22text_play\x22:\x22Play\x22,\x22text_game_description\x22:\x22Description\x22,\x22text_home\x22:\x22Home\x22,\x22text_history\x22:\x22History\x22,\x22text_ranking\x22:\x22Ranking\x22,\x22text_editor_choice\x22:\x22Editor Choice\x22,\x22text_players\x22:\x22players\x22,\x22text_stars\x22:\x22stars\x22,\x22text_views\x22:\x22views\x22,\x22text_about\x22:\x22About\x22,\x22text_rank\x22:\x22Rank\x22,\x22text_popular\x22:\x22Popular\x22,\x22text_new\x22:\x22New\x22,\x22template_type\x22:1,\x22content_type\x22:1,\x22watermark\x22:0,\x22menu_1_category\x22:\x22popular\x22,\x22menu_2_category\x22:\x22random\x22,\x22menu_3_category\x22:\x22random\x22,\x22tab_1_category\x22:\x22random\x22,\x22tab_2_category\x22:\x22popular\x22,\x22tab_3_category\x22:\x22new\x22,\x22tab_4_category\x22:\x22random\x22,\x22text_tap_tap_mix_title_1\x22:\x22Amazing games you should never miss\x22,\x22text_tap_tap_mix_title_2\x22:\x22Puzzle games classic\x22,\x22text_tap_tap_mix_title_3\x22:\x22Find and enjoy most played games\x22,\x22has_bottom_nav\x22:false,\x22bottom_nav_items\x22:[{\x22title\x22:\x22title-a\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-a\x22},{\x22title\x22:\x22title-b\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-b\x22},{\x22title\x22:\x22title-c\x22,\x22icon\x22:\x22\x22,\x22link\x22:\x22link-c\x22}]}');
        var bannerRatio =  9  /  16 
    </script>
    <script src="scripts/zepto.min.js"></script>
    <script src="scripts/data.min.js"></script>
    <script src="scripts/detail.min.js"></script>
</body>

</html>
