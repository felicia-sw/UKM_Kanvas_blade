@extends('layouts.app')

@section('title', 'Events')
@section('content')
<div class="event-schedule text-white min-vh-100 py-5">
  <div class="container-fluid">
    
    <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
      <div class="col-12">
        <h1 class="event-title display-1 fw-bold text-uppercase mb-4">EVENTS</h1>
        <p class="event-subtitle text-white fs-5 mx-auto" style="max-width: 600px;">
          Discover upcoming events that will inspire and challenge you. 
          Explore the maze of opportunities waiting ahead.
        </p>
      </div>
    </div>

    
    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-12 col-xl-8">
        <div class="timeline-container position-relative">
          @php
          $events = [
            [
              'id' => 1,
              'title' => 'Digital Innovation Summit 2025',
              'description' => 'Join us for a groundbreaking summit exploring the future of digital transformation and innovation in business.',
              'poster_image' => null,
              'start_date' => '2025-11-15 09:00:00',
              'end_date' => '2025-11-15 17:00:00',
              'registration_deadline' => '2025-11-10',
              'price' => 150000,
              'location' => 'Jakarta Convention Center',
              'max_participants' => 500,
              'is_active' => true
            ],
            [
              'id' => 2,
              'title' => 'Entrepreneurship Bootcamp',
              'description' => 'A 3-day intensive bootcamp designed for aspiring entrepreneurs to learn the fundamentals of starting and scaling a business.',
              'poster_image' => null,
              'start_date' => '2025-11-20 08:00:00',
              'end_date' => '2025-11-22 18:00:00',
              'registration_deadline' => '2025-11-15',
              'price' => 250000,
              'location' => 'Bali International Convention Center',
              'max_participants' => 100,
              'is_active' => true
            ],
            [
              'id' => 3,
              'title' => 'AI & Machine Learning Workshop',
              'description' => 'Hands-on workshop covering the latest trends in artificial intelligence and machine learning technologies.',
              'poster_image' => null,
              'start_date' => '2025-12-01 10:00:00',
              'end_date' => '2025-12-01 16:00:00',
              'registration_deadline' => '2025-11-25',
              'price' => 100000,
              'location' => 'Bandung Tech Hub',
              'max_participants' => 80,
              'is_active' => true
            ],
            [
              'id' => 4,
              'title' => 'Creative Design Conference',
              'description' => 'Explore the intersection of creativity and technology with industry-leading designers and creative professionals.',
              'poster_image' => 'null',
              'start_date' => '2025-12-10 09:30:00',
              'end_date' => '2025-12-10 17:30:00',
              'registration_deadline' => '2025-12-05',
              'price' => null,
              'location' => 'Surabaya Creative Space',
              'max_participants' => 200,
              'is_active' => true
            ],
            [
              'id' => 5,
              'title' => 'Sustainability & Green Business Forum',
              'description' => 'Discover sustainable business practices and learn how to build an eco-friendly enterprise for the future.',
              'poster_image' => null,
              'start_date' => '2025-12-15 08:00:00',
              'end_date' => '2025-12-16 17:00:00',
              'registration_deadline' => '2025-12-10',
              'price' => 200000,
              'location' => 'Yogyakarta Convention Hall',
              'max_participants' => 150,
              'is_active' => true
            ]
          ];

          // Filter only active events
          $activeEvents = array_filter($events, function($event) {
            return $event['is_active'] === true;
          });
          @endphp

          @foreach($activeEvents as $index => $event)
          <div class="row event-item mb-5 pb-5 position-relative" style="margin-bottom: 5rem !important; padding-bottom: 5rem !important;" data-index="{{ $index }}">
            <!-- Image Circle (Left Side) -->
            <div class="col-12 col-md-3 col-lg-2 d-flex justify-content-center justify-content-md-start align-items-center mb-4 mb-md-0">
              <div class="event-rect border-3 border-white position-relative d-flex align-items-center overflow-hidden">
                @if($event['poster_image'])
                  <img src="{{ asset('images/events/' . $event['poster_image']) }}" 
                       alt="{{ $event['title'] }}" 
                       class="event-img object-fit-cover">
                @else
                  <div class="placeholder-image bg-secondary d-flex align-items-center justify-content-center w-100 h-100">
                    <i class="bi bi-calendar-event text-muted"></i>
                  </div>
                @endif
              </div>
            </div>

            <!-- Event Content (Right Side) -->
            <div class="col-12 col-md-9 col-lg-10 d-flex flex-column justify-content-center">
              <!-- Date at Top -->
              <div class="event-date mb-3">
                <span class="display-4 fw-bold">{{ date('d', strtotime($event['start_date'])) }}</span>
                <span class="fs-4 text-uppercase ms-2 align-top">{{ strtoupper(date('M', strtotime($event['start_date']))) }}</span>
              </div>

              <!-- Event Info -->
              <div class="event-content">
                <h2 class="event-name h2 fw-bold mb-3">{{ $event['title'] }}</h2>
                <p class="event-description text-white fs-5 mb-4">{{ $event['description'] }}</p>
                
                <!-- Event Details -->
                <div class="event-details">
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-clock text-accent fs-5 me-2"></i>
                    <strong class="me-2">Time:</strong>
                    <span>{{ date('d M Y, H:i', strtotime($event['start_date'])) }} - {{ date('d M Y, H:i', strtotime($event['end_date'])) }}</span>
                  </div>
                  
                  @if($event['location'])
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-geo-alt text-accent fs-5 me-2"></i>
                    <strong class="me-2">Location:</strong>
                    <span>{{ $event['location'] }}</span>
                  </div>
                  @endif
                  
                  @if($event['price'])
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-tag text-accent fs-5 me-2"></i>
                    <strong class="me-2">Price:</strong>
                    <span>Rp {{ number_format($event['price'], 0, ',', '.') }}</span>
                  </div>
                  @else
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-tag text-accent fs-5 me-2"></i>
                    <strong class="me-2">Price:</strong>
                    <span>Free</span>
                  </div>
                  @endif
                  
                  @if($event['max_participants'])
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-people text-accent fs-5 me-2"></i>
                    <strong class="me-2">Max Participants:</strong>
                    <span>{{ $event['max_participants'] }}</span>
                  </div>
                  @endif
                  
                  @if($event['registration_deadline'])
                  <div class="detail-item d-flex align-items-center mb-2">
                    <i class="bi bi-calendar-check text-accent fs-5 me-2"></i>
                    <strong class="me-2">Registration Deadline:</strong>
                    <span>{{ date('d M Y', strtotime($event['registration_deadline'])) }}</span>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
  const eventItems = document.querySelectorAll('.event-item');
  
  // Intersection Observer for fly-in animation
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
    {
      threshold: 0.2
    }
  );

  // Observe all event items
  eventItems.forEach((item) => {
    observer.observe(item);
  });

  // Scroll-based zoom effect: scale up when element is in center of viewport
  function updateZoomEffect() {
    const viewportCenter = window.innerHeight / 2;
    
    eventItems.forEach((item) => {
      const rect = item.getBoundingClientRect();
      const itemCenter = rect.top + rect.height / 2;
      
      // Calculate distance from viewport center
      const distanceFromCenter = Math.abs(viewportCenter - itemCenter);
      const maxDistance = window.innerHeight / 2;
      
      // If item is close to center (within a threshold), apply zoom
      if (distanceFromCenter < maxDistance * 0.6 && rect.top < window.innerHeight && rect.bottom > 0) {
        // Calculate scale based on proximity to center (closer = larger)
        const proximityRatio = 1 - (distanceFromCenter / (maxDistance * 0.6));
        
        // Only add zoom-active class if it's very close to center
        if (proximityRatio > 0.5) {
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
  
  // Initial check
  updateZoomEffect();
});
</script>
@endsection