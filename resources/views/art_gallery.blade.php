@extends('layouts.app')

@section('title', 'Art Gallery - UKM Kanvas')

@section('content')
<div class="art-gallery-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">ART GALLERY</h1>
                <p class="page-subtitle text-white fs-5 mx-auto" data-aos="fade-up" data-aos-delay="100">
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
                    @foreach($categories as $category)
                    <button class="btn btn-filter" data-filter="{{ strtolower($category->name) }}">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="container pb-5">
        <div class="row g-4 gallery-grid">
            @forelse($artworks as $index => $artwork)
            <div class="col-lg-4 col-md-6 gallery-item" 
                 data-category="{{ strtolower($artwork->category->name ?? 'other') }}" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ asset($artwork->image_path) }}" 
                             alt="{{ $artwork->title }}" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">{{ $artwork->title }}</h4>
                                <p class="text-white-50 mb-3">By: {{ $artwork->artist_name }}</p>
                                <button class="btn btn-sm btn-gradient view-details-btn" 
                                        onclick="togglePopup(event, {{ $artwork->id }})">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Small Popup Card -->
                    <div class="artwork-popup" id="popup-{{ $artwork->id }}">
                        <div class="popup-header">
                            <h5 class="text-white fw-bold mb-0">{{ $artwork->title }}</h5>
                            <button class="popup-close" onclick="closePopup({{ $artwork->id }})">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="popup-body">
                            <div class="popup-item">
                                <i class="bi bi-person-circle text-warning me-2"></i>
                                <div>
                                    <small class="text-white-50 d-block">Artist</small>
                                    <span class="text-white">{{ $artwork->artist_name }}</span>
                                </div>
                            </div>
                            <div class="popup-item">
                                <i class="bi bi-tag text-warning me-2"></i>
                                <div>
                                    <small class="text-white-50 d-block">Category</small>
                                    <span class="badge bg-warning text-dark">{{ $artwork->category->name ?? 'Uncategorized' }}</span>
                                </div>
                            </div>
                            <div class="popup-item">
                                <i class="bi bi-calendar text-warning me-2"></i>
                                <div>
                                    <small class="text-white-50 d-block">Created</small>
                                    <span class="text-white">{{ $artwork->created_date->format('M d, Y') }}</span>
                                </div>
                            </div>
                            @if($artwork->description)
                            <div class="popup-item">
                                <i class="bi bi-journal-text text-warning me-2"></i>
                                <div>
                                    <small class="text-white-50 d-block">Description</small>
                                    <p class="text-white-50 small mb-0 popup-description">{{ Str::limit($artwork->description, 120) }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="glass-card p-5">
                    <i class="bi bi-palette fs-1 text-white-50 mb-3 d-block"></i>
                    <h4 class="text-white mb-3">No Artworks Yet</h4>
                    <p class="text-white-50">Check back later for amazing artworks from our talented members!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($artworks->hasPages())
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $artworks->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
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
    background: linear-gradient(to top left,
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
    position: relative;
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

/* Popup Styles */
.artwork-popup {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 320px;
    max-width: 90%;
    background: rgba(42, 10, 86, 0.98);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 236, 119, 0.5);
    border-radius: 1rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    z-index: 100;
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    pointer-events: none;
}

.artwork-popup.active {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
    pointer-events: auto;
}

.popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.popup-close {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.popup-close:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #FFEC77;
}

.popup-body {
    padding: 1rem 1.25rem;
    max-height: 400px;
    overflow-y: auto;
}

.popup-item {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.popup-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.popup-item i {
    font-size: 1.2rem;
    margin-top: 0.25rem;
}

.popup-description {
    line-height: 1.5;
    margin-top: 0.25rem;
}

/* Scrollbar for popup */
.popup-body::-webkit-scrollbar {
    width: 6px;
}

.popup-body::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.popup-body::-webkit-scrollbar-thumb {
    background: rgba(255, 236, 119, 0.5);
    border-radius: 10px;
}

.popup-body::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 236, 119, 0.8);
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

/* Modal Styles */
.modal-content {
    border-radius: 1rem;
}

.artwork-image-wrapper {
    background: rgba(0, 0, 0, 0.3);
}

.artwork-image-wrapper img {
    transition: transform 0.3s ease;
}

.artwork-image-wrapper:hover img {
    transform: scale(1.02);
}

.detail-section {
    border-left: 3px solid rgba(255, 236, 119, 0.5);
    padding-left: 1rem;
    transition: all 0.3s ease;
}

.detail-section:hover {
    border-color: #FFEC77;
    transform: translateX(5px);
}

.modal-footer .btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
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

// Popup functions
function togglePopup(event, artworkId) {
    event.stopPropagation();
    const popup = document.getElementById(`popup-${artworkId}`);
    const allPopups = document.querySelectorAll('.artwork-popup');
    
    // Close all other popups
    allPopups.forEach(p => {
        if (p.id !== `popup-${artworkId}`) {
            p.classList.remove('active');
        }
    });
    
    // Toggle current popup
    popup.classList.toggle('active');
}

function closePopup(artworkId) {
    const popup = document.getElementById(`popup-${artworkId}`);
    popup.classList.remove('active');
}

// Close popup when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.artwork-card') && !event.target.closest('.view-details-btn')) {
        document.querySelectorAll('.artwork-popup').forEach(popup => {
            popup.classList.remove('active');
        });
    }
});

// Share functions
function shareArtwork(platform) {
    const url = window.location.href;
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=Check out this amazing artwork!`;
            break;
        case 'instagram':
            alert('Please share via Instagram app');
            return;
    }
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copied to clipboard!');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
}
</script>
@endsection