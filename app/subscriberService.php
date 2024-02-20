<?php

class subscriberService
{

    public function __construct()
    {
    }

    public function getSubscriber($msisdn, $service)
    {
        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "SELECT id, subscriber_name, phone, service FROM subscribers WHERE phone=:phone AND service=:service";
        if ($conn == null) {
            echo("<p>Invalid connection</p>");
        }

        $stmt = $conn->prepare($sqlQuery);
        $stmt->bindParam(":phone", $msisdn);
        $stmt->bindParam(":service", $service);
        $stmt->execute();
        return $stmt;
    }

    public function saveSubscriber($msisdn, $name, $service)
    {
        $database = new Database();
        $conn = $database->getConnection();
        if ($conn == null) {
            echo("<p>Invalid connection</p>");
        }
        try {
            $stmt = $conn->prepare("INSERT INTO subscribers(subscriber_name,phone,service)VALUES(?,?,?)");
            $stmt->execute([$name, $msisdn, $service]);
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
    }

    public function sendActivationRequest($phone, $serviceId)
    {
        $postData = array(
            'serviceId' => $serviceId,
            'dateTime' => "20240201101000",
            'msisdn' => $phone
        );
        // Setup cURL
        $ch = curl_init('https://api.vasmasta.com:8480/vasmasta/api/subscribe');
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
        // Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }
        // Decode the response
        $responseData = json_decode($response, TRUE);
        // Close the cURL handler
        echo  $responseData;
        curl_close($ch);
    }
}