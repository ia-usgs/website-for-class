<?php
session_start();

// Enable error reporting for debugging 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../db_connection.php'); 

// Check if the form data is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the input to prevent XSS
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Prevent SQL injection by using prepared statements
    $stmt = $conn->prepare("SELECT user_id, username, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password against the hashed version in the database
        if (password_verify($password, $user['password'])) {
            // Password is correct, create session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];

            // Close the database connection before redirection
            $conn->close();

            // Redirect the user based on their admin status
            if ($user['is_admin']) {
                header("Location: admin_page.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            // If password doesn't match, redirect with an error
            // Close the database connection before redirection
            $conn->close();

            header("Location: index.php?error=Incorrect%20username%20or%20password");
            exit();
        }
    } else {
        // Username doesn't exist, redirect with an error
        // Close the database connection before redirection
        $conn->close();

        header("Location: index.php?error=Incorrect%20username%20or%20password");
        exit();
    }
} else {
    // If the form wasn't submitted via POST, redirect to the login form
    header("Location: index.php");
    exit();
}
?>
