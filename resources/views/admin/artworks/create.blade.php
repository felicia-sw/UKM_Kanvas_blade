@extends('admin.layouts.admin')

@section('title', 'Add New Artwork')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.artworks.index') }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Artworks List
            </a>
        </div>
        <h1 class="h2 mb-0">Add New Artwork</h1>
        <div style="width: 180px;"></div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            {{-- important: enctype for file uploads --}}
            <form action="{{ route('admin.artworks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- title field --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Artwork Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- artist name field --}}
                <div class="mb-3">
                    <label for="artist_name" class="form-label">Artist Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('artist_name') is-invalid @enderror" id="artist_name"
                        name="artist_name" value="{{ old('artist_name') }}" required>
                    @error('artist_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- category dropdown --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                        id="category_id" required>
                        <option value="">Select Category</option>
                        {{-- loop through the catgories passed from the controller's create() method --}}
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- description textarea --}}
                <div>
                    <label for="description" class="form-label">Description (optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="4">
                {{ old('description') }}
            </textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Image upload field --}}
                <div class="mb-4">
                    <label for="image_path" class="form-label">Artwork Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path"
                        name="image_path" required>
                    <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB.</div>
                    @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Save Artwork
                </button>
            </form>
        </div>
    </div>
@endsection
