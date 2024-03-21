<?php
session_start();
include('../db_connection.php');

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../pages/login.php');
    exit();
}

$userId = $_GET['id'] ?? null;
$user = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
    // Assume POST data is already validated and sanitized
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    
    // Check if password was provided, if so, hash it
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : NULL;

    // Prepare SQL statement
    if ($password) {
        $updateStmt = $conn->prepare("UPDATE users SET username=?, first_name=?, last_name=?, email=?, password=?, is_admin=? WHERE user_id=?");
        $updateStmt->bind_param("sssssii", $username, $first_name, $last_name, $email, $password, $is_admin, $userId);
    } else {
        // If password was not provided, do not update the password column
        $updateStmt = $conn->prepare("UPDATE users SET username=?, first_name=?, last_name=?, email=?, is_admin=? WHERE user_id=?");
        $updateStmt->bind_param("ssssii", $username, $first_name, $last_name, $email, $is_admin, $userId);
    }
    
    // Execute and close the statement
    $updateStmt->execute();
    $updateStmt->close();

    // Redirect after successful update
    header('Location: manage_users.php');
    exit();
}

if ($userId) {
    // Fetch the user's data for the form
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        exit('User not found.'); // Handle the case where user does not exist.
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
        <p>You are currently logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    </header>
    
    <<?php include('../navigation/nav_edit_user.php'); ?>
    
    <main>
        <div class="user-form">
            <?php if ($user): ?>
            <form action="edit_user.php?id=<?php echo $userId; ?>" method="post">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                
                <label for="is_admin">Is Admin:</label>
                <input type="checkbox" id="is_admin" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>>
                
                <input type="submit" value="Edit">
            </form>
            <?php else: ?>
            <p>User not found.</p>
            <?php endif; ?>
        </div>
    </main>
    <!-- Footer area -->
    <?php include('../navigation/footer.php'); ?> 
</body>
</html>
