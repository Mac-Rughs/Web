
<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['admin_username'])) {
    // Redirect to admin dashboard if already logged in
    header("Location: admin_dashboard.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Establish a database connection
    $servername = "localhost";
    $username = "blablaadmin";
    $password = "bla123bla456";
    $dbname = "prepit_users";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if username and password are provided
    if (empty($_POST['admin_username']) || empty($_POST['admin_password'])) {
        echo "Please enter username and password.";
        exit();
    }

    // Get form data
    $admin_username = mysqli_real_escape_string($conn, $_POST['admin_username']);
    $admin_password = mysqli_real_escape_string($conn, $_POST['admin_password']);

    // Query the database
    $sql = "SELECT * FROM admin_users WHERE username='$admin_username' AND password='$admin_password'";
    $result = mysqli_query($conn, $sql);

    // Check for query errors
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    // Check if admin exists
    if (mysqli_num_rows($result) == 1) {
        // Admin authenticated, set session variable
        $_SESSION['admin_username'] = $admin_username;

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Admin authentication failed, show error message
        $error_message = "Invalid username or password.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .error-msg {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="admin_username">Username:</label>
                <input type="text" id="admin_username" name="admin_username" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn">
            </div>
            <?php
            if (isset($error_message)) {
                echo '<div class="error-msg">' . $error_message . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>
