@extends('admin.layouts.admin')

@section('title', 'Add New Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2">Add New Event</h1>
    <a href="{{ route('admin.events.index')}}" class="btn btn-admin-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to Events List
    </a>
</div>

<div class="admin-card">
    <div class="card-body">
        
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title field --}}
        <div class="mb-3">
            <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description textarea --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- Date and Time Fields --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_date" class="form-label">Start Date & Time <span class="text-danger">*</span></label>
                {{-- datetime-local provides Y-m-d\TH:i format required by controller validation --}}
                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="end_date" class="form-label">End Date & Time (Optional)</label>
                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Registration Deadline (Optional) --}}
        <div class="mb-3">
            <label for="registration_deadline" class="form-label">Registration Deadline (Optional)</label>
            <input type="date" class="form-control @error('registration_deadline') is-invalid @enderror" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}">
            @error('registration_deadline')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="row">
            {{-- Price field (Optional) --}}
            <div class="col-md-4 mb-3">
                <label for="price" class="form-label">Price (IDR) (Optional)</label>
                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', 0) }}">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Max Participants field (Optional) --}}
            <div class="col-md-4 mb-3">
                <label for="max_participants" class="form-label">Max Participants (Optional)</label>
                <input type="number" class="form-control @error('max_participants') is-invalid @enderror" id="max_participants" name="max_participants" value="{{ old('max_participants') }}">
                @error('max_participants')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            {{-- Location field (Optional) --}}
            <div class="col-md-4 mb-3">
                <label for="location" class="form-label">Location / Type (Optional)</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="e.g., Kampus A, Online">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Multiple Days Checkbox --}}
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="has_multiple_days" name="has_multiple_days" value="1" {{ old('has_multiple_days') ? 'checked' : '' }} onchange="toggleMultipleDaysPricing()">
            <label class="form-check-label" for="has_multiple_days">
                Event has multiple days (Day 1, Day 2, or Both)
            </label>
        </div>

        {{-- Multiple Days Pricing (Hidden by default) --}}
        <div id="multipleDaysPricing" style="display: {{ old('has_multiple_days') ? 'block' : 'none' }};">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="day_1_price" class="form-label">Day 1 Price (IDR)</label>
                    <input type="number" step="0.01" class="form-control @error('day_1_price') is-invalid @enderror" id="day_1_price" name="day_1_price" value="{{ old('day_1_price', 0) }}">
                    @error('day_1_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="day_2_price" class="form-label">Day 2 Price (IDR)</label>
                    <input type="number" step="0.01" class="form-control @error('day_2_price') is-invalid @enderror" id="day_2_price" name="day_2_price" value="{{ old('day_2_price', 0) }}">
                    @error('day_2_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="both_days_price" class="form-label">Both Days Price (IDR)</label>
                    <input type="number" step="0.01" class="form-control @error('both_days_price') is-invalid @enderror" id="both_days_price" name="both_days_price" value="{{ old('both_days_price', 0) }}">
                    @error('both_days_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Poster Image upload field --}}
        <div class="mb-4">
            <label for="poster_image" class="form-label">Event Poster Image <span class="text-danger">*</span></label>
            <input type="file" class="form-control @error('poster_image') is-invalid @enderror" id="poster_image" name="poster_image" required>
            <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB.</div>
            @error('poster_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- Is Active checkbox --}}
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" {{ old('is_active', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">
                Event is Active (Visible on public site)
            </label>
            @error('is_active')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-admin-primary">
            <i class="bi bi-calendar-plus me-2"></i>Create Event
        </button>
        </form>
    </div>
</div>

<script>
function toggleMultipleDaysPricing() {
    const checkbox = document.getElementById('has_multiple_days');
    const pricingDiv = document.getElementById('multipleDaysPricing');
    pricingDiv.style.display = checkbox.checked ? 'block' : 'none';
}
</script>
@endsection