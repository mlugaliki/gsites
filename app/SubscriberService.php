<?php

class SubscriberService
{
    public function sendActivationRequest($phone, $serviceId)
    {
        $date = new DateTime('2000-01-01');
        echo $date->format('YmdHmmss') . "\n";
        $postData = array(
            'serviceId' => $serviceId,
            'dateTime' => $date->format('YmdHmmss'),
            'msisdn' => $phone
        );
        // Setup cURL
        $ch = curl_init('http://159.65.208.160:8480/vasmasta/api/subscribe');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'x-api-Key: ' . "9090",
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        // Send the request
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }

        json_decode($response, TRUE);
        curl_close($ch);
    }

    public function sendCampaign($clickId, $name)
    {
        $postData = array(
            'clickId' => $clickId,
            'service' => $name
        );

        // Setup cURL
        // $ch = curl_init('https://api.guruhub.tech/vasmasta/he/campaign');
        $ch = curl_init('http://localhost:8081/vasmasta/he/campaigns');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'x-api-Key: ' . "9090",
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        // Send the request
        $response = curl_exec($ch);
        if ($response === FALSE) {
            die(curl_error($ch));
        }

        json_decode($response, TRUE);
        curl_close($ch);
    }
}