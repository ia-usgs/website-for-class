<?php
session_start();
include('../db_connection.php'); 

// redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../pages/login.php'); 
    exit();
}

// Retrieve current users to display
$users = []; 
$sql = "SELECT * FROM users ORDER BY user_id ASC"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
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
        <h3>Registered Users</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['registration_date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <!-- Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
