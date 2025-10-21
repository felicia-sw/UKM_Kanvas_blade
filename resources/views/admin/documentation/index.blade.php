@extends('admin.layouts.admin')

@section('title', 'Documentation Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Documentation Management</h1>
    <div>
        {{-- <a href="#" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Add Documentation</a> --}}
         {{-- Add button later --}}
    </div>
</div>
<p class="text-muted mb-4">Manage event documentation photos.</p>

<div class="card admin-card">
    <div class="card-header">
        Documentation List
        {{-- Optional Filter --}}
        {{-- <form method="GET" action="{{ route('admin.documentation.index') }}" class="d-inline-block ms-3">
             <select name="event_id" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                 <option value="">All Events</option>
                 @foreach($events as $event)
                     <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                         {{ $event->title }}
                     </option>
                 @endforeach
             </select>
        </form> --}}
    </div>
    <div class="card-body">
        <div class="row g-3">
            @forelse($documentations as $doc)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card admin-card h-100 documentation-card">
                         {{-- Placeholder or actual image --}}
                         <img src="{{ asset('images/gallery/artwork' . (($loop->index % 6) + 1) . '.jpg') }}" class="card-img-top documentation-image" alt="{{ $doc->title ?? 'Documentation' }}">
                         {{-- <img src="{{ asset('storage/' . $doc->image_path) }}" class="card-img-top documentation-image" alt="{{ $doc->title ?? 'Documentation' }}"> --}}
                        <div class="card-body">
                            <h6 class="card-title mb-1">{{ $doc->title ?? 'Untitled' }}</h6>
                            <p class="card-text text-muted small mb-2">Event: {{ $doc->event->title ?? 'N/A' }}</p>
                             <div class="mt-auto d-flex justify-content-end">
                                {{-- Add Edit/Delete buttons later --}}
                                <button class="btn btn-sm btn-admin-outline-warning me-1 disabled"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-admin-outline-danger disabled"><i class="bi bi-trash"></i></button>
                             </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No documentation found.</p>
                </div>
            @endforelse
        </div>

         <div class="d-flex justify-content-center mt-4">
             {{ $documentations->appends(request()->query())->links('vendor.pagination.bootstrap-5-admin') }}
         </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .documentation-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .documentation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .documentation-image {
        height: 180px;
        object-fit: cover;
    }
</style>
@endpush