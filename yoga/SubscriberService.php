<?php

class SubscriberService
{

    public function __construct()
    {
    }

    public function getSubscriber($msisdn, $service){
        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "SELECT id, subscriber_name, phone, service FROM subscribers WHERE phone=:phone AND service=:service";
        if($conn == null){
            echo ("<p>Invalid connection</p>");
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
}