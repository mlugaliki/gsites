<?php
require_once('HttpUtilClient.php');
#$data = json_decode(file_get_contents('php://input'), true);
#$data = json_encode('{"username":"guruhub","password":"4x5d8q9j3p7n6v2b1t","grant_type":"client_credentials"}', false);
$data = '{"username":"guruhub","password":"4x5d8q9j3p7n6v2b1t","grant_type":"client_credentials"}';
#$data = file_get_contents('php://input');
#print_r($data);
$he = new HttpUtilClient();
#echo $data;
//$response = $he->getScienLabToken($data);
print_r($he->getConsent());
#echo json_encode($response);
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
