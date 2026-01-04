@extends('admin.layouts.admin')

@section('title', 'Edit Artwork: ' . $artwork->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.artworks.index') }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Artwork List
            </a>
        </div>
        <h1 class="h2 mb-0">Edit Artwork: {{ $artwork->title }}</h1>
        <div style="width: 180px;"></div>
    </div>

    <div class="card admin-card">
        <div class="card-body">
            {{-- action points to the update route and includes PUT/PATCH method and file enctype --}}
            <form action="{{ route('admin.artworks.update', $artwork->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- title field --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Artwork Title <span class="text-danger">*</span></label>
                    {{-- Value uses old() for validation errors, falling back to the existing artwork data --}}
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $artwork->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Artist Name Field --}}
                <div class="mb-3">
                    <label for="artist_name" class="form-label">Artist Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name"
                        name="artist_name" value="{{ old('artist_name', $artwork->artist_name) }}" required>
                    @error('artist_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category Dropdown --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description Textarea --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="4">{{ old('description', $artwork->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Current Image Preview --}}
                <div class="mb-3">
                    <label class="form-label">Current Artwork Image</label>
                    <img src="{{ $artwork->image_path }}" alt="Current Image" class="img-thumbnail"
                        style="max-height: 150px;">
                </div>

                {{-- New Image Upload Field (Optional) --}}
                <div class="mb-4">
                    <label for="image_path" class="form-label">Upload New Artwork Image (Optional)</label>
                    <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path"
                        name="image_path">
                    <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 20MB. Leave blank to keep current
                        image.</div>
                    @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Update Artwork
                </button>
            </form>
        </div>
    </div>
@endsection
