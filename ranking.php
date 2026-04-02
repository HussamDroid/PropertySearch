<?php
include 'header.php'; 

// Fetch properties - ordered by score as default for a "Ranking" page
$query = "SELECT * FROM properties ORDER BY recommendation_score DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Property Rankings</h1>
        <p class="text-muted">Explore our highest-rated real estate listings in Qatar.</p>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="ps-4 py-3">Property Name</th>
                        <th class="py-3">Type</th>
                        <th class="py-3">Price (QR)</th> <th class="py-3">Location</th>
                        <th class="py-3 text-center">Score</th> <th class="pe-4 py-3 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-dark"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><span class="badge bg-light text-primary border border-primary-subtle"><?php echo htmlspecialchars($row['type']); ?></span></td>
                        <td class="fw-semibold">QR <?php echo number_format($row['price']); ?></td>
                        <td><i class="bi bi-geo-alt text-muted me-1"></i><?php echo htmlspecialchars($row['location']); ?></td>
                        <td class="text-center">
                            <span class="fw-bold text-primary fs-5"><?php echo $row['recommendation_score']; ?></span><span class="text-muted small">/10</span>
                        </td>
                        <td class="pe-4 text-end">
                            <a href="property.php?id=<?php echo $row['property_id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                View Details
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>