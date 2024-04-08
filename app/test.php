<?php
include 'HttpUtilClient.php';
$url = "http://159.65.208.160:8480/vasmasta/he/find-number";
$he = new HttpUtilClient($url);
$servId = "04c1cd83-15a3-4364-b65b-32ed1bbf1491";
$msisdn = "0726387742";
$payload = '{"serviceId":"'.$servId.'","msisdn":"'.$msisdn.'"}';
//$payload = array("serviceId" => "04c1cd83-15a3-4364-b65b-32ed1bbf1491", "msisdn" => "");
echo $payload;
$data = $he->getMaskedNumber($payload);
print_r($data);

$subscribed = $data['subscribed'];
$billed = $data['billed'];

if (!$subscribed) {
    echo "Oooh no, not subscribed\n";
}

if (!$billed) {
    echo "Oooh no, not billed\n";
}


$credential = $he->getCredentials();
$data = array("username" => $credential->scLab->username,
    "password" => $credential->scLab->password,
    "grant_type" => "client_credentials");
$token = $this->getScienLabToken($data, $credential->scLab->tokenUrl);


/*$heData = array();
$heData['success'] = "true";
if ($data != null) {
    $keyExists = array_key_exists('ServiceResponse', $data);
    if (array_key_exists('ServiceResponse', $data)) {
        $response = $data['ServiceResponse'];
        if (array_key_exists('ResponseHeader', $response)) {
            $header = $response['ResponseHeader'];
            if (array_key_exists('ResponseCode', $header) && array_key_exists('ResponseMsg', $header)) {
                $heData['responseCode'] = $header['ResponseCode'];
                $heData['responseMsg'] = $header['ResponseMsg'];
            }
        }

        if (array_key_exists('ResponseBody', $response)) {
            $body = $response['ResponseBody'];
            if (array_key_exists('Response', $body)) {
                $bodyResponse = $body['Response'];
                if (array_key_exists('Msisdn', $bodyResponse)) {
                    $msisdn = $bodyResponse['Msisdn'];
                    $heData['msisdn'] = $msisdn;
                    $heData['success'] = !empty($msisdn) ? "true" : "false";
                }
            }
        }
    }
}*/