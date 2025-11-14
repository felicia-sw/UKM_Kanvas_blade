@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Merchandise</h1>
    <p class="mb-4">Manage your club's merchandise here.</p>

    <a href="{{ route('admin.merchandise.create') }}" class="btn btn-primary btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add New Merchandise</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Merchandise</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <td><img src="{{ $item->image_path }}" alt="{{ $item->name }}" width="100"></td>
                            <td>{{ $item->name }}</td>
                            <td>IDR {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.merchandise.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.merchandise.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No merchandise items found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $merchandiseItems->links('vendor.pagination.bootstrap-5-admin') }}
            </div>
        </div>
    </div>
</div>
@endsection