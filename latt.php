<!DOCTYPE html>
<html>
<head>
    <title>My Web Page</title>
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
    <h1>Linear Algebra and Transform
Techniques</h1>
    
    <div class="column">
        <h2>Notes</h2>
        <div class="scroll-box">
            <!-- Add your notes content here -->
            <p><a href="http://localhost:8012/PrepIT/uploads/car.pdf" target="_blank"> Car</a></p>
            <p><a href="https://drive.google.com/file/d/1xxMPkyzzkhS_Lrt772CT2A5n_xe-fvgC/view?usp=drive_link" target="_blank"> Module 1</a></p>
            <?php
            // PHP code to generate notes dynamically
            for ($i = 1; $i <= 20; $i++) {
                echo "<p>Note $i</p>";
            }
            ?>
        </div>
    </div>
    
    <div class="column">
        <h2>YouTube Links</h2>
        <div class="scroll-box">
            <!-- Add your YouTube links content here -->
            <p><a href="https://youtu.be/xxQd2W_JZFA?list=PL7lBkW4pLsIK-G03ZOcyJ34cMKc5iQ4QA" target="_blank"> Module 1</a></p>
            <p><a href="https://youtu.be/wPurDFlD3Kk?list=PL7lBkW4pLsIK-G03ZOcyJ34cMKc5iQ4QA&t" target="_blank"> Rank Of Matrix</a></p>
            <?php
            // PHP code to generate YouTube links dynamically
            for ($i = 1; $i <= 10; $i++) {
                echo "<p>YouTube Link $i</p>";
            }
            ?>
        </div>
    </div>
    
    <div class="column">
        <h2>Question Papers</h2>
        <div class="scroll-box">
            <!-- Add your question papers content here -->
            <?php
            // PHP code to generate question papers dynamically
            for ($i = 1; $i <= 5; $i++) {
                echo "<p>Question Paper $i</p>";
            }
            ?>
        </div>
    </div>
    
    <div class="clear"></div>
    <a class="back-button" href="fms.php">Back</a>
</body>
</html>
