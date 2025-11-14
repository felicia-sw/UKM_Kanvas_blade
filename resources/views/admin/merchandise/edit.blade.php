@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Edit Merchandise: {{ $merchandise->name }}</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.merchandise.update', $merchandise->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $merchandise->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="price">Price (IDR)</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $merchandise->price) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $merchandise->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-text text-muted">Leave blank to keep current image.</small>
                    <img src="{{ $merchandise->image_path }}" alt="{{ $merchandise->name }}" width="150" class="mt-2">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection