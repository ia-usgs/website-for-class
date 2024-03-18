<?php
// Database credentials
$host = 'localhost'; // or your database host, e.g., a remote server
$db_user = 'root'; // your database username
$db_password = 'kali'; // your database password
$db_name = 'used_car_database'; // your database name

// Create a new database connection instance
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If you wish to set the charset (optional)
$conn->set_charset("utf8");

// The connection is now established and you can use $conn to interact with your database
?>
