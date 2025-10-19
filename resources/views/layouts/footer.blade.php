<footer class="footer-section mt-5 py-5" style="background: rgba(42, 10, 86, 0.9); backdrop-filter: blur(12px); border-top: 1px solid rgba(255, 255, 255, 0.1);">
    <div class="container">
        <div class="row g-5">
            <!-- About -->
            <div class="col-lg-4 col-md-6">
                <h4 class="fw-bold mb-3 text-gradient">UKM KANVAS</h4>
                <p class="text-white-50 mb-4">
                    Unit Kegiatan Mahasiswa yang berfokus pada pengembangan kreativitas seni dan desain. 
                    Bergabunglah dan wujudkan potensi seni Anda bersama kami.
                </p>
                <div class="social-links d-flex gap-3">
                    <a href="https://www.instagram.com/uc_kanvas?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" 
                       target="_blank" rel="noopener noreferrer" 
                       class="social-icon instagram" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="mailto:ukm.kanvas@ciputra.ac.id" 
                       class="social-icon gmail" title="Email">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                    <a href="https://wa.me/6281337241083" 
                       target="_blank" rel="noopener noreferrer" 
                       class="social-icon whatsapp" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5 class="text-white fw-bold mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="footer-link"><i class="bi bi-chevron-right me-2"></i>Home</a></li>
                    <li><a href="{{ route('events') }}" class="footer-link"><i class="bi bi-chevron-right me-2"></i>Events</a></li>
                    <li><a href="{{ route('art_gallery') }}" class="footer-link"><i class="bi bi-chevron-right me-2"></i>Art Gallery</a></li>
                    <li><a href="{{ route('about') }}" class="footer-link"><i class="bi bi-chevron-right me-2"></i>About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link"><i class="bi bi-chevron-right me-2"></i>Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-4 col-md-6 ms-auto">
                <h5 class="text-white fw-bold mb-4">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt text-warning me-3 fs-5"></i>
                        <span class="text-white-50">CitraLand CBD Boulevard, Made, Kec. Sambikerep, Surabaya, Jawa Timur 60219</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope text-warning me-3 fs-5"></i>
                        <a href="mailto:ukm.kanvas@ciputra.ac.id" class="footer-contact">ukm.kanvas@ciputra.ac.id</a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-telephone text-warning me-3 fs-5"></i>
                        <a href="tel:+6281337241083" class="footer-contact">+62 813-3724-1083</a>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-clock text-warning me-3 fs-5"></i>
                        <span class="text-white-50">Tuesday, 17:00 - 19:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-4 border-light opacity-25">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="text-white-50 mb-0">&copy; {{ date('Y') }} UKM Kanvas. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="text-white-50 mb-0">
                    Made with <i class="bi bi-heart-fill text-danger"></i> by <span class="text-warning">Kanvas Team</span>
                </p>
            </div>
        </div>
    </div>
</footer>
