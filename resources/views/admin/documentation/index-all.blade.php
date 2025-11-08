// felicia-sw/ukm_kanvas_blade/UKM_Kanvas_blade-0b53f92b2505becaae0fa1f79d6eaecf074212d4/resources/views/admin/documentation/index-all.blade.php

@extends('admin.layouts.admin')

@section('title', 'All Documentation Media')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">All Documentation Media</h1>
    {{-- Button to remind the user where to add new media --}}
    <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-calendar-event me-2"></i>Manage & Upload Media by Event
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="admin-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Event</th> {{-- New Column to show the parent event --}}
                        <th scope="col">Media Type</th>
                        <th scope="col">Featured</th>
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
                            <td>
                                <span class="badge bg-{{ $documentation->file_type == 'photo' ? 'info' : 'secondary' }}">
                                    {{ ucfirst($documentation->file_type) }}
                                </span>
                            </td>
                            <td>
                                @if($documentation->is_featured)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @else
                                    <i class="bi bi-x-circle-fill text-danger"></i>
                                @endif
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
            {{ $documentations->links('vendor.pagination.bootstrap-5-admin') }}
        </div>
    </div>
</div>
@endsection