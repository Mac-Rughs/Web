<?php
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

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if username and password are provided
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "Please enter username and password.";
        exit();
    }

    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start a session and store user data
            session_start();
            $_SESSION['username'] = $username;

            // Redirect to home page
            header("Location: index.php");
            exit();
        }
    }

    // User authentication failed, show error message
    echo "Invalid username or password.";
}

mysqli_close($conn);
?>
