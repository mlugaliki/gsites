<?php
class Database
{
    private $host = "67.205.144.173";
    private $database_name = "gsites";
    private $username = "root";
    private $password = "Zni9X55UVgFvhaXBruByL@!987-";
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    }

    function CloseCon($conn)
    {
       // $conn->close();
    }
}
