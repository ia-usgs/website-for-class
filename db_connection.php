<?php
// Database credentials
$host = '172.30.58.67:3306'; // database host
//$host = '172.30.52.25:3306';
$db_user = 'irvin'; // database username
$db_password = ''; // database password
$db_name = 'used_car_database'; // database name
//$db_name = 'used_car_database2';
// Create a new database connection instance
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>
