<?php
session_start();
include('../db_connection.php'); 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php'); // Redirect to the homepage at the root directory
    exit();
}

// Retrieve all vehicle makes
$makes = [];
$result = $conn->query("SELECT * FROM makes");
while ($row = $result->fetch_assoc()) {
    $makes[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Makes</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    </header>
    <!-- Nav area -->
    <?php include('../navigation/nav_dashboard.php'); ?> 
    <main>
        <h2>Vehicle Makes</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($makes as $make): ?>
                <tr>
                    <td><a href="models.php?make=<?php echo urlencode($make['name']); ?>"><?php echo htmlspecialchars($make['name']); ?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <!-- footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
