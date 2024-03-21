<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National University Car Dealership - Vehicle Inventory Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <nav>
        <ul>
            <!-- Did not make a seperate php file since I only use this nav links once-->
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    
    <main>
        <div class="login-form">
            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <h3>Login</h3>
            <form action="pages/login.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    
    <!-- Footer area -->
    <?php include('navigation/footer.php'); ?>
</body>
</html>
