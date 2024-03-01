<?php
require_once('HttpUtilClient.php');

class HEWebFlowClient
{
    private $username;
    private $password;



    public function checkMobileNumber($payload)
    {
        $url = "http://159.65.208.160:8480/vasmasta/he/find-number";
        $he = new HttpUtilClient($url);
        $data = $he->getMaskedNumber($payload);
        return $data;
    }
}