@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="h2 mb-4">Dashboard Overview</h1>
<p class="text-muted mb-4">Welcome back to the Kanvas Admin Portal</p>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-primary text-white me-3">
                    <i class="bi bi-palette fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $totalArtworks ?? 0 }}</div>
                    <div class="text-muted">Total Artworks</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-warning text-white me-3">
                    <i class="bi bi-calendar-event fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $upcomingEvents ?? 0 }}</div>
                    <div class="text-muted">Upcoming Events</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
         <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                 <div class="card-icon bg-info text-white me-3">
                    <i class="bi bi-person-check fs-4"></i>
                 </div>
                 <div>
                    <div class="fs-2 fw-bold">{{ $userRegistrations ?? 0 }}</div> {{-- Using User Count --}}
                    <div class="text-muted">User Registrations</div>
                 </div>
             </div>
         </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body d-flex align-items-center">
                 <div class="card-icon bg-success text-white me-3">
                    <i class="bi bi-graph-up-arrow fs-4"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $monthlyGrowth ?? 0 }}%</div> {{-- Dummy Data --}}
                    <div class="text-muted">Monthly Growth</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card admin-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Activity</h5>
        <a href="#" class="btn btn-sm btn-outline-secondary">View All</a>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
             @forelse($recentActivity as $activity)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">{{ $activity['type'] }} by {{ $activity['user'] }}</small>
                        <p class="mb-0">{{ $activity['details'] }}</p>
                    </div>
                    <small class="text-muted">{{ $activity['time'] }}</small>
                </li>
             @empty
                <li class="list-group-item text-center text-muted">No recent activity.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection