@extends('admin.layouts.admin')

@section('title', 'Edit Merchandise')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.merchandise.index') }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Merchandise List
            </a>
        </div>
        <h1 class="h2 mb-0">Edit Merchandise: {{ $merchandise->name }}</h1>
        <div style="width: 200px;"></div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <form action="{{ route('admin.merchandise.update', $merchandise->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Merchandise Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $merchandise->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id" required>
                        <option value="">Select a category...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $merchandise->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price (IDR) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" value="{{ old('price', $merchandise->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        name="stock" value="{{ old('stock', $merchandise->stock) }}" min="0" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="4">{{ old('description', $merchandise->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Merchandise Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" accept="image/*">
                    <small class="form-text text-muted">Leave blank to keep current image. Accepted formats: JPG, PNG, GIF
                        (Max: 2MB)</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label">Current Image</label>
                    <div>
                        <img src="{{ $merchandise->image_path }}" alt="{{ $merchandise->name }}" class="img-thumbnail"
                            style="max-width: 300px;">
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-check-lg me-2"></i>Update Merchandise
                    </button>
                    <a href="{{ route('admin.merchandise.index') }}" class="btn btn-admin-outline-secondary">
                        <i class="bi bi-x-lg me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
    </form>
    </div>
    </div>
    </div>
@endsection
