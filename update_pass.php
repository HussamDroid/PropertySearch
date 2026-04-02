<?php
include 'db_connection.php';

$username = 'john_doe';  // The username for which we want to update the password
$password = 'password123'; // The password to be hashed

// Hash the password using PHP's password_hash function
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Update the user's password in the database
$sql = "UPDATE users SET password = '$hashed_password' WHERE username = '$username'";

if (mysqli_query($conn, $sql)) {
    echo "Password updated successfully!";
} else {
    echo "Error updating password: " . mysqli_error($conn);
}
?>