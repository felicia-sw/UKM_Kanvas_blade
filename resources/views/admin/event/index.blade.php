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

<div class="card admin-card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
       <h5 class="mb-0">Upcoming Events</h5>
       {{-- Filter/Search can go here --}}
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
             {{ $upcomingEvents->appends(['past_page' => $pastEvents->currentPage()])->links('vendor.pagination.bootstrap-5-admin') }}
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
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @forelse($pastEvents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_date->format('d M Y') }}</td>
                        <td>
                            {{-- View Documentation button remains disabled as CRUD isn't implemented for it yet --}}
                            {{-- <a href="{{ route('admin.documentation.index', ['event_id' => $event->id]) }}" class="btn btn-sm btn-admin-outline-info me-1 disabled"><i class="bi bi-images me-1"></i>View Docs</a> --}}
                            
                            {{-- Delete form for past events --}}
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
                        <td colspan="3" class="text-center text-muted">No past events.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $pastEvents->appends(['upcoming_page' => $upcomingEvents->currentPage()])->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>

@endsection