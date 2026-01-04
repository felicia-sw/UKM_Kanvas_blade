@extends('admin.layouts.admin')

@section('title', 'Edit Event: ' . $event->title)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit: {{ $event->title }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Events List
            </a>
        </div>
        <h1 class="h2 mb-0">Edit Event: {{ $event->title }}</h1>
        <div style="width: 180px;"></div>
    </div>

    <div class="card admin-card">
        <div class="card-body">
            {{-- action points to the update route, uses PUT/PATCH method, and requires file enctype --}}
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                {{-- Title field --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title', $event->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description textarea --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="5" required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @php
                    // Format the dates for the input[type=datetime-local] (Y-m-d\TH:i)
                    $startDate = old(
                        'start_date',
                        $event->start_date ? $event->start_date->format('Y-m-d\TH:i') : null,
                    );
                    $endDate = old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : null);
                @endphp

                {{-- Start Date and Time field --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date & Time <span
                                class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                            id="start_date" name="start_date" value="{{ $startDate }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- End Date and Time field (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date & Time (Optional)</label>
                        <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror"
                            id="end_date" name="end_date" value="{{ $endDate }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Registration Deadline (Optional) --}}
                <div class="mb-3">
                    <label for="registration_deadline" class="form-label">Registration Deadline (Optional)</label>
                    <input type="date" class="form-control @error('registration_deadline') is-invalid @enderror"
                        id="registration_deadline" name="registration_deadline"
                        value="{{ old('registration_deadline', $event->registration_deadline ? $event->registration_deadline->format('Y-m-d') : null) }}">
                    @error('registration_deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    {{-- Price field (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Price (IDR) (Optional)</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            id="price" name="price" value="{{ old('price', $event->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Location field (Optional) --}}
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location / Type (Optional)</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location', $event->location) }}"
                            placeholder="e.g., Kampus A, Online">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Current Poster Preview --}}
                @if ($event->poster_image)
                    <div class="mb-3">
                        <label class="form-label">Current Event Poster</label>
                        <img src="{{ $event->poster_image }}" alt="Current Poster"
                            class="img-thumbnail" style="max-height: 150px;">
                    </div>
                @endif

                {{-- New Poster Image Upload Field (Optional) --}}
                <div class="mb-4">
                    <label for="poster_image" class="form-label">Upload New Event Poster (Optional)</label>
                    <input type="file" class="form-control @error('poster_image') is-invalid @enderror"
                        id="poster_image" name="poster_image">
                    <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB. Leave blank to keep current
                        image.</div>
                    @error('poster_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Is Active checkbox --}}
                <div class="form-check mb-4">
                    {{-- Uses $event->is_active for the default state --}}
                    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active"
                        {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Event is Active (Visible on public site)
                    </label>
                    @error('is_active')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-admin-primary">
                    <i class="bi bi-save me-2"></i>Update Event
                </button>
            </form>
        </div>
    </div>

@endsection
