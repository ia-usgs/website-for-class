<?php
session_start();
include('../../db_connection.php'); 

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../../login.php'); 
    exit();
}

$selectedMakeId = $_POST['make_id'] ?? null;
$models = [];

if ($selectedMakeId) {
    $stmt = $conn->prepare("SELECT * FROM models WHERE make_id = ?");
    $stmt->bind_param("i", $selectedMakeId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $models[] = $row;
    }
    
    $stmt->close();
}

// Get all makes for the dropdown
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
    <title>Manage Vehicle Models</title>
    <link rel="stylesheet" href="../../style.css"> 
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
        <form action="manage_models.php" method="post">
            <label for="make_id">Select Vehicle Make:</label>
            <select name="make_id" id="make_id">
                <?php foreach ($makes as $make): ?>
                    <option value="<?php echo $make['id']; ?>"><?php echo $make['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Submit">
        </form>

        <?php if ($selectedMakeId): ?>
            <h2>Vehicle Models</h2>
            <table>
                <tr>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Model Name</th>
                </tr>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><a href="edit_model.php?id=<?php echo $model['id']; ?>">Edit</a></td>
                        <td><a href="delete_model.php?id=<?php echo $model['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                        <td><?php echo $model['name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </main>
    <!-- Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
