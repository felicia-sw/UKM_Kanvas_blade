@extends('layouts.app')

@section('title', 'Pay Dues: ' . $duesPeriod->name)

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <h1 class="display-5 fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Pay Dues</h1>
                    
                    <div class="card bg-dark bg-opacity-75 border-warning mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $duesPeriod->name }}</h5>
                            <p class="mb-2"><strong>Amount:</strong> Rp {{ number_format($duesPeriod->amount, 0, ',', '.') }}</p>
                            <p class="mb-2"><strong>Due Date:</strong> {{ $duesPeriod->due_date->format('d M Y') }}</p>
                            @if($duesPeriod->description)
                                <p class="text-white-50 mb-0">{{ $duesPeriod->description }}</p>
                            @endif
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('dues.payment.store', $duesPeriod->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="payment_proof" class="form-label fw-semibold">Upload Payment Proof <span class="text-danger">*</span></label>
                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="form-control">
                            <small class="form-text text-muted">Accepted formats: JPG, PNG (Max: 2MB)</small>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Submit Payment
                            </button>
                            <a href="{{ route('dues.index') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
</style>
@endsection

