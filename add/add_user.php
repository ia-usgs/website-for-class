<?php
session_start();
include('db_connection.php');

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, first_name, last_name, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $username, $password, $email, $first_name, $last_name, $is_admin);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $conn->close();
    
    header('Location: manage_users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <?php include('nav_manage.php'); ?>
    
    <main>
        <div class="user-form">
            <form action="add_user.php" method="post">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <label for="is_admin">Is Admin:</label>
                <input type="checkbox" id="is_admin" name="is_admin">
                
                <input type="submit" value="Add User">
            </form>
        </div>
    </main>
    
    <?php include('footer.php'); ?>
</body>
</html>
