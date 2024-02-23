<?php
require_once('HttpUtilClient.php');

class HEWebFlowClient
{
    private $username;
    private $password;
    public function __construct()
    {
        $this->username = "33pda8j0s6gva0rloog8fpmds5";
        $this->password = "57naa464p0c6lbb5ib8vd1p80kk31ktndpcr70jgss6c01mgolv";
    }

    public function checkMobileNumber()
    {
        $heData = array();
        $heData['success'] = "false";
        $token = $this->getToken();
        if ($token != null){
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
            return $data;
            /*if ($data != null) {
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
        }else{
            $heData['message'] = "Token error";
        }

        return $heData;
    }

    private function getToken()
    {
        $url = "https://dev-account-safaricom.auth.eu-west-1.amazoncognito.com/oauth2/token?grant_type=client_credentials";
        $headers = ['Content-type: application/x-www-form-urlencoded',
            'Authorization: Basic '.base64_encode($this->username.":".$this->password)
        ];

        $he = new HttpUtilClient($url, $headers);
        $data = $he->getToken();
        if ($data != null && sizeof($data) > 0 && array_key_exists('access_token', $data)) {
            return trim($data['access_token']);
        }

        return null;
    }
}