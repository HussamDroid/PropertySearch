<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection settings - UPDATED TO MATCH YOUR SCREENSHOT
$hostname = "localhost";
$username = "root";
$password = ""; 
$database = "property_recommendation"; // Updated from property_db

// Turn off strict error reporting for a cleaner connection check
mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 20px; text-align: center; border: 1px solid #f5c6cb; font-family: sans-serif;'>";
    echo "<strong>Database Connection Error!</strong><br>";
    echo "The code is looking for a database named '<strong>$database</strong>'.<br>";
    echo "Actual Error: " . mysqli_connect_error();
    echo "</div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PropertySearch Qatar</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
 
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.php">
            <i class="bi bi-houses-fill me-2"></i>PropertySearch
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="ranking.php">Rankings</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3">
                        <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-primary btn-sm rounded-pill px-4">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>