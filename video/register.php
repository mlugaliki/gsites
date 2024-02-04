<?php
    include 'db.php';
    //if(isset($_POST["subscribe-drumbell"])){
    if(!empty($_POST)){
        $name = $_POST['customername'];
        $phoneNumber = $_POST['phoneNumber'];
        $service = $_POST['service'];

        $database = new Database();
        $conn = $database->getConnection();
        $sqlQuery = "INSERT INTO gsites.subscribers(subscriber_name, phone, service)VALUES(:name,:phone_number,:service)";
        if($conn == null){
            echo ("<p>Invalid connection</p>");
        }

        try{
            $stmt = $conn->prepare('INSERT INTO subscribers(subscriber_name,phone,service)VALUES(?,?,?)');
            $stmt->execute([$name, $phoneNumber, $phone, $service]);
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
        }
    }else{
        echo "Wrong form submitted";
    }
?>