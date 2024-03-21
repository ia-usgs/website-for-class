<?php
session_start();
include('db_connection.php');

$modelId = $_GET['id'] ?? null;
$model = null;
$make = null;

if ($modelId) {
    // Fetch the model details
    $stmt = $conn->prepare("SELECT models.*, makes.name as make_name FROM models JOIN makes ON models.make_id = makes.id WHERE models.id = ?");
    $stmt->bind_param("i", $modelId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $model = $result->fetch_assoc();
        $make = $model['make_name'];
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $newModelName = $_POST['model_name'];
    // Update the model
    $stmt = $conn->prepare("UPDATE models SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $newModelName, $modelId);
    $stmt->execute();
    $stmt->close();
    
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle Model</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    </header>
    <?php include('../navigation/nav_models.php'); ?>
    <main>
        <h2>Edit Vehicle Model</h2>
        <?php if ($model): ?>
        <form action="edit_model.php?id=<?php echo $modelId; ?>" method="post">
            <label for="model_name">Vehicle Model:</label>
            <input type="text" name="model_name" value="<?php echo $model['name']; ?>" required>
            
            <label for="make_name">Vehicle Make:</label>
            <input type="text" name="make_name" value="<?php echo $make; ?>" readonly>
            
            <input type="submit" name="update" value="Edit">
        </form>
        <?php else: ?>
        <p>Model not found.</p>
        <?php endif; ?>
    </main>
    <?php include('../navigation/footer.php'); ?>
</body>
</html>
