@extends('admin.layouts.admin')

@section('title', 'Art Gallery Management')

@section('content')
{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Art Gallery Management</h1>
    <div>
        <a href="{{ route('admin.artworks.create') }}" class="btn btn-admin-primary">
            <i class="bi bi-plus-lg me-2"></i>Add New Artwork
        </a>
    </div>
</div>
<p class="text-muted mb-4">Manage artworks displayed in the gallery.</p>

{{-- Search and Filter Bar --}}
<div class="card admin-card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.artworks.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search" 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-admin-primary w-100">
                    <i class="bi bi-search me-2"></i>Search
                </button>
            </div>
            @if(request('search') || request('category'))
            <div class="col-12">
                <a href="{{ route('admin.artworks.index') }}" class="btn btn-admin-secondary">
                </a>    
            </div>
            @endif
        </form>
    </div>
</div>

<div class="card admin-card">
    <div class="card-header">
       Artwork List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover admin-table">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Category</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($artworks as $artwork)
                    <tr>
                        <td>
                            <img src="{{ $artwork->image_path }}" alt="{{ $artwork->title }}" width="60" height="40" style="object-fit: cover; border-radius: 4px;">
                        </td>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->artist_name }}</td>
                        <td>{{ $artwork->category->name ?? 'N/A' }}</td>
                        <td>{{ $artwork->created_date->format('d M Y') }}</td>
                        <td>
                            {{-- edit button --}}
                            <a href="{{ route('admin.artworks.edit', $artwork->id)}}" class="btn btn-sm btn-admin-outline-warning me-1" title="Edit Artwork">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- <button class="btn btn-sm btn-admin-outline-warning me-1 disabled"><i class="bi bi-pencil"></i></button> --}}
                            <form action="{{ route('admin.artworks.destroy', $artwork->id)}}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-admin-outline-danger" title="Delete Artwork" onclick="return confirm('Are you sure you want to delete this artwork titled \'{{ $artwork->title }}\'?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No artworks found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

         <div class="d-flex justify-content-center mt-4">
             {{ $artworks->appends(request()->query())->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>
@endsection