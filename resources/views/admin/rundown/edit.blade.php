@extends('admin.layouts.admin')

@section('title', 'Edit Rundown Item: ' . $event->title)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.rundown.index', $event->id) }}">Rundown</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Edit Rundown Item</h1>
        <a href="{{ route('admin.events.rundown.index', $event->id) }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <form action="{{ route('admin.events.rundown.update', [$event->id, $rundown->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" 
                            id="start_time" name="start_time" 
                            value="{{ old('start_time', $rundown->start_time->format('Y-m-d\TH:i')) }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="end_time" class="form-label">End Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" 
                            id="end_time" name="end_time" 
                            value="{{ old('end_time', $rundown->end_time->format('Y-m-d\TH:i')) }}" required>
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="activity" class="form-label">Activity <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('activity') is-invalid @enderror" 
                        id="activity" name="activity" value="{{ old('activity', $rundown->activity) }}" required>
                    @error('activity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="3">{{ old('description', $rundown->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="person_in_charge" class="form-label">Person in Charge (Optional)</label>
                    <input type="text" class="form-control @error('person_in_charge') is-invalid @enderror" 
                        id="person_in_charge" name="person_in_charge" value="{{ old('person_in_charge', $rundown->person_in_charge) }}">
                    @error('person_in_charge')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Update Rundown Item
                </button>
            </form>
        </div>
    </div>
@endsection

