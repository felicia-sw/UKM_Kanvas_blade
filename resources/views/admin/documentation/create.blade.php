@extends('admin.layouts.admin')

@section('title', 'Upload Media for: ' . $event->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.events.documentation.index', $event->id) }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Documentation
            </a>
        </div>
        <h1 class="h2 mb-0">Upload Media for: {{ $event->title }}</h1>
        <div style="width: 180px;"></div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            {{-- Form action uses the nested 'store' route and requires the event ID. enctype is crucial for file uploads. --}}
            <form action="{{ route('admin.events.documentation.store', $event->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                {{-- Title Field --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Media Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Media File Upload Field --}}
                <div class="mb-4">
                    <label for="media_file" class="form-label">Select Photo File <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('media_file') is-invalid @enderror" id="media_file"
                        name="media_file" required>
                    <div class="form-text">Accepted formats: JPG, PNG. Max size: 10MB.</div>
                    @error('media_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-cloud-upload me-2"></i>Upload Media
                </button>
            </form>
        </div>
    </div>
@endsection
