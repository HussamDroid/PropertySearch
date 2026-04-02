<?php
$servername = "localhost";
$username = "root";  // Use your database username (default for XAMPP/MAMP is 'root')
$password = "";      // Your database password (default for XAMPP/MAMP is an empty string)
$dbname = "property_recommendation";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>