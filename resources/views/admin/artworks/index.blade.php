@extends('admin.layouts.admin')

@section('title', 'Art Gallery Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Art Gallery & Documentation</h1>
    <div>
        {{-- <a href="#" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Add New Artwork</a> --}}
        {{-- Add button later --}}
    </div>
</div>
<p class="text-muted mb-4">Manage artworks displayed in the gallery.</p>

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
                            <img src="{{ asset($artwork->image_path) }}" alt="{{ $artwork->title }}" width="60" height="40" style="object-fit: cover; border-radius: 4px;">
                        </td>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->artist_name }}</td>
                        <td>{{ $artwork->category->name ?? 'N/A' }}</td>
                        <td>{{ $artwork->created_date->format('d M Y') }}</td>
                        <td>
                            {{-- Add Edit/Delete buttons later --}}
                            <button class="btn btn-sm btn-admin-outline-warning me-1 disabled"><i class="bi bi-pencil"></i></button>
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
             {{ $artworks->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>
@endsection