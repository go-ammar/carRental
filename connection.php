<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sampledb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// Now you can perform database operations using $conn

// Close connection when done
// $conn->close();
