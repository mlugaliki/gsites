<?php
require_once('HttpUtilClient.php');
require_once('videoService.php');

$he = new HttpUtilClient();
$sid = $_GET['msisdn'];
$name = $_GET['name'];
$pid =  $_GET['ipAddress'];

$videoService = new VideoService();
$cid = $videoService->getCampaignId($name);

error_log("Masked MSISDN =".$sid." Video plan =".$name." IP ".$pid ." CampaignId ".$cid ."\n");
if (isset($sid)) {
    $response = $he->getConsent($sid, $cid, $name, $pid);
    echo json_encode($response);
    /*error_log("\nFlow2 -> ScienLab ->" . json_encode($response));
    if ($response != null && $response->cg_url != null) {
        header("Location: $response->cg_url");
    }*/
} else {
    header("Location: https://wap.guruhub.tech/app/home.php");
}