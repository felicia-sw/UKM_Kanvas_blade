@extends('layouts.app')

@section('title', $event->title . ' - Documentation')

@section('content')
<div class="documentation-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">{{ $event->title }}</h1>
                <p class="page-subtitle text-white fs-5 mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
                    {{ $event->description }}
                </p>
                <div class="mt-3" data-aos="fade-up" data-aos-delay="200">
                    <span class="badge text-dark fs-6 px-3 py-2" style="background: linear-gradient(135deg, #FFEC77, #F8B803);">
                        <i class="bi bi-calendar-event me-2"></i>{{ date('d M Y', strtotime($event->start_date)) }}
                    </span>
                    @if($event->location)
                    <span class="badge text-dark fs-6 px-3 py-2 ms-2" style="background: linear-gradient(135deg, #FFEC77, #F8B803);">
                        <i class="bi bi-geo-alt me-2"></i>{{ $event->location }}
                    </span>
                    @endif
                </div>
                <div class="mt-4">
                    <a href="{{ route('events', ['filter' => 'past']) }}" class="btn btn-lg px-4" 
                       data-aos="fade-up" 
                       data-aos-delay="300"
                       style="background-color: #FFEC77 !important; color: #1a1a2e !important; border: 2px solid #F8B803 !important; font-weight: bold !important; opacity: 1 !important; z-index: 1000 !important; position: relative !important; transition: all 0.3s ease !important;">
                        <i class="bi bi-arrow-left me-2"></i>Back to Events
                    </a>
                </div>
            </div>
        </div>

        <!-- Documentation Gallery Grid -->
        <div class="container pb-5">
            <div class="row g-4 gallery-grid">
                @forelse($event->documentations as $index => $documentation)
                <div class="col-lg-4 col-md-6 gallery-item" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="documentation-card">
                        <div class="documentation-image-container">
                            <img src="{{ asset($documentation->image_path) }}" 
                                 alt="{{ $documentation->title }}" 
                                 class="documentation-image">
                            <div class="documentation-overlay">
                                <div class="documentation-info">
                                    <h4 class="text-white fw-bold mb-2">{{ $documentation->title }}</h4>
                                    <button class="btn btn-sm btn-gradient view-details-btn" 
                                            onclick="togglePopup(event, {{ $documentation->id }})">
                                        <i class="bi bi-eye me-2"></i>View Full Size
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
                        <h4 class="text-white mb-3">No Documentation Yet</h4>
                        <p class="text-white-50">Documentation for this event will be uploaded soon!</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal-style Popup for Documentation Details -->
@foreach($event->documentations as $documentation)
<div class="documentation-modal-overlay" id="popup-{{ $documentation->id }}" onclick="closePopup({{ $documentation->id }})">
    <div class="documentation-modal-container" onclick="event.stopPropagation()">
        <!-- Close Button -->
        <button class="modal-close-btn" onclick="closePopup({{ $documentation->id }})">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="row g-0 h-100">
            <!-- Image Column -->
            <div class="col-lg-8 d-flex align-items-center justify-content-center p-4">
                <img src="{{ asset($documentation->image_path) }}" 
                     alt="{{ $documentation->title }}" 
                     class="modal-image">
            </div>
            
            <!-- Details Column -->
            <div class="col-lg-4 p-4 modal-details">
                <h2 class="text-white fw-bold mb-4">{{ $documentation->title }}</h2>
                
                <div class="mb-4">
                    <h5 class="text-accent mb-2"><i class="bi bi-calendar-event me-2"></i>Event</h5>
                    <p class="text-white-50">{{ $event->title }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-accent mb-2"><i class="bi bi-clock me-2"></i>Event Date</h5>
                    <p class="text-white-50">{{ date('d M Y', strtotime($event->start_date)) }}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-accent mb-2"><i class="bi bi-upload me-2"></i>Upload Date</h5>
                    <p class="text-white-50">{{ $documentation->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
body {
    background: #2A0A56 !important;
}

.documentation-page {
    background-image: url('{{ asset("images/bg1.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.documentation-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, 
        rgba(42, 10, 86, 0.95) 0%, 
        rgba(42, 10, 86, 0.85) 50%, 
        rgba(42, 10, 86, 0.95) 100%);
    pointer-events: none;
}

.page-title {
    letter-spacing: 5px;
    line-height: 1.1;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
}

.page-subtitle {
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
}

.gallery-grid {
    position: relative;
    z-index: 1;
}

.documentation-card {
    height: 100%;
    border-radius: 15px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 236, 119, 0.2);
    transition: all 0.3s ease;
}

.documentation-card:hover {
    transform: translateY(-10px);
    border-color: rgba(255, 236, 119, 0.5);
    box-shadow: 0 10px 30px rgba(255, 236, 119, 0.3);
}

.documentation-image-container {
    position: relative;
    padding-top: 75%; /* 4:3 Aspect Ratio */
    overflow: hidden;
}

.documentation-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.documentation-card:hover .documentation-image {
    transform: scale(1.1);
}

.documentation-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(42, 10, 86, 0.95) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
}

.documentation-card:hover .documentation-overlay {
    opacity: 1;
}

.documentation-info {
    width: 100%;
}

.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 236, 119, 0.2);
    border-radius: 15px;
}

.btn-gradient {
    background: linear-gradient(135deg, #FF750F 0%, #FFEC77 100%);
    border: none;
    color: #2A0A56;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 236, 119, 0.4);
    color: #2A0A56;
}

/* Modal Styles */
.documentation-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    overflow-y: auto;
    padding: 2rem;
}

.documentation-modal-overlay.active {
    display: block;
}

.documentation-modal-container {
    position: relative;
    max-width: 1400px;
    margin: 0 auto;
    background: linear-gradient(135deg, rgba(42, 10, 86, 0.95) 0%, rgba(80, 20, 140, 0.95) 100%);
    border-radius: 20px;
    overflow: hidden;
    border: 2px solid rgba(255, 236, 119, 0.3);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.modal-close-btn {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 50px;
    height: 50px;
    border: none;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: white;
    font-size: 1.5rem;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
}

.modal-close-btn:hover {
    background: rgba(255, 236, 119, 0.3);
    transform: rotate(90deg);
}

.modal-image {
    max-width: 100%;
    max-height: 80vh;
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.modal-details {
    background: rgba(42, 10, 86, 0.5);
    overflow-y: auto;
    max-height: 80vh;
}

.modal-details h5 {
    font-weight: 600;
}

/* Responsive Styles */
@media (max-width: 991px) {
    .documentation-modal-container {
        max-width: 90%;
    }
    
    .modal-details {
        max-height: none;
    }
    
    .page-title {
        font-size: 3rem;
    }
}

@media (max-width: 767px) {
    .page-title {
        font-size: 2rem;
        letter-spacing: 2px;
    }
    
    .documentation-modal-overlay {
        padding: 1rem;
    }
    
    .modal-image {
        max-height: 50vh;
    }
}
</style>

<script>
function togglePopup(event, id) {
    event.stopPropagation();
    const popup = document.getElementById('popup-' + id);
    popup.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closePopup(id) {
    const popup = document.getElementById('popup-' + id);
    popup.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close popup with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const activePopup = document.querySelector('.documentation-modal-overlay.active');
        if (activePopup) {
            activePopup.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
});
</script>
@endsection
