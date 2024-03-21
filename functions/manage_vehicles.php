<?php
session_start();
include('../db_connection.php'); 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php'); 
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
    <?php include('../navigation/nav_manage_vehicles.php'); ?> 
    <main>
        <h2>Vehicle Makes</h2>
        <table>
            <tr>
                <th>Edit</th>
                <th>Delete</th>
                <th>Name</th>
            </tr>
            <?php foreach ($makes as $make): ?>
            <tr>
                <td><a href="edit_make.php?id=<?php echo $make['id']; ?>">Edit</a></td>
                <td><a href="delete_make.php?id=<?php echo $make['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                <td><?php echo htmlspecialchars($make['name']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <!--Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
