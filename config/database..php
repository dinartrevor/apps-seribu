<?php 
$servername = "localhost";
$username = "root";
$password = "pasword";
$dbname = "apps-seribu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

