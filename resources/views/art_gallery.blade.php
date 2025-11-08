@extends('layouts.app')

@section('title', 'Event Photo Gallery - UKM Kanvas') {{-- New title --}}

@section('content')
<div class="art-gallery-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">EVENT GALLERY</h1> {{-- New heading --}}
                <p class="page-subtitle text-white fs-5 mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="100">
                    Showcasing featured photos from our latest events
                </p>
            </div>
        </div>

        <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                {{-- Filter by Event ID --}}
                <form action="{{ route('art_gallery') }}" method="GET" class="filter-form d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up">
                    <button type="submit" name="event_id" value="" 
                            class="btn btn-filter {{ !request()->filled('event_id') ? 'active' : '' }}" data-filter="all">
                        All Events
                    </button>
                    @foreach($events as $event) {{-- Using $events instead of $categories --}}
                    <button type="submit" name="event_id" value="{{ $event->id }}" 
                            class="btn btn-filter {{ request('event_id') == $event->id ? 'active' : '' }}" >
                        {{ $event->title }}
                    </button>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="row g-4 gallery-grid">
            @forelse($artworks as $index => $documentation) {{-- Rename loop variable --}}
            @php
                $eventName = $documentation->event ? $documentation->event->title : 'No Event';
            @endphp
            <div class="col-lg-4 col-md-6 gallery-item" 
                 data-event="{{ $documentation->event_id }}" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="artwork-card">
                    <div class="artwork-image-container">
                        {{-- Use file_path and title from Documentation --}}
                        <img src="{{ asset($documentation->file_path) }}" 
                             alt="{{ $documentation->title }}" 
                             class="artwork-image">
                        <div class="artwork-overlay">
                            <div class="artwork-info">
                                <h4 class="text-white fw-bold mb-2">{{ $documentation->title }}</h4>
                                {{-- Display Event Title instead of Artist Name --}}
                                <p class="text-white-50 mb-3">Event: {{ $eventName }}</p> 
                                {{-- Display Featured Status --}}
                                <span class="badge bg-warning mb-2">Featured Photo</span>
                                <button class="btn btn-sm btn-gradient view-details-btn" 
                                        onclick="togglePopup(event, {{ $documentation->id }})">
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
                    <i class="bi bi-images fs-1 text-white-50 mb-3 d-block"></i>
                    <h4 class="text-white mb-3">No Featured Event Photos Yet</h4>
                    <p class="text-white-50">Check back later for photos highlighting our events!</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="bottom-section" data-aos="fade-up">
                    <div class="bottom-card">
                        @if($artworks->hasPages())
                        <div class="pagination-content">
                            {{-- Append filter if present --}}
                            {{ $artworks->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($artworks as $documentation) {{-- Rename loop variable --}}
<div class="artwork-modal-overlay" id="popup-{{ $documentation->id }}" onclick="closePopup({{ $documentation->id }})">
    <div class="artwork-modal-container" onclick="event.stopPropagation()">
        <button class="modal-close-btn" onclick="closePopup({{ $documentation->id }})">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <div class="modal-image-box">
                    <img src="{{ asset($documentation->file_path) }}" 
                         alt="{{ $documentation->title }}" 
                         class="modal-artwork-image">
                </div>
            </div>
            
            <div class="col-lg-5">
                <div class="modal-details">
                    <h2 class="text-white fw-bold mb-4">{{ $documentation->title }}</h2>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-calendar-event text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Event</span>
                        </div>
                        <p class="text-white mb-0 ps-4">{{ $documentation->event->title ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-star-fill text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Status</span>
                        </div>
                        <p class="mb-0 ps-4">
                            <span class="badge bg-warning text-dark">Featured Photo</span>
                        </p>
                    </div>
                    
                    <div class="detail-item mb-3">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-upload text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Upload Date</span>
                        </div>
                        <p class="text-white mb-0 ps-4">{{ $documentation->created_at->format('F d, Y') }}</p>
                    </div>
                    
                    @if($documentation->caption)
                    <div class="detail-item">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-journal-text-fill text-warning fs-5"></i>
                            <span class="text-warning fw-semibold">Caption</span>
                        </div>
                        <p class="text-white-50 mb-0 ps-4 lh-lg">{{ $documentation->caption }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- The style and script blocks remain as they are, but the script's filtering logic is now obsolete
    since the filtering is handled by the server-side form submission. --}}
@endsection