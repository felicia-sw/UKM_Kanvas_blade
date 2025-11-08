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

    <!-- Filter Buttons -->
    <div class="row justify-content-center mb-4">
      <div class="col-auto">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <a href="{{ route('events', ['filter' => 'upcoming']) }}" class="btn btn-filter btn-lg px-4 py-2 {{ ($filter ?? 'upcoming') === 'upcoming' ? 'active' : '' }}">Now & Upcoming</a>
          <a href="{{ route('events', ['filter' => 'past']) }}" class="btn btn-filter btn-lg px-4 py-2 {{ ($filter ?? 'upcoming') === 'past' ? 'active' : '' }}">Past Events</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-12 col-xl-10 col-xxl-8 px-2 px-md-3" style="overflow: visible;">
        <div class="timeline-container position-relative overflow-visible">

          @forelse($events as $event)
            <x-event-card :event="$event" layout="timeline" :filter="$filter ?? 'upcoming'" />
          @empty
          <div class="row justify-content-center">
            <div class="col-12 text-center py-5">
              <i class="bi bi-calendar-x display-1 text-white-50 mb-4"></i>
              <h3 class="mb-3 text-white">
                @if(($filter ?? 'upcoming') === 'past')
                  No Past Events
                @else
                  No Active Events
                @endif
              </h3>
              <p class="fs-5 text-white-50">
                @if(($filter ?? 'upcoming') === 'past')
                  There are no past events to show.
                @else
                  Check back soon for upcoming events!
                @endif
              </p>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<style>
body {
  background: #2A0A56 !important;
}

.page-bg-image {
  width: 100%;
  overflow-x: hidden;
  min-height: 100vh;
  padding-bottom: 0 !important;
  margin-bottom: 0 !important;
  background-image: url('{{ asset("images/bg1.jpg") }}');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  position: relative;
}

.page-bg-image::before {
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

.page-bg-image > * {
  position: relative;
  z-index: 1;
}

/* Filter Button Styles */
.btn-filter {
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 236, 119, 0.3);
  color: white;
  font-weight: 600;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.btn-filter:hover {
  background: rgba(255, 236, 119, 0.2);
  border-color: rgba(255, 236, 119, 0.5);
  color: white;
  transform: translateY(-2px);
}

.btn-filter.active {
  background: linear-gradient(135deg, #FFEC77, #F8B803);
  border-color: #FFEC77;
  color: #2A0A56;
}

.timeline-container {
  overflow: visible !important;
  padding: 2rem 0;
}

@media (min-width: 1200px) {
  .timeline-container {
    padding: 4rem 0;
  }
}

.event-item {
  margin-bottom: 8rem !important;
  padding-bottom: 6rem !important;
  padding-top: 2rem !important;
  overflow: visible !important;
}

@media (min-width: 1200px) {
  .event-item {
    margin-bottom: 10rem !important;
    padding-bottom: 8rem !important;
    padding-top: 3rem !important;
  }
  .event-item.zoom-active {
    transform: translateY(0) scale(1.08);
    transition: transform 0.6s ease-out;
  }
}

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
  
  .ps-md-2 {
    padding-left: 0.25rem !important;
  }
  .event-rect {
    width: 120px;
  }
  .col-md-3 {
    flex: 0 0 auto;
    width: 20% !important;
  }
  
  .col-md-9 {
    flex: 0 0 auto;
    width: 80% !important;
    padding-right: 1.5rem !important;
  }
  
  .container-fluid {
    padding-right: 2rem !important;
  }
  
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
  }  .event-item.zoom-active {
    transform: translateY(0) scale(1.04);
  }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .timeline-container::before {
    left: 55px;
  }
  
  .event-item {
    transform-origin: 55px center;
    padding-right: 2.5rem !important;
  }
  
  .ps-md-2 {
    padding-left: 0.5rem !important;
  }
  
  .event-rect {
    width: 130px;
  }
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

@media (max-width: 767px) {
  .timeline-container::before {
    display: none;
  }
  
  .event-item {
    margin-bottom: 4rem !important;
    padding-bottom: 3rem !important;
    padding-top: 1.5rem !important;
  }
  
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
  .event-item.zoom-active {
    transform: translateY(0) scale(1);
  }
}

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
  
  // check if device is mobile
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
