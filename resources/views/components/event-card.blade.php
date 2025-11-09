@props(['event', 'layout' => 'home', 'filter' => 'upcoming'])

@if($layout === 'home')
    {{-- Home Page Event Card Layout --}}
    <div class="card border-0 h-100 event-card">
        <div class="card-body p-4">
            <div class="d-flex align-items-start mb-3 flex-wrap">
                <span class="badge bg-warning text-dark me-2 mb-2 event-badge" style="max-width: 100%; word-wrap: break-word; white-space: normal; text-align: left;">
                    {{ $event->title }}
                </span>
                <small class="text-white-50 event-badge text-shadow-sm">
                    {{ date('D, d M', strtotime($event->start_date)) }}
                </small>
            </div>
            <h5 class="card-title text-white fs-3 text-shadow-sm">{{ $event->title }}</h5>
            <p class="card-text text-white-50 fs-5 text-shadow-sm">
                {{ Str::limit($event->description, 80) }}
            </p>
            <a href="{{ route('events') }}" class="link-light text-decoration-none fs-5 text-shadow-sm">
                Detail event →
            </a>
        </div>
    </div>
@elseif($layout === 'timeline')
    {{-- Events Page Timeline Layout --}}
    <div class="row event-item mb-5 pb-5 position-relative overflow-visible" data-index="{{ $loop->index ?? 0 }}">
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
                
                {{-- Show documentation button only for past events --}}
                @if($filter === 'past')
                <div class="mt-4">
                    <a href="{{ route('events.documentation', $event->id) }}" class="btn btn-gradient btn-lg px-4 py-2">
                        <i class="bi bi-images me-2"></i>View Event Documentation
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endif
