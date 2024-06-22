<?php

class HttpUtilClient
{
    public function getMaskedNumber($payload)
    {
        $url = "http://127.0.0.1:8080/vasmasta/he/find-number";
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $resp = curl_exec($curl);
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

    public function getConsent($msidn, $cid, $name, $pid)
    {
        try {
            $credential = $this->getCredentials();
            //error_log("GIL HE credentials -> ".json_encode($credential));
            $data = array("username" => $credential->scLab->username,
                "password" => $credential->scLab->password,
                "grant_type" => "client_credentials");
            $token = $this->getScienLabToken(urldecode(json_encode($data)), $credential->scLab->tokenUrl);
            //error_log("ScienLab Token " . json_encode($token));
            if ($token != null) {
                $consentData = array("msisdn" => $msidn,
                    "campaign_id" => $cid,
                    "source_ip" => $pid,
                    "requestid" => uniqid(),
                    "user_agent" => $_SERVER['HTTP_USER_AGENT'],
                    "redirect_url" => $credential->scLab->redirectUrl . "?name=" . $name);
                error_log("Consent request -> " . json_encode($consentData) . ", Source IP " . $pid);
                $curl = curl_init($credential->scLab->consentUrl);
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(json_encode($consentData)));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json', "Authorization: Bearer " . $token->access_token));
                $resp = curl_exec($curl);
                curl_close($curl);
                error_log("Consent response -> " . $resp);
                return json_decode($resp);
            }
            return null;
        } catch (Exception $exception) {
            error_log("Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString());
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

    public function getConsent2($sid, $ipAddress, $msisdn)
    {
    }
}


