<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_username'])) {
    // Redirect to the admin login page
    header('Location: admin_login.php');
    exit();
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file is selected
    if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] == UPLOAD_ERR_NO_FILE) {
        echo "Please select a PDF file.";
        exit();
    }

    // Get file details
    $file_name = $_FILES['pdf_file']['name'];
    $file_size = $_FILES['pdf_file']['size'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_type = $_FILES['pdf_file']['type'];

    // Check file extension (allow only PDF files)
    $allowed_extensions = array('pdf');
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Only PDF files are allowed.";
        exit();
    }

    // Database configuration
    $servername = "localhost";
    $username = "blablaadmin";
    $password = "bla123bla456";
    $dbname = "prepit_notes";

    // Create a new connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the data for insertion
    $file_name = mysqli_real_escape_string($conn, $file_name);
    $file_path = "uploads/" . $file_name;

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Insert the file details into the database
        $sql = "INSERT INTO notes (file_name, file_path) VALUES ('$file_name', '$file_path')";

        if (mysqli_query($conn, $sql)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <h1>Upload Notes</h1>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="pdf_file">Select PDF file:</label>
        <input type="file" id="pdf_file" name="pdf_file" accept=".pdf" required>

        <button type="submit">Upload</button>
    </form>
</body>
</html>
