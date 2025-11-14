@extends('admin.layouts.admin')

@section('title', 'Event Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Event Management</h1>
    <div>
        <a href="{{ route('admin.events.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Add New Event</a>
    </div>
</div>
<p class="text-muted mb-4">Organize and track your events.</p>

{{-- Search Bar --}}
<div class="card admin-card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.events.index') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" 
                       placeholder="search" 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-admin-primary w-100">
                    <i class="bi bi-search me-2"></i>Search
                </button>
            </div>
            @if(request('search'))
            <div class="col-12">
                <a href="{{ route('admin.events.index') }}" class="btn btn-admin-secondary">
                  
                </a>
               
            </div>
            @endif
        </form>
    </div>
</div>

<div class="card admin-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
       <h5 class="mb-0">Upcoming Events</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>Location/Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcomingEvents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_date->format('d M Y, H:i') }}</td>
                        <td>{{ $event->location ?? 'Online Event' }}</td>
                        <td>
                            {{-- View Registrations button --}}
                            <a href="{{ route('admin.events.registrations', $event->id) }}" class="btn btn-sm btn-admin-outline-primary me-1">
                                <i class="bi bi-person-lines-fill me-1"></i>Registrations
                            </a>
                            
                            {{-- FIX: Added View Documentation button for Upcoming Events --}}
                            <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-sm btn-admin-outline-secondary me-1" style="border: 2px solid #6c757d !important;">
                                <i class="bi bi-images me-1"></i>View Docs
                            </a>
                            
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-admin-outline-warning me-1"><i class="bi bi-pencil me-1"></i>Edit</a>
                            
                            {{-- Delete form --}}
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-admin-outline-danger" onclick="return confirm('Are you sure you want to delete this upcoming event? This action cannot be undone.')">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No upcoming events.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         <div class="d-flex justify-content-center mt-4">
             {{ $upcomingEvents->appends(request()->query())->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>

<div class="card admin-card">
    <div class="card-header">
       <h5 class="mb-0">Past Events</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        {{-- Added for alignment --}}
                        <th>Location/Type</th> 
                        <th>Start Date</th> {{-- This header refers to the start date --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse($pastEvents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        {{-- Added for alignment --}}
                        <td>{{ $event->location ?? 'Online Event' }}</td> 
                        {{-- Keeping start_date --}}
                        <td>{{ $event->start_date->format('d M Y') }}</td>
                        <td>
                            {{-- View Registrations button --}}
                            <a href="{{ route('admin.events.registrations', $event->id) }}" class="btn btn-sm btn-admin-outline-primary me-1">
                                <i class="bi bi-person-lines-fill me-1"></i>Registrations
                            </a>
                            
                            {{-- View Documentation button --}}
                            <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-sm btn-admin-outline-secondary me-1" style="border: 2px solid #6c757d !important;">
                                <i class="bi bi-images me-1"></i>View Docs
                            </a>
                            
                            {{-- Delete form --}}
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-admin-outline-danger" onclick="return confirm('Are you sure you want to delete this past event? This action cannot be undone.')">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Updated colspan to 4 for alignment --}}
                        <td colspan="4" class="text-center text-muted">No past events.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $pastEvents->appends(request()->query())->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>

@endsection