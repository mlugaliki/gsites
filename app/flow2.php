<?php
require_once('HttpUtilClient.php');
$he = new HttpUtilClient();
$sid = $_GET['msisdn'];
$name = $_GET['name'];
$pid =  $_GET['ipAddress'];
$cid = getCampaignId($name);

error_log("Masked MSISDN =".$sid." Video plan =".$name." IP ".$pid ." CampaignId ".$cid);
if (isset($sid)) {
    $response = $he->getConsent2($sid, $pid, $sid);
    error_log("Flow2 -> ScienLab ->" . json_encode($response));
    if ($response != null && $response->cg_url != null) {
        header("Location: $response->cg_url");
    }
} else {
    header("Location: https://wap.guruhub.tech/app/home.php");
}


//public function getCampaignId($name)
//{
    $db = new Database();
    $conn = $db->getConnection();
    try {
        $sqlQuery = "SELECT campaign_id FROM video WHERE video_name=:video_name AND deleted_at IS NULL ORDER BY id ASC;";
        if ($conn == null) {
            echo("<p>Invalid connection</p>");
        }
        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(":video_name", $name);
        $stmt->execute();
        $video=  $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($video as $vp) {
            error_log("Video: " .$name ." found");
            return $vp['campaign_id'];
        }
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    // return null;
//}

//26d9b19c-6545-476f-b8eb-95172a49aeea