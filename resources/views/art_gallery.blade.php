@extends('layouts.app')

@section('title', 'Art Gallery - UKM Kanvas')

@section('content')
<div class="art-gallery-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">ART GALLERY</h1>
                <p class="page-subtitle text-white fs-5 mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="100">
                    Eksplorasi karya-karya luar biasa dari talenta terbaik Kanvas
                </p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="filter-buttons d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up">
                    <button class="btn btn-filter active" data-filter="all">Semua</button>
                    <button class="btn btn-filter" data-filter="digital">Digital Art</button>
                    <button class="btn btn-filter" data-filter="traditional">Traditional</button>
                    <button class="btn btn-filter" data-filter="photography">Photography</button>
                    <button class="btn btn-filter" data-filter="3d">3D Art</button>
                    <button class="btn btn-filter" data-filter="illustration">Illustration</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="container pb-5">
        <div class="row g-4 gallery-grid">
            <!-- Artwork 1 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="digital" data-aos="fade-up">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art1.jpg') }}" 
                             alt="Digital Portrait" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Digital Portrait</h4>
                                <p class="text-white-50 mb-3">By: Sarah Johnson</p>
                                <button class="btn btn-sm btn-gradient" data-bs-toggle="modal" data-bs-target="#artModal1">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 2 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="traditional" data-aos="fade-up" data-aos-delay="100">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art2.jpg') }}" 
                             alt="Watercolor Landscape" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Watercolor Landscape</h4>
                                <p class="text-white-50 mb-3">By: Michael Chen</p>
                                <button class="btn btn-sm btn-gradient" data-bs-toggle="modal" data-bs-target="#artModal2">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 3 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="photography" data-aos="fade-up" data-aos-delay="200">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art3.jpg') }}" 
                             alt="Urban Photography" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Urban Photography</h4>
                                <p class="text-white-50 mb-3">By: Emma Davis</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 4 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="3d" data-aos="fade-up">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art4.jpg') }}" 
                             alt="3D Character Design" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">3D Character Design</h4>
                                <p class="text-white-50 mb-3">By: Alex Rodriguez</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 5 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="illustration" data-aos="fade-up" data-aos-delay="100">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art5.jpg') }}" 
                             alt="Fantasy Illustration" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Fantasy Illustration</h4>
                                <p class="text-white-50 mb-3">By: Lisa Wang</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 6 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="digital" data-aos="fade-up" data-aos-delay="200">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art6.jpg') }}" 
                             alt="Concept Art" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Concept Art</h4>
                                <p class="text-white-50 mb-3">By: David Kim</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 7 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="traditional" data-aos="fade-up">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art7.jpg') }}" 
                             alt="Oil Painting" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Oil Painting</h4>
                                <p class="text-white-50 mb-3">By: Anna Martinez</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 8 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="photography" data-aos="fade-up" data-aos-delay="100">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art8.jpg') }}" 
                             alt="Nature Photography" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Nature Photography</h4>
                                <p class="text-white-50 mb-3">By: James Wilson</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artwork 9 -->
            <div class="col-lg-4 col-md-6 gallery-item" data-category="illustration" data-aos="fade-up" data-aos-delay="200">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset('images/gallery/art9.jpg') }}" 
                             alt="Comic Illustration" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">Comic Illustration</h4>
                                <p class="text-white-50 mb-3">By: Tom Anderson</p>
                                <button class="btn btn-sm btn-gradient">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Artwork Detail Modal Example -->
<div class="modal fade" id="artModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content glass-card border-0">
            <div class="modal-header border-0">
                <h3 class="modal-title text-white fw-bold">Digital Portrait</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <img src="{{ asset('images/gallery/art1.jpg') }}" 
                             alt="Digital Portrait" 
                             class="w-100 rounded-3">
                    </div>
                    <div class="col-lg-4">
                        <div class="artwork-details text-white mt-3 mt-lg-0">
                            <h5 class="text-warning mb-3">Informasi Karya</h5>
                            
                            <div class="mb-3">
                                <p class="text-white-50 mb-1">Artist</p>
                                <p class="fw-bold">Sarah Johnson</p>
                            </div>

                            <div class="mb-3">
                                <p class="text-white-50 mb-1">Medium</p>
                                <p class="fw-bold">Digital Art (Procreate)</p>
                            </div>

                            <div class="mb-3">
                                <p class="text-white-50 mb-1">Year</p>
                                <p class="fw-bold">2024</p>
                            </div>

                            <div class="mb-3">
                                <p class="text-white-50 mb-1">Category</p>
                                <p class="fw-bold">Portrait</p>
                            </div>

                            <h5 class="text-warning mb-3 mt-4">Deskripsi</h5>
                            <p class="text-white-50">
                                Karya ini menggambarkan eksplorasi emosi manusia melalui warna dan 
                                komposisi. Dibuat menggunakan teknik digital painting dengan fokus 
                                pada pencahayaan dramatis dan detail wajah.
                            </p>

                            <div class="social-share mt-4">
                                <h6 class="text-warning mb-3">Share</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-facebook"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-twitter"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-instagram"></i>
                                    </button>
                                    <button class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-link-45deg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.art-gallery-page {
    min-height: 100vh;
    background-image: url('{{ asset("images/bg1.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
}

.art-gallery-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, 
        rgba(255, 236, 119, 0.85) 0%, 
        rgba(255, 217, 107, 0.85) 15%,
        rgba(255, 192, 95, 0.85) 25%,
        rgba(232, 160, 85, 0.85) 35%,
        rgba(199, 130, 78, 0.85) 45%,
        rgba(143, 72, 152, 0.85) 60%,
        rgba(106, 53, 116, 0.85) 75%,
        rgba(71, 35, 96, 0.85) 85%,
        rgba(42, 10, 86, 0.9) 100%);
    z-index: 0;
}

.art-gallery-page > * {
    position: relative;
    z-index: 1;
}

.page-title {
    letter-spacing: 5px;
    line-height: 1.1;
    color: #ddd;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
    -webkit-text-stroke: 1px rgba(255, 255, 255, 0.8);
}

/* Override text-white-50 to be lighter */
.text-white-50 {
    color: rgba(255, 255, 255, 0.85) !important;
}

.btn-filter {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid transparent;
    color: #fff;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-filter:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 236, 119, 0.5);
    color: #FFEC77;
    transform: translateY(-2px);
}

.btn-filter.active {
    background: linear-gradient(135deg, #FFEC77 0%, #F8B803 100%);
    color: #1b1b18;
    font-weight: 600;
}

.artwork-card {
    height: 350px;
    overflow: hidden;
    border-radius: 1rem;
    transition: all 0.3s ease;
}

.artwork-image-container {
    position: relative;
    height: 100%;
    overflow: hidden;
}

.artwork-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.artwork-card:hover .artwork-image {
    transform: scale(1.1);
}

.artwork-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(42, 10, 86, 0.95) 0%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 2rem;
}

.artwork-card:hover .artwork-overlay {
    opacity: 1;
}

.artwork-info {
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.artwork-card:hover .artwork-info {
    transform: translateY(0);
}

.gallery-item {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.gallery-item.hidden {
    opacity: 0;
    transform: scale(0.8);
    position: absolute;
    pointer-events: none;
}

@media (max-width: 767px) {
    .artwork-card {
        height: 300px;
    }
    
    .filter-buttons {
        overflow-x: auto;
        flex-wrap: nowrap !important;
        -webkit-overflow-scrolling: touch;
    }
    
    .btn-filter {
        white-space: nowrap;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.btn-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
});
</script>
@endsection