<?php
// Database configuration
$hostname = "localhost";  // Change this to your database host
$username = "root";  // Change this to your database username
$password = "";  // Change this to your database password
$database = "development_task";  // Change this to your database name

// Create a connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>