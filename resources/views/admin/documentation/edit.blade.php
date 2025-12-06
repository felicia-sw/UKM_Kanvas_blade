@extends('admin.layouts.admin')

@section('title', 'Edit Media for: ' . $event->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Documentation
            </a>
        </div>
        <h1 class="h2 mb-0">Edit Media: {{ $documentation->title }}</h1>
        <div style="width: 180px;"></div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            {{-- Form action uses the nested 'update' route and requires both event and documentation IDs. --}}
            <form
                action="{{ route('admin.events.documentation.update', ['event' => $event->id, 'documentation' => $documentation->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Required to tell Laravel to use the update() method --}}

                {{-- Title Field --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Media Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $documentation->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- File Type Field --}}
                <div class="mb-3">
                    <label for="file_type" class="form-label">File Type <span class="text-danger">*</span></label>
                    <select class="form-control @error('file_type') is-invalid @enderror" id="file_type"
                        name="file_type" required>
                        <option value="image" {{ old('file_type', $documentation->file_type) == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="video" {{ old('file_type', $documentation->file_type) == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                    @error('file_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Caption Field --}}
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption (Optional)</label>
                    <textarea class="form-control @error('caption') is-invalid @enderror" id="caption"
                        name="caption" rows="3" placeholder="Add a caption for this media...">{{ old('caption', $documentation->caption) }}</textarea>
                    @error('caption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Media Preview --}}
                <div class="mb-3">
                    <label class="form-label">Current Media</label>
                    @if($documentation->file_type == 'video')
                        <video src="{{ asset('storage/' . $documentation->file_path) }}" controls class="img-thumbnail" style="max-height: 200px;"></video>
                    @else
                        <img src="{{ asset('storage/' . $documentation->file_path) }}" alt="Current Media" class="img-thumbnail"
                            style="max-height: 200px;">
                    @endif
                </div>

                {{-- Media File Upload Field (Optional) --}}
                <div class="mb-4">
                    <label for="media_file" class="form-label">Replace Media (Optional)</label>
                    <input type="file" class="form-control @error('media_file') is-invalid @enderror" id="media_file"
                        name="media_file" accept="image/*,video/*">
                    <div class="form-text">Leave blank to keep current file. Accepted formats: JPG, PNG (images) or MP4, MOV, AVI (videos). Max 10MB.</div>
                    @error('media_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Update Media
                </button>
            </form>
        </div>
    </div>
@endsection
