@extends('admin.layouts.admin')

@section('title', 'Add ' . ucfirst($type) . ' - ' . $event->title)

@section('content')
    <div class="container-fluid py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.events.finances.recap', $event->id) }}">Financial
                        Recap</a></li>
                <li class="breadcrumb-item active">Add {{ ucfirst($type) }}</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('admin.events.finances.recap', $event->id) }}" class="btn btn-admin-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Financial Recap
                </a>
            </div>
            <h1 class="h2 mb-0">Add {{ ucfirst($type) }} - {{ $event->title }}</h1>
            <div style="width: 200px;"></div>
        </div>

        <div class="card admin-card">
            <div class="card-body">
                <form action="{{ route('admin.events.finances.store', $event->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('item_name') is-invalid @enderror"
                                id="item_name" name="item_name" value="{{ old('item_name') }}"
                                placeholder="e.g., Sponsorship, Equipment, Venue, etc." required>
                            @error('item_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label">Amount (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                                name="amount" value="{{ old('amount') }}" min="0" step="0.01" placeholder="0"
                                required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Transaction Date <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('transaction_date') is-invalid @enderror"
                            id="transaction_date" name="transaction_date"
                            value="{{ old('transaction_date', date('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="4" placeholder="Add any additional details about this {{ $type }}...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn {{ $type === 'income' ? 'btn-success' : 'btn-danger' }}">
                            <i class="bi bi-check-circle me-2"></i>Add {{ ucfirst($type) }}
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
