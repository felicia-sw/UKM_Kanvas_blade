<footer class="mt-5" style="background: rgba(0,0,0,0.45);">
    <div class="container-fluid px-5 pt-5 pb-4">
        <div class="glass-card rounded-4 p-4 p-md-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <h5 class="text-white fw-bold mb-3">{{ config('app.name', 'UKM Kanvas') }}</h5>
                    <p class="text-white-50 mb-0">Celebrating creativity and artistic expression in our university
                        community.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="text-white fw-semibold mb-3">Quick Links</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ route('home') }}#about"
                                class="link-light text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#events"
                                class="link-light text-decoration-none">Events</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#gallery"
                                class="link-light text-decoration-none">Gallery</a></li>
                        <li class="mb-0"><a href="{{ route('home') }}#contact"
                                class="link-light text-decoration-none">Join Us</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="text-white fw-semibold mb-3">Contact</h6>
                    <ul class="list-unstyled text-white-50 mb-0">
                        <li class="mb-2"><i class="bi bi-envelope me-2 text-warning"></i> ukm.kanvas@university.edu
                        </li>
                        <li class="mb-2"><i class="bi bi-telephone me-2 text-warning"></i> +60 12-345 6789</li>
                        <li class="mb-0"><i class="bi bi-geo-alt me-2 text-warning"></i> University Campus</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="text-white fw-semibold mb-3">Follow Us</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3"><i
                                class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-white-25 my-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <small class="text-white-50">© {{ date('Y') }} {{ config('app.name', 'UKM Kanvas') }}. All rights
                    reserved.</small>
                <div class="d-flex gap-3 mt-2 mt-md-0">
                    <a href="#" class="link-light text-decoration-none small">Privacy</a>
                    <a href="#" class="link-light text-decoration-none small">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>
