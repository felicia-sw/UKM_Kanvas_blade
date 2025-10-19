@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5 w-100" style="overflow-x: hidden;">
  <div class="container-fluid px-3 px-md-4" style="overflow: visible;">

    <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
      <div class="col-12 px-2">
        <h1 class="page-title display-1 fw-bold text-uppercase mb-4">EVENTS</h1>
        <p class="page-subtitle text-white fs-5 mx-auto px-3">
          Discover upcoming events that will inspire and challenge you. 
          Explore the maze of opportunities waiting ahead.
        </p>
      </div>
    </div>


    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-12 col-xl-10 col-xxl-8 px-2 px-md-3" style="overflow: visible;">
        <div class="timeline-container position-relative overflow-visible">

          @forelse($events as $index => $event)
          <div class="row event-item mb-5 pb-5 position-relative overflow-visible" data-index="{{ $index }}">
            <!-- Image Rectangle (Left Side) -->
            <div class="col-12 col-md-3 col-lg-3 col-xl-2 d-flex justify-content-center justify-content-md-start align-items-center mb-4 mb-md-0">
              <div class="event-rect border-3 border-white position-relative d-flex align-items-center justify-content-center overflow-hidden rounded-3 shadow-sm">
                @if($event->poster_image)
                  <img src="{{ asset('storage/' . $event->poster_image) }}" 
                       alt="{{ $event->title }}" 
                       class="event-img">
                @else
                  <div class="placeholder-image bg-secondary d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-calendar-event text-muted"></i>
                  </div>
                @endif
              </div>
            </div>

            <!-- Event Content (Right Side) -->
            <div class="col-12 col-md-9 col-lg-9 col-xl-10 d-flex flex-column justify-content-center ps-md-2 ps-xl-4">
              <!-- Date at Top -->
              <div class="d-flex align-items-baseline mb-3">
                <span class="display-4 fw-bold">{{ date('d', strtotime($event->start_date)) }}</span>
                <span class="fs-4 text-uppercase ms-2">{{ strtoupper(date('M', strtotime($event->start_date))) }}</span>
              </div>

              <!-- Event Info -->
              <div class="event-content">
                <h2 class="h2 fw-bold mb-3">{{ $event->title }}</h2>
                <p class="text-white fs-5 mb-4 lh-base">{{ $event->description }}</p>

                <!-- Event Details -->
                <div class="event-details">
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-clock text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Time:</strong>
                      <span>{{ date('d M Y, H:i', strtotime($event->start_date)) }} - {{ date('d M Y, H:i', strtotime($event->end_date)) }}</span>
                    </div>
                  </div>

                  @if($event->location)
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-geo-alt text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Location:</strong>
                      <span>{{ $event->location }}</span>
                    </div>
                  </div>
                  @endif

                  @if($event->price)
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-tag text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Price:</strong>
                      <span>Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                    </div>
                  </div>
                  @else
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-tag text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Price:</strong>
                      <span>Free</span>
                    </div>
                  </div>
                  @endif

                  @if($event->max_participants)
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-people text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Max Participants:</strong>
                      <span>{{ $event->max_participants }}</span>
                    </div>
                  </div>
                  @endif

                  @if($event->registration_deadline)
                  <div class="d-flex align-items-start mb-2">
                    <i class="bi bi-calendar-check text-accent fs-5 me-2 flex-shrink-0"></i>
                    <div class="flex-grow-1">
                      <strong class="me-2">Registration Deadline:</strong>
                      <span>{{ date('d M Y', strtotime($event->registration_deadline)) }}</span>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="row justify-content-center">
            <div class="col-12 text-center py-5">
              <i class="bi bi-calendar-x display-1 text-white-50 mb-4"></i>
              <h3 class="mb-3 text-white">No Active Events</h3>
              <p class="fs-5 text-white-50">Check back soon for upcoming events!</p>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Event-specific styles - extends app.css */

