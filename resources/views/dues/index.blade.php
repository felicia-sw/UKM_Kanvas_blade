@extends('layouts.app')

@section('title', 'Dues Payment')

@section('content')
    <div class="page-bg-image text-white min-vh-100 py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 mb-4 backdrop-blur">
                        <h1 class="display-5 fw-bold mb-4"><i class="bi bi-cash-coin me-2"></i>Dues Payment</h1>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Current Dues -->
                        @if ($currentDues->count() > 0)
                            <div class="mb-4">
                                <h3 class="h4 mb-3">Current Dues</h3>
                                <div class="row g-3">
                                    @foreach ($currentDues as $dues)
                                        @php
                                            $userPayment = $payments->firstWhere('dues_period_id', $dues->id);
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="card bg-dark bg-opacity-75 border-warning">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $dues->name }}</h5>
                                                    <p class="card-text mb-2">
                                                        <strong>Amount:</strong> Rp
                                                        {{ number_format($dues->amount, 0, ',', '.') }}<br>
                                                        <strong>Due Date:</strong> {{ $dues->due_date->format('d M Y') }}
                                                    </p>
                                                    @if ($dues->description)
                                                        <p class="text-white-50 small mb-3">{{ $dues->description }}</p>
                                                    @endif
                                                    @if ($userPayment)
                                                        <span
                                                            class="badge 
                                                    @if ($userPayment->payment_status === 'verified') bg-success
                                                    @elseif($userPayment->payment_status === 'rejected') bg-danger
                                                    @else bg-warning text-dark @endif">
                                                            {{ ucfirst($userPayment->payment_status) }}
                                                        </span>
                                                    @else
                                                        <a href="{{ route('dues.payment.create', $dues->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="bi bi-credit-card me-1"></i>Pay Now
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Payment History -->
                        <div>
                            <h3 class="h4 mb-3">Payment History</h3>
                            @if ($payments->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th>Period</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->duesPeriod->name }}</td>
                                                    <td>Rp {{ number_format($payment->duesPeriod->amount, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                        @if ($payment->payment_status === 'verified') bg-success
                                                        @elseif($payment->payment_status === 'rejected') bg-danger
                                                        @else bg-warning text-dark @endif">
                                                            {{ ucfirst($payment->payment_status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $payment->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $payments->links() }}
                            @else
                                <p class="text-white">No payment history yet.</p>
                            @endif
                        </div>
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
            background-image: url('{{ asset('images/bg1.jpg') }}');
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

        .page-bg-image>* {
            position: relative;
            z-index: 1;
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
        }

        .card-body {
            color: #ffffff !important;
        }

        .card-title {
            color: #ffffff !important;
        }

        .card-text {
            color: #ffffff !important;
        }

        .table-dark th,
        .table-dark td {
            color: #ffffff !important;
        }

        .card-title {
            color: #ffffff !important;
        }

        .card-text {
            color: #ffffff !important;
        }

        .table-dark th,
        .table-dark td {
            color: #ffffff !important;
        }
    </style>
@endsection
