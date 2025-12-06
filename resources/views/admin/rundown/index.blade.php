@extends('admin.layouts.admin')

@section('title', 'Event Rundown: ' . $event->title)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">{{ $event->title }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">Event Rundown</h1>
            <p class="text-muted mb-0">{{ $event->title }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.events.rundown.create', $event->id) }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Rundown Item
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Events
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-body">
            @if($rundowns->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Activity</th>
                                <th>Description</th>
                                <th>Person in Charge</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rundowns as $rundown)
                                <tr>
                                    <td>
                                        <strong>{{ $rundown->start_time->format('H:i') }}</strong> - 
                                        {{ $rundown->end_time->format('H:i') }}
                                    </td>
                                    <td>{{ $rundown->activity }}</td>
                                    <td>{{ Str::limit($rundown->description, 50) }}</td>
                                    <td>{{ $rundown->person_in_charge ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.events.rundown.edit', [$event->id, $rundown->id]) }}" 
                                                class="btn btn-sm btn-admin-outline-secondary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.events.rundown.destroy', [$event->id, $rundown->id]) }}" 
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-admin-outline-danger" 
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-4">No rundown items yet. <a href="{{ route('admin.events.rundown.create', $event->id) }}">Add one</a></p>
            @endif
        </div>
    </div>
@endsection

