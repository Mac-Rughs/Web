<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['admin_username'])) {
    // If not logged in, redirect to the admin login page
    header("Location: admin_login.php");
    exit();
}

// Check if the user clicked the logout button
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the admin login page
    session_destroy();
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            color: #333333;
        }

        .logout-link {
            display: block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }

        .logout-link:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['admin_username']; ?></h1>
        <?php include 'upload_notes.php'; ?>

        <!-- Add your dashboard content here -->

        <a href="?logout=1" class="logout-link">Logout</a>
    </div>
</body>
</html>
