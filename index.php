<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National University Car Dealership - Vehicle Inventory Management System</title>
    <!-- Correct the path to the stylesheet, assuming this file is in the root directory -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <nav>
        <ul>
            <!-- Assuming index.php is the home page and it is located at the root directory -->
            <li><a href="index.php">Home</a></li>
            <!-- Add more links here as needed -->
        </ul>
    </nav>
    
    <main>
        <!-- Main content goes here -->
        <div class="login-form">
            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <h3>Login</h3>
            <!-- Assuming the form should post to login.php in the pages directory -->
            <form action="pages/login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    
    <!-- Include the footer using PHP, corrected path assuming this file is in the root directory -->
    <?php include('navigation/footer.php'); ?>
</body>
</html>
