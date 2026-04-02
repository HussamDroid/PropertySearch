<?php
include 'header.php'; 

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to match your table columns exactly
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $dob = $_POST['dob'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user or email exists
    $check_user = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $run_check = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($run_check) > 0) {
        $message = "Username or Email already taken!";
        $message_type = "danger";
    } else {
        // MATCHED TO YOUR TABLE: first_name, last_name, email, date_of_birth, username, password, country
        $sql = "INSERT INTO users (first_name, last_name, email, date_of_birth, username, password, country) 
                VALUES ('$first_name', '$last_name', '$email', '$dob', '$username', '$password', '$country')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "Account created successfully! <a href='login.php'>Login here</a>";
            $message_type = "success";
        } else {
            $message = "Error: " . mysqli_error($conn);
            $message_type = "danger";
        }
    }
}
?>

<div class="container d-flex align-items-center justify-content-center my-5">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 600px; width: 100%;">
        <div class="card-body p-5">
            <h2 class="fw-bold text-center mb-4">Register</h2>
            
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?> small text-center"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">First Name</label>
                        <input type="text" name="first_name" class="form-control bg-light" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Last Name</label>
                        <input type="text" name="last_name" class="form-control bg-light" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Email</label>
                    <input type="email" name="email" class="form-control bg-light" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Date of Birth</label>
                        <input type="date" name="dob" class="form-control bg-light" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold">Country</label>
                        <input type="text" name="country" class="form-control bg-light" placeholder="e.g. Qatar" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" name="username" class="form-control bg-light" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control bg-light" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Create Account</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>