/* Ensure background covers full width on all devices */
.page-bg-image {
  width: 100%;
  overflow-x: hidden;
  background: linear-gradient(to bottom, #1a1a2e, #16213e, #0f3460);
  min-height: 100vh;
}

/* Timeline container - allow content to scale without clipping */
.timeline-container {
  overflow: visible !important;
  padding: 2rem 0;
}

/* Add extra padding on larger screens */
@media (min-width: 1200px) {
  .timeline-container {
    padding: 4rem 0;
  }
}

/* Event items - ensure proper spacing for zoom effect */
.event-item {
  margin-bottom: 8rem !important;
  padding-bottom: 6rem !important;
  padding-top: 2rem !important;
  overflow: visible !important;
}

/* Desktop zoom adjustments (1200px and up) */
@media (min-width: 1200px) {
  .event-item {
    margin-bottom: 10rem !important;
    padding-bottom: 8rem !important;
    padding-top: 3rem !important;
  }
  
  /* Reduce zoom to prevent clipping */
  .event-item.zoom-active {
    transform: translateY(0) scale(1.08);
    transition: transform 0.6s ease-out;
  }
}

/* Tablet adjustments (768px - 1199px) */
@media (min-width: 768px) and (max-width: 1199px) {
  .timeline-container::before {
    left: 50px;
  }
  
  .event-item {
    transform-origin: 50px center;
    margin-bottom: 7rem !important;
    padding-bottom: 5rem !important;
    padding-top: 2rem !important;
    padding-right: 2rem !important;
  }
  
  /* Reduce space between image and text */
  .ps-md-2 {
    padding-left: 0.25rem !important;
  }
  
  /* Make image smaller to save space */
  .event-rect {
    width: 120px;
  }
  
  /* Reduce column width for image to bring text closer */
  .col-md-3 {
    flex: 0 0 auto;
    width: 20% !important;
  }
  
  .col-md-9 {
    flex: 0 0 auto;
    width: 80% !important;
    padding-right: 1.5rem !important;
  }
  
  /* Add container padding to prevent overflow */
  .container-fluid {
    padding-right: 2rem !important;
  }
  
  /* Tablet text sizing */
  .page-title {
    font-size: 3.5rem !important;
    letter-spacing: 4px;
  }
  
  .page-subtitle {
    font-size: 1.1rem !important;
  }
  
  .display-4 {
    font-size: 2.5rem !important;
  }
  
  .fs-4 {
    font-size: 1.25rem !important;
  }
  
  .h2 {
    font-size: 1.5rem !important;
  }
  
  .fs-5 {
    font-size: 0.95rem !important;
  }
  
  .event-details {
    font-size: 0.9rem;
  }
  
  .event-details i {
    font-size: 1.1rem !important;
  }
  
  /* Minimal zoom effect on tablet */
  .event-item.zoom-active {
    transform: translateY(0) scale(1.04);
  }
}

/* Medium-large screens (992px - 1199px) - extra adjustments */
@media (min-width: 992px) and (max-width: 1199px) {
  .timeline-container::before {
    left: 55px;
  }
  
  .event-item {
    transform-origin: 55px center;
    padding-right: 2.5rem !important;
  }
  
  /* Slightly reduce gap */
  .ps-md-2 {
    padding-left: 0.5rem !important;
  }
  
  .event-rect {
    width: 130px;
  }
  
  /* Reduce column width for image to bring text closer */
  .col-md-3 {
    flex: 0 0 auto;
    width: 18% !important;
  }
  
  .col-md-9 {
    flex: 0 0 auto;
    width: 82% !important;
    padding-right: 2rem !important;
  }
  
  .display-4 {
    font-size: 2.65rem !important;
  }
  
  .fs-4 {
    font-size: 1.3rem !important;
  }
  
  .h2 {
    font-size: 1.6rem !important;
  }
  
  .fs-5 {
    font-size: 0.98rem !important;
  }
}

/* Mobile responsive adjustments (below 768px) */
@media (max-width: 767px) {
  .timeline-container::before {
    display: none;
  }
  
  .event-item {
    margin-bottom: 4rem !important;
    padding-bottom: 3rem !important;
    padding-top: 1.5rem !important;
  }
  
  /* Mobile text sizing */
  .page-title {
    font-size: 2.25rem !important;
    letter-spacing: 2px;
  }
  
  .page-subtitle {
    font-size: 0.95rem !important;
    padding: 0 0.5rem;
  }
  
  .event-rect {
    width: 150px;
    margin: 0 auto;
  }
  
  .ps-md-4 {
    text-align: center;
    padding-left: 0 !important;
  }
  
  .display-4 {
    font-size: 2.25rem !important;
  }
  
  .fs-4 {
    font-size: 1.15rem !important;
  }
  
  .h2 {
    font-size: 1.35rem !important;
  }
  
  .fs-5 {
    font-size: 0.9rem !important;
  }
  
  .event-details {
    text-align: left;
    max-width: 100%;
    margin: 0 auto;
    font-size: 0.875rem;
  }
  
  .event-details i {
    font-size: 1rem !important;
  }
  
  /* Adjust zoom effect for mobile */
  .event-item {
    transform-origin: center center;
  }
  
  .event-item.zoom-active {
    transform: translateY(0) scale(1.03);
  }
  
  .placeholder-image {
    font-size: 2.75rem !important;
  }
}

/* Extra small mobile adjustments (below 576px) */
@media (max-width: 576px) {
  .event-item {
    margin-bottom: 3rem !important;
    padding-bottom: 2rem !important;
  }
  
  .page-title {
    font-size: 1.85rem !important;
    letter-spacing: 1.5px;
  }
  
  .page-subtitle {
    font-size: 0.875rem !important;
  }
  
  .event-rect {
    width: 130px;
  }
  
  .display-4 {
    font-size: 1.85rem !important;
  }
  
  .fs-4 {
    font-size: 0.95rem !important;
  }
  
  .h2 {
    font-size: 1.15rem !important;
  }
  
  .fs-5 {
    font-size: 0.85rem !important;
  }
  
  .event-details {
    font-size: 0.8rem;
  }
  
  .event-details i {
    font-size: 0.9rem !important;
  }
  
  .placeholder-image {
    font-size: 2.25rem !important;
  }
  
  /* Disable zoom on very small screens */
  .event-item.zoom-active {
    transform: translateY(0) scale(1);
  }
}

/* Landscape mobile optimization */
@media (max-width: 767px) and (orientation: landscape) {
  .event-rect {
    width: 110px;
  }
  
  .event-item {
    margin-bottom: 2.5rem !important;
    padding-bottom: 1.5rem !important;
  }
  
  .page-title {
    font-size: 1.75rem !important;
  }
  
  .display-4 {
    font-size: 1.75rem !important;
  }
  
  .fs-4 {
    font-size: 0.9rem !important;
  }
  
  .h2 {
    font-size: 1.1rem !important;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const eventItems = document.querySelectorAll('.event-item');
  
  // Check if device is mobile
  function isMobile() {
    return window.innerWidth <= 576;
  }
  
  function isTablet() {
    return window.innerWidth > 576 && window.innerWidth <= 991;
  }
  
  // Intersection Observer for fly-in animation
  const observerOptions = {
    threshold: isMobile() ? 0.1 : 0.2,
    rootMargin: '0px'
  };
  
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fly-in');
        } else {
          entry.target.classList.remove('fly-in');
        }
      });
    },
    observerOptions
  );

  // Observe all event items
  eventItems.forEach((item) => {
    observer.observe(item);
  });

  // Scroll-based zoom effect: scale up when element is in center of viewport
  function updateZoomEffect() {
    // Disable zoom effect on very small screens
    if (isMobile()) {
      eventItems.forEach((item) => {
        item.classList.remove('zoom-active');
      });
      return;
    }
    
    const viewportCenter = window.innerHeight / 2;
    
    eventItems.forEach((item) => {
      const rect = item.getBoundingClientRect();
      const itemCenter = rect.top + rect.height / 2;
      
      // Calculate distance from viewport center
      const distanceFromCenter = Math.abs(viewportCenter - itemCenter);
      const maxDistance = window.innerHeight / 2;
      
      // Adjust threshold based on device - more conservative to prevent clipping
      const threshold = isTablet() ? 0.4 : 0.5;
      
      // If item is close to center (within a threshold), apply zoom
      if (distanceFromCenter < maxDistance * threshold && rect.top < window.innerHeight && rect.bottom > 0) {
        // Calculate scale based on proximity to center (closer = larger)
        const proximityRatio = 1 - (distanceFromCenter / (maxDistance * threshold));
        
        // Only add zoom-active class if it's very close to center
        // Increased threshold to make zoom more selective
        if (proximityRatio > 0.6) {
          item.classList.add('zoom-active');
        } else {
          item.classList.remove('zoom-active');
        }
      } else {
        item.classList.remove('zoom-active');
      }
    });
  }
  
  // Run on scroll with throttling for performance
  let ticking = false;
  window.addEventListener('scroll', function() {
    if (!ticking) {
      window.requestAnimationFrame(function() {
        updateZoomEffect();
        ticking = false;
      });
      ticking = true;
    }
  });
  
  // Handle window resize
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      updateZoomEffect();
    }, 250);
  });
  
  // Initial check
  updateZoomEffect();
});
</script>
@endsection
