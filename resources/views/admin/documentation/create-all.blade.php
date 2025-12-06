@extends('admin.layouts.admin')

@section('title', 'Add New Documentation Photo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Add New Documentation Photo (Global)</h1>
    <a href="{{ route('admin.documentation.index.all') }}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to All Photos
    </a>
</div>

<div class="admin-card">
    <div class="card-body">
        <form action="{{ route('admin.documentation.store.all') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Event Selection Dropdown (NEW) --}}
            <div class="mb-3">
                <label for="event_id" class="form-label">Link to Event <span class="text-danger">*</span></label>
                <select class="form-select @error('event_id') is-invalid @enderror" id="event_id" name="event_id" required>
                    <option value="" selected disabled>Select an Event</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                            {{ $event->title }} ({{ $event->start_date->format('Y') }})
                        </option>
                    @endforeach
                </select>
                @error('event_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Title Field --}}
            <div class="mb-3">
                <label for="title" class="form-label">Media Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- File Type Field --}}
            <div class="mb-3">
                <label for="file_type" class="form-label">File Type <span class="text-danger">*</span></label>
                <select class="form-control @error('file_type') is-invalid @enderror" id="file_type"
                    name="file_type" required>
                    <option value="">Select file type...</option>
                    <option value="image" {{ old('file_type') == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ old('file_type') == 'video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('file_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Caption Field --}}
            <div class="mb-3">
                <label for="caption" class="form-label">Caption (Optional)</label>
                <textarea class="form-control @error('caption') is-invalid @enderror" id="caption"
                    name="caption" rows="3" placeholder="Add a caption for this media...">{{ old('caption') }}</textarea>
                @error('caption')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Media File Upload Field --}}
            <div class="mb-4">
                <label for="media_file" class="form-label">Select Media File <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('media_file') is-invalid @enderror" id="media_file" name="media_file" accept="image/*,video/*" required>
                <div class="form-text">Accepted formats: JPG, PNG (images) or MP4, MOV, AVI (videos). Max size: 10MB.</div>
                @error('media_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-admin-primary">
                <i class="bi bi-upload me-2"></i>Upload Photo
            </button>
        </form>
    </div>
</div>
@endsection