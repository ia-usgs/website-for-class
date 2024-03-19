<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$makeId = $_GET['id'] ?? null;
$make = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $makeId) {
    // Sanitize and validate input
    $make_name = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_STRING);
    
    // Update the make in the database
    if ($make_name) {
        $stmt = $conn->prepare("UPDATE makes SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $make_name, $makeId);
        $stmt->execute();
        $stmt->close();
        
        header('Location: manage_vehicles.php');
        exit();
    }
}

if ($makeId) {
    // Fetch the make's data for the form
    $stmt = $conn->prepare("SELECT * FROM makes WHERE id = ?");
    $stmt->bind_param("i", $makeId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $make = $result->fetch_assoc();
    } else {
        exit('Make not found.'); // Handle the case where the make does not exist
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle Make</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
        <nav>
            <!-- Navigation -->
            <a href="logout.php">Logout</a>
            <a href="new_make.php">New Make</a>
            <a href="manage_vehicles.php">Manage Vehicles</a>
            <a href="admin_page.php">Admin Page</a>
        </nav>
    </header>
    
    <main>
        <?php if ($make): ?>
            <h2>Edit Vehicle Make</h2>
            <form action="edit_make.php?id=<?php echo $makeId; ?>" method="post">
                <label for="make_name">Vehicle Make:</label>
                <input type="text" id="make_name" name="make_name" value="<?php echo htmlspecialchars($make['name']); ?>" required>
                <input type="submit" value="Edit">
            </form>
        <?php else: ?>
            <p>Make not found.</p>
        <?php endif; ?>
    </main>
    
    <footer>
        <p>Copyright & Designed by Peter Nguyen 2019 | <a href="mailto:feedback@example.com">Click Here to Send Feedback</a></p>
    </footer>
</body>
</html>
