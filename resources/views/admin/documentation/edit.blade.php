@extends('admin.layouts.admin')

@section('title', 'Edit Media for: ' . $event->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Edit Media: **{{ $documentation->title }}** (Event: {{ $event->title }})</h1>
    <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Documentation
    </a>
</div>

<div class="admin-card">
    <div class="card-body">
        {{-- Form action uses the nested 'update' route and requires both event and documentation IDs. --}}
        <form action="{{ route('admin.events.documentation.update', ['event' => $event->id, 'documentation' => $documentation->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Required to tell Laravel to use the update() method --}}

            {{-- Title Field --}}
            <div class="mb-3">
                <label for="title" class="form-label">Media Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
                       value="{{ old('title', $documentation->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Current Media Preview --}}
            <div class="mb-3">
                <label class="form-label">Current Media</label>
                @if ($documentation->file_type == 'photo')
                    <img src="{{ asset($documentation->file_path) }}" alt="Current Photo" class="img-thumbnail" style="max-height: 200px;">
                @elseif ($documentation->file_type == 'video')
                    <video controls src="{{ asset($documentation->file_path) }}" class="img-thumbnail" style="max-height: 200px;">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>

            {{-- Media File Upload Field (Optional) --}}
            <div class="mb-3">
                <label for="media_file" class="form-label">Replace Media File (Optional)</label>
                <input type="file" class="form-control @error('media_file') is-invalid @enderror" id="media_file" name="media_file">
                <div class="form-text">Leave blank to keep current file. Accepted formats: JPG, PNG, MP4, MOV. Max 50MB.</div>
                @error('media_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Media Type (Photo/Video) Radio Buttons --}}
            <div class="mb-4">
                <label class="form-label d-block">Media Type <span class="text-danger">*</span></label>
                @php $currentType = old('type', $documentation->file_type); @endphp
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="type_photo_edit" value="photo" {{ $currentType == 'photo' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="type_photo_edit">Photo</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="type_video_edit" value="video" {{ $currentType == 'video' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="type_video_edit">Video</label>
                </div>
                @error('type')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            {{-- Caption Textarea --}}
            <div class="mb-3">
                <label for="caption" class="form-label">Caption (Optional)</label>
                <textarea class="form-control @error('caption') is-invalid @enderror" name="caption" id="caption" rows="3">{{ old('caption', $documentation->caption) }}</textarea>
                @error('caption')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Is Featured Checkbox --}}
            <div class="form-check mb-4">
                {{-- Uses the existing database value for default state --}}
                <input class="form-check-input" type="checkbox" value="1" id="is_featured_edit" name="is_featured" {{ old('is_featured', $documentation->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured_edit">
                    Mark as Featured (Highlights this media)
                </label>
            </div>

            <button type="submit" class="btn btn-admin-primary">
                <i class="bi bi-save me-2"></i>Update Media
            </button>
        </form>
    </div>
</div>
@endsection