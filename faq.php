<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
                
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary text-white rounded-3 p-3 me-3 shadow-sm">
                        <i class="bi bi-journal-text fs-3"></i>
                    </div>
                    <div>
                        <h1 class="fw-bold mb-0">System Documentation</h1>
                        <p class="text-muted mb-0">Project overview, features, and technical stack</p>
                    </div>
                </div>

                <hr class="mb-5 opacity-25">

                <div class="readme-content">
                    <?php
                    $readme_path = 'README.md';
                    
                    if (file_exists($readme_path)) {
                        // 1. Read the raw text from your README.md
                        $content = file_get_contents($readme_path);
                        
                        // 2. Escape HTML for security
                        $content = htmlspecialchars($content);

                        // 3. CONVERT MARKDOWN TO HTML (THE MAGIC)
                        
                        // Convert # Titles
                        $content = preg_replace('/^# (.*)$/m', '<h2 class="fw-bold text-dark mt-4 border-bottom pb-2">$1</h2>', $content);
                        // Convert ## Subtitles
                        $content = preg_replace('/^## (.*)$/m', '<h3 class="fw-bold text-primary mt-4">$1</h3>', $content);
                        // Convert ### Small Titles
                        $content = preg_replace('/^### (.*)$/m', '<h5 class="fw-bold mt-3 text-secondary">$1</h5>', $content);
                        // Convert **Bold**
                        $content = preg_replace('/\*\*(.*?)\*\*/', '<strong class="text-dark">$1</strong>', $content);
                        // Convert - Bullet points
                        $content = preg_replace('/^- (.*)$/m', '<li class="ms-3 mb-1">$1</li>', $content);
                        
                        // 4. FIX THE GITHUB LINK (Auto-Linker)
                        // This finds your specific GitHub URL and wraps it in an <a> tag
                        $github_url = "https://github.com/HussamDroid/PropertySearch";
                        $content = str_replace($github_url, '<a href="'.$github_url.'" target="_blank" class="text-primary text-decoration-none fw-bold"><i class="bi bi-github me-1"></i>'.$github_url.'</a>', $content);

                        // 5. Display with line breaks preserved
                        echo nl2br($content);

                    } else {
                        // Fallback if the file is missing
                        echo "<div class='alert alert-light border text-center py-5'>";
                        echo "<i class='bi bi-file-earmark-x display-4 text-muted'></i>";
                        echo "<p class='mt-3'>README.md file not found in the root directory.</p>";
                        echo "</div>";
                    }
                    ?>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <p class="text-muted small mb-0">Source: <code>README.md</code> (Last Synced: <?php echo date("F d, Y"); ?>)</p>
                        <a href="index.php" class="btn btn-dark btn-sm rounded-pill px-4">
                            <i class="bi bi-arrow-left me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>