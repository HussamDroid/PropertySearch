<?php
include 'header.php'; 

// 1. Get Property ID from URL
$property_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = "SELECT * FROM properties WHERE property_id = $property_id";
$result = mysqli_query($conn, $query);
$property = mysqli_fetch_assoc($result);

// Redirect if property doesn't exist
if (!$property) {
    header("Location: index.php");
    exit();
}

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
?>

<style>
    .sticky-card {
        top: 100px;
        z-index: 10;
    }
    .amenity-box {
        transition: 0.3s;
        border: 1px solid #eee !important;
    }
    .amenity-box:hover {
        background-color: #f8f9fa !important;
        border-color: #0d6efd !important;
    }
</style>

<div class="container my-5">
    <div class="row g-5">
        
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

            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h1 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($property['name']); ?></h1>
                    <p class="text-muted fs-5"><i class="bi bi-geo-alt text-primary me-2"></i><?php echo htmlspecialchars($property['location']); ?></p>
                </div>
                <div class="text-end">
                    <h2 class="text-primary fw-bold mb-0">QR <?php echo number_format($property['price']); ?></h2>
                    <span class="badge bg-success px-3 py-2 mt-2 shadow-sm">Score: <?php echo $property['recommendation_score']; ?>/10</span>
                </div>
            </div>

            <hr class="my-4 opacity-25">

            <h4 class="fw-bold mb-4">Property Features</h4>
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3 text-center">
                    <div class="p-3 rounded-4 bg-white shadow-sm amenity-box">
                        <i class="bi bi-door-open fs-3 text-primary"></i>
                        <p class="small fw-bold mb-0 mt-2">3 Bedrooms</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="p-3 rounded-4 bg-white shadow-sm amenity-box">
                        <i class="bi bi-droplet fs-3 text-primary"></i>
                        <p class="small fw-bold mb-0 mt-2">2 Bathrooms</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="p-3 rounded-4 bg-white shadow-sm amenity-box">
                        <i class="bi bi-p-circle fs-3 text-primary"></i>
                        <p class="small fw-bold mb-0 mt-2">Parking Space</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <div class="p-3 rounded-4 bg-white shadow-sm amenity-box">
                        <i class="bi bi-wind fs-3 text-primary"></i>
                        <p class="small fw-bold mb-0 mt-2">Central AC</p>
                    </div>
                </div>
            </div>

            <h4 class="fw-bold mb-3">Detailed Description</h4>
            <p class="text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                This premium <?php echo strtolower($property['type']); ?> located in the heart of <?php echo htmlspecialchars($property['location']); ?> 
                offers a blend of luxury and comfort. Designed for modern living, the property features high-end appliances, 
                spacious layouts, and access to premium community amenities.
            </p>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 p-4 sticky-top sticky-card">
                
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

                <h5 class="fw-bold mb-3">Contact Property Agent</h5>
                <form>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 fw-bold">Full Name</label>
                        <input type="text" class="form-control bg-light border-0 py-2" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 fw-bold">Email Address</label>
                        <input type="email" class="form-control bg-light border-0 py-2" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted mb-1 fw-bold">Message</label>
                        <textarea class="form-control bg-light border-0" rows="4" placeholder="I would like to inquire about..."></textarea>
                    </div>
                    <button type="button" class="btn btn-primary w-100 py-2 fw-bold rounded-pill shadow-sm">
                        Send Inquiry
                    </button>
                </form>
            </div> </div> </div> </div> <?php include 'footer.php'; ?>