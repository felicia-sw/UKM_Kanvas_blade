@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <!-- Event Details -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <!-- Event Header -->
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 mb-4 backdrop-blur">
                    <div class="row">
                        <div class="col-md-4 mb-4 mb-md-0">
                            @if($event->poster_image)
                                <img src="{{ Storage::url($event->poster_image) }}" alt="{{ $event->title }}" class="img-fluid rounded-3 shadow-lg w-100">
                            @else
                                <div class="bg-secondary rounded-3 d-flex align-items-center justify-content-center" style="height: 300px;">
                                    <i class="bi bi-image fs-1 text-white-50"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h1 class="display-4 fw-bold mb-3">{{ $event->title }}</h1>
                            
                            <div class="mb-3">
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                    @if($event->isPastEvent())
                                        <i class="bi bi-calendar-check"></i> Past Event
                                    @else
                                        <i class="bi bi-calendar-event"></i> Upcoming Event
                                    @endif
                                </span>
                            </div>

                            <div class="event-info mb-4">
                                <p class="mb-2"><i class="bi bi-calendar3 me-2"></i><strong>Start:</strong> {{ $event->start_date->format('d M Y, H:i') }}</p>
                                @if($event->end_date)
                                <p class="mb-2"><i class="bi bi-calendar3 me-2"></i><strong>End:</strong> {{ $event->end_date->format('d M Y, H:i') }}</p>
                                @endif
                                @if($event->location)
                                <p class="mb-2"><i class="bi bi-geo-alt me-2"></i><strong>Location:</strong> {{ $event->location }}</p>
                                @endif
                                @if($event->registration_deadline)
                                <p class="mb-2"><i class="bi bi-clock me-2"></i><strong>Registration Deadline:</strong> {{ $event->registration_deadline->format('d M Y') }}</p>
                                @endif
                                @if($event->price)
                                <p class="mb-2"><i class="bi bi-tag me-2"></i><strong>Price:</strong> Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                @endif
                                @if($event->max_participants)
                                <p class="mb-2"><i class="bi bi-people me-2"></i><strong>Max Participants:</strong> {{ $event->max_participants }}</p>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 flex-wrap">
                                @if($event->isPastEvent())
                                    <a href="{{ route('events.documentation', $event->id) }}" class="btn btn-warning btn-lg px-4">
                                        <i class="bi bi-images me-2"></i>View Event Documentation
                                    </a>
                                @else
                                    @auth
                                        @if(isset($userRegistration))
                                            {{-- User already registered --}}
                                            <div class="alert alert-info mb-0 me-2">
                                                <i class="bi bi-check-circle me-2"></i>
                                                <strong>You're registered!</strong>
                                                <div class="mt-2">
                                                    <small>
                                                        Status: 
                                                        @if($userRegistration->payment_status === 'verified')
                                                            <span class="badge bg-success">Verified</span>
                                                        @elseif($userRegistration->payment_status === 'rejected')
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">Pending Verification</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        @elseif($event->canRegister())
                                            <button onclick="openRegistrationModal()" class="btn btn-success btn-lg px-4">
                                                <i class="bi bi-pencil-square me-2"></i>Register Now
                                            </button>
                                        @else
                                            <button disabled class="btn btn-secondary btn-lg px-4">
                                                <i class="bi bi-x-circle me-2"></i>Registration Closed
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login.form') }}" class="btn btn-success btn-lg px-4">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Register
                                        </a>
                                    @endauth
                                @endif
                                
                                <a href="{{ route('events') }}" class="btn btn-outline-light btn-lg px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Events
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Description -->
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <h2 class="h3 fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>About This Event</h2>
                    <p class="fs-5 text-white-50">{{ $event->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Registration Modal -->
@auth
@if($event->canRegister() && !isset($userRegistration))
<div id="registrationModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h2 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Event Registration</h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('events.register', $event) }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                    @csrf
                    
                    <!-- Name (Pre-filled) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" disabled class="form-control bg-secondary text-white">
                    </div>

                    <!-- Email (Pre-filled) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" value="{{ auth()->user()->email }}" disabled class="form-control bg-secondary text-white">
                    </div>

                    <!-- NIM -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim" required class="form-control" value="{{ old('nim') }}">
                    </div>

                    <!-- Jurusan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                        <input type="text" name="jurusan" required class="form-control" value="{{ old('jurusan') }}">
                    </div>

                    <!-- Asal Universitas -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Asal Universitas <span class="text-danger">*</span></label>
                        <input type="text" name="asal_universitas" required class="form-control" value="{{ old('asal_universitas') }}">
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="tel" name="nomor_telp" required class="form-control" value="{{ old('nomor_telp') }}">
                    </div>

                    <!-- Kanvas Member -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_kanvas_member" value="0">
                            <input type="checkbox" name="is_kanvas_member" value="1" class="form-check-input" id="kanvasMember" {{ old('is_kanvas_member') ? 'checked' : '' }}>
                            <label class="form-check-label" for="kanvasMember">
                                I am a Kanvas member
                            </label>
                        </div>
                    </div>

                    <!-- Days Selection (if multiple days) -->
                    @if($event->has_multiple_days)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Days <span class="text-danger">*</span></label>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input type="radio" name="days_attending" value="day_1" required class="form-check-input" id="day1" {{ old('days_attending') == 'day_1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="day1">
                                    Day 1 - Rp {{ number_format($event->day_1_price, 0, ',', '.') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="days_attending" value="day_2" required class="form-check-input" id="day2" {{ old('days_attending') == 'day_2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="day2">
                                    Day 2 - Rp {{ number_format($event->day_2_price, 0, ',', '.') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="days_attending" value="both" required class="form-check-input" id="both" {{ old('days_attending') == 'both' ? 'checked' : '' }}>
                                <label class="form-check-label" for="both">
                                    Both Days - Rp {{ number_format($event->both_days_price, 0, ',', '.') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Payment Gateway Link -->
                    <div class="alert alert-info mb-3">
                        <h6 class="alert-heading"><i class="bi bi-credit-card me-2"></i>Payment Instructions</h6>
                        <p class="mb-2">Please complete payment first through our payment gateway:</p>
                        <a href="https://forms.google.com/your-payment-form" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Proceed to Payment
                        </a>
                        <small class="d-block mt-2 text-muted">After payment, upload your proof below</small>
                    </div>

                    <!-- Upload Payment Proof -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Payment Proof <span class="text-danger">*</span></label>
                        <input type="file" name="payment_proof" accept="image/*" required class="form-control">
                        <small class="form-text text-muted">Accepted formats: JPG, PNG (Max: 2MB)</small>
                    </div>

                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endauth

<style>
body {
    background: #2A0A56 !important;
}

.page-bg-image {
    background-image: url('{{ asset("images/bg1.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
}

.page-bg-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, 
        rgba(255, 236, 119, 0.85) 0%, 
        rgba(255, 217, 107, 0.85) 15%,
        rgba(255, 192, 95, 0.85) 25%,
        rgba(232, 160, 85, 0.85) 35%,
        rgba(199, 130, 78, 0.85) 45%,
        rgba(143, 72, 152, 0.85) 60%,
        rgba(106, 53, 116, 0.85) 75%,
        rgba(71, 35, 96, 0.85) 85%,
        rgba(42, 10, 86, 0.9) 100%);
    z-index: 0;
}

.page-bg-image > * {
    position: relative;
    z-index: 1;
}

.backdrop-blur {
    backdrop-filter: blur(10px);
}

.modal-content {
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #FFEC77;
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(255, 236, 119, 0.25);
}

.form-control:disabled {
    background-color: rgba(108, 117, 125, 0.3);
}
</style>

<script>
function openRegistrationModal() {
    const modal = new bootstrap.Modal(document.getElementById('registrationModal'));
    modal.show();
}

// Auto-open modal if there are validation errors
@if($errors->any() && !$event->isPastEvent())
    document.addEventListener('DOMContentLoaded', function() {
        openRegistrationModal();
    });
@endif
</script>
@endsection
