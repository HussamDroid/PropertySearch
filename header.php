<?php
// 1. Error Reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Session Management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Smart Database Connection (Detects Local vs Live)
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $servername = "localhost";
    $username   = "root";
    $password   = ""; 
    $dbname     = "property_recommendation"; 
} else {
    $servername = "sql113.infinityfree.com";
    $username   = "if0_41565717";
    $password   = "LblOtkckpuR6Fw";
    $dbname     = "if0_41565717_property_recommendation"; 
}

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 20px; text-align: center; border: 1px solid #f5c6cb; font-family: sans-serif; margin: 20px; border-radius: 8px;'>";
    echo "<strong>Database Connection Error!</strong><br>";
    echo "Current Host: " . $_SERVER['HTTP_HOST'] . "<br>";
    echo "<strong>Error:</strong> " . mysqli_connect_error();
    echo "</div>";
    exit();
}

mysqli_set_charset($conn, "utf8");
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
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="overview.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ranking.php">Rankings</a>
                </li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3">
                        <span class="navbar-text text-white me-3">
                            <i class="bi bi-person-circle me-1 text-primary"></i> 
                            Hi, <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></strong>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3">
                        <a href="login.php" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script src="assets/js/bootstrap.bundle.min.js"></script>