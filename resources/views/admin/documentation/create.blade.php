@extends('admin.layouts.admin')

@section('title', 'Upload Media for: ' . $event->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Upload Media for Event: **{{ $event->title }}**</h1>
    {{-- Back button uses the nested index route --}}
    <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Documentation
    </a>
</div>

<div class="admin-card">
    <div class="card-body">
        {{-- Form action uses the nested 'store' route and requires the event ID. enctype is crucial for file uploads. --}}
        <form action="{{ route('admin.events.documentation.store', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title Field --}}
            <div class="mb-3">
                <label for="title" class="form-label">Media Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Media File Upload Field --}}
            <div class="mb-3">
                <label for="media_file" class="form-label">Select Photo File (Accepted formats: JPG, PNG. Max size: 10MB.) <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('media_file') is-invalid @enderror" id="media_file" name="media_file" required>
                <div class="form-text">Accepted formats: JPG, PNG. Max size: 10MB.</div>
                @error('media_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Caption Textarea --}}
            <div class="mb-3">
                <label for="caption" class="form-label">Caption (Optional)</label>
                <textarea class="form-control @error('caption') is-invalid @enderror" name="caption" id="caption" rows="3">{{ old('caption') }}</textarea>
                @error('caption')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Is Featured Checkbox --}}
            <div class="form-check mb-4">
                {{-- Defaults to unchecked (0) --}}
                <input class="form-check-input" type="checkbox" value="1" id="is_featured" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">
                    Mark as Featured (Highlights this media)
                </label>
            </div>
            <button type="submit" class="btn btn-admin-primary">
                <i class="bi bi-cloud-upload me-2"></i>Upload Media
            </button>
        </form>
    </div>
</div>
@endsection