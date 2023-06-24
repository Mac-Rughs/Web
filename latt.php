<!DOCTYPE html>
<html>
<head>
    <title>subject</title>
    <style>
        h1 {
            font-family: "Times New Roman", Times, serif;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 2em;
        }
        .column {
            width: 33.33%;
            float: left;
            padding: 10px;
        }
        .scroll-box {
            height: 200px;
            overflow: auto;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .clear {
            clear: both;
        }
        .back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            color:white ;
            padding: 5px;
            font-weight: bold;
            border-radius: 20%;
            text-transform: uppercase;
            background-color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>$subject</h1>

    <div class="column">
        <h2>Notes</h2>
        <div class="scroll-box">
            <?php
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

            // Function to generate dynamic content based on the subject and type
            function generateContent($conn, $subject, $type)
            {
                // Prepare and execute a query to retrieve the content for the selected subject and type
                $query = "SELECT file_name, file_path FROM notes WHERE subject = '$subject' AND type = '$type'";
                $result = mysqli_query($conn, $query);

                // Process the query result and generate the content
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $fileName = $row['file_name'];
                        $filePath = $row['file_path'];
                        echo "<p><a href='$filePath' target='_blank'>$fileName</a></p>";
                    }
                } else {
                    echo "No $type available for this subject.";
                }
            }

            // Retrieve the subject from the query parameter
            $subject = $_GET['subject'];

            // Call the generateContent function with the selected subject and type 'Notes'
            generateContent($conn, $subject, 'Notes');

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <div class="column">
        <h2>YouTube Links</h2>
        <div class="scroll-box">
            <?php
            // Create a new connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Call the generateContent function with the selected subject and type 'YouTube Links'
            generateContent($conn, $subject, 'YouTube Links');

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <div class="column">
        <h2>Question Papers</h2>
        <div class="scroll-box">
            <?php
            // Create a new connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Call the generateContent function with the selected subject and type 'Question Papers'
            generateContent($conn, $subject, 'Question Papers');

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <div class="clear"></div>
    <a class="back-button" href="fms.php">Back</a>
</body>
</html>
