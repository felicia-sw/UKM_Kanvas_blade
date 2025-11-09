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

    {{-- Monthly Growth --}}
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                 <div class="card-icon bg-success text-white me-3">
                    <i class="bi bi-graph-up-arrow fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">
                        {{ $monthlyGrowth > 0 ? '+' : '' }}{{ $monthlyGrowth }}%
                    </div>
                    <div class="text-muted">Monthly Growth</div>
                    <small class="text-muted">Artwork additions</small>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <span class="text-muted small">
                    @if($monthlyGrowth > 0)
                        <i class="bi bi-arrow-up text-success"></i> Increasing
                    @elseif($monthlyGrowth < 0)
                        <i class="bi bi-arrow-down text-danger"></i> Decreasing
                    @else
                        <i class="bi bi-dash"></i> No change
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>

{{-- Recent Activity Section --}}
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-activity me-2"></i>Recent Activity</h5>
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

    {{-- Quick Stats Sidebar --}}
    <div class="col-lg-4">
        <div class="card admin-card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Quick Stats</h5>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Artworks</span>
                        <span class="fs-5 fw-bold text-primary">{{ $totalArtworks }}</span>
                    </div>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Events</span>
                        <span class="fs-5 fw-bold text-warning">{{ $totalEvents }}</span>
                    </div>
                </div>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Documentation</span>
                        <span class="fs-5 fw-bold text-info">{{ $totalDocumentation }}</span>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Users</span>
                        <span class="fs-5 fw-bold text-success">{{ $userRegistrations }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions
        <div class="card admin-card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.artworks.create') }}" class="btn btn-admin-primary">
                        <i class="bi bi-plus-lg me-2"></i>Add Artwork
                    </a>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-admin-warning">
                        <i class="bi bi-plus-lg me-2"></i>Add Event
                    </a>
                    <a href="{{ route('admin.documentation.create.all') }}" class="btn btn-admin-info">
                        <i class="bi bi-plus-lg me-2"></i>Add Documentation
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection