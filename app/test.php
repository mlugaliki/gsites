<?php
include 'HttpUtilClient.php';

// Get token
$url = "https://dev-account-safaricom.auth.eu-west-1.amazoncognito.com/oauth2/token?grant_type=client_credentials";
$headers = ['Content-type: application/x-www-form-urlencoded',
    'Authorization: Basic MzNwZGE4ajBzNmd2YTBybG9vZzhmcG1kczU6NTduYWE0NjRwMGM2bGJiNWliOHZkMXA4MGtrMzFrdG5kcGNyNzBqZ3NzNmMwMW1nb2x2',
];

echo base64_encode("33pda8j0s6gva0rloog8fpmds5:57naa464p0c6lbb5ib8vd1p80kk31ktndpcr70jgss6c01mgolv")."\n";
$he = new HttpUtilClient($url, $headers);
$data = $he->getToken();
print_r($data);
if ($data != null && sizeof($data) > 0) {
    // Get subscribers number
    $token = trim($data['access_token']);
    $headers = [
        'X-App: he-partner',
        'x-correlation-conversationid: 434',
        'X-MessageID: 1234',
        'X-DeviceId: 1234',
        'X-DeviceToken: 1234',
        'X-Version: 232',
        'X-Source-System: he-partner',
        'Authorization: Bearer ' . $token
    ];

    $url = "https://uat-identity.safaricom.com/partner/api/v2/fetchMaskedMsisdn";
    $he = new HttpUtilClient($url, $headers);
    $data = $he->getMaskedNumber();
    $heData = array();
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
    }

    print_r($heData);
}