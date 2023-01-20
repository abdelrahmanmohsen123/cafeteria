<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
  $conn = new PDO("mysql:host=$servername;dbname=cafeteria", $username, $password);
  // set the PDO error mode to exception


  return "Connected successfully";
} catch (PDOException $e) {
  return "Connection failed: " . $e->getMessage();
}
