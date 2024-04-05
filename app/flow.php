<?php
require_once('HttpUtilClient.php');
$he = new HttpUtilClient();
$sid = $_GET['sid'];
if (isset($sid)) {
    $response = $he->getConsent('127636472464');
    if($response !=null && $response->cg_url != null){
        header("Location: $response->cg_url");
    }
} else {
    header("Location: https://wap.guruhub.tech");
}

