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
    $file_tmp = $_FILES['pdf_file']['tmp_name'];
    $file_type = $_FILES['pdf_file']['type'];
    $file_size = $_FILES['pdf_file']['size'];

    // Check file extension (allow only PDF files)
    $allowed_extensions = array('pdf');
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Only PDF files are allowed.";
        exit();
    }

    // Folder mapping based on the first three letters of the file name
    $folderMapping = array(
        'F3L' => 'Full_Mark/Sem_3/Latt',
        'P3L' => 'Pass_Mark/Sem_3/Latt',
        'ghi' => 'folder3'
        // Add more mappings as needed
    );

    // Extract the first three letters of the file name
    $prefix = substr($file_name, 0, 3);

    // Check if the prefix matches any mapping
    if (isset($folderMapping[$prefix])) {
        $folder = $folderMapping[$prefix];
    } else {
        $folder = 'default_folder'; // Default folder if no specific match is found
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
    $file_path = "uploads/" . $folder . "/" . $file_name;

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Insert the file details into the database
        $sql = "INSERT INTO notes (file_name, file_path, file_type, file_size) VALUES ('$file_name', '$file_path', '$file_type', '$file_size')";

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

<!-- Rest of the HTML code remains the same -->



<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .upload-form {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .upload-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            color: #ffffff;
            background-color: #343a40;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 30px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="upload-form">
            <h1 class="upload-title">Upload Notes</h1>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Select PDF file:</label>
                    <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>

        <a class="back-button" href="admin_dashboard.php">Back</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
