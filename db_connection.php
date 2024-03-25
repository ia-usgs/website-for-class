<?php
// Database credentials
$host = '127.0.0.1:3306'; // database host
$db_user = 'root'; // database username
$db_password = 'kali'; // database password
$db_name = 'used_car_database'; // database name

// Create a new database connection instance
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>
