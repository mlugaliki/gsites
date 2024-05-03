<?php
require_once('HttpUtilClient.php');
$he = new HttpUtilClient();
$sid = $_GET['sid'];
$cid = $_GET['cid'];
$name = $_GET['name'];
if (isset($sid)) {
    $response = $he->getConsent($sid, $cid, $name);
    error_log("ScienLab ->" . $response);
    if ($response != null && $response->cg_url != null) {
        header("Location: $response->cg_url");
    }
} else {
    header("Location: https://wap.guruhub.tech");
}

