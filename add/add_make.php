<?php
session_start();
include('../db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Handle the form submission to add a new make
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_make'])) {
    $make_name = $_POST['vehicle_make'];
    // Insert the new make into the database (with proper validation and sanitization)
    $stmt = $conn->prepare("INSERT INTO makes (name) VALUES (?)");
    $stmt->bind_param("s", $make_name);
    $stmt->execute();
    $stmt->close();
    
    // Redirect to prevent form resubmission
    header('Location: add_make.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Vehicle Make</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <div class="banner">
            <h1>National University Car Dealership</h1>
            <h2>Vehicle Inventory Management System</h2>
            <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>
    
    <?php include('../navigation/nav.php'); ?>

    <main>
        <h2>Add Vehicle Make</h2>
        <form action="add_make.php" method="post">
            <label for="vehicle_make">Vehicle Make:</label>
            <input type="text" id="vehicle_make" name="vehicle_make" required>
            <input type="submit" name="add_make" value="Add">
        </form>
    </main>
    
    <?php include('../navigation/footer.php'); ?>
</body>

</html>
