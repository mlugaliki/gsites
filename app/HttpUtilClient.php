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


    public function getScienLabToken($payload)
    {
        $url = "https://telco-staging-api.scienlabs.com/api/get_token";
        try {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
            $resp = curl_exec($curl);
            curl_close($curl);
            print_r($resp);
            return json_decode($resp, true);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }
}


