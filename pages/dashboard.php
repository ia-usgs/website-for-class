<?php
session_start(); // This should be the first line to ensure session variable access

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Assuming index.php is in the root, adjust if it's elsewhere
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Vehicle Inventory Management System</title>
    <link rel="stylesheet" href="../style.css"> <!-- Adjusted path to root directory -->
</head>
<body>
    <header>
        <div class="banner">
            <h1>National University Car Dealership</h1>
            <h2>Vehicle Inventory Management System</h2>
        </div>
    </header>

    <?php include('../navigation/nav_dashboard.php'); ?> <!-- Corrected path for the navigation bar -->

    <main class="main-content">
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <!-- Main content area where dynamic content will be loaded based on navigation -->
    </main>

    <?php include('../navigation/footer.php'); ?> <!-- Corrected path for the footer -->
</body>
</html>
