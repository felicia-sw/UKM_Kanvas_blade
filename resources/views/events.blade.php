@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="event-schedule text-white min-vh-100 py-5">
  <div class="container-fluid">

    {{-- Page Header --}}
    <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
      <div class="col-12">
        <h1 class="event-title display-1 fw-bold text-uppercase mb-4">EVENTS</h1>
        <p class="event-subtitle text-white fs-5 mx-auto" style="max-width: 600px;">
          Discover upcoming events that will inspire and challenge you.
        </p>
      </div>
    </div>

    {{-- Events List --}}
    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-12 col-xl-8">
        <div class="timeline-container position-relative">

          @forelse($events as $event)
            <div class="row event-item mb-5 pb-5 position-relative">
              
              {{-- Poster --}}
              <div class="col-12 col-md-3 col-lg-2 mb-4 mb-md-0 d-flex justify-content-center justify-content-md-start">
                <div class="event-rect d-flex align-items-center justify-content-center overflow-hidden">
                  @if($event->poster_image)
                    <img src="{{ asset('storage/' . $event->poster_image) }}"
                         alt="{{ $event->title }}"
                         class="event-img">
                  @else
                    <div class="placeholder-image d-flex align-items-center justify-content-center w-100 h-100">
                      <i class="bi bi-calendar-event text-muted"></i>
                    </div>
                  @endif
                </div>
              </div>

              {{-- Details --}}
              <div class="col-12 col-md-9 col-lg-10">
                <div class="event-date mb-3">
                  <span class="display-4 fw-bold">{{ $event->start_date->format('d') }}</span>
                  <span class="fs-4 text-uppercase ms-2">{{ $event->start_date->format('M') }}</span>
                </div>
                <h2 class="event-name h2 fw-bold mb-3">{{ $event->title }}</h2>
                <p class="event-description fs-5 mb-4">{{ $event->description }}</p>

                <div class="event-details">
                  <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-clock fs-5 me-2 text-accent"></i>
                    <span>
                      {{ $event->start_date->format('d M Y, H:i') }}
                      @if($event->end_date)
                        – {{ $event->end_date->format('d M Y, H:i') }}
                      @endif
                    </span>
                  </div>
                  @if($event->location)
                    <div class="d-flex align-items-center mb-2">
                      <i class="bi bi-geo-alt fs-5 me-2 text-accent"></i>
                      <span>{{ $event->location }}</span>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @empty
            <div class="row justify-content-center">
              <div class="col-12 text-center py-5">
                <i class="bi bi-calendar-x display-1 text-white-50 mb-4"></i>
                <h3 class="mb-3">No Active Events</h3>
                <p class="fs-5 text-white-50">Check back soon for upcoming events!</p>
              </div>
            </div>
          @endforelse

        </div>
      </div>
    </div>

  </div>
</div>

@push('styles')
<style>
  .event-schedule { background: url('{{ asset('images/bg1.jpg') }}') fixed center/cover; position: relative; }
  .event-schedule::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to top,
      rgba(255,236,119,0.85) 0%, rgba(232,160,85,0.85) 35%, rgba(42,10,86,0.9) 100%);
    z-index: 0;
  }
  .event-schedule > * { position: relative; z-index: 1; }
  .event-title { letter-spacing: 5px; text-shadow: 2px 2px 8px rgba(0,0,0,0.3); }
  .event-rect { width: 160px; height: 160px; border: 3px solid #fff; border-radius: 15px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); }
  .event-img { width: 100%; height: 100%; object-fit: cover; }
  .placeholder-image { background: #6c757d; }
  .text-accent { color: #FFEC77 !important; }
  .btn-gradient {
    background: linear-gradient(135deg, #FFEC77, #F8B803);
    color: #1b1b18; padding: .5rem 1.5rem; border-radius: 50px; transition: .3s;
  }
  .btn-gradient:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(255,236,119,0.4); }
  .event-item { opacity: 0; transform: translateX(-50px); transition: .8s ease; }
  .event-item.fly-in { opacity: 1; transform: translateX(0); }
  @media(max-width:767px) {
    .event-rect { width:120px; height:120px; }
    .event-title { font-size:3rem !important; }
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => e.isIntersecting
        ? e.target.classList.add('fly-in')
        : e.target.classList.remove('fly-in'));
    }, { threshold: 0.2 });
    document.querySelectorAll('.event-item').forEach(i => observer.observe(i));
  });
</script>
@endpush
@endsection
