<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beginners Yoga</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="/assets/pages/portal/video/yoga/assets/img/ic_logo.png" rel="icon">
    <link href="//d3vmvvo5csin3s.cloudfront.net/css/pure/1.0.0/pure-min.css" rel="stylesheet">
    <link href="/assets/pages/portal/assets/manifest/46.json" rel="manifest">
    <link href="//d2eshl90wojc4s.cloudfront.net/wap/assets/pages/portal/video/yoga/assets/css/detail.min.css"
        rel="stylesheet">
    <link href="/assets/pages/portal/video/yoga/assets/img/ic_logo.png" rel="Shortcut Icon" type="image/x-icon">
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
                            src="//d2eshl90wojc4s.cloudfront.net/wap/assets/pages/portal/assets/img/ic_back.svg">
                        <span class="j-title">
                            DAY - <?php $categoryId = htmlspecialchars($_GET["plan-id"]); echo $categoryId; ?>
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
                           echo "<div class='img-container j-item-container'>"
                            ."<video src='".$video_url."' poster='".$image."' class='j-video'></video>"
                            ."<img src='//d2eshl90wojc4s.cloudfront.net/wap/assets/pages/portal/assets/img/ic_play.svg'  alt='video' class='icon-play j-play'>"
                        ."</div>"
                        ."<div class='info'>"
                        ."    <div class='title'>PART-1: Breathe &amp; Tune In</div>"
                        ."    <div class='desc'>DURATION: 4′44″</div>"
                        ."</div>";
                        }
                ?>
                        
                    </div>
                </div>
            </div>

            <div class="pure-u-1-1 back-top-container">
                <div class="pure-button pure-button-primary back-top j-back-top" style="background-color: #673AB7;">
                    BACK TO TOP
                </div>
            </div>
        </div>
    </div>
    <script src="//d3vmvvo5csin3s.cloudfront.net/js/zepto/1.2.0/zepto.min.js"></script>
    <script src="//d2eshl90wojc4s.cloudfront.net/wap/assets/pages/portal/video/yoga/assets/js/data.min.js"></script>
    <script src="//d2eshl90wojc4s.cloudfront.net/wap/assets/pages/portal/video/yoga/assets/js/detail.min.js"></script>
</body>

</html>
