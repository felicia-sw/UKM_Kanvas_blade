@extends('layouts.app')

@section('title', $event->title . ' - Documentation')

@section('content')
<div class="documentation-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
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

        <!-- Documentation gallery grid -->
        <div class="container pb-5">
            <div class="row g-4 gallery-grid">
                @forelse($event->documentations as $index => $documentation)
                <div class="col-lg-4 col-md-6 gallery-item" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="documentation-card">
                        <div class="documentation-image-container">
                            <img src="{{ $documentation->file_path }}" 
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

<!-- Modal  popup for documentation details -->
@foreach($event->documentations as $documentation)
<div class="documentation-modal-overlay" id="popup-{{ $documentation->id }}" onclick="closePopup({{ $documentation->id }})">
    <div class="documentation-modal-container" onclick="event.stopPropagation()">
      
        <button class="modal-close-btn" onclick="closePopup({{ $documentation->id }})">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <div class="row g-0 h-100">
           
            <div class="col-lg-8 d-flex align-items-center justify-content-center p-4">
                <img src="{{ $documentation->file_path }}" 
                     alt="{{ $documentation->title }}" 
                     class="modal-image">
            </div>
            
         
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

<link rel="stylesheet" href="{{ asset('css/pages/event-documentation.css') }}">

<script src="{{ asset('js/pages/event-documentation.js') }}"></script>
@endsection
