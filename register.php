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
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match");
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format");
    }

    // Check if username or email already exists in database
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        die("Error: Username or email already exists");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    $result = mysqli_query($conn, $sql);

    // Check if user was added successfully
    if ($result) {
        // User added, redirect to login page
        header("Location: login.html");
        exit();
    } else {
        // User add failed, show error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
