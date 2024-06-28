<?php
class Database
{
    private $host = "127.0.0.1";
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
            error_log("Database could not be connected: " . $exception->getMessage());
        }
        return $this->conn;
    }

    function CloseCon($conn)
    {
       // $conn->close();
    }
}
