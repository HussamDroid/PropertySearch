<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h4 class="fw-bold text-primary mb-3"><i class="bi bi-houses-fill me-2"></i>PropertySearch</h4>
                <p class="text-white-50 small" style="line-height: 1.8;">
                    Qatar's leading property recommendation engine. We use data-driven insights to help you find the perfect home in Doha, Lusail, and beyond.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-white opacity-50 h5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white opacity-50 h5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white opacity-50 h5"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <div class="col-md-2 offset-md-1">
                <h6 class="fw-bold mb-4">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="index.php" class="text-white text-decoration-none opacity-75">Home</a></li>
                    <li class="mb-2"><a href="ranking.php" class="text-white text-decoration-none opacity-75">Rankings</a></li>
                    <li class="mb-2"><a href="overview.php" class="text-white text-decoration-none opacity-75">Overview</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h6 class="fw-bold mb-4">Support</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="faq.php" class="text-white text-decoration-none opacity-75">FAQs</a></li>
                    <li class="mb-2">
                        <a href="mailto:support@propertysearch.qa?subject=Property Inquiry" class="text-white text-decoration-none opacity-75">
                            Contact Us
                        </a>
                    </li>
                    <li class="mb-2"><a href="privacy.php" class="text-white text-decoration-none opacity-75">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h6 class="fw-bold mb-4">Subscribe</h6>
                <p class="small text-white-50 mb-3">Get the latest market updates.</p>
                <form class="input-group mb-3">
                    <input type="email" class="form-control form-control-sm bg-secondary border-0 text-white" placeholder="Email address">
                    <button class="btn btn-primary btn-sm px-3" type="button">Join</button>
                </form>
            </div>
        </div>

        <hr class="my-5 opacity-10">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-light mb-0">&copy; <?php echo date("Y"); ?> PropertySearch Qatar. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small text-light mb-0">Developed for LJMU Computer Science Project</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>