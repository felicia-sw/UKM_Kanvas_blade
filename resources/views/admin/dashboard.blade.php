@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="h2 mb-4">Dashboard Overview</h1>
<p class="text-muted mb-4">Welcome back to the Kanvas Admin Portal</p>

{{-- Statistics Cards --}}
<div class="row g-4 mb-4">
    {{-- Total Artworks --}}
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-primary text-white me-3">
                    <i class="bi bi-palette fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $totalArtworks }}</div>
                    <div class="text-muted">Total Artworks</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="{{ route('admin.artworks.index') }}" class="text-decoration-none text-primary small">
                    View all artworks <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Total Events --}}
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-warning text-white me-3">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $totalEvents }}</div>
                    <div class="text-muted">Total Events</div>
                    <small class="text-muted">{{ $upcomingEvents }} upcoming</small>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="{{ route('admin.events.index') }}" class="text-decoration-none text-warning small">
                    View all events <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Total Documentation --}}
    <div class="col-xl-3 col-md-6">
         <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                 <div class="card-icon bg-info text-white me-3">
                    <i class="bi bi-camera fs-4"></i>
                 </div>
                 <div>
                    <div class="fs-2 fw-bold">{{ $totalDocumentation }}</div>
                    <div class="text-muted">Documentation Items</div>
                 </div>
             </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="{{ route('admin.documentation.index.all') }}" class="text-decoration-none text-info small">
                    View all documentation <i class="bi bi-arrow-right"></i>
                </a>
            </div>
         </div>
    </div>

    {{-- user regist total --}}
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                 <div class="card-icon bg-success text-white me-3">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $userRegistrations }}  </div>
                    <div class="text-muted">User Regist</div>
                </div>
            </div>
              <div class="card-footer bg-transparent border-top-0">
            <i class="bi bi-dash"></i> -
            </div>
        </div>
    </div>
</div>

{{-- Recent Activity Section --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card admin-card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class=" me-2"></i>Recent Events</h5>

            </div>
            <div class="card-body">
                @if(count($recentEvents) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentEvents as $event)
                            <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                <div>
                                    <div class="fw-semibold">{{ $event->title }}</div>
                                    <small class="text-muted">{{ $event->location ?? 'No location' }} • {{ date('d M Y', strtotime($event->start_date)) }}</small>
                                </div>
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p>No events found.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class=" me-2"></i>Recent Artworks</h5>
            </div>
            <div class="card-body">
                @if(count($recentArtworks) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentArtworks as $artwork)
                            <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $artwork->image_path) }}" 
                                         alt="{{ $artwork->title }}" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;" 
                                         class="me-3">
                                    <div>
                                        <div class="fw-semibold">{{ $artwork->title }}</div>
                                        <small class="text-muted">by {{ $artwork->artist_name }} • {{ $artwork->category->name ?? 'N/A' }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('admin.artworks.edit', $artwork) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p>No artworks found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class=" me-2"></i>Recent Activity</h5>
                <span class="badge bg-secondary">Last 8 items</span>
            </div>
            <div class="card-body">
                @if(count($recentActivity) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentActivity as $activity)
                            <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                <div class="d-flex align-items-start flex-grow-1">
                                    <div class="me-3">
                                        <div class="card-icon bg-{{ $activity['color'] }} text-white" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                            <i class="{{ $activity['icon'] }}"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $activity['details'] }}</div>
                                        <small class="text-muted">by {{ $activity['user'] }}</small>
                                    </div>
                                </div>
                                <small class="text-muted text-nowrap ms-3">{{ $activity['time'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                        <p>No recent activity.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</div>
@endsection