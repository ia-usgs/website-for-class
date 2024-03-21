<?php
session_start(); 

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Vehicle Inventory Management System</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <header>
        <div class="banner">
            <h1>National University Car Dealership</h1>
            <h2>Vehicle Inventory Management System</h2>
            <h2>Dashboard</h2>
            <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>
    <!-- Nav area -->
    <?php include('../navigation/nav_dashboard.php'); ?> 

    <main class="main-content">
        
        

        <img id="carrito" src="/banner.jpg" atl="Car Dealership" >

    </main>
    <!-- Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
