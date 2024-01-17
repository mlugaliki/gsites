<?php
function OpenCon()
{
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "password@2023";
$db = "gsites";
try {
$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password, $db);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
return $conn;
}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}
// $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
}
function CloseCon($conn)
{
$conn -> close();
}
?>