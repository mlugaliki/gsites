<?php
require_once('HttpUtilClient.php');
$he = new HttpUtilClient();
$sid = $_GET['sid'];
$cid = $_GET['cid'];
$name = $_GET['name'];
$pid = $_GET['pid'];
if (isset($sid)) {
    $response = $he->getConsent($sid, $cid, $name, $pid);
    error_log("ScienLab ->" . json_encode($response));
    if ($response != null && $response->cg_url != null) {
        header("Location: $response->cg_url");
    }
} else {
    header("Location: https://wap.guruhub.tech");
}

