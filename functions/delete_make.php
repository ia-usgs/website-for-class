<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$makeId = $_GET['id'] ?? null;

if (!$makeId) {
    exit('No make specified.');
}

$make = null;

// Fetch the make's name for confirmation message
$stmt = $conn->prepare("SELECT name FROM makes WHERE id = ?");
$stmt->bind_param("i", $makeId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $make = $result->fetch_assoc();
} else {
    exit('Make not found.');
}
$stmt->close();

// Check if the confirmation form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'Yes') {
        // Delete the make from the database
        $deleteStmt = $conn->prepare("DELETE FROM makes WHERE id = ?");
        $deleteStmt->bind_param("i", $makeId);
        $deleteStmt->execute();
        $deleteStmt->close();
        
        header('Location: manage_vehicles.php');
        exit();
    } else {
        // If user chose 'No', redirect back to the manage vehicles page
        header('Location: manage_vehicles.php');
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Vehicle Make</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <?php include('nav.php'); ?> <!-- Include the navigation bar -->
    
    <main>
        <h2>Delete Vehicle Make</h2>
        <?php if ($make): ?>
            <p>Are you sure you want to permanently delete <?php echo htmlspecialchars($make['name']); ?>?</p>
            <form action="delete_make.php?id=<?php echo $makeId; ?>" method="post">
                <input type="submit" name="confirm" value="Yes">
                <input type="submit" name="confirm" value="No">
            </form>
        <?php else: ?>
            <p>Make not found.</p>
        <?php endif; ?>
    </main>
    
    <?php include('footer.php'); ?> <!-- Include the footer -->
</body>
</html>
