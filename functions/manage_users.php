<?php
session_start();
include('../db_connection.php'); // Adjust path to go up one level to root

// Security check: redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Adjust path to login.php in root
    exit();
}

// Retrieve current users to display
$users = []; // Placeholder for users array
$sql = "SELECT * FROM users ORDER BY user_id ASC"; // SQL query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close(); // Close database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../style.css"> <!-- Adjust path for stylesheet -->
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <?php include('../navigation/nav_admin.php'); ?> <!-- Adjust include path for admin navigation -->
    
    <main>
        <h3>Registered Users</h3>
        <table>
            <thead>
                <tr>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
    <td><a href="edit_user.php?id=<?php echo $user['user_id']; ?>">Edit</a></td>
<td><a href="delete_user.php?id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?');">Delete</a></td>


        <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
        <td><?php echo htmlspecialchars($user['username']); ?></td>
        <td><?php echo htmlspecialchars($user['email']); ?></td>
        <td><?php echo htmlspecialchars($user['registration_date']); ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </main>
    
    <?php include('../navigation/footer.php'); ?> <!-- Adjust path for footer -->
</body>
</html>
