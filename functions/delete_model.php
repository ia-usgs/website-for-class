<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$modelId = $_GET['id'] ?? null;

if (!$modelId) {
    exit('No model specified.');
}

$model = null;

// Fetch the model's name for confirmation message
$stmt = $conn->prepare("SELECT name FROM models WHERE id = ?");
$stmt->bind_param("i", $modelId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $model = $result->fetch_assoc();
} else {
    exit('Model not found.');
}
$stmt->close();

// Check if the confirmation form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] === 'Yes') {
        // Delete the model from the database
        $deleteStmt = $conn->prepare("DELETE FROM models WHERE id = ?");
        $deleteStmt->bind_param("i", $modelId);
        $deleteStmt->execute();
        $deleteStmt->close();
        
        header('Location: manage_models.php');
        exit();
    } elseif (isset($_POST['confirm']) && $_POST['confirm'] === 'No') {
        // If user chose 'No', redirect back to the manage models page
        header('Location: manage_models.php');
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Vehicle Model</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <?php include('nav_models.php'); ?> <!-- Replace the existing nav with the include -->
    
    <main>
        <h2>Delete Vehicle Model</h2>
        <?php if ($model): ?>
            <p>Are you sure you want to permanently delete <?php echo htmlspecialchars($model['name']); ?>?</p>
            <form action="delete_model.php?id=<?php echo $modelId; ?>" method="post">
                <input type="submit" name="confirm" value="Yes">
                <input type="submit" name="confirm" value="No">
            </form>
        <?php else: ?>
            <p>Model not found.</p>
        <?php endif; ?>
    </main>
    
    <?php include('footer.php'); ?> <!-- Replace the existing footer with the include -->
</body>
</html>
