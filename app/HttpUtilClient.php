<?php

class HttpUtilClient
{
    public function getMaskedNumber($payload)
    {
        $url = "http://159.65.208.160:8480/vasmasta/he/find-number";
        try
        {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $resp = curl_exec($curl);
           // print_r($resp);
            curl_close($curl);
            return json_decode($resp, true);
        } catch (Exception $exception) {
            echo "Error message ->" . $exception->getMessage() . "->" . $exception->getTraceAsString();
            return null;
        }
    }
}


