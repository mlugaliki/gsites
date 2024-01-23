<?php
include './videos.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The best fittness routine platform in Kenya</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://wap.wizlimited.com/assets/pages/portal/video/yoga/assets/img/ic_logo.png" rel="icon">
    <link href="./styles/pure-min.css" rel="stylesheet">
    <link href="http://wap.wizlimited.com/assets/pages/portal/assets/manifest/46.json" rel="manifest">
    <link href="./styles/index.min.css" rel="stylesheet">
    <link href="http://wap.wizlimited.com/assets/pages/portal/video/yoga/assets/img/ic_logo.png" rel="Shortcut Icon"
        type="image/x-icon">
    <style type="text/css" src="styles/style.css"></style>
</head>

<body data-new-gr-c-s-check-loaded="14.1149.0" data-gr-ext-installed="" data-new-gr-c-s-loaded="14.1149.0">
    <div class="container">
        <div class="pure-g">
            <div class="pure-u-1-1 top-header j-top-header"
                style="background-color: rgb(103, 58, 183); height: 263.2px; margin-bottom: 112.8px;">

                <?php
                    $plan = isset($_GET["name"]) ?  htmlspecialchars($_GET["name"]) : '30_day_yoga';
                    $video = new Videos();
                    $stmt = $video->getVideo($plan);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);
                        echo "<div class='pure-g'>"
                            ."<div class='pure-u-1-1'>"
                            ."    <div class='pure-g'>"
                            ."        <div class='pure-u-3-4 header'>".$title."</div>"
                            ."    </div>"
                            ."</div>"

                            ."<div class='pure-u-1-1 banner'>"
                            ."    <div class='j-banner-img-container banner-img-container' data-width='16' data-height='9' style='width: 448px; height: 252px;'>"
                            ."        <img alt='img' class='img-fluid j-banner' src='".$image."'/>"
                            ."    </div><br/>"
                            ."</div><br/>"
                        ."</div>";
                    }
                    
                ?>
            </div>

            <div class="pure-u-1-1 lesson-title">The Plan</div>
            <div class="pure-u-1-1 items j-items">
                <div class="pure-g j-items-container">
                <?php
                        $video = new Videos();
                        $stmt = $video->getVideoPlan($plan);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                        echo "<a class='pure-u-1-1 item j-item index-1566354878722854015 j-item-1566354878722854015' href='view.php?plan-id=".$id."&&fn_day=".fn_day."'><br/>";
                        echo "<img src='".$image ."' alt='cover' class='j-cover item-cover' style='height: 234px; width: 416px;'><br/>";
                        echo "<div class='info'><br/>";
                            echo "<span class='title'>".$category_name ."</span><br/>";
                        echo "</div></a>";
                        }
                ?>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/zepto.min.js"></script>
    <script src="./scripts/data.min.js"></script>
    <script src="./scripts/index.min.js"></script>
</body>

</html>
