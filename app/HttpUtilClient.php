<?php

class HttpUtilClient
{
    public function getMaskedNumber($payload)
    {
        //$url = "http://159.65.208.160:8480/vasmasta/he/find-number";
        $url = "http://127.0.0.1:8080/vasmasta/he/find-number";
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $resp = curl_exec($curl);
            print_r($resp);
            curl_close($curl);
            return json_decode($resp, true);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }


    public function getScienLabToken($payload, $url)
    {
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
            $resp = curl_exec($curl);
            curl_close($curl);
            return json_decode($resp);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }

    public function getConsent($msidn)
    {
        try {
            $credential = $this->getCredentials();
            $data = array("username" => $credential->scLab->username,
                "password" => $credential->scLab->password,
                "grant_type" => "client_credentials");
            $token = $this->getScienLabToken($data, $credential->scLab->tokenUrl);
            if ($token != null) {
                $consentData = array("msisdn" => $msidn,
                    "campaign_id" => $credential->scLab->campaignId,
                    "source_ip" => $_SERVER['REMOTE_ADDR'],
                    "requestid" => uniqid(),
                    "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                    "redirect_url" => $credential->scLab->redirectUrl);
                $curl = curl_init($credential->scLab->consentUrl);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(json_encode($consentData)));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json', "Authorization: Bearer " . $token->access_token));
                $resp = curl_exec($curl);
                curl_close($curl);
                return json_decode($resp);
            }
            return null;
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }

    public function getCredentials()
    {
        $url = "https://api.guruhub.tech/vasmasta/he/auth";
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
            $resp = curl_exec($curl);
            curl_close($curl);
            return json_decode($resp);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }
}


