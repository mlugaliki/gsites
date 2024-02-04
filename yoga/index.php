<?php
include './videos.php';
session_start();
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
            $plan = isset($_GET["name"]) ? htmlspecialchars($_GET["name"]) : '30_day_yoga';
            $video = new Videos();
            $stmt = $video->getVideo($plan);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<div class='pure-g'>"
                    . "<div class='pure-u-1-1'>"
                    . "    <div class='pure-g'>"
                    . "        <div class='pure-u-3-4 header'>" . $title . "</div>"
                    . "    </div>"
                    . "</div>"

                    . "<div class='pure-u-1-1 banner'>"
                    . "    <div class='j-banner-img-container banner-img-container' data-width='16' data-height='9' style='width: 448px; height: 252px;'>"
                    . "        <img alt='img' class='img-fluid j-banner' src='" . $image . "'/>"
                    . "    </div><br/>"
                    . "</div><br/>"
                    . "</div>";
            }

            ?>
        </div>

        <?php if(isset($_SESSION['phone']) && isset($_SESSION['name']) && isset($_SESSION['service'])) {?>
        <div class="pure-u-1-1 lesson-title">The Plan</div>
        <?php
        }else{?>
            <div class="pure-u-1-1 lesson-title">Subscribe NOW!!</div>
        <?php
        }
        ?>
        <div class="pure-u-1-1 items j-items">
            <div class="pure-g j-items-container">
                <?php
                if (isset($_SESSION['phone']) && isset($_SESSION['name']) && isset($_SESSION['service'])) {
                    $video = new Videos();
                    $stmt = $video->getVideoPlan($plan);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<a class='pure-u-1-1 item j-item index-1566354878722854015 j-item-1566354878722854015' href='view.php?plan-id=" . $id . "&&fn_day=" . $fn_day . "'><br/>";
                        echo "<img src='" . $image . "' alt='cover' class='j-cover item-cover' style='height: 234px; width: 416px;'><br/>";
                        echo "<div class='info'><br/>";
                        echo "<span class='title'>" . $category_name . "</span><br/>";
                        echo "</div></a>";
                    }
                } else { ?>
                <div class="img-container j-item-container pure-u-1-1 item j-item index-1566354878722854015 j-item-1566354878722854015">
                    <table border="0px" cellspacing="10px" cellpadding="10px" width="50px">
                        <form name="subscribe" method="post" action="">
                            <tr>
                                <td width="50px"><label for="name">Name</label></td>
                                <td><input type="text" id="name" name="name"/></td>
                            </tr>
                            <tr>
                                <td width="50px"><label for="phone">Phone</label></td>
                                <td><input type="tel" id="phone" name="phone"/></td>
                            </tr>
                            <tr>
                                <td colspan="2"><button class="btn btn-primary" type="submit">Subscribe</button></td>
                            </tr>
                            <input type="hidden" name="service" value="<?php echo $plan;?>">
                        </form>
                    </table>
                </div>
                <?php
                    if (!empty($_POST)) {
                        $name = $_POST['name'];
                        $phoneNumber = $_POST['phone'];
                        $service = $_POST['service'];

                        $database = new Database();
                        $conn = $database->getConnection();
                        if ($conn == null) {
                            echo("<p>Invalid connection</p>");
                        }
                        try {
                            $stmt = $conn->prepare("INSERT INTO subscribers(subscriber_name,phone,service)VALUES(?,?,?)");
                            $stmt->execute([$name, $phoneNumber, $service]);
                            $_SESSION['name'] = $name;
                            $_SESSION['phone'] = $phoneNumber;
                            $_SESSION['service'] = $service;
                            header('Refresh: 1; url=index.php?name='.$plan);
                        } catch (PDOException $exception) {
                            echo "Database could not be connected: " . $exception->getMessage();
                        }
                    }
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
