<footer class="footer-section mt-5 py-5" style="background: rgba(42, 10, 86, 0.95); backdrop-filter: blur(10px);">
    <div class="container">
        <div class="row g-4">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6">
                <h4 class="text-white fw-bold mb-4">
                    <span class="brand-gradient">UKM KANVAS</span>
                </h4>
                <p class="text-white-50 mb-4">
                    Unit Kegiatan Mahasiswa yang berfokus pada pengembangan kreativitas seni dan desain. 
                    Mari bergabung dan wujudkan potensi seni Anda bersama kami.
                </p>
                <div class="social-links d-flex gap-3">
                    <a href="#" class="social-icon" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-icon" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-icon" title="Twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-icon" title="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="social-icon" title="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white fw-bold mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('event') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Events
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('art_gallery') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Art Gallery
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>About Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Resources -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white fw-bold mb-4">Resources</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Kanvas Rules
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Weekly Materials
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Documentation
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>Registration
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="footer-link">
                            <i class="bi bi-chevron-right me-2"></i>FAQ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white fw-bold mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt text-warning me-3 fs-5"></i>
                        <span class="text-white-50">
                            Kampus Universitas<br>
                            Surabaya, Jawa Timur
                        </span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope text-warning me-3 fs-5"></i>
                        <a href="mailto:info@ukmkanvas.com" class="text-white-50 text-decoration-none">
                            info@ukmkanvas.com
                        </a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-telephone text-warning me-3 fs-5"></i>
                        <a href="tel:+6281234567890" class="text-white-50 text-decoration-none">
                            +62 812-3456-7890
                        </a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-clock text-warning me-3 fs-5"></i>
                        <span class="text-white-50">
                            Mon - Fri: 09:00 - 17:00
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-4 border-secondary opacity-25">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="text-white-50 mb-0">
                    &copy; {{ date('Y') }} UKM Kanvas. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="text-white-50 mb-0">
                    Made with <i class="bi bi-heart-fill text-danger"></i> by Kanvas Team
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.brand-gradient {
    background: linear-gradient(135deg, #FFEC77 0%, #F8B803 50%, #FF750F 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-link {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.footer-link:hover {
    color: #FFEC77;
    transform: translateX(5px);
}

.social-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: #fff;
    font-size: 20px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon:hover {
    background: linear-gradient(135deg, #FFEC77 0%, #F8B803 100%);
    color: #1b1b18;
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(255, 236, 119, 0.4);
}
</style>