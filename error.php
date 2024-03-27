<?php
session_start(); 

// Retrieve the error message from the query parameter
$error = isset($_GET['error']) ? $_GET['error'] : '';
$imageUrl = 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.behance.net%2Fsearch%2Fprojects%2Fmewtwo&psig=AOvVaw3-4O8NnmTEortxisyr85AF&ust=1711630530734000&source=images&cd=vfe&opi=89978449&ved=0CBAQjRxqFwoTCMDpq-K-lIUDFQAAAAAdAAAAABAD'; // pic URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - National University Car Dealership</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>National University Car Dealership</h1>
        <h2>Vehicle Inventory Management System</h2>
    </header>
    
    <main>
        <div class="error-page">
            <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Error Image">
            <h3>Oops! Something went wrong.</h3>
            <h3>Check your login information.</h3>
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="index.php">Return to Homepage</a>
        </div>
    </main>
    
    <!-- Footer area -->
    <?php include('navigation/footer.php'); ?>
</body>
</html>
