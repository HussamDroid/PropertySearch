<?php
include 'header.php';

// Logic for Search Filters
$location = mysqli_real_escape_string($conn, $_GET['location'] ?? '');
$type = mysqli_real_escape_string($conn, $_GET['type'] ?? '');

$query = "SELECT * FROM properties WHERE 1=1";
if ($location) $query .= " AND location LIKE '%$location%'";
if ($type) $query .= " AND type = '$type'";
$query .= " LIMIT 3"; 

$result = mysqli_query($conn, $query);
?>

<section class="hero-section position-relative text-white d-flex align-items-center" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.3)), url('assets/images/hero-bg.jpg') center/cover; min-height: 500px;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3">Find Your Dream Home in Qatar</h1>
        <p class="lead mb-5 opacity-75">Discover premium villas, apartments, and penthouses.</p>
        
        <div class="search-box p-3 shadow-lg rounded-4 mx-auto" style="max-width: 900px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
            <form action="index.php" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-geo-alt text-primary"></i></span>
                        <input type="text" name="location" class="form-control border-0" placeholder="City or Area..." value="<?php echo htmlspecialchars($location); ?>">
                    </div>
                </div>
                <div class="col-md-4 border-start">
                    <select name="type" class="form-select border-0">
                        <option value="">All Property Types</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Villa">Villa</option>
                        <option value="Penthouse">Penthouse</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3">Search Now</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php if (isset($_SESSION['user_id'])): ?>
    <?php
    $u_id = $_SESSION['user_id'];
    $user_query = "SELECT preferred_property FROM users WHERE user_id = $u_id";
    $user_res = mysqli_query($conn, $user_query);
    $user_data = mysqli_fetch_assoc($user_res);
    $fav_name = $user_data['preferred_property'] ?? '';

    if (!empty($fav_name)): 
        // Fetch details using LIKE to ensure a match even with spacing issues
        $fav_query = "SELECT * FROM properties WHERE name LIKE '%$fav_name%' LIMIT 1";
        $fav_result = mysqli_query($conn, $fav_query);
        
        if ($fav_result && mysqli_num_rows($fav_result) > 0):
            $fav_prop = mysqli_fetch_assoc($fav_result);
    ?>
    <section class="py-5 bg-white border-bottom">
        <div class="container">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-danger-subtle p-2 rounded-3 me-3">
                    <i class="bi bi-heart-fill text-danger fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold mb-0">Your Saved Property</h3>
                    <p class="text-muted small mb-0">Pick up where you left off</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-row" style="border: 1px solid #eee !important;">
                        <img src="assets/images/property<?php echo $fav_prop['property_id']; ?>.jpg" style="width: 180px; object-fit: cover;" alt="Fav" onerror="this.src='assets/images/placeholder.jpg'">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($fav_prop['name']); ?></h5>
                            <p class="text-muted small mb-3"><?php echo htmlspecialchars($fav_prop['location']); ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-primary fw-bold">QR <?php echo number_format($fav_prop['price']); ?></span>
                                <a href="property.php?id=<?php echo $fav_prop['property_id']; ?>" class="btn btn-sm btn-primary rounded-pill px-3">View Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold mb-0">Featured Recommendations</h2>
                <p class="text-muted">Hand-picked properties with high scores</p>
            </div>
            <a href="ranking.php" class="btn btn-outline-primary rounded-pill px-4">View All Rankings</a>
        </div>

        <div class="row g-4">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm property-card rounded-4 overflow-hidden">
                    <div class="position-relative">
                        <img src="assets/images/property<?php echo $row['property_id']; ?>.jpg" class="card-img-top" alt="Property" style="height: 240px; object-fit: cover;" onerror="this.src='assets/images/placeholder.jpg'">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3 py-2 px-3"><?php echo $row['type']; ?></span>
                        <div class="score-badge position-absolute bottom-0 start-0 m-3 bg-white p-2 rounded-3 shadow-sm text-center">
                            <span class="d-block fw-bold text-primary lh-1"><?php echo $row['recommendation_score']; ?></span>
                            <small class="text-muted" style="font-size: 10px;">SCORE</small>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-dark mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($row['location']); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-primary fw-bold mb-0">QR <?php echo number_format($row['price']); ?></h4>
                            <a href="property.php?id=<?php echo $row['property_id']; ?>" class="btn btn-dark btn-sm rounded-pill px-3">Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Explore Popular Areas</h2>
        <div class="row g-4 justify-content-center">
            <?php 
            $area_query = "SELECT location, COUNT(*) as total FROM properties GROUP BY location LIMIT 4";
            $areas = mysqli_query($conn, $area_query);
            while($area = mysqli_fetch_assoc($areas)): 
            ?>
            <div class="col-6 col-md-3">
                <a href="index.php?location=<?php echo urlencode($area['location']); ?>" class="text-decoration-none">
                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm text-center p-4 bg-primary text-white h-100">
                        <i class="bi bi-buildings fs-1 mb-2 d-block"></i>
                        <h5 class="fw-bold mb-0"><?php echo htmlspecialchars($area['location']); ?></h5>
                        <small class="opacity-75"><?php echo $area['total']; ?> Properties</small>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>