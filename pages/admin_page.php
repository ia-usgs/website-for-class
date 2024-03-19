<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit();
}

// Include database connection file
include('../db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Vehicle Inventory Management System</title>
    <link rel="stylesheet" href="../style.css"> <!-- Make sure this path is correct based on your project's structure -->
</head>
<body>
    <header>
        <div class="banner">
            <h1>National University Car Dealership</h1>
            <h2>Vehicle Inventory Management System</h2>
        </div>
    </header>

    <!-- Include the admin-specific navigation bar -->
    <?php include('../navigation/nav_admin.php'); ?>

    <main class="main-content">
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <div class="category-container">
            <!-- Categories and images go here -->
        </div>
    </main>

    <!-- Include the footer -->
    <?php include('../navigation/footer.php'); ?>

</body>
</html>
