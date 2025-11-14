@extends('admin.layouts.admin')

@section('title', 'Event Registrations - ' . $event->title)

@section('content')
<div class="container-fluid py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">{{ $event->title }} - Registrations</li>
        </ol>
    </nav>

    <!-- Event Info Header -->
    <div class="card mb-4">
        <div class="card-body">
            <h1 class="h3 mb-3">{{ $event->title }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Date:</strong> {{ $event->start_date->format('d M Y, H:i') }}</p>
                    <p class="mb-1"><strong>Location:</strong> {{ $event->location ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Price:</strong> Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    <p class="mb-1"><strong>Max Participants:</strong> {{ $event->max_participants ?? 'Unlimited' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Registrations</h6>
                            <h2 class="mb-0">{{ $event->registrations->count() }}</h2>
                        </div>
                        <div class="text-primary">
                            <i class="bi bi-people fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Verified Participants</h6>
                            <h2 class="mb-0">{{ $event->getVerifiedParticipantsCount() }}</h2>
                        </div>
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Pending Verification</h6>
                            <h2 class="mb-0">{{ $event->registrations()->where('payment_status', 'pending')->count() }}</h2>
                        </div>
                        <div class="text-warning">
                            <i class="bi bi-clock-history fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Income</h6>
                            <h2 class="mb-0 text-success">Rp {{ number_format($event->getTotalIncome(), 0, ',', '.') }}</h2>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-cash-stack fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <ul class="nav nav-tabs mb-3" id="registrationTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">
                All ({{ $event->registrations->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                Pending ({{ $event->registrations()->where('payment_status', 'pending')->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="verified-tab" data-bs-toggle="tab" data-bs-target="#verified" type="button">
                Verified ({{ $event->registrations()->where('payment_status', 'verified')->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button">
                Rejected ({{ $event->registrations()->where('payment_status', 'rejected')->count() }})
            </button>
        </li>
    </ul>

    <!-- Registrations Table -->
    <div class="tab-content" id="registrationTabsContent">
        <!-- All Tab -->
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            @include('admin.event.partials.registration-table', ['registrations' => $event->registrations])
        </div>

        <!-- Pending Tab -->
        <div class="tab-pane fade" id="pending" role="tabpanel">
            @include('admin.event.partials.registration-table', ['registrations' => $event->registrations()->where('payment_status', 'pending')->get()])
        </div>

        <!-- Verified Tab -->
        <div class="tab-pane fade" id="verified" role="tabpanel">
            @include('admin.event.partials.registration-table', ['registrations' => $event->registrations()->where('payment_status', 'verified')->get()])
        </div>

        <!-- Rejected Tab -->
        <div class="tab-pane fade" id="rejected" role="tabpanel">
            @include('admin.event.partials.registration-table', ['registrations' => $event->registrations()->where('payment_status', 'rejected')->get()])
        </div>
    </div>
</div>

<!-- Payment Proof Modal -->
<div class="modal fade" id="paymentProofModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Proof</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="paymentProofImage" src="" alt="Payment Proof" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
function viewPaymentProof(imageUrl) {
    document.getElementById('paymentProofImage').src = imageUrl;
    const modal = new bootstrap.Modal(document.getElementById('paymentProofModal'));
    modal.show();
}
</script>
@endsection
