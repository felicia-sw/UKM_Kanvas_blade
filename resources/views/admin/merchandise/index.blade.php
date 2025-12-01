@extends('admin.layouts.admin')

@section('title', 'Merchandise Management')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Merchandise Management</h1>
        <div>
            <a href="{{ route('admin.merchandise.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-lg me-2"></i>Add New Merchandise
            </a>
        </div>
    </div>
    <p class="text-muted mb-4">Manage your club's merchandise here.</p>

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($merchandiseItems as $item)
                            <tr>
                                <td><img src="{{ $item->image_path }}" alt="{{ $item->name }}" width="100"
                                        class="rounded"></td>
                                <td>{{ $item->name }}</td>
                                <td>IDR {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.merchandise.edit', $item->id) }}"
                                        class="btn btn-sm btn-admin-outline-warning me-1" title="Edit Merchandise">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.merchandise.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-admin-outline-danger"
                                            title="Delete Merchandise"
                                            onclick="return confirm('Are you sure you want to delete this merchandise?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                    <p class="text-muted">No merchandise items found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($merchandiseItems->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $merchandiseItems->links('vendor.pagination.bootstrap-5-admin') }}
                </div>
            @endif
        </div>
    </div>
@endsection
