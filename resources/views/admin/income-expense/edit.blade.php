@extends('admin.layouts.admin')

@section('title', 'Edit ' . ucfirst($incomeExpense->type) . ' - ' . $event->title)

@section('content')
    <div class="container-fluid py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.finances.recap', $event->id) }}">Financial
                        Recap</a></li>
                <li class="breadcrumb-item active">Edit {{ ucfirst($incomeExpense->type) }}</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('admin.events.finances.recap', $event->id) }}" class="btn btn-admin-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Financial Recap
                </a>
            </div>
            <h1 class="h2 mb-0">Edit {{ ucfirst($incomeExpense->type) }}: {{ $incomeExpense->item_name }}</h1>
            <div style="width: 200px;"></div>
        </div>

        <div class="card admin-card">
            <div class="card-body">
                <form action="{{ route('admin.events.finances.update', [$event->id, $incomeExpense->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                                id="item_name" name="item_name" value="{{ old('item_name', $incomeExpense->item_name) }}"
                                placeholder="e.g., Sponsorship, Equipment, Venue, etc." required>
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price', $incomeExpense->price) }}" min="0"
                                step="0.01" placeholder="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" value="{{ old('quantity', $incomeExpense->quantity) }}"
                                min="1" placeholder="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit"
                            class="btn {{ $incomeExpense->type === 'income' ? 'btn-success' : 'btn-danger' }}">
                            <i class="bi bi-check-circle me-2"></i>Update {{ ucfirst($incomeExpense->type) }}
                        </button>
                        <a href="{{ route('admin.events.finances.recap', $event->id) }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
