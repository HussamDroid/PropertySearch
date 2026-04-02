<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold"> Overview</h1>
        <p class="lead text-muted">A technical breakdown of the Property Recommendation System.</p>
        <hr class="mx-auto" style="width: 100px; height: 3px; background-color: var(--bs-primary); opacity: 1;">
    </div>

    <div class="row g-5">
        <div class="col-lg-3">
            <div class="sticky-top" style="top: 100px;">
                <h6 class="fw-bold text-uppercase small text-muted mb-3">Sections</h6>
                <nav class="nav flex-column gap-2">
                    <a class="nav-link p-0 small text-dark fw-medium" href="#architecture">1. System Architecture</a>
                    <a class="nav-link p-0 small text-dark fw-medium" href="#technologies">2. Technologies Used</a>
                    <a class="nav-link p-0 small text-dark fw-medium" href="#features">3. Key Features</a>
                    <a class="nav-link p-0 small text-dark fw-medium" href="#database">4. Database Schema</a>
                </nav>
            </div>
        </div>

        <div class="col-lg-9">
            <section id="architecture" class="mb-5">
                <h3 class="fw-bold mb-3"><i class="bi bi-diagram-3 me-2 text-primary"></i>System Architecture</h3>
                <p>This platform follows a <strong>Client-Server architecture</strong>. The client-side is rendered using HTML5 and Bootstrap 5, while the server-side logic is handled by PHP. Data is stored in a MySQL database, managed locally via XAMPP.</p>
                <div class="p-4 bg-light rounded-4 border-start border-4 border-primary">
                    <p class="mb-0 small"><strong>Workflow:</strong> User Request &rarr; Apache Server &rarr; PHP Processing &rarr; MySQL Query &rarr; Dynamic HTML Response.</p>
                </div>
            </section>

            <section id="technologies" class="mb-5">
                <h3 class="fw-bold mb-3"><i class="bi bi-cpu me-2 text-primary"></i>Technologies Used</h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100">
                            <h6 class="fw-bold"><i class="bi bi-code-slash me-2"></i>Frontend</h6>
                            <ul class="small text-muted">
                                <li>HTML5 & CSS3</li>
                                <li>Bootstrap 5.3 (Responsive Grid)</li>
                                <li>Bootstrap Icons</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 h-100">
                            <h6 class="fw-bold"><i class="bi bi-database me-2"></i>Backend</h6>
                            <ul class="small text-muted">
                                <li>PHP 8.x (Server-side Logic)</li>
                                <li>MySQL (Relational Database)</li>
                                <li>XAMPP (Local Development Environment)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section id="features" class="mb-5">
                <h3 class="fw-bold mb-3"><i class="bi bi-star me-2 text-primary"></i>Core Functionalities</h3>
                <div class="list-group list-group-flush">
                    <div class="list-group-item bg-transparent px-0 py-3">
                        <h6 class="fw-bold mb-1">Dynamic Property Search</h6>
                        <p class="small text-muted mb-0">Allows users to filter listings by location and property type using SQL LIKE queries.</p>
                    </div>
                    <div class="list-group-item bg-transparent px-0 py-3">
                        <h6 class="fw-bold mb-1">User Authentication</h6>
                        <p class="small text-muted mb-0">Secure registration and login using PHP sessions and password hashing (password_hash).</p>
                    </div>
                    <div class="list-group-item bg-transparent px-0 py-3">
                        <h6 class="fw-bold mb-1">Ranking System</h6>
                        <p class="small text-muted mb-0">A data-driven view that sorts properties based on editorial recommendation scores.</p>
                    </div>
                </div>
            </section>

            <section id="database">
                <h3 class="fw-bold mb-3"><i class="bi bi-table me-2 text-primary"></i>Database Schema</h3>
                <p>The system utilizes two primary tables: <code>users</code> for profile management and <code>properties</code> for listing data. These tables are linked to provide a personalized user experience.</p>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered small">
                        <thead class="bg-light">
                            <tr>
                                <th>Table</th>
                                <th>Key Columns</th>
                                <th>Purpose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>users</code></td>
                                <td>user_id, username, password, email, dob</td>
                                <td>Stores user credentials and profile data.</td>
                            </tr>
                            <tr>
                                <td><code>properties</code></td>
                                <td>property_id, name, location, price, score</td>
                                <td>Stores property information and rankings.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>