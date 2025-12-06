@extends('admin.layouts.admin')

@section('title', 'Create New Dues Period')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dues.index') }}">Dues Periods</a></li>
            <li class="breadcrumb-item active">Create New</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Create New Dues Period</h1>
        <a href="{{ route('admin.dues.index') }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <form action="{{ route('admin.dues.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Period Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name') }}" 
                        placeholder="e.g., January 2025" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount (IDR) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                        id="amount" name="amount" value="{{ old('amount') }}" min="0" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                        id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-check-circle me-2"></i>Create Dues Period
                </button>
            </form>
        </div>
    </div>
@endsection

