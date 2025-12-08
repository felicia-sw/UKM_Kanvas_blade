@extends('admin.layouts.admin')

@section('title', 'Edit Dues Period: ' . $duesPeriod->name)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dues.index') }}">Dues Periods</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Edit Dues Period</h1>
        <a href="{{ route('admin.dues.index') }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <form action="{{ route('admin.dues.update', $duesPeriod->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Period Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        id="name" name="name" value="{{ old('name', $duesPeriod->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount (IDR) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" 
                        id="amount" name="amount" value="{{ old('amount', $duesPeriod->amount) }}" min="0" required>
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                        id="due_date" name="due_date" value="{{ old('due_date', $duesPeriod->due_date ? $duesPeriod->due_date->format('Y-m-d') : '') }}" required>
                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3">{{ old('description', $duesPeriod->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Update Dues Period
                </button>
            </form>
        </div>
    </div>
@endsection

