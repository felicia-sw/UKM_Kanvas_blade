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
        <div class="container mb-4">
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
            <div class="col-12">
                <div class="pagination-wrapper" data-aos="fade-up">
                    <div class="pagination-container">
                        {{ $artworks->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal-style Popup for Artwork Details -->
@foreach($artworks as $artwork)
<div class="artwork-modal-overlay" id="popup-{{ $artwork->id }}" onclick="closePopup({{ $artwork->id }})">
    <div class="artwork-modal-container" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button class="modal-close-btn" onclick="closePopup({{ $artwork->id }})">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="row g-4 align-items-center">
            <!-- Image Box -->
            <div class="col-lg-7">
                <div class="modal-image-box">
                    <img src="{{ asset($artwork->image_path) }}" 
                         alt="{{ $artwork->title }}" 
                         class="modal-artwork-image">
                </div>
            </div>
            
            <!-- Description Outside Box -->
            <div class="col-lg-5">
                <div class="modal-details">
                    <h2 class="text-white fw-bold mb-4">{{ $artwork->title }}</h2>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-person-circle text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Artist</span>
                        </div>
                        <p class="text-white mb-0 ps-4">{{ $artwork->artist_name }}</p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-tag-fill text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Category</span>
                        </div>
                        <p class="mb-0 ps-4">
                            <span class="badge bg-warning text-dark">{{ $artwork->category->name ?? 'Uncategorized' }}</span>
                        </p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-calendar-fill text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Created Date</span>
                        </div>
                        <p class="text-white mb-0 ps-4">{{ $artwork->created_date->format('F d, Y') }}</p>
                    </div>
                    
                    @if($artwork->description)
                    <div class="detail-item">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-journal-text-fill text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Description</span>
                        </div>
                        <p class="text-white-50 mb-0 ps-4 lh-lg">{{ $artwork->description }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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

/* Consistent Text Styling */
.text-white-50 {
    color: rgba(255, 255, 255, 0.85) !important;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.9) !important;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

/* Consistent artwork text */
.artwork-info h4,
.artwork-info .text-white {
    color: #ffffff !important;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.artwork-info .text-white-50 {
    color: rgba(255, 255, 255, 0.85) !important;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

/* Modal text consistency */
.modal-details .text-white {
    color: #ffffff !important;
}

.modal-details .text-white-50 {
    color: rgba(255, 255, 255, 0.85) !important;
}

.modal-details .text-warning {
    color: #FFEC77 !important;
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

/* Modal-style Popup */
.artwork-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.artwork-modal-overlay.active {
    display: flex;
    opacity: 1;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.artwork-modal-container {
    background: rgba(42, 10, 86, 0.95);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 236, 119, 0.3);
    border-radius: 1.5rem;
    padding: 2.5rem;
    max-width: 1200px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideUp 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
}

@keyframes slideUp {
    from {
        transform: translateY(100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-close-btn {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.2);
    color: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.modal-close-btn:hover {
    background: rgba(255, 236, 119, 0.2);
    border-color: #FFEC77;
    color: #FFEC77;
    transform: rotate(90deg);
}

.modal-image-box {
    background: rgba(0, 0, 0, 0.3);
    border: 3px solid rgba(255, 236, 119, 0.4);
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
    transition: all 0.3s ease;
}

.modal-image-box:hover {
    border-color: rgba(255, 236, 119, 0.7);
    box-shadow: 0 20px 45px rgba(255, 236, 119, 0.2);
}

.modal-artwork-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

.modal-details {
    padding: 1rem;
}

.detail-item {
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0.75rem;
    border-left: 3px solid rgba(255, 236, 119, 0.5);
    transition: all 0.3s ease;
}

.detail-item:hover {
    background: rgba(255, 255, 255, 0.08);
    border-left-color: #FFEC77;
    transform: translateX(5px);
}

/* Scrollbar for modal */
.artwork-modal-container::-webkit-scrollbar {
    width: 8px;
}

.artwork-modal-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
}

.artwork-modal-container::-webkit-scrollbar-thumb {
    background: rgba(255, 236, 119, 0.5);
    border-radius: 10px;
}

.artwork-modal-container::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 236, 119, 0.8);
}

/* Responsive */
@media (max-width: 991px) {
    .artwork-modal-container {
        padding: 2rem 1.5rem;
    }
    
    .modal-details {
        margin-top: 1rem;
    }
}

@media (max-width: 767px) {
    .artwork-modal-overlay {
        padding: 1rem;
    }
    
    .artwork-modal-container {
        padding: 1.5rem 1rem;
    }
    
    .modal-close-btn {
        width: 40px;
        height: 40px;
        top: 1rem;
        right: 1rem;
    }
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

/* Results Display Styling */
.results-info-card {
    background: linear-gradient(135deg, rgba(42, 10, 86, 0.8) 0%, rgba(68, 30, 126, 0.8) 100%);
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255, 236, 119, 0.3);
    border-radius: 1.25rem;
    padding: 1.5rem 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.results-info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 236, 119, 0.2);
    border-color: rgba(255, 236, 119, 0.5);
}

.results-content-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1.25rem;
    flex-wrap: wrap;
}

.results-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #FFEC77 0%, #FF750F 100%);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2A0A56;
    font-size: 1.5rem;
    box-shadow: 0 5px 15px rgba(255, 236, 119, 0.3);
}

.results-text-wrapper {
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.results-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.1rem;
    font-weight: 500;
}

.results-number {
    color: #FFEC77;
    font-size: 1.75rem;
    font-weight: 700;
    text-shadow: 0 2px 8px rgba(255, 236, 119, 0.4);
}

.results-category-badge {
    padding: 0.5rem 1.25rem;
    background: rgba(255, 236, 119, 0.15);
    border: 2px solid rgba(255, 236, 119, 0.3);
    border-radius: 50px;
    color: #FFEC77;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.results-category-badge:hover {
    background: rgba(255, 236, 119, 0.25);
    border-color: rgba(255, 236, 119, 0.5);
}

/* Pagination Styling */
.pagination-wrapper {
    display: flex;
    justify-content: center;
}

.pagination-container {
    background: linear-gradient(135deg, rgba(42, 10, 86, 0.8) 0%, rgba(68, 30, 126, 0.8) 100%);
    backdrop-filter: blur(15px);
    border: 2px solid rgba(255, 236, 119, 0.3);
    border-radius: 1.25rem;
    padding: 1.25rem 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* Override Bootstrap Pagination Styles */
.pagination-container .pagination {
    margin: 0;
    gap: 0.5rem;
}

.pagination-container .page-item .page-link {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 236, 119, 0.2);
    color: #fff;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    min-width: 45px;
    text-align: center;
}

.pagination-container .page-item .page-link:hover {
    background: rgba(255, 236, 119, 0.2);
    border-color: rgba(255, 236, 119, 0.5);
    color: #FFEC77;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 236, 119, 0.2);
}

.pagination-container .page-item.active .page-link {
    background: linear-gradient(135deg, #FFEC77 0%, #FF750F 100%);
    border-color: #FFEC77;
    color: #2A0A56;
    box-shadow: 0 5px 20px rgba(255, 236, 119, 0.4);
}

.pagination-container .page-item.disabled .page-link {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.3);
    cursor: not-allowed;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .results-info-card {
        padding: 1.25rem 1.5rem;
    }
    
    .results-content-wrapper {
        gap: 1rem;
    }
    
    .results-icon {
        width: 45px;
        height: 45px;
        font-size: 1.3rem;
    }
    
    .results-number {
        font-size: 1.5rem;
    }
    
    .results-label {
        font-size: 1rem;
    }
    
    .pagination-container {
        padding: 1rem 1.5rem;
    }
}

@media (max-width: 767px) {
    .results-info-card {
        padding: 1rem 1.25rem;
    }
    
    .results-content-wrapper {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .results-text-wrapper {
        flex-direction: column;
        text-align: center;
        gap: 0.25rem;
    }
    
    .results-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
    
    .results-number {
        font-size: 1.4rem;
    }
    
    .results-label {
        font-size: 0.95rem;
    }
    
    .results-category-badge {
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
    }
    
    .pagination-container {
        padding: 1rem;
    }
    
    .pagination-container .page-item .page-link {
        padding: 0.4rem 0.75rem;
        font-size: 0.9rem;
        min-width: 40px;
    }
}

@media (max-width: 575px) {
    .pagination-container .pagination {
        gap: 0.25rem;
    }
    
    .pagination-container .page-item .page-link {
        padding: 0.35rem 0.6rem;
        font-size: 0.85rem;
        min-width: 35px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.btn-filter');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const visibleCountElement = document.getElementById('visibleCount');
    const categoryLabelElement = document.getElementById('categoryLabel');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            const categoryName = this.textContent.trim();
            let visibleCount = 0;
            
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });
            
            // Update visible count with animation
            visibleCountElement.style.transform = 'scale(1.2)';
            visibleCountElement.style.color = '#FF750F';
            setTimeout(() => {
                visibleCountElement.textContent = visibleCount;
                visibleCountElement.style.transform = 'scale(1)';
                visibleCountElement.style.color = '#FFEC77';
            }, 150);
            
            // Update category label
            const displayName = filter === 'all' ? 'All Categories' : categoryName;
            categoryLabelElement.style.transform = 'scale(1.1)';
            setTimeout(() => {
                categoryLabelElement.textContent = displayName;
                categoryLabelElement.style.transform = 'scale(1)';
            }, 150);
        });
    });
});

// Modal popup functions
function togglePopup(event, artworkId) {
    event.stopPropagation();
    const modal = document.getElementById(`popup-${artworkId}`);
    
    // Close all other modals
    document.querySelectorAll('.artwork-modal-overlay').forEach(m => {
        m.classList.remove('active');
    });
    
    // Open current modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closePopup(artworkId) {
    const modal = document.getElementById(`popup-${artworkId}`);
    modal.classList.remove('active');
    document.body.style.overflow = ''; // Restore scrolling
}

// Close modal when pressing ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.artwork-modal-overlay').forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
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