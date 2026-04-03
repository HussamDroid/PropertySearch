<?php include 'header.php'; ?>

<?php
// 1. Get the Property ID safely
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 2. Fetch Property Details
$query = "SELECT * FROM properties WHERE property_id = '$property_id'";
$result = mysqli_query($conn, $query);
$property = mysqli_fetch_assoc($result);

if (!$property) {
    echo "<div class='container my-5 text-center'><div class='alert alert-danger'>Property not found.</div></div>";
    include 'footer.php';
    exit();
}

$user_id = $_SESSION['user_id'] ?? null;
$message = "";

// 2. Logic for Favorites (Save & Remove)
$is_favorite = false;
if (isset($_SESSION['user_id'])) {
    $u_id = $_SESSION['user_id'];
    $p_name = mysqli_real_escape_string($conn, $property['name']);

    // Handle Saving
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_favorite'])) {
        mysqli_query($conn, "UPDATE users SET preferred_property = '$p_name' WHERE user_id = $u_id");
    }

    // Handle Removing
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_favorite'])) {
        mysqli_query($conn, "UPDATE users SET preferred_property = NULL WHERE user_id = $u_id");
    }

    // Refresh check status for the UI
    $check = mysqli_query($conn, "SELECT preferred_property FROM users WHERE user_id = $u_id");
    $user_data = mysqli_fetch_assoc($check);
    if ($user_data && $user_data['preferred_property'] === $property['name']) {
        $is_favorite = true;
    }
}

// 3. Handle Review Submission (Using your user_reviews table)
if (isset($_POST['submit_review']) && $user_id) {
    $score = intval($_POST['score']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $check_query = "SELECT * FROM user_reviews WHERE user_id = '$user_id' AND property_id = '$property_id'";
    $check_res = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_res) > 0) {
        $message = "<div class='alert alert-warning mt-3'>You have already reviewed this property.</div>";
    } else {
        $insert_review = "INSERT INTO user_reviews (user_id, property_id, title, content, score) 
                          VALUES ('$user_id', '$property_id', '$title', '$content', '$score')";
        mysqli_query($conn, $insert_review);
        $message = "<div class='alert alert-success mt-3'>Review posted!</div>";
    }
}

// 4. Fetch Reviews
$reviews_query = "SELECT r.*, u.username FROM user_reviews r 
                  JOIN users u ON r.user_id = u.user_id 
                  WHERE r.property_id = '$property_id' ORDER BY r.review_id DESC";
$reviews_result = mysqli_query($conn, $reviews_query);
?>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-lg-8">
            
           <div id="propertyCarousel" class="carousel slide shadow-sm rounded-4 overflow-hidden mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/property<?php echo $property_id; ?>/1.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" onerror="this.src='assets/images/property<?php echo $property_id; ?>.jpg'">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <p class="mb-0">Bedroom</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/property<?php echo $property_id; ?>/2.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" onerror="this.src='assets/images/placeholder.jpg'">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <p class="mb-0">Bedroom / Bath Facilities</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/property<?php echo $property_id; ?>/3.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;" onerror="this.src='assets/images/placeholder.jpg'">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <p class="mb-0">Living area / Kitchen</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <div class="amenities-section mb-5 p-4 bg-white rounded-4 shadow-sm">
                <h4 class="fw-bold text-primary mb-4">Property Amenities</h4>
                <div class="row">
                    <div class="col-md-4 mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Parking</div>
                    <div class="col-md-4 mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Gym Access</div>
                    <div class="col-md-4 mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> 24/7 Security</div>
                    <div class="col-md-4 mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Central AC</div>
                    <div class="col-md-4 mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> High-speed WiFi</div>
                </div>
            </div>

            <div class="reviews-section">
                <h4 class="fw-bold mb-3">Recent Reviews</h4>
                <?php if (mysqli_num_rows($reviews_result) > 0): ?>
                    <?php while($rev = mysqli_fetch_assoc($reviews_result)): ?>
                        <div class="card border-0 shadow-sm p-3 mb-3 rounded-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-bold text-primary mb-1">@<?php echo htmlspecialchars($rev['username']); ?></h6>
                                <span class="badge bg-light text-dark border">Score: <?php echo $rev['score']; ?>/5</span>
                            </div>
                            <p class="fw-bold mb-1 small"><?php echo htmlspecialchars($rev['title']); ?></p>
                            <p class="text-muted small mb-0"><?php echo htmlspecialchars($rev['content']); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted small">No reviews yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 rounded-4 sticky-top" style="top: 90px;">
                <h3 class="fw-bold mb-1"><?php echo htmlspecialchars($property['name']); ?></h3>
                <h4 class="text-primary fw-bold mb-4">QR <?php echo number_format($property['price']); ?></h4>

                                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="mb-4 text-center">
                        <form method="POST">
                            <?php if ($is_favorite): ?>
                                <div class="alert alert-success border-0 rounded-4 py-2 small mb-2 shadow-sm">
                                    <i class="bi bi-check-circle-fill me-2"></i> Saved as Favorite
                                </div>
                                <button type="submit" name="remove_favorite" class="btn btn-link text-danger text-decoration-none small p-0 hover-opacity">
                                    <i class="bi bi-trash3 me-1"></i> Remove from Favorites
                                </button>
                            <?php else: ?>
                                <button type="submit" name="save_favorite" class="btn btn-outline-danger w-100 rounded-pill py-2 shadow-sm">
                                    <i class="bi bi-heart me-2"></i> Save to Favorites
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endif; ?>
                
                <div class="d-grid gap-2 mb-4">
                    <a href="https://wa.me/97400000000" class="btn btn-dark rounded-pill py-2">
                        <i class="bi bi-whatsapp me-2"></i>Contact Agent
                    </a>
                </div>

                <hr>

                <?php if ($user_id): ?>
                    <h6 class="fw-bold mb-3">Write a Review</h6>
                    <form method="POST">
                        <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
                        <select name="score" class="form-select mb-2" required>
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                        </select>
                        <textarea name="content" class="form-control mb-3" rows="3" placeholder="Your review..." required></textarea>
                        <button type="submit" name="submit_review" class="btn btn-primary w-100 rounded-pill btn-sm">Post Review</button>
                    </form>
                <?php else: ?>
                    <p class="small text-center text-muted">Please <a href="login.php">Login</a> to review.</p>
                <?php endif; ?>
                <?php echo $message; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>