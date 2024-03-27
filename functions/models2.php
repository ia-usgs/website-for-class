<?php
session_start();
include('../db_connection.php'); 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php'); 
    exit();
}

// Retrieve the selected make from the query parameter
$selectedMake = $_GET['make'] ?? '';

// Retrieve all models for the selected make from the database
$models = [];
$stmt = $conn->prepare("SELECT m.id, m.name FROM models m JOIN makes m2 ON m.make_id = m2.id WHERE m2.name = ?");
$stmt->bind_param("s", $selectedMake);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $models[] = $row;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Models</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    </header>
    <!-- Nav area -->
    <?php include('../navigation/nav_admin.php'); ?> 
    <main>
        <h2>Models</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($models as $model): ?>
                <tr>
                    <td><?php echo htmlspecialchars($model['name']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <!-- Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
