<?php
require_once('HttpUtilClient.php');

$data = json_decode(file_get_contents('php://input'), true);
$he = new HttpUtilClient();
echo $he->getScienLabToken($data);
/*die("Hello world");
class HEWebFlowClient
{
    private $username;
    private $password;
    public function checkMobileNumber($payload)
    {
        $url = "http://159.65.208.160:8480/vasmasta/he/find-number";
        //$he = new HttpUtilClient($url);
       // $data = $he->getMaskedNumber($payload);
        return "$data";
    }
}*/