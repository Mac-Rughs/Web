<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="home.css" type="text/css">
</head>
<body>

<header class="header">
    <a href="#" class="logo">PrepIT</a>
    <h3 class="phrase">The World is Your Classroom: Explore, Learn, Grow</h3>
    <div class="profile">
        <img src="https://clipground.com/images/profile-logo-3.png" alt="DP">
        <?php
        session_start();

        if (isset($_SESSION['username'])) {
            echo '<p>Hello ' . $_SESSION['username'] . '</p>';
            echo '<a href="logout.php" class="logout-btn">Logout</a>';
        } else {
            echo '<a href="login.html" class="logout-btn">Login</a>';
        }
        ?>
    </div>
</header>

<div class="content">
    <h1>Student Dashboard</h1>
</div>

<div class="Full_mark">
    <h1><a href="FMS.php" class="Full_mark">Full Marks Oriented Study</a></h1>
</div>

<div class="Pass_mark">
    <h1><a href="pms.php" class="Pass_mark">Pass Marks Oriented Study</a></h1>
</div>

<!-- Admin Login Button -->
<div class="admin-login-btn">
    <a href="admin_login.php" class="admin-btn">Admin Login</a>
</div>

</body>
</html>
