
@extends('admin.layouts.admin')

@section('title', 'All Documentation Media')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">All Documentation Media</h1>
    <div class="d-flex">
        {{-- Button to quickly add documentation (requires event selection) --}}
        <a href="{{ route('admin.documentation.create.all') }}" class="btn btn-admin-primary me-2">
            <i class="bi bi-plus-circle me-1"></i>Add New Photo
        </a>
        {{-- Button to remind the user where to manage media event-by-event --}}
        <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-calendar-event me-2"></i>Manage by Event
        </a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Search and Filter Bar --}}
<div class="card admin-card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.documentation.index.all') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search" 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="event" class="form-select">
                    <option value="">All Events</option>
                    @foreach($events as $eventOption)
                    <option value="{{ $eventOption->id }}" {{ request('event') == $eventOption->id ? 'selected' : '' }}>
                        {{ $eventOption->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-admin-primary w-100">
                    <i class="bi bi-search me-2"></i>Search
                </button>
            </div>
            @if(request('search') || request('event'))
            <div class="col-12">
                <a href="{{ route('admin.documentation.index.all') }}" class="btn btn-admin-secondary">
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Event</th>
                        <th scope="col">Upload Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documentations as $documentation)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $documentation->title }}</td>
                            <td>
                                {{-- Link to the specific event's documentation index page --}}
                                <a href="{{ route('admin.events.documentation.index', $documentation->event_id) }}">
                                    {{ $documentation->event->title ?? 'N/A' }}
                                </a>
                            </td>
                            <td>{{ $documentation->created_at->format('d M Y') }}</td>
                            <td>
                                {{-- Edit/Destroy must use the nested route, requiring both IDs --}}
                                <a href="{{ route('admin.events.documentation.edit', ['event' => $documentation->event_id, 'documentation' => $documentation->id]) }}" class="btn btn-sm btn-admin-outline-warning me-1">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                
                                <form action="{{ route('admin.events.documentation.destroy', ['event' => $documentation->event_id, 'documentation' => $documentation->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-admin-outline-danger" onclick="return confirm('Are you sure you want to delete this media? This cannot be undone.')">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No documentation media has been uploaded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination Links --}}
        <div class="d-flex justify-content-center">
            {{ $documentations->appends(request()->query())->links('vendor.pagination.bootstrap-5-admin') }}
        </div>
    </div>
</div>
@endsection {{-- This is the directive that must match a starting @section --}}