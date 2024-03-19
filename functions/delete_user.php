<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if an ID was passed to this script through the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare the delete statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    if($stmt->error) {
        // Handle error - perhaps redirect to an error page
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $conn->close();

    // Redirect to manage users page
    header('Location: manage_users.php');
    exit();
} else {
    // ID wasn't passed to the script, redirect or handle the error as needed
    header('Location: manage_users.php');
    exit();
}
?>
