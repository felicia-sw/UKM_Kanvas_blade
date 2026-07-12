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
                    Explore extraordinary artworks from Kanvas's finest talents
                </p>
            </div>
        </div>
        <!-- Filter Section -->
        <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="filter-buttons d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up">
                    <button class="btn btn-filter active" data-filter="all">All</button>
                    @foreach($categories as $category)
                    <button class="btn btn-filter" data-filter="{{ strtolower(trim($category->name)) }}">
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
            @php
                $categoryName = $artwork->category ? strtolower(trim($artwork->category->name)) : 'uncategorized';
            @endphp
            <div class="col-lg-4 col-md-6 gallery-item" 
                 data-category="{{ $categoryName }}" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        <img src="{{ $artwork->image_path }}" 
                             alt="{{ $artwork->title }}" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">{{ $artwork->title }}</h4>
                                <p class="text-white-50 mb-3">By: {{ $artwork->artist_name }}</p>
                                <span class="badge bg-info mb-2">{{ $artwork->category->name ?? 'No Category' }}</span>
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

        <!-- Results and Pagination -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bottom-section" data-aos="fade-up">
                    <div class="bottom-card">
                        <!-- Pagination -->
                        @if($artworks->hasPages())
                        <div class="pagination-content">
                            {{ $artworks->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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
                    <img src="{{ $artwork->image_path }}" 
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

<link rel="stylesheet" href="{{ asset('css/pages/art-gallery.css') }}">

<script src="{{ asset('js/pages/art-gallery.js') }}"></script>
@endsection