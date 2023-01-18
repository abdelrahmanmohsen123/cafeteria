<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=cafteria", $username, $password);
  // set the PDO error mode to exception
  

  return "Connected successfully";
} catch(PDOException $e) {
  return "Connection failed: " . $e->getMessage();
}


?>