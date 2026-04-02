<?php
include 'header.php'; // This handles session_start and DB connection

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 450px; width: 100%;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="display-6 text-primary mb-2"><i class="bi bi-person-lock"></i></div>
                <h2 class="fw-bold">Welcome Back</h2>
                <p class="text-muted small">Please enter your details to sign in</p>
            </div>

            <?php if ($error_message): ?>
                <div class="alert alert-danger py-2 small text-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" name="username" class="form-control border-start-0 bg-light" placeholder="Enter username" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 bg-light" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm mb-3">
                    Sign In
                </button>
                
                <div class="text-center">
                    <p class="small text-muted mb-0">Don't have an account? <a href="register.php" class="text-decoration-none fw-bold">Create one</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>