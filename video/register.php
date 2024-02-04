<?php
include './videos.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>The best fittness routine platform in Kenya</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="./styles/pure-min.css" rel="stylesheet">
    <link href="./styles/index.min.css" rel="stylesheet">
    <style type="text/css" src="styles/style.css"></style>
</head>

<body data-new-gr-c-s-check-loaded="14.1149.0" data-gr-ext-installed="" data-new-gr-c-s-loaded="14.1149.0">
    <div class="container">
        <div class="pure-g">
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

            <div class="pure-u-1-1 lesson-title"><h5>Subscribe to <?php echo $title; ?></h5></div>
            <div class="pure-u-1-1 items j-items">
                <div class="pure-g j-items-container">
                    <form>
                        <label for="fname">Name</label><br>
                        <input type="text" id="fname" name="fname" value="John"><br>
                        <label for="phone-number">Phone number:</label><br>
                        <input type="text" id="lname" name="phone-number" value="072200000">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./scripts/zepto.min.js"></script>
    <script src="./scripts/data.min.js"></script>
    <script src="./scripts/index.min.js"></script>
</body>
</html>
