@extends('admin.layouts.admin')

@section('title', 'Documentation for: ' . $event->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Documentation for: **{{ $event->title }}**</h1>
    <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Events List
    </a>
</div>

<div class="mb-3">
    <a href="{{ route('admin.events.documentation.create', $event->id) }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Upload Media
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
                        <th scope="col">Upload Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documentations as $documentation)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $documentation->title }}</td>
                            <td>{{ $documentation->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.events.documentation.edit', ['event' => $event->id, 'documentation' => $documentation->id]) }}" class="btn btn-sm btn-admin-outline-warning me-1">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                
                                <form action="{{ route('admin.events.documentation.destroy', ['event' => $event->id, 'documentation' => $documentation->id]) }}" method="POST" class="d-inline">
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
                            <td colspan="6" class="text-center">No documentation media has been uploaded for this event yet.</td>
